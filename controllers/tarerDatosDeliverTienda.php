<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        session_start();
        $created = (isset($_POST['created']) ? $_POST['created'] : null);
        $resp = $model->traerDatosDeliverParaTienda($created);
        echo $resp;
        break;
    default:
        # code...
        break;
}
