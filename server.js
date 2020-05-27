require('dotenv').config();
const express = require('express');
const MongoClient = require('mongodb').MongoClient;
const logger = require('./utils/winston');

/**local require */
const UsersModels = require('./src/models/users.models');
const UsersRoutes = require('./src/routes/users.routes');
const ArticleModels = require('./src/models/articles.models');
const ArticleRoutes = require('./src/routes/articles.routes');
const CollectorRoutes = require('./src/routes/collector.routes');
const CollectorModels = require('./src/models/collector.models');
const CollectRoutes = require('./src/routes/collections.routes');
const CollectModels = require('./src/models/collections.models');

logger.info(`Inciando o servidor...`, { label: 'Express' });

const app = express();

const port = 3001;

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use('/api/v1/users', UsersRoutes);
app.use('/api/v1/articles', ArticleRoutes);
app.use('/api/v1/collectors', CollectorRoutes);
app.use('/api/v1/collections', CollectRoutes);

logger.info(`Rotas Carregadas`, { label: 'Express' });
// const uri =
//   'mongodb+srv://recycle:recycle2020@sandbox-a2uhg.mongodb.net/test?retryWrites=true&w=majority';
logger.info(`Inciando conexões com o MongoDb`, { label: 'Express' });
const client = new MongoClient(process.env.DB_MONGO, {
  useNewUrlParser: true,
  useUnifiedTopology: true,
});

client
  .connect()
  .catch((err) => {
    console.error(err.stack);
    process.exit(1);
  })
  .then(async (client) => {
    /**Conecta na database  */
    const db = client.db('recycle');
    logger.info(`Conectado no banco db recycle`, { label: 'MongoDb' });

    await UsersModels.conectCollection(db);
    await ArticleModels.conectCollection(db);
    await CollectorModels.conectCollection(db);
    await CollectModels.conectCollection(db);

    /**starta a aplicação */
    app.listen(port, () => {
      logger.info(`O servidor foi iniciado na porta ${port}`, {
        label: 'Express',
      });
    });
  });

client.close();
