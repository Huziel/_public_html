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
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $type = (isset($_POST['type']) ? $_POST['type'] : null);
        if ($type == 1) {
            $resp = $model->bloquearDeliver($id);
        } else {
            $resp = $model->desbloquearDeliver($id);
        }

        echo $resp;
        break;
    default:
        # code...
        break;
}
