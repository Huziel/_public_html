<?php
session_start();
require('validate_session.php');
require('core.php');
$session = $_SESSION['nombre'];
$query = "DELETE FROM `data` WHERE `data`.`session` = '$session'";
$query_b = "DELETE FROM `liks` WHERE `liks`.`createdby` = '$session'";
$sql = mysqli_query($con, $query);
$sql = mysqli_query($con, $query_b);
/* $files = glob('images/*'); */ //obtenemos todos los nombres de los ficheros
/* foreach($files as $file){ */
   /*  if(is_file($file)) */
    /* unlink($file); */ //elimino el fichero
/* } */
echo "<script>location.href='../home.php'</script>";