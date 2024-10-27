<?php
require '../../app/themp/PHPMailer/PHPMailer-master/src/Exception.php';
require '../../app/themp/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../../app/themp/PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
        $idOrden = (isset($_POST['idOrden']) ? $_POST['idOrden'] : null);
        $Corder = (isset($_POST['Corder']) ? $_POST['Corder'] : null);
        $correo = (isset($_POST['correo']) ? $_POST['correo'] : null);
        $codigo = (isset($_POST['codigo']) ? $_POST['codigo'] : null);
        $cerrar = $model->cerrarPedido($idOrden, $Corder, $codigo);
        $idDel = $_SESSION['id'];
        $costEnvi = $model->getDtCostEnv($Corder);
        if ($cerrar == 1) {
            cargarImg($model, $idDel, $costEnvi, $Corder, $correo);
        } else {
            $userData = array('data' => 'El código es invalido');
            echo json_encode($userData);
        }

        break;

    default:
        # code...
        break;
}
function cargarImg($model, $idDel, $costEnvi, $Corder, $correo)
{
    // Verifica si el archivo se ha cargado correctamente
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Nombre original del archivo
        $nombreArchivo = $_FILES['file']['name'];
        // Tipo de archivo (ej., image/jpeg)
        $tipoArchivo = $_FILES['file']['type'];
        // Tamaño del archivo en bytes
        $tamanioArchivo = $_FILES['file']['size'];
        // Ruta temporal del archivo en el servidor
        $rutaTemporal = $_FILES['file']['tmp_name'];

        // Directorio donde guardarás la imagen
        $directorioDestino = '../../app/themp/objets/imagesDelivery/';
        // Asegúrate de que el directorio exista; si no, créalo
        if (!is_dir($directorioDestino)) {
            mkdir($directorioDestino, 0755, true);
        }

        // Genera un nombre único para evitar colisiones
        $nombreUnico = uniqid('img_', true) . '.' . pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        $rutaDestino = $directorioDestino . $nombreUnico;

        // Mueve el archivo a la ubicación final
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            // Procesamiento adicional si es necesario
            $model->guardarImageDelivery($Corder, $nombreUnico);
            $model->setMoneyDeliver($idDel, $costEnvi);

            $userData = array('data' => 'Código valido');
            echo json_encode($userData);
            $mail = new PHPMailer(true);
            try {
                // Configuración del servidor SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.hostinger.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'notificaciones@rutadelaseda.xyz';
                $mail->Password = 'Huzidrago666&';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Detalles del mensaje
                $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de envio cerrada');
                $mail->Subject = 'Orden de envio cerrada';
                $mail->Body = "No. Order " . $Corder . " El repartidor entregó la orden.";
                $mail->addAddress($correo);
                // Enviar el correo
                $mail->send();
            } catch (Exception $e) {
            }
        } else {
            $response = [
                'data' => 'Error al mover la imagen al destino final',
            ];
            echo json_encode($response);
        }
    } else {
        $response = [
            'data' => 'No se recibió ninguna imagen o hubo un error en la carga',
        ];
        echo json_encode($response);
    }
}
