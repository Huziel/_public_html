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
        $idDel = $_SESSION['id'];
        $pedido = $model->cancelarPedido($idOrden, $idDel, $Corder);
        if ($pedido == 1) {
            $userData = array('data' => 'Pedido cancelado');
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
                $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de envio cancelada');
                $mail->Subject = 'Orden de envio cancelada';
                $mail->Body = "No. Order " . $Corder . " El repartidor canceló la orden.";



                $mail->addAddress($correo);
                // Enviar el correo
                $mail->send();
            } catch (Exception $e) {
            }
        } else {
            $userData = array('data' => 'No puedes cancelar hasta que entregues el pedido');
            echo json_encode($userData);
        }

        break;

    default:
        # code...
        break;
}
