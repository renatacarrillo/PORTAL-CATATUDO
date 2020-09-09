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
        <form name="form-cadastro" class="formulario" oninput='passwordRPT.setCustomValidity(passwordRPT.value != password.value ? "As senhas não conferem." : "")'>
          <div class="verdecla form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="" name="email" placeholder="Digite seu email" required>
            <div class="invalid-feedback">
              Por favor, digite um email valido.
            </div>
          </div>
          <div class="form-group verdecla">
            <label for="name">Nome Completo</label>
            <input type="text" class="form-control" id="" name="name" placeholder="Digite seu nome">
          </div>
          <div class="form-group verdecla">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control" id="" name="phone" placeholder="Digite seu telefone">
          </div>
          <div class="form-group verdecla">
            <label for="password">Senha</label>
            <input type="name" class="form-control" id="" name="password" placeholder="Digite sua senha">
          </div>
          <div class="form-group verdecla">
            <label for="passwordRPT">Confirme a Senha</label>
            <input type="name" class="form-control" id="" name="passwordRPT" placeholder="Repita sua senha">
          </div>
          <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="isOk" name="isOk" required>
            <label class="custom-control-label verdecla" for="isOk">Confirmar que está de acordo com a Política de Privacidade</label>
            <div class="invalid-feedback">Confirme que está de acordo com a Política de Privacidade</div>
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
        <?php include 'includes/footer.php' ?>
      </div>
    </div>
  </footer>

  <script src="/js/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


  <script src="./js/cadastro.js"></script>
</body>

</html>