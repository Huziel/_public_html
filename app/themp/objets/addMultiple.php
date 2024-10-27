<body onLoad="setTimeout('window.close()',5000)">
<?php
session_start();
require('core.php');

$name = (isset($_POST['keyy']) ? $_POST['keyy'] : null);
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
$dscr = (isset($_POST['dscr']) ? $_POST['dscr'] : null);
$vari = (isset($_POST['vari']) ? $_POST['vari'] : null);

$host = $_SERVER["HTTP_HOST"];
$url = $_SERVER["REQUEST_URI"];

if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")
) {
    $nameArch = $session . $_FILES['file']['name'];
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "images/" . $nameArch)) {
        //more code here...

        $link = "https://" . $host . "/themp/objets/images/" . $nameArch;
?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Correcto!</strong> <a class="alert-link">Registro completo</a>.
        </div>
    <?php
        /* echo "images/".$_FILES['img']['name']; */
    } else {
    ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> <a class="alert-link">Archivo no subido</a>.
        </div>
    <?php
    }
} else {
    if (empty($name && $serial)) {
    ?>
        <div class="alert alert-dismissible alert-info">
            <button type="button" class="close" data-dismiss="danger">&times;</button>
            <strong>Mostrando información!</strong>.
        </div>
    <?php
    } else {
    ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="danger">&times;</button>
            <strong>Error!</strong> <a class="alert-link">Archivo no compatible o faltante</a>.
        </div>
<?php
    }
}

$query = "INSERT INTO `data` (`id`, `number`, `keyy`, `link`, `session`, `dscr`, `var`) VALUES (NULL, '$serial', '$name', '$link', '$session', '$dscr', '$vari');";
$query_b = "SELECT * FROM `data` WHERE session = '$session' ORDER BY ID DESC LIMIT 1  ";
$sql = mysqli_query($con, $query);
$sql_b = mysqli_query($con, $query_b);
while ($arreglo = mysqli_fetch_array($sql_b)) {
    $idP = $arreglo[0];
}

//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name) {
    //Validamos que el archivo exista
    if ($_FILES["archivo"]["name"][$key]) {
        $filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
        $source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

        $directorio = 'docs/'; //Declaramos un  variable con la ruta donde guardaremos los archivos

        //Validamos si la ruta de destino existe, en caso de no existir la creamos
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
        }

        $dir = opendir($directorio); //Abrimos el directorio de destino
        $target_path = $directorio . '/' .$session.$filename; //Indicamos la ruta de destino, así como el nombre del archivo

        //Movemos y validamos que el archivo se haya cargado correctamente
        //El primer campo es el origen y el segundo el destino
        if (move_uploaded_file($source, $target_path)) {
            $link = "https://" . $host . "/themp/objets/docs/" .$session.$filename;
            $queryIMG = "INSERT INTO `img` (`id`, `picture`, `dom`, `product`) VALUES (NULL, '$link', '$session', '$idP');";
            $sql_img = mysqli_query($con, $queryIMG);
            echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
        } else {
            echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
        }
        closedir($dir); //Cerramos el directorio de destino
    }
}
