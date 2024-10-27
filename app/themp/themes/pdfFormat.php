<head>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $nombreT ?>" />
    <meta property="og:description" content="<?= $text1 ?>" />
    <meta property="og:image" content="<?= $logo ?>" />
    <title><?= $nombreT ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= $logo ?>" />
    <!-- Bootstrap icons-->
    <!-- Core theme CSS (includes Bootstrap)-->
   

    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    
    <style>
        body {
            margin: 0;
            font: normal 75% Arial, Helvetica, sans-serif;
        }

        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }

        .boxes {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
                rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
        }

        .video-fluid {
            max-width: 100%;
            height: auto;
        }

        .py5 {
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.15);

            backdrop-filter: blur(5px);
        }

        .textC {
            color: #212529;
            margin: 0 auto;
            text-align: center;

            font: bold;
            text-shadow: -3px 2px 0 #ced4da;
        }

        .objetfit {
            position: absolute;
            left: -100%;
            right: -100%;
            top: -100%;
            bottom: -100%;
            margin: auto;
            min-height: 100%;
            min-width: 100%;
        }

        .tres {
            max-width: 50vw;
            max-height: 100px;
            background: #0ebeff;
            object-fit: contain;
            object-position: 50% 50%;
            box-shadow: 0 0 4px 1px rgba(0, 0, 0, 0.4);
            vertical-align: middle;
        }

        .menuC {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.8);

            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(13.7px);
            -webkit-backdrop-filter: blur(13.7px);
        }

        .estilo-x {
            font-size: calc(1em + 1vw);
            line-height: 1em;
            padding: 1em;
            margin: 1em;
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
        }

        body {
            overflow: hidden;
        }

        body {
            /*  background: rgb(122, 65, 201);
    background: linear-gradient(153deg, rgba(122, 65, 201, 1) 0%, rgba(205, 2, 157, 1) 51%, rgba(37, 19, 246, 1) 97%);
*/
            background-size: fixed;
        }

        .ParallaxVideo {
            height: 300px;
            padding-bottom: 50px;
            padding-top: 50px;

            overflow: hidden;
        }

        .ParallaxVideo video {
            min-width: 100%;
            position: fixed;
            top: 0;
            z-index: -99;
        }

        .ParallaxVideo h1 {
            color: #fff;
            font-size: 76px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
        }

        #table_id_filter {
            display: none;
        }

        .dataTables_filter input {
            width: 100%;
            height: 32px;
            background: #fcfcfc;
            border: 1px solid #aaa;
            border-radius: 5px;
            box-shadow: 0 0 3px #ccc, 0 10px 15px #ebebeb inset;
            text-indent: 10px;
            display: none;
        }

        .dataTables_filter .fa-search {
            position: absolute;
            top: 10px;
            left: auto;
            right: 10px;
            display: none;
        }

        .cristal {
            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            background-color: rgba(245, 245, 245, 0.5);

            backdrop-filter: blur(5px);
        }

        .imagenCircular {
            width: 70px;
            height: 70px;
            margin-top: 5px;
            margin-left: 5px;
            border-radius: 50%;
            /* Esto hace que la imagen tenga forma circular */
            overflow: hidden;

            /* Esto asegura que la imagen no se salga de su contenedor */
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset,
                rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset,
                rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px,
                rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px,
                rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px,
                rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }

        .imagenCircular img {
            width: 100%;
            /* Ajusta el tamaño de la imagen al contenedor */
            height: auto;
            /* Mantiene la proporción original de la imagen */
            display: block;
            /* Asegura que la imagen se muestre correctamente */
        }

        .redes-sociales {
            text-align: center;
            margin-top: 20px;
        }

        .redes-sociales a {
            color: #333;
            font-size: 24px;
            margin: 0 10px;
        }

        .redes-sociales a:hover {
            color: #007bff;
        }

        .rating {
            display: inline-block;
            unicode-bidi: bidi-override;
            direction: rtl;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            padding: 0 0.1em;
            cursor: pointer;
            font-size: 24px;
            color: #ccc;
        }

        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked~label {
            color: #ffcc00;
        }

        .color-input-container {
            display: flex;
            justify-content: center;

        }

        .pantone-card {
            background: #fff;
            display: grid;

            border-radius: 10px;
            box-shadow: 0 2px 4px #0001;
            border: 4px solid #fff;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            transition: box-shadow 0.27s ease-in-out, margin 0.3s ease-in-out;
        }

        .pantone-card:hover {
            box-shadow: 0 18px 16px -15px #0008, 0 2px 4px #0001;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        [type="color"] {
            display: inline-flex;
            vertical-align: bottom;
            border: none;
            border-radius: 10px;
            padding: 0;
            height: 50px;
            width: 100%;
            cursor: pointer;
        }

        [type="color"]::-webkit-color-swatch-wrapper {
            padding: 0;
        }

        [type="color"]::-webkit-color-swatch {
            border: 0;
            border-radius: 10px 10px 0 0;
        }

        [type="color"]::-moz-color-swatch {
            border: 0;
            border-radius: 10px 10px 0 0;
        }

        [type="color"]+output {
            display: block;
            background: #fff;
            font-size: 14px;
            padding: 16px;
            line-height: 1em;
            font-family: "helvetica", sans-serif;
        }


        .icon {
            font-size: 18px;
            /* Cambiar el tamaño de la tipografia */
            text-transform: uppercase;
            /* Texto en mayusculas */
            font-weight: bold;
            /* Fuente en negrita o bold */
            color: #ffffff;
            /* Color del texto */
            border-radius: 5px;
            /* Borde del boton */
            letter-spacing: 2px;
            /* Espacio entre letras */

            /* Color de fondo */
            padding: 24px 24px;
            /* Relleno del boton */
            position: fixed;
            bottom: 50vh;
            right: 40px;
            transition: all 300ms ease 0ms;

            z-index: 99;

            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.19);
            border-radius: 100%;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(6.4px);
            -webkit-backdrop-filter: blur(6.4px);
            border: 1px solid rgba(255, 255, 255, 0.14);
        }

        .left {
            left: 10px;
            right: auto;
        }

        .right {
            right: 10px;
            left: auto;
        }
    </style>
