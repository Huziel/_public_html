<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['pdf'])) {
        $file = $_FILES['pdf'];

        // Ruta donde se guardará el archivo PDF en el servidor
        $uploadDir = '../pdfQR/';
        $uploadFile = $uploadDir . basename($file['name']);

        // Asegurarse de que el directorio de subida existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Mover el archivo desde la ubicación temporal a la ubicación de destino
        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
            echo 'El archivo ha sido subido correctamente.';
        } else {
            echo 'Error al mover el archivo a la ubicación de destino.';
        }
    } else {
        echo 'No se ha recibido ningún archivo.';
    }
} else {
    echo 'Método de solicitud no permitido.';
}
?>
