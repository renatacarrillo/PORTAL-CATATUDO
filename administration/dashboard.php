<?php
ob_start();
require "./includes/userValidate.php";

// title tag page 
$titlePage = "Dashboard";

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
          <div class="row">
            <div class="col-12">
              <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom  border-success">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                    <i class="fas fa-calendar-alt"></i>
                    Mês atual
                  </button>
                </div>
              </header>

              <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

              <section class="mb-5">
                <h2>Informações e estatisticas</h2>
                <p>Informações atualizadas de usuários e coletas do projeto.</p>
                <div class="row statistics text-center p-4">
                  <div class="col-md-3 col-6">
                    <span id="usuarios">0</span>
                    <p>Usuários cadastrados</p>
                  </div>
                  <div class="col-md-3 col-6">
                    <span id="coletores">0</span>
                    <p>Coletores registrados</p>
                  </div>
                  <div class="col-md-3 col-6">
                    <span id="coletas">0</span>
                    <p>Coletas solicitadas</p>
                  </div>
                  <div class="col-md-3 col-6">
                    <span id="finalizadas">0</span>
                    <p>Coletas finalizadas</p>
                  </div>
                </div>
              </section>
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

  <!-- Graphs -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script src="./js/dashboard.js"></script>


</body>

</html>
<?php ob_end_flush(); ?>