</head>

<!-- <div id="icon" class="icon animate__animated animate__pulse" style="display: none;">⬅️</div>
<div id="icon2" class="icon animate__animated animate__pulse" style="display: none;">⬅️</div> -->


<?php
$horarioArray = explode(",", trim($horario, "()"));
$NhorarioArray = array_slice($horarioArray, 2);
$Zarray = implode(", ", $NhorarioArray);

if ($banner) {
?>
    <div class=" text-center bg-image rounded-3 d-flex justify-content-center align-items-center" style="
    background-image: url('<?= $banner ?>');
    height: 100vh;
    border-radius: 16px;
    background-repeat: no-repeat; background-size: cover;
    background-position: center;
    
  ">
        <img id="imageLogon" src="<?= $banner ?>" alt="Imagen" crossorigin="anonymous" style="display: none;">
        <canvas id="canvas" style="display: none;"></canvas>
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 16px;">
            <div class="d-flex justify-content-center p-5 align-items-center h-100">
                <div class="text-white">
                    <center>
                        <div class="imagenCircular mb-3">
                            <img src="<?= $logo ?>" class="d-inline-block align-top" id="" alt="" crossorigin="anonymous">
                        </div>
                    </center>

                    <h4 class="text-light"><?= $nombreT ?></h4>
                    <p class="mb-3"><?= $text1 ?></p>
                    <br>
                    <h6 class="text-light mt-3">Horario: de <?= $horarioArray[0] ?> a <?= $horarioArray[1] ?> horas. <br>Dias de cierre: <?= $Zarray ?></h6>
                </div>
            </div>
        </div>
    </div>
<?php
}
if ($nota) {
?>

<?php
}
?>



<?php
if ($_SESSION['types']) {
?>

<?php
}
?>


<?php
if ($_SESSION['types']) {
?>

<?php
} else {
?>

<?php
}
?>




