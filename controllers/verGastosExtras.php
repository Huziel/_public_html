<?php

require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $orderP = (isset($_POST['order']) ? $_POST['order'] : null);

       echo $model->verGastosExtras($orderP);
        break;

    default:
        # code...
        break;
}
