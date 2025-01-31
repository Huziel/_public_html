<?php
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        # code...
        break;

    default:
        $id = (isset($_GET['usuario']) ? $_GET['usuario'] : null);
        $serial = (isset($_GET['tienda']) ? $_GET['tienda'] : null);
        $resp = $model->trearCarrito($id, $serial);
        echo $resp;
        break;
}
