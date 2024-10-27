<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../../class/validateLog.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$a = new validateLog();
switch ($requestMethod) {
    case 'GET':
        $userData['data'][] = array('id' => 'Servicio creado por Tlaokoyalistli Teotl');
        echo json_encode($userData);
        break;

    case 'POST':
        postLogin($a);

        break;
}
function postLogin($a)
{
    $data = json_decode(file_get_contents("php://input"));

    if (empty($data->correo) || empty($data->pass)) {
        $userData = array('ok' => 'false', 'id' => 'Datos vacios');
        echo json_encode($userData);
    } else {
        $a->login($data = [
            "username" => "$data->correo",
            "pass" => "$data->pass"
        ]);
    }
}
