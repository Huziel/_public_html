<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':

        $idTienda = (isset($_POST['idTienda']) ? $_POST['idTienda'] : null);
        $nombreTienda = (isset($_POST['nombreTienda']) ? $_POST['nombreTienda'] : null);
        $texto1 = (isset($_POST['texto1']) ? $_POST['texto1'] : null);
        $texto2 = (isset($_POST['texto2']) ? $_POST['texto2'] : null);
        $facebook = (isset($_POST['facebook']) ? $_POST['facebook'] : null);
        $instagram = (isset($_POST['instagram']) ? $_POST['instagram'] : null);
        $youtube = (isset($_POST['youtube']) ? $_POST['youtube'] : null);
        $mercadoLibre = (isset($_POST['mercadoLibre']) ? $_POST['mercadoLibre'] : null);
        $transf1 = (isset($_POST['transf1']) ? $_POST['transf1'] : null);
        $transf2 = (isset($_POST['transf2']) ? $_POST['transf2'] : null);

        $namebancIn1 = (isset($_POST['namebancIn1']) ? $_POST['namebancIn1'] : null);
        $namePropie1 = (isset($_POST['namePropie1']) ? $_POST['namePropie1'] : null);
        $namebancIn2 = (isset($_POST['namebancIn2']) ? $_POST['namebancIn2'] : null);
        $namePropie2 = (isset($_POST['namePropie2']) ? $_POST['namePropie2'] : null);





        $resp = $model->agregardatosExtras($data = [
            "idTienda" => $idTienda,
            "nombreTienda" => $nombreTienda,
            "texto1" => $texto1,
            "texto2" => $texto2,
            "facebook" => $facebook,
            "instagram" => $instagram,
            "youtube" => $youtube,
            "mercadoLibre" => $mercadoLibre,
            "transf1" => $transf1,
            "transf2" => $transf2,
            "namebancIn1" => $namebancIn1,
            "namePropie1" => $namePropie1,
            "namebancIn2" => $namebancIn2,
            "namePropie2" => $namePropie2,

        ]);
        echo $resp;
        break;

    default:
        # code...
        break;
}
