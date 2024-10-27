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
        $total = (isset($_POST['total']) ? $_POST['total'] : null);
        $extra = (isset($_POST['extra']) ? $_POST['extra'] : null);
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $array = (isset($_POST['array']) ? $_POST['array'] : null);
        $resp = $model->guardarOrderPv($data = [
            "total" => $total,
            "extra" => $extra,
            "id" => $id,


        ]);
        $arrayOb = array();
        foreach ($array as $item) {
            $resp2 = $model->guardarProductosDeOrden($data = [

                "id" => $id,
                "idProd" => $item[0],
                "cantidad" => $item[2],
                "nameProd" => $item[1],
                "precioBruto" => $item[3],
                "precioNeto" => $item[4],

            ]);
            $arrayOb[] = $resp2;
        }
        echo json_encode(array("info" => $resp, "data" => $arrayOb));
        break;

    default:
        # code...
        break;
}
