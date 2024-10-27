<?php
session_start();
require('core.php');
$idSession = session_id();
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$querySe = "SELECT SUM(price) as total FROM cart WHERE user = '$idSession' AND variation = '$serial' AND status ='0';";
$sqlSele = mysqli_query($con, $querySe);
while ($arreglo = mysqli_fetch_array($sqlSele)) {
    $number = $arreglo[0];
}
if ($number) {

    echo "$" . number_format($number, 2);
}
