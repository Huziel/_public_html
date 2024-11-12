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

        $idStore = (isset($_POST['idStore']) ? $_POST['idStore'] : null);
        $costEnvi = (isset($_POST['costEnvi']) ? $_POST['costEnvi'] : null);
        if ($idStore == $_SESSION['id']) {
            echo "No te puedes pagar a ti mismo";
        } else {
            $model->susMoney($idStore, $costEnvi);
        }

        break;

    default:
        # code...
        break;
}
