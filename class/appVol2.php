<?php
require_once('app.php');
class appvol2 extends app
{
    public function agregarCupons($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $sqlIdTienda = "SELECT A.id FROM `liks` A WHERE A.createdby='$namePropet';";
        $queryidTienda = mysqli_query($newCon, $sqlIdTienda);
        while ($arrays = mysqli_fetch_array($queryidTienda)) {
            $idTienda = $arrays[0];
        }
        $prefix = 'C'; // Prefijo opcional para identificar como cupón
        $unique_id = uniqid($prefix, true); // Genera un ID único con más entropía
        $random_bytes = random_bytes(4); // Genera 4 bytes aleatorios
        $random_hex = bin2hex($random_bytes); // Convierte los bytes a hexadecimal

        // Combina uniqid con los bytes aleatorios
        $combined_id = $unique_id . $random_hex;

        // Limpia y ajusta la longitud del código de cupón
        $coupon_code = substr($combined_id, 0, 12);
        $sql = "INSERT INTO `cuponera` (`id`, `idTienda`, `nombre`, `tipo`, `codeC`, `uses`, `expired`, `porcent`, `cant`, `valorCompra`, `starts`) VALUES (NULL, '$idTienda', '$nombreCupon', '$tipoCupon', '$coupon_code', '$usosCupon', '$fechaexpiraCupon', '$porcentCupon', '$descuentoValorCupon', '$valorCupon', '$fechaInicioCupon');";
        $query = mysqli_query($newCon, $sql);

        if ($query) {
            $last_id = mysqli_insert_id($newCon);
            $last_items = [];

            foreach ($array as $item) {
                // Actualizar el array con el último ítem para cada id
                $last_items[$item['id']] = $item;
            }
            // Insertar los últimos ítems en ProductCupon
            foreach ($last_items as $item) {
                $this->agregarprod($last_id, $item['id'], $item['value'], $newCon);
            }
            $newCon->close();
            return json_encode(array("data" => "1"));
        } else {
            $newCon->close();
            return json_encode(array("data" => "2"));
        }
    }

