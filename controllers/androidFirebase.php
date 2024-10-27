<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$idToken = (isset($_POST['idToken']) ? $_POST['idToken'] : null);
$message = (isset($_POST['message']) ? $_POST['message'] : null);
require './FCMSDK/vendor/autoload.php'; // Asegúrate de que el autoload de Composer está correctamente incluido.

use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;

// Función para enviar notificación push usando Firebase Cloud Messaging (FCM)
function sendNotification($token, $title, $body) {
    // Cargar credenciales de la cuenta de servicio
    $serviceAccountPath = './FCMSDK/ruta-de-la-seda-firebase-adminsdk-n926s-3fdd97ef31.json'; // Cambia esto por la ruta a tu archivo JSON
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $credentials = new ServiceAccountCredentials($scopes, $serviceAccountPath);

    // Obtener el token de acceso
    $accessToken = $credentials->fetchAuthToken()['access_token'];

    // Configurar la URL de la API
    $url = 'https://fcm.googleapis.com/v1/projects/ruta-de-la-seda/messages:send'; // Cambia YOUR_PROJECT_ID por el ID de tu proyecto

    // Crear el cuerpo del mensaje
    $data = [
        'message' => [
            'token' => $token,
            'notification' => [
                'title' => $title,
                'body' => $body,
            ]
        ]
    ];

    // Crear un cliente HTTP
    $httpClient = new Client();

    // Configurar las cabeceras
    $headers = [
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json'
    ];

    // Enviar la solicitud
    try {
        $response = $httpClient->post($url, [
            'headers' => $headers,
            'json' => $data
        ]);

        // Mostrar resultado
        echo "Notificación enviada: " . $response->getBody();
    } catch (Exception $e) {
        echo "Error al enviar la notificación: " . $e->getMessage();
    }
}

// Ejemplo de uso
$token = $idToken; // Reemplaza con el token del dispositivo
$title = '¡Noticias!';
$body = $message;
sendNotification($token, $title, $body);
?>
