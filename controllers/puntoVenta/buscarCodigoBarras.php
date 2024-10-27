<?php
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        session_start();

        $barcodePV = (isset($_POST['barcodePV']) ? $_POST['barcodePV'] : null);
        echo  $resp = $model->searchBarcode($barcodePV, $_SESSION['nombre']);
        break;
    default:
        # code...
        break;
}
