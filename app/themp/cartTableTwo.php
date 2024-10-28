<?php
require('./objets/core.php');
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$query = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation WHERE A.user = '$id' AND C.serial = '$serial' AND A.status = '0';";
$queryEs = "SELECT * FROM cart A JOIN data B ON A.product = B.id JOIN liks C ON C.serial = A.variation WHERE A.user = '$id' AND C.serial = '$serial' LIMIT 1;";
$query_v = "SELECT * FROM `liks` WHERE createdby = '$id';";
$sql = mysqli_query($con, $query);

?>

<div class="container table-responsive">
    <table style="border-radius: 16px; " class="table bg-light table-borderless" ">
        <thead >
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
                        <img width=" 200px" style="border-radius: 16px; " src="<?= $arreglo['link'] ?>" class="img-fluid" alt="">
        </td>
        <td scope="row"><?= $arreglo['keyy'] ?> <?= $arreglo['var'] ?></td>
        <td><?= $arreglo['cant'] ?></td>
        <td>$<?= $arreglo['price'] ?> MXN</td>
        <td><button type="button" onclick="deleteAjax('<?= $arreglo[0] ?>');" class="btn btn-danger"><i class="fas fa-backspace"></i></button></td>
        </tr>

    <?php } ?>
    <tr class="bg-success">
        <td></td>
        <td></td>
        <td>
            <h5 class="text-primary">Sub total</h5>
        </td>
        <td>
            <div class="countPrs text-secondary" style=" font-size: 25px;"></div>
        </td>
        <td></td>
    </tr>
    </tbody>
    </table>
</div>