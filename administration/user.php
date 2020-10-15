<?php
ob_start();
require "./includes/userValidate.php";

$userID = $_GET['userID'];

include './controllers/c_user.php';

$imageProfile = !isset($user->image) || $user->image === NULL ? "img/semFoto.webp" : $user->image;
$userPhone = isset($user->phone) ? $user->phone : '';

// title tag page 
$titlePage = "Usuario";


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
                <h1 class="h2">Informações do usuário</h1>
                <p><small class="text-muted">User Id: <?= $user->_id ?></small></p>
                <div class="btn-toolbar mb-2 mb-md-0">
                  <div class="btn-group mr-2">
                    <button id="resetPassword" class="btn btn-sm btn-outline-secondary">Alterar Senha</button>
                    <button id="newAddress" class="btn btn-sm btn-outline-secondary">Novo Endereço</button>
                  </div>
                </div>
              </header>
              <section class="px-md-2">
                <h4>Básico</h4>
                <img id="preview" src="<?= $imageProfile ?>" alt="foto do usuario: <?= $user->name ?>" class="img-thumbnail w-25 float-md-right">
                <form class="w-75 px-md-5" name="form-profile">
                  <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" name="name" placeholder="Nome" value="<?= $user->name ?>" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-8">
                      <label for="name">Email</label>
                      <input type="text" class="form-control" name="email" placeholder="Email" value="<?= $user->email ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputCity">Telefone</label>
                      <input type="text" class="form-control" name="phone" value="<?= $userPhone ?>">
                    </div>
                  </div>
                  <p>Data do Cadastro <?= date("d-m-Y", strtotime($user->createdDate)) ?></p>
                  <!-- TODO: verificar se é necessario -->
                  <!-- <div class="form-group">
              <label for="imageProfile">Alterar imagem do Perfil</label>
              <input type="file" class="form-control-file" accept="image/*" id="imageProfile">
            </div> -->
                  <fieldset class="form-group bg-light p-3">
                    <div class="row">
                      <legend class="col-form-label col-sm-2 pt-0">Perfil</legend>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="gerador" name="userProfile" class="custom-control-input" value="gerador" <?= $user->isCollector == 'false' ? 'checked' : '' ?>>
                        <label class="custom-control-label" for="gerador">Gerador</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="coletor" name="userProfile" class="custom-control-input" value="coletor" <?= $user->isCollector == 'true' ? 'checked ' : 'disabled' ?>>
                        <label class="custom-control-label" for="coletor">Coletor</label>
                      </div>
                    </div>
                  </fieldset>
                  <fieldset class="form-group bg-light p-3">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" id="customCheck1" name="isAdmin" <?= $user->isAdmin == 'true' ? 'checked' : '' ?>>
                      <label class="custom-control-label h6" for="customCheck1">Administrador</label>
                      <small class="form-text text-muted">Liberar o acesso de administrador para o usuário.</small>
                    </div>
                  </fieldset>
                  <input type="hidden" class="form-control" name="userId" readonly value="<?= $user->_id ?>">

                  <div class="text-right my-3">
                    <button id="salvar" type="submit" class="text-right btn btn-outline-success">Salvar Alterações</button>
                  </div>
                </form>
              </section>
              <section class="pt-3" id="listAddresses">
                <h4>Endereços</h4>
                <p>Lista de endereços cadastrados do usuário.</p>

                <?php
                if (isset($user->addresses)) {
                  foreach ($user->addresses as $key => $address) { ?>
                    <form class="w-75 p-3 rounded bg-light mb-3" name="form-address">
                      <div class="address">
                        <div class="form-row">
                          <div class="col-md-9 mb-3">
                            <label for="street">Rua</label>
                            <input type="text" class="form-control" name="street" readonly value="<?= $address->street ?>">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="number">Numero</label>
                            <input type="text" class="form-control" name="number" readonly value="<?= $address->number ?>">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="complement">Complemento</label>
                            <input type="text" class="form-control" name="complement" readonly value="<?= $address->complement ?>">
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="neighborhood">Bairro</label>
                            <input type="text" class="form-control" name="neighborhood" readonly value="<?= $address->neighborhood ?>">
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="col-md-6 mb-3">
                            <label for="city">Cidade</label>
                            <input type="text" class="form-control" name="city" readonly value="<?= $address->city ?>">
                          </div>
                          <div class=" col-md-3 mb-3">
                            <label for="state">Estado</label>
                            <input type="text" class="form-control" name="state" readonly value="<?= $address->state ?>">
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="zipCode">CEP</label>
                            <input type="text" class="form-control" name="zipCode" readonly value="<?= $address->zipCode ?>">
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="codAddress" readonly value="<?= $address->codAddress ?>">
                        <input type="hidden" class="form-control" name="userId" readonly value="<?= $user->_id ?>">
                      </div>
                      <div class="row pt-3">
                        <div class="text-left col-6">
                          <span class="btn-sec text-left" style="display: none;">
                            <button id=" saveAddress" type="submit" class="text-right btn btn-sm btn-success">Salvar</button>
                            <button id="cancel" type="reset" class="text-right btn btn-sm btn-secondary">Cancelar</button>
                          </span>
                        </div>
                        <div class="text-right col-6">
                          <span class="text-right btn-pri">
                            <button id=" editAddress" type="submit" class="text-right btn btn-sm btn-warning">Editar</button>
                            <button id="deleteAddress" type="delete" class="text-right btn btn-sm btn-danger">Excluir</button>
                          </span>
                        </div>
                      </div>
                    </form>

                <?php }
                } else {
                  echo "<p id='notAddress' class='h3 p-3 text-secondary'>Nenhum endereço cadastrado</p>";
                } ?>
              </section>

            </div>
          </div>
          <!-- loading  -->
          <div id="loading" style="display: none">
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

  <!-- modal alert delete -->
  <div class="modal fade" id="modalAlert" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Atenção</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Confirma a exclusão do endereço?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" id="confirmed">Confirma</button>
        </div>
      </div>
    </div>
  </div>

  <!-- modal add new address -->
  <div class="modal fade" id="modalAddAddress" tabindex="-1" role="dialog" aria-labelledby="modalLabelAddAddress" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelAddAddress">Cadastrar novo Endereço</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="p-2" name="form-addAddress">
            <div class="addAddress">
              <div class="form-row">
                <div class="col-md-9 mb-3">
                  <label for="street">Rua</label>
                  <input type="text" class="form-control" name="street">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="number">Numero</label>
                  <input type="text" class="form-control" name="number">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="complement">Complemento</label>
                  <input type="text" class="form-control" name="complement">
                </div>
                <div class="col-md-6 mb-3">
                  <label for="neighborhood">Bairro</label>
                  <input type="text" class="form-control" name="neighborhood">
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="city">Cidade</label>
                  <input type="text" class="form-control" name="city">
                </div>
                <div class=" col-md-3 mb-3">
                  <label for="state">Estado</label>
                  <input type="text" class="form-control" name="state">
                </div>
                <div class="col-md-3 mb-3">
                  <label for="zipCode">CEP</label>
                  <input type="text" class="form-control" name="zipCode">
                </div>
              </div>
              <input type="hidden" class="form-control" name="userId" readonly value="<?= $user->_id ?>">
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

  <!-- modal alter password -->
  <div class="modal fade" id="modalAlterPass" tabindex="-1" role="dialog" aria-labelledby="modalLabelAlterPass" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelAlterPass">Alterar a senha do usuário</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="p-2" name="form-alterPass">
            <div class="form-group">
              <label for="password" class="col-form-label">Nova Senha:</label>
              <input type="text" class="form-control" name="password" required autocomplete="off">
              <small class="form-text text-muted">Por segurança, sempre solicitar ao usuário para alterar a senha temporária pelo Aplicativo.</small>
            </div>
            <input type="hidden" class="form-control" name="userId" readonly value="<?= $user->_id ?>">
            <div class="text-right">
              <button type="reset" class="btn btn-secondary">Limpar</button>
              <button type="submit" class="btn btn-success">Alterar</button>
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
  <script src="./js/user.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>