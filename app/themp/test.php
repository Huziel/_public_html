<?php

// Configura la URL de la preferencia
$preference_id = "1236062875-84de52e6-a4d5-466f-b468-4d728f4f6d94"; // Reemplaza con tu ID de preferencia
$url = "https://api.mercadopago.com/checkout/preferences/" . $preference_id;

// Inicializa cURL
$curl = curl_init();

// Configura las opciones de cURL
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,                                // URL de la API
  CURLOPT_RETURNTRANSFER => true,                     // Para obtener la respuesta como string
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer TEST-4823388493667360-092823-a45e51ec3a86f49fd387223aaf914b3a-1236062875", // Token de acceso
  ),
));

// Ejecuta la solicitud
$response = curl_exec($curl);

// Verifica si ocurrió un error
if(curl_errno($curl)) {
    echo 'Error en cURL: ' . curl_error($curl);
} else {
    // Decodifica la respuesta JSON
    $response_data = json_decode($response, true);

    // Muestra la respuesta en formato legible
    echo '<pre>';
    print_r($response_data);
    echo '</pre>';
}

// Cierra la sesión de cURL
curl_close($curl);