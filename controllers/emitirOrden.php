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
        session_start();
        $idStore = $_SESSION['id'];
        $id = (isset($_POST['id']) ? $_POST['id'] : null);
        $costEnvi = $model->getDtCostEnv($id);
        $wallet = $model->getMoney($idStore);
        if ($wallet >= $costEnvi) {
            $model->susMoney($idStore, $costEnvi);
            $correos = $model->emitirOrden($id);
            $jsonData = json_decode($correos, true);
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
                $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de envio');
                $mail->Subject = 'Orden de envio';
                $mail->Body = "Hay nuevas ordenes de envio.";


                $arrayTokens = array();
                if (isset($jsonData['data'])) {
                    
                    foreach ($jsonData['data'] as $objeto) {
                        // Verificar si la clave 'name' existe en el objeto
                        if (isset($objeto['name'])) {
                            $mail->addAddress($objeto['name']);

                            if (isset($objeto['token'])) {
                                $arrayTokens[] = $objeto['token'];
                            }
                        }
                    }
                }
                // Enviar el correo
                $mail->send();
                $status = 'Se emitió una orden de envio';
                $userData = array('data' => $status, 'keys' => $arrayTokens);
                echo json_encode($userData);
            } catch (Exception $e) {
                $status =  $jsonData['data'];
                $userData = array('data' => $status);
                echo json_encode($userData);
            }
        } else {
            $status = 'No cuentas con saldo suficiente';
            $userData = array('data' => $status);
            echo json_encode($userData);
        }

        break;

    default:
        # code...
        break;
}

