<?php
$id = (isset($_GET['id']) ? $_GET['id'] : null);
require('./objets/core.php');
$query = "SELECT * FROM liks WHERE lat <> 'null' GROUP BY createdby";
$sql = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RutaDeLaSeda | Tienda instantanea</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="images/gotaverde.png" />
    <!-- Bootstrap icons-->
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/stylesM.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
    <link rel="stylesheet" href="css/particles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.2/minty/bootstrap.min.css" integrity="sha512-eIWDPd26e4DL6modlm5smdzpfAMb8DmCBVxQAVxVJWDmevrMLVHcWaBEpG8eKiYZgLOZzxfS2dW67QhtqIgKdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #mapCanvas {
            width: 100%;
            height: 100%;
        }

        .map-responsive {
            overflow: hidden;

            position: relative;
            height: 100vh;

        }

        .map-responsives {
            left: 0;
            z-index: 5;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }



        .dataTables_filter {
            float: left !important;
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

        .cristal {

            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
            border-radius: 5px;
            background-color: rgba(245, 245, 245, .50);

            backdrop-filter: blur(5px);

        }

        /* Slider */

        .slick-slide {
            margin: 0px 20px;
        }

        .slick-slide img {
            width: 100%;
        }

        .slick-slider {
            position: relative;
            display: block;
            box-sizing: border-box;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
            -khtml-user-select: none;
            -ms-touch-action: pan-y;
            touch-action: pan-y;
            -webkit-tap-highlight-color: transparent;
        }

        .slick-list {
            position: relative;
            display: block;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        .slick-list:focus {
            outline: none;
        }

        .slick-list.dragging {
            cursor: pointer;
            cursor: hand;
        }

        .slick-slider .slick-track,
        .slick-slider .slick-list {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .slick-track {
            position: relative;
            top: 0;
            left: 0;
            display: block;
        }

        .slick-track:before,
        .slick-track:after {
            display: table;
            content: '';
        }

        .slick-track:after {
            clear: both;
        }

        .slick-loading .slick-track {
            visibility: hidden;
        }

        .slick-slide {
            display: none;
            float: left;
            height: 100%;
            min-height: 1px;
        }

        [dir='rtl'] .slick-slide {
            float: right;
        }

        .slick-slide img {
            display: block;
        }

        .slick-slide.slick-loading img {
            display: none;
        }

        .slick-slide.dragging img {
            pointer-events: none;
        }

        .slick-initialized .slick-slide {
            display: block;
        }

        .slick-loading .slick-slide {
            visibility: hidden;
        }

        .slick-vertical .slick-slide {
            display: block;
            height: auto;
            border: 1px solid transparent;
        }

        .slick-arrow.slick-hidden {
            display: none;
        }

        #catalog {



            z-index: 6;
            left: 0;
            right: 0;
            margin: 0 auto;

            z-index: 6;

            position: fixed;

            bottom: 0px;

        }

        .aviso {

            background-image: url('images/COLOR.png');
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }

        .whatsapp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            z-index: 100;
        }

        .whatsapp-icon {
            margin-top: 14px;
        }
    </style>
</head>


<body>
    <a href="https://wa.me/525517042359?text=Me%20gustaría%20saber%20más%20información%20de%20la%20app." class="whatsapp" target="_blank">
        <div class="mt-1"><i class="fa-brands fa-whatsapp"></i></div>
    </a>

    <div id="particles-js" class="loader"></div>
    <nav class="navbar navbar-expand-lg  bg-light cristal fixed-top" data-bs-theme="light">
        <div class="container-fluid">
            <img src="./images/rutadelasedaLogo.png" width="200px" class="img-fluid" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor03">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="https://rutadelaseda.xyz/login">Iniciar sessión

                        </a>
                    </li>
                </ul>
                <form class="d-flex" action="https://rutadelaseda.xyz/app/themp/smarticket.php" method="GET">
                    <input class="form-control my-2 me-sm-2" name="order" type="search" placeholder="¿Tiene una orden de compra?">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">Buscar</button>
                </form>

            </div>
        </div>
    </nav>
    <div class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="./images/telefonosMok.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">¡Empieza a vender ya!</h1>
                <p class="lead">Comienza a crear tu tienda en minutos fácil y gratis.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="filesApk/Rutadelaseda_1_0.5.apk" download="Rutadelaseda_1_0.5.apk">
                        <button type="button" class="btn btn-dark btn-lg px-4 me-md-2">Descarga la app</button>
                    </a>
                    <br>
                    <a name="" id="" class="btn btn-primary btn-lg px-4 me-md-2" href="https://rutadelaseda.xyz/app/themp/page.php?id=o81vgmk94p6rd21il3bgk6rjp0679%26pablocerveza9@gmail.com" role="button">Ver demostración</a>


                </div>
            </div>
            <div class="container my-5">
                <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 ">
                    <div class="col-lg-3 col-12 offset-lg-1 p-0 rounded-3">
                        <center>
                            <img class="rounded-lg-3 border shadow-lg" src="./images/screenPhoneMenu.PNG" alt="">
                        </center>

                    </div>
                    <div class="col-lg-8 col-12 p-3 p-lg-5 pt-lg-3">
                        <h1 class="display-6 fw-bold lh-1 mt-2">Todo en uno</h1>
                        <p class="lead">Nuestra poderosa herramienta te permite gestionar tu negocio de manera fácil, explora todas las características que te permitirán vender de manera rápida.</p>
                        <div class="mb-4 mb-lg-3">
                            <p><i class="fa-solid fa-circle-check"></i><b> Comparta su tienda de manera rápida.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> 0% comisiones. Sin anuncios ni cargos ocultos.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Reciba pedidos ilimitados.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Modificadores de artículos, variantes posibles.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Menú con código QR.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Convierte la tediosa escritura de pedidos en un simple clic. Recibes más pedidos.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Comience a tomar pedidos en minutos.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Utilice su moneda e idioma locales.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Múltiples temas.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> No se requiere sitio web.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Sistema y perfil de repartidores.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Cotizador de envíos locales.</b></p>
                            <p><i class="fa-solid fa-circle-check"></i><b> Acepte pagos por tarjeta.</b></p>

                        </div>
                    </div>

                </div>
            </div>
            <div class="px-4 py-5 my-5 text-center">
                <h1 class="display-5 fw-bold">Únete a nuestra red de socios hoy mismo</h1>

            </div>
        </div>
    </div>
    <div class="map-responsive aviso">
        <div id="capa-mapa" class="map-responsives"></div>
    </div>
    <div id="catalog"></div>

    <footer class="bg-body-tertiary text-center">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #3b5998;" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>



                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #c037a6;" href="#!" role="button"><i class="fab fa-instagram"></i></a>


                <!-- Github -->
                <a data-mdb-ripple-init class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i class="fa-brands fa-tiktok"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="https://rutadelaseda.xyz/">rutadelaseda.xyz</a>
        </div>
        <!-- Copyright -->
    </footer>


</body>



<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&sensor=false"></script>
<script type="text/javascript">
    navigator.geolocation.getCurrentPosition(function(objPosicion) {
        //almacenamos en variables la longitud y latitud
        var iLongitud = objPosicion.coords.longitude,
            iLatitud = objPosicion.coords.latitude;
        var misPuntos = [

            <?php
            while ($arreglo = mysqli_fetch_array($sql)) {
            ?>["<?= $arreglo['createdby'] ?>",
                    "<?= $arreglo['lat'] ?>",
                    "<?= $arreglo['long'] ?>",
                    "icon<?= $arreglo['category'] ?>",
                    "<center><div class='card bg-light mb-3 text-dark'><div class='card-header'><?= $arreglo['createdby'] ?></div><div class='card-body'><br><center><div class='col-12 col-md-12'><img style ='width: 100%;height: auto;' src='<?= $arreglo['logojpg'] ?>' class='img-fluid'></div></center><br><center><div class='d-grid gap-2'><a class='btn btn-outline-dark' href='<?php echo 'page.php?id=' . $arreglo['serial']; ?>%26<?= $arreglo['createdby'] ?>'>Visitar tienda</a></div></center></div></div></center>"],

            <?php
            }
            ?>
        ];

        var x = iLatitud;
        var y = iLongitud;
        //pasamos las variables por ajax
        var mapOptions = {
            zoom: 10,
            center: new google.maps.LatLng(x, y),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }

        var map = new google.maps.Map(document.getElementById("capa-mapa"), mapOptions);







        var markers = Array();
        var infowindowActivo = false;

        function setGoogleMarkers(map, locations) {


            // Definimos los iconos a utilizar con sus medidas
            var icon0 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/684/684908.png"
            );
            var icon1 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/3575/3575840.png"
            );
            var icon2 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/7906/7906691.png"

            );
            var icon3 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/5759/5759423.png"
            );
            var icon4 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/5015/5015093.png"
            );
            var icon5 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/2727/2727139.png"
            );
            var icon6 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/8171/8171500.png"
            );
            var icon7 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/6231/6231174.png"
            );
            var icon8 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/727/727590.png"
            );
            var icon9 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/5193/5193706.png"
            );
            var icon10 = new google.maps.MarkerImage(
                "https://cdn-icons-png.flaticon.com/32/2903/2903045.png"
            );

            for (var i = 0; i < locations.length; i++) {
                var elPunto = locations[i];
                var myLatLng = new google.maps.LatLng(elPunto[1], elPunto[2]);

                markers[i] = new google.maps.Marker({
                    position: myLatLng,
                    map: map,
                    icon: eval(elPunto[3]),
                    title: elPunto[0]
                });
                markers[i].infoWindow = new google.maps.InfoWindow({
                    content: elPunto[4]
                });
                google.maps.event.addListener(markers[i], 'click', function() {

                    if (infowindowActivo)
                        infowindowActivo.close();
                    infowindowActivo = this.infoWindow;
                    /* console.log(this.title) */
                    catalogV(this.title)
                    infowindowActivo.open(map, this);
                });
            }
        }
        setGoogleMarkers(map, misPuntos);

    }, function(objError) {
        //manejamos los errores devueltos por Geolocation API
        switch (objError.code) {
            //no se pudo obtener la informacion de la ubicacion
            case objError.POSITION_UNAVAILABLE:
                errorjs.innerHTML = 'La información de tu posición no es posible';
                break;
                //timeout al intentar obtener las coordenadas
            case objError.TIMEOUT:
                errorjs.innerHTML = "Tiempo de espera agotado";
                break;
                //el usuario no desea mostrar la ubicacion
            case objError.PERMISSION_DENIED:
                errorjs.innerHTML = 'Necesitas permitir tu localización';
                break;
                //errores desconocidos
            case objError.UNKNOWN_ERROR:
                errorjs.innerHTML = 'Error desconocido';
                break;
        }
    });
</script>
<script>
    function catalogV(ids) {
        console.log(ids)
        $.ajax({
            type: "get",
            url: "objets/getMenusSearch.php",
            data: {

                ids: ids
            },
            dataType: "html",
            asycn: false,
            success: function(response) {
                $("#catalog").html(response);
                $('.customer-logos').slick({
                    slidesToShow: 6,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 1500,
                    arrows: false,
                    dots: false,
                    pauseOnHover: false,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4
                        }
                    }, {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 3
                        }
                    }]
                });

            }
        });
    }
    /*  catalogV(); */

    function hiden() {
        $("#particles-js").fadeOut("slow");
        document.getElementsByTagName('body')[0].style.overflow = 'visible';
    }
    window.setTimeout(hiden, 1000);
</script>
<script src="js/paricles.js"></script>

</html>