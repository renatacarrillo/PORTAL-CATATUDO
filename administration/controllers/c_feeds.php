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

  case 'listFeeds': /* listar todos as coletas */
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/feeds/?limit=20&page=" . $page;


    /**Chamando a função */
    $feeds = Myfunctions::requestApi('GET', $url, $data = [], $jwt);

    if (isset($feeds) && $feeds != null) {
      $html = '';
      // $totalPages = round($collections->total_results / $collections->limit);
      foreach ($feeds as $key => $feed) {
        $CreateDate =  strftime('%d de %B de %Y', strtotime($feed->createdDate));

        $html .= '<div class="card" border-success">' .
          '<div class="card-header bg-transparent">' .  $feed->tag . '</div>' .
          '<img class="card-img-top" src="' . $feed->image . '" alt="Imagem de capa do card"><div class="card-body">' .
          '<h5 class="card-title">' . $feed->title . '</h5>' .
          '<p class="card-text">' . $feed->subtitle . '</p>' .
          '<p class="card-text"><small class="text-muted">Criado em: ' . $CreateDate . '</small></p>' .
          '</div><div class="card-footer">' .
          '<a href="feed.php?action=editFeed&feedId=' . $feed->_id . '" class="btn btn-dark">Editar</a>' .
          '</div></div>';
      }

      echo json_encode([
        "code" => 200,
        "html" =>  $html,
      ]);
    } else {
      echo json_encode([
        "code" => 404,
        "message" => 'Dados não localizados',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;
  case 'addNewFeed':
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
    $source = filter_input(INPUT_POST, 'source', FILTER_SANITIZE_STRING);
    $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
    $tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);
    $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/feeds";

    $feedData = array(
      "title" => $title, "subtitle" => $subtitle, "body" => $body, "source" => $source,
      "image" => $image, "link" => $link, "tag" => $tag, "active" => $active
    );

    $feeds = Myfunctions::requestApi('POST', $url,  $feedData, $jwt);

    if (isset($feeds->code)) {
      echo json_encode([
        "code" => $feeds->code,
        "message" => $feeds->message,
        "description" => $feeds->description,
      ]);
    } else {
      echo json_encode([
        "code" => 500,
        "message" => 'Erro na solicitação como servidor',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;

  case 'editFeed':
    $feedId = filter_input(INPUT_POST, 'feedId', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $subtitle = filter_input(INPUT_POST, 'subtitle', FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
    $source = filter_input(INPUT_POST, 'source', FILTER_SANITIZE_STRING);
    $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING);
    $link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING);
    $tag = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);
    $active = filter_input(INPUT_POST, 'active', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/feeds/$feedId";

    $feedData = array(
      "title" => $title, "subtitle" => $subtitle, "body" => $body, "source" => $source,
      "image" => $image, "link" => $link, "tag" => $tag, "active" => $active
    );


    $editFeed = Myfunctions::requestApi('PUT', $url,  $feedData, $jwt);

    if (isset($editFeed->updatedDate)) {
      echo json_encode([
        "code" => 201,
        "message" => 'Feed Atualizado com Sucesso',
        "description" => 'As informações do Feed foram atualizadas com sucesso!',
      ]);
    } else {
      echo json_encode([
        "code" => 500,
        "message" => 'Erro na solicitação como servidor',
        "description" => 'Ocorreu um erro para salvar as alterações do Feed',
      ]);
    }

    break;
  case 'deleteFeed':
    $feedId = filter_input(INPUT_POST, 'feedId', FILTER_SANITIZE_STRING);
    $url = CATATUDO_API . "/feeds/$feedId";
    $Data = [];

    /**Chamando a função */
    $resultDeleteFeed = Myfunctions::requestApi('DELETE', $url,  $Data, $jwt);

    if (isset($resultDeleteFeed->code)) {
      echo json_encode([
        "code" => $resultDeleteFeed->code,
        "message" => $resultDeleteFeed->message,
        "description" => $resultDeleteFeed->description,
      ]);
    } else {
      echo json_encode([
        "code" => 500,
        "message" => 'Erro na solicitação como servidor',
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
// "_id": "5ef52dd21bb032062545adf6",
// "createdDate": "2020-06-25T23:05:54.843Z",
// "title": "Poluição das praias e mares: o lixo plástico",
// "subtitle": "Os plásticos nos mares são grandes ameaças para a biodiversidade, para os serviços ecossistêmicos e para a segurança e saúde alimentar humana.",
// "body": "Em 2015, um estudo realizado pela expedição “Race for Water Odyssey” percorrendo durante 300 dias a rota atlântica da França ao Rio de Janeiro determinou que cerca de 80% da poluição dos oceanos é composta por plásticos. Cerca de 10% de todo o plástico produzido por ano vai parar nos oceanos através do descarte irregular desses resíduos e do despejo de esgotos sem tratamento diretamente no mar.\n De todo o lixo que chega ao mar 80% é proveniente de fontes terrestres nos continentes e 20% proveniente de atividades de embarcações de pesca e cruzeiros. O Brasil ocupa a triste posição de 16º lugar no ranking dos países mais poluidores dos mares. China, Indonésia e Filipinas são os países que mais jogam lixo nos oceanos.",
// "source": "http://sustentahabilidade.com",
// "image": "https://g1.globo.com/VCnoG1/foto/0,,15938931,00.jpg",
// "link": "http://sustentahabilidade.com/poluicao-das-praias-e-mares-o-lixo-plastico/",
// "updatedDate": "2020-03-25T23:50:56.537Z",
// "tag": "Noticias"
// },