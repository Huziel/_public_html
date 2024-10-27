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
        $idUser = (isset($_POST['idUser']) ? $_POST['idUser'] : null);
        $calificacion = (isset($_POST['calificacion']) ? $_POST['calificacion'] : null);
        $comentario = (isset($_POST['comentario']) ? $_POST['comentario'] : null);
        echo $model->guardarcomentariosTienda($data = [
            "idTieda" => "$idTieda",
            "idUser" => "$idUser",
            "calificacion" => "$calificacion",
            "comentario" => "$comentario",
        ]);
        break;

    default:
        # code...
        break;
}
