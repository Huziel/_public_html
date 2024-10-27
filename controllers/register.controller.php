<?php
require_once('../class/app.php');
$model = new app;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        $username = (isset($_POST['username']) ? $_POST['username'] : null);
        $pass = (isset($_POST['pass']) ? $_POST['pass'] : null);
        $pass2 = (isset($_POST['pass2']) ? $_POST['pass2'] : null);
        $phone = (isset($_POST['phone']) ? $_POST['phone'] : null);
        $cat = (isset($_POST['cat']) ? $_POST['cat'] : null);
        $tipoUs = (isset($_POST['tipoUs']) ? $_POST['tipoUs'] : null);
        $id_token = (isset($_POST['id_token']) ? $_POST['id_token'] : null);
        if ($id_token) {

            require_once '../googleAuth/vendor/autoload.php';

            // Recibe el token de autenticación


            // Configura el cliente de Google
            $client = new Google_Client(['client_id' => '794936788729-jf5jug4aut3caoa6kpilouiugt4h9o7h.apps.googleusercontent.com']);
            $payload = $client->verifyIdToken($id_token);
            if ($payload) {
                // Token válido, obtener la información del usuario
                $userid = $payload['sub']; // ID único del usuario
                $email = $payload['email'];
                $name = $payload['name'];
                $fechaHoraActual = date('YmdHis');

                // Crear un número aleatorio basado en la fecha y hora actual
                $numeroRandom = hexdec(substr(md5($fechaHoraActual), 0, 8)); // Convertir a decimal
                $model->register($data = [
                    "username" => $email,
                    "pass" => $userid,
                    "phone" => $numeroRandom,
                    "cat" => "0",
                    "tipoUs" => "4",
                ]);
            } else {
                // Token inválido
                echo json_encode(['ok' => 'false', 'id' => 'Token inválido', 'statusG' => '0']);
            }
        } else {

            if ($pass == $pass2) {
                $model->register($data = [
                    "username" => $username,
                    "pass" => $pass,
                    "phone" => $phone,
                    "cat" => $cat,
                    "tipoUs" => $tipoUs,
                ]);
            } else {
                $userData = array('ok' => 'false', 'id' => 'Las contraseñas no coinciden', 'statusG' => '0');
                echo json_encode($userData);
            }
        }


        break;

    default:
        # code...
        break;
}
