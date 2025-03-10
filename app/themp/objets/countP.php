<?php
session_start();
require('core.php');
header('Set-Cookie: PHPSESSID=' . session_id() . '; Path=/; Secure; HttpOnly; SameSite=None');
$idSession = session_id();
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$querySe = "SELECT SUM(price) as total FROM cart WHERE user = '$idSession' AND variation = '$serial' AND status ='0';";
$sqlSele = mysqli_query($con, $querySe);
$querySeAdi = "SELECT SUM(B.precio) as total FROM cartAditivos A INNER JOIN aditivos B ON A.idAditivo = B.id WHERE session = '$idSession'";
$sqlSeleAdi = mysqli_query($con, $querySeAdi);

while ($arreglo = mysqli_fetch_array($sqlSele)) {
    $number = $arreglo[0];
}
while ($arreglo2 = mysqli_fetch_array($sqlSeleAdi)) {
    $number2 = $arreglo2[0];
}
if ($number) {

    echo "$" . number_format($number, 2);
}
