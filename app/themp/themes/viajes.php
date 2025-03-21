<head>
    <meta property="og:title" content="<?= $nombreT ?>">
    <meta property="og:description" content="<?= $text1 ?>">
    <meta property="og:image" content="<?= $logo ?>">
    <meta property="og:url" content="https://rutadelaseda.xyz/">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="500">
    <meta property="og:image:height" content="500">
    <title><?= $nombreT ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="<?= $logo ?>" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/stylesM.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/particles.css">
    <link rel="stylesheet" href="css/page.css">
    <style>
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
<div id="particles-js" class="loader"></div>
<!-- <div id="icon" class="icon animate__animated animate__pulse" style="display: none;">⬅️</div>
<div id="icon2" class="icon animate__animated animate__pulse" style="display: none;">⬅️</div> -->
<nav class="navbar bg-light navbar-light fixed-top ">
    <a class="navbar-brand d-flex align-items-center" href="https://rutadelaseda.xyz/" id="nvarImg">
        <i class="fas fa-arrow-left"></i>
        <div class="imagenCircular">
            <img src="<?= $logo ?>" class="d-inline-block align-top" id="" alt="" crossorigin="anonymous">

        </div>
    </a>

    <center id="buscarInputo">
        <div class="form-inline my-2 my-lg-0">
            <input type="text" id="myInputTextField" class="" style=" font-size: 20px; background-color: transparent; text-align: center;border: 0; outline: none;" placeholder="Buscar">


        </div>
    </center>
    <a class="navbar-toggler" onclick="mostarSearch()" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

        <i class="fas fa-search fa-lg"></i>
    </a>
    <a id="shareButton" class="navbar-toggler"><i class="fas fa-share-alt fa-lg"></i></a>
    <a href="https://wa.me/+52<?= $wha ?>?text=Me%20gustaría%20saber%20más%20informes%20de%20<?= $nombreT ?>" class="navbar-toggler"><i class="fab fa-whatsapp fa-lg"></i></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars fa-lg"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto" style="overflow-y: auto; max-height: 200px;">

            <?php
            while ($arreglo = mysqli_fetch_array($sqlCat)) {
            ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#table_id" onclick="viewPList('<?= $arreglo[0] ?>')"><b><?= $arreglo[0] ?></b></a>
                </li>

            <?php
            }
            ?>
        </ul>

    </div>
</nav>
<br>
<br>
<br>
<br>
<br>
<div class="container mt-5" id="colorContainer">
    <button type="button" name="" id="showCOLORSiNP" class="btn btn-light btn-lg btn-block" onclick="showColorsPer()"><i class="far fa-eye"></i> Mostrar Personalización</button>
    <div class="color-input-container row mt-3">
        <div class="pantone-card col-6 col-md-6 mb-3">
            <input name="coloruno" id="coloruno" type="color" onchange="changeBootstrapColors()" value="<?= $coloruno ?>" oninput="colorhex1.value=value">
            <label for="" class="mt-2"><b>Color primario</b></label>
            <output id="colorhex1"><?= $coloruno ?></output>
        </div>

        <div class="pantone-card col-6 col-md-6 mb-3">
            <input name="colordos" id="colordos" type="color" onchange="changeBootstrapColors()" value="<?= $colordos ?>" oninput="colorhex2.value=value">
            <label for="" class="mt-2"><b>Color secundario</b></label>
            <output id="colorhex2"><?= $colordos ?></output>
        </div>

        <div class="pantone-card col-6 col-md-6 mb-3">
            <input name="colortres" id="colortres" type="color" onchange="changeBootstrapColors()" value="<?= $colortres ?>" oninput="colorhex3.value=value">
            <label for="" class="mt-2"><b>Color afirmativo</b></label>
            <output id="colorhex3"><?= $colortres ?></output>
        </div>

        <div class="pantone-card col-6 col-md-6 mb-3">
            <input name="colorcuatro" id="colorcuatro" type="color" onchange="changeBootstrapColors()" value="<?= $colorcuatro ?>" oninput="colorhex4.value=value">
            <label for="" class="mt-2"><b>Color obscuro</b></label>
            <output id="colorhex4"><?= $colorcuatro ?></output>
        </div>
        <div class="pantone-card col-6 col-md-6 mb-3">
            <input name="colorcinco" id="colorcinco" type="color" onchange="changeBootstrapColors()" value="<?= $colorcinco ?>" oninput="colorhex5.value=value">
            <label for="" class="mt-2"><b>Color claro</b></label>
            <output id="colorhex5"><?= $colorcinco ?></output>
        </div>
    </div>
