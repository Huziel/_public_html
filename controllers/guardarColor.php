<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':

        $idTienda = (isset($_POST['idTienda']) ? $_POST['idTienda'] : null);
        $primo = (isset($_POST['primo']) ? $_POST['primo'] : null);
        $secon = (isset($_POST['secon']) ? $_POST['secon'] : null);
        $lights = (isset($_POST['lights']) ? $_POST['lights'] : null);
        $darks = (isset($_POST['darks']) ? $_POST['darks'] : null);
        $cuccessI = (isset($_POST['cuccessI']) ? $_POST['cuccessI'] : null);
        $cant = $model->agregarColor($data = [
            "idTienda" => $idTienda,
            "primo" => "$primo",
            "secon" => "$secon",
            "lights" => "$lights",
            "darks" => "$darks",
            "cuccessI" => "$cuccessI"
        ]);
        echo $cant;
        break;

    default:
        # code...
        break;
}
