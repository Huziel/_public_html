<?php
require('./objets/core.php');
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
$queryD = "DELETE FROM cart WHERE id = '$id'";
$sqlD = mysqli_query($con, $queryD);

$query = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation WHERE A.user = '$session';";
$queryEs = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation WHERE A.user = '$id' LIMIT 1;";

$sql = mysqli_query($con, $query);

?>
<div class="container table-responsive">
    <table class="table ">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($arreglo = mysqli_fetch_array($sql)) {
            ?>
                <tr>
                    <td>
                        <img width="200px" src="<?=$arreglo['link'] ?>" class="img-fluid" alt="">
                    </td>
                    <td scope="row"><?= $arreglo['keyy'] ?></td>
                    <td><?= $arreglo['cant'] ?></td>
                    <td>$<?= $arreglo['price'] ?> MXN</td>
                    <td><button type="button" onclick="deleteAjax('<?= $arreglo[0] ?>');" class="btn btn-danger"><i class="fas fa-backspace"></i></button></td>
                </tr>

            <?php } ?>
            <tr class="table-info">
                <td></td>
                <td></td>
                <td>Sub total</td>
                <td>
                    <div id="countPr"></div>
                </td>
                <td></td>
            </tr>
            <tr class="table-info">
                <td></td>
                <td></td>
                <td>Envio</td>
                <td>
                    <div id="envioT"></div>
                </td>
                <td></td>
            </tr>
            <tr class="table-info">
                <td></td>
                <td></td>
                <td>Total</td>
                <td>
                    <div id="totT"></div>
                </td>
                <td></td>
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
    <input type="hidden" id="orden" value="<?php echo rand(100, 999);?>">
</div>

