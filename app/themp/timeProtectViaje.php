<?php
require('./objets/core.php');
session_start();
$session_id = session_id();
date_default_timezone_set('America/Mexico_City');
$fecha = strftime("%Y-%m-%d %T");
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$sessionN = (isset($_POST['session']) ? $_POST['session'] : null);
$wha = (isset($_POST['wha']) ? $_POST['wha'] : null);
$cat = (isset($_POST['cat']) ? $_POST['cat'] : null);

$query_v = "SELECT * FROM `liks` WHERE serial = '$id' AND createdby = '$sessionN';";
/* $query_d = "DELETE FROM `liks` WHERE serial = '$id' AND createdby = '$sessionN';"; */
$query_s = "UPDATE `liks` SET `session` = '$session_id' WHERE `liks`.`serial` = '$id';";
$sql = mysqli_query($con, $query_v);

$count = mysqli_num_rows($sql);

if ($count > 0) {

    while ($array = mysqli_fetch_array($sql)) {
        $times = $array[2];
        $phone = $array[3];
        $session = $array[4];
        $type = $array[6];
        $colorBack = $array['color'];
        $logo = $array['logo'];
        $local = $array['locales'];
        $logojpg = $array['logojpg'];
    }

    $horaTermino = new DateTime($times);
    $horaInicial = new DateTime($fecha);

    $interval = $horaInicial->diff($horaTermino);
    if ($horaInicial > $horaTermino) {
        $type = 10;
    }
    if ($cat == null) {
        $query = "SELECT * FROM `data` A LEFT JOIN stock B ON B.idProd = A.id WHERE session = '$sessionN' AND active = '1'";
    } else {
        $query = "SELECT * FROM `data` A LEFT JOIN stock B ON B.idProd = A.id WHERE session = '$sessionN' AND category = '$cat' AND active = '1'";
    }

    $sql = mysqli_query($con, $query);

    if ($session == NULL) {
        $sqlS = mysqli_query($con, $query_s);
    }
    $sqlComp = mysqli_query($con, $query_v);
    while ($array = mysqli_fetch_array($sqlComp)) {
        $session = $array[4];
    }
    if ($type == 2) {
        if ($session == $session_id) {
        } else {
?>
            <div class="alert alert-danger" role="alert">
                <strong>CONTENIDO NO DISPONIBLE1 :(</strong>
            </div>
        <?php
        }
    } elseif ($type == 10) {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>CONTENIDO NO DISPONIBLE2 :(</strong>
        </div>
    <?php
    } else {
    ?>


        <link href="lightbox2-2.11.3/src/css/lightbox.css" rel="stylesheet" />

        <body>


            <style>
                .image-container {
                    width: 100%;
                    height: 200px;
                    overflow: hidden;
                    position: relative;
                }

                .image-container img {
                    display: block;
                    width: 100%;
                    height: auto;
                }

                .text-overlay {
                    position: absolute;
                    bottom: 10px;
                    /* Ajusta la posición según tu preferencia */
                    left: 10px;
                    /* Ajusta la posición según tu preferencia */
                    background-color: rgba(0, 0, 0, 0.5);
                    /* Fondo semitransparente */
                    color: white;
                    padding: 5px;
                    border-radius: 3px;
                    font-size: 12px;
                }


                p {
                    font-size: 12px;
                }
            </style>
            <?php if ($sql && mysqli_num_rows($sql) > 0) {
                # code...
            ?>
                <section class="py-5 container-fluid bg-light " id="productsPageLoader">
                    <table id="table_id" class=" justify-content-center ">
                        <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-5 justify-content-center mt-5">

                            <?php
                            while ($arreglo = mysqli_fetch_array($sql)) {
                            ?>
                                <tr class="col">
                                    <td class="card h-75 boxes animate__animated animate__flipInX">
                                        <!-- Product image-->
                                        <a class="image-container" onclick="agregarRapido('<?php echo $arreglo[0] ?>','<?php echo $arreglo[1] ?>','<?php echo $arreglo[4] ?>','<?= $id ?>','<?= $session_id ?>','1')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <img src="<?php echo $arreglo[3]; ?>" class="img-fluid cropped-image" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="Imagen">
                                            <div class="text-overlay">
                                                <?php

                                                echo '<b>Servicio de cotización</b>';

                                                ?>
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            
                                            <p class="card-text"><?php echo $arreglo[2]; ?> <?php echo $arreglo['var']; ?></p>
                                            <div id="respuestaTab<?php echo $arreglo[0] ?>"></div>
                                        </div>
                                       
                                    </td>


                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                   

                </section>
                <script>
                    $(document).ready(function() {
                        $("#inputNombreViaje").hide();
                        $.extend(true, $.fn.dataTable.defaults, {
                            language: {
                                search: ""
                            }
                        });

                        oTable = $('#table_id').DataTable({
                            "dom": "ftip",
                            "language": {
                                "lengthMenu": "Display _MENU_ records per page",
                                "zeroRecords": "Nothing found - sorry",
                                "info": "Mostrando pagina _PAGE_ de _PAGES_",
                                "infoEmpty": "No records available",
                                "infoFiltered": "(filtered from _MAX_ total records)",
                                "paginate": {

                                    "next": ">",
                                    "previous": "<"
                                }
                            },


                        });
                        $('#myInputTextField').keyup(function() {
                            oTable.search($(this).val()).draw();
                        })


                    });

                    

                    function agregarRapido(name, price, dom, domSession, session, value) {
                        $("#agregarRapidoBTN" + name).html('<i class="fas fa-spinner fa-spin"></i>');
                        $("#respuestaTab" + name).show();
                        $('#agregarRapidoBTN' + name).prop('disabled', true);
                        $.ajax({
                            type: "POST",
                            url: "addProduct.php",
                            data: {
                                name,
                                price,
                                dom,
                                domSession,
                                session,
                                value
                            },
                            dataType: "html",
                            success: function(response) {
                                if (response) {
                                    console.log("1");


                                    $("#respuestaTab" + name).html('<center><i class="far fa-check-circle animate__animated animate__backInUp"></i></center>');

                                    counPrs();
                                    $("#table_id").hide();
                                    $("#table_id_wrapper").hide();
                                    $("#inputNombreViaje").show();

                                    function desaparecer() {
                                        $("#agregarRapidoBTN" + name).html('<i class="fas fa-cart-plus"></i>');
                                        $("#respuestaTab" + name).addClass('animate__animated animate__backOutDown').one('animationend', function() {
                                            // Esta función se ejecutará cuando la animación termine
                                            $(this).removeClass('animate__backOutDown'); // Elimina la clase de animación
                                            $(this).hide(); // Muestra el elemento
                                            $('#agregarRapidoBTN' + name).prop('disabled', false);
                                        });

                                    }
                                    setTimeout(desaparecer, 3000);
                                }
                            }
                        });
                    }
                </script>
            <?php } ?>

            <style>
                .sorting_asc {
                    display: none;
                }

                .dataTables_filter {
                    float: left !important;
                    padding-left: 15px;
                    width: 100%;
                }
            </style>
            <br>
            <br>
            <br>
        </body>
        <script src="lightbox2-2.11.3/src/js/lightbox.js"></script>

        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>



    <?php
    }
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        <strong>CONTENIDO NO DISPONIBLE3 :(</strong>
    </div>
<?php
}

?>