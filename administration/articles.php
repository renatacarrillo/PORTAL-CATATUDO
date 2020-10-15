<?php
ob_start();
require "./includes/userValidate.php";

// title tag page 
$titlePage = "Artigos";

?>

<!doctype html>
<html lang="pt-br">

<!-- head -->
<?php require "./includes/Head.php"; ?>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- sidebar  -->
      <?php require "./includes/SideBarNav.php"; ?>
      <div class="main">
        <!-- navbar  -->
        <?php require "./includes/NavBar.php"; ?>
        <!-- Main content  -->
        <main class="container">
          <div class="row row-adm-main">
            <div class="col-12">
              <section class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom  border-success">
                <h1 class="h2">Artigos</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <button id="btnAddArticle" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#modalCreateUser">
                    <span data-feather="plus-circle"></span>
                    Cadastrar Novo
                  </button>
                </div>
              </section>

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
        </main>
      </div>
    </div>
  </div>


  <!-- JS files Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/custom.js"></script>

  <script src="./js/users.js"></script>


</body>

</html>
<?php ob_end_flush(); ?>