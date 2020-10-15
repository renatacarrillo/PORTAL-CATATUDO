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
  case 'pendingApproval':

    $url = CATATUDO_API . "/collectors/?status=1";
    $collectors = Myfunctions::requestApi('GET', $url, $data = [], $jwt);
    $table = '';

    if (isset($collectors->collectorsList)) {
      foreach ($collectors->collectorsList as $key => $collector) {
        $collectorVehicles = "<ul>";
        foreach ($collector->vehicle as $vehicle) {
          $collectorVehicles .= '<li>' . $vehicle . '</li>';
        }
        $collectorVehicles .= '</ul>';

        $collectorPlaces = "<ul>";
        foreach ($collector->collectionLocations as $place) {
          $collectorPlaces .= '<li class="pb-2"><small>cidade: </small> ' . $place->city . '</br><small>bairro:</small>' . implode(', ', $place->neighbourhood) . '</li>';
        }
        $collectorPlaces .= '</ul>';

        $createdDate = date("d-m-Y", strtotime($collector->createdDate));

        $table .= '<tr class="tbLine"><th scope="row">' . substr($collector->_id, 0, 4) . "..." . substr($collector->_id, -5)  . '</th>' .
          '<td>' . $collector->userName . '</td>' .
          '<td>' . $createdDate . '</td>' .
          '<td>' . $collector->status->description . '</td>' .
          '<td><div class="btn-group btn-group-sm" role="group">' .
          '<button id="btnRejeitar" type="button" class="btn btn-danger" data-id="' . $collector->userId . '"><i class="fas fa-times-circle"></i></button>' .
          '<button class="btn btn-dark" type="button" data-toggle="collapse" title="Visualizar" data-target="#collapseDetails' . $key . '" aria-expanded="false" aria-controls="collapseDetails"><i class="fas fa-eye"></i></button>' .
          '<button id="btnAprovar" type="button" class="btn  btn-success" data-id="' . $collector->userId . '"><i class="fas fa-check-circle"></i></button>' .
          '</div></td>' .
          '<tr class="collapse" id="collapseDetails' . $key . '"><td colspan="6"><div class="card"><div class="card-body"><h5 class="card-title d-flex justify-content-between align-items-center">Detalhes da Solicitação
          </h5><div class="row"><div class="col-sm-6"><ul class="list-details">' .
          '<li><small>Nome do Usuario:</small></br><span>' . $collector->userName . '</span></li>' .
          '<li><small>Nome da Empresa:</small></br><span>' . $collector->companyName . '</span></li>' .
          '<li><small>Data da abertura:</small></br><span>' . $createdDate . '</span></li>' .
          '<li><small>Veiculos para coleta:</small>' .  $collectorVehicles . '</li>' .
          '</ul></div><div class="col-sm-6"><ul class="list-details">' .
          '<li><small>Lugares para Coleta:</small>' .  $collectorPlaces . '</li>' .
          '</ul></div></div>';

        $table .= '</div></div></td></tr>';
      }
      echo json_encode([
        "code" => 200,
        "table" =>  $table,
      ]);
    } else {
      echo json_encode([
        "code" => 404,
        "message" => 'Dados não localizados',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;
  case 'approveRequest':
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $data = array("statusTo" => 2);

    $url = CATATUDO_API . "/collectors/$userId/status";
    $resultApprove = Myfunctions::requestApi('PUT', $url, $data, $jwt);

    if (isset($resultApprove->status) && $resultApprove->status->code == 2) {
      echo json_encode([
        "code" => 200,
      ]);
    } else {
      echo json_encode([
        "code" => 500,
      ]);
    }
    break;
  case 'rejectRequest':
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $data = array("statusTo" => 3);

    $url = CATATUDO_API . "/collectors/$userId/status";
    $resultApprove = Myfunctions::requestApi('PUT', $url, $data, $jwt);

    if (isset($resultApprove->status) && $resultApprove->status->code == 3) {
      echo json_encode([
        "code" => 200,
      ]);
    } else {
      echo json_encode([
        "code" => 500,
      ]);
    }
    break;

  default:
    break;
}

// {
//             "_id": "5f7f70a3bfd37aac0551fbf7",
//             "userId": "5f7f73f53bab4e0ff063a763",
//             "collectionLocations": [
//                 {
//                     "city": "Aluminio",
//                     "neighbourhood": [
//                         "Centro",
//                         "Marmeleiro"
//                     ]
//                 },
//                 {
//                     "city": "Mairinque",
//                     "neighbourhood": [
//                         "Centro",
//                         "Sorocabana"
//                     ]
//                 }
//             ],
//             "createdDate": "2020-10-08T20:19:35.059Z",
//             "status": {
//                 "code": 1,
//                 "description": "Aguardando Aprovação"
//             },
//             "vehicle": [
//                 "Caminhão"
//             ],
//             "Links": [
//                 {
//                     "url": "http://192.168.1.13:3001/api/v1/users/5f7f73f53bab4e0ff063a763",
//                     "Method": "GET",
//                     "Type": "Details"
//                 },
//                 {
//                     "url": "http://192.168.1.13:3001/api/v1/collectors/5f7f73f53bab4e0ff063a763/status",
//                     "Method": "PUT",
//                     "Type": "Action"
//                 }
//             ]
//         } 