    public function agregarprod($idCupon, $idProd, $discount, $newCon)
    {
        $sql2 = "INSERT INTO `ProductCupon` (`id`, `idCupon`, `idData`, `porcent`) VALUES (NULL, '$idCupon', '$idProd', '$discount');";
        $query = mysqli_query($newCon, $sql2);
    }
    public function verCupons($namePropet)
    {

        $newCon = $this->newCon;
        $sqlIdTienda = "SELECT A.id FROM `liks` A WHERE A.createdby='$namePropet';";
        $queryidTienda = mysqli_query($newCon, $sqlIdTienda);
        while ($arrays = mysqli_fetch_array($queryidTienda)) {
            $idTienda = $arrays[0];
        }
        if ($idTienda) {
            $cuponesRow = array();
            $sqlCupons = "SELECT * FROM `cuponera` A WHERE A.idTienda = '$idTienda';";
            $queryCupons = mysqli_query($newCon, $sqlCupons);
            while ($arrays = mysqli_fetch_array($queryCupons)) {
                $cuponesRow[] = $arrays;
            }
            return json_encode(array("data" => "1", "values" => $cuponesRow));
        } else {
            return json_encode(array("data" => "2"));
        }
    }
    public function hacerdescuento($codeC, $user, $store)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d');
        $newCon = $this->newCon;
        $sqlIdCupon = "SELECT * FROM `cuponera` A INNER JOIN liks B ON B.id = A.idTienda WHERE A.codeC = '$codeC' AND B.serial = '$store'";
        $sqlIdUser = "SELECT * FROM `cart` A WHERE A.user = '$user' AND A.variation ='$store'";
        $query = mysqli_query($newCon, $sqlIdCupon);
        $queryUser = mysqli_query($newCon, $sqlIdUser);
        $arrayRespuestas = [];
        while ($arrays = mysqli_fetch_array($query)) {
            $idCupon = $arrays[0];
            $idTienda = $arrays[1];
            $porcent = $arrays[7];
            $precioEstatico = $arrays[8];
            $valorCompra = $arrays[9];
            $tipoCupon = $arrays[3];
            $usosDelCupon = $arrays[5];
            $fechaInicia = $arrays[10];
            $fechaTermina = $arrays[6];
        }
        if ($idTienda) {
            if ($usosDelCupon > 0) {
                if ($fechaActual >= $fechaInicia && $fechaActual <= $fechaTermina) {
                    switch ($tipoCupon) {
                        case '1':
                            /* Productos del carrito, se guarda el id y el precio en 2 arrays */
                            $arrayProductos = [];
                            $arrayidProductosCart = [];
                            while ($arrays = mysqli_fetch_array($queryUser)) {
                                $arrayProductos[] = $arrays[2];
                                $arrayidProductosCart[] = $arrays[0];
                            }
                            /* ------------FIN------------------------------ */
                            $sumaE = count($arrayidProductosCart);
                            $totalProdCart = array_sum($arrayProductos);
                            if ($precioEstatico > 1 && $precioEstatico < $totalProdCart) {
                                $precioDivi = $precioEstatico / $sumaE;
                                for ($i = 0; $i < $sumaE; $i++) {
                                    $arrayProductos[$i];
                                    $arrayidProductosCart[$i];
                                    $respCup = $this->actualizarCart($newCon, $precioDivi, $arrayidProductosCart[$i], $idCupon, $usosDelCupon);
                                    $arrayRespuestas[] = $respCup;
                                }
                                return json_encode(array('ok' => 'info', 'data' => $arrayRespuestas));
                            } else if ($porcent) {

                                $montoPorcentaje = ($totalProdCart * $porcent) / 100;
                                $precioDivi2 = $montoPorcentaje / $sumaE;

                                for ($i = 0; $i < $sumaE; $i++) {
                                    $arrayProductos[$i];
                                    $arrayidProductosCart[$i];
                                    $respCup = $this->actualizarCart($newCon, $precioDivi2, $arrayidProductosCart[$i], $idCupon, $usosDelCupon);
                                    $arrayRespuestas[] = $respCup;
                                }
                                return json_encode(array('ok' => 'info', 'data' => $arrayRespuestas));
                            } else {

                                return json_encode(array('ok' => 'false', 'data' => "Hubo un error con el cupón"));
                            }
                            break;
                        case '2':
                            $arrayCart = array();
                            while ($arrays = mysqli_fetch_array($queryUser)) {
                                $arrayCart[] = $arrays;
                            }
                            $arrayobjets = $this->mostrarDescuentosCupon($idCupon);
                            if (empty($arrayobjets)) {

                                return json_encode(array('ok' => 'false', 'data' => "No hay productos con descuento"));
                            } else {
                                foreach ($arrayCart as $productoCart) {
                                    foreach ($arrayobjets as $producto) {
                                        if ($productoCart[1] == $producto[2]) {
                                            $cotizarPorcent = ($productoCart[2] * $producto[3]) / 100;
                                            $respCup = $this->actualizarCart($newCon, $cotizarPorcent, $productoCart[0], $idCupon, $usosDelCupon);
                                            $arrayRespuestas[] = $respCup;
                                        } else {

                                            return json_encode(array('ok' => 'false', 'data' => "No se puede hacer descuento"));
                                        }
                                    }
                                }
                                return json_encode(array('ok' => 'info', 'data' => $arrayRespuestas));
                            }

                            break;
                        case '3':

                            /* Productos del carrito, se guarda el id y el precio en 2 arrays */
                            $arrayProductos = [];
                            $arrayidProductosCart = [];
                            while ($arrays = mysqli_fetch_array($queryUser)) {
                                $arrayProductos[] = $arrays[2];
                                $arrayidProductosCart[] = $arrays[0];
                            }
                            /* ------------FIN------------------------------ */
                            $sumaE = count($arrayidProductosCart);
                            $totalProdCart = array_sum($arrayProductos);
                            if ($valorCompra <= $totalProdCart) {
                                if ($precioEstatico > 1 && $precioEstatico < $totalProdCart) {
                                    $precioDivi = $precioEstatico / $sumaE;
                                    for ($i = 0; $i < $sumaE; $i++) {
                                        $arrayProductos[$i];
                                        $arrayidProductosCart[$i];
                                        $respCup = $this->actualizarCart($newCon, $precioDivi, $arrayidProductosCart[$i], $idCupon, $usosDelCupon);
                                        $arrayRespuestas[] = $respCup;
                                    }
                                    return json_encode(array('ok' => 'info', 'data' => $arrayRespuestas));
                                } else if ($porcent) {

                                    $montoPorcentaje = ($totalProdCart * $porcent) / 100;
                                    $precioDivi2 = $montoPorcentaje / $sumaE;

                                    for ($i = 0; $i < $sumaE; $i++) {
                                        $arrayProductos[$i];
                                        $arrayidProductosCart[$i];
                                        $respCup = $this->actualizarCart($newCon, $precioDivi2, $arrayidProductosCart[$i], $idCupon, $usosDelCupon);
                                        $arrayRespuestas[] = $respCup;
                                    }
                                    return json_encode(array('ok' => 'info', 'data' => $arrayRespuestas));
                                } else {

                                    return json_encode(array('ok' => 'false', 'data' => "Hubo un error con el cupón"));
                                }
                            } else {

                                return json_encode(array('ok' => 'false', 'data' => "Debes cubrir con el minimo de compra para aplicar el cupón"));
                            }

                            break;

                        default:

                            return json_encode(array('ok' => 'false', 'data' => "El cupón no tiene tipo"));
                            break;
                    }
                } else {

                    return json_encode(array('ok' => 'false', 'data' => "El cupón expiró o no esta dentro de las fechas permitidas"));
                }
            } else {

                return json_encode(array('ok' => 'false', 'data' => "El cupón dejo de tener usos"));
            }




            /* foreach ($arrayProductos as $item) {

            } */
        } else {
            return json_encode(array('ok' => 'false', 'data' => "No exite el cupón para esta tienda"));
        }
    }
    public function actualizarCart($newCon, $precioDivi, $idCart, $idCupon, $uses)
    {
        $sql = "SELECT A.id,A.price FROM `cart` A WHERE A.id = '$idCart'";
        $query = mysqli_query($newCon, $sql);
        while ($arrays = mysqli_fetch_array($query)) {
            $priceProd = $arrays[1];
        }
        if ($priceProd) {
            $newPrice = number_format($priceProd - $precioDivi, 2);

            $sql2 = "UPDATE `cart` SET `price` = '$newPrice' WHERE `cart`.`id` = '$idCart';";
            $query2 = mysqli_query($newCon, $sql2);
            if ($query2) {
                $newUses = $uses - 1;
                $sqlActualizarCupons = "UPDATE `cuponera` SET `uses` = '$newUses' WHERE `cuponera`.`id` = '$idCupon';";
                $queryAcCup = mysqli_query($newCon, $sqlActualizarCupons);
                if ($queryAcCup) {
                    return "Cupón aplicado";
                } else {
                    return "No se pudo actualizar el cupón";
                }
            } else {
                return "Lamentablemente no se pudo actualizar";
            }
        } else {
            return "No se encontro el producto";
        }
    }
    public function mostrarDescuentosCupon($id)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `ProductCupon` A WHERE A.idCupon = '$id'";
        $query = mysqli_query($newCon, $sql);
        $arrayOb = array();
        while ($arrays = mysqli_fetch_array($query)) {
            $arrayOb[] = $arrays;
        }
        return $arrayOb;
    }
    public function traerProductosParaPuntoVenta($sessionN)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `data` A LEFT JOIN stock B ON B.idProd = A.id WHERE session = '$sessionN' AND active = '1'";
        $query = mysqli_query($newCon, $sql);
        $arrayOb = array();
        while ($arrays = mysqli_fetch_array($query)) {
            $arrayOb[] = $arrays;
        }
        return $arrayOb;
    }
    public function añadirOrdenPventa($data = [])
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d H:i:s');
        extract($data);
        $newCon = $this->newCon;
        if (empty($alias)) {
            $sql = "SELECT * FROM `PVentaGeneral` A WHERE A.creator = '$name' AND (A.estado = '0' OR A.estado = '1');";
            $query = mysqli_query($newCon, $sql);
            $arrayOb = array();
            while ($arrays = mysqli_fetch_array($query)) {
                $arrayOb[] = $arrays;
            }
            return $arrayOb;
        } else {
            $sql = "INSERT INTO `PVentaGeneral` (`id`, `noOrder`, `nombre`, `fecha`, `estado`, `total`, `extra`, `descuento`, `tipoPago`,`creator`) VALUES (NULL, '$clave', '$alias', '$fechaActual', '0', '0', '0', '0', '0','$name');";
            $query = mysqli_query($newCon, $sql);
            if ($query) {
                $sql = "SELECT * FROM `PVentaGeneral` A WHERE A.creator = '$name' AND (A.estado = '0' OR A.estado = '1');";
                $query = mysqli_query($newCon, $sql);
                $arrayOb = array();
                while ($arrays = mysqli_fetch_array($query)) {
                    $arrayOb[] = $arrays;
                }
                return $arrayOb;
            }
        }
    }
    public function guardarOrderPv($data = [])
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d H:i:s');
        extract($data);
        $newCon = $this->newCon;
        $sql1 = "DELETE FROM PVentaGeneralDetalle WHERE `PVentaGeneralDetalle`.`idPventaGeneral` = '$id'";
        $query1 = mysqli_query($newCon, $sql1);
        $sql = "UPDATE `PVentaGeneral` SET `fecha` = '$fechaActual', `estado` = '1', `total` = '$total', `extra` = '$extra' WHERE `PVentaGeneral`.`id` = '$id';";
        $query = mysqli_query($newCon, $sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    public function guardarProductosDeOrden($data = [])
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d H:i:s');
        extract($data);
        $newCon = $this->newCon;

        $sql = "INSERT INTO `PVentaGeneralDetalle` (`id`, `idPventaGeneral`, `productoId`, `cantidad`, `nameProd`, `precioBruto`, `precioNeto`) VALUES (NULL, '$id', '$idProd', '$cantidad', '$nameProd', '$precioBruto', '$precioNeto');";
        $query = mysqli_query($newCon, $sql);
        if ($query) {
            return 1;
        } else {
            return 0;
        }
    }
    public function traerOrdenDetalleGuardado($id)
    {
        $newCon = $this->newCon;
        $sql1 = "SELECT * FROM `PVentaGeneral` A WHERE A.id = '$id'";
        $query1 = mysqli_query($newCon, $sql1);
        $arrayOb1 = array();
        while ($arrays1 = mysqli_fetch_array($query1)) {
            $arrayOb1[] = $arrays1;
        }
        $sql = "SELECT * FROM `PVentaGeneralDetalle` A WHERE A.idPventaGeneral = '$id'";
        $query = mysqli_query($newCon, $sql);
        $arrayOb = array();
        while ($arrays = mysqli_fetch_array($query)) {
            $arrayOb[] = $arrays;
        }

        return  json_encode(array("info" => $arrayOb1, "data" => $arrayOb));
    }
    public function modificarNombrePV($id, $value)
    {
        $newCon = $this->newCon;
        $sql1 = "UPDATE `PVentaGeneral` SET `nombre` = '$value' WHERE `PVentaGeneral`.`id` = '$id';";
        $query1 = mysqli_query($newCon, $sql1);
        if ($query1) {
            $sql = "SELECT * FROM `PVentaGeneral` A WHERE A.id = '$id'";
            $query = mysqli_query($newCon, $sql);
            while ($arrays = mysqli_fetch_array($query)) {
                $names = $arrays[2];
            }
            return $names;
        } else {
            return 0;
        }
    }
    public function borrarOrdenPv($id)
    {
        $newCon = $this->newCon;
        $sql1 = "DELETE FROM PVentaGeneral WHERE `PVentaGeneral`.`id` = '$id'";
        $query1 = mysqli_query($newCon, $sql1);
        if ($query1) {
            return 1;
        } else {
            return 0;
        }
    }
    public function hacerPagoPV($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $sql1 = "INSERT INTO PVentaGeneralDetalleHisto (idPventaGeneral, productoId,cantidad,nameProd,precioBruto,precioNeto) SELECT idPventaGeneral, productoId,cantidad,nameProd,precioBruto,precioNeto FROM PVentaGeneralDetalle A WHERE A.idPventaGeneral = '$id';";
        $sql2 = "INSERT INTO PVentaGeneralHisto (id,noOrder ,nombre,fecha,estado,total,extra,descuento,tipoPago,creator) SELECT id,noOrder ,nombre,fecha,estado,total,extra,descuento,tipoPago,creator FROM PVentaGeneral A WHERE A.id = '$id';";
        $sql3 = "UPDATE `PVentaGeneral` SET `estado` = '2', `tipoPago` = '$tipoPago' WHERE `PVentaGeneral`.`id` = '$id';";
        $query3 = mysqli_query($newCon, $sql3);
        if ($query3) {
            $query2 = mysqli_query($newCon, $sql2);
            if ($query2) {
                $query1 = mysqli_query($newCon, $sql1);
                if ($query1) {
                    foreach ($arrayPV as $fila) {
                        $sql4 = "UPDATE stock SET stock = stock - '$fila[2]' WHERE idProd = '$fila[0]';";
                        $query4 = mysqli_query($newCon, $sql4);
                    }
                    return  json_encode(array("ok" => "true", "data" => "Orden de compra pagada"));
                } else {
                    return  json_encode(array("ok" => "false", "data" => "No se pudieron procesar los productos"));
                }
            } else {
                return  json_encode(array("ok" => "false", "data" => "No se pudo procesar la orden de compra"));
            }
        } else {
            return  json_encode(array("ok" => "false", "data" => "No se pudo actualizar"));
        }
    }
    public function traerHistoricoPv($creator)
    {
        $newCon = $this->newCon;
        $sql = "SELECT * FROM `PVentaGeneralHisto` A WHERE A.creator = '$creator'";

        $query = mysqli_query($newCon, $sql);
        $arrayOb = array();
        while ($arrays = mysqli_fetch_array($query)) {
            $arrayOb[] = $arrays;
        }
        $sql2 = "SELECT A.idPventaGeneral,A.cantidad,A.nameProd,A.precioBruto,A.precioNeto FROM `PVentaGeneralDetalleHisto` A INNER JOIN PVentaGeneralHisto B ON B.id = A.idPventaGeneral WHERE B.creator = '$creator';";
        $query2 = mysqli_query($newCon, $sql2);
        $arrayOb2 = array();

        while ($arrays2 = mysqli_fetch_array($query2)) {
            $arrayOb2[] = $arrays2;
        }

        return  json_encode(array("order" => $arrayOb, "products" => $arrayOb2));
    }
    public function printTiket($order)
    {
        $newCon = $this->newCon;
        $sql = "SELECT A.noOrder,A.nombre,A.fecha,A.total,A.extra,A.tipoPago,B.id AS idTienda,C.nombreTienda FROM `PVentaGeneralHisto` A INNER JOIN liks B ON B.createdby = A.creator LEFT JOIN masDatosdeTienda C ON C.idTienda = B.id WHERE A.noOrder ='$order';";

        $query = mysqli_query($newCon, $sql);
        $arrayOb = array();
        while ($arrays = mysqli_fetch_array($query)) {
            $arrayOb[] = $arrays;
        }
        $sql2 = "SELECT A.idPventaGeneral,A.cantidad,A.nameProd,A.precioBruto,A.precioNeto FROM `PVentaGeneralDetalleHisto` A INNER JOIN PVentaGeneralHisto B ON B.id = A.idPventaGeneral WHERE B.noOrder = '$order';";
        $query2 = mysqli_query($newCon, $sql2);
        $arrayOb2 = array();

        while ($arrays2 = mysqli_fetch_array($query2)) {
            $arrayOb2[] = $arrays2;
        }

        return  json_encode(array("order" => $arrayOb, "products" => $arrayOb2));
    }
    public function guardarOrdenMercadoPago($id, $preference)
    {
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d H:i:s');
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `mercadoPago` WHERE orderP = '$id'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `mercadoPago` SET `preference` = '$preference', `fecha` = '$fechaActual' WHERE `mercadoPago`.`orderP` = '$id';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
        } else {
            $SQLInsert = "INSERT INTO `mercadoPago` (`id`, `orderP`, `status`, `preference`, `fecha`) VALUES (NULL, '$id', '0', '$preference', '$fechaActual');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
        }
    }
    public function actualizarMercadoPago($id)
    {
        session_start();
        $insertWallet = new app;
        date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d H:i:s');
        $newCon = $this->newCon;
        $sql = "UPDATE `mercadoPago` SET `status` = '1', `fecha`='$fechaActual' WHERE `mercadoPago`.`orderP` = '$id';";
        $query2 = mysqli_query($newCon, $sql);

        $sqlIdLog = "SELECT C.id FROM `ordenCompra` A INNER JOIN liks B ON B.serial = A.serial INNER JOIN log C ON C.name = B.createdby WHERE A.order = '$id';";
        $queryLog = mysqli_query($newCon, $sqlIdLog);
        while ($array2 = mysqli_fetch_array($queryLog)) {
            $idLog = $array2[0];
        }
        
        $insertWallet->setMoney($idLog, $_SESSION['totalCompraMercadopago']);
    }
    public function asociarDispositivo($data = [])
    {
        extract($data);
        $newCon = $this->newCon;
        $query_Tienda = "SELECT * FROM `deviceId` WHERE `deviceId`.`idLog` = '$idP'";
        $query = mysqli_query($newCon, $query_Tienda);
        while ($array = mysqli_fetch_array($query)) {
            $dato = $array[0];
        }
        if ($dato) {

            $SQLUpDate = "UPDATE `deviceId` SET `token` = '$token' WHERE `deviceId`.`idLog` = '$idP';";
            $queryUpdate = mysqli_query($newCon, $SQLUpDate);
            if ($queryUpdate) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos actualizados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al actualizar los datos'));
            }
        } else {
            $SQLInsert = "INSERT INTO `deviceId` (`id`, `idLog`, `token`) VALUES (NULL, '$idP', '$token');";
            $queryInsert = mysqli_query($newCon, $SQLInsert);
            if ($queryInsert) {
                return json_encode(array('ok' => 'true', 'data' => 'Datos insertados correctamente'));
            } else {
                return json_encode(array('ok' => 'false', 'data' => 'Hubo un error al cargar los datos'));
            }
        }
    }
}
