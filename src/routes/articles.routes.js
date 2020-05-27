const express = require('express');
const routes = express.Router();

const ArticleController = require('../controllers/articles.controller');

/**rotas a partir /api/v1/articles */

routes.get('/', ArticleController.apiGetAllArticles);

routes.get('/:id_article', ArticleController.apiGetArticle);

routes.post('/', ArticleController.apiAddArticle);

routes.put('/:id_article', ArticleController.apiAlterArticle);

routes.delete('/:id_article', ArticleController.apiDeleteArticle);

module.exports = routes;
