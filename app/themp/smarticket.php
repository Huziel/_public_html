<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Smart Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        #map {
            height: 400px;
            width: 100%;
        }

        .center-map-container {
            text-align: center;
        }
    </style>
</head>
<div class="container mt-3">
    <a href="https://rutadelaseda.xyz/" class="btn btn-light">
        <i class="fas fa-arrow-left"></i>
    </a>
    <form action="" method="get">
        <div class="mb-3">
            <label for="" class="form-label">¿No es su orden de compra?</label>
            <input type="number" class="form-control" name="order" id="order" aria-describedby="helpId" placeholder="Orden de compra" />

        </div>
        <center>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-info mt-3 mb-3 text-light">
                    Buscar Orden de compra <i class="fas fa-search"></i>
                </button>
            </div>

        </center>
    </form>


</div>
<?php
session_start();
$order1 = (isset($_GET['order']) ? $_GET['order'] : null);
if ($order1 == null) {
    $order1 = $_SESSION['orderUser'];
}
require_once('../../class/app.php');
$model = new app;
$json = $model->checkSessionDatsUser($order1);


$dataArray = json_decode($json, true);
$data = $dataArray['data'][0];
$id = $data['id'];
$idStore = $data['idTienda'];
$order = $data['order'];
$phone = $data['phone'];
$serial = $data['serial'];
$session = $data['session'];
$lat = $data['lat'];
$long = $data['long'];
$total = $data['total'];
$totEnvio = $data['totEnvio'];
$nombre = $data['nombre'];
$date = $data['date'];
$createdby = $data['createdby'];
$suma = $data['suma'];
$status = $data['status'];
$evidencia = $data['img'];

$jsonApart = $model->traerAprtadoDelticket($order1);
$dataArrayAprt = json_decode($jsonApart, true);
$dataAprt = $dataArrayAprt['data'][0];
$apartado = $dataAprt['descuento'];

$jsonGastoExt = $model->verGastosExtras($order1);
$dataArrayAprt = json_decode($jsonGastoExt, true);
$dataGastoEx = $dataArrayAprt['data'][0];
$precioGastExt = $dataGastoEx['precio'];
$descGastExt = $dataGastoEx['tipoCargo'];

$jsonDatosExtr = $model->traerDatosTiendExtra($idStore);
$dataDatosExt = json_decode($jsonDatosExtr, true);
$dataDatoExt = $dataDatosExt['data'][0];
$transf1 = $dataDatoExt["transf1"];
$transf2 = $dataDatoExt["transf2"];
$nameBanc1 = $dataDatoExt["nameBanc1"];
$nameBanc2 = $dataDatoExt["nameBanc2"];
$namePrope1 = $dataDatoExt["namePrope1"];
$namePrope2 = $dataDatoExt["namePrope2"];

