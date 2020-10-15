<?php
ob_start();
require "./includes/userValidate.php";

// title tag page 
$titlePage = "Leiaute";

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
              <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom  border-success">
                <h1 class="h2">Aprovação de Coletores</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <p class="text-right text-muted">Solicitações de usuários para <br> serem aprovados como coletores</p>
                </div>
              </header>

              <section class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">Usuário</th>
                      <th scope="col">Data Solicitação</th>
                      <th scope="col">Status</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>
                  <!-- lista das pendecias para aprovação-->
                  <tbody id="tbodyCollectors">

                  </tbody>

                </table>
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
        </main>
      </div>
    </div>
  </div>


  <!-- JS files Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/custom.js"></script>

  <script src="./js/collectors.js"></script>


</body>

</html>
<?php ob_end_flush(); ?>