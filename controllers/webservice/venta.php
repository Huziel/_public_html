<?php
require_once('../../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
require '../../app/themp/PHPMailer/PHPMailer-master/src/Exception.php';
require '../../app/themp/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../../app/themp/PHPMailer/PHPMailer-master/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

switch ($requestMethod) {
    case 'POST':
        $order = (isset($_POST['order']) ? $_POST['order'] : null);
        $serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
        $session = (isset($_POST['session']) ? $_POST['session'] : null);
        $lat = (isset($_POST['lat']) ? $_POST['lat'] : null);
        $long = (isset($_POST['long']) ? $_POST['long'] : null);
        $tot = (isset($_POST['tot']) ? $_POST['tot'] : null);
        $totEnv = (isset($_POST['totEnv']) ? $_POST['totEnv'] : null);
        $nameU = (isset($_POST['nameU']) ? $_POST['nameU'] : null);
        $tel = (isset($_POST['tel']) ? $_POST['tel'] : null);
        $resp = $model->preventa($order, $serial, $session, $lat, $long, $tot, $totEnv, $nameU, $tel);

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
            $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de compra');
            $mail->Subject = 'Orden de compra';
            $mail->Body = "Se realizo una orden de compra de " . $tot . " a nombre de " . $nameU . " Con el No. " . $order;

            $mail->addAddress($resp[0]);


            // Enviar el correo
            $mail->send();
            $status = 'Correo enviado correctamente';
        } catch (Exception $e) {
            $status =  'Error al enviar el correo: ' . $mail->ErrorInfo;
        }
        return json_encode(array("correo" => $status, "statusCompra" => $resp[1], "statusCart" => $resp[2]));

        break;

    default:



        break;
}
