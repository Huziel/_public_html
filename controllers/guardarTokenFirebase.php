<?php

require_once('../class/app.php');
require_once('../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        session_start();

        $token = (isset($_SESSION['token']) ? $_SESSION['token'] : null);
        $idP = (isset($_SESSION['id']) ? $_SESSION['id'] : null);
        if ($token && $idP) {
            echo $model->asociarDispositivo($data = [
                "token" => $token,
                "idP" => $idP,
            ]);
        } else {
            $token2 = (isset($_POST['token']) ? $_POST['token'] : null);
            $_SESSION['token'] = $token2;
        }



        break;

    default:
        # code...
        break;
}
