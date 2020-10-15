<?php
ob_start();
session_start();

if (!defined('SITE_URL')) {
  include_once '../config.php';
}
// title tag page 
$titlePage = "Login";

?>
<!Doctype html>
<html lang="pt-br">

<!-- head -->
<?php require "./includes/Head.php"; ?>

<body class="body-login">
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-md-8 d-none d-sm-flex justify-content-center align-items-center banner-login">
        <div>

        </div>
      </div>
      <div class="col-md-4 d-flex justify-content-center align-items-center">
        <div class="body-signin px-4 px-md-2 ">
          <form class="form-signin" action="" method="POST" name="form_login" novalidate>
            <div class="text-center mb-4">
              <img src="img/logo.png" class="img-fluid w-75" alt="Logo do site Catatudo">
              <h2 class="h4 mb-3 font-weight-normal text-secondary">Área Administrativa</h2>
              <p class="text-secondary">Area restrita a administradores, faça login para continuar.</p>
            </div>
            <div class="form-label-group">
              <input type="email" id="inputEmail" class="form-control form-control-lg" name="email" required placeholder="Endereço de Email" autofocus>
              <label for="inputEmail">Email</label>
            </div>
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control form-control-lg" name="password" required placeholder="Password">
              <label for="inputPassword">Senha</label>
            </div>
            <div class="checkbox mb-3">
              <label>
                <input type="checkbox" name="remember" value="remember-me"> Remember me
              </label>
            </div>
            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            <div class="text-center loading">
              <img src="img/loader.gif" id="load" class="load" alt="Carregando" style="display: none;" />
            </div>
            <p class="mt-5 mb-3 text-muted text-center">&copy;RRT 2019-2020</p>

            <a class="text-secondary" href="../index.php"><i class="fas fa-backward"></i> voltar para o site</a>
          </form>
        </div>

      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/login.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>