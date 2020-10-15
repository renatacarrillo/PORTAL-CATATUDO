<?php
ob_start();
session_start();
/**Validar se o usuario esta logado */
if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
  session_destroy();
  header("location: index.php");
  exit;
}

/**fazer o logout do usuario */
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  session_destroy();
  header('Location: login.php');
}

// title tag page 
$titlePage = "Noticias";

?>

<!doctype html>
<html lang="pt-br">

<!-- head -->
<?php require "./includes/Head.php"; ?>

<body>
  <!-- navbar menu -->
  <?php require_once "./includes/NavBar.php"; ?>

  <div class="container-fluid">
    <div class="row">
      <!-- sidebar menu -->
      <?php require "./includes/SideBarNav.php"; ?>

      <!-- content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="container">
          <div class="row row-adm-main">
            <div class="col-12">

              <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Noticias</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <button id="btnAddArticle" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalCreateUser">
                    <span data-feather="plus-circle"></span>
                    Cadastrar Novo
                  </button>
                </div>
              </div>


            </div>
          </div>
          <div class="row">
            <div class="col">
              <!-- paginação  -->
              <nav aria-label="Navegação das paginas">
                <ul id="pagination" class="pagination pagination-sm justify-content-center">
                  <li class="page-item active" data-page="1"><a class="page-link">1</a></li>
                  <li class="page-item " data-page="2"><a class="page-link">2</a></li>
                  <li class="page-item " data-page="3"><a class="page-link">3</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>





  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/custom.js"></script>
  <script src="./js/articles.js"></script>


  <!-- Icons -->
  <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
  <script>
    feather.replace()
  </script>

</body>

</html>
<?php ob_end_flush(); ?>