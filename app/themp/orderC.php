<?php

require './PHPMailer/PHPMailer-master/src/Exception.php';
require './PHPMailer/PHPMailer-master/src/PHPMailer.php';
require './PHPMailer/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();
require('objets/core.php');
date_default_timezone_set('America/Mexico_City');
$fecha = strftime("%Y-%m-%d");
$order = (isset($_POST['order']) ? $_POST['order'] : null);
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
$lat = (isset($_POST['lat']) ? $_POST['lat'] : null);
$long = (isset($_POST['long']) ? $_POST['long'] : null);
$tot = (isset($_POST['tot']) ? $_POST['tot'] : null);
$totEnv = (isset($_POST['totEnv']) ? $_POST['totEnv'] : null);
$nameU = (isset($_POST['nameU']) ? $_POST['nameU'] : null);
$tel = (isset($_POST['tel']) ? $_POST['tel'] : null);
$realValue = $price * $value;
$query = "UPDATE `cart` SET `orderC` = '$order', `status` = '2' WHERE `cart`.`user` = '$session' AND `cart`.`variation` = '$serial' AND `cart`.`status` = '0';";
$sqlSele = mysqli_query($con, $query);
$fecha_actual = new DateTime();
$fecha_formateada = $fecha_actual->format($fecha);

$queryOrd = "INSERT INTO `ordenCompra` (`id`, `order`, `tel`, `serial`, `session`, `lat`, `long`, `total`, `totEnvio`, `nombre`, `date`) VALUES (NULL, '$order', '$tel', '$serial', '$session', '$lat', '$long', '$tot', '$totEnv', '$nameU','$fecha_formateada');";
$sqlOrd = mysqli_query($con, $queryOrd);
/* correo */
$_SESSION['orderUser'] = $order;

$queryNuevo = "SELECT * FROM `masDatosdeTienda` A INNER JOIN liks B ON B.id = A.idTienda INNER JOIN log C ON C.name = B.createdby LEFT JOIN deviceId D ON D.idLog = C.id WHERE B.serial = '$serial'";
$sqlNuevo = mysqli_query($con, $queryNuevo);

$sqlMailDom = "SELECT name FROM `cart` A INNER JOIN log B ON A.dom = B.name WHERE A.variation = '$serial'";
$queryMailDom = mysqli_query($con, $sqlMailDom);
while ($array = mysqli_fetch_array($queryMailDom)) {
    $mailDom = $array[0];
}
while ($array2 = mysqli_fetch_array($sqlNuevo)) {
    $transf1 = $array2["transf1"];
    $transf2 = $array2["transf2"];
    $nameBanc1 = $array2["nameBanc1"];
    $nameBanc2 = $array2["nameBanc2"];
    $namePrope1 = $array2["namePrope1"];
    $namePrope2 = $array2["namePrope2"];
    $token = $array2["token"];
}
$mail = new PHPMailer(true);
try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'notificaciones@rutadelaseda.xyz';
    $mail->Password = 'Huzidrago666&';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Detalles del mensaje
    $mail->setFrom('notificaciones@rutadelaseda.xyz', 'Orden de compra');
    $mail->Subject = 'Orden de compra';
    $mail->Body = "Se realizo una orden de compra de " . $tot . " a nombre de " . $nameU . " Con el No. " . $order;



    $mail->addAddress($mailDom);


    // Enviar el correo
    $mail->send();
    $status = 'Correo enviado correctamente';
} catch (Exception $e) {
    $status =  'Error al enviar el correo: ' . $mail->ErrorInfo;
}

?>
<div class="col-12">
    <div class="alert  alert-success mb-3" role="alert">

        <br>
        <strong>Orden de compra enviada con el número: <?= $order ?><br></strong>
        <br>
        <input type="text" class="form-control col-12" readonly value="<?= $order ?>" id="orderInputCopy">
        <br>
        <a name="" id="" class="btn btn-primary btn-block" href="smarticket.php?order=<?= $order ?>" role="button">Ver Estado del pedido</a>

        <a name="" id="" class="btn btn-secondary btn-block mt-3" href="https://rutadelaseda.xyz/" role="button">Seguir explorando <i class="fas fa-binoculars"></i></a>
        <hr>
        <p class="mb-0">En un momento el vendedor se pondrá en contacto con usted o en su defecto puede avisarle con el boton <b> Enviar mensaje.</b></p>
        

    </div>
</div>
<script>
    enviarNotificac("<?=$token?>");
</script>