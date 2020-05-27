const logger = require('../../utils/winston');
const CollectModel = require('../models/collections.models');
const ObjectId = require('mongodb').ObjectID;

/**Função para gerar o status do cadastro */
const createStatusCollect = (code) => {
  let description;

  switch (parseInt(code)) {
    case 1:
      description = 'Em Aberto';
      break;
    case 2:
      description = 'Aceita pelo Coletor';
      break;
    case 3:
      description = 'Coleta realizada com sucesso';
      break;
    case 4:
      description = 'Informações Pendentes';
      break;
    default:
      description = 'Codigo Não identificado';
      break;
  }

  return {
    code: parseInt(code),
    description: description,
  };
};

/**Função para remover os campos vazios do objeto */
const dataCleaning = (obj) => {
  Object.keys(obj).forEach((key) => {
    if (obj[key] && typeof obj[key] === 'object') dataCleaning(obj[key]);
    else if (obj[key] === undefined) delete obj[key];
  });
  return obj;
};

class CollectController {
  /**
   * Metodo para adicionar uma coleta
   */
  static async apiAddCollect(req, res) {
    let collectDataCleaning = {};
    let dataCollect = {};

    // preparando os dados que serão inseridos
    try {
      dataCollect.generator_id = ObjectId(req.userJwt.user_id); //JWT

      //validação dos dados
      let error = {};

      if (!req.body.collectDate) {
        error.collectDate = 'É necessario informar a data da coleta';
      } else {
        dataCollect.collect_date = new Date(req.body.collectDate);
      }
      dataCollect.collect_time = req.body.collectTime;
      dataCollect.collect_photo = req.body.collectPhoto;
      dataCollect.created_date = new Date();
      dataCollect.generator_note = req.body.notes;

      /** validar o endereço */
      dataCollect.collect_address = {};
      dataCollect.collect_address.street = req.body.street;
      dataCollect.collect_address.number = req.body.number;
      dataCollect.collect_address.complement = req.body.complement;
      dataCollect.collect_address.neighborhood = req.body.neighborhood;
      dataCollect.collect_address.city = req.body.city;
      dataCollect.collect_address.state = req.body.state;
      dataCollect.collect_address.zip_code = req.body.zipCode;

      dataCollect.collect_type = Array.isArray(req.body.collectType)
        ? req.body.collectType
        : Array(req.body.collectType);
      dataCollect.collect_weight = parseFloat(req.body.collectWeight);

      dataCollect.status = createStatusCollect(1);

      /**Removendo os campos undefined */
      collectDataCleaning = await dataCleaning(dataCollect);

      if (Object.keys(error).length > 0) {
        res.status(400).json({
          error: 'Ocorreram erros na validações do formulario',
          description: error,
        });
        return;
      }
    } catch (e) {
      logger.error(`${e}`, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Ocorreu erro na tratativa dos dados`,
        description: `${e}`,
      });
    }
    // enviando os dados para o banco
    try {
      const resultAddCollect = await CollectModel.addCollect(
        collectDataCleaning
      );

      res.status(200).json({
        resultAddCollect,
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
   * Metodo para listar todas as coletas
   */
  //TODO: Listar as coleta do usuario JWT
  static async apiGetAllCollect(req, res) {
    try {
      let page = parseInt(req.query.page || 1);
      let limit = parseInt(req.query.limit || 10);
      let status = req.query.status || null;
      let generatorId = req.query.generator || null;

      let filter = { page, status, limit, generatorId };

      const {
        collectList,
        totalResults,
        count,
      } = await CollectModel.getAllCollect(filter);

      let response = {
        results: collectList,
        total_results: totalResults,
        page,
        count,
        limit,
      };

      res.status(200).json(response);
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
   * Metodo para listar uma coleta especifica
   */
  static async apiGetCollect(req, res) {
    try {
      const collectId = req.params.collectId;

      const listCollect = await CollectModel.getCollect(collectId);

      res.status(200).json(listCollect);
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }
  /**
   * Metodo para Deletar uma Coleta especifica
   */
  static async apiDeleteCollect(req, res) {
    try {
      const collectId = req.params.collectId;

      const listCollect = await CollectModel.deleteCollect(collectId);

      if (listCollect.deletedCount > 0) {
        res.status(204).send();
      } else {
        res.status(404).json({
          code: 404,
          message: `Não foi possivel exlcluir o documento`,
          description: `O documento não esta disponivel ou ja foi excluido`,
        });
      }
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para alterar os status da coleta (assumir)
   */
  static async apiAlterStatusCollect(req, res) {
    const collectId = req.params.collectId;
    const status = req.body.statusTo;

    let dataCollect = {};

    try {
      /**Aceitar a coleta */
      if (status == 2) {
        dataCollect.collector_id = req.userJwt.user_id;
        dataCollect.acepted_date = new Date();
      }

      /**Finalizar a coleta */
      if (status == 3) {
        dataCollection.collected_date = new Date();
      }

      dataCollect.status = createStatusCollect(status);

      const resultAlterStatus = await CollectModel.alterStatusCollect(
        collectId,
        dataCollect
      );

      if (resultAlterStatus > 0) {
        res.status(201).json({
          code: 201,
          message: `Alteração realizada com sucesso`,
          description: `O status da coleta foi alterado para ${dataCollect.status.description}`,
        });
      } else {
        res.status(400).json({
          code: 400,
          message: `Não foi possivel alterar o status da solicitação`,
          description: `O recurso solicitado não estava disponivel para alteração`,
        });
      }
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para listar o status da coleta especifica
   */
  static async apiGetStatusCollect(req, res) {
    try {
      const collectId = req.params.collectId;

      const infoStatus = await CollectModel.getStatusCollect(collectId);

      return res.status(200).json(infoStatus);
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para alterar a coleta
   */
  static async apiAlterCollect(req, res) {
    const collectId = req.params.collectId;
    let dataCollect = {};
    let collectDataCleaning = {};

    /**validar se aleração pode ser alterada ou não pelo status */
    try {
      const statusCollect = await CollectModel.getStatusCollect(collectId);

      if (statusCollect.status.code != 1) {
        res.status(400).json({
          code: 500,
          message: `Não foi possivel alterar a coleta`,
          description: `Colleta com o status = ${statusCollect.status.description} não podem ser alteradas apenas excluida`,
        });
        return;
      }
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
      return;
    }
    /**realizar a alteração */
    try {
      /**verificar os campos do form */
      if (req.body.collectDate) {
        dataCollect.collect_date = new Date(req.body.collectDate);
      }
      dataCollect.collect_time = req.body.collectTime;
      dataCollect.collect_photo = req.body.collectPhoto;
      dataCollect.generator_note = req.body.notes;
      /** validar o endereço */
      dataCollect.collect_address = new Object();
      dataCollect.collect_address.street = req.body.street;
      dataCollect.collect_address.number = req.body.number;
      dataCollect.collect_address.complement = req.body.complement;
      dataCollect.collect_address.neighborhood = req.body.neighborhood;
      dataCollect.collect_address.city = req.body.city;
      dataCollect.collect_address.state = req.body.state;
      dataCollect.collect_address.zip_code = req.body.zipCode;
      if (req.body.collectType) {
        dataCollect.collect_type = Array.isArray(req.body.collectType)
          ? req.body.collectType
          : Array(req.body.collectType);
      }
      if (req.body.collectWeight) {
        parseFloat(req.body.collectWeight);
      }

      dataCollect.collect_address = await dataCleaning(
        dataCollect.collect_address
      );

      if (Object.keys(dataCollect.collect_address).length == 0) {
        dataCollect.collect_address = undefined;
      }

      dataCollect.altered_date = new Date();

      /**Removendo os campos undefined */
      collectDataCleaning = await dataCleaning(dataCollect);

      const resultUpdate = await CollectModel.alterCollect(
        collectId,
        collectDataCleaning
      );

      res.status(200).json({ resultUpdate });
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }
}

module.exports = CollectController;
