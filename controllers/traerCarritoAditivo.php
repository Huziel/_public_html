<?php
require_once('../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        $id = (isset($_GET['id']) ? $_GET['id'] : null);
        echo $model->traerCarritoAditivos($id);
        break;

    default:
        # code...
        break;
}
