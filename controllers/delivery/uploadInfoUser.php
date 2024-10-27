<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('../../class/app.php');

function handleFileUpload($fieldName, &$uniqueName, &$errorMessage)
{
    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
        $uploadsDirectory = '../../controllers/delivery/uploads/';
        $fileExtension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
        $uniqueName = uniqid() . '_' . time() . '.' . $fileExtension;
        $uploadPath = $uploadsDirectory . $uniqueName;

        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadPath)) {
            return true;
        } else {
            $errorMessage = "Error al mover el archivo $fieldName.";
        }
    } else {
        $errorMessage = "Error al cargar el archivo $fieldName.";
    }

    return false;
}

try {
    $model = new app;
    $requestMethod = $_SERVER["REQUEST_METHOD"];
    $requestMethod = strtoupper($requestMethod);

    switch ($requestMethod) {
        case 'POST':
            session_start();
            $idDel = $_SESSION['id'];

            $nombre = $_POST["nombre"] ?? null;
            $apellidoPaterno = $_POST["apellidoPaterno"] ?? null;
            $apellidoMaterno = $_POST["apellidoMaterno"] ?? null;
            $fechaNacimiento = $_POST["fechaNacimiento"] ?? null;

            $placas = $_POST["placas"] ?? null;
            $tipo = $_POST["tipo"] ?? null;
            $modelo = $_POST["modelo"] ?? null;
            $color = $_POST["color"] ?? null;

            $uniqueName1 = $uniqueName2 = $uniqueName3 = null;
            $errorMessage1 = $errorMessage2 = $errorMessage3 = '';

            if (handleFileUpload('fotoIdentificacion', $uniqueName1, $errorMessage1) &&
                handleFileUpload('fotoPlacas', $uniqueName2, $errorMessage2) &&
                handleFileUpload('fotoComprobante', $uniqueName3, $errorMessage3)
            ) {
                $model->uploadDatsPer([
                    "idDel" => $idDel,
                    "nombre" => $nombre,
                    "apellidoPaterno" => $apellidoPaterno,
                    "apellidoMaterno" => $apellidoMaterno,
                    "fechaNacimiento" => $fechaNacimiento,
                    "placas" => $placas,
                    "tipo" => $tipo,
                    "modelo" => $modelo,
                    "color" => $color,
                    "fotoPorfile" => $uniqueName1,
                    "fotoId" => $uniqueName2,
                    "fotoDom" => $uniqueName3,
                ]);

                echo " Datos y archivos cargados exitosamente.";
            } else {
                echo "Error al cargar archivos: $errorMessage1 $errorMessage2 $errorMessage3";
            }
            break;

        default:
            // Otros casos...
            break;
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
