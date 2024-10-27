<?php
session_start();
require('core.php');
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$name = (isset($_POST['keyy']) ? $_POST['keyy'] : null);
$serial = (isset($_POST['serial']) ? $_POST['serial'] : null);
$session = (isset($_POST['session']) ? $_POST['session'] : null);
/* $link = (isset($_POST['img']) ? $_POST['img'] : null); */

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

        $link = "https://" . $host . "/digitalmenu/objets/images/" . $nameArch;
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


$query = "INSERT INTO `data` (`id`, `number`, `keyy`, `link`, `session`) VALUES (NULL, '$serial', '$name', '$link', '$session');";
$queryE = "DELETE FROM `data` WHERE `data`.`id` = $id";
$query_b = "SELECT * FROM `data` WHERE session = '$session';";
$sql_ER = mysqli_query($con, $queryE);
if (empty($name && $serial)) {

    $sql_b = mysqli_query($con, $query_b);
    ?>
    <html>
    <div class="table-responsive">
        <table id="example" class=" table-">
            <thead>
                <tr>
                    <th>Precio</th>
                    <th>Producto</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($arreglo = mysqli_fetch_array($sql_b)) {
                ?>
                    <tr>

                        <td style="color: black;">$<?php echo $arreglo[1]; ?></td>
                        <td style="color: black;"><?php echo $arreglo[2]; ?>
                            <br>
                            <center>
                                <form id="sendBP<?php echo $arreglo[0] ?>" action="./objets/borrarP.php" method="POST">
                                    <input type="hidden" value="<?php echo $arreglo[0] ?>" name="id">
                                    <input type="hidden" value="<?= $arreglo[4] ?>" name="session" >
                                    <button type="submit" id="btnBP<?php echo $arreglo[0] ?>" class="btn boxshadowD btn-warning " style="margin-top: 10px;">
                                        <i class="fas fa-eraser"></i> Borrar
                                    </button>
                                    <script type="text/javascript">
            $(document).ready(function() {
              $("#sendBP<?php echo $arreglo[0] ?>").bind("submit", function() {
                // Capturamnos el boton de envío
                var btnEnviar = $("#btnBP<?php echo $arreglo[0] ?>");
                $.ajax({
                  type: $(this).attr("method"),
                  url: $(this).attr("action"),
                  data: $(this).serialize(),
                  beforeSend: function() {
                    /*
                     * Esta función se ejecuta durante el envió de la petición al
                     * servidor.
                     * */
                    // btnEnviar.text("Enviando"); Para button 
                    btnEnviar.val("Enviando"); // Para input de tipo button
                    btnEnviar.attr("disabled", "disabled");
                  },
                  complete: function(data) {
                    /*
                     * Se ejecuta al termino de la petición
                     * */
                    btnEnviar.val("Iniciar");
                    btnEnviar.removeAttr("disabled");
                  },
                  success: function(data) {
                    /*
                     * Se ejecuta cuando termina la petición y esta ha sido
                     * correcta
                     * */

                    $(".respuesta").html(data);

                  },
                  error: function(data) {
                    /*
                     * Se ejecuta si la peticón ha sido erronea
                     * */
                    alert("Problemas al tratar de enviar el formulario");
                  }
                });
                // Nos permite cancelar el envio del formulario
                return false;
              });
            });
          </script>
                                </form>
                                <br>
                            </center>
                        </td>
                        <td style="color: black;"> <img width="100px" src="<?php echo $arreglo[3]; ?>" class="img-fluid" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt=""></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <center><a href="objets/trash.php" class="btn btn-danger boxshadowD">Limpiar TODO <i class="fas fa-trash"></i></a><br>
        <small>Este botón use con precaución</small>
    </center>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    </html>
<?php
} else {


    $sql = mysqli_query($con, $query);
    $sql_b = mysqli_query($con, $query_b);
?>
    <html>
    <div class="table-responsive">
        <table id="example" class=" table-">
            <thead>
                <tr>
                    <th>Precio</th>
                    <th>Producto</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($arreglo = mysqli_fetch_array($sql_b)) {
                ?>
                    <tr>

                        <td style="color: black;">$<?php echo $arreglo[1]; ?></td>
                        <td style="color: black;"><?php echo $arreglo[2]; ?>
                            <br>
                            <center>
                                <form id="sendBP<?php echo $arreglo[0] ?>" action="./objets/borrarP.php" method="POST">
                                    <input type="hidden" value="<?php echo $arreglo[0] ?>" name="id">
                                    <input type="hidden" value="<?= $arreglo[4] ?>" name="session" >
                                    <button type="submit" id="btnBP<?php echo $arreglo[0] ?>" class="btn boxshadowD btn-warning " style="margin-top: 10px;">
                                        <i class="fas fa-eraser"></i> Borrar
                                    </button>
                                    <script type="text/javascript">
            $(document).ready(function() {
              $("#sendBP<?php echo $arreglo[0] ?>").bind("submit", function() {
                // Capturamnos el boton de envío
                var btnEnviar = $("#btnBP<?php echo $arreglo[0] ?>");
                $.ajax({
                  type: $(this).attr("method"),
                  url: $(this).attr("action"),
                  data: $(this).serialize(),
                  beforeSend: function() {
                    /*
                     * Esta función se ejecuta durante el envió de la petición al
                     * servidor.
                     * */
                    // btnEnviar.text("Enviando"); Para button 
                    btnEnviar.val("Enviando"); // Para input de tipo button
                    btnEnviar.attr("disabled", "disabled");
                  },
                  complete: function(data) {
                    /*
                     * Se ejecuta al termino de la petición
                     * */
                    btnEnviar.val("Iniciar");
                    btnEnviar.removeAttr("disabled");
                  },
                  success: function(data) {
                    /*
                     * Se ejecuta cuando termina la petición y esta ha sido
                     * correcta
                     * */

                    $(".respuesta").html(data);

                  },
                  error: function(data) {
                    /*
                     * Se ejecuta si la peticón ha sido erronea
                     * */
                    alert("Problemas al tratar de enviar el formulario");
                  }
                });
                // Nos permite cancelar el envio del formulario
                return false;
              });
            });
          </script>
                                </form>
                                <br>
                            </center>
                        </td>
                        <td style="color: black;"> <img width="100px" src="<?php echo $arreglo[3]; ?>" class="img-fluid" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt=""></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>

    </html>
<?php
}


if ($sql_b == null) {
?>
    <html>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> <a class="alert-link">Registro invalido</a> Intente de nuevo.
    </div>

    </html>

<?php
}

?>