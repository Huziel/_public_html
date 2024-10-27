<?php
require('./objets/core.php');
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$query = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation LEFT JOIN stock D ON D.idProd = B.id WHERE A.user = '$id' AND C.serial = '$serial' AND A.status = '0';";
$queryEs = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation WHERE A.user = '$id' AND C.serial = '$serial' LIMIT 1;";
$query_v = "SELECT * FROM `liks` WHERE createdby = '$id';";
$sql = mysqli_query($con, $query);
$stockStatusbg = "";
$stockStatus = 0;
?>

<div class="container table-responsive">
    <table style="border-radius: 16px; " class="table bg-light table-borderless" ">
        <thead >
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>En existencia</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($arreglo = mysqli_fetch_array($sql)) {
                if ($arreglo['cant'] > $arreglo['stock']) {
                    $stockStatus = 1;
                    $stockStatusbg = "bg-warning";
                }
            ?>
                <tr>
                    <td>
                        <img width="200px" style="border-radius: 16px; " src="<?=$arreglo['link'] ?>" class="img-fluid" alt="">
                    </td>
                    <td scope="row"><?= $arreglo['keyy'] ?> <?= $arreglo['var'] ?></td>
                    <td class="<?= $stockStatusbg ?>"><?= $arreglo['cant'] ?></td>
                    <td><?= $arreglo['stock'] ?></td>
                    <td>$<?= $arreglo['price'] ?> MXN</td>
                    <td><button type="button" onclick="deleteAjax('<?= $arreglo[0] ?>');" class="btn btn-danger"><i class="fas fa-backspace"></i></button></td>
                </tr>

            <?php } ?>
            <tr class="bg-success">
                <td></td>
                <td></td>
                <td><h5 class="text-primary">Sub total</h5></td>
                <td>
                    <div id="countPr" class="h5"></div>
                </td>
                <td></td>
            </tr>
            <tr class="bg-success">
                <td></td>
                <td></td>
                <td><h5 class="text-primary">Envio</h5></td>
                <td>
                    <div id="envioT" class="h5"></div>
                </td>
                <td></td>
            </tr>
            <tr class="bg-success"  >
                <td style="border-bottom-left-radius:15px"></td>
                <td></td>
                <td><h5 class="text-primary">Total</h5></td>
                <td>
                    <div id="totT" class="h5"></div>
                </td>
                <td style="border-bottom-right-radius:15px"></td>
            </tr>
        </tbody>
    </table>
    <textarea name="dats" style="display: none;" id="pedidoBack" wrap="hard">
    <?php
    $sql = mysqli_query($con, $query);
    while ($arreglo = mysqli_fetch_array($sql)) {
    ?>
            <?php echo "▪ ".$arreglo['cant']."x ".$arreglo['keyy'] . " " . $arreglo['var']."%0A" ?>
            <?php } ?>
    </textarea>
    <?php
    $sql = mysqli_query($con, $queryEs);
    while ($arregloP = mysqli_fetch_array($sql)) {
        $phone = $arregloP['phone'];
        $dom = $arregloP['dom'];
        $paypal = $arregloP['paypal'];
    }
    ?>
    <input type="hidden" id="phoneIn" value="<?= $phone ?>">
    
    
    <input type="hidden" id="nameStore" value="<?=$dom?>">
    <input type="hidden" id="orden" value="<?php echo rand(100, 99999).date('y').date('m').date('d');?>">
</div>


