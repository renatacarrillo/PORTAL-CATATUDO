<?php

/** remover os warnings do frontend */
error_reporting(0);

session_start();

if (!defined('CATATUDO_API')) {
  include_once '../../config.php';
}

require_once 'c_functions.php';


// $jwt = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiI1ZjU1NTQxNWI5MWFjZjAwMTczOThkMmMiLCJuYW1lIjoiVGhhaXMgZGEgU2lsdmEgZSBTYW50b3MiLCJlbWFpbCI6InRoYWlzQGZhdGVjLmNvbSIsImlhdCI6MTYwMDcwMTgyMywiZXhwIjoxNjAxNzM4NjIzfQ.bjH085Vo-by4OOUZrLfNjYqIxBXo4oeJVgmfkoxqSyE";
/**Pegar o jwt salvo na sesssion */
$jwt = $_SESSION['admin']['jwt'];

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

switch ($action) {

  case 'listCollections': /* listar todos as coletas */
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);
    $limit = filter_input(INPUT_POST, 'limit', FILTER_SANITIZE_STRING);


    if ($status != null) {
      $url = CATATUDO_API . "/collections/?page=" . $page . "&status=" . $status;
    } else {
      $url = CATATUDO_API . "/collections/?page=" . $page . "&limit=" . $limit;
    }

    /**Chamando a função */
    $collections = Myfunctions::requestApi('GET', $url, $data = [], $jwt);

    if (isset($collections->results) && $collections->results != null) {
      $table = '';
      $totalPages = round($collections->total_results / $collections->limit, 0, PHP_ROUND_HALF_UP);
      foreach ($collections->results as $key => $collect) {

        switch ($collect->status->code) {
          case 1:
            $badge = 'badge-secondary';
            break;
          case 2:
            $badge = 'badge-warning';
            break;
          case 3:
            $badge = 'badge-success';
            break;
          default:
            $badge = 'badge-primary';
            break;
        }

        $collectorId = isset($collect->collectorId) ? $collect->collectorId : 'N/A';
        $aceptedDate = isset($collect->aceptedDate) ? date("d-m-Y", strtotime($collect->aceptedDate)) : 'N/A';
        $collectedDate = isset($collect->collectedDate) ? date("d-m-Y", strtotime($collect->collectedDate)) : 'N/A';

        $table .= '<tr><th scope="row">' . substr($collect->_id, 0, 4) . "..." . substr($collect->_id, -5)  . '</th>' .
          '<td>' . $collect->collectType . '</td>' .
          '<td>' . date("d-m-Y", strtotime($collect->collectDate)) . '</td>' .
          '<td>' . date("d-m-Y", strtotime($collect->createdDate)) . '</td>' .
          '<td>' . $collect->status->description . '</td>' .
          '<td> <button class="btn  btn-dark btn-sm" type="button" data-toggle="collapse" data-target="#collapseDetails' . $key . '" aria-expanded="false" aria-controls="collapseExample">Visualizar</button></td></tr>' .
          '<tr class="collapse" id="collapseDetails' . $key . '"><td colspan="6"><div class="card"><div class="card-body"><h5 class="card-title d-flex justify-content-between align-items-center">Detalhes da coleta
          <span class="badge ' . $badge . ' badge-pill">' .  $collect->status->description . '</span>
          </h5><div class="row"><div class="col-sm-6"><ul class="list-details">' .
          '<li><small>Tipo da coleta:</small>' . $collect->collectType . '</li>' .
          '<li><small>Data da coleta:</small>' . date("d-m-Y", strtotime($collect->collectDate)) . '</li>' .
          '<li><small>Periodo da coleta:</small>' . $collect->collectTime . '</li>' .
          '<li><small>Data da abertura:</small>' . date("d-m-Y", strtotime($collect->createdDate)) . '</li>' .
          '<li><small>Data da aceitação:</small>' . $aceptedDate . '</li>' .
          '<li><small>Data da finalização: </small>' . $collectedDate . '</li>' .
          '<li><small>Id do Coletor: </small>' . $collectorId . '</li>' .
          '</ul></div><div class="col-sm-6"><ul class="list-details">' .
          '<li><small>Id do Gerador:</small>' . $collect->generatorId . '</li>' .
          '<li><small>Cidade:</small>' . $collect->address->city . '</li>' .
          '<li><small>Rua:</small>' . $collect->address->street . '</li>' .
          '<li><small>Numero:</small>' . $collect->address->number . '</li>' .
          '<li><small>Bairro:</small>' . $collect->address->neighborhood . '</li>' .
          '<li><small>Cep:</small>' . $collect->address->zipCode . '</li></ul></div></div>';

        if ($collect->status->code != 3) {
          $table
            .= '<div class="text-right"><a href="#" class="btn btn-sm btn-danger" data-id="' . $collect->_id . '">Cancelar</a></div>';
        }
        $table .= '</div></div></td></tr>';
      }

      echo json_encode([
        "code" => 200,
        "message" => 'Requisição realizada com sucesso',
        "table" =>  $table,
        "page" => $collections->page,
        "count" => $collections->count,
        "totalPages" => $totalPages,
      ]);
    } else {
      echo json_encode([
        "code" => 404,
        "message" => 'Dados não localizados',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;

  case 'detailsCollect': /* listar uma coleta especifica*/
    $collectId = filter_input(INPUT_POST, 'collectId', FILTER_SANITIZE_STRING);
    $url = CATATUDO_API . "/collections/$collectId";

    $collect = Myfunctions::requestApi('GET', $url, $data = [], $jwt);

    if ($collect != null) {
?>
      <h5>Informações da coleta</h5>
      <p><?= $collect->collectDate ?> </p>

<?php
    } else {
      echo json_encode([
        "code" => 404,
        "message" => 'Dados não localizados',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;

  default:
    echo json_encode([
      "code" => 500,
      "message" => 'Opção selecionada invalida',
      "description" => 'Não foi possivel fazer a requisição com o servidor',
    ]);
    break;
}


// {
//     "_id": "5f5ec1df22aab012f807e2ed",
//     "generatorId": "5f555415b91acf0017398d2c",
//     "collectDate": "2020-10-03T12:00:00.000Z",
//     "collectTime": "Tarde",
//     "createdDate": "2020-09-14T01:05:35.787Z",
//     "address": {
//         "street": "Rua do Rau",
//         "number": "123",
//         "complement": "Perto daqui",
//         "city": "mairinque",
//         "state": "SP",
//         "neighborhood": "Centro 2",
//         "zipCode": "18130430"
//     },
//     "collectType": "Eletronicos",
//     "collectWeight": 0,
//     "status": {
//         "code": 3,
//         "description": "Coleta realizada"
//     },
//     "aceptedDate": "2020-09-17T01:29:33.400Z",
//     "collectorId": "5f555415b91acf0017398d2c",
//     "collectedDate": "2020-09-19T21:18:36.608Z"
// },
