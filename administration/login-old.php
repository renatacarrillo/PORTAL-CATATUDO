<?php
if (!defined('SITE_URL')) {
  include_once '../config.php';
}
// title tag page 
// $titlePage = "Adm";
?>

<!doctype html>
<html lang="pt-br">

<!-- head -->
<?php require "./includes/Head.php"; ?>

<body class="body-login">
  <div class="" id="feedResponse"> </div>
  <div class="d-flex h-100 justify-content-center align-items-center">
    <div class="body-signin rounded">
      <form class="form-signin" action="" method="POST" name="form_login" novalidate>
        <div class="text-center mb-4">
          <h1 class="h3 mb-3 font-weight-normal">Administração Catatudo</h1>
          <p>Area restrita a administradores, faça login para continuar.</p>
        </div>
        <div class="form-label-group">
          <input type="email" id="inputEmail" class="form-control form-control-lg" name="email" placeholder="Email address" autofocus>
          <label for="inputEmail">Email</label>
        </div>
        <div class="form-label-group">
          <input type="password" id="inputPassword" class="form-control form-control-lg" name="password" placeholder="Password">
          <label for="inputPassword">Senha</label>
        </div>
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" name="remember" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
        <div class="text-center loading">
          <img src="img/loader.gif" id="load" class="load" alt="Carregando" style="display: none;" />
        </div>
        <p class="mt-5 mb-3 text-muted text-center">&copy;RRT 2019-2020</p>
      </form>
    </div>

  </div>
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="./js/login.js"></script>


</body>

</html>