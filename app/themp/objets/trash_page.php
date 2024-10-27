<?php
require('validate_session.php');
require('core.php');
$query_b = "TRUNCATE TABLE `liks`";
$sql = mysqli_query($con, $query_b);
echo "<script>location.href='../page.php'</script>";