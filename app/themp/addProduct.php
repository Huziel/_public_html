<?php
require('objets/core.php');
$name = (isset($_POST['name']) ? $_POST['name'] : null);
$price = (isset($_POST['price']) ? $_POST['price'] : null);
$dom = (isset($_POST['dom']) ? $_POST['dom'] : null);
$domSession = (isset($_POST['domSession']) ? $_POST['domSession'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
$value = (isset($_POST['value']) ? $_POST['value'] : null);

$realValue = $price * $value;
$query1 = "SELECT * FROM `cart` WHERE product = '$name' AND dom = '$dom' AND user = '$session' AND status = '0'";
$sqlSele1 = mysqli_query($con, $query1);
while ($array = mysqli_fetch_array($sqlSele1)) {
    $dato = $array[0];
    $cantidad = $array['cant'];
    $precio = $array['price'];
}
if ($dato) {
    $nuevaCantidad = $cantidad + $value;
    $nuevoPrecio = $precio + $price;
    $query2 = "UPDATE `cart` SET `cant` = '$nuevaCantidad', `price` = '$nuevoPrecio' WHERE `cart`.`id` = '$dato';";
    $sqlSele2 = mysqli_query($con, $query2);
} else {
    $query = "INSERT INTO `cart` (`id`, `product`, `price`, `dom`, `user`, `variation`, `cant`, `orderC`, `status`) VALUES (NULL, '$name', '$realValue', '$dom', '$session', '$domSession', '$value', NULL, '0');";
    $sqlSele = mysqli_query($con, $query);
}

?>
<div class="alert alert-success" role="alert" style="margin-top: 15px;">
    <strong>Producto agregado</strong>
    <br>
    <button type="button" class="btn btn-dark btn-block" onclick="closemodal()" data-dismiss="modal">Seguir viendo</button>
</div>