<?php
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'GET':
        $variable = (isset($_GET['metod']) ? $_GET['metod'] : null);
        switch ($variable) {
            case 'show':
                $value = (isset($_GET['id']) ? $_GET['id'] : null);
                $resp = $model->listarP($value);
                echo $resp;
                break;
            case 'viewUnique':
                $value = (isset($_GET['id']) ? $_GET['id'] : null);
                $resp = $model->traerProductoUnicoWebSer($value);
                echo $resp;
                break;
            default:
                # code...
                break;
        }

        break;

    default:
        # code...
        break;
}
