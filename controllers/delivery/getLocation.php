<?php
header('Connection: Keep-Alive');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once('../../class/app.php');

$model = new app;
$requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);

switch ($requestMethod) {
    case 'POST':

        $latitud = (isset($_POST['latitud']) ? $_POST['latitud'] : null);
        $longitud = (isset($_POST['longitud']) ? $_POST['longitud'] : null);
        $iduser = (isset($_POST['iduser']) ? $_POST['iduser'] : null);
        $permisoTiendUbi = (isset($_POST['permisoTiendUbi']) ? $_POST['permisoTiendUbi'] : null);
        if ($latitud && $longitud) {
            if ($iduser == 0) {
                $iduser = null;
            }
            if ($iduser) {
                if ($permisoTiendUbi) {
                    $model->actualizarUbiExtra($iduser, $latitud, $longitud);
                }
               
                try {
                    $model->getLocale($latitud, $longitud, $iduser);
                    echo json_encode(array('success' => "success"));
                } catch (Exception $e) {
                    echo json_encode(array('error' => $e->getMessage()));
                }
            } else {
                echo json_encode(array('success' => "falta iniciar sesion"));
            }
        }


        // Cerrar la conexión
        header("Connection: close");
        exit();

        break;

    default:
        echo ("Api de localización");
        break;
}
