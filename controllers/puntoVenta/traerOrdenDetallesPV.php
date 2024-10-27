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

        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        echo  $resp = $model->traerOrdenDetalleGuardado($id);

        break;

    default:
        # code...
        break;
}
