<?php
require_once('../../class/app.php');
require_once('../../class/appVol2.php');
$model = new appvol2;
$requestMethod = $_SERVER["REQUEST_METHOD"];
$requestMethod = strtoupper($requestMethod);
$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];
switch ($requestMethod) {
    case 'POST':
        session_start();
        $nameOV = (isset($_POST['name']) ? $_POST['name'] : null);
        $sessionN = $_SESSION['nombre'];
        // Obtener la fecha y hora actuales
        $clave = date('YmdHis'); // Formato: AñoMesDíaHoraMinutoSegundo (Ej: 20240723153045)

        $resp = $model->añadirOrdenPventa($data = [
            "name" => $sessionN,
            "clave" => $clave,
            "alias" => $nameOV,


        ]);
?>

        <table id="table_id_orders" class=" justify-content-center col-11">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-3 justify-content-center mt-5">

                <?php
                foreach ($resp as $fila) {
                    switch ($fila[4]) {
                        case '0':
                            $status = "";
                            break;
                        case '1':
                            $status = "border-success";
                            break;
                    }
                ?>
                    <tr class="col">
                        <td class="card m-1 boxes animate__animated animate__flipInX <?= $status ?>" id="cardOrder<?= $fila[0] ?>" style="border-radius: 9px;">
                            <div class="card-header">
                                <div class="row justify-content-between"><b class="col-6"><?= $fila['nombre'] ?></b>
                                    <div class="mr-2 row justify-content-end"><button type="button" class="btn btn-danger" onclick="borrarOrderVenPV(<?= $fila[0] ?>)"><i class="fas fa-times"></i></button></div>
                                </div>
                            </div>
                            <div class="card-body" id="cardPanel<?= $fila['nombre'] ?>" onclick="verDetalleDeOrden(<?= $fila[0] ?>,'<?= $fila['nombre'] ?>','<?= $fila[1] ?>')">
                                <b class="card-text">Estado:</b>
                                <p class="card-text mt-1"><?= $fila['fecha'] ?></p>
                            </div>
                            <div class="card-footer">
                                <b style="font-size: 9px;">No Orden.<br><?php echo $fila[1]; ?></b>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php

        break;

    default:
        # code...
        break;
}
