<?php
session_start();
session_destroy();

require('core.php');
$query = "TRUNCATE TABLE `data`";
$query_b = "TRUNCATE TABLE `liks`";
$sql = mysqli_query($con, $query);
$sql = mysqli_query($con, $query_b);
echo "<script>location.href='../home.php'</script>";