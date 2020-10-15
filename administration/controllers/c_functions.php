<?php
class Myfunctions
{


  public static function requestApi($method, $url, $data = [], $userJwt = '')
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

  public static function alterUser($method, $url, $data = [], $userJwt = '')
  {
    define('MULTIPART_BOUNDARY', '--------------------------' . microtime(true));
    try {
      $body = $data;
      $header = 'Content-Type: multipart/form-data; boundary=' . MULTIPART_BOUNDARY;
      $header .= $userJwt != '' ?  "\r\nAuthorization: Bearer " . $userJwt : '';
      $content = '';

      // equivalent to <input type="file" name="uploaded_file"/>
      // define('FORM_FIELD', 'uploaded_file');
      // $file_contents = file_get_contents($filename);
      // $content =  "--" . MULTIPART_BOUNDARY . "\r\n" .
      //   "Content-Disposition: form-data; name=\"image\"; filename=\"" . basename($filename) . "\"\r\n" .
      //   "Content-Type: image/jpeg\r\n\r\n" .
      //   $file_contents . "\r\n";

      // add some POST fields to the request too: $_POST['foo'] = 'bar'
      foreach ($body as $key => $value) {
        $content .= "--" . MULTIPART_BOUNDARY . "\r\n" .
          "Content-Disposition: form-data; name=\"$key\"\r\n\r\n" .
          "$value\r\n";
      }

      // signal end of request (note the trailing "--")
      $content .= "--" . MULTIPART_BOUNDARY . "--\r\n";

      $opts = array(
        'http' => array(
          'header' => $header,
          'method' => $method,
          'content' => $content,
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

  /**Função para decodificar o jwt retornado */
  public static function decodeJwt($jwt)
  {

    $token = explode('.', $jwt);
    $header = $token[0];
    $payload = $token[1];
    $sign = $token[2];
    $payload = json_decode(base64_decode($payload), true);

    return ($payload);
  }
}