</div>
<?php
$horarioArray = explode(",", trim($horario, "()"));
$NhorarioArray = array_slice($horarioArray, 2);
$Zarray = implode(", ", $NhorarioArray);

if ($banner) {
?>
    <div class=" text-center bg-image rounded-3 d-flex justify-content-center align-items-center" style="
    background-image: url('<?= $banner ?>');
    height: 100vh;
    background-repeat: no-repeat; background-size: cover;
    background-position: center;
  ">
        <img id="imageLogon" src="<?= $banner ?>" alt="Imagen" crossorigin="anonymous" style="display: none;">
        <canvas id="canvas" style="display: none;"></canvas>
        <div class="mask" style="background-color: rgba(0, 0, 0, 0.6); border-radius: 16px;">
            <div class="d-flex justify-content-center p-5 align-items-center h-100">
                <div class="text-white">
                    <h1 class="text-light"><?= $nombreT ?></h1>
                    <p class="mb-3"><?= $text1 ?></p>
                    <br>
                    <a class="btn btn-secondary btn-lg text-light animate__animated animate__pulse animate__infinite" href="#table_id">Bienvenido</a>
                    <br>
                    <h5 class="text-light mt-3">Horario: de <?= $horarioArray[0] ?> a <?= $horarioArray[1] ?> horas. <br>Dias de cierre: <?= $Zarray ?></h5>
                </div>
            </div>
        </div>
    </div>
<?php
}
if ($nota) {
?>
    <center>
        <div class="text-center col-12 col-md-7 mb-3 h-100" style="margin-top: 100px;">

            <div class="embed-responsive">
                <?= $nota ?>
            </div>

        </div>
    </center>
<?php
}
?>

<div class="container mt-3 mb-3">
    <div class="redes-sociales">
        <?php
        if ($face) {
        ?>
            <a class="text-primary" href="<?= $face ?>"><i class="fab fa-facebook"></i></a>

        <?php
        }
        if ($insta) {
        ?>
            <a class="text-primary" href="<?= $insta ?>"><i class="fab fa-instagram"></i></a>

        <?php
        }
        if ($youtu) {
        ?>
            <a class="text-primary" href="<?= $youtu ?>"><i class="fab fa-youtube"></i></a>

        <?php
        }
        if ($mercada) {
        ?>
            <a class="text-primary" href="<?= $mercada ?>"><i class="fas fa-handshake"></i></a>

        <?php
        }
        ?>



        <!-- Utilizo fa-teamspeak en lugar de fa-mercado-libre porque no existe un icono específico para Mercado Libre -->
    </div>
</div>

<div class="viewPList" style="margin-bottom: 40px;"></div>
<div class="col-12 container" id="inputNombreViaje">
    <center>
        <div class="form-group mb-3 mt-3">
            <label for="">A nombre de</label>
            <input type="text"
                class="form-control" name="" id="nameclientesillo" onchange="guardarClientesillo()" aria-describedby="helpId" placeholder="Nombre">
            <small id="helpId" class="form-text text-muted">Nombre del cliente</small>
        </div>
        <form action="prelocalizador.php" method="get">
            <input type="hidden" value="<?= $nameP ?>" name="id">
            <button type="submit" class="btn btn-primary btn-block text-light animate__animated animate__pulse animate__infinite infinite">
                <span>
                    Continuar <i class="fa fa-shopping-basket "></i>
                </span>

            </button>
        </form>
    </center>
