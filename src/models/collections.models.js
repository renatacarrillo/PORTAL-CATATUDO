const logger = require('../../utils/winston');
const ObjectId = require('mongodb').ObjectID;

let collections;

class CollectModel {
  /**
   * Conectando com o coleção pre_collector
   */
  static async conectCollection(conn) {
    if (collections) {
      return;
    }
    try {
      collections = await conn.collection('collections');

      logger.info(`Conectado na coleção collections`, { label: 'MongoDB' });
    } catch (e) {
      logger.error(`Falha para conectar com a coleção collections: ${e} `, {
        label: 'MongoDB',
      });
    }
  }

  static async addCollect(dataCollection) {
    try {
      const resultInsert = await collections.insertOne(dataCollection);

      if (resultInsert.insertedCount == 0) {
        return {
          error: `Não foi possivel inserir a coleta`,
          description: `Ocorreu algum erro para adicionar a coleta`,
        };
      }

      return { _id: resultInsert.insertedId };
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Cadastrar o Coleta`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para pegar todas as coletas no banco
   */
  static async getAllCollect(filter) {
    const { page, status, generatorId, limit } = filter;

    let queryStatus = {};
    let queryGenerator = {};
    let query = {};

    let cursor;
    let pagination = page == 0 ? 0 : page - 1;
    let skip = pagination * limit;

    try {
      /** Filtro pos status */
      queryStatus = status ? { 'status.code': parseInt(status) } : {};
      /**filtro por usuario */
      queryGenerator = generatorId
        ? { generator_id: ObjectId(generatorId) }
        : {};

      logger.debug(`queryStatus: ${JSON.stringify(queryStatus)}`, {
        label: 'MongoDB',
      });

      logger.debug(`queryGenerator: ${JSON.stringify(queryGenerator)}`, {
        label: 'MongoDB',
      });

      query = { $and: [queryStatus, queryGenerator] };

      logger.debug(`Query Find: ${JSON.stringify(query)}`, {
        label: 'MongoDB',
      });

      cursor = await collections
        .find(query)
        .limit(limit)
        .project({ collect_date: 1, collect_type: 1 })
        .skip(skip);
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Erro para executar o comando Find`,
        description: `${e} `,
      };
    }

    try {
      const collectList = await cursor.toArray();
      const totalResults = await collections.countDocuments(query);
      const count = await collectList.length;

      return { collectList, totalResults, count };
    } catch (e) {
      logger.error(`Ocorreu um erro para montar os dados, ${e}`);
      return { collectList: [], totalResults: 0, error: `${e}` };
    }
  }

  /**
   * Metodo para buscar uma Coleta especifica no Banco
   */
  static async getCollect(colletcId) {
    try {
      const resultFindOne = await collections.findOne({
        _id: ObjectId(colletcId),
      });

      return resultFindOne;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Localizar o Coleta`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para deletar a coleta no Banco deletedCount
   */
  //TODO: definir qual o codigo de finalizado
  static async deleteCollect(colletcId) {
    try {
      const resultDelete = await collections.deleteOne({
        _id: ObjectId(colletcId),
        'status.code': { $ne: 1 },
      });

      return resultDelete;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Localizar o Coleta`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para alterar o status da coleta no banco
   */
  static async alterStatusCollect(colletcId, dataCollection) {
    try {
      const resultUpdate = await collections.updateOne(
        { _id: ObjectId(colletcId) },
        { $set: dataCollection }
      );

      console.log(resultUpdate);

      return resultUpdate.modifiedCount;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Localizar o Coleta`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para listar o status da coleta
   */
  static async getStatusCollect(colletcId) {
    try {
      const resultFind = await collections
        .find({ _id: ObjectId(colletcId) })
        .project({ status: 1, collect_date: 1 })
        .toArray();

      return resultFind[0];
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Localizar o Coleta`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para alterar a coleta no banco
   */
  static async alterCollect(colletcId, dataCollection) {
    try {
      const resultUpdate = await collections.findOneAndUpdate(
        { _id: ObjectId(colletcId) },
        { $set: dataCollection },
        { returnOriginal: false }
      );

      return resultUpdate.value;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Localizar o Coleta`,
        description: `${e} `,
      };
    }
  }
}

module.exports = CollectModel;
