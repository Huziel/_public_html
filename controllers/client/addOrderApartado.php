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
        $desc = (isset($_POST['desc']) ? $_POST['desc'] : null);
        $order = (isset($_POST['order']) ? $_POST['order'] : null);
        echo $model->addOrderApartado($order, $desc);
        break;

    default:
        # code...
        break;
}
