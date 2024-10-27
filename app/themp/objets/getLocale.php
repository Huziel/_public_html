<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$querySe = "SELECT * FROM `estados_municipios` A JOIN municipios B ON A.municipios_id = B.id WHERE A.estados_id = '$id';";
$sqlSele = mysqli_query($con, $querySe);
?>
<div class="form-group">
    <label for="">Municipio</label>
    <select class="form-control" name="locales" id="localess" onchange="viewMenus()">
    <option value="0">Seleccione uno</option>
        <?php
        while ($arreglo = mysqli_fetch_array($sqlSele)) {
        ?>
            <option value="<?=$arreglo[0]?>"><?=$arreglo[4]?></option>
        <?php
        }
        ?>
    </select>
</div>