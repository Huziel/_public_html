<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        $data = (isset($_GET['data']) ? $_GET['data'] : null);
        $model->predecirCat($data);
        break;
    
    default:
        # code...
        break;
}