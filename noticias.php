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

<nav class="mt-5 mb-5">
    <div class="container-fluid fundo-verde-noticias">
        <div class="row">
        <div class="col-sm fundo-escuro-noticias">
        </div>
        <div class="col-sm fundo-cinza-noticias">
        <div class="row">
        <div class="col-sm">
            <img src="./IMAGENS/img-projeto-caixa.png" class="img-fluid posi-img-not posi-app mt-5" alt="">
        </div>
        </div>
            <h1 class="font-weight-bold verdeesc ml-3 notic-h">Veja as notícias do Projeto</h1>
        </div>
        <div class="col-sm ">
            <h3 class="font-weight-bold posi-noti-h-dois posi-noticias">Comprometida em reduzir de forma significativa o lixo gerado na região — especialmente quanto à reciclagem.</h3>
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
                <hr></hr>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 ml-3 mt-5 mb-5">
                <img src="./IMAGENS/adidas.png" class="efeito2 img-fluid btn btn-link" alt="">
                <h2 class="teste mt-2 ml-4">Adidas lança tênis do futuro feito de um único material 100% reciclável.</h2>
                <p class="square-color mt-1 ml-4">DIRETO DE: exame.com</p>
            </div>
        </div>  

        <div class="row">
            <div class="col-sm-12 ml-3 mt-5 mb-5">
                <img src="./IMAGENS/gerdau.png" class="efeito2 img-fluid btn btn-link" alt="">
                <h2 class="teste mt-2 ml-4">Gerdau oferece US$ 45 mil por soluções inovadoras em reciclagem.</h2>
                <p class="square-color mt-1 ml-4">DIRETO DE: exame.com</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 ml-3 mt-5 mb-5">
                <img src="./IMAGENS/starbucks.png" class="efeito2 img-fluid btn btn-link" alt="">
                <h2 class="teste mt-2 ml-4">Starbucks transforma lixo plástico de suas lojas em mobília.</h2>
                <p class="square-color mt-1 ml-4">DIRETO DE: exame.com</p>
            </div>
        </div>

    </div>
</section>

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