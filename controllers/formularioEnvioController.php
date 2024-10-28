<?php
require_once('../class/app.php');
require_once('../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        // Validar y sanitizar los datos recibidos
        $nombre = isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre']), ENT_QUOTES, 'UTF-8') : null;
        $direccion = isset($_POST['direccion']) ? htmlspecialchars(trim($_POST['direccion']), ENT_QUOTES, 'UTF-8') : null;
        $ciudad = isset($_POST['ciudad']) ? htmlspecialchars(trim($_POST['ciudad']), ENT_QUOTES, 'UTF-8') : null;
        $pais = isset($_POST['pais']) ? htmlspecialchars(trim($_POST['pais']), ENT_QUOTES, 'UTF-8') : null;
        $codigoPostal = isset($_POST['codigoPostal']) ? filter_var(trim($_POST['codigoPostal']), FILTER_SANITIZE_STRING) : null;
        $tipoEnvio = isset($_POST['tipoEnvio']) ? htmlspecialchars(trim($_POST['tipoEnvio']), ENT_QUOTES, 'UTF-8') : null;

        $order = (isset($_POST['order']) ? $_POST['order'] : null);

        // Validar que no falten datos
        if (!$nombre || !$direccion || !$ciudad || !$pais || !$codigoPostal || !$tipoEnvio) {

            echo json_encode(['ok' => 'false', 'data' => 'Por favor completa todos los campos.']);
            exit;
        }
        echo $model->formularioEnvio($data = [
            "order" => $order,
            "nombre" => $nombre,
            "direccion" => $direccion,
            "ciudad" => $ciudad,
            "pais" => $pais,
            "codigoPostal" => $codigoPostal,
            "tipoEnvio" => $tipoEnvio,
        ]);
        break;

    default:
        # code...
        break;
}
