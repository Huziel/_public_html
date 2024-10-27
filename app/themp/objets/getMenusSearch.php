<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_GET['ids']) ? $_GET['ids'] : null);


$sql = "SELECT * FROM `data` WHERE session = '$id'";

$query = mysqli_query($con, $sql);
?>


<div class="container">
    <center>
    <section class="customer-logos slider col-12 cristal" id="PT<?=$id?>">
        <?php
        while ($arreglo = mysqli_fetch_array($query)) {
        ?>
            <div class="slide mt-3">
                <div class="card h-100 boxes animate__animated animate__flipInX">

                    <!-- Product image-->

                    <img src="<?php echo $arreglo[3]; ?>" class="card-img-top" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="">


                    <!-- Product details-->


                </div>

                <div class=" mt-3">
                    <!-- Product name-->
                    <h4 class="fw-bolder fs-6">MX$<?php echo $arreglo[1]; ?></h4>
                    

                    <!-- Product price-->

                </div>
            </div>
        <?php } ?>

    </section>
    </center>
    

</div>