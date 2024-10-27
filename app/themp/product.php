<!DOCTYPE html>
<html lang="en">
<?php
session_start();

$idSession = session_id();
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$sessionN = (isset($_GET['session']) ? $_GET['session'] : null);
$keyP = (isset($_GET['pr']) ? $_GET['pr'] : null);

require('./objets/core.php');

$query_v = "SELECT * FROM `liks` WHERE serial = '$id';";
$queryUp = "UPDATE `liks` SET `session` = '$idSession' WHERE `liks`.`serial` = '$id'";
$sql = mysqli_query($con, $query_v);

while ($arreglo = mysqli_fetch_array($sql)) {
    $number = $arreglo[3];
    $session = $arreglo[4];
    $logo = $arreglo[12];
    $nameP = $arreglo[5];
    $colorBack = $arreglo[9];
}

?>




<br>
<div class="viewPS"></div>





</html>

<script>
    function viewP() {

        $.ajax({
            type: 'POST',
            url: 'productStack.php',
            data: {
                id: "<?= $keyP ?>",
                session: "<?= $sessionN ?>",
                sessionx: "<?= $id ?>"
            },
            dataType: "html",
            asycn: false,
            beforeSend: function() {

            },
            complete: function(data) {

            },
            success: function(data) {

                $(".viewPS").html(data);
            },
            error: function(data) {

                alert("Problemas al tratar de enviar el formulario");
            },
        });
    };
    window.onload = viewP();
    /* setInterval(viewP, 90000); */
  
</script>

