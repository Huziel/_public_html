<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        if (($_FILES["file"]["type"] == "image/pjpeg")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/jpg")
            || ($_FILES["file"]["type"] == "image/png")
        ) {
            $rand = rand(1, 99);
            $fechaActual = date('d-m-Y');
            $nameArch = $rand . $fechaActual . $id . $_FILES['file']['name'];
            move_uploaded_file($_FILES["file"]["tmp_name"], "../app/themp/objets/images/" . $nameArch);
            $link = "https://" . $host . "/app/themp/objets/images/" . $nameArch;
            echo $model->agregarBnner($data = [
                "banner" => "$link",
                "idTienda" => "$id"
            ]);
        }
        break;

    default:
        # code...
        break;
}
