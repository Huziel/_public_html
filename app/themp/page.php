<!DOCTYPE html>
<script>
    function handleAndroidParam(param) {
        console.log("Received from Android: " + param);

        // Guardar el parámetro en localStorage
        localStorage.setItem("androidParam", param);

        // Para confirmar que el parámetro se guardó correctamente
        let cachedParam = localStorage.getItem("androidParam");
        console.log("Cached param: " + cachedParam);
    }
</script>
<html lang="en">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idSession = session_id();
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$idparts = explode('&', $id); /* la dividimos  */
$id = $idparts[0];
$sessionN = base64_decode($idparts[1]);

require('./objets/core.php');
require('./objets/head.php');
$query_v = "SELECT * FROM `liks` A INNER JOIN masDatosdeTienda B ON B.idTienda = A.id WHERE A.serial = '$id';";
$queryExtraPuntos = "SELECT A.id FROM liks A INNER JOIN masDatosdeTienda B ON A.id = B.idTienda WHERE A.lat <> 'null' AND A.logojpg <> 'null' GROUP BY A.createdby;";
$sql = mysqli_query($con, $query_v);
$sqlExtraPuntos = mysqli_query($con, $queryExtraPuntos);

while ($arreglo = mysqli_fetch_array($sql)) {
    $idTienda = $arreglo[0];
    $serialC = $arreglo[1];
    $number = $arreglo[3];
    $session = $arreglo[4];
    $nota = $arreglo[10];
    $logo = $arreglo[12];
    $wha = $arreglo[3];
    $costos = $arreglo['color'];
    $nameP = $arreglo[5];
    $tipoDeCatalogo = $arreglo[6];
    $colorBack = $arreglo[9];
    $lat = $arreglo[14];
    $long = $arreglo[15];
    $banner = $arreglo['banner'];
    $nombreT = $arreglo['nombreTienda'];
    $text1 = $arreglo['texto1'];
    $horario = $arreglo['horario'];
    $face = $arreglo['facebook'];
    $insta = $arreglo['instagram'];
    $youtu = $arreglo['youtube'];
    $mercada = $arreglo['mercadoLibre'];
}



$queryColors = "SELECT * FROM `colores` WHERE idStore = '$idTienda'";
$sqlColor = mysqli_query($con, $queryColors);
while ($arregloColor = mysqli_fetch_array($sqlColor)) {
    $coloruno = $arregloColor[2];
    $colordos = $arregloColor[3];
    $colortres = $arregloColor[4];
    $colorcuatro = $arregloColor[5];
    $colorcinco = $arregloColor[6];
}
$taxes  = $costos;
$part = explode("|", $taxes);
$precioBase = $part[0];
$precioMedio = $part[1];
$precioLargo = $part[2];
$tiempoComi = $part[3];

$query_Cat = "SELECT category FROM `data` WHERE category != 'null' AND session = '$nameP' GROUP BY category";
$sqlCat = mysqli_query($con, $query_Cat);

$query_Tienda = "SELECT * FROM `temasTienda` WHERE `temasTienda`.`userId` = '$idTienda'";
$sqlTiend = mysqli_query($con, $query_Tienda);
while ($arregloTien = mysqli_fetch_array($sqlTiend)) {
    $theme = $arregloTien[2];
}
if ($nameP == $_SESSION['nombre']) {
    $ColorValidate = 1;
}

if ($_SESSION['paginitaURL']) {
    unset($_SESSION['paginitaURL']);
} else {
    if ($theme == '4') {
        # code...
    } else {
        $_SESSION['paginitaURL'] = $idTienda;
    }
}

switch ($theme) {
    case '1':
        require_once("themes/original.php");
        break;
    case '2':
        require_once("themes/viajes.php");
        break;
    case '3':
        require_once("themes/pizzeria.php");
        break;
    case '4':
        require_once("themes/buscador.php");
        break;
    case '5':
        require_once("themes/areaEstudio.php");
        break;
    case '6':
        require_once("themes/webflyer.php");
        break;
    case '7':
        require_once("themes/vapers.php");
        break;

    default:
        require_once("themes/original.php");
        break;
}

?>