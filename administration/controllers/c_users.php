<?php

/** remover os warnings do frontend */
error_reporting(0);

session_start();

if (!defined('CATATUDO_API')) {
  include_once '../../config.php';
}

require_once 'c_functions.php';

/**Pegar o jwt salvo na sesssion */
$jwt = $_SESSION['admin']['jwt'];

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);


switch ($action) {

  case 'listUsers': /* listar todos os usuarios */
    $profile = filter_input(INPUT_POST, 'profile', FILTER_SANITIZE_STRING);
    $page = filter_input(INPUT_POST, 'page', FILTER_SANITIZE_STRING);

    if ($profile != null) {
      $url = CATATUDO_API . "/users?profile=" . $profile;
    } else {
      $url = CATATUDO_API . "/users?page=$page";
    }
    /**Chamando a função */
    $users = Myfunctions::requestApi('GET', $url);

    if (isset($users->results) && $users->results != null) {
      $totalPages = round($users->total_results / $users->limit);
      $html = '';
      foreach ($users->results as $key => $user) {
        $userProfile = $user->isAdmin ? 'Admin' : ($user->isCollector ? 'Coletor' : 'Gerador');

        $html .= "<tr><td>" . substr($user->_id, 0, 4) . "..." . substr($user->_id, -5) . "</td>"
          . "<td>$user->name</td>"
          . "<td>$user->email</td>"
          . "<td>$userProfile</td>"
          . "<td>" . date("d-m-Y", strtotime($user->createdDate)) . "</td>"
          . "<td><a class='btn btn-dark btn-sm' href='../administration/user.php?userID=$user->_id' role='button'><i class='fas fa-eye'></i> Visualizar</a></td></tr>";
      }

      echo json_encode([
        "code" => 200,
        "html" =>  $html,
        "page" => $users->page,
        "count" => $users->count,
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


  case 'addNewUser': /* cadastrar um novo usuario */
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/users";
    $userData = array("name" => $name, "email" => $email, "password" => $password, "phone" => $phone);

    /**Chamando a função */
    $resultCreateUser = Myfunctions::requestApi('POST', $url,  $userData);

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
    break;
  case 'alterAddress': /*Alterar o endereço */
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $codAddress = filter_input(INPUT_POST, 'codAddress', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
    $complement = filter_input(INPUT_POST, 'complement', FILTER_SANITIZE_STRING);
    $neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/users/$userId/address/$codAddress";

    $userData = array(
      "street" => $street, "number" => $number, "complement" =>  $complement, "neighborhood" => $neighborhood,
      "city" => $city, "state" => $state, "zipCode" => $zipCode
    );

    /**Chamando a função */
    $resultAlterAddress = Myfunctions::requestApi('PUT', $url,  $userData, $jwt);

    if (isset($resultAlterAddress->codAddress)) {
      echo json_encode(["code" => 201]);
    } else {
      echo json_encode([
        "code" => 500,
        "message" => 'Erro na solicitação como servidor',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }

    break;
  case 'deleteAddress':
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $codAddress = filter_input(INPUT_POST, 'codAddress', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/users/$userId/address/$codAddress";
    $userData = [];

    /**Chamando a função */
    $resultDeleteAddress = Myfunctions::requestApi('DELETE', $url,  $userData, $jwt);

    if ($resultDeleteAddress == null) {
      echo json_encode(["code" => 204]);
    } else {
      echo json_encode([
        "code" => 500,
        "message" => 'Erro na solicitação como servidor',
        "description" => 'Não foi possivel fazer a requisição com o servidor',
      ]);
    }
    break;
  case 'addNewAddress':

    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);

    $codAddress = filter_input(INPUT_POST, 'codAddress', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING);
    $complement = filter_input(INPUT_POST, 'complement', FILTER_SANITIZE_STRING);
    $neighborhood = filter_input(INPUT_POST, 'neighborhood', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
    $zipCode = filter_input(INPUT_POST, 'zipCode', FILTER_SANITIZE_STRING);


    $url = CATATUDO_API . "/users/$userId/address";

    $userData = array(
      "street" => $street, "number" => $number, "complement" =>  $complement, "neighborhood" => $neighborhood,
      "city" => $city, "state" => $state, "zipCode" => $zipCode
    );

    $resultAddNewAddress = Myfunctions::requestApi('POST', $url,  $userData, $jwt);

    if (isset($resultAddNewAddress->codAddress)) {
      $address = $resultAddNewAddress;
?>
      <form class="w-75 p-3 rounded bg-light mb-3" name="form-address">
        <div class="address">
          <div class="form-row">
            <div class="col-md-9 mb-3">
              <label for="street">Rua</label>
              <input type="text" class="form-control" name="street" readonly value="<?= $address->street ?>">
            </div>
            <div class="col-md-3 mb-3">
              <label for="number">Numero</label>
              <input type="text" class="form-control" name="number" readonly value="<?= $address->number ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="complement">Complemento</label>
              <input type="text" class="form-control" name="complement" readonly value="<?= $address->complement ?>">
            </div>
            <div class="col-md-6 mb-3">
              <label for="neighborhood">Bairro</label>
              <input type="text" class="form-control" name="neighborhood" readonly value="<?= $address->neighborhood ?>">
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="city">Cidade</label>
              <input type="text" class="form-control" name="city" readonly value="<?= $address->city ?>">
            </div>
            <div class=" col-md-3 mb-3">
              <label for="state">Estado</label>
              <input type="text" class="form-control" name="state" readonly value="<?= $address->state ?>">
            </div>
            <div class="col-md-3 mb-3">
              <label for="zipCode">CEP</label>
              <input type="text" class="form-control" name="zipCode" readonly value="<?= $address->zipCode ?>">
            </div>
          </div>
          <input type="hidden" class="form-control" name="codAddress" readonly value="<?= $address->codAddress ?>">
          <input type="hidden" class="form-control" name="userId" readonly value="<?= $userId ?>">
        </div>
        <div class="row pt-3">
          <div class="text-left col-6">
            <span class="btn-sec text-left" style="display: none;">
              <button id=" saveAddress" type="submit" class="text-right btn btn-sm btn-success">Salvar</button>
              <button id="cancel" type="reset" class="text-right btn btn-sm btn-secondary">Cancelar</button>
            </span>
          </div>
          <div class="text-right col-6">
            <span class="text-right btn-pri">
              <button id=" editAddress" type="submit" class="text-right btn btn-sm btn-warning">Editar</button>
              <button id="deleteAddress" type="delete" class="text-right btn btn-sm btn-danger">Excluir</button>
            </span>
          </div>
        </div>
      </form>
<?php

    } else {
      echo false;
    }
    break;


  case 'alterUser':
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $isCollector = filter_input(INPUT_POST, 'isCollector', FILTER_SANITIZE_STRING);
    $isAdmin = filter_input(INPUT_POST, 'isAdmin', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/users/$userId";
    $userData = array("name" => $name, "email" => $email, "isCollector" => $isCollector, "phone" => $phone,  "isAdmin" => $isAdmin);


    // var_dump($userData);

    // https://www.cloudways.com/blog/the-basics-of-file-upload-in-php/
    // $valid_extensions = array('jpeg', 'jpg', 'png');
    // $img = $_FILES["image"]["name"]; /*stores the original filename from the client*/
    // $tmp = $_FILES["image"]["tmp_name"];/*stores the name of the designated temporary file*/
    // $errorimg = $_FILES["image"]["error"]; /*stores any error code resulting from the transfer*/


    // if (!empty($_POST['name']) || !empty($_POST['email']) || $_FILES['image']) {
    //   $img = $_FILES['image']['name'];
    //   $tmp = $_FILES['image']['tmp_name'];
    //   // get uploaded file's extension
    //   $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // }
    // // check's valid format
    // if (in_array($ext, $valid_extensions)) {
    //   $path = $path . strtolower($final_image);
    //   if (move_uploaded_file($tmp, $path)) {
    //     echo "<img src='$path' />";
    //     $name = $_POST['name'];
    //     $email = $_POST['email'];
    //     //include database configuration file

    //     //insert form data in the database
    //   }
    // } else {
    //   echo 'invalid';
    // }


    $resultAlterUser = Myfunctions::alterUser('PUT', $url, $userData, $jwt);

    if (isset($resultAlterUser->_id)) {
      echo json_encode([
        "code" => 201
      ]);
    } else {
      echo json_encode([
        "code" => 500
      ]);
    }
    break;

  case 'alterPassword':
    $userId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $url = CATATUDO_API . "/users/$userId";
    $userData = array("password" => $password);

    $resultAlterPass = Myfunctions::alterUser('PUT', $url, $userData, $jwt);

    if (isset($resultAlterPass->_id)) {
      echo 201;
    } else {
      echo 500;
    }
    break;


  default:
    echo json_encode([
      "code" => 404,
      "message" => 'Requisição informada invalida',
      "description" => 'A opção informada no action não existe',
    ]);
    break;
}
