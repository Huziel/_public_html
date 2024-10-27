<?php
require_once('../class/app.php');
require_once('../class/appVol2.php');
$requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
$type = (isset($_POST['type']) ? $_POST['type'] : null);


switch ($requestMethod) {
    case 'POST':
        evaluateTypePost($type);
        break;
    case 'GET':
        // Código GET si es necesario
        break;
    default:
        // Otras acciones para métodos no soportados
        break;
}
function evaluateTypePost($type)
{
    switch ($type) {
        case 'traerListaProd':
            $model = new app;
            session_start();
            $sessions = (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null);
            $model->listarP($sessions);
            break;
        case 'agregarCupon':
            session_start();
            $sessions = (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null);
            $model = new appvol2;
            // Obtener el JSON enviado en la solicitud
            $json = (isset($_POST['jsonData']) ? $_POST['jsonData'] : null);

            // Decodificar el JSON a un array asociativo
            $data = json_decode($json, true);

            // Verificar si la decodificación fue exitosa
            if ($data !== null) {

                // Acceder a los datos del cupón
                $nombreCupon = $data['nombreCupon'];
                $tipoCupon = $data['tipoCupon'];
                $valorCupon = $data['valorCupon'];
                $porcentCupon = $data['porcentCupon'];
                $descuentoValorCupon = $data['descuentoValorCupon'];
                $usosCupon = $data['usosCupon'];
                $fechaInicioCupon = $data['fechaInicioCupon'];
                $fechaexpiraCupon = $data['fechaexpiraCupon'];
                $array = $data['array'];
                // Este será tu array de descuentos
                // Aquí puedes realizar las operaciones necesarias con los datos recibidos
                // Por ejemplo, insertar en una base de datos, procesar lógica de negocio, etc.
                // Ejemplo de impresión para verificar
                echo $model->agregarCupons($data = [
                    "namePropet" => "$sessions",
                    "nombreCupon" => "$nombreCupon",
                    "tipoCupon" => $tipoCupon,
                    "valorCupon" => $valorCupon,
                    "porcentCupon" => $porcentCupon,
                    "descuentoValorCupon" => $descuentoValorCupon,
                    "usosCupon" => $usosCupon,
                    "fechaInicioCupon" => $fechaInicioCupon,
                    "fechaexpiraCupon" => $fechaexpiraCupon,
                    "array" => $array,

                ]);
            } else {
            }
            break;
        case 'vercupones':
            session_start();
            $sessions = (isset($_SESSION['nombre']) ? $_SESSION['nombre'] : null);
            $model = new appvol2;
            echo $model->verCupons($sessions);
            break;
        case 'aplicarCupon':
            session_start();
            $sessions = session_id();
            $codeTienda = (isset($_POST['codeTienda']) ? $_POST['codeTienda'] : null);
            $codeC = (isset($_POST['codeC']) ? $_POST['codeC'] : null);
            $model = new appvol2;
            echo  $model->hacerdescuento($codeC, $sessions, $codeTienda);



            break;
        default:
            // Manejo para otros tipos de solicitud POST no reconocidos
            break;
    }
}
