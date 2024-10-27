<?php

require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $idTieda = (isset($_POST['idTienda']) ? $_POST['idTienda'] : null);

        $model->traerDatosComentario($idTieda);
        break;

    default:
        # code...
        break;
}
