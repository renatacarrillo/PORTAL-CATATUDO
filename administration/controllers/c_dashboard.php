
<?php
/** remover os warnings do frontend */
error_reporting(0);

session_start();

date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

if (!defined('CATATUDO_API')) {
  include_once '../../config.php';
}

require_once 'c_functions.php';

/**Pegar o jwt salvo na sesssion */
$jwt = $_SESSION['admin']['jwt'];

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
  case 'grafic':
    $title;
    $labels = [];
    $data = [];
    $days = [];
    // $url = CATATUDO_API . "/statistics/collections?initialDate=2020-10-1&finalDate=2020-10-05";
    $url = CATATUDO_API . "/statistics/collections";
    $dateToday = strtotime("now");
    $day =  strftime('%d',  $dateToday);
    $title =  "Coletas em " . strftime('%B de %Y',  $dateToday);


    /**Chamando a função */
    $collectionsStatistics = Myfunctions::requestApi('GET', $url, $data = [], $jwt);

    if (sizeof($collectionsStatistics)) {
      foreach ($collectionsStatistics as $key => $collectInfo) {
        $days[$collectInfo->day] = $collectInfo->total;
      }
    };

    /**preencher com 0 os dias que não tiveram coletas */
    for ($i = 1; $i <= $day; $i++) {
      if (array_key_exists($i, $days)) {
        $labels[] = $i;
        $data[] = $days[$i];
      } else {
        $labels[] = $i;
        $data[] = 0;
      }
    };

    echo json_encode([
      "code" => 200,
      "labels" => $labels,
      "data" => $data,
      "title" => $title,
    ]);
    break;

  case 'geral':

    $url = CATATUDO_API . "/statistics";
    $geralStatistics = Myfunctions::requestApi('GET', $url, $data = [], $jwt);

    if (isset($geralStatistics->users)) {
      echo json_encode(
        $geralStatistics
      );
    } else {
      echo json_encode([
        "code" => 500,
      ]);
    }

    break;
  default:
    echo "Opção invalida";
    break;
}
