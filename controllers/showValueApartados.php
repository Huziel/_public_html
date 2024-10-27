<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once('../class/app.php');

$model = new app;
$requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);

switch ($requestMethod) {
    case 'POST':
        session_start();
        $idTienda = (isset($_POST['idTienda']) ? $_POST['idTienda'] : null);

        try {
            $dato =  $model->showApartadosValue($idTienda);
            echo json_encode(array('dato' => $dato));
        } catch (Exception $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
        break;

        // Puedes agregar más casos según sea necesario

    default:
        // Código por defecto, si no se cumple ningún caso
        break;
}
