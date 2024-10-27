<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$name = (isset($_POST['kei']) ? $_POST['kei'] : null);
$time = (isset($_POST['time']) ? $_POST['time'] : null);
$phone = (isset($_POST['phones']) ? $_POST['phones'] : null);
$sessionN = (isset($_POST['session']) ? $_POST['session'] : null);
$type = (isset($_POST['type']) ? $_POST['type'] : null);
$cat = (isset($_POST['cat']) ? $_POST['cat'] : null);
$locales = (isset($_POST['locales']) ? $_POST['locales'] : null);
$color = (isset($_POST['color']) ? $_POST['color'] : null);
$logocat = (isset($_POST['logocat']) ? $_POST['logocat'] : null);
$map = (isset($_POST['map']) ? $_POST['map'] : null);
$logocatjpg = (isset($_POST['logocatjpg']) ? $_POST['logocatjpg'] : null);
$paypalkey = (isset($_POST['paypalkey']) ? $_POST['paypalkey'] : null);
$latitude = (isset($_POST['latitude']) ? $_POST['latitude'] : null);
$longitude = (isset($_POST['longitude']) ? $_POST['longitude'] : null);
$fecha = strftime("%Y-%m-%d %T");
$uri = $_SERVER['REQUEST_URI'];
$uriParts = explode('/', $uri);
$fechaFormated = new DateTime($fecha);
switch ($time) {
  case '1':
    $fechaFormated->modify('+10 minutes');
    break;
  case '2':
    $fechaFormated->modify('+30 minutes');
    break;
  case '3':
    $fechaFormated->modify('+1 hour');
    break;
  case '4':
    $fechaFormated->modify('+12 hour');
    break;
  case '5':
    $fechaFormated->modify('+1 day');
    break;
  case '6':
    $fechaFormated->modify('+1 month');
    break;
  case '7':
    $fechaFormated->modify('+1 year');
    break;
  case '8':
    $fechaFormated->modify('+5 day');
    break;

  default:
    # code...
    break;
}

$FInicioFormat = $fechaFormated->format('d-m-Y H:i:s');

/* generador */
if ($phone == null) {
} else {
  $rand = rand(1, 999);
  $sessionID = session_id();
  $geberate = $sessionID . $rand;
  $name = $geberate;
}


/* $query_b = "TRUNCATE TABLE `liks`"; */
$query = "INSERT INTO `liks` (`id`, `serial`, `time`, `phone`, `session`, `createdby`, `type`, `category`, `adress`, `color`, `logo`, `locales`, `logojpg`, `paypal`, `lat`, `long`) VALUES (NULL, '$name', '$FInicioFormat', '$phone', NULL, '$sessionN', '$type', '$cat', '$locales', '$color', '$logocat', '$map', '$logocatjpg', '$paypalkey', '$latitude', '$longitude');";

$querySe = "SELECT * FROM `liks` WHERE createdby = '$sessionN'";

$querySele = "SELECT * FROM `liks` WHERE serial = '$name'";

$sqlSele = mysqli_query($con, $querySele);



$count = mysqli_num_rows($sqlSele);

if (empty($name && $time)) {
  echo 'no var';
} else {

  /* $sql_t = mysqli_query($con, $query_b); */
  if ($count > 0) {
?>
    <div class="alert alert-warning" role="alert">
      <strong>Ya ah sido creado un link con la misma clave, vuelve a generar el codigo.</strong>
    </div>
  <?php
  } else {
    $sql = mysqli_query($con, $query);

  ?>

    <center>
      <div class="form-group">

        <input type="text" class="form-control" name="" id="link" value="<?php echo $_SERVER['SERVER_NAME']. '/themp/page.php?id=' . $name; ?>%26<?= $sessionN ?>" aria-describedby="helpId" placeholder="">

      </div>
      <br>
      <center>
        <?php


        require('../phpqrcode/qrlib.php');
        $dir = 'temp/';
        if (!file_exists($dir))
          mkdir($dir);
        $filename = $dir . $name . $sessionN . '.png';
        $tamanio = 5;
        $level = 'M';
        $frameSize = 0;
        $urlCompleta = "https" . '://' . $serverName;
        $contenido = $urlCompleta.'/themp/page.php?id=' . $name . '%26' . $sessionN;
        QRcode::png($contenido, $filename, $level, $tamanio, $frameSize);
        ?>
        <img src="<?= 'objets/' . $filename ?>">

      </center>
      <br>
      <div class="alert alert-success" role="alert">
        <strong>LINK CREADO CORRECTAMENTE</strong>
        <br>
        <button type="button" onclick="copyToClipBoard()" class="btn btn-primary">COPIAR CODIGO</button>
      </div>
      <script>
        function copyToClipBoard() {

          var content = document.getElementById('link');

          content.select();
          document.execCommand('copy');

          alert("LINK COPIADO!");
        }
      </script>
    </center>

    <br>

<?php
  }
}
?>

<br>