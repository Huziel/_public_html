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
        $deliveryMan = (isset($_POST['deliveryMan']) ? $_POST['deliveryMan'] : null);
        $store = (isset($_POST['store']) ? $_POST['store'] : null);
        $model->borrarAnexoTienda($deliveryMan, $store);
        break;

    default:
        # code...
        break;
}
