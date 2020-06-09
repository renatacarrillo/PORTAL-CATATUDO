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
<div class="row">
    <div class="col mt-5 mb-5">
<?php
include ("includes/header.php");
?>
</div>
    </div>


<section class="mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h1 class="verdeesc text-center">FAÇA AGORA SEU CADASTRO</h1>
        </div>
    </div>
</section>


<div class="container mt-5 mb-5">
<div class="row">
<div class="col-md-6 offset-md-3">
<form class="formulario">
  <div class="verdecla form-group">
    <label for="exampleInputEmail1">E-mail</label>
    <input type="email" class="form-control" id="" placeholder="Digite seu email">
  </div>
  <div class="form-group verdecla">
    <label for="exampleInputPassword1">Nome Completo</label>
    <input type="name" class="form-control" id="" placeholder="Digite seu nome">
  </div>
  <div class="form-group verdecla">
    <label for="exampleInputPassword1">Endereço</label>
    <input type="name" class="form-control" id="" placeholder="Digite seu endereço">
  </div>
  <div class="form-group verdecla">
    <label for="exampleInputPassword1">Telefone</label>
    <input type="name" class="form-control" id="" placeholder="Digite seu telefone">
  </div>
  <div class="form-group verdecla">
    <label for="exampleInputPassword1">CPF</label>
    <input type="name" class="form-control" id="" placeholder="Digite seu cpf">
  </div>
  <div class="form-group verdecla">
    <label for="exampleInputPassword1">RG</label>
    <input type="name" class="form-control" id="" placeholder="Digite seu rg">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label verdecla" for="exampleCheck1">Confirmar que está de acordo com a Política de Privacidade</label>
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">CADASTRAR</button>
</form>
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
