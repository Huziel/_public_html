<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
require_once('../../class/app.php');
require_once('../../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':

        $idPVOrder = (isset($_POST['idPVOrder']) ? $_POST['idPVOrder'] : null);
        $arrayPV = (isset($_POST['arrayPV']) ? $_POST['arrayPV'] : null);
        /* print_r($arrayPV); */
        $tipopago = (isset($_POST['tipopago']) ? $_POST['tipopago'] : null);
        echo  $resp = $model->hacerPagoPV($data = [
            "id" => $idPVOrder,
            "arrayPV" => $arrayPV,
            "tipoPago" => $tipopago
        ]);

        break;

    default:
        # code...
        break;
}
