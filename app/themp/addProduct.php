<?php
require('objets/core.php');
$name = (isset($_POST['name']) ? $_POST['name'] : null);
$price = (isset($_POST['price']) ? $_POST['price'] : null);
$dom = (isset($_POST['dom']) ? $_POST['dom'] : null);
$domSession = (isset($_POST['domSession']) ? $_POST['domSession'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
$value = (isset($_POST['value']) ? $_POST['value'] : null);
$seleccionados = (isset($_POST['seleccionados']) ? $_POST['seleccionados'] : null);
$seleccionados = json_decode($seleccionados);
$realValue = $price * $value;
$query1 = "SELECT * FROM cart A LEFT JOIN cartAditivos B ON B.noOrder = A.id WHERE A.product = '$name' AND A.dom = '$dom' AND A.user = '$session' AND A.status = '0' AND B.id IS null";
$sqlSele1 = mysqli_query($con, $query1);

while ($array = mysqli_fetch_array($sqlSele1)) {
    $dato = $array[0];
    $cantidad = $array['cant'];
    $precio = $array['price'];
}
if ($dato && empty($seleccionados)) {
    $nuevaCantidad = $cantidad + $value;
    $nuevoPrecio = $precio + $price;
    $query2 = "UPDATE `cart` SET `cant` = '$nuevaCantidad', `price` = '$nuevoPrecio' WHERE `cart`.`id` = '$dato';";
    $sqlSele2 = mysqli_query($con, $query2);
} else {
    if (!empty($seleccionados)) {
        $suma = 0;
        foreach ($seleccionados as $valor) {
            $cadena = $valor;
            $partes = explode("-", $cadena);

            // Acceder a las partes
            $primeraParte = $partes[0]; // "objeto"
            $segundaParte = $partes[1];

            $suma += $segundaParte;
            // Aquí puedes trabajar con cada valor del array


        }
        $realsuma = $suma * $value;
        $valorRealIn = $realValue + $realsuma;
    } else {
        $valorRealIn = $realValue;
    }
    $query = "INSERT INTO `cart` (`id`, `product`, `price`, `dom`, `user`, `variation`, `cant`, `orderC`, `status`) VALUES (NULL, '$name', '$valorRealIn', '$dom', '$session', '$domSession', '$value', NULL, '0');";
    $sqlSele = mysqli_query($con, $query);
    $queryS = "SELECT * FROM `cart` WHERE product = '$name' AND dom = '$dom' AND user = '$session' AND status = '0'";
    $sqlSeleS = mysqli_query($con, $queryS);
    while ($array2 = mysqli_fetch_array($sqlSeleS)) {
        $dato2 = $array2[0];
    }
    if (!empty($seleccionados)) {

        foreach ($seleccionados as $valor) {
            $cadena = $valor;
            $partes = explode("-", $cadena);

            // Acceder a las partes
            $primeraParte = $partes[0]; // "objeto"
            $segundaParte = $partes[1];


            // Aquí puedes trabajar con cada valor del array

            $query = "INSERT INTO `cartAditivos` (`id`, `noOrder`, `idAditivo`, `session`) VALUES (NULL, '$dato2', '$primeraParte', '$session');";
            $sqlSele = mysqli_query($con, $query);
        }
    } else {
    }
}




?>
<div class="alert alert-success" role="alert" style="margin-top: 15px;">
    <strong>Producto agregado</strong>
    <br>
    <button type="button" class="btn btn-dark btn-block" onclick="closemodal()" data-dismiss="modal">Seguir viendo</button>
</div>