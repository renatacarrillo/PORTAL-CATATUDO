const logger = require('../../utils/winston');
const CollectorModels = require('../models/collector.models');
const UsersModels = require('../models/users.models');

/**Função para gerar o status do cadastro */
const createStatusCollector = (code) => {
  let description;

  switch (code) {
    case 1:
      description = 'Aguardando Aprovação';
      break;
    case 2:
      description = 'Aprovado';
      break;
    case 3:
      description = 'Rejeitado';
      break;
    case 4:
      description = 'Informações Pendentes';
      break;
    default:
      description = 'Codigo Não identificado';
      break;
  }

  return {
    status: {
      code: code,
      description: description,
    },
  };
};

/**
 * Classe com os metodos utilizado para as solcitações dos Coletores
 */
class CollectorController {
  /**
   * Metodo utilizado para adicinar o coletor no pre-coletores
   */
  static async apiAddCollector(req, res) {
    try {
      const userIdJWT = req.userJwt.user_id;
      const userNameJWT = req.userJwt.name;
      const collectedCities = req.body.collectedCities;
      const collectedNeighbourhood = req.body.collectedNeighbourhood;
      const vehicle = req.body.vehicle;
      const { status } = createStatusCollector(1);

      let data = {
        user_name: userNameJWT,
        collected_cities: Array.isArray(collectedCities)
          ? collectedCities
          : Array(collectedCities),
        collected_neighbourhood: Array.isArray(collectedNeighbourhood)
          ? collectedNeighbourhood
          : Array(collectedNeighbourhood),
        vehicle: Array.isArray(vehicle) ? vehicle : Array(vehicle),
        created_date: new Date(),
        status,
      };

      const resultAddCollector = await CollectorModels.addCollector(
        userIdJWT,
        data
      );

      if (resultAddCollector.sucess) {
        res.status(200).json({
          code: 200,
          message: `Enviado com Sucesso`,
          description: `Solicitação aguardando a aprovação`,
        });
        return;
      }

      res.status(500).json({
        code: 500,
        message: resultAddCollector.error,
        description: resultAddCollector.description,
      });
    } catch (e) {
      logger.error(`${e}`, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   *  Metodo para listar todos os usuarios cadastrados como pre-coletores
   */
  static async apiGetAllPreCollector(req, res) {
    try {
      const collectorsList = await CollectorModels.getAllPreCollector();

      collectorsList.map((collector) => {
        collector.Links = [
          {
            url: `http://localhost:3001/api/v1/users/${collector.user_id}`,
            Method: 'GET',
            Type: 'Details',
          },
          {
            url: `http://localhost:3001/api/v1/collectors/${collector.user_id}/status`,
            Method: 'PATCH',
            Type: 'Action',
          },
        ];
      });

      res.status(200).json({ collectorsList });
    } catch (e) {
      logger.error(`${e}`, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para listar as informações de um usuario
   */
  static async apiGetStatusPreCollector(req, res) {
    try {
      const userId = req.params.id;

      const resultFind = await CollectorModels.getStatusPreCollector(userId);

      res.json(resultFind);
    } catch (e) {
      logger.error(e, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para deletar a solicitação de coletor
   */
  static async apiDeletePreCollector(req, res) {
    try {
      const userId = req.params.id;

      const resultDelete = await CollectorModels.deletePreCollector(userId);

      console.log(resultDelete);

      if (resultDelete.sucess) {
        res.status(204).send();
      } else {
        res.status(404).json({
          code: 404,
          message: resultDelete.error,
          description: resultDelete.description,
        });
      }
    } catch (e) {
      logger.error(e, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para alterar o status da solicitação do pre-coletor
   */
  static async apiAlterStatusPreCollector(req, res) {
    const newStatus = req.body.statusTo;
    const userId = req.params.id;
    const infoStatus = createStatusCollector(newStatus);
    const statusValidos = [1, 2, 3, 4, 5];

    try {
      if (statusValidos.includes(newStatus)) {
        const resultStatus = await CollectorModels.alterStatusPreCollector(
          userId,
          infoStatus
        );

        if (!resultStatus) {
          res.status(500).json({
            code: 500,
            message: `Erro interno, por favor tente mas tarde`,
            description: `Não foi possivel alterar o status da solicitação`,
          });
          return;
        }

        /** adicionar os dados na coleção users quando aprovado */
        if (newStatus === 2) {
          let data = {
            collected_cities: resultStatus.collected_cities,
            collected_neighbourhood: resultStatus.collected_neighbourhood,
            vehicle: resultStatus.vehicle,
            collector_date: new Date(),
            is_collector: true,
          };

          const resultAlterUser = await UsersModels.alterUser(userId, data);

          if (resultAlterUser.modifiedCount == 0) {
            logger.error('Ocorreu um erro para alterar o usuario', {
              label: 'Express',
            });
            res.status(500).json({
              code: 500,
              message: `Erro interno, por favor tente mas tarde`,
              description: `${resultAlterUser.e}`,
            });
            return;
          }
        }

        res.status(200).json(infoStatus);
      } else {
        res.status(404).json({
          code: 404,
          message: `Informação invalida para alteração do Status`,
          description: `O status ${newStatus} informado não é valido, informar os codigos ${statusValidos}`,
        });
      }
    } catch (e) {
      logger.error(`${e}`, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }
}

module.exports = CollectorController;
