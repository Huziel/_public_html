<?php
class app
{

    public $newCon;
    public function __construct()
    {
        date_default_timezone_set('America/Mexico_City');

        $host = "localhost";
        $user = "u119629285_rutadelaseda";
        $pass = 'Huzidrago666';
        $db = "u119629285_datos";

        // Crear conexión a la base de datos
        $con = new mysqli($host, $user, $pass, $db);

        // Verificar si hay errores en la conexión
        if ($con->connect_error) {
            die("Error de conexión: " . $con->connect_error);
        }

        // Establecer la conexión en una propiedad para su reutilización
        $this->newCon = $con;
    }
    public function listarP($value)
    {

        $newCon = $this->newCon;
        $sql = "SELECT * FROM `data` WHERE session ='$value'";
        $query = mysqli_query($newCon, $sql);
        $jsonArray = array();
        while ($array = mysqli_fetch_array($query)) {
            $jsonArray['data'][] = $array;
        }
        echo json_encode($jsonArray);
    }
    public function addPOne($data = [])
    {
        $newCon = $this->newCon;
        extract($data);

        $query = "INSERT INTO `data` (`id`, `number`, `keyy`, `link`, `session`, `dscr`, `var`,`category`) VALUES (NULL, '$price', '$name', '$link', '$session', '$descr', '$variable', '$category');";
        $query_b = "SELECT * FROM `data` WHERE session = '$session' ORDER BY ID DESC LIMIT 1  ";
        $sql = mysqli_query($newCon, $query);
        $sql_b = mysqli_query($newCon, $query_b);
        while ($arreglo = mysqli_fetch_array($sql_b)) {
            return $idP = $arreglo[0];
        }
    }
    public function editPOne($data = [])
    {
        $newCon = $this->newCon;
        extract($data);
        if (empty($link)) {
            $query = "UPDATE `data` SET `number` = '$price', `keyy` = '$name', `dscr` = '$descr', `var` = '$variable', `active` = '$activeProduct' WHERE `data`.`id` = '$session';";
        } else {
            $query = "UPDATE `data` SET `number` = '$price', `keyy` = '$name', `link` = '$link', `dscr` = '$descr', `var` = '$variable', `active` = '$activeProduct' WHERE `data`.`id` = '$session';";
        }
        $sql = mysqli_query($newCon, $query);
        return $session;
    }
    public function addMultiPicture($data = [])
    {
        $newCon = $this->newCon;
        extract($data);
        echo $idP;
        $queryIMG = "INSERT INTO `img` (`id`, `picture`, `dom`, `product`) VALUES (NULL, '$link', '$session', '$idp');";
        $sql_img = mysqli_query($newCon, $queryIMG);
    }
    public function productDetails($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.number, A.keyy, A.link, A.session, A.dscr, A.var, A.category, A.active, B.code FROM `data` A LEFT JOIN `cBarras` B ON B.idProd = A.id WHERE A.id = '$id'";
        $sqlIMG = "SELECT * FROM `img` WHERE product = '$id'";
        $sqlStock = "SELECT `stock` FROM `stock` WHERE idProd = '$id'";
        $query = mysqli_query($newCon, $sql);
        $queryIMG = mysqli_query($newCon, $sqlIMG);
        $queryStock = mysqli_query($newCon, $sqlStock);
        $jsonArray = array();
        $jsonArrayIMG = array();
        $jsonArrayStock = array();
        while ($array = mysqli_fetch_array($query)) {
            $jsonArray = $array;
        }
        while ($arrayIMG = mysqli_fetch_array($queryIMG)) {
            $jsonArrayIMG[] = $arrayIMG;
        }
        while ($arrayStock = mysqli_fetch_array($queryStock)) {
            $jsonArrayStock = $arrayStock;
        }
        echo json_encode(array("response" => $jsonArray, "files" => $jsonArrayIMG, "stock" => $jsonArrayStock));
    }
    public function deleteProduct($id)
    {
        $newCon = $this->newCon;
        $sql = "DELETE FROM `data` WHERE `data`.`id` = $id";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true', 'data' => "Archivo eliminado");
        echo json_encode($userData);
    }
    public function deleteProductImg($id)
    {
        $newCon = $this->newCon;
        $sql = "DELETE FROM `img` WHERE `img`.`id` = $id";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true', 'data' => "Archivo eliminado");
        echo json_encode($userData);
    }
    public function getInfoCat($createdBy)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `liks` WHERE createdby = '$createdBy'";
        $query = mysqli_query($newCon, $sql);
        $jsonArray = array();
        while ($array = mysqli_fetch_array($query)) {
            $jsonArray = $array;
        }
        $userData = array('ok' => 'true', 'data' => $jsonArray);
        echo json_encode($userData);
    }
    public function editCatInfo($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        if ($type == "phone") {
            $sql1 = "SELECT * FROM `liks` WHERE phone = '$value'";
            $query1 = mysqli_query($newCon, $sql1);
            if ($query1 && mysqli_num_rows($query1) > 0) {
                $userData = array('ok' => 'false', 'data' => "Ya existe el mismo número registrado en otra cuenta");
                echo json_encode($userData);
            } else {
                $sql = "UPDATE `liks` SET `$type` = '$value' WHERE `liks`.`id` = '$id';";
                $query = mysqli_query($newCon, $sql);
                $userData = array('ok' => 'true', 'data' => "Datos actualizados");
                echo json_encode($userData);
            }
        } else {
            $sql = "UPDATE `liks` SET `$type` = '$value' WHERE `liks`.`id` = '$id';";
            $query = mysqli_query($newCon, $sql);
            $userData = array('ok' => 'true', 'data' => "Datos actualizados");
            echo json_encode($userData);
        }
    }
    public function editCatInfoAdress($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $sql = "UPDATE `liks` SET `locales` = '$adress',`lat` = '$lat',`long` = '$lng' WHERE `liks`.`id` = '$id';";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true', 'data' => "Datos actualizados");
        echo json_encode($userData);
    }
    public function viewCat($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `liks` WHERE id = '$id'";
        $query = mysqli_query($newCon, $sql);
        $array = mysqli_fetch_array($query);

        require('../app/themp/phpqrcode/qrlib.php');
        $dir = '../app/themp/objets/temp/';
        if (!file_exists($dir))
            mkdir($dir);
        $filename = $dir . $array['serial'] . $array['createdby'] . '.png';
        $tamanio = 5;
        $level = 'M';
        $frameSize = 0;
        $serverName = $_SERVER['SERVER_NAME'];
        $scheme = $_SERVER['REQUEST_SCHEME'];

        $urlCompleta = "https" . '://' . $serverName;
        $link = $urlCompleta . '/@' . $array['id'];
        $urlViewer = $urlCompleta . "/app/themp/newPage.php?id=" . $array['serial'];

        QRcode::png($link, $filename, $level, $tamanio, $frameSize);
        $userData = array('ok' => 'true', 'data' => $filename, 'link' => $link, 'urlView' => $urlViewer);
        echo json_encode($userData);
    }
    public function redirectPage($createdBy)
    {

        if (strpos($createdBy, 'P') !== false) {
            $partes = explode('P', $createdBy);
            $createdBy = $partes[0];
            $product = $partes[1];
        }
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `liks` A LEFT JOIN masDatosdeTienda B ON B.idTienda = A.id WHERE A.id = '$createdBy'";
        $query = mysqli_query($newCon, $sql);
        $jsonArray = array();
        while ($array = mysqli_fetch_array($query)) {

            $contenido =  '/app/themp/page.php?id=' . $array['serial'] . '%26' . base64_encode($array['createdby']);
            if ($product) {
                $contenido =  '/app/themp/page.php?id=' . $array['serial'] . '%26' . base64_encode($array['createdby']) . "&product=" . $product;
            }
?>

            <head>
                <meta property="og:url" content="https://rutadelaseda.xyz/<?= $contenido ?>">
                <meta property="og:site_name" content="<?= $array['nombreTienda'] ?>">
                <meta property="og:locale" content="es_ES">
                <meta property="og:title" content="<?= $array['nombreTienda'] ?>">
                <meta property="og:description" content="<?= $array['texto1'] ?>">
                <meta property="og:image" content="<?= $array['logojpg'] ?>">
                <meta property="og:image:type" content="image/jpeg">
                <meta property="og:image:width" content="1200">
                <meta property="og:image:height" content="630">
                <meta property="og:type" content="website">

                <title><?= $array['nombreTienda'] ?></title>
            </head>
            <script>
                setTimeout(function() {
                    window.location.href = "https://rutadelaseda.xyz<?= $contenido ?>";
                }, 1000);
            </script>
<?php

            /* header("Location: .$contenido"); */

            die();
        }
    }
    public function register($data = [])
    {

        session_start();
        date_default_timezone_set('America/Mexico_City');
        $newCon = $this->newCon;
        extract($data);

        $username = str_replace(" ", "", $username);
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $fecha = strftime("%Y-%m-%d %T");
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        $fechaFormated = new DateTime($fecha);
        $query = "SELECT * FROM log A LEFT JOIN liks B ON B.createdby = A.name WHERE A.name = '$username' OR B.phone = '$phone'";

        $sql = mysqli_query($newCon, $query);
        if ($f = mysqli_fetch_assoc($sql)) {
            $userData = array('ok' => 'false', 'id' => 'Ya existe usuario registrado con el mismo alias o número telefónico', 'statusG' => '2', 'nameG' => $username, 'idTokenG' => $pass);
            echo json_encode($userData);
        } else {
            $queryInsert = "INSERT INTO `log` (`id`, `name`, `keyvalue`, `type`) VALUES (NULL, '$username', '$hash','$tipoUs')";
            $sqlInsert = mysqli_query($newCon, $queryInsert);
            $fechaFormated->modify('+3 month');
            $FInicioFormat = $fechaFormated->format('d-m-Y H:i:s');
            $rand = rand(1, 999);
            $sessionID = session_id();
            $geberate = $sessionID . $rand;
            $name = $geberate;
            $sqlC = mysqli_query($newCon, "INSERT INTO `liks` (`id`, `serial`, `time`, `phone`, `session`, `createdby`, `type`, `category`, `adress`, `color`, `logo`, `locales`, `logojpg`, `paypal`, `lat`, `long`) VALUES (NULL, '$name', '$FInicioFormat', '$phone', NULL, '$username', '1', '$cat', null, '10|4|10|1', null, null, null, null, null, null)");
            $link = $_SERVER['SERVER_NAME'] . "/themp/page.php?id=" . $name . "%26" . $username;
            $userData = array('ok' => 'true', 'id' => 'Usuario creado', 'link' => $link, 'statusG' => '1', 'nameG' => $username, 'idTokenG' => $pass);

            echo json_encode($userData);
        }
    }
    public function predecirCat($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT category FROM `data` WHERE category != 'null' GROUP BY category";
        $query = mysqli_query($newCon, $sql);
        $jsonArray = array();
        while ($array = mysqli_fetch_array($query)) {
            $jsonArray[] = $array;
        }
        $userData = array('ok' => 'true', 'data' => $jsonArray);
        echo json_encode($jsonArray);
    }
    public function getInfoCatPDF($createdBy)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `liks` WHERE createdby = '$createdBy'";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array = $array;
        }
        return $Array;
    }
    public function extra()
    {
        return $newCon = $this->newCon;
    }
    public function generalP($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,SUM(C.price) AS suma,C.status,D.status AS estdoMercado,E.nombre AS nombreCompleto, E.direccion, E.ciudad, E.pais, E.codigoPostal, E.tipoEnvio FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order LEFT JOIN mercadoPago D ON D.orderP = A.order LEFT JOIN formularioEnvios E ON E.noOrder = A.order WHERE B.createdby = '$data'  GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function generalPService($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,SUM(C.price) AS suma,C.status FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order INNER JOIN log D ON D.name = B.createdby WHERE D.id = '$data' GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function generalA($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,SUM(C.price) AS suma,C.status FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order WHERE  C.status <> '2' GROUP BY C.orderC";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function productsOrderC($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM cart A JOIN data B ON A.product = B.id INNER JOIN ordenCompra C ON A.variation = C.serial AND A.orderC = C.order WHERE C.id = '$id';";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function changeStatusP($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '3' WHERE `cart`.`orderC` = '$id'";
        $sqlverify = "SELECT A.idProd,A.stock,B.cant FROM `stock` A INNER JOIN cart B ON B.product = A.idProd WHERE B.orderC ='$id'";
        $query = mysqli_query($newCon, $sql);
        $queryverify = mysqli_query($newCon, $sqlverify);
        while ($array = mysqli_fetch_array($queryverify)) {
            $data = $array[0];
            $stock = $array[1];
            $cant = $array[2];
        }
        if ($data && $stock > 0) {
            $newStock = $stock - $cant;
            $sqlStock = "UPDATE `stock` SET `stock` = '$newStock' WHERE `stock`.`idProd` = '$data';";
            $querystock = mysqli_query($newCon, $sqlStock);
            if ($newStock == 0) {
                $queryUpData = "UPDATE `data` SET `active` = '0' WHERE `data`.`id` = '$data';";
                $queryUpdata = mysqli_query($newCon, $queryUpData);
            }
        }
        $userData = array('ok' => 'true');
        echo json_encode($userData);
    }
    public function changeStatusP2($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '9' WHERE `cart`.`orderC` = '$id'";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true');
        echo json_encode($userData);
    }
    public function changeStatusA($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '4' WHERE `cart`.`orderC` = '$id'";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true');
        echo json_encode($userData);
    }
    public function changeStatusE($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '6' WHERE `cart`.`orderC` = '$id'";
        $query = mysqli_query($newCon, $sql);
        $sql2 = "SELECT * FROM `ordenCompra` WHERE `ordenCompra`.`order` = '$id'";
        $query2 = mysqli_query($newCon, $sql2);

        while ($array = mysqli_fetch_array($query2)) {
            $idOrder = $array[0];
        }
        $sql3 = "UPDATE `ordenEnvio` SET `status` = '2' WHERE `ordenEnvio`.`ordenCompra` = '$idOrder';";
        $query3 = mysqli_query($newCon, $sql3);
        $userData = array('ok' => $idOrder);
        echo json_encode($userData);
    }
    public function CancelEnv($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '3' WHERE `cart`.`orderC` = '$id'";
        $query = mysqli_query($newCon, $sql);
        $sql2 = "SELECT * FROM `ordenCompra` WHERE `ordenCompra`.`order` = '$id'";
        $query2 = mysqli_query($newCon, $sql2);

        while ($array = mysqli_fetch_array($query2)) {
            $idOrder = $array[0];
        }
        $sql3 = "DELETE FROM ordenEnvio WHERE `ordenEnvio`.`ordenCompra` = '$idOrder'";
        $query3 = mysqli_query($newCon, $sql3);
    }
    public function resultTest($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `data` WHERE category = '$id' AND session = 'CANIVADIS'";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function borrarCache($id)
    {
        $newCon = $this->newCon;
        $sql = "UPDATE `liks` SET `session` = NULL WHERE `id` = '$id'";
        $query = mysqli_query($newCon, $sql);
        $userData = array('ok' => 'true');
        echo json_encode($userData);
    }
    public function anexarTienda($idTienda, $idDel)
    {
        $newCon = $this->newCon;
        $sql1 = "SELECT * FROM `anexosDeliver` WHERE store = '$idTienda' AND deliveryMan = '$idDel'";
        $query1 = mysqli_query($newCon, $sql1);
        $sql2 = "INSERT INTO `anexosDeliver` (`id`, `deliveryMan`, `store`) VALUES (NULL, '$idDel', '$idTienda');";
        $sql3 = "SELECT * FROM `liks` WHERE id = '$idTienda';";
        $query3 = mysqli_query($newCon, $sql3);
        $sql4 = "SELECT * FROM `datosPersonales` WHERE `datosPersonales`.`idLog` = '$idDel' AND `datosPersonales`.`verificado` = '1';";
        $query4 = mysqli_query($newCon, $sql4);
        if ($verif = mysqli_fetch_assoc($query4)) {
            if (empty($idDel) && empty($idTienda)) {
                echo "IdUser Invalido";
            } else {
                if ($idTienda == '0') {
                    echo "Sin codigo";
                } else {
                    if ($y = mysqli_fetch_assoc($query3)) {
                        if ($x = mysqli_fetch_assoc($query1)) {
                            echo "Esta tienda ya está vinculada";
                        } else {
                            $query2 = mysqli_query($newCon, $sql2);
                            echo "Datos vinculados";
                        }
                    } else {
                        echo "El codigo es invalido";
                    }
                }
            }
        } else {
            echo "Tienes que estar verificado para anexar una tienda";
        }
    }
    public function verTiendas($idDel)
    {
        $newCon = $this->newCon;
        $sql1 = "SELECT * FROM `anexosDeliver` A INNER JOIN liks B ON A.store = B.id WHERE A.deliveryMan = '$idDel'";
        $query1 = mysqli_query($newCon, $sql1);

        $Array = array();

        while ($array = mysqli_fetch_array($query1)) {
            $Array['data'][] = $array;
        }

        if (!empty($Array)) {
            echo json_encode($Array);
        } else {
            $userData = array('data' => 'Sin datos');
            echo json_encode($userData);
        }
    }
    public function borrarAnexoTienda($deliveryMan, $store)
    {
        // Usar sentencias preparadas para prevenir inyección de SQL
        $newCon = $this->newCon;
        $sql = "DELETE FROM anexosDeliver WHERE `anexosDeliver`.`deliveryMan` = ? AND `anexosDeliver`.`store` = ?";

        // Preparar la sentencia
        $stmt = mysqli_prepare($newCon, $sql);

        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "ss", $deliveryMan, $store);

        // Ejecutar la sentencia
        $query = mysqli_stmt_execute($stmt);

        // Verificar si la consulta fue exitosa
        if ($query) {
            // Todo está bien
            mysqli_stmt_close($stmt); // Cerrar la sentencia preparada


            echo 'Enlace borrado';
        } else {
            // Manejar el error
            // Puedes imprimir el mensaje de error o lanzar una excepción, según tus necesidades
            $error = mysqli_error($newCon);
            // También puedes registrar el error en un archivo de registro
            error_log("Error en la consulta SQL: $error");

            mysqli_stmt_close($stmt); // Cerrar la sentencia preparada


            echo 'Error en el proceso';
        }
    }
    public function emitirOrden($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $fecha_actual = date("Y-m-d H:i:s");
        $newCon = $this->newCon;
        $sql = "UPDATE `cart` SET `status` = '4' WHERE `cart`.`orderC` = '$id'";


        $sql2 = "SELECT * FROM `liks` A INNER JOIN ordenCompra B ON A.serial = B.serial WHERE B.order = '$id';";
        $query2 = mysqli_query($newCon, $sql2);
        while ($array = mysqli_fetch_array($query2)) {
            $idTienda = $array[0];
            $idOrden = $array[16];
            $lat = $array[21];
            $long = $array[22];
        }

        $sql3 = "SELECT * FROM `ordenEnvio` WHERE tienda = '$idTienda' AND ordenCompra = '$idOrden'";
        $query3 = mysqli_query($newCon, $sql3);
        while ($array = mysqli_fetch_array($query3)) {
            $idEnvio = $array[0];
        }
        if ($lat && $long) {
            if (empty($idEnvio)) {
                $sql4 = "INSERT INTO `ordenEnvio` (`id`, `tienda`, `delivery`, `ordenCompra`, `fechaIn`, `status`) VALUES (NULL, '$idTienda', NULL, '$idOrden','$fecha_actual','0');";
                $sql5 = "SELECT * FROM `anexosDeliver` A INNER JOIN log B ON A.deliveryMan = B.id LEFT JOIN deviceId C ON C.idLog = B.id WHERE A.store = '$idTienda';";

                $query5 = mysqli_query($newCon, $sql5);

                $Array = array();

                while ($array = mysqli_fetch_array($query5)) {
                    $Array['data'][] = $array;
                }

                if (count($Array) === 0) {

                    $userData = array('data' => 'Sin datos');
                    return json_encode($userData);
                } else {
                    $query = mysqli_query($newCon, $sql);
                    $query4 = mysqli_query($newCon, $sql4);
                    return json_encode($Array);
                }
            } else {
                $userData = array('data' => 'Ya hay una orden de envio');
                return json_encode($userData);
            }
        } else {
            $userData = array('data' => 'El envío no está disponible');
            return json_encode($userData);
        }
    }
    public function showPedidosDelivery($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `ordenCompra` A INNER JOIN ordenEnvio B ON A.id = B.ordenCompra INNER JOIN anexosDeliver C ON C.store = B.tienda INNER JOIN liks D ON D.serial = A.serial INNER JOIN log E ON E.name = D.createdby LEFT JOIN deviceId F ON F.idLog = E.id WHERE C.deliveryMan = '$id' AND C.bloqueo = '0' AND B.status = '0';";
        $query = mysqli_query($newCon, $sql);
        $Array = array();

        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        if (!empty($Array)) {
            echo json_encode($Array);
        } else {
            $userData = array('data' => 'Sin datos');
            echo json_encode($userData);
        }
    }
    public function aceptarPedido($idOrden, $idDel, $Corder)
    {
        $newCon = $this->newCon;


        // Utilizar una sentencia preparada
        $sql = "UPDATE `ordenEnvio` SET `delivery` = ?, `status` = '1' WHERE `ordenEnvio`.`ordenCompra` = ?";
        $codigoAleatorio = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
        $sql2 = "INSERT INTO `verificacion` (`id`, `orderC`, `code`) VALUES (NULL, '$Corder', '$codigoAleatorio');";
        $query = mysqli_query($newCon, $sql2);
        $stmt = mysqli_prepare($newCon, $sql);

        if ($stmt) {
            // Vincular parámetros
            mysqli_stmt_bind_param($stmt, "ss", $idDel, $idOrden);

            // Ejecutar la consulta
            $result = mysqli_stmt_execute($stmt);

            // Manejar errores
            if (!$result) {
                $error_message = 'Error al ejecutar la consulta: ' . mysqli_error($newCon);
                $userData = array('data' => $error_message, 'true' => 'false');
                echo json_encode($userData);
                // Puedes elegir si quieres detener la ejecución aquí o continuar con el código.
                // die($error_message);
            } else {

                $sql2 = "UPDATE `cart` SET `status` = '5' WHERE `cart`.`orderC` = '$Corder';";

                $query = mysqli_query($newCon, $sql2);
                // Éxito
                $success_message = 'Pedido aceptado con éxito.';
                $userData = array('data' => $success_message, 'true' => 'ok');
                echo json_encode($userData);
            }

            // Cerrar la sentencia preparada
            mysqli_stmt_close($stmt);
        } else {
            $error_message = 'Error al preparar la consulta: ' . mysqli_error($newCon);
            $userData = array('data' => $error_message, 'true' => 'false');
            echo json_encode($userData);
            // Puedes elegir si quieres detener la ejecución aquí o continuar con el código.
            // die($error_message);
        }

        // Cerrar la conexión
        mysqli_close($newCon);
    }

    public function checkDeliverPedido($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `ordenCompra` A INNER JOIN ordenEnvio B ON A.id = B.ordenCompra INNER JOIN anexosDeliver C ON C.store = B.tienda INNER JOIN liks D ON D.serial = A.serial INNER JOIN log E ON E.name = D.createdby LEFT JOIN deviceId F ON F.idLog = E.id WHERE C.deliveryMan = '$id'  AND C.bloqueo ='0' AND B.status = '1' OR B.status = '2' LIMIT 1;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();

        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        if (!empty($Array)) {
            echo json_encode($Array);
        } else {
            $userData = array('data' => 'Sin datos');
            echo json_encode($userData);
        }
    }
    public function cancelarPedido($idOrden, $idDel, $Corder)
    {
        $newCon = $this->newCon;
        $idOrder = null;

        $sql = "SELECT * FROM `ordenCompra` A INNER JOIN ordenEnvio B ON A.id = B.ordenCompra INNER JOIN anexosDeliver C ON C.store = B.tienda INNER JOIN liks D ON D.serial = A.serial WHERE C.deliveryMan = '$idDel' AND B.status = '2'";
        $query = mysqli_query($newCon, $sql);

        while ($array = mysqli_fetch_array($query)) {
            $idOrder = $array[0];
        }
        if (empty($idOrder)) {

            $sql3 = "UPDATE `cart` SET `status` = '4' WHERE `cart`.`orderC` = '$Corder'";
            $query3 = mysqli_query($newCon, $sql3);
            // Utilizar una sentencia preparada
            $sql2 = "UPDATE `ordenEnvio` SET `delivery` = null, `status` = '0' WHERE `ordenEnvio`.`ordenCompra` = '$idOrden'";

            $query = mysqli_query($newCon, $sql2);
            return 1;
        } else {
            return 0;
        }
    }
    public function cerrarPedido($idOrden, $Corder, $clave)
    {

        $newCon = $this->newCon;
        $sql = "SELECT * FROM `verificacion` WHERE `verificacion`.`orderC` = '$Corder' AND `verificacion`.`code` = '$clave';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $idOrder = $array[0];
        }
        if (empty($idOrder)) {
            return 0;
        } else {
            $sql3 = "UPDATE `cart` SET `status` = '7' WHERE `cart`.`orderC` = '$Corder'";
            $sql2 = "UPDATE `ordenEnvio` SET `status` = '3' WHERE `ordenEnvio`.`ordenCompra` = '$idOrden'";
            $query3 = mysqli_query($newCon, $sql3);
            $query2 = mysqli_query($newCon, $sql2);
            return 1;
        }
    }
    public function guardarImageDelivery($Corder, $ruteImg)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `imageEvidence` WHERE `imageEvidence`.`orderC` = '$Corder';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `imageEvidence` (`id`, `orderC`, `img`) VALUES (NULL, '$Corder', '$ruteImg');";
            $query2 = mysqli_query($newCon, $sql2);
        } else {
            $sql3 = "UPDATE `imageEvidence` SET `img` = '$ruteImg' WHERE `imageEvidence`.`orderC` = '$Corder';";
            $query3 = mysqli_query($newCon, $sql3);
        }
    }
    public function uploadPicturePorfile($idDel, $uniqueName)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `fotoPorfile` WHERE `fotoPorfile`.`idUser` = '$idDel';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `fotoPorfile` (`id`, `idUser`, `picture`) VALUES (NULL, '$idDel', '$uniqueName');";
            $query2 = mysqli_query($newCon, $sql2);
        } else {
            $sql3 = "UPDATE `fotoPorfile` SET `picture` = '$uniqueName' WHERE `fotoPorfile`.`idUser` = '$idDel';";
            $query3 = mysqli_query($newCon, $sql3);
        }
    }
    public function uploadDatsPer($data = [])
    {
        // Accede directamente a los elementos del array $data
        $idDel = $data['idDel'];
        $nombre = $data['nombre'];
        $apellidoPaterno = $data['apellidoPaterno'];
        $apellidoMaterno = $data['apellidoMaterno'];
        $fechaNacimiento = $data['fechaNacimiento'];
        $placas = $data['placas'];
        $tipo = $data['tipo'];
        $modelo = $data['modelo'];
        $color = $data['color'];
        $fotoPorfile = $data['fotoPorfile'];
        $fotoId = $data['fotoId'];
        $fotoDom = $data['fotoDom'];

        $newCon = $this->newCon;

        // Utiliza sentencias preparadas o sanitización para prevenir inyecciones de SQL

        $sql = "SELECT * FROM `datosPersonales` WHERE `datosPersonales`.`idLog` = '$idDel';";
        $query = mysqli_query($newCon, $sql);

        $dato = mysqli_fetch_array($query);

        if (empty($dato)) {
            $sql2 = "INSERT INTO `datosPersonales` (`id`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `placas`, `tipo`, `modelo`, `color`, `fotoPorfile`, `fotoID`, `fotoDomicilio`, `idLog`, `verificado`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '0')";
            $stmt = mysqli_prepare($newCon, $sql2);
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $placas, $tipo, $modelo, $color, $fotoPorfile, $fotoId, $fotoDom, $idDel);
            $query2 = mysqli_stmt_execute($stmt);

            if ($query2) {
                echo "Registro insertado exitosamente.";
            } else {
                echo "Error al insertar el registro.";
            }
        } else {
            $sql3 = "UPDATE `datosPersonales` SET `nombre` = ?, `apellidoPaterno` = ?, `apellidoMaterno` = ?, `fechaNacimiento` = ?, `placas` = ?, `tipo` = ?, `modelo` = ?, `color` = ?, `fotoPorfile` = ?, `fotoID` = ?, `fotoDomicilio` = ? WHERE `datosPersonales`.`idLog` = ?";
            $stmt = mysqli_prepare($newCon, $sql3);
            mysqli_stmt_bind_param($stmt, "sssssssssssi", $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $placas, $tipo, $modelo, $color, $fotoPorfile, $fotoId, $fotoDom, $idDel);
            $query3 = mysqli_stmt_execute($stmt);

            if ($query3) {
                echo "Registro actualizado exitosamente.";
            } else {
                echo "Error al actualizar el registro.";
            }
        }
    }
    public function chargePorfile($idDel)
    {
        try {
            $newCon = $this->newCon;

            // Utiliza una sentencia preparada
            $sql = "SELECT * FROM `datosPersonales` A INNER JOIN fotoPorfile B ON B.idUser = A.idLog WHERE `A`.`idLog` = ?";
            $stmt = mysqli_prepare($newCon, $sql);

            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta SQL.");
            }

            mysqli_stmt_bind_param($stmt, "s", $idDel);

            if (!mysqli_stmt_execute($stmt)) {
                throw new Exception("Error al ejecutar la consulta SQL.");
            }

            $queryResult = mysqli_stmt_get_result($stmt);

            $userData = array('data' => array());

            while ($array = mysqli_fetch_assoc($queryResult)) {
                $userData['data'][] = $array;
            }

            if (!empty($userData['data'])) {
                echo json_encode($userData);
            } else {
                echo json_encode(array('data' => 'Sin datos'));
            }
        } catch (Exception $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
    }
    public function getLocale($latitud, $longitud, $idDel)
    {
        // Establecer la zona horaria a la Ciudad de México
        date_default_timezone_set('America/Mexico_City');

        // Crear un objeto DateTime con la fecha y hora actual
        $fechaHoraActual = new DateTime();

        // Formatear la fecha y hora según el formato de DATETIME de MySQL
        $formatoMySQL = 'Y-m-d H:i:s';
        $fechaHoraFormateada = $fechaHoraActual->format($formatoMySQL);

        $newCon = $this->newCon;
        $sql = "SELECT COUNT(*) as count FROM `location` WHERE `idDeliver` = ?;";

        // Preparar la consulta SQL
        $stmt = mysqli_prepare($newCon, $sql);
        mysqli_stmt_bind_param($stmt, 's', $idDel);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($count == 0) {
            $sql = "INSERT INTO `location` (`id`, `idDeliver`, `latitud`, `longitud`, `time`) VALUES (NULL, ?, ?, ?, ?);";
        } else {
            $sql = "UPDATE `location` SET `latitud` = ?, `longitud` = ?, `time` = ? WHERE `idDeliver` = ?;";
        }

        // Preparar y ejecutar la consulta SQL
        $stmt = mysqli_prepare($newCon, $sql);
        if ($count == 0) {
            mysqli_stmt_bind_param($stmt, 'ssss', $idDel, $latitud, $longitud, $fechaHoraFormateada);
        } else {
            mysqli_stmt_bind_param($stmt, 'ssss', $latitud, $longitud, $fechaHoraFormateada, $idDel);
        }
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Cerrar la conexión
        mysqli_close($newCon);
    }

    public function getDatsDeli($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,SUM(C.price) AS suma,C.status, E.nombre AS nombreDel , E.apellidoPaterno, E.apellidoMaterno,E.placas,E.tipo,E.modelo,E.color,E.fotoID,F.picture, G.latitud,G.longitud,G.time FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order INNER JOIN ordenEnvio D ON D.ordenCompra = A.id INNER JOIN datosPersonales E ON E.idLog = D.delivery INNER JOIN fotoPorfile F ON F.idUser = E.idLog INNER JOIN location G ON G.idDeliver = E.idLog WHERE A.order = '$data' GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function checkSessionDatsUser($order)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,B.phone,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,B.id AS idTienda,SUM(C.price) AS suma,C.status,D.img FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order LEFT JOIN imageEvidence D ON D.orderC = A.order WHERE A.order = '$order' GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        return json_encode($Array);
    }
    public function traerAprtadoDelticket($order)
    {
        $newCon = $this->newCon;
        $sqlAp = "SELECT * FROM `apartadoOrder` A WHERE A.order  = '$order'";
        $queryAp = mysqli_query($newCon, $sqlAp);
        $Array2 = array();
        while ($array = mysqli_fetch_array($queryAp)) {
            $Array2['data'][] = $array;
        }
        return json_encode($Array2);
    }
    public function getDatsDeli2($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,SUM(C.price) AS suma,C.status, E.nombre AS nombreDel , E.apellidoPaterno, E.apellidoMaterno,E.placas,E.tipo,E.modelo,E.color,E.fotoID,F.picture, G.latitud,G.longitud,G.time,H.code FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order INNER JOIN ordenEnvio D ON D.ordenCompra = A.id INNER JOIN datosPersonales E ON E.idLog = D.delivery INNER JOIN fotoPorfile F ON F.idUser = E.idLog INNER JOIN location G ON G.idDeliver = E.idLog INNER JOIN verificacion H ON H.orderC = A.order WHERE A.order = '$data' GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        return json_encode($Array);
    }
    public function productsOrderTikcet($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT B.keyy,B.number,B.link,B.var,A.cant FROM cart A JOIN data B ON A.product = B.id INNER JOIN ordenCompra C ON A.variation = C.serial AND A.orderC = C.order WHERE C.order = '$id';";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        return json_encode($Array);
    }
    public function setMoney($idDel, $money)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaHoraActual = new DateTime();
        $formatoMySQL = 'Y-m-d H:i:s';
        $fechaHoraFormateada = $fechaHoraActual->format($formatoMySQL);
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `wallet` WHERE `wallet`.`idLog` = '$idDel';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
            $cant = $array[2];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `wallet` (`id`, `idLog`, `cant`, `time`) VALUES (NULL, '$idDel', '$money', '$fechaHoraFormateada');";
            $query2 = mysqli_query($newCon, $sql2);
        } else {
            $newVal = $cant + $money;
            $sql3 = "UPDATE `wallet` SET `cant` = '$newVal', `time` = '$fechaHoraFormateada' WHERE `wallet`.`idLog` = '$idDel';";
            $query3 = mysqli_query($newCon, $sql3);
        }
        if ($query2 || $query3) {
            return 1;
        } else {
            return 2;
        }
    }
    public function getMoney($idDel)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `wallet` WHERE `wallet`.`idLog` = '$idDel';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[2];
        }
        return $dato;
    }
    public function getDtCostEnv($order)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `ordenCompra` WHERE `ordenCompra`.`order` = '$order';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[8];
        }
        return $dato;
    }
    public function susMoney($idDel, $money)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaHoraActual = new DateTime();
        $formatoMySQL = 'Y-m-d H:i:s';
        $fechaHoraFormateada = $fechaHoraActual->format($formatoMySQL);
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `wallet` WHERE `wallet`.`idLog` = '$idDel';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
            $cant = $array[2];
        }
        $newVal = $cant - $money;
        $sql3 = "UPDATE `wallet` SET `cant` = '$newVal', `time` = '$fechaHoraFormateada' WHERE `wallet`.`idLog` = '$idDel';";
        $query3 = mysqli_query($newCon, $sql3);
    }
    public function setMoneyDeliver($idDel, $money)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaHoraActual = new DateTime();
        $formatoMySQL = 'Y-m-d H:i:s';
        $fechaHoraFormateada = $fechaHoraActual->format($formatoMySQL);
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `wallet` WHERE `wallet`.`idLog` = '$idDel';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
            $cant = $array[2];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `wallet` (`id`, `idLog`, `cant`, `time`) VALUES (NULL, '$idDel', '$money', '$fechaHoraFormateada');";
            $query2 = mysqli_query($newCon, $sql2);
        } else {
            $newVal = $cant + $money;
            $sql3 = "UPDATE `wallet` SET `cant` = '$newVal', `time` = '$fechaHoraFormateada' WHERE `wallet`.`idLog` = '$idDel';";
            $query3 = mysqli_query($newCon, $sql3);
        }
    }
    public function addTheme($idTienda, $theme)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `temasTienda` WHERE `temasTienda`.`userId` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `temasTienda` (`id`, `userId`, `temaId`) VALUES (NULL, '$idTienda', '$theme');";
            $query2 = mysqli_query($newCon, $sql2);
            if ($query2) {
                return json_encode(array('data' => 'Datos instertados con éxito'));
            }
        } else {
            $sql3 = "UPDATE `temasTienda` SET `temaId` = '$theme' WHERE `temasTienda`.`userId` = '$idTienda';";
            $query3 = mysqli_query($newCon, $sql3);
            if ($query3) {
                return json_encode(array('data' => 'Datos actulizados con éxito'));
            }
        }
    }
    public function addApartado($idTienda, $value)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `apartados` WHERE `apartados`.`tienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `apartados` (`id`, `tienda`, `value`) VALUES (NULL, '$idTienda', '$value');";
            $query2 = mysqli_query($newCon, $sql2);
            if ($query2) {
                return json_encode(array('data' => 'Datos instertados con éxito'));
            }
        } else {
            $sql3 = "UPDATE `apartados` SET `value` = '$value' WHERE `apartados`.`tienda` = '$idTienda';";
            $query3 = mysqli_query($newCon, $sql3);
            if ($query3) {
                return json_encode(array('data' => 'Datos actulizados con éxito'));
            }
        }
    }
    public function addOrderApartado($order, $desc)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `apartadoOrder` WHERE `apartadoOrder`.`order` = '$order'";
        $query = mysqli_query($newCon, $query_Tienda);

        $sqlCh = "UPDATE `cart` SET `status` = '8' WHERE `cart`.`orderC` = '$order'";


        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql2 = "INSERT INTO `apartadoOrder` (`id`, `order`, `descuento`) VALUES (NULL, '$order', '$desc');";
            $query2 = mysqli_query($newCon, $sql2);
            $queryCh = mysqli_query($newCon, $sqlCh);
            if ($query2) {
                return json_encode(array('data' => 'Datos instertados con éxito'));
            }
        } else {
            $sql3 = "UPDATE `apartadoOrder` SET `descuento` = '$desc' WHERE `apartadoOrder`.`order` = '$order';";
            $query3 = mysqli_query($newCon, $sql3);
            $queryCh = mysqli_query($newCon, $sqlCh);
            if ($query3) {
                return json_encode(array('data' => 'Datos actulizados con éxito'));
            }
        }
    }
    public function showApartadosOrder($order)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `apartadoOrder` WHERE `apartadoOrder`.`order` = '$order'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            return $dato = $array[2];
        }
    }
    public function showApartadosValue($idTienda)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `apartados` WHERE `apartados`.`tienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            return $dato = $array[2];
        }
    }
    public function crearClaveRecupera($correo)
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Obtener la longitud de la cadena de caracteres permitidos
        $longitud = strlen($caracteres);

        // Inicializar la variable donde se almacenará el código
        $codigo = '';

        // Generar el código de 5 caracteres
        for ($i = 0; $i < 5; $i++) {
            // Seleccionar un carácter aleatorio de la cadena de caracteres permitidos
            $codigo .= $caracteres[rand(0, $longitud - 1)];
        }
        date_default_timezone_set('America/Mexico_City');


        $fecha_hora_actual = date('Y-m-d H:i:s');
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `token` A INNER JOIN `log` B ON A.id_Log = B.id WHERE B.name = '$correo';";

        $query = mysqli_query($newCon, $query_Tienda);

        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            $sql_User = "SELECT * FROM `log` WHERE `log`.`name` = '$correo'";
            $query_User = mysqli_query($newCon, $sql_User);
            while ($array_Datos = mysqli_fetch_array($query_User)) {
                $dato_User = $array_Datos[0];
            }
            if ($dato_User) {

                $sql2 = "INSERT INTO `token` (`id`, `id_Log`, `token`, `fecha`) VALUES (NULL, '$dato_User', '$codigo', '$fecha_hora_actual');";
                $query2 = mysqli_query($newCon, $sql2);

                if ($query2) {
                    return json_encode(array('data' => 'Datos instertados con éxito', 'status' => '1', 'token' => $codigo));
                }
            } else {
                return json_encode(array('data' => 'El usuario no existe', 'status' => '3'));
            }
        } else {
            $sql3 = "UPDATE `token` SET `token` = '$codigo', `fecha` = '$fecha_hora_actual' WHERE `token`.`id` = '$dato';";
            $query3 = mysqli_query($newCon, $sql3);

            if ($query3) {
                return json_encode(array('data' => 'Datos actulizados con éxito', 'status' => '2', 'token' => $codigo));
            }
        }
    }
    public function verificarCodigoRe($clave)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `token` WHERE `token`.`token` = '$clave'";

        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            return json_encode(array('data' => 'El codigo es invalido', 'status' => '2'));
        } else {

            return json_encode(array('data' => 'El codigo es valido', 'status' => '1'));
        }
    }
    public function cambiarContra($correo, $key, $pass)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `token` WHERE `token`.`token` = '$key'";

        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if (empty($dato)) {
            return json_encode(array('data' => 'El codigo es invalido', 'status' => '2'));
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $query_Tienda = "UPDATE `log` SET `keyvalue` = '$hash' WHERE `log`.`name` = '$correo'";
            $query = mysqli_query($newCon, $query_Tienda);
            return json_encode(array('data' => 'Contraseña actualizada', 'status' => '1'));
        }
    }
    public function borrarCuentaParaSiempre($name)
    {
        session_start();

        $newCon = $this->newCon;
        $sql = "DELETE FROM log WHERE `log`.`name` = '$name'";
        $sql2 = "DELETE FROM liks WHERE `liks`.`createdby` ='$name'";
        $query = mysqli_query($newCon, $sql);
        $query1 = mysqli_query($newCon, $sql2);
        if ($query && $query1) {
            echo "true";
            session_destroy();
        } else {
            echo "false";
        }
    }
    public function agregarDatosdeTienda($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `masDatosdeTienda` WHERE `masDatosdeTienda`.`idTienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {
            $SQLInsert = "INSERT INTO `masDatosdeTienda` (`id`, `idTienda`, `nombreTienda`, `horario`, `banner`, `texto1`, `texto2`, `facebook`, `instagram`, `youtube`, `mercadoLibre`, `transf1`, `transf2`) VALUES (NULL, '$idTienda', '$nombreTienda', '$horario', '$banner', '$texto1', '$texto2', '$facebook', '$instagram', '$youtube', '$mercadoLibre','$transf1','$transf2');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        } else {
            $SQLUpDate = "UPDATE `masDatosdeTienda` SET `nombreTienda` = '$nombreTienda', `horario` = '$horario', `banner` = '$banner', `texto1` = '$texto1', `texto2` = '$texto2', `facebook` = '$facebook', `instagram` = '$instagram', `youtube` = '$youtube', `mercadoLibre` = '$mercadoLibre', `transf1` = '$transf1', `transf2` = '$transf2' WHERE `masDatosdeTienda`.`idTienda` = '$idTienda';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        }
        /* mysqli_close($newCon); */
    }
    public function agregarBnner($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `masDatosdeTienda` WHERE `masDatosdeTienda`.`idTienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `masDatosdeTienda` SET `banner` = '$banner' WHERE `masDatosdeTienda`.`idTienda` = '$idTienda';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `masDatosdeTienda` (`id`, `idTienda`, `nombreTienda`, `horario`, `banner`, `texto1`, `texto2`, `facebook`, `instagram`, `youtube`, `mercadoLibre`, `transf1`, `transf2`) VALUES (NULL, '$idTienda', NULL, NULL, '$banner', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
        /* mysqli_close($newCon); */
    }
    public function agregardatosExtras($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `masDatosdeTienda` WHERE `masDatosdeTienda`.`idTienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `masDatosdeTienda` SET `nombreTienda` = '$nombreTienda', `texto1` = '$texto1', `texto2` = '$texto2', `facebook` = '$facebook', `instagram` = '$instagram', `youtube` = '$youtube', `mercadoLibre` = '$mercadoLibre', `transf1` = '$transf1', `transf2` = '$transf2', `nameBanc1` = '$namebancIn1', `nameBanc2` = '$namebancIn2', `namePrope1` = '$namePropie1', `namePrope2` = '$namePropie2' WHERE `masDatosdeTienda`.`idTienda` = '$idTienda';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `masDatosdeTienda` (`id`, `idTienda`, `nombreTienda`, `horario`, `banner`, `texto1`, `texto2`, `facebook`, `instagram`, `youtube`, `mercadoLibre`, `transf1`, `transf2`,`nameBanc1`,`nameBanc2`,`namePrope1`,`namePrope2`) VALUES (NULL, '$idTienda', '$nombreTienda', NULL, NULL, '$texto1', '$texto2', '$facebook', '$instagram', '$youtube', '$mercadoLibre', '$transf1', '$transf2','$namebancIn1','$namebancIn2','$namePropie1','$namePropie2');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
        /* mysqli_close($newCon); */
    }
    public function agregarHorario($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `masDatosdeTienda` WHERE `masDatosdeTienda`.`idTienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `masDatosdeTienda` SET `horario` = '$horario' WHERE `masDatosdeTienda`.`idTienda` = '$idTienda';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `masDatosdeTienda` (`id`, `idTienda`, `nombreTienda`, `horario`, `banner`, `texto1`, `texto2`, `facebook`, `instagram`, `youtube`, `mercadoLibre`, `transf1`, `transf2`) VALUES (NULL, '$idTienda', NULL, '$horario', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
        /* mysqli_close($newCon); */
    }
    public function traerDatosTiendExtra($idTienda)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `masDatosdeTienda` WHERE `masDatosdeTienda`.`idTienda` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        $jsonArray = array();
        while ($arrayUsers = mysqli_fetch_array($query)) {
            $jsonArray[] = $arrayUsers;
        }
        return json_encode(array("data" => $jsonArray));
    }
    public function traerDatosDeliverParaTienda($created)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM anexosDeliver A INNER JOIN datosPersonales B ON B.idLog = A.deliveryMan INNER JOIN liks C ON C.id = A.store INNER JOIN fotoPorfile E ON E.idUser = A.deliveryMan WHERE C.createdby = '$created' GROUP BY A.deliveryMan;";
        $query = mysqli_query($newCon, $query_Tienda);
        $jsonArray = array();
        while ($arrayUsers = mysqli_fetch_array($query)) {
            $jsonArray[] = $arrayUsers;
        }
        return json_encode(array("data" => $jsonArray));
    }
    public function bloquearDeliver($id)
    {
        $newCon = $this->newCon;
        $query_Tienda = "UPDATE `anexosDeliver` SET `bloqueo` = '1' WHERE `anexosDeliver`.`id` = '$id';";
        $query = mysqli_query($newCon, $query_Tienda);
        if ($query) {
            return json_encode(array("data" => "Repartidor bloqueado"));
        } else {
            return json_encode(array("data" => "No se pudo actualizar"));
        }
    }
    public function desbloquearDeliver($id)
    {
        $newCon = $this->newCon;
        $query_Tienda = "UPDATE `anexosDeliver` SET `bloqueo` = '0' WHERE `anexosDeliver`.`id` = '$id';";
        $query = mysqli_query($newCon, $query_Tienda);
        if ($query) {
            return json_encode(array("data" => "Repartidor desbloqueado"));
        } else {
            return json_encode(array("data" => "No se pudo actualizar"));
        }
    }
    public function agregarTiempo($idTienda)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `log` A INNER JOIN liks B ON B.createdby = A.name WHERE A.id = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($arrayUsers = mysqli_fetch_array($query)) {
            $fecha = $arrayUsers['time'];
            $createdby = $arrayUsers['name'];
        }
        $nueva_fecha = date("d-m-Y H:i:s", strtotime($fecha . " +1 month"));
        $newCon = $this->newCon;
        $query_Time = "UPDATE `liks` SET `time` = '$nueva_fecha' WHERE `liks`.`createdby` = '$createdby';";
        $queryTime = mysqli_query($newCon, $query_Time);
    }
    public function generalPCliente($data)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.order,A.tel,A.serial,A.session,A.lat,A.long,A.total,A.totEnvio,A.nombre,A.date,B.createdby,B.ID AS idTienda,SUM(C.price) AS suma,C.status FROM ordenCompra A INNER JOIN liks B ON A.serial = B.serial INNER JOIN cart C ON C.orderC = A.order  WHERE A.nombre = '$data' GROUP BY C.orderC ORDER BY A.date DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function guardarcomentariosTienda($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $sql = "INSERT INTO `calificacionTienda` (`id`, `idTieda`, `idUser`, `calificacion`, `comentario`, `fotoComentario`) VALUES (NULL, '$idTieda', '$idUser', '$calificacion', '$comentario', NULL)";
        $query = mysqli_query($newCon, $sql);
        if ($query) {
            return json_encode(array("data" => "Comentario agregado"));
        } else {
            return json_encode(array("data" => "No se pudo procesar"));
        }
    }
    public function traerDatosComentario($idTienda)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.calificacion, A.comentario, B.name FROM `calificacionTienda` A INNER JOIN log B ON B.id = A.idUser WHERE A.idTieda ='$idTienda' ORDER BY A.id DESC;";
        $query = mysqli_query($newCon, $sql);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        echo json_encode($Array);
    }
    public function actualizarUbiExtra($iduser, $lat, $long)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `location` A INNER JOIN log B ON B.id = A.idDeliver INNER JOIN liks C ON C.createdby = B.name WHERE A.idDeliver = '$iduser';";
        $query = mysqli_query($newCon, $sql);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array['name'];
        }

        if ($dato) {
            $sql2 = "UPDATE `liks` SET `lat` = '$lat', `long` = '$long' WHERE `liks`.`createdby` = '$dato';";
            $query2 = mysqli_query($newCon, $sql2);
        }
    }
    public function agregarColor($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `colores` WHERE `colores`.`idStore` = '$idTienda'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `colores` SET `coloruno` = '$primo', `colordos` = '$secon', `colortres` = '$cuccessI', `colorcuatro` = '$darks', `colorcinco` = '$lights' WHERE `colores`.`idStore` = '$idTienda'";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `colores` (`id`, `idStore`, `coloruno`, `colordos`, `colortres`, `colorcuatro`, `colorcinco`) VALUES (NULL, '$idTienda', '$primo', '$secon', '$cuccessI', '$darks', '$lights')";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
        /* mysqli_close($newCon); */
    }
    public function addStock($data = [])
    {

        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `stock` WHERE `stock`.`idProd` = '$idProd'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `stock` SET `stock` = '$value' WHERE `stock`.`idProd` = '$idProd';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `stock` (`id`, `idProd`, `stock`, `typesd`) VALUES (NULL, '$idProd', '$value', NULL)";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
    }
    public function gastosExtras($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `gastosExtras` WHERE `gastosExtras`.`orderP` = '$orderP'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `gastosExtras` SET `precio` = '$precio', `tipoCargo` = '$cargo' WHERE `gastosExtras`.`orderP` = '$orderP';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `gastosExtras` (`id`, `orderP`, `precio`, `tipoCargo`) VALUES (NULL, '$orderP', '$precio', '$cargo');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
    }
    public function verGastosExtras($orderP)
    {
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `gastosExtras` WHERE `gastosExtras`.`orderP` = '$orderP'";
        $query = mysqli_query($newCon, $query_Tienda);
        $Array = array();
        while ($array = mysqli_fetch_array($query)) {
            $Array['data'][] = $array;
        }
        return json_encode($Array);
    }
    public function insertBarcode($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `cBarras` WHERE `cBarras`.`idProd` = '$idP'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `cBarras` SET `code` = '$barcode' WHERE `cBarras`.`idProd` = '$idP';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `cBarras` (`id`, `idProd`, `code`) VALUES (NULL, '$idP', '$barcode');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
    }
    public function searchBarcode($barcodePV, $session)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.id,A.number, A.keyy, A.link, A.session, A.dscr, A.var, A.category, A.active, B.code, C.stock FROM `data` A LEFT JOIN `cBarras` B ON B.idProd = A.id LEFT JOIN `stock` C ON C.idProd = A.id WHERE B.code = '$barcodePV' AND A.session = '$session'";
        $query = mysqli_query($newCon, $sql);
        $jsonArray = array();
        while ($arrayUsers = mysqli_fetch_array($query)) {
            $jsonArray[] = $arrayUsers;
        }
        return json_encode(array("data" => $jsonArray));
    }
}
