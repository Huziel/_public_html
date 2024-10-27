<?php
require_once('../../class/app.php');
require_once('../../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':

        $order = (isset($_POST['order']) ? $_POST['order'] : null);
        echo  $resp = $model->printTiket($order);

        break;

    default:
        # code...
        break;
}
