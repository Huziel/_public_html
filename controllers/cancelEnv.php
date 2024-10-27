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
        $idDel = $_SESSION['id'];
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $costos = $model->getDtCostEnv($id);
        $nuevoCosto = $costos - 30;
        $devolver = $model->setMoneyDeliver($idDel, $nuevoCosto);
        $model->CancelEnv($id);
        $userData = array('ok' => 'Envio cancelado');
        echo json_encode($userData);
        break;

    default:
        # code...
        break;
}
