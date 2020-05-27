const ObjectId = require('mongodb').ObjectID;
const logger = require('../../utils/winston');

let users;
let sessions;

class UsersModels {
  /**
   * Metodo para conectar na coleção usuario
   **/
  static async conectCollection(conn) {
    if (users && sessions) {
      return;
    }

    try {
      users = await conn.collection('users');
      logger.info(`Conectado na coleção users`, { label: 'MongoDB' });

      sessions = await conn.collection('sessions');
      logger.info(`Conectado na coleção sessions`, { label: 'MongoDB' });
    } catch (e) {
      logger.error(
        `Falha para conectar com a coleção users ou sessions: ${e}`,
        { label: 'MongoDB' }
      );
    }
  }
  /**
   * Metodo para Listar todos os usuarios do banco
   */
  static async getAllUsers(page, limit) {
    let query = {};
    let cursor;
    let pagination = page == 0 ? 0 : page - 1;
    let skips = limit * pagination;
    let project = {};

    try {
      //listar todos os usuarios
      cursor = await users.find(query).skip(skips).limit(limit);
    } catch (e) {
      logger.error(`Não foi possivel realizar o comando find: ${e}`, {
        label: 'MongoDb',
      });
      return { userList: [], totalNumUser: 0, count: 0 };
    }

    try {
      const userList = await cursor.toArray();
      const totalNumUser = await users.countDocuments(query);
      const count = await userList.length;

      return { userList, totalNumUser, count };
    } catch (e) {
      logger.error(`Não foi possivel converter os dados: ${e}`, {
        label: 'MongoDb',
      });
      return { userList: [], totalNumUser: 0, count: 0 };
    }
  }

  /**
   * Metodo para inserir o usuario no banco
   **/
  static async addUser(infoUsers) {
    try {
      await users.insertOne(infoUsers);

      return { sucess: true };
    } catch (e) {
      logger.error(`Erro ao executar o comando insertOne, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para Cadastrar o usuario`,
        description: `${e}`,
      };
    }
  }
  /**
   * Metodo para buscar um usuario pelo ID no banco
   **/
  static async getUser(idUser) {
    try {
      return await users
        .find({ _id: ObjectId(idUser) })
        .project({ password: 0 })
        .toArray();
    } catch (e) {
      logger.error(`${e}`, { label: 'MongoDb' });
      return {
        error: `Ocorreu um erro para buscar o usuario`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo pala buscar um usuario pelo email no banco
   **/
  static async getUserFromEmail(email) {
    try {
      return users.findOne({ email: email });
    } catch (e) {
      logger.error(`Erro ao executar o comando findOne, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para buscar o usuario`,
        description: `${e}`,
      };
    }
  }
  /**
   * Metodo para alterar as informações so usuario no banco
   */
  static async alterUser(userId, userInfo) {
    try {
      const resultupdate = await users.updateOne(
        { _id: ObjectId(userId) },
        { $set: userInfo }
      );

      return resultupdate;
    } catch (e) {
      logger.error(`Erro ao executar o comando updateOne, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para alterar o usuario`,
        description: `${e}`,
      };
    }
  }

  /**metodo para inserir o token de acesso na tabela sessim */
  static async addSession(userId, jwt) {
    try {
      let infoSession = {
        user_id: userId,
        jwt: jwt,
        created_at: new Date(),
      };

      const resultUpdate = await sessions.updateOne(
        { user_id: userId },
        { $set: infoSession },
        { upsert: true }
      );
      // if (!resultUpdate.modifiedCount || resultUpdate.upsertedCount ) {
      //   return { error: 'Não foi possivel alterar os dados' };
      // }
      return { sucess: true };
    } catch (e) {
      logger.error(`Erro ao executar o comando updateOne, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para criar o Jwt`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo para adicionar o endereço no banco
   */
  static async addUserAdress(userId, address) {
    try {
      const userAddressUpdate = await users.updateOne(
        { _id: ObjectId(userId) },
        { $push: { address: address } }
      );

      if (userAddressUpdate.modifiedCount || userAddressUpdate.upsertedCount) {
        return { sucess: true };
      } else {
        return { error: 'Não foi possivel incluir o endereço do usuario' };
      }
    } catch (e) {
      logger.error(`Erro ao executar o comando updateOne, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para cadastrar o endereço`,
        description: `${e}`,
      };
    }
  }

  /**
   * Metodo para buscar os endereços cadastrados do usuario no banco
   */

  static async getUserAdress(userId, codAdress = 1) {
    let projection = {};
    // projection = {
    //   address: { $arrayElemAt: ['$address', adressPosition] }
    // };

    try {
      let adressPosition = codAdress > 0 ? codAdress - 1 : 0;

      const resultQuery = await users.aggregate([
        {
          $match: {
            _id: ObjectId(userId),
          },
        },
        {
          $project: {
            _id: 0,
            address: { $arrayElemAt: ['$address', adressPosition] },
          },
        },
      ]);

      let adressResult = await resultQuery.toArray();
      console.log(adressResult);

      return { adressResult };
    } catch (e) {
      logger.error(`Erro ao executar o comando aggregate, ${e}`, {
        label: 'MongoDb',
      });
      return {
        error: `Ocorreu um erro para listar os endereços`,
        description: `${e}`,
      };
    }
  }
}

module.exports = UsersModels;
