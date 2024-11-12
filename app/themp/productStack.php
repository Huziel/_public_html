<?php
require('./objets/core.php');
session_start();
$session_id = session_id();
date_default_timezone_set('America/Mexico_City');
$fecha = strftime("%Y-%m-%d %T");
$id = (isset($_POST['id']) ? $_POST['id'] : null);
$sessionN = (isset($_POST['session']) ? $_POST['session'] : null);
$sessionX = (isset($_POST['sessionx']) ? $_POST['sessionx'] : null);
$query_v = "SELECT * FROM `data` WHERE id = '$id' AND session = '$sessionN';";
$query_p = "SELECT * FROM `img` WHERE product = '$id';";
$query_A = "SELECT * FROM `aditivos` WHERE idProd = '$id'";
$sql = mysqli_query($con, $query_v);
$sql_p = mysqli_query($con, $query_p);
$sql_A = mysqli_query($con, $query_A);
$count = mysqli_num_rows($sql);
if ($count > 0) {
    while ($array = mysqli_fetch_array($sql)) {
        $id = $array[0];
        $price = $array[1];
        $name = $array[2];
        $picture = $array[3];
        $descr = $array[5];
    }
    $query_var = "SELECT * FROM `data` WHERE session = '$sessionN' AND keyy = '$name';";
    $sql_var = mysqli_query($con, $query_var);

?>
    <link href="lightbox2-2.11.3/src/css/lightbox.css" rel="stylesheet" />
    <section class="py-5 bg-light container menuC">
        <div class="row">
            <div class="col-12 col-md-4">
                <a href="<?php echo $picture; ?>" data-lightbox="roadtrip">
                    <img src="<?php echo $picture; ?>" style="border-radius: 10px;" class="card-img-top" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="">

                </a>

                <div class="row" style="margin-top: 15px;">

                    <?php
                    while ($array = mysqli_fetch_array($sql_p)) {
                    ?>
                        <div class="col-4 col-md-4">
                            <a href="<?php echo $array[1]; ?>" data-lightbox="roadtrip">
                                <img src="<?php echo $array[1]; ?>" style="border-radius: 10px;" class="card-img-top" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="">

                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <br>
                <h2><?= $name ?></h2>
                <hr>
                <br>
                <h3>$<?= $price ?> MXN.</h3>
                <br>
                <p><?= $descr ?></p>

                <br>
                <form id="addForm" action="addProduct.php" method="post">
                    <input type="hidden" name="name" value="<?= $id ?>">
                    <input type="hidden" name="price" value="<?= $price ?>">
                    <input type="hidden" name="dom" value="<?= $sessionN ?>">
                    <input type="hidden" name="domSession" value="<?= $sessionX ?>">
                    <input type="hidden" name="session" value="<?= $session_id ?>">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Añadidos</label>
                            <?php
                            while ($array_A = mysqli_fetch_array($sql_A)) {
                                $value = $array_A['id'];
                            ?>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="<?= $value ?>-<?= $array_A['precio'] ?>" id="checkbox_<?= $value ?>" onchange="actualizarArray(this)">
                                    <label class="form-check-label" for="checkbox_<?= $value ?>">
                                        <?= $array_A['nombre'] ?> <i class="fas fa-chevron-right"></i> <?= $array_A['descripcion'] ?> <i class="fas fa-chevron-right"></i> $<?= $array_A['precio'] ?>
                                    </label>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" onclick="restar()" class="btn btn-primary">-</button>
                                    </div>
                                    <input type="number" name="value" id="valor" min="1" value="1" class="form-control" placeholder="Cantidad">
                                    <div class="input-group-append">
                                        <button type="button" onclick="sumar()" class="btn btn-primary">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <button id="addForm" type="submit" class="btn btn-outline-dark btn-block boxshadowD animate__animated animate__infinite infinite animate__pulse">Agregar a carrito <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>

                    <br>
                </form>

                <center>
                    <button type="button" name="" id="" onclick="shareProduct('<?= $id ?>')" class="btn btn-secondary btn-lg btn-block mt-3 mb-3 text-bg-primary">Compartir producto <i class="fas fa-share-alt"></i></button>
                    <div class="resP"></div>
                </center>

                <script>
                    let arraySeleccionados = [];

                    function actualizarArray(checkbox) {
                        const value = checkbox.value;

                        if (checkbox.checked) {
                            // Si el checkbox se selecciona, añade el valor al array
                            arraySeleccionados.push(value);
                        } else {
                            // Si el checkbox se deselecciona, remueve el valor del array
                            arraySeleccionados = arraySeleccionados.filter(item => item !== value);
                        }

                        // Muestra el array actualizado en la consola para verificar
                    }

                    function sumar() {
                        // Obtener el valor actual del input
                        var inputValor = document.getElementById("valor");
                        var valor = parseInt(inputValor.value);

                        // Sumar 1 al valor
                        valor = valor + 1;

                        // Actualizar el valor en el input
                        inputValor.value = valor;
                    }

                    function restar() {
                        // Obtener el valor actual del input
                        var inputValor = document.getElementById("valor");
                        var valor = parseInt(inputValor.value);

                        // Restar 1 al valor
                        valor = valor - 1;

                        // Actualizar el valor en el input
                        inputValor.value = valor;
                    }
                </script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $("#valor").on("change", function() {
                            // Obtiene el valor del input
                            var valor = $(this).val();
                            // Si el valor es menor que cero, lo establece como cero
                            if (valor < 0) {
                                $(this).val(0);
                            }
                        });
                        $("#addForm").bind("submit", function() {
                            var inputSuma = $("#valor").val();
                            if (inputSuma < 0) {
                                Swal.fire({
                                    title: "!Valor negativo!",

                                    icon: "error",
                                    confirmButtonText: "Ok",
                                });

                            } else { // Capturamnos el boton de envío
                                var btnEnviar = $("#btnEnviar2");
                                $.ajax({
                                    type: $(this).attr("method"),
                                    url: $(this).attr("action"),
                                    data: $(this).serialize() + "&seleccionados=" + JSON.stringify(arraySeleccionados),
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
                                        arraySeleccionados = [];
                                        /*
                                         * Se ejecuta cuando termina la petición y esta ha sido
                                         * correcta
                                         * */

                                        $(".resP").html(data);
                                        counPrs();

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
                            }

                        });
                    });
                </script>


            </div>
            <div class="col-12">
                <center>
                    <h3>Opciones</h3>
                    <hr>
                </center>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-5 justify-content-center">
                    <?php
                    while ($array = mysqli_fetch_array($sql_var)) {
                    ?>
                        <div class="col-6 col-md-4">


                            <div class="card boxes animate__animated animate__flipInX">

                                <!-- Product image-->
                                <a onclick="showP('<?= $sessionX ?>','<?= $sessionN ?>','<?php echo $array[0]; ?>')">
                                    <img src="<?php echo $array[3]; ?>" style="border-radius: 10px;" class="card-img-top" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'" alt="">

                                </a>

                                <!-- Product details-->


                            </div>

                            <div class=" mt-3">
                                <!-- Product name-->
                                <h4 class="fw-bolder fs-6">MX$<?php echo $array[1]; ?></h4>
                                <p><?php echo $array[2]; ?> <?php echo $array['var']; ?></p>
                                <br>

                                <!-- Product price-->

                            </div>

                        </div>



                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <script src="lightbox2-2.11.3/src/js/lightbox.js"></script>
<?php

} else {

?>
    <div class="alert alert-danger" role="alert">
        <strong>CONTENIDO NO DISPONIBLE :(</strong>
    </div>
<?php
}
?>