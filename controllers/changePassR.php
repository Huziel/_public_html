<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $correo = (isset($_POST['correo']) ? $_POST['correo'] : null);
        $key = (isset($_POST['key']) ? $_POST['key'] : null);
        $pass = (isset($_POST['pass']) ? $_POST['pass'] : null);
        echo $model->cambiarContra($correo, $key, $pass);
        break;

    default:
        # code...
        break;
}
