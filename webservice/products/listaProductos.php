<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
require_once("../../class/app.php");
switch ($requestMethod) {
    case 'GET':

        break;

    case 'POST':

        traerProductos();

        break;
}
function traerProductos()
{
    $model = new app;
    $data = json_decode(file_get_contents("php://input"));
    if (empty($data->dominio)) {
        $userData = array('ok' => 'false', 'id' => 'Datos vacios');
    } else {
        $model->listarP($data->dominio);
    }
}
