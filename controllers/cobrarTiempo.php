<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        session_start();
        $idStore = $_SESSION['id'];
        $costEnvi = 50;
        $wallet = $model->getMoney($idStore);
        if ($wallet >= $costEnvi) {
            $model->susMoney($idStore, $costEnvi);
            $model->agregarTiempo($idStore);
            $status = 'Tiempo agregado con éxito';
            $userData = array('data' => $status);
            echo json_encode($userData);
           
        } else {
            $status = 'No cuentas con saldo suficiente';
            $userData = array('data' => $status);
            echo json_encode($userData);
        }

        break;

    default:
        # code...
        break;
}
