<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_GET['ids']) ? $_GET['ids'] : null);
$cate = (isset($_GET['cate']) ? $_GET['cate'] : null);
$querySe = "SELECT * FROM `liks` WHERE category = '$cate' AND adress ='$id' AND type = '1'";
$sqlSele = mysqli_query($con, $querySe);
?>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Seleccione uno.</th>

            </tr>
        </thead>
        <tbody>
            <?php
            while ($arreglo = mysqli_fetch_array($sqlSele)) {
            ?>
                <tr>
                    <td scope="row">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-dark " onclick="addkeyIn('<?= $arreglo[1] ?>&<?= $arreglo['createdby'] ?>')"><?= $arreglo['createdby'] ?></button>
                        </div>
                    </td>

                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>