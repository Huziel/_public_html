<?php
require_once('../class/app.php');
require_once('../class/appVol2.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        session_start();

        $id = (isset($_SESSION['idp12312']) ? $_SESSION['idp12312'] : null);
        $idGet = (isset($_GET['id']) ? $_GET['id'] : null);
        if ($idGet) {
            $id = $idGet;
        }
        $model->changeStatusP($id);
        if ($idGet) {
            # code...
        } else {
            $model2 = new appvol2;
            $model2 -> actualizarMercadoPago($id);
            header('Location: https://rutadelaseda.xyz/app/themp/smarticket.php?order=' . $id);

        }

        break;

    default:
        # code...
        break;
}
