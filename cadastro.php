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
  <div class="row">
    <div class="col mt-5 mb-5">
      <?php
      include("includes/header.php");
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
        <section class="">
          <div id="section-register">
            <p>Preencha seus dados para começar a reciclar</p>
            <div id="feedResponse"></div>
            <form name="form-cadastro" class="" method="POST" oninput='passwordRPT.setCustomValidity(passwordRPT.value != password.value ? "As senhas não conferem." : "")'>
              <div class="form-group verdecla">
                <label for="name">Nome Completo</label>
                <input type="text" class="form-control" name="name" placeholder="Digite seu nome" required>
              </div>
              <div class="verdecla form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="Digite seu email" required>
              </div>
              <div class="form-group verdecla">
                <label for="phone">Telefone</label>
                <input type="text" class="form-control" name="phone" placeholder="Digite seu telefone">
              </div>
              <div class="form-group verdecla">
                <label for="password">Senha</label>
                <input type="password" class="form-control" name="password" placeholder="Digite sua senha" required>
              </div>
              <div class="form-group verdecla">
                <label for="passwordRPT">Confirme a Senha</label>
                <input type="password" class="form-control" name="passwordRPT" placeholder="Repita sua senha" required>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="" required>
                <label class="form-check-label verdecla" for="isOk">
                  Confirmar que está de acordo com a Política de Privacidade
                </label>
              </div>
              <button type="submit" class="btn btn-success btn-lg btn-block">CADASTRAR</button>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
  <!-- INCLUINDO O FOOTER -->
  <!-- FOOTER -->
  <?php include 'includes/footer.php' ?>

</body>

</html>