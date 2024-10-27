<?php
function buscarEnGoogleCustomSearch($searchTerm, $apiKey, $cx) {
    // Construye la URL de la solicitud de búsqueda
    $url = 'https://www.googleapis.com/customsearch/v1?key=' . urlencode($apiKey) . '&cx=' . urlencode($cx) . '&q=' . urlencode($searchTerm);

    // Realiza la solicitud de búsqueda y obtiene el JSON de respuesta
    $response = file_get_contents($url);

    // Decodifica el JSON en un array asociativo
    $data = json_decode($response, true);

    // Verifica si se encontraron resultados
    if (isset($data['items'])) {
        // Se encontraron resultados, prepara un array para almacenar los detalles de los resultados
        $resultados = [];

        // Recorre los resultados y guarda los detalles en el array
        foreach ($data['items'] as $item) {
            // Obtiene los detalles del resultado
            $resultado = [
                'titulo' => $item['title'],
                'url' => $item['link'],
                'descripcion' => $item['snippet']
            ];

            // Verifica si hay una URL de imagen disponible y la agrega al array de detalles del resultado
            if (isset($item['pagemap']['cse_image'][0]['src'])) {
                $resultado['url_imagen'] = $item['pagemap']['cse_image'][0]['src'];
            }

            // Agrega los detalles del resultado al array de resultados
            $resultados[] = $resultado;
        }

        // Devuelve los resultados
        return $resultados;
    } else {
        // No se encontraron resultados, devuelve falso
        return false;
    }
}

// Ejemplo de uso
$apiKey = 'AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps'; // Reemplaza esto con tu clave de API
$cx = '51740b0b0dd0a40d1'; // Reemplaza esto con el ID de tu motor de búsqueda personalizado
$searchTerm = 'primal b.b.simon'; // Término de búsqueda que deseas buscar

$resultados = buscarEnGoogleCustomSearch($searchTerm, $apiKey, $cx);

// Verifica si se encontraron resultados
if ($resultados !== false) {
    // Se encontraron resultados, muestra los resultados
    foreach ($resultados as $resultado) {
        echo "Título: " . $resultado['titulo'] . "<br>";
        echo "URL: " . $resultado['url'] . "<br>";
        echo "Descripción: " . $resultado['descripcion'] . "<br>";
        if (isset($resultado['url_imagen'])) {
            echo "URL de imagen: " . $resultado['url_imagen'] . "<br>";
        }
        echo "<br>";
    }
} else {
    // No se encontraron resultados
    echo "No se encontraron resultados.";
}
?>