switch ($status) {
    case '2':
        $EstadoPed = "Sin pagar, la tienda se contactará en breve";
        break;
    case '3':
        $EstadoPed = "Pagado, sin emitir orden de recolección";
        break;
    case '4':
        $EstadoPed = "En proceso de aceptación";
        break;
    case '5':
        $EstadoPed = "Pedido aceptado por un repartidor";
        break;
    case '6':
        $EstadoPed = "En ruta";
        break;
    case '7':
        $EstadoPed = "Pedido terminado";
        $imagenDeEvidencia = $evidencia;
        break;
    case '8':
        $EstadoPed = "Apartado sin pagar";
        break;
    case '9':
        $EstadoPed = "Apartado pagado";
        break;


    default:
        $EstadoPed = "En proceso";
        $imagenDeEvidencia = '';
        break;
}
if ($order == null) {
?>
    <div class="alert alert-dismissible alert-warning">
        <center>
            <h4 class="alert-danger">No hay ninguna orden en proceso</h4>
        </center>

    </div>
<?php
} else {
?>
    <div class="alert alert-dismissible alert-info">
        <center>
            <h4 class="alert-heading">No. Orden: <?= $order1 ?>, <?= $EstadoPed ?></h4>

        </center>

    </div>
    <center>
        <?php

        if ($_SESSION['nombre'] == $nombre || $_SESSION['nombre'] == $createdby) {

            if ($evidencia) {
        ?>
                <h5>Evidencia de entrega</h5>
                <img src="./objets/imagesDelivery/<?= $imagenDeEvidencia ?>" class="img-fluid col-8 mt-3 mb-3" style="border-radius: 20px;" alt="">
        <?php
            }
        }
        ?>
    </center>
    <?php
}
if ($status == 2 || $status == 3 || $status == 4  || $status == 9) {
    if (isset($precioGastExt)) {
        $_SESSION['totalCompraMercadopago'] = $totEnvio + $suma + $precioGastExt - $apartado;
    ?>
        <div class="d-flex justify-content-center">
            <div class="row mb-3 container">
                <div class="col-12 col-md-6 mb-2">
                    <h6>
                        <b>No. Orden</b> <span id="eta-value" class="badge bg-danger"><?= $order ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Precio neto </b><span id="eta-value" class="badge bg-warning">$<?= number_format($suma, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Gasto extra </b><span id="eta-value" class="badge bg-warning">$<?= number_format($precioGastExt, 2, '.', ',') ?></span>
                        <br>
                        <b><?= $descGastExt ?></b>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Apartado </b><span id="eta-value" class="badge bg-primary">$<?= number_format($apartado, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <h6>
                        <b>Total de envio </b><span id="eta-value" class="badge bg-info">$<?= number_format($totEnvio, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>TOTAL </b><span id="eta-value" class="badge bg-success">$<?= number_format($totEnvio + $suma + $precioGastExt - $apartado, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-12 mt-3 container" id="tablePostCompra">
                    <div class="table-responsive">
                        <table border="1" class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Variante</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Tu JSON de ejemplo
                                $json3 = $model->productsOrderTikcet($order);

                                // Decodificar el JSON a un array asociativo en PHP
                                $data4 = json_decode($json3, true);

                                // Construir la tabla HTML
                                foreach ($data4['data'] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['keyy'] . '</td>';
                                    echo '<td>$' . $item['number'] . '</td>';
                                    echo '<td>
                                            <img
                                                src="' . $item['link'] . '"
                                                class="img-fluid rounded-top"
                                                alt=""
                                                width="100px"
                                            /></td>';
                                    echo '<td>' . $item['var'] . '</td>';
                                    echo '<td>' . $item['cant'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <?php
                    if ($status == 2 || $status == 8) {
                    ?>
                        <center>

                            <h2>Pagar con:</h2>

                            <div class="d-grid gap-2 p-2">
                                <button id="checkout-button" class="btn btn-primary mt-3">Mercado Pago <i class="far fa-handshake"></i></button>
                            </div>
                        </center>
                        <br>
                        <?php
                        if ($transf1 || $transf2) {
                        ?>
                            <div class="container col-12">
                                <center>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Datos de transferencia</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6 class="text-dark">Transferencia 1</h6>
                                                    <p class="text-dark">Número de transferencia: <?php echo $transf1; ?></p>
                                                    <p class="text-dark">Nombre del banco: <?php echo $nameBanc1; ?></p>
                                                    <p class="text-dark">Nombre del propietario: <?php echo $namePrope1; ?></p>
                                                </div>
                                                <?php
                                                if ($transf2) {
                                                ?>
                                                    <div class="col-md-6">
                                                        <h6 class="text-dark">Transferencia 2</h6>
                                                        <p class="text-dark">Número de transferencia: <?php echo $transf2; ?></p>
                                                        <p class="text-dark">Nombre del banco: <?php echo $nameBanc2; ?></p>
                                                        <p class="text-dark">Nombre del propietario: <?php echo $namePrope2; ?></p>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </center>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="https://wa.me/<?= $phone ?>?text=Hola%20mi%20orden%20de%20compra%20es%3A%20%22<?= $order1 ?>%22%2C%20me%20gustar%C3%ADa%20enviar%20mi%20recibo%20de%20pago." class="btn btn-success">
                                        Enviar comprobante por WhatsApp <i class="fab fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        <?php

                        }
                        ?>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>


    <?php
    } else {
    ?>
        <div class="d-flex justify-content-center">
            <div class="row mb-3 container">
                <div class="col-12 col-md-6 mb-2">
                    <h6>
                        <b>No. Orden</b> <span id="eta-value" class="badge bg-danger"><?= $order ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Precio neto </b><span id="eta-value" class="badge bg-warning">$<?= number_format($suma, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Gasto extra </b><span id="eta-value" class="badge bg-warning">$<?= number_format($precioGastExt, 2, '.', ',') ?></span>
                        <br>
                        <b><?= $descGastExt ?></b>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>Apartado </b><span id="eta-value" class="badge bg-primary">$<?= number_format($apartado, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <h6>
                        <b>Total de envio </b><span id="eta-value" class="badge bg-info">$<?= number_format($totEnvio, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-6 col-md-6 mb-2">
                    <h6>
                        <b>TOTAL </b><span id="eta-value" class="badge bg-success">$<?= number_format($totEnvio + $suma + $precioGastExt - $apartado, 2, '.', ',') ?></span>
                    </h6>
                </div>
                <div class="col-12 mt-3 container" id="tablePostCompra">
                    <div class="table-responsive">
                        <table border="1" class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Imagen</th>
                                    <th>Variante</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Tu JSON de ejemplo
                                $json3 = $model->productsOrderTikcet($order);

                                // Decodificar el JSON a un array asociativo en PHP
                                $data4 = json_decode($json3, true);

                                // Construir la tabla HTML
                                foreach ($data4['data'] as $item) {
                                    echo '<tr>';
                                    echo '<td>' . $item['keyy'] . '</td>';
                                    echo '<td>$' . $item['number'] . '</td>';
                                    echo '<td>
                                            <img
                                                src="' . $item['link'] . '"
                                                class="img-fluid rounded-top"
                                                alt=""
                                                width="100px"
                                            /></td>';
                                    echo '<td>' . $item['var'] . '</td>';
                                    echo '<td>' . $item['cant'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>


                </div>
            </div>
        </div>
        <center>
            <div class="alert alert-danger" role="alert">
                <strong>Pedido no liberado</strong>
            </div>
        </center>

    <?php
    }
}
if ($status == 5 || $status == 6) {
    $json2 = $model->getDatsDeli2($order);
    $dataArray2 = json_decode($json2, true);

    // Acceder a los datos
    $data2 = $dataArray2['data'][0];

    // Crear variables para cada valor
    $id2 = $data2['id'];
    $order2 = $data2['order'];
    $phone2 = $data2['phone'];
    $serial2 = $data2['serial'];
    $session2 = $data2['session'];
    $lat2 = $data2['lat'];
    $long2 = $data2['long'];
    $total2 = $data2['total'];
    $totEnvio2 = $data2['totEnvio'];
    $nombre2 = $data2['nombre'];
    $date2 = $data2['date'];
    $createdby2 = $data2['createdby'];
    $suma2 = $data2['suma'];
    $status2 = $data2['status'];
    $nombreDel2 = $data2['nombreDel'];
    $apellidoPaterno2 = $data2['apellidoPaterno'];
    $apellidoMaterno2 = $data2['apellidoMaterno'];
    $placas2 = $data2['placas'];
    $tipo2 = $data2['tipo'];
    $modelo2 = $data2['modelo'];
    $color2 = $data2['color'];
    $fotoID2 = $data2['fotoID'];
    $picture2 = $data2['picture'];
    $latitud2 = $data2['latitud'];
    $longitud2 = $data2['longitud'];
    $time2 = $data2['time'];
    $code = $data2['code'];


    $json3 = $model->productsOrderTikcet($order);

    $jsonGastoExt = $model->verGastosExtras($order1);
    $dataArrayAprt = json_decode($jsonGastoExt, true);
    $dataGastoEx = $dataArrayAprt['data'][0];
    $precioGastExt = $dataGastoEx['precio'];
    $descGastExt = $dataGastoEx['tipoCargo'];
    switch ($tipo2) {
        case "1":
            $tipo2 = "Moto";
            break;
        case "2":
            $tipo2 = "Bicicleta";
            break;
        case "3":
            $tipo2 = "Automovil";
            break;
    }
    switch ($color2) {
        case "1":
            $color2 = "Blanco";
            break;
        case "2":
            $color2 = "Negro";
            break;
        case "3":
            $color2 = "Gris";
            break;
        case "4":
            $color2 = "Rojo";
            break;
        case "5":
            $color2 = "Azul";
            break;
        case "6":
            $color2 = "Verde";
            break;
        case "7":
            $color2 = "Amarillo";
            break;
    }
    $_SESSION['totalCompraMercadopago'] = $totEnvio2 + $suma2 + $precioGastExt;
    ?>


    <body>
        <nav class="navbar navbar-expand-lg bg-light d-flex justify-content-center" data-bs-theme="light">
            <div class="d-flex justify-content-center">
                <a class="navbar-brand" href="#">Ticket de pedido</a>

            </div>
        </nav>
        <div class="container-fluid">
            <div class="card text-dark bg-light mb-3">
                <div class="card-header">

                    <div class="col-12 center-map-container mt-3">
                        <!-- Mapa centrado -->
                        <div id="map" data-center="40.7128,-74.0060" style="border-radius: 12px;"></div>

                        <div id="eta" class="mt-3 mb-3">

                            Tiempo estimado de llegada: <span id="eta-value" class="badge bg-success">Primary</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <center>
                        <h5 class="card-title">Detalles del pedido</h5>
                    </center>

                    <br>
                    <center>
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>No. Orden</b> <span id="eta-value" class="badge bg-danger"><?= $order ?></span>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Precio neto </b><span id="eta-value" class="badge bg-warning">$<?= number_format($suma2, 2, '.', ',') ?></span>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Gasto extra </b><span id="eta-value" class="badge bg-warning">$<?= number_format($precioGastExt, 2, '.', ',') ?></span>
                                    <br>
                                    <b><?= $descGastExt ?></b>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Total de envio </b><span id="eta-value" class="badge bg-info">$<?= number_format($totEnvio2, 2, '.', ',') ?></span>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Total </b><span id="eta-value" class="badge bg-success">$<?= number_format($totEnvio2 + $suma2 + $precioGastExt, 2, '.', ',') ?></span>
                                </h6>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table border="1" class="table">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Imagen</th>
                                                <th>Variante</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Tu JSON de ejemplo


                                            // Decodificar el JSON a un array asociativo en PHP
                                            $data4 = json_decode($json3, true);

                                            // Construir la tabla HTML
                                            foreach ($data4['data'] as $item) {
                                                echo '<tr>';
                                                echo '<td>' . $item['keyy'] . '</td>';
                                                echo '<td>$' . $item['number'] . '</td>';
                                                echo '<td>
                                            <img
                                                src="' . $item['link'] . '"
                                                class="img-fluid rounded-top"
                                                alt=""
                                                width="100px"
                                            /></td>';
                                                echo '<td>' . $item['var'] . '</td>';
                                                echo '<td>' . $item['cant'] . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <?php
                                if ($status == 2 || $status == 8) {
                                ?>
                                    <center>

                                        <h2>Pagar con:</h2>
                                        <div class="d-grid gap-2 p-2">
                                            <button id="checkout-button" class="btn btn-primary mt-3">Mercado Pago <i class="far fa-handshake"></i></button>
                                        </div>
                                    </center>
                                    <br>
                                    <?php
                                    if ($transf1 || $transf2) {
                                    ?>
                                        <div class="container col-12">
                                            <center>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Datos de transferencia</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h6 class="text-dark">Transferencia 1</h6>
                                                                <p class="text-dark">Número de transferencia: <?php echo $transf1; ?></p>
                                                                <p class="text-dark">Nombre del banco: <?php echo $nameBanc1; ?></p>
                                                                <p class="text-dark">Nombre del propietario: <?php echo $namePrope1; ?></p>
                                                            </div>
                                                            <?php
                                                            if ($transf2) {
                                                            ?>
                                                                <div class="col-md-6">
                                                                    <h6 class="text-dark">Transferencia 2</h6>
                                                                    <p class="text-dark">Número de transferencia: <?php echo $transf2; ?></p>
                                                                    <p class="text-dark">Nombre del banco: <?php echo $nameBanc2; ?></p>
                                                                    <p class="text-dark">Nombre del propietario: <?php echo $namePrope2; ?></p>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </center>
                                            <div class="d-grid gap-2 mt-4">
                                                <a href="https://wa.me/<?= $phone ?>?text=Hola%20mi%20orden%20de%20compra%20es%3A%20%22<?= $order1 ?>%22%2C%20me%20gustar%C3%ADa%20enviar%20mi%20recibo%20de%20pago." class="btn btn-success">
                                                    Enviar comprobante por WhatsApp <i class="fab fa-whatsapp"></i>
                                                </a>
                                            </div>
                                        </div>
                                    <?php

                                    }
                                    ?>
                                <?php

                                }
                                ?>


                            </div>
                        </div>
                        <h5 class="card-title">Detalles del Repartidor</h5>
                        <br>
                        <div class="row">
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Nombre</b> <?= $nombreDel2 . " " . $apellidoPaterno2 . " " . $apellidoMaterno2 ?>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Tipo de trasporte </b><?= $tipo2 ?>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Placas </b><?= $placas2 ?>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Color </b><?= $color2 ?>
                                </h6>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <h6>
                                    <b>Modelo </b><?= $modelo2 ?>
                                </h6>
                            </div>
                            <?php
                            if ($_SESSION['nombre'] == $nombre || $_SESSION['nombre'] == $createdby) {
                            ?>
                                <center>
                                    <div class="col-12">
                                        <h4>
                                            <b>Código de verificación </b><?= $code ?>
                                        </h4>
                                        <br>
                                        <h5>Es muy importante que NO comparta este código</h5>
                                    </div>
                                </center>
                            <?php
                            }
                            ?>





                        </div>
                    </center>

                    <br>
                </div>
            </div>

            <div class="row">
                <!-- Columna para el mapa -->


                <!-- Columna para otros contenidos (opcional) -->
                <div class="col-md-4">
                    <!-- Puedes colocar aquí cualquier otro contenido -->
                </div>
            </div>

        </div>

        <script>
            function initMap() {
                // Coordenadas iniciales
                var initialCoords = {
                    lat: <?= $lat ?>,
                    lng: <?= $long ?>
                };

                // Crear mapa
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 13,
                    center: initialCoords,
                });

                // Crear marcador para el carrito
                const carMarker = new google.maps.Marker({
                    position: initialCoords,
                    map: map,

                    icon: {
                        url: "taxi.png", // Reemplaza con la ruta de tu icono de carrito
                        scaledSize: new google.maps.Size(30, 30),
                    },
                    animation: google.maps.Animation.BOUNCE,
                });


                // Ejemplo de animación de desplazamiento hacia una nueva posición

                const directionsService = new google.maps.DirectionsService();
                const directionsRenderer = new google.maps.DirectionsRenderer();
                directionsRenderer.setMap(map);

                function calculateAndDisplayRoute(start, end) {
                    const request = {
                        origin: start,
                        destination: end,
                        travelMode: "DRIVING",
                    };

                    directionsService.route(request, function(result, status) {
                        if (status == "OK") {
                            directionsRenderer.setDirections(result);

                            // Obtener el tiempo estimado de llegada
                            const duration = result.routes[0].legs[0].duration.text;
                            document.getElementById("eta-value").innerText = duration;
                        } else {
                            console.error("Error al obtener la ruta:", status);
                        }
                    });
                }
                const staticMarker = new google.maps.Marker({
                    position: {
                        lat: <?= $lat ?>,
                        lng: <?= $long ?>
                    },
                    map: map,
                    title: "Destino",
                });

                function moveCar(newCoords) {
                    carMarker.setPosition(newCoords);
                    map.panTo(newCoords);
                    calculateAndDisplayRoute(newCoords, staticMarker.getPosition());
                }

                const initialCoords2 = {
                    lat: <?= $latitud2 ?>,
                    lng: <?= $longitud2 ?>
                };

                const newCoords = {
                    lat: initialCoords2.lat, // Reemplaza con tus coordenadas específicas
                    lng: initialCoords2.lng, // Reemplaza con tus coordenadas específicas
                };

                moveCar(newCoords);


            }
        </script>

        <!-- Incluir la API de Google Maps con tu clave -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&callback=initMap"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
<?php
}
?>
<center>
    <div class="container ">
        <div class="d-grid gap-2 p-4">
            <button type="button" name="" id="shareButton" class="btn btn-primary mt-3 mb-3 text-light">Compartir ticket <i class="fas fa-share-square"></i></button>
        </div>
    </div>

    <script>
        $('#shareButton').click(function() {
            const textToCopy = "https://rutadelaseda.xyz/app/themp/smarticket.php?order=" + "<?= $order1 ?>";

            navigator.clipboard.writeText(textToCopy).then(() => {
                Swal.fire("Enlace de la tienda copiado al portapapeles.");
            }).catch((error) => {
                console.error('Error al copiar el texto:', error);
            });
        });
    </script>
</center>
<script>
    // Inicializa el SDK de MercadoPago con tu Public Key
    const mercadopago = new MercadoPago('APP_USR-554a0828-7b40-4977-a6ff-0d36943bd65a', {
        locale: 'es-MX', // Elige el idioma según tu país
    });

    document.getElementById('checkout-button').addEventListener('click', async function() {
        try {
            // Hacer una solicitud al backend para crear la preferencia de pago
            const response = await fetch('create_preference.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product: 'No. Orden:' + <?= $order1 ?>,
                    amount: <?= number_format($totEnvio + $suma + $precioGastExt - $apartado, 2, '.', ',') ?>, // Monto del producto
                    idP: <?= $order1 ?>
                }),
            });

            // Verificar si la respuesta fue exitosa
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            // Verificar si la respuesta tiene contenido antes de convertirla a JSON
            const data = await response.json();

            // Verificar si se obtuvo el preference_id
            if (!data.preference_id) {
                throw new Error('No se obtuvo un preference_id en la respuesta.');
            }

            // Redirige al checkout de MercadoPago con la preferencia
            window.location.href = `https://mercadopago.com.mx/checkout/v1/redirect?preference_id=${data.preference_id}`;
            /* console.log( `https://sandbox.mercadopago.com.mx/checkout/v1/redirect?preference_id=${data.preference_id}`); */

        } catch (error) {
            console.error('Error al crear el pago:', error);
            alert('Hubo un problema al crear el pago. Por favor, inténtalo de nuevo.');
        }
    });
</script>