<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        $id = (isset($_GET['id']) ? $_GET['id'] : null);
        $model->viewCat($id);
        break;
    
    default:
        # code...
        break;
}