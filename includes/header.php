<?php
if (!defined('SITE_PATH')) {
  include_once 'config.php';
}
?>

<header class='shadow p-3 mb-5 bg-white rounded fixed-top'>
  <div class='container-fluid'>
    <div class='row'>
      <div class='col-sm-12 col-md-4 text-sm-center'>
        <a href='index.php'><img src='./IMAGENS/CATATUDO1.png' class='img-logotipo btn btn-link' alt='Logotipo CATATUDO'></a>
      </div>
      <nav class='col-sm-12 col-md-8 text-right'>
        <a href='noticias.php' type='button' class='efeito3 btn corbtn font-weight-bold'>NOTÍCIAS</a>
        <a href='projeto.php' type='button' class='efeito3 btn corbtn font-weight-bold'>PROJETO</a>
        <!-- <a href='cadastro.php' type='button' class='efeito3 btn corbtn font-weight-bold'>CADASTRE-SE</a> -->
        <!-- botão via jquery -->
        <a href='#' type='button' class='ml-md-5 btn btn-success font-weight-bold  slide-register-open'>CADASTRE-SE</a>
      </nav>
    </div>
  </div>
</header>
<!-- fomrulario de cadastro  -->
<?php include  'includes/formCadastro.php' ?>