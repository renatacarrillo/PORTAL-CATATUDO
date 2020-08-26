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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
include ("includes/header.php");
?>

<!-- NAV PÁGINA QUEM SOMOS -->
<nav class="mt-5 mb-5">
    <div class="container-fluid fundo-verde-projeto">
        <div class="row">
        <div class="col-sm-6">
            <h1 class="font-weight-bold ml-5 posi-proj-um">Conheça um pouco mais sobre nós!</h1>
            </div>  
            <div class="col-sm-6">
            <img src="./IMAGENS/photo-1552581234-26160f608093.jpg" class="efeito2 img-fluid posi-not-img posi-app mt-5" alt="">
            </div>
        </div>
    </div>
</nav>

<!-- SECTION PÁGINA QUEM SOMOS -->
<section class="mt-5 mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mt-3">
                <h1 class="text-center sombreamento-text"> SOBRE NÓS </h1>
                <h5>Somos alunos da FATEC São Roque - Faculdade de Tecnologia de São Roque, iníciamos nossa jornada no curso de Sistemas para Internet
                no 1º Semestre do ano de 2018. Composto por uma equipe de 3: Reginaldo Domingos, Renata Carrillo e Thais Machado.
                <h5>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mt-3">
            <h1 class="text-center sombreamento-text"> IDEIA DO PROJETO </h1>
            <h5>A ideia do projeto CATATUDO, surgiu logo no 3º semestre do nosso curso de Sistema para Interner, durante uma conversa entre a equipe,
            onde se apontou o levantamento de circuntâncias que deixavam claro a ausência de um sistema como o CATATUDO, por carência de coletas seletivas
            em muitos bairros onde 2 integrantes da equipe vivem. Foi pensando também na possibilidade de ajuda a coletores, que normalmente fazem dessa
            atividade como sustento e complementação de renda. Foi então que inicíamos a elaboração do projeto com pesquisas de campo, teste de usabilidade e etc.
            <h5>
            </div>
        </div>
    </div>

<!-- INCLUINDO O FOOTER -->
        <!-- FOOTER -->
        <footer class="">
			<div class="row">
				<div class="col-sm">
					<?php include 'includes/footer.php'?>
				</div>
			</div>                
        </footer>
    
</body>
</html>
