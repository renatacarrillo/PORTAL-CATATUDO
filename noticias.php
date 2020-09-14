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

  <nav class="mt-5 mb-5">
    <div class="container-fluid fundo-verde-noticias">
      <div class="row">
        <div class="col-sm fundo-escuro-noticias">
        </div>
        <div class="col-sm fundo-cinza-noticias">
          <div class="row">
            <div class="col-sm">
              <img src="./IMAGENS/notic-he.png" class="img-fluid posi-img-not-less mt-4" alt="">
            </div>
          </div>
          <h1 class="font-weight-bold verdeesc ml-3">Principais Notícias</h1>
        </div>
        <div class="col-sm back-mob">
          <h3 class="font-weight-bold posi-noticias text-white">Comprometida em reduzir de forma significativa o lixo gerado na região — especialmente quanto à reciclagem.</h3>
        </div>
      </div>
    </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm esp-caixas">
          <h1 class="teste text-center">NOTÍCIAS E NOVIDADES</h1>
          <hr>
          </hr>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 ml-3 mt-5 mb-5">
          <a href='https://www.portalr3.com.br/2019/02/acao-lixo-marinho-retira-600-garrafas-pet-do-mar-em-ilhabela/'>
            <img src="./IMAGENS/not-garr.png" class="efeito2 img-fluid btn btn-link" alt="">
          </a>
          <h2 class="teste mt-2 ml-4">Ação Lixo Marinho retira 600 garrafas pet do mar em Ilhabela</h2>
          <p class="square-color mt-1 ml-4">DIRETO DE: portalr3.com.br</p>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 ml-3 mt-5 mb-5">
          <a href='https://boxedwaterisbetter.com/'>
            <img src="./IMAGENS/boxedwater.png" class="efeito2 img-fluid btn btn-link" alt="">
          </a>
          <h2 class="teste mt-2 ml-4">Empresa Boxed Water Is Better LLC faz garrafas de um jeito inovador.</h2>
          <p class="square-color mt-1 ml-4">DIRETO DE: boxedwaterisbetter.com</p>
        </div>
      </div>
    </div>
  </section>

  <!-- INCLUINDO O FOOTER -->
  <!-- FOOTER -->
  <?php include 'includes/footer.php' ?>

</body>

</html>