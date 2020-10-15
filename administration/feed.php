<?php
ob_start();
require "./includes/userValidate.php";
require_once "./controllers/c_gets_for_id.php";

if (isset($_GET['action']) && $_GET['action'] == 'editFeed') {
  $isEditUser =  true;
  $titleFeedPage = 'Editar a Publicação';
  $createDate =  strftime('%d de %B de %Y', strtotime($feed->createdDate));
  $updateDate = isset($feed->updatedDate) ?  strftime('%d de %B de %Y', strtotime($feed->updatedDate)) : '';
  $titlePage = "Editando: " . $feed->title;
} else {
  $isEditUser =  false;
  $titleFeedPage = 'Adicionar nova publicação';

  // title tag page 
  $titlePage = "Adicionar Novo Feed";
}

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
                <h1 class="h2"><?= $titleFeedPage ?></h1>
              </header>
              <section class="px-md-2">
                <?php if ($isEditUser) { ?>
                  <form name="form-feed" class="form-feed" method="POST" data-action="editFeed">
                    <div class="row">
                      <div class="col-md-8">
                        <h4>Publicação</h4>
                        <div class="form-group">
                          <label for="title" class="col-form-label">Titulo</label>
                          <input type="text" class="form-control form-control-lg" name="title" autocomplete="off" required value="<?= $feed->title ?>">
                          <small class="form-text text-muted">
                            O titulo principal da publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="subtitle" class="col-form-label">Subtitulo</label>
                          <input type="text" class="form-control form-control-lg" name="subtitle" autocomplete="off" required value="<?= $feed->subtitle ?>">
                          <small class="form-text text-muted">
                            Subtitulo para resumir o publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="body" class="col-form-label">Corpo da Publicação</label>
                          <textarea class="form-control" rows="5" name="body" required><?= $feed->body ?></textarea>
                          <small class="form-text text-muted">
                            Texto principal da publicação</small>
                        </div>
                      </div>
                      <div class="col-md-4 mb-5 bg-light p-2">
                        <p class="h5">Informações</p>
                        <p class="form-text mb-2">Criado em: <?= $createDate ?></p>
                        <p class="form-text">Atualizado em: <?= $updateDate ?></p>
                        <div class=" form-group">
                          <label for="tag">Tipo do Feed (Tag)</label>
                          <select class="form-control" name="tag" required>
                            <option value=""></option>
                            <option value="Noticias" <?= $feed->tag == 'Noticias' ? 'selected' : '' ?>>Noticias</option>
                            <option value="Dicas" <?= $feed->tag == 'Dicas' ? 'selected' : '' ?>>Dicas</option>
                            <option value="Novidades" <?= $feed->tag == 'Novidades' ? 'selected' : '' ?>>Novidades</option>
                            <option value="Especial" <?= $feed->tag == 'Especial' ? 'selected' : '' ?>>Especial</option>
                          </select>
                          <small class="form-text text-muted">
                            Classificação do conteudo
                          </small>
                        </div>
                        <div class="form-group">
                          <label for="image" class="col-form-label">Imagem Banner(url)</label>
                          <input type="text" class="form-control" name="image" value="<?= $feed->image ?>">
                          <small class="form-text text-muted">
                            A URL da imagem que será o banner da publicação</small>
                        </div>

                        <div class="form-group">
                          <label for="source" class="col-form-label">Fonte da Noticia</label>
                          <input type="text" class="form-control" name="source" value="<?= $feed->source ?>">
                          <small class=" form-text text-muted">
                            Qual a fonte/site da publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="link" class="col-form-label">Link da Noticia</label>
                          <input type="text" class="form-control" name="link" value="<?= $feed->link ?>">
                          <small class="form-text text-muted">
                            Link para noticia original completa</small>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="true" <?= $feed->active == "true" ? 'checked' : '' ?>>
                          <label class="form-check-label" for="inlineRadio1">Ativo</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="false" <?= $feed->active == "true" ? '' : 'checked' ?>>
                          <label class="form-check-label" for="inlineRadio2">Inativo</label>
                        </div>
                        <small class="form-text text-muted">
                          Status da publicação</small>
                        <input type="hidden" class="form-control" name="feedId" readonly value="<?= $feed->_id ?>">
                        <div class="text-right mt-4">
                          <button type="button" class="btn btn-danger" id="deleteFeed">Excluir</button>
                          <button id="btnSubmit" type="submit" class="btn btn-success">Salvar Alterações</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php } else { ?>
                  <form name="form-feed" class="form-feed" method="POST" data-action="addNewFeed">
                    <div class="row">
                      <div class="col-md-8">
                        <h4>Publicação</h4>
                        <div class="form-group">
                          <label for="title" class="col-form-label">Titulo</label>
                          <input type="text" class="form-control form-control-lg" name="title" autocomplete="off" required>
                          <small class="form-text text-muted">
                            O titulo principal da publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="subtitle" class="col-form-label">Subtitulo</label>
                          <input type="text" class="form-control form-control-lg" name="subtitle" autocomplete="off" required>
                          <small class="form-text text-muted">
                            Subtitulo para resumir o publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="body" class="col-form-label">Corpo da Publicação</label>
                          <textarea class="form-control" rows="5" name="body" required></textarea>
                          <small class="form-text text-muted">
                            Texto principal da publicação</small>
                        </div>
                      </div>
                      <div class="col-md-4 mb-5 bg-light p-2">
                        <p class="h5">Informações</p>
                        <div class="form-group">
                          <label for="tag">Tipo do Feed (Tag)</label>
                          <select class="form-control" name="tag" required>
                            <option value=""></option>
                            <option value="Noticias">Noticias</option>
                            <option value="Dicas">Dicas</option>
                            <option value="Novidades">Novidades</option>
                            <option value="Especial">Especial</option>
                          </select>
                          <small class="form-text text-muted">
                            Classificação do conteudo
                          </small>
                        </div>
                        <div class="form-group">
                          <label for="image" class="col-form-label">Imagem Banner(url)</label>
                          <input type="text" class="form-control" name="image" required>
                          <small class="form-text text-muted">
                            A URL da imagem que será o banner da publicação</small>
                        </div>

                        <div class="form-group">
                          <label for="source" class="col-form-label">Fonte da Noticia</label>
                          <input type="text" class="form-control" name="source">
                          <small class="form-text text-muted">
                            Qual a fonte/site da publicação</small>
                        </div>
                        <div class="form-group">
                          <label for="link" class="col-form-label">Link da Noticia</label>
                          <input type="text" class="form-control" name="link">
                          <small class="form-text text-muted">
                            Link para noticia original completa</small>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="true">
                          <label class="form-check-label" for="inlineRadio1">Ativo</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="false">
                          <label class="form-check-label" for="inlineRadio2">Inativo</label>
                        </div>
                        <small class="form-text text-muted">
                          Status da publicação</small>
                        <div class="text-right mt-4">
                          <button type="reset" class="btn btn-secondary">Limpar</button>
                          <button id="btnSubmit" type="submit" class="btn btn-success">Cadastrar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <?php } ?>
              </section>

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
          O Documento excluido não pode ser reativado, Confirma a exclusão do endereço?
          <smal>obs: Você pode tambem apenas desativar o feed</smal>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-danger" id="confirmed">Confirma</button>
        </div>
      </div>
    </div>
  </div>


  <!-- JS files Placed at the end of the document so the pages load faster -->
  <script src="../js/jquery-3.5.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/toastr.min.js"></script>
  <script src="./js/custom.js"></script>
  <script src="./js/feed.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>