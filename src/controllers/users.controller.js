const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
const UsersModels = require('../models/users.models');
const logger = require('../../utils/winston');

/**função para criptografar a senha do usuario */
const hashPassword = (password) => bcrypt.hash(password, 10);

class User {
  constructor({ _id, name, email, password } = {}) {
    this.user_id = _id;
    this.name = name;
    this.email = email;
    this.password = password;
  }

  toJsonRes() {
    return {
      user_id: this.user_id,
      name: this.name,
      email: this.email,
    };
  }

  async comparePassword(passFromForm) {
    return await bcrypt.compare(passFromForm, this.password);
  }

  createJwsToken() {
    return jwt.sign({ ...this.toJsonRes() }, process.env.PRIVATE_KEY, {
      expiresIn: '365d',
    });
  }

  // decodedToken(jwtoken) {
  //   return jwt.verify(jwtoken, process.env.PRIVATE_KEY, (error, res) => {});
  // }
}
/**
 * Classe UserController com as chamadas para os models de usuario
 **/
class UsersController {
  /**
   * Metodo para listar todos os usuarios cadastrados
   */
  static async apiGetAllUsers(req, res) {
    try {
      let page = parseInt(req.query.page || 1);
      let limit = parseInt(req.query.limit || 10);

      const { userList, totalNumUser, count } = await UsersModels.getAllUsers(
        page,
        limit
      );

      let response = {
        results: userList,
        total_results: totalNumUser,
        page,
        count,
        limit,
      };

      res.json(response);
    } catch (e) {
      logger.error(`${e}`);
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo utilizado para adicionar um novo usuario
   **/
  static async apiAddUser(req, res) {
    try {
      let errors = {};
      let userFromBody = req.body;

      /**validações do form */
      if (userFromBody.password.length < 8) {
        errors.code = 400;
        errors.message = `Informações fora do padrão`;
        errors.description = `A senha precisa ser maior que 8 digitos`;
      }

      if (Object.keys(errors).length > 0) {
        res.status(400).json(errors);
        return;
      }

      const userInfo = {
        ...userFromBody,
        is_collector: false,
        is_admin: false,
        password: await hashPassword(userFromBody.password),
      };

      const insertResult = await UsersModels.addUser(userInfo);

      if (!insertResult.sucess) {
        errors.message = insertResult.error;
        errors.description = insertResult.description;
      }

      if (Object.keys(errors).length > 0) {
        res.status(400).json(errors);
        return;
      }

      res.status(201).json({
        code: 201,
        message: `Sucesso`,
        description: `Cadastro realizado com sucesso`,
      });
    } catch (e) {
      logger.error(`${e}`);
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**Metodo para listar um usuario especifico  */
  static async apiGetUser(req, res) {
    try {
      let id_user = req.params.id;

      // console.log(req.userJwt.user_id);
      if (req.userJwt.user_id != id_user) {
        res.status(401).json({
          code: 401,
          message: 'Não Autorizada',
          description: `As informações de autenticação necessárias estão ausentes ou não são válidas para o recurso.`,
        });
        return;
      }

      const resultFindUser = await UsersModels.getUser(id_user);

      if (resultFindUser == null) {
        res.status(404).json({
          code: 404,
          message: 'O recurso solicitado não existe',
          description:
            'O recurso solicitado não foi localizado em nossa base de dados',
        });
        return;
      }

      if (resultFindUser.error) {
        res.status(500).json({
          code: 500,
          message: resultFindUser.error,
          description: resultFindUser.description,
        });
        return;
      }

      res.status(200).json(resultFindUser);
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }

  /**
   * Metodo para alterar um usuario especifico
   */
  static async apiAlterUser(req, res) {
    try {
      let id_user = req.params.id;
      const userFromBody = req.body;

      const alterResult = await UsersModels.alterUser(id_user, userFromBody);

      var { error } = alterResult;

      if (error) {
        res.status(400).json({
          code: 400,
          message: `Erro interno, por favor tente mas tarde`,
          description: `${error}`,
        });
        return;
      }

      if (alterResult.matchedCount === 1 && alterResult.modifiedCount === 0) {
        res.status(200).json({
          code: 200,
          message: 'Não foram realizadas nenhuma mudança no usuario',
          description: 'Não foram realizadas nenhuma mudança no usuario',
        });
        return;
      }

      if (alterResult.modifiedCount === 0) {
        res.status(404).json({
          code: 404,
          message: 'O recurso solicitado não existe',
          description: 'O recurso solicitado não existe',
        });
        return;
      }

      res.status(200).json({
        status: 'Sucesso',
      });
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
   * Metodo para deletar um usuario
   */
  static async apiDeleteUser(req, res) {
    let id_user = req.params.id;
    let userInfoDelete = {};
    let errors = {};

    try {
      userInfoDelete.status = 'inativa';
      userInfoDelete.dateDeleteTS = Date.now();

      const deleteResult = await UsersModels.alterUser(id_user, userInfoDelete);

      if (!deleteResult.sucess) {
        errors.status = 'Falha';
        errors.message = 'Erro interno, por favor tente mas tarde';
      }

      res.status(200).json({
        status: 'Sucesso',
      });
    } catch (e) {
      logger.error(e, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: `Erro interno, por favor tente mas tarde`,
        description: `${e}`,
      });
    }
  }
  //TODO: incluir as regras e validações do email
  /**
   * Metodo para gerar um Token de autenticação para o client
   * */
  static async apiCreateAuth(req, res) {
    try {
      let errors = {};
      const { email, password } = req.body;

      /**validações do form */
      if (email.length < 8) {
        errors = [
          {
            code: 400,
            message: `Algumas informações enviadas estão fora do padrão`,
            description: `O email digitado não esta de acordo com os padrões`,
          },
        ];
      }

      if (Object.keys(errors).length > 0) {
        res.status(400).json(errors);
        return;
      }

      const userFromDb = await UsersModels.getUserFromEmail(email);

      if (!userFromDb) {
        res.status(401).json({
          code: 401,
          message: `E-mail não locarizado`,
          description: `Verifique se o email digitado esta correto`,
        });
        return;
      }

      const user = new User(userFromDb);

      /**validar a senha digitada com a senha do banco */
      const login = await user.comparePassword(password); //return true or false

      if (!login) {
        res.status(401).json({
          code: 401,
          message: `Senha não confere`,
          description: `Verifique se a senha digitada esta correta`,
        });
        return;
      }

      const resultCreateJwsToken = await UsersModels.addSession(
        user.user_id,
        user.createJwsToken()
      );

      if (!resultCreateJwsToken.sucess) {
        errors.status = 'Falha';
        errors.message = resultCreateJwsToken.error;
      }

      if (Object.keys(errors).length > 0) {
        res.status(400).json(errors);
        return;
      }

      res.status(201).json({
        code: 201,
        user_info: user.toJsonRes(),
        auth_token: user.createJwsToken(),
      });
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
   * Metodo para adicionar o endereço do usuario
   */
  static async apiAddUserAddress(req, res) {
    //   {
    //     "street": "Rua Leopoldo Couto de Magalhães Jr.",
    //     "number": "700",
    //     "neighborhood": "Itaim Bibi",
    //     "complement": "7° andar",
    //     "city": "São Paulo",
    //     "state": "SP"
    // }

    try {
      const userId = req.params.id;
      const userAddress = req.body;

      const addressResult = await UsersModels.addUserAdress(
        userId,
        userAddress
      );

      if (!addressResult.sucess) {
        res.status(500).json({
          code: 500,
          message: 'Erro interno, por favor tente mas tarde',
          description: addressResult.error,
        });
      }

      res.status(200).json({
        status: 'Sucesso',
      });
    } catch (e) {
      res.status(500).json({
        code: 500,
        message: 'Erro interno, por favor tente mas tarde',
        description: `${e}`,
      });
    }
  }

  /**
   *  Metodo para listar todos os endereços dos usuario
   */
  static async apiGetAllUserAddress(req, res) {
    try {
      const userId = req.params.id;
      const codAddress = req.params.codAddress;

      const { adressResult } = await UsersModels.getUserAdress(
        userId,
        codAddress
      );

      let response = {
        results: adressResult,
        total_results: 1,
        page: 0,
      };

      res.status(200).json(response);
    } catch (e) {
      logger.error(e, { label: 'Express' });
      res.status(500).json({
        code: 500,
        message: 'Erro interno, por favor tente mas tarde',
        description: `${e}`,
      });
    }
  }
}

module.exports = { UsersController, User };
