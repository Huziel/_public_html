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
if ($id) {
    $_SESSION['recoveredPage'] = $id;
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
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
        case '2':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/cyborg/bootstrap.min.css" integrity="sha512-M+Wrv9LTvQe81gFD2ZE3xxPTN5V2n1iLCXsldIxXvfs6tP+6VihBCwCMBkkjkQUZVmEHBsowb9Vqsq1et1teEg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
        case '3':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/litera/bootstrap.min.css" integrity="sha512-TUtnNUXMMWp2IALAR9t2z1vuorOUQL4dPWG3J9ANInEj6xu/rz5fzni/faoEGzuqeY1Z1yGD6COYAW72oiDVYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;

        case '4':
            require_once("themes/buscador.php");
            break;

        case '5':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/lux/bootstrap.rtl.min.css" integrity="sha512-HTAZCwhj2s2OzMZrBJX5D8qBhYXA2KAG5G983UY1D+zsWTwj/FBpiAijY8gG1XqSF8EyJlkue9BcjG2jlhxj9w==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;

        case '6':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/morph/bootstrap.rtl.min.css" integrity="sha512-36xw1AJG6E0yKDFXi1ZCuYvAjyH67M2nhVOmvTh3Y+zRm4TUHrmsh+Xz/jg+7qJPZoH3zf6PhMnK9hSRg2pIcw==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
        case '7':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/vapor/bootstrap.rtl.min.css" integrity="sha512-m7CK8cF5bdYJfX+UljSgkgzNUqtbs1+YlXGb3WwJQ7iUCohLD55fqi35zO9Bct8b/2GrbQNxjVXvkmuoDUXsKg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
        case '8':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/slate/bootstrap.rtl.min.css" integrity="sha512-8n7mJPYc1PYv0QSKTgmWUNAXc3ivx3bf1m2Pb/Dn+StJ8D69Hyxwq+aMw6NUreHzSMlwB6PqT5JBiDgUCyjIpg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
        case '333':
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/cyborg/bootstrap.min.css" integrity="sha512-M+Wrv9LTvQe81gFD2ZE3xxPTN5V2n1iLCXsldIxXvfs6tP+6VihBCwCMBkkjkQUZVmEHBsowb9Vqsq1et1teEg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/osiryx.php");
            break;

        default:
            $cdn = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />';
            $_SESSION['themeCDN'] = $cdn;
            require_once("themes/original.php");
            break;
    }
}

?>