</html>
<script>
    $(document).ready(function() {
        $('#icon').hide();

        function staticButton() {
            var icon = $('#icon');
            var icon2 = $('#icon2');
            var listaCoordenadas = [
                <?php while ($arreglo = mysqli_fetch_array($sqlExtraPuntos)) { ?> {
                        id: "<?= $arreglo[0] ?>"
                    },
                <?php } ?>
            ];
            icon.show();
            icon.html('<a><i class="fas fa-genderless"></i></a>');
            icon.removeClass('right animate__animated animate__pulse animate__infinite').addClass('left animate__animated animate__pulse animate__infinite');
            if (misPuntitosLindos2(listaCoordenadas) > 0) {
                var id = misPuntitosLindos2(listaCoordenadas);
                icon.html('<a href="https://rutadelaseda.xyz/@' + id + '"><i class="fas fa-arrow-left"></i></a>');

            }
            icon2.show();
            icon2.html('<a><i class="fas fa-genderless"></i></a>');
            icon2.removeClass('left animate__animated animate__pulse animate__infinite').addClass('right animate__animated animate__pulse animate__infinite');
            if (misPuntitosLindos(listaCoordenadas) > 0) {
                var id2 = misPuntitosLindos(listaCoordenadas);
                icon2.html('<a href="https://rutadelaseda.xyz/@' + id2 + '"><i class="fas fa-arrow-right"></i></a>');

            }


        }
        staticButton();




        $('#shareButton').click(function() {
            const textToCopy = "https://rutadelaseda.xyz/@" + "<?= $idTienda ?>";

            navigator.clipboard.writeText(textToCopy).then(() => {
                Swal.fire("Enlace de la tienda copiado al portapapeles.");
            }).catch((error) => {
                console.error('Error al copiar el texto:', error);
            });
        });

        $("#buscarInputo").hide();

        <?php
        if ($ColorValidate == 1) {
        ?>
            $("#colorContainer").show();
        <?php
        } else {
        ?>
            $("#colorContainer").hide();
        <?php
        }
        ?>
        changeBootstrapColors();
        traerComentariosT();

    });

    function misPuntitosLindos(listaCoordenadas) {
        var targetId = "<?= $idTienda ?>";
        var found = false;
        for (var i = 0; i < listaCoordenadas.length; i++) {
            if (listaCoordenadas[i].id === targetId) {
                if (i + 1 < listaCoordenadas.length) {
                    return (listaCoordenadas[i + 1].id);
                } else {
                    return (0);
                }
                found = true;
                break;
            }
        }

        if (!found) {
            return (-1);
        }
    }

    function misPuntitosLindos2(listaCoordenadas) {
        var targetId = "<?= $idTienda ?>";
        var found = false;
        for (var i = 0; i < listaCoordenadas.length; i++) {
            if (listaCoordenadas[i].id === targetId) {
                if (i - 1 >= 0) {
                    return (listaCoordenadas[i - 1].id);
                } else {
                    return (0);
                }
                found = true;
                break;
            }
        }

        if (!found) {
            return (-1);
        }
    }





    function mostarSearch() {
        $("#nvarImg").hide();
        $("#buscarInputo").show();
    }

    function viewPList(cat) {
        $('.navbar-collapse').collapse('hide');
        $.ajax({
            type: 'POST',
            url: 'timerProtect.php',
            data: {
                id: "<?= $id ?>",
                session: "<?= $sessionN ?>",
                wha: "<?= $number ?>",
                cat: cat
            },
            dataType: "html",
            asycn: false,
            beforeSend: function() {

            },
            complete: function(data) {

            },
            success: function(data) {

                $(".viewPList").html(data);

            },
            error: function(data) {

                alert("Problemas al cargar");
            },
        });
    };
    window.onload = viewPList();
    /* setInterval(viewPList, 90000); */
</script>

