<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once('../../class/validateLog.php');
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);

switch ($requestMethod) {
    case 'GET':
        $userData['data'][] = array('id' => 'Servicio creado por Tlaokoyalistli Teotl');
        echo json_encode($userData);
        break;

    case 'POST':
        uploadProduct();

        break;
}
function uploadProduct()
{
    $host = $_SERVER["HTTP_HOST"];
    $url = $_SERVER["REQUEST_URI"];
    $data = json_decode(file_get_contents("php://input"));
    $session = $data->session;
    $name = $data->name;
    $variable = $data->variable;
    $descr = $data->descr;
    $price = $data->price;
    $img = $data->img;
    $category = $data->category;

    $binary_data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $img));
    $directorio_destino = '../../app/themp/objets/docs/';
    $nombre_archivo = 'imagen_' . time() . '.png';

    $ruta_completa = $directorio_destino . $nombre_archivo;

    $link = "https://" . $host . "/app/themp/objets/docs/" . $nombre_archivo;

    $model = new app;
    if ($data !== null) {
        if (empty($session)) {
            $userData['data'][] = array('ok' => 'false', 'response' => 'Producto sin dueño');
        } else {
            if (empty($name)) {
                $userData['data'][] = array('ok' => 'false', 'response' => 'Producto sin nombre');
            } else {
                $idpicture = $model->addPOne($data = [
                    "session" => "$session",
                    "name" => "$name",
                    "variable" => "$variable",
                    "descr" => "$descr",
                    "price" => "$price",
                    "link" => "$link",
                    "category" => "$category"
                ]);

                if (file_put_contents($ruta_completa, $binary_data)) {

                    $userData['data'][] = array('ok' => 'true', 'response' => 'Información e imagen subidos con éxito', 'id_product' => $idpicture);
                } else {
                    $userData['data'][] = array('ok' => 'true', 'response' => 'Información sin imagen procesado correctamente', 'id_product' => $idpicture);
                }
            }
        }
    } else {
        $userData['data'][] = array('ok' => 'false', 'response' => 'Sin datos por procesar');
    }
    echo json_encode($userData);
}