</div>
<?php
if ($_SESSION['types']) {
?>
    <div class="container p-5" style="height: 80vh;">
        <div class="row">
            <div class="col-12">
                <h3>Deja un comentario</h3>
                <div class="mb-3">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="username" name="username">
                    </div>
                    <label for="comment">Calificación:</label>
                    <br>
                    <div class="rating">

                        <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="Excelente"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="Muy bueno"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="Bueno"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="Regular"><i class="fas fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="Malo"><i class="fas fa-star"></i></label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="commentInput">Comentario:</label>
                        <textarea class="form-control" id="commentInput" name="commentInput" rows="3"></textarea>
                    </div>

                    <button type="button" onclick="guardarComentario()" class="btn btn-primary text-light">Enviar comentario</button>
                </div>
            </div>
            <div class="col-12">
                <h3>Comentarios</h3>
                <div id="comentariosContainer" class="mt-3" style="margin-bottom: 200px;"></div>
            </div>
        </div>
    </div>
<?php
}
?>

<br>
<br>

<?php
if ($_SESSION['types']) {
?>
    <footer class="py-3 cristal fixed-bottom">
        <center>
            <div class="container row text-primary">
                <div class="col-6">
                    <center><a href="https://rutadelaseda.xyz/" class="botonF1 text-primary"> <i class="fas fa-store fa-2x"></i></a></center>
                </div>
                <div class="col-6">
                    <center> <a href="https://wa.me/+52<?= $wha ?>" class="botonF1 text-primary" target="_blank"> <i class="fab fa-whatsapp fa-2x"></i></a></center>
                </div>


            </div>
        </center>

    </footer>
<?php
} else {
?>
    <footer class="text-center fixed-bottom cristal">
        <!-- Grid container -->
        <div class="container p-4 pb-0 ">
            <!-- Section: CTA -->
            <section class="">
                <p class="d-flex justify-content-center align-items-center">

                    <a href="https://rutadelaseda.xyz/login2" class="btn btn-secondary text-light">
                        Iniciar sesion
                    </a>
                    <a href="https://rutadelaseda.xyz/register" class=" ml-3 btn btn-outline-primary btn-rounded">
                        Regístrate
                    </a>

                </p>
            </section>
            <!-- Section: CTA -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); font-size: 9px;">
            © 2024 Copyright:
            <a class="text-white">rutadelaseda.xyz</a>
        </div>

        <!-- Copyright -->
    </footer>
<?php
}
?>



<div class="modal " id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del producto</h5>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closemodal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="responsess"></div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary text-light" onclick="closemodal()" data-dismiss="modal">Seguir viendo</button>
            </div>
        </div>
    </div>
