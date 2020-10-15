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
                <h1 class="h2">Usuários</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group mr-2">
                    <button id="todos" class="btn btn-sm btn-outline-secondary">Todos</button>
                    <button id="coletores" class="btn btn-sm btn-outline-secondary">Coletores</button>
                    <button id="geradores" class="btn btn-sm btn-outline-secondary">Geradores</button>
                  </div>
                  <button id="btnAddUser" class="btn btn-sm btn-outline-dark" data-toggle="modal" data-target="#modalCreateUser">
                    <i class="fas fa-user-plus"></i>
                    Cadastrar Novo
                  </button>
                </div>
              </header>

              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th># ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Perfil</th>
                      <th>Cadastro</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>
                  <!-- lista de usuarios  -->
                  <tbody id="tbodyUsers">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <nav aria-label="Navegação das paginas">
                <ul id="pagination" class="pagination pagination-sm justify-content-center">
                  <li class="page-item active" data-page="1"><a class="page-link">1</a></li>
                  <li class="page-item " data-page="2"><a class="page-link">2</a></li>
                  <li class="page-item " data-page="3"><a class="page-link">3</a></li>
                </ul>
              </nav>
            </div>
          </div>
          <div id="loading">
            <div class="d-flex justify-content-center align-items-center h-100 w-100">
              <div class="spinner-border text-light" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>

  <!-- modal add new user -->
  <div class="modal fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cadastrar novo usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="form-cadastro" class=" form-cadastro" method="POST">
            <div class="form-group">
              <label for="name" class="col-form-label">Nome Completo:</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="email" class="col-form-label">Email:</label>
              <input type="text" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label for="password" class="col-form-label">Senha:</label>
              <input type="text" class="form-control" name="password">
            </div>
            <div class="text-right">
              <button type="reset" class="btn btn-secondary">Limpar</button>
              <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <p>CataTudo</p>
        </div>
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