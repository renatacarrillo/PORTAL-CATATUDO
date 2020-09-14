<?php

/** remover os warnings do frontend */
error_reporting(0);


if (!defined('CATATUDO_API')) {
  include_once '../config.php';
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];


// $url = "https://catatudo-api.herokuapp.com/api/v1/users";
$url = CATATUDO_API . "/users";


$userData = array("name" => $name, "email" => $email, "password" => $password, "phone" => $phone);

//$jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1ZjUyNThjYWUwMGM1ODBkMzhjNmI5ZGEiLCJuYW1lIjoiVXNlciBEZW1vIFRlc3QiLCJlbWFpbCI6InVzZXIzQGRlbW8uY29tIiwiaXNBZG1pbiI6ZmFsc2UsImlhdCI6MTU5OTI1MDEyMSwiZXhwIjoxNjMwNzg2MTIxfQ.KL-OXt08yWeu6ioTjSxe0NDYAqZxeDjep0ai3nyifSY';

$resultCreateUser = requestApi("POST", $url, $userData);

// var_dump($resultCreateUser);

if (isset($resultCreateUser->code)) {

  if ($resultCreateUser->code == 201) {
    echo json_encode(["code" => 201]);
  } else {
    echo json_encode([
      "code" => $resultCreateUser->code,
      "message" => $resultCreateUser->message,
      "description" => $resultCreateUser->description,
    ]);
  }
} else {
  echo json_encode([
    "code" => 500,
    "message" => 'Erro na solicitação como servidor',
    "description" => 'Não foi possivel fazer a requisição com o servidor',
  ]);
}






/**Função para fazer a requisição com a api */
function requestApi($method, $url, $data = [], $userJwt = '')
{
  try {
    $body = json_encode($data);
    // $header = "Content-Type: application/json\r\n" . "Content-Length: " . strlen($body) . "\r\nAuthorization: Bearer " . $userJwt;
    $header = "Content-Type: application/json\r\n" . "Content-Length: " . strlen($body);
    $header .= $userJwt != '' ?  "\r\nAuthorization: Bearer " . $userJwt : '';

    $opts = array(
      'http' => array(
        'header' => $header,
        'method' => $method,
        'content' => $body,
        'timeout' => 60
      ),
      "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
      ),
    );

    $context  = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);

    return json_decode($result);
  } catch (Throwable $th) {
    return json_encode(array("code" => 500, "message" => $th->getMessage()));
  }
}
