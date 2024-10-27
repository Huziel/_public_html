<?php

session_start();
// Requiere el SDK de MercadoPago
require __DIR__ . '/mercadopago/vendor/autoload.php'; // Ruta del autoload si usas Composer

// Habilitar la depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Configura las credenciales de MercadoPago
MercadoPago\SDK::setAccessToken('APP_USR-4823388493667360-092823-cf70a494b06f098c4d37658f66a3ec5a-1236062875'); // Usa el token de producción o sandbox

// Obtiene los datos enviados por el frontend
$body = file_get_contents('php://input');
$data = json_decode($body, true);

// Verifica si el JSON está vacío o no válido
if (is_null($data)) {
  header('Content-Type: application/json');
  echo json_encode(['error' => 'No se pudo decodificar el JSON enviado.']);
  exit();
}

$product = $data['product'] ?? 'Producto Genérico';  // Proporcionar un valor por defecto
$amount = $data['amount'] ?? 100;
$idP = $data['idP'] ?? 100;                       // Proporcionar un valor por defecto
$_SESSION['idp12312'] = $idP;
try {
  // Crea una preferencia
  $preference = new MercadoPago\Preference();

  // Configura los ítems del producto
  $item = new MercadoPago\Item();
  $item->title = $product;         // Usa el producto proporcionado por el frontend
  $item->quantity = 1;
  $item->unit_price = $amount;     // Usa el monto proporcionado por el frontend

  // Añade el ítem a la preferencia
  $preference->items = array($item);

  // Configura el comprador
  $payer = new MercadoPago\Payer();
  if ($_SESSION['nombre']) {
    $payer->email = $_SESSION['nombre'];
  } else {
    $payer->email = "contacto@rutadelaseda.xyz"; // Aquí puedes cambiar dinámicamente si lo prefieres
  }

  $preference->payer = $payer;

  // URL de retorno en caso de pago exitoso
  $preference->back_urls = array(
    "success" => "https://rutadelaseda.xyz/controllers/changeStatusP.controller.php",  // Donde redirigir si el pago es exitoso
    "failure" => "https://rutadelaseda.xyz/app/themp/smarticket.php?order=" . $idP,  // Si el pago falla
    "pending" => "https://rutadelaseda.xyz/app/themp/smarticket.php?order=" . $idP   // Si el pago está pendiente
  );

  // Indica si quieres que el comprador vuelva automáticamente a tu sitio tras pagar
  $preference->auto_return = "approved";

  // Guarda la preferencia
  $preference->save();

  // Configura la cabecera para la respuesta JSON
  header('Content-Type: application/json');
  echo json_encode(['preference_id' => $preference->id]);
  require_once('../../class/app.php');
  require_once('../../class/appVol2.php');
  $model = new appvol2;
  $model->guardarOrdenMercadoPago($idP, $preference->id);
} catch (Exception $e) {
  // En caso de error, devolver el error en formato JSON
  header('Content-Type: application/json');
  http_response_code(500);  // Devuelve un código HTTP 500 en caso de error
  echo json_encode(['error' => $e->getMessage()]);
}
