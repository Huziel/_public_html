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
        $sessionN = $_SESSION['nombre'];

        $resp = $model->traerProductosParaPuntoVenta($sessionN);

?>
        

        <table id="table_id" class=" justify-content-center col-12">
            <thead>
                <tr>
                    <th></th>
                </tr>
            </thead>
            <tbody class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center mt-5">

                <?php
                foreach ($resp as $fila) {
                ?>
                    <tr class="col">
                        <td class="card h-75 boxes animate__animated animate__flipInX" id="cardProdPV<?php echo $fila[0]; ?>" onclick="seleccionarProducto(<?php echo $fila[0]; ?>,'<?php echo $fila[2]; ?>','<?php echo $fila[1]; ?>','<?php echo $fila['stock']; ?>')" style="border-radius: 9px; <?php if ($fila['stock'] < 1) {
                                                                                                                                                                                                                                                                                                        echo "pointer-events: none; opacity: 0.5";
                                                                                                                                                                                                                                                                                                    } ?>">
                            <!-- Product image-->
                            <a class="image-container" onclick="">
                                <img src="<?php echo $fila[3]; ?>" style="border-radius: 9px;" class="img-fluid cropped-image" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="Imagen">
                                <div class="text-overlay col-12">


                                    <span class="badge bg-secondary" style="font-size: 12px;">Disponible: <?php
                                                                                                            echo $fila['stock'];
                                                                                                            ?></span>
                                    <span class="badge bg-warning text-dark" style="font-size: 12px;"><?php
                                                                                                        echo '<div id="stockLabel' . $fila[0] . '"></div>';
                                                                                                        ?></span>

                                </div>
                            </a>

                            <div class="card-footer">
                                <div class="row justify-content-center container">
                                    <b style="font-size: 12px;"><?php echo $fila[2]; ?></b>
                                </div>
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
