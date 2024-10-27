<?php
session_start();
require('core.php');
$username = (isset($_POST['correo']) ? $_POST['correo'] : null);
$pass = (isset($_POST['pass']) ? $_POST['pass'] : null);
$searchString = " ";
$replaceString = "";
$username = str_replace($searchString, $replaceString, $username); 
$query = "SELECT * FROM log WHERE name = '$username'";
$sql = mysqli_query($con, $query);

if ($f = mysqli_fetch_assoc($sql)) {
	if (password_verify($pass, $f['keyvalue'])) {
		echo 'Inicio correcto';
		$_SESSION['id'] = $f['id'];
		$_SESSION['nombre'] = $f['name'];
		$_SESSION['types'] = $f['type'];
		echo "<script>location.href='./home'</script>";
	} else {
?>
		<html>
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<strong>Error!</strong> <a class="alert-link">Contraseña invalida</a> Intente de
			nuevo.
		</div>

		</html>
<?php
	}
} else {
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$queryInsert = "INSERT INTO `log` (`id`, `name`, `keyvalue`) VALUES (NULL, '$username', '$hash')";
	$sqlInsert = mysqli_query($con, $queryInsert);
	echo 'Inicio correcto';
	$_SESSION['nombre'] = $username;
	echo "<script>location.href='./home'</script>";
} ?>