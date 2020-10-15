<?php

/** remover os warnings do frontend */
error_reporting(0);
/**
 * Controller para fazer o GET de recursos unicos por ID
 */
if (!defined('CATATUDO_API')) {
  include_once '../config.php';
}

require_once 'c_functions.php';

$jwt = $_SESSION['admin']['jwt'];


/**verificar qual o action que quer o recurso */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
  case 'editFeed':
    if (isset($_GET['feedId'])) {
      $feedID = $_GET['feedId'];
      $url = CATATUDO_API . "/feeds/$feedID";
      $feed = Myfunctions::requestApi('GET', $url, $data = [], $jwt);
    }
    break;

  default:
    # code...
    break;
}
