<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];

switch ($requestMethod) {
    case 'POST':
        session_start();
        $data = json_decode(file_get_contents("php://input"));
        $id = $data->id;
        $model->generalPService($id);
        break;

    default:
    echo "servicio de notificación";
        break;
}
