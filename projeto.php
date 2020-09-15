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
    <div class="container-fluid fundo-verde-projeto">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="font-weight-bold ml-5 posi-proj-um">Veja o objetivo do nosso Projeto</h1>
          <h4 class="font-weight-bold ml-5 mt-5 color-proj-dois">Conscientizando moradores, apoiando coletores!</h4>
        </div>
        <div class="col-sm-6">
          <img src="./IMAGENS/green.png" class="efeito2 img-fluid mt-5" alt="">
        </div>
      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm esp-caixas-proj">
          <h1 class="teste text-center">INOVADOR, ACESSÍVEL, CONSCIENTE</h1>
          <hr>
          </hr>
        </div>
      </div>

      <div class="row">
        <div class="efeito2 col-sm ml-3 mt-5 mb-5">
          <i class="fas fa-recycle icons-nav-green ml-4"></i>
          <h2 class="teste mt-2 ml-4">O PROJETO</h2>
          <p class="square-color mt-1 ml-4">O objetivo do nosso projeto, é algo urgente, necessário, IMPORTANTE, para a conscientização das pessoas como um todo, e não menos importante o alcance considerável da diminuição dos lixos em todo o mundo, todos sabemos que dá pra reciclar, dá pra separar esse lixo reciclável do lixo orgânico, então o enfoque principal é essa mudança da população perante o lixo que descarta.</p>
        </div>

        <div class="efeito2 col-sm ml-3 mt-5 mb-5">
          <i class="fas fa-laptop-code icons-nav-green ml-4"></i>
          <h2 class="teste mt-2 ml-4">DESENVOLVEDORES</h2>
          <p class="square-color mt-1 ml-4">A equipe de desenvolvimento é composta por 3 pessoas: Reginaldo Domingos, Renata Carrillo e Thais Machado. Todos alunos da FATEC São Roque - Faculdade de tecnologia de São Roque, e estudantes do curso de Sistemas para Internet. Desenvolvido exclusivamente para o Trabalho de Graduação de 2020.</p>
        </div>
      </div>

      <hr>
      </hr>

      <div class="row">
        <div class="efeito2 col-sm ml-3 mt-5 mb-5">
          <i class="fas fa-hands-helping icons-nav-green ml-4"></i>
          <h2 class="teste mt-2 ml-4">PARCERIAS</h2>
          <p class="square-color mt-1 ml-4">O projeto tem como finalidade gerar parcerias com empresas, instituições, prefeituras e etc. Acreditamos que com cooperação, o projeto pode crescer positivamente, alcançando outros requisitos e paramêtros. A gente conta com vocês para essa causa extremamente importante e urgente.</p>
        </div>

        <div class="efeito2 col-sm ml-3 mt-5 mb-5">
          <i class="fas fa-people-arrows icons-nav-green ml-4"></i>
          <h2 class="teste mt-2 ml-4">ENVOLVIDOS</h2>
          <p class="square-color mt-1 ml-4">Os envolvidos desse projeto, são de uma forma geral, as pessoas, qualquer indivíduo que queira contribuir com o nosso projeto, pode efetuar seu cadastro em nosso sistema, e começar utilizar de nossos serviços, ao mesmo tempo que, contribui com a preservação do meio ambiente, e claro, ajuda todos os coletores, que seram nossa base para esse projeto se tornar possível.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- NAV PARCEIROS -->
  <nav class="esp-nav-home">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm esp-caixas-b tam-mob-ind">
          <h1 class="teste text-center"> PARCEIROS </h1>
          <hr>
          </hr>

          <div class="row mt-5 cor-nav-home">
            <div class="col-sm tam-mob-ind-li">
              <h3 class="mt-5 mb-5 ml-1">MORADORES</h3>
              <i class="efeito fas fa-users icons-nav-green ml-5 mb-5"></i>
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm tam-mob-ind-lix">
              <h3 class="mt-5 mb-5 ml-1">COLETORES</h3>
              <i class="efeito fas fa-trash-alt icons-nav ml-5 mb-5"></i>
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm tam-mob-ind-lix">
              <h3 class="mt-5 mb-5 ml-1">PREFEITURA</h3>
              <i class="efeito fas fa-archway icons-nav-green ml-5 mb-5"></i>
            </div>

            <div class="vl mr-5"></div>

            <div class="col-sm tam-mob-ind-lix">
              <h3 class="mt-5 mb-5 ml-1">INDÚSTRIAS</h3>
              <i class="efeito fas fa-city icons-nav ml-5 mb-5"></i>
            </div>

          </div>
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