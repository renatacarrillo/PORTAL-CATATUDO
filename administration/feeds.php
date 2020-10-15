<?php
ob_start();
require "./includes/userValidate.php";

// title tag page 
$titlePage = "Feeds";

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
              <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3  border-success border-bottom">
                <h1 class="h2">Feeds e Patrocinados</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <a class="btn btn-sm btn-outline-dark" href="feed.php?action=addNewFeed">
                    <i class="fas fa-plus-circle"></i>
                    Cadastrar Novo
                  </a>
                </div>
              </header>
              <section class="card-deck" id="bodyFeeds">

              </section>
              <div id="loading">
                <div class="d-flex justify-content-center align-items-center h-100 w-100">
                  <div class="spinner-border text-light" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
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
        </main>
      </div>
    </div>
  </div>


  <!-- JS files Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/custom.js"></script>
  <script src="./js/feeds.js"></script>


</body>

</html>
<?php ob_end_flush(); ?>