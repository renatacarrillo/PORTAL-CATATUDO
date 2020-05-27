const jwt = require('jsonwebtoken');

module.exports = (req, res, next) => {
  try {
    const { authorization } = req.headers;

    if (!authorization) {
      res.status(401).json({
        code: 401,
        message: 'Header invalido',
        description: 'Deve ser enviado tag Authorization no header'
      });
      return;
    }

    const [authType, token] = authorization.trim().split(' ');

    if (authType != 'Bearer') {
      res.status(401).json({
        code: 401,
        message: 'Header invalido',
        description: 'Deve ser enviado um token do tipo Bearer'
      });
      return;
    }

    const decoded = jwt.verify(token, process.env.PRIVATE_KEY);

    req.userJwt = decoded;

    next();
  } catch (err) {
    res.status(401).json({
      code: 401,
      message: 'Não Autorizada',
      description: `${err}`
    });
  }
};

// eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiNWU3OTZiNDAzYWZlOWQwZjdhM2NiNDQxIiwibmFtZSI6IlN0ZXZlIEpvYnMiLCJlbWFpbCI6InN0ZXZlLmpvYnNzaWx2YUBhcHBsZS5jb20iLCJpYXQiOjE1ODU2MTEwMjYsImV4cCI6MTU4NTY5NzQyNn0.1BgYUpt4Sajupudaa04dPM0C2FtVcIF3-sOJhm8MqKY
