<?php
session_start();
require('core.php');
date_default_timezone_set('America/Mexico_City');
$id = (isset($_GET['ids']) ? $_GET['ids'] : null);


$sql = "SELECT * FROM `data` WHERE session = '$id' LIMIT 10";

$query = mysqli_query($con, $sql);
?>


<div class="container">
    <center>
        <section class="col-12 row" id="PT<?= $id ?>">
            <?php
            while ($arreglo = mysqli_fetch_array($query)) {
            ?>
                <div class="mt-3 col-6">
                    <div class="card h-100 boxes animate__animated animate__flipInX ">

                        <!-- Product image-->

                        <img src="<?php echo $arreglo[3]; ?>" class="card-img-top" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="">


                        <!-- Product details-->

                        <div class=" mt-3">
                            <!-- Product name-->
                            <p class="fw-bolder" style ="font-size: 10px">MX$<?php echo $arreglo[1]; ?></p>


                            <!-- Product price-->

                        </div>
                    </div>


                </div>
            <?php } ?>

        </section>
    </center>


</div>