<script type="text/javascript">
    function insertText() {
        var elem = document.getElementById("Select1").value;
        var elem2 = document.getElementById("product").value;
        var elem3 = document.getElementById("espef").value;
        var elem4 = document.getElementById("value").value;
        var actualText = $("#txt1").val();
        var newText = actualText + " " + elem2 + " cantidad: " + elem + " especificaciones: " + elem3 + "\n";
        var mul = elem * elem4;
        var elem5 = document.getElementById("txt2").value;
        var newText2 = Number(elem5) + Number(mul);
        $("#txt1").val(newText);
        $("#txt2").val(newText2);
        document.getElementById('numerin').innerHTML = ' ' + newText2;
    }
</script>
<script type="text/javascript">
    function insertText2(text, value) {
        var actualText = $("#product").val();
        var newText = text;
        var def = 0;
        var voi = "--";
        $("#product").val(newText);
        $("#value").val(value);
        $("#Select1").val(def);
        $("#esp").val(voi);

    }
</script>
<script type="text/javascript">
    $('.botonF1').hover(function() {
        $('.btn').addClass('animacionVer');
    })
    $('.contenedor').mouseleave(function() {
        $('.btn').removeClass('animacionVer');
    })
</script>
<script type="text/javascript">
    function closemodal() {
        $('#exampleModal').modal('toggle');
    }

    function closemodal2() {
        $('#exampleModal2').modal('toggle');
    }

    function showP(id, session, pr) {
        $("#exampleModal").modal('show');
        $(".responsess").empty();
        $.ajax({
            type: "get",
            url: "product.php",
            data: {
                id: id,
                session: session,
                pr: pr
            },
            dataType: "html",
            success: function(response) {
                // Función para cerrar cualquier modal
                function cerrarModal(selector) {
                    var modal = $(selector);
                    if (modal.hasClass('show')) {
                        modal.modal('hide');
                    }
                }

                // Agrega un evento al gesto de ir atrás en Android
                window.addEventListener('popstate', function() {
                    cerrarModal('.modal'); // Cierra cualquier modal con clase 'modal'
                });

                // Modifica el historial para que se active el evento popstate al ir atrás
                history.pushState({}, '');

                // Cierra el modal cuando se hace clic en el botón de cerrar del modal
                /* $('.modal').on('hidden.bs.modal', function() {
                    history.back(); // Simula el gesto de ir atrás para que se active el evento popstate
                }); */
                $(".responsess").html(response);
            }
        });
    }
</script>
<script>
    function counPrs() {
        $.ajax({
            type: "POST",
            url: "objets/countP.php",
            data: {
                serial: "<?= $serialC ?>"
            },
            dataType: "html",
            success: function(data) {
                if (data) {

                    $("#botonCanasta").prop('disabled', false);
                    $("#contadorCanasta").show();
                    $(".countPrs").html(data);
                } else {

                    $("#botonCanasta").prop('disabled', true);
                    $("#contadorCanasta").hide();

                }

            }
        });

    }
    window.onload = counPrs();
    setInterval(counPrs, 5000);

    function hiden() {
        $("#particles-js").fadeOut("slow");
        document.getElementsByTagName('body')[0].style.overflow = 'visible';
    }
    window.setTimeout(hiden, 1000);
