<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CATATUDO - Portal</title>
  <meta name="author" content="Renata">
  <link rel="icon" href="./IMAGENS/RECICLAGEM.png" alt="Logotipo CATATUDO">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href='https://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>

  <!-- Icones -->
  <script src="https://kit.fontawesome.com/d7ddfb275f.js" crossorigin="anonymous"></script>
  <!-- CSS padrão -->
  <link rel="stylesheet" href="css/style.css">
  <!-- FONTE MONTSERRAT -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

</head>

<body class='container-fluid'>
  <!-- INCLUINDO O HEADER -->
  <?php
  include("includes/header.php");
  ?>

  <!-- NAV PÁGINA QUEM SOMOS -->
  <nav class="mt-5 mb-5">
    <div class="container-fluid fundo-verde-projeto">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="font-weight-bold ml-5 posi-proj-um">CONHEÇA UM POUCO MAIS SOBRE NÓS!</h1>
        </div>
        <div class="col-sm-6">
          <img src="./IMAGENS/quem-somos.jpg" class="efeito2 img-fluid posi-not-img-quem-somos posi-app-quem-somos mt-5" alt="">
        </div>
      </div>
    </div>
  </nav>

  <!-- SECTION PÁGINA QUEM SOMOS -->
  <section class="mt-5 mb-5">

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mt-3 mb-3">
          <h1 class="text-center sombreamento-text"> IDEIA DO PROJETO </h1>
          <hr>
          </hr>
          <h5>A ideia do projeto CATATUDO, surgiu logo no 3º semestre do nosso curso de Sistema para Interner, durante uma conversa entre a equipe,
            onde se apontou o levantamento de circuntâncias que deixavam claro a ausência de um sistema como o CATATUDO, por carência de coletas seletivas
            em muitos bairros onde 2 integrantes da equipe vivem.</h5>
          <h5>Foi pensando também na possibilidade de ajuda a coletores, que normalmente fazem dessa
            atividade como sustento e complementação de renda. Foi então que inicíamos a elaboração do projeto com pesquisas de campo, teste de usabilidade e etc.
            <h5>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mt-3">
          <h1 class="text-center sombreamento-text"> SOBRE NÓS </h1>
          <hr>
          </hr>
          <h5>Somos alunos da FATEC São Roque - Faculdade de Tecnologia de São Roque, iníciamos nossa jornada no curso de Sistemas para Internet
            no 1º Semestre do ano de 2018. Composto por uma equipe de 3: Reginaldo Domingos, Renata Carrillo e Thais Machado.
            <h5>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-5 mb-3">
      <div class="row">
        <div class="col-sm-4 ml-4 mt-3">
          <div class="card border-warning" style="width: 20rem;">
            <img class="card-img-top" src="./IMAGENS/reginaldo.jpeg" alt="Foto de Reginaldo">
            <div class="card-body">
              <h5 class="card-title">Reginaldo Domingos</h5>
              <p class="card-text">Estudante do curso de Sistemas para Internet da FATEC São Roque.</p>
              <p class="card-text">Analista de Sistema na Cambucci</p>
              <a href="https://github.com/rcdomingos" class="btn btn-primary">Perfil do GitHub</a>
            </div>
          </div>
        </div>


        <div class="col-sm-4 ml-5 mt-3">
          <div class="card border-danger" style="width: 20rem;">
            <img class="card-img-top" src="./IMAGENS/renata.jpeg" alt="Foto de Renata">
            <div class="card-body">
              <h5 class="card-title">Renata Carrillo</h5>
              <p class="card-text">Estudante do curso de Sistemas para Internet da FATEC São Roque.</p>
              <p class="card-text">Estudante de Programação</p>
              <a href="https://github.com/renatacarrillo" class="btn btn-primary">Perfil do GitHub</a>
            </div>
          </div>
        </div>

        <div class="col-sm-2 ml-5 mt-3">
          <div class="card border-success" style="width: 20rem;">
            <img class="card-img-top" src="./IMAGENS/thais.jpeg" alt="Foto de Thais">
            <div class="card-body">
              <h5 class="card-title">Thais Machado</h5>
              <p class="card-text">Estudante do curso de Sistemas para Internet da FATEC São Roque.</p>
              <p class="card-text">Suporte no Sistema na </p>
              <a href="https://github.com/thaismachado94" class="btn btn-primary">Perfil do GitHub</a>
            </div>
          </div>
        </div>

      </div>
    </div>
    </div>

  </section>

  <!-- INCLUINDO O FOOTER -->
  <!-- FOOTER -->
  <?php include 'includes/footer.php' ?>


</body>

</html>