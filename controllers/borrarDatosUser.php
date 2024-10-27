<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $id = (isset($_POST['id']) ? $_POST['id'] : null);

        echo $model->borrarCuentaParaSiempre($id);
        break;

    default:
        # code...
        break;
}