</script>
<script>
    function viewTable() {
        $("#exampleModal2").modal('show');
        $(".responsessTable").empty();
        $.ajax({
            type: 'POST',
            url: 'cartTableTwo.php',
            data: {
                id: "<?= $idSession ?>",
                serial: "<?= $serialC ?>"
            },
            dataType: "html",
            asycn: false,
            beforeSend: function() {

            },
            complete: function(data) {

            },
            success: function(data) {
                function cerrarModal(selector) {
                    var modal = $(selector);
                    if (modal.hasClass('show')) {
                        modal.modal('hide');
                    }
                }

                // Agrega un evento al gesto de ir atrás en Android
                window.addEventListener('popstate', function() {
                    cerrarModal('.modal'); // Cierra cualquier modal con clase 'modal'
                });

                // Modifica el historial para que se active el evento popstate al ir atrás
                history.pushState({}, '');

                // Cierra el modal cuando se hace clic en el botón de cerrar del modal
                /* $('.modal').on('hidden.bs.modal', function() {
                    history.back(); // Simula el gesto de ir atrás para que se active el evento popstate
                }); */
                $(".responsessTable").html(data);
                counPrs();
            },
            error: function(data) {

                alert("Problemas al tratar de enviar el formulario");
            },
        });
    }

    function deleteAjax(id) {
        $.ajax({
            type: "POST",
            url: "deleteProduc.php",
            data: {
                id: id,
                session: "<?= $idSession ?>"
            },
            dataType: "html",
            success: function(response) {
                viewTable();
            }
        });
    }

    function guardarComentario() {
        var calificacion = $("input[name='rating']:checked").val();
        var comentario = $("#commentInput").val();

        // Validar que la calificación y el comentario estén presentes
        if (calificacion && comentario) {
            $.ajax({
                type: "POST",
                url: "../../controllers/calificarTienda.php",
                data: {
                    idTienda: <?= $idTienda ?>,
                    idUser: <?= $_SESSION['id'] ?>,
                    calificacion: calificacion,
                    comentario: comentario
                },
                dataType: "json",
                success: function(response) {
                    Swal.fire("Comentario agregado.");
                    traerComentariosT();
                    // Mostrar un mensaje de éxito o realizar alguna acción adicional si es necesario
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);

                    // Mostrar un mensaje de error al usuario o manejar el error de otra manera
                }
            });
        } else {

            Swal.fire("Debe ingresar una calificación y un comentario.");

            // Aquí podrías mostrar un mensaje de error al usuario si lo deseas
        }
    }

    function traerComentariosT() {
        $.ajax({
            type: "POST",
            url: "../../controllers/traerComentariosTienda.php",
            data: {
                idTienda: <?= $idTienda ?>
            },
            dataType: "json",
            success: function(response) {
                // Limpia el contenedor
                $('#comentariosContainer').empty();

                // Itera sobre los datos del JSON
                $.each(response.data, function(index, comment) {
                    switch (comment.calificacion) {

                        case "5":
                            var califica = "Excelente";

                            break;
                        case "4":
                            var califica = "Muy bueno";

                            break;
                        case "3":
                            var califica = "Bueno";

                            break;
                        case "2":
                            var califica = "Regular";

                            break;
                        case "1":
                            var califica = "Malo";

                            break;

                        default:
                            break;
                    }
                    var cardHtml = '<div class="card mb-3">';
                    cardHtml += '<div class="card-body">';
                    cardHtml += '<p><i class="far fa-user"></i> ' + comment.name + '</p>';
                    cardHtml += '<h6 class="card-subtitle mb-2 text-muted">Calificación: ' + califica + '</h6>';
                    cardHtml += '<p class="card-text">' + comment.comentario + '</p>';
                    cardHtml += '</div></div>';

                    // Agrega el comentario al contenedor
                    $('#comentariosContainer').append(cardHtml);
                });
            }
        });
    }

    function aplicarCupons() {
        var codeC = $("#cuponsitoCupon").val();
        var longitudC = codeC.length;
        if (longitudC === 12) {
            Swal.fire({
                title: "¿Realmente desas aplicar este cupón?",
                text: "Al aplicar un cupón, ten en cuenta y elegir bien los productos, porque una vez que se aplique, no podrás revertirlo.",
                showDenyButton: true,
                confirmButtonText: "Aplicar",
                denyButtonText: `Cancelar`
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../../controllers/universalCuponController.php",
                        data: {
                            codeTienda: "<?= $serialC ?>",
                            codeC: codeC,
                            type: "aplicarCupon"
                        },
                        dataType: "json",
                        success: function(response) {
                            if ($.isArray(response.data)) {
                                Swal.fire("Procesando cupón", "", "info");
                                console.log(response)
                                viewTable();


                            } else {
                                Swal.fire(response.data, "", "info");
                            }


                        }
                    });

                } else if (result.isDenied) {
                    Swal.fire("Acción cancelada", "", "info");
                }
            });

        }

    }
</script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 -->
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="js/paricles.js"></script>