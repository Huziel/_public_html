<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':

        $orderP = (isset($_POST['orderP']) ? $_POST['orderP'] : null);
        $precio = (isset($_POST['precio']) ? $_POST['precio'] : null);
        $cargo = (isset($_POST['cargo']) ? $_POST['cargo'] : null);

        $cant = $model->gastosExtras($data = [
            "orderP" => $orderP,
            "precio" => $precio,
            "cargo" => $cargo,
        ]);
        echo $cant;
        break;

    default:
        # code...
        break;
}
