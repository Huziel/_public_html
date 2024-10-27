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

        $creator = (isset($_POST['creator']) ? $_POST['creator'] : null);
        echo  $resp = $model->traerHistoricoPv($creator);

        break;

    default:
        # code...
        break;
}
