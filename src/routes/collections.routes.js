const express = require('express');
const routes = express.Router();
const authentication = require('../middlewares/authentication');
const CollectController = require('../controllers/collections.controller');

/**rotas apartir do 'api/v1/collections/' */
routes.post('/', authentication, CollectController.apiAddCollect);
routes.get('/', authentication, CollectController.apiGetAllCollect);

routes.put('/:collectId', authentication, CollectController.apiAlterCollect);
routes.get('/:collectId', authentication, CollectController.apiGetCollect);
routes.delete(
  '/:collectId',
  authentication,
  CollectController.apiDeleteCollect
);

/** manipulação do status */
routes.put(
  '/:collectId/status',
  authentication,
  CollectController.apiAlterStatusCollect
);
routes.get(
  '/:collectId/status',
  authentication,
  CollectController.apiGetStatusCollect
);

module.exports = routes;
