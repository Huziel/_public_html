<?php
require_once('../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        switch ($_POST['type']) {
            case 'add':
                $idProd = (isset($_POST['idPD']) ? $_POST['idPD'] : null);
                $nombre = (isset($_POST['nombreAditivo']) ? $_POST['nombreAditivo'] : null);
                $precio = (isset($_POST['precioAditivo']) ? $_POST['precioAditivo'] : null);
                $categoria = (isset($_POST['categoriaAditivo']) ? $_POST['categoriaAditivo'] : null);
                $descripcion = (isset($_POST['descripcionAditivo']) ? $_POST['descripcionAditivo'] : null);
                $stock = (isset($_POST['stockAditivo']) ? $_POST['stockAditivo'] : null);
                if ($nombre && $precio && $categoria && $descripcion && $stock) {
                    echo $model->crearAditivo($data = [
                        "idProd" => $idProd,
                        "nombre" => $nombre,
                        "precio" => $precio,
                        "categoria" => $categoria,
                        "descripcion" => $descripcion,
                        "stock" => $stock,
                    ]);
                } else {

                    echo json_encode(array('ok' => 'false', 'data' => 'Complete los campos de Aditivos'));
                }
                break;
            case 'erase':
                $idA = (isset($_POST['idA']) ? $_POST['idA'] : null);
                echo $model->borrarAditivo($idA);
                break;

            default:
                # code...
                break;
        }


        break;

    case 'GET':
        $idProd = (isset($_GET['idP']) ? $_GET['idP'] : null);
        echo $model->traerAditivos($idProd);
        break;


    default:

        break;
}
