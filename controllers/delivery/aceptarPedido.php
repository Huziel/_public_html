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
        $model->aceptarPedido($idOrden, $idDel, $Corder);

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
            $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de envio aceptada');
            $mail->Subject = 'Orden de envio aceptada';
            $mail->Body = "No. Order ".$Corder." Ya hay un repartidor en camino.";



            $mail->addAddress($correo);
            // Enviar el correo
            $mail->send();
            
        } catch (Exception $e) {
            
        }
        break;

    default:
        # code...
        break;
}