</div>
<div class="modal " id="exampleModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del pedido</h5>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closemodal2()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="responsessTable mb-2"></div>
                <div class="row justify-content-center">
                    <div class="form-group">
                        <label for="">¿Tienes un cupón?</label>
                        <input type="text" onchange="aplicarCupons()" class="form-control" name="" id="cuponsitoCupon" aria-describedby="helpId" placeholder="Código de cupón">
                        <small id="helpId" class="form-text text-muted">Por favor ingrese su código para aplicar su descuento</small>
                    </div>
                </div>
                <?php
                if ($precioBase >= 1) {
                    if ($_SESSION['nameClienteUnique']) {
                ?>
                        <form action="prelocalizador.php" method="get">
                            <input type="hidden" value="<?= $nameP ?>" name="id">
                            <button type="submit" class="btn btn-primary btn-block text-light animate__animated animate__pulse animate__infinite infinite">
                                <span>
                                    Realizar compra <i class="fa fa-shopping-basket "></i>
                                </span>

                            </button>
                        </form>
                    <?php
                    } else {
                    ?>
                        <form action="localizador.php" method="get">
                            <input type="hidden" value="<?= $nameP ?>" name="id">
                            <button type="submit" class="btn btn-primary btn-block text-light animate__animated animate__pulse animate__infinite infinite">
                                <span>
                                    Realizar compra <i class="fa fa-shopping-basket "></i>
                                </span>

                            </button>
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <form action="cart2.php" method="get">
                        <input type="hidden" value="<?= $nameP ?>" name="id">
                        <button type="submit" class="btn btn-primary btn-block text-light animate__animated animate__pulse animate__infinite infinite">
                            <span>
                                Realizar compra <i class="fa fa-shopping-basket "></i>
                            </span>

                        </button>
                    </form>
                <?php
                }
                ?>

            </div>
            <div class="modal-footer">


                <a name="" id="" class="btn btn-success  btn-block text-light" href="smarticket.php" role="button">¿Ya tiene una orden en proceso?</a>

                <button type="button" class="btn btn-secondary text-light" onclick="closemodal2()" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</html>
<script>
    $(document).ready(function() {
        $('#icon').hide();
        $(".color-input-container").hide();

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

    function guardarClientesillo() {
        var clientesillo = $("#nameclientesillo").val();
        $.ajax({
            type: "POST",
            url: "../../controllers/pedidolocalController.php",
            data: {
                session: clientesillo
            },
            dataType: "html",
            success: function(response) {

            },
        });
    }

    function showColorsPer() {
        $(".color-input-container").show();
    }

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

    function changeBootstrapColors() {

        const style = document.createElement('style');

        var primo = $("#coloruno").val();
        var secon = $("#colordos").val();
        var lights = $("#colorcinco").val();
        var darks = $("#colorcuatro").val();
        var cuccessI = $("#colortres").val();
        guardarColorcitos(primo,
            secon,
            lights,
            darks,
            cuccessI, )
        style.innerHTML = `
:root {
--primary: ${primo};
--secondary: ${secon};
--light: ${lights};
--dark: ${darks};
--success: ${cuccessI};
}
.text-primary {
color: var(--primary) !important;
}
.text-secondary {
color: var(--secondary) !important;
}
a {
color: var(--success) !important; 
}
a:hover {
color: var(--success) !important; 
}
.btn-primary {
background-color: var(--primary) !important;
border-color: var(--primary) !important;
color: var(--light) !important; 
}
.btn-primary:hover {
background-color: lighten(var(--primary), 10%) !important;
border-color: lighten(var(--primary), 10%) !important;
color: var(--dark) !important
}
.btn-success {
background-color: var(--success) !important;
border-color: var(--success) !important;
color: var(--light) !important; 
}
.btn-success:hover {
background-color: var(--light) !important;
color: var(--success) !important
}
.btn-secondary {
background-color: var(--secondary) !important;
border-color: var(--secondary) !important;
}
.btn-secondary:hover {
background-color: lighten(var(--secondary), 10%) !important;
border-color: lighten(var(--secondary), 10%) !important;
}
.btn-outline-primary {
color: var(--primary) !important;
border-color: var(--primary) !important;
}
.btn-outline-primary:hover {
background-color: var(--primary) !important;
color: #fff !important;
}
.page-link {
background-color: var(--secondary) !important;
border: 1px solid var(--secondary) !important;
color: var(--light) !important;
}
.badge-secondary {
background-color: var(--secondary) !important;
color: var(--light) !important;
}
.navbar {
background-color: var(--light) !important;
}
.navbar-light .navbar-brand {
color: var(--secondary) !important;
}
.nav-link {
color: var(--dark) !important;
}
.nav-link:hover {
color: var(--primary) !important;
}
.bg-success {
background-color: var(--success) !important;
color: var(--light) !important;
}
`;

        document.head.appendChild(style);
    }

    function guardarColorcitos(primo,
        secon,
        lights,
        darks,
        cuccessI, ) {
        $.ajax({
            type: "POST",
            url: "../../controllers/guardarColor.php",
            data: {
                idTienda: <?= $idTienda ?>,
                primo: primo,
                secon: secon,
                lights: lights,
                darks: darks,
                cuccessI: cuccessI,
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
            }
        });
    }


    function mostarSearch() {
        $("#nvarImg").hide();
        $("#buscarInputo").show();
    }

    function viewPList(cat) {
        $('.navbar-collapse').collapse('hide');
        $.ajax({
            type: 'POST',
            url: 'timeProtectViaje.php',
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