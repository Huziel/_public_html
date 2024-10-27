<?php
require '../app/themp/PHPMailer/PHPMailer-master/src/Exception.php';
require '../app/themp/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require '../app/themp/PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $dato = (isset($_POST['dato']) ? $_POST['dato'] : null);
        $token = $model->crearClaveRecupera($dato);
        $data = json_decode($token, true);
        $mensaje = $data['data'];
        if ($data['status'] == 1 || $data['status'] == 2) {
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
                $mail->CharSet = 'UTF-8';
                $mail->addCustomHeader('Content-Type: text/html; charset=UTF-8');
                $mail->isHTML(true);

                // Detalles del mensaje
                $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Recuperación de contraseña');
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body = '
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperación de Contraseña</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px;">

<div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);">
    <h2 style="color: #333333;">Recuperación de Contraseña</h2>
    <p>Su número de activación es: <strong>' . $data['token'] . '</strong></p>
    <!-- Puedes agregar más contenido aquí si lo deseas -->
</div>

</body>
</html>
';



                $mail->addAddress($dato);
                // Enviar el correo
                $mail->send();
                echo json_encode(array('data' => "Su código de verificación ah sido enviado a su correo."));
            } catch (Exception $e) {
                echo json_encode(array('data' => "Hubo un error al enviar el correo, intente más tarde."));
            }
        } else {
            echo json_encode(array('data' => "El correo proporcionado no coincide con ninguna cuenta."));
        }

        break;

    default:
        # code...
        break;
}
