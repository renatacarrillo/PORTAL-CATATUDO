<?php

/** remover os warnings do frontend */
error_reporting(0);

if (!defined('CATATUDO_API')) {
  include_once '../config.php';
}


require_once 'c_functions.php';

$jwt = $_SESSION['admin']['jwt'];

if (isset($userID) && $userID != null) {

  $url = CATATUDO_API . "/users/$userID";

  $user = Myfunctions::requestApi('GET', $url, $data = [], $jwt);
}
