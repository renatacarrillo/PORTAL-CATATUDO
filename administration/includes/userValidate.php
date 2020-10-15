<?php

session_start();
/**Validar se o usuario esta logado */
if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
  session_destroy();
  header("location: login.php");
  exit;
}

/**fazer o logout do usuario */
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
  session_destroy();
  header('Location: login.php');
}
