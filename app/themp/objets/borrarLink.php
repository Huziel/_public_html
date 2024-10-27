<?php
$host = "catflyer.tech";
$url = $_SERVER["REQUEST_URI"];
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_POST['id']) ? $_POST['id'] : null);

$sessionN = (isset($_POST['session']) ? $_POST['session'] : null);


/* $query_b = "TRUNCATE TABLE `liks`"; */
$query = "DELETE FROM `liks` WHERE `liks`.`id` = '$id'";

$querySe = "SELECT * FROM `liks` WHERE createdby = '$sessionN'";

$querySele = "SELECT * FROM `liks` WHERE serial = '$name'";
$sqlB = mysqli_query($con, $query);
$sqlSele = mysqli_query($con, $querySele);



$count = mysqli_num_rows($sqlSele);


?>

<center>
  <h3>Links creados</h3>
</center>
<div class="table-responsive">
  <table class="table">
    
    <tbody class="row">
      <?
      $sqlS = mysqli_query($con, $querySe);
      while ($arreglo = mysqli_fetch_array($sqlS)) {
      ?>
        <tr class=" col-12 col-md-6 ">
        <center>
          <td class=" col-12" >
           
              <div class="card" style="width: 120;">

                <div class="card-body">
                  <h5 class="card-title">Menu ID <?php echo $arreglo[0] ?></h5>
                  <h4>
                    WhatsApp: <?php echo $arreglo[3] ?>
                  </h4>
                  <p class="card-text">Tiempo de termino: <?php echo $arreglo[2] ?></p>
                  <div class="row">
                    <div class="col-6">
                      <a href="https://catflyer.tech/digitalmenu/protector.php?id=<?php echo $arreglo[1] ?>&session=<?php echo $sessionN; ?>" class="btn btn-primary"><i class="fas fa-bars"></i> Ver menú</a>

                    </div>
                    <div class="col-6">
                      <form id="sendB<?php echo $arreglo[0] ?>" action="./objets/borrarLink.php" method="POST">
                        <input type="hidden" value="<?php echo $arreglo[0] ?>" name="id">
                        <input type="hidden" value="<?php echo $sessionN ?>" name="session">
                        <button type="submit" id="btnB<?php echo $arreglo[0] ?>" class="btn btn-warning">
                        <i class="fas fa-eraser"></i> Borrar
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            

          </td>
          </center>
          <script type="text/javascript">
            $(document).ready(function() {
              $("#sendB<?php echo $arreglo[0] ?>").bind("submit", function() {
                // Capturamnos el boton de envío
                var btnEnviar = $("#btnB<?php echo $arreglo[0] ?>");
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

                    $(".respuesta2").html(data);

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
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<hr>
<br>