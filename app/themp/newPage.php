<?php
require_once('../../class/app.php');
require_once('../../class/templatesStore.php');
$model = new templatesStore;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        session_start();

        $id = (isset($_GET['id']) ? $_GET['id'] : null);
        echo  $resp = $model->traerPagina($id);
        break;
    default:
        # code...
        break;
}
