<?php

/** remover os warnings do frontend */
error_reporting(0);

if (!defined('CATATUDO_API')) {
  include_once '../../config.php';
}

$email = $_POST['email'];
$password = $_POST['password'];
$remember = $_POST['remember'];

// $email = "rcdomingos@fatec.com";
// $password = "123";
/**Chama a função para validar o usuario  */
$loginValite = getUserJwt($email, $password);

if (isset($loginValite->code)) {

  if ($loginValite->code == 201) {

    $respJwt = $loginValite->auth_token;

    $infoAdmin = decodeJwt($respJwt);

    if (isset($infoAdmin['isAdmin']) && $infoAdmin['isAdmin']) {
      session_start();
      $_SESSION['admin']['userId'] =  $infoAdmin['userId'];
      $_SESSION['admin']['name'] =  $infoAdmin['name'];
      $_SESSION['admin']['email'] =  $infoAdmin['email'];
      $_SESSION['admin']['jwt'] = $respJwt;

      // header("Location: index.php");
      echo json_encode([
        "code" => 200,
        "message" => 'acesso autorizado',
        "description" => 'acesso feito com sucesso',
      ]);
      exit;
    } else {
      echo json_encode([
        "code" => 404,
        "message" => 'Não autorizado, acesso autorizado apenas para usuários administradores',
        "description" => 'acesso autorizado apenas para usuários administradores do sistema',
      ]);
      exit;
    }
  } else {
    echo json_encode([
      "code" => $loginValite->code,
      "message" => $loginValite->message,
      "description" => $loginValite->description,
    ]);
  }
} else {
  echo json_encode([
    "code" => 500,
    "message" => 'Erro na solicitação com o servidor',
    "description" => 'Não foi possivel fazer a requisição com o servidor',
  ]);
}


function logado($sessao)
{
  if (!isset($_SESSION[$sessao]) || empty($_SESSION[$sessao])) {
    header("Location:login.php");
  } else {
    return true;
  }
}


/** FUNÇÕES  */
/**Função para decodificar o jwt retornado */
function decodeJwt($jwt)
{

  $token = explode('.', $jwt);
  $header = $token[0];
  $payload = $token[1];
  $sign = $token[2];
  $payload = json_decode(base64_decode($payload), true);

  return ($payload);
}

/**Função para gerar o jwt gerando no backend pela api */
function getUserJwt($email, $password)
{
  try {
    $body = json_encode(array("email" => $email, "password" => $password));
    $url = CATATUDO_API . "/users/create-auth";
    $opts = array(
      'http' => array(
        'header' => "Content-Type: application/json\r\nContent-Length: " . strlen($body) . "\r\n",
        'method' => 'POST',
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
