<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];

switch ($requestMethod) {
    case 'POST':
        session_start();
        $idDel = $_SESSION['id'];


        if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadsDirectory = '../../controllers/delivery/uploads/';  // Directorio de destino
            
            $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $uniqueName = uniqid() . '_' . time() . '.' . $fileExtension;
            $uploadPath = $uploadsDirectory . $uniqueName;
            // Mueve el archivo al directorio de destino
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
                echo $uniqueName;  // Devuelve el nombre único del archivo cargado

                $model->uploadPicturePorfile($idDel, $uniqueName);
            } else {
                echo 'Error al mover el archivo.';
            }
        } else {
            echo 'Error en la carga del archivo.';
        }



        
        break;

    default:
        # code...
        break;
}
