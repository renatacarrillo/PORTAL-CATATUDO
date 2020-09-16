<!-- 
    Archive: index.php
    Author: Reginaldo Cardoso Domingos / Renata Carrillo / Thais Machado Oliveira
    Since: 2020/05/25
-->

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
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <!-- Icones -->
  <script src="https://kit.fontawesome.com/d7ddfb275f.js" crossorigin="anonymous"></script>
  <!-- CSS padrão -->
  <link rel="stylesheet" href="css/style.css">
  <!-- FONTE MONTSERRAT -->
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">

</head>

<body class='container-fluid'>
  <!-- INCLUINDO O HEADER -->
  <?php include "includes/header.php" ?>

  <nav class="mt-5 mb-5">
    <div class="container fundo-verde">
      <div class="col-sm">
        <img src="./IMAGENS/businessinsider.png" class="img-garrafa" alt="Imagem de uma garrafa no mar">
      </div>
      <div class="row">
        <div class="col-sm fundo-escuro"></div>
        <div class="col-sm fundo-cinza">
          <h1 class="font-weight-bold text-princ ml-3">O planeta ainda pode ser RECICLADO</h1>
          <h3 class="corverde ml-3 mt-5">Você também pode ajudar a salvar o planeta, é só baixar o aplicativo
            nas lojas:</h3>
          <div class="row taman mt-5 mr-1">
            <div class="col-sm-6 tam-play-nav">
              <a href="https://play.google.com/store/"><img src="./IMAGENS/playstore.png" class="img-fluid"></a>
            </div>
            <div class="col-sm-6 tam-app-nav">
              <a href="https://www.apple.com/br/ios/app-store/"><img src="./IMAGENS/appstore.png" class="img-fluid"></a>
            </div>
          </div>
        </div>
        <div class="col-sm">
        </div>
      </div>
    </div>
  </nav>

  <!-- SECTION VEJA COMO FUNCIONA -->
  <section>
    <div class="container esp-caixas esp-nav-home">
      <div class="row">
        <div class="col-sm mt-5">
          <h1 class="teste text-center"> VEJA COMO FUNCIONA </h1>
          <hr></hr>
        </div>
      </div>

      <div class="row efeito2">
        <div class="col-sm-4 ml-5 mr-5 mt-5 esp-caixas">
          <h3 class="sombreamento-text">CADASTRO</h3>
          <hr></hr>
          <h5 class="square-color">Você faz o cadastro no site e baixa o aplicativo nas lojas.</h5>
        </div>

        <div class="row">
          <div class="col-sm ml-5 mr-5">
            <ul class="square mr-4">
              <h1 class="mb-4">01</h1>
              <h5>
                <li class="square-color">Totalmente Rápido</li>
                <li class="square-color">Totalmente Prático</li>
                <li class="square-color">Totalmente Seguro</li>
              </h5>
            </ul>
          </div>

          <div class="row">
            <div class="col-sm ml-5 esp-caixas">
              <i class="fas fa-address-book posi-mob-ind"></i>
            </div>
          </div>
        </div>
      </div>


      <div class="row efeito2">
        <div class="col-sm-4 ml-5 mr-5 esp-caixas">
          <h3 class="sombreamento-text">AGENDAMENTO</h3>
          <hr></hr>
          <h5 class="square-color">Você separa o lixo reciclável e pelo aplicativo agenda uma data para o
            coletor ir buscar.</h5>
        </div>


        <div class="row">
          <div class="col-sm ml-5 mr-5">
            <ul class="square mr-4">
              <h1 class="mb-4">02</h1>
              <h5>
                <li class="square-color">Ferramenta Simples</li>
                <li class="square-color">Muito Eficiente</li>
                <li class="square-color">Rápido</li>
              </h5>
            </ul>
          </div>

          <div class="row">
            <div class="col-sm ml-4 esp-caixas">
              <i class="far fa-calendar-check posi-mob-ind"></i>
            </div>
        </div>
      </div>
    </div>


      <div class="row efeito2">
        <div class="col-sm-4 ml-5 mr-5 esp-caixas esp-caixas-b">
          <h3 class="sombreamento-text">PRONTO!</h3>
          <hr></hr>
          <h5 class="square-color">Você separa o lixo reciclável e aguarda um coletor ir fazer a retirada.
          </h5>
        </div>

        <div class="row">
          <div class="col-sm ml-5 mr-5">
            <ul class="square mr-4">
              <h1 class="mb-4">03</h1>
              <h5>
                <li class="square-color">Apoie a Causa</li>
                <li class="square-color">Beneficie Coletores</li>
                <li class="square-color">Ajude o Planeta</li>
              </h5>
            </ul>
          </div>
        </div>

          <div class="row">
            <div class="col-sm ml-4 esp-caixas">
              <i class="fas fa-globe-americas posi-mob-ind-ul"></i>
            </div>
          </div>
      </div>
    </div>
  </section>

  <!-- NAV MATERIAIS RECICLAVEIS -->
  <nav class="esp-nav-dois-home mt-5">
    <div class="container">
      <div class="row">
        <div class="col-sm mt-2">

          <h1 class="teste text-center">MATERIAIS RECICLÁVEIS</h1>
          <h5 class="square-color text-center">Tenha conhecimento de todos os materiais que PODEM ser reciclados.</h5>
          <hr></hr>

          <div class="row mb-5">
            <div class="col-sm">
              <h4 class="text-center">PLÁSTICO</h4>
              <img src="./IMAGENS/garrafa.png" class="efeito2 ic-garraf img-fluid" alt="Imagem Plástico">
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm">
              <h4 class="text-center">PAPEL</h4>
              <img src="./IMAGENS/papel.png" class="efeito2 ic-garraf img-fluid" alt="Imagem Papel">
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm">
              <h4 class="text-center">VIDRO</h4>
              <img src="./IMAGENS/vidro.png" class="efeito2 ic-garraf img-fluid" alt="Imagem Vidro">
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm">
              <h4 class="text-center">METAL</h4>
              <img src="./IMAGENS/metal.png" class="efeito2 ic-garraf img-fluid" alt="Imagem Metal">
            </div>
            </div>

        </div>
      </div>
    </div>
  </nav>


  <!-- NAV INF -->
  <nav class="esp-nav-dois-home">
    <div class="container">
      <div class="row">
        <div class="col-sm mb-5 mt-5">
          <h2 class="teste text-center">O CATATUDO É O PORTAL PARA AJUDAR NO CONTROLE DO LIXO RECICLÁVEL</h>
            <hr>
            </hr>

            <div class="row">
              <div class="col-sm esp-nav-dois-home">
                <h3 class="square-color mt-3">Pessoas conscientes, como você, ajudam tanto o meio ambiente, como
                  os coletores que são imprescindíveis nessa causa.</h3>
                <h2 class="text-center mt-4 sombreamento-text-nav">JUNTE-SE A NÓS!</h2>
              </div>

              <div class="col-sm">
                <img src="./IMAGENS/boxed.png" class="efeito2 img-gerdau img-fluid" alt="Imagem Boxed Water">
              </div>
              
        </div>
      </div>
    </div>
  </nav>

  <!-- INCLUINDO O FOOTER -->
  <!-- FOOTER -->
  <?php include 'includes/footer.php' ?>

</body>
</html>