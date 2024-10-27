<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$querySe = "SELECT * FROM `estados`";
$sqlSele = mysqli_query($con, $querySe);
?>
<div class="form-group">
    <label for="">Estado</label>
    <select class="form-control" name="states" id="states" onchange="selectLocale()">
    <option value="0">Seleccione uno</option>
        <?php
        while ($arreglo = mysqli_fetch_array($sqlSele)) {
        ?>
            <option value="<?=$arreglo[0]?>"><?=$arreglo[1]?></option>
        <?php
        }
        ?>
    </select>
</div>
