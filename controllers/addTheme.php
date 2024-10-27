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
        $idTienda = (isset($_POST['idTienda']) ? $_POST['idTienda'] : null);
        $theme = (isset($_POST['theme']) ? $_POST['theme'] : null);
        $resp = $model->addTheme($idTienda, $theme);
        echo $resp;
        break;

    default:
        # code...
        break;
}
