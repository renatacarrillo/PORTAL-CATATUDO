const logger = require('../../utils/winston');
const ObjectId = require('mongodb').ObjectID;

let preCollector;

class CollectorModels {
  /**
   * Conectando com o coleção pre_collector
   */
  static async conectCollection(conn) {
    if (preCollector) {
      return;
    }
    try {
      preCollector = await conn.collection('pre_collector');

      logger.info(`Conectado na coleção pre_collector`, { label: 'MongoDB' });
    } catch (e) {
      logger.error(`Falha para conectar com a coleção pre_collector: ${e} `, {
        label: 'MongoDB',
      });
    }
  }

  /**
   * Metodo para inserir o coletor no banco coleção pre-cadastro
   */
  static async addCollector(userId, userData) {
    try {
      const resultInsert = await preCollector.updateOne(
        { user_id: ObjectId(userId) },
        { $set: userData },
        { upsert: true }
      );

      if (resultInsert.modifiedCount || resultInsert.upsertedCount) {
        return { sucess: true };
      } else {
        return {
          error: `Ocorreu um erro para Cadastrar o Collector`,
          description: `Não foi possivel cadastrar ou localizar o collector`,
        };
      }
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para Cadastrar o Collector`,
        description: `${e} `,
      };
    }
  }

  /**
   * Metodo para alterar o status da solicitação no banco coleção pre-cadastro
   */
  static async alterStatusPreCollector(userId, data) {
    try {
      const resultUpdate = await preCollector.findOneAndUpdate(
        { user_id: ObjectId(userId) },
        { $set: data },
        { returnOriginal: false }
      );

      return resultUpdate.value;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para executar o comando Find`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo para buscar no banco todos os documentos na coleção pre-cadastro
   */

  static async getAllPreCollector() {
    try {
      const resultFind = await preCollector.find().toArray();

      return resultFind;
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para executar o comando Find`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo para buscar no banco o status de uma solcitação de cadastro
   */
  static async getStatusPreCollector(userId) {
    try {
      return await preCollector
        .find({ user_id: ObjectId(userId) })
        .project({ user_id: 1, status: 1, _id: 0 })
        .toArray();
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para executar o comando Find`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo para deletar no banco uma solicitação de pre-cadastro que <> de 2 (aprovado)
   **/
  static async deletePreCollector(userId) {
    try {
      const resultDelete = await preCollector.deleteOne({
        user_id: ObjectId(userId),
        status: { $ne: 2 },
      });

      if (resultDelete.deletedCount > 0) {
        return { sucess: true };
      } else {
        return {
          error: `Não foi Possivel Deletar o Cadastro`,
          description: `Talves o recurso não exista, ja foi deletado ou aprovado`,
        };
      }
    } catch (e) {
      logger.error(e, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para executar o comando Delete`,
        description: `${e}`,
      };
    }
  }
}

module.exports = CollectorModels;
