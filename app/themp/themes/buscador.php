<?php
$lat = (isset($_GET['lat']) ? $_GET['lat'] : null);
$long = (isset($_GET['lng']) ? $_GET['lng'] : null);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($lat) && isset($long)) {
    if ($lat == "0" && $long == "0") {
        unset($_SESSION['lat']);
        unset($_SESSION['long']);
    } else {
        $_SESSION['lat'] = $lat;
        $_SESSION['long'] = $long;
    }
} else {
    if (isset($_SESSION['lat']) && isset($_SESSION['long'])) {
        $lat = $_SESSION['lat'];
        $long = $_SESSION['long'];
    } else {
        // Si las variables $lat y $long no están seteadas y tampoco están en la sesión
        // Debes manejar este caso según lo que necesites en tu aplicación
        // Por ejemplo, podrías asignarles un valor por defecto
        $lat = 0;
        $long = 0;
    }
}
require('./objets/core.php');
$query = "SELECT * FROM liks A INNER JOIN masDatosdeTienda B ON A.id = B.idTienda WHERE A.lat <> 'null' AND A.logojpg <> 'null' GROUP BY A.createdby;";
$sql = mysqli_query($con, $query);
$sql2 = mysqli_query($con, $query);
if ($lat && $long) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="RutaDeLaSeda | Tienda instantanea">
        <meta property="og:description" content="RutaDeLaSeda | Tienda instantanea">
        <meta property="og:image" content="images/rutadelaseda.png">
        <meta property="og:url" content="https://rutadelaseda.xyz/">
        <meta property="og:type" content="website">
        <meta property="og:image:width" content="500">
        <meta property="og:image:height" content="500">
        <title>RutaDeLaSeda | Tienda instantanea</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images/rutadelaseda.png" />
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            #mapCanvas {
                width: 100%;
                height: 100%;
            }

            .map-responsive {
                overflow: hidden;

                position: relative;
                height: 70vh;

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

            .imagenCircular {
                width: 100px;
                height: 100px;
                margin-top: 10px;
                margin-left: 10px;
                border-radius: 50%;
                /* Esto hace que la imagen tenga forma circular */
                overflow: hidden;
                position: absolute;

                /* Esto asegura que la imagen no se salga de su contenedor */
                box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
            }

            .imagenCircular img {
                width: 100%;
                /* Ajusta el tamaño de la imagen al contenedor */
                height: auto;
                /* Mantiene la proporción original de la imagen */
                display: block;
                /* Asegura que la imagen se muestre correctamente */
            }

            .imagenCircularmap {
                width: 100px;
                height: 100px;

                border-radius: 50%;
                /* Esto hace que la imagen tenga forma circular */
                overflow: hidden;


                /* Esto asegura que la imagen no se salga de su contenedor */
                box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
                box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
            }

            .imagenCircularmap img {
                width: 100%;
                /* Ajusta el tamaño de la imagen al contenedor */
                height: auto;
                /* Mantiene la proporción original de la imagen */

                /* Asegura que la imagen se muestre correctamente */
            }

            .card {
                box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
            }

            .image-container {
                width: 100%;
                /* O establece un ancho fijo */
                height: 100px;
                /* Establece la altura que desees */
                overflow: hidden;
                /* Oculta el contenido que exceda el contenedor */
            }

            .image-container img {
                width: 30%;
                height: 100px;
                object-fit: cover;
                /* Recorta la imagen y la centra sin deformarla */
                object-position: center;
                /* Centra la imagen dentro del contenedor */
            }
        </style>
    </head>


    <body class="">


        <div id="particles-js" class="loader"></div>

        <div class="row justify-content-center col-12 mt-3">

            <div id="pac-container" class="row justify-content-center">
                <div class="col-12 row justify-content-center">
                    <div class="col-8 mb-3">
                        <h1>Tiendas más cercanas</h1>
                    </div>


                    <div class="row mb-3 col-12 mb-3 row justify-content-center">
                        <div class="col-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-sm" onclick="showMap()"><i class="fas fa-map"></i> Mapa</button>
                        </div>
                        <div class="col-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary btn-sm" onclick="showList()"><i class="fas fa-list"></i> Lista</button>
                        </div>
                        <div class="col-12 mt-3 mb-3 d-grid gap-2">
                            <a href="https://rutadelaseda.xyz/app/themp/page.php?id=i71oiev3bfnh3q0j6qhn6ermpa285%26contacto@rutadelaseda.xyz&lat=0&lng=0" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i> Volver a buscar</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class=" d-flex justify-content-center container mt-3">
            <div class="col-12 row row-cols-1 row-cols-md-3 g-4" id="listaTienda"></div>
        </div>




        <div class="map-responsive aviso col-12" style="border-radius: 16px;">
            <div id="capa-mapa" class="map-responsives"></div>
        </div>
        <div class="container fixed-bottom" id="containerCardsStores">
            <center>
                <section class="customer-logos slider col-12 cristal mb-2" id="punticos">




                </section>
            </center>


        </div>




    </body>



    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&sensor=false"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            calcularPuntosProximos("<?= $lat ?>", "<?= $long ?>");
            $(".map-responsive").show();
            $("#listaTienda").hide();
            $(".slick-track").show();
        });

        function showMap() {
            $(".map-responsive").show();
            $("#listaTienda").hide();
            $(".slick-track").show();
        }

        function showList() {
            $(".map-responsive").hide();
            $("#listaTienda").show();
            $(".slick-track").hide();

        }
        var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(<?= $lat ?>, <?= $long ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true, // Desactiva los controles predeterminados

        }
        var map = new google.maps.Map(document.getElementById("capa-mapa"), mapOptions);

        var infowindowActivo = false;

        function mapa() {
            //almacenamos en variables la longitud y latitud
            /*   var iLongitud = objPosicion.coords.longitude,
                  iLatitud = objPosicion.coords.latitude; */
            var misPuntos = [

                <?php
                while ($arreglo = mysqli_fetch_array($sql)) {
                ?>["<?= $arreglo['nombreTienda'] ?>",
                        "<?= $arreglo['lat'] ?>",
                        "<?= $arreglo['long'] ?>",
                        "icon<?= $arreglo['category'] ?>",
                        "<center><div class='card-body'><center><div class='col-12 col-md-12'><div class='imagenCircularmap mb-3'><img style ='' src='<?= $arreglo['logojpg'] ?>' class=''></div></div></center></div></div><div class='mb-3'><h6><?= $arreglo['nombreTienda'] ?></h6></div></center>",
                        "<?= $arreglo['logojpg'] ?>",
                        "<?= $arreglo['banner'] ?>",
                        "<?= $arreglo[0] ?>"
                    ],


                <?php
                }
                ?>
            ];

            /*  var x = iLatitud;
             var y = iLongitud; */
            //pasamos las variables por ajax




            var markers = Array();


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
                var geocoder = new google.maps.Geocoder();
                for (let i = 0; i < locations.length; i++) {
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
                        var marker = this;
                        mostrarvantanainfo(this);
                        $('.customer-logos').slick('slickGoTo', i);
                    });




                    // Crear el botón y agregarlo al DOM

                    // Crear un contenedor para el contenido del slide
                    var slideContainer = document.createElement('div');

                    // Asignar el contenido HTML al contenedor
                    slideContainer.innerHTML = `
                    <div class="slide mt-3">
<div class="card h-50 boxes animate__animated animate__flipInX image-container flex-row"><img class="card-img-left example-card-img-responsive rounded mt-2" src="${elPunto[6]}" onerror="this.src='https://simg.nicepng.com/png/small/274-2748179_alien-aliens-glitch-tumblr-stickers-trippy-alien-png.png'"/>
  <div class="card-body">
    <b style='font-size:12px;' class="card-title">${elPunto[0]}</b>
    <p style='font-size:8px;' id="address-${i}">Buscando dirección...</p>
    <a href='https://rutadelaseda.xyz/@${elPunto[7]}' style='font-size:8px;' class="btn btn-outline-dark btn-sm">Ir</a>
   
  </div>
</div>
</div>

`;

                    // Agregar un evento onclick al contenedor o a un elemento específico dentro de él
                    slideContainer.onclick = function() {
                        mostrarvantanainfo(markers[i]);
                    };

                    // Agregar el contenedor al DOM
                    document.getElementById('punticos').appendChild(slideContainer);

                    geocoder.geocode({
                        'location': myLatLng
                    }, (function(slideIndex) {
                        return function(results, status) {
                            if (status === 'OK' && results[0]) {
                                document.getElementById(`address-${slideIndex}`).textContent = results[0].formatted_address;
                            } else {
                                document.getElementById(`address-${slideIndex}`).textContent = 'Dirección no encontrada';
                            }
                        };
                    })(i));
                }
                $('.customer-logos').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: false,
                    autoplaySpeed: 2500,
                    arrows: false,
                    dots: false,
                    pauseOnHover: true,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }, {
                        breakpoint: 520,
                        settings: {
                            slidesToShow: 1
                        }
                    }]
                });
                $('.customer-logos').on('afterChange', function(event, slick, currentSlide) {

                    var $currentSlideElement = $(slick.$slides[currentSlide]);

                    // Simular el clic
                    $currentSlideElement.click();


                });
            }
            setGoogleMarkers(map, misPuntos);
        }

        function mostrarvantanainfo(parms) {
            if (infowindowActivo)
                infowindowActivo.close();
            infowindowActivo = parms.infoWindow;
            /* console.log(parms.title) */
            /* catalogV(parms.title) */
            infowindowActivo.open(map, parms);
        }
        mapa();
    </script>
    <script>
        function catalogV(ids) {

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
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: false,
                        autoplaySpeed: 1500,
                        arrows: false,
                        dots: false,
                        pauseOnHover: false,
                        responsive: [{
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1
                            }
                        }, {
                            breakpoint: 520,
                            settings: {
                                slidesToShow: 1
                            }
                        }]
                    });
                    $('.customer-logos').on('afterChange', function(event, slick, currentSlide) {
                        console.log('El slide actual es: ' + currentSlide);
                        // Aquí puedes agregar cualquier acción adicional que desees ejecutar


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

        function calcularPuntosProximos(miLatitud, miLongitud) {
            function calcularDistancia(lat1, lon1, lat2, lon2) {
                var R = 6371; // Radio de la Tierra en kilómetros
                var dLat = toRad(lat2 - lat1);
                var dLon = toRad(lon2 - lon1);
                var a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);
                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                var distancia = R * c; // Distancia en kilómetros
                return distancia;
            }

            function toRad(grados) {
                return grados * Math.PI / 180;
            }

            function encontrarCoordenadasCercanas(miLatitud, miLongitud, coordenadas) {
                var coordenadasCercanas = [];

                coordenadas.forEach(function(coordenada) {
                    var distancia = calcularDistancia(miLatitud, miLongitud, coordenada.latitud, coordenada.longitud);
                    coordenadasCercanas.push({
                        coordenada: coordenada,
                        distancia: distancia,
                        id: coordenada.id,
                        image: coordenada.image,
                        name: coordenada.name,
                        phone: coordenada.phone,
                        category: coordenada.category
                    });
                });

                coordenadasCercanas.sort(function(a, b) {
                    return a.distancia - b.distancia;
                });

                return coordenadasCercanas.slice(0, 20); // Devuelve solo los primeros 10 resultados
            }

            // Ejemplo de uso


            var listaCoordenadas = [
                <?php

                while ($arreglo = mysqli_fetch_array($sql2)) {
                ?> {
                        latitud: "<?= $arreglo['lat'] ?>",
                        longitud: "<?= $arreglo['long'] ?>",
                        id: "<?= $arreglo[0] ?>",
                        image: "<?= $arreglo['logojpg'] ?>",
                        name: "<?= $arreglo['createdby'] ?>",
                        phone: "<?= $arreglo['phone'] ?>",
                        category: "<?= $arreglo['category'] ?>"
                    }, // Nueva York

                <?php
                }

                ?>


            ];

            var coordenadasCercanas = encontrarCoordenadasCercanas(miLatitud, miLongitud, listaCoordenadas);
            detalleTiendas(coordenadasCercanas);

        }

        function detalleTiendas(params) {

            var mensaje;
            var category;
            var numero;
            var numero2;
            params.forEach(function(coordenada) {
                numero = coordenada.distancia;
                numero2 = numero.toFixed(2).toString();
                switch (coordenada.category) {
                    case "1":
                        category = "Alimentos";

                        break;
                    case "2":
                        category = "Moda";

                        break;
                    case "3":
                        category = "Moda";

                        break;
                    case "4":
                        category = "Jugetes";

                        break;
                    case "5":
                        category = "Videojuegos";

                        break;
                    case "6":
                        category = "Electrónica";

                        break;
                    case "7":
                        category = "Informática";

                        break;
                    case "8":
                        category = "Electrodomésticos";

                        break;
                    case "9":
                        category = "Varios";

                        break;
                    case "10":
                        category = "Adultos";

                        break;


                }
                if (numero2 <= 10) {
                    mensaje = `
                    <div
              class="card mb-3 col-12 col-md-6"
              style="cursor: pointer"
              onclick="redirectStore(${coordenada.id})"
            >
            
              <div id="imgTienda${coordenada.id}"></div>
              <div class="imagenCircular">
                <img src="${coordenada.image}" alt="Descripción de la imagen">
                </div>
                <div id="disponiblesHorario${coordenada.id}"></div>
              <div class="card-body">
              <div class= "row">
              <div id="tituloTienda${coordenada.id}" class="col-6"></div>
              <div class="col-6 text-end"><h6 class="card-title"><span class="badge bg-info">${category}</span></h6></div>
              </div>
                    
                
                <div id="mini${coordenada.id}"></div>
                <p class="card-text mt-3">
                  <small class="text-muted"
                    >A ${numero2} Km de tu referenciá.</small
                  >
                </p>
              </div>
            </div>
                `;
                    $("#listaTienda").append(mensaje);
                    productsMini(coordenada.name, coordenada.id);
                    traerExtras(coordenada.id);
                }


            });
        }

        function traerExtras(idTienda) {
            var entero = parseInt(idTienda);

            function parseTime(timeString) {
                const [hours, minutes] = timeString.split(":").map(Number);
                const date = new Date();
                date.setHours(hours, minutes, 0, 0);
                return date;
            }

            function estaAbierto(horario) {
                const ahora = new Date();
                const options = {
                    weekday: 'long',
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: false
                };
                const diaActual = ahora.toLocaleString('es-ES', options).split(',')[0].toLowerCase();
                const horaActual = ahora.getHours().toString().padStart(2, '0') + ":" + ahora.getMinutes().toString().padStart(2, '0');

                const horaApertura = horario[0];
                const horaCierre = horario[1];
                const diasCierre = horario.slice(2);

                const horaAperturaDate = parseTime(horaApertura);
                const horaCierreDate = parseTime(horaCierre);
                const horaActualDate = parseTime(horaActual);

                // Verificar si es un día de cierre
                if (diasCierre.includes(diaActual)) {
                    return false;
                }

                // Verificar si está dentro del horario de apertura y cierre
                if (horaActualDate >= horaAperturaDate && horaActualDate <= horaCierreDate) {
                    return true;
                } else {
                    // Caso especial para horarios de cierre después de medianoche (e.g., 22:00 - 02:00)
                    if (horaAperturaDate > horaCierreDate) {
                        if (horaActualDate >= horaAperturaDate || horaActualDate <= horaCierreDate) {
                            return true;
                        }
                    }
                    return false;
                }
            }


            $.ajax({
                type: "POST",
                url: "../../controllers/tarerDatosExtras.php",
                data: {
                    idTienda: idTienda
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    var data = response.data[0];
                    var image = `<img src="${data.banner}" class="card-img-top" style="width: 100%;" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/thumbnails/004/141/669/small/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';">`;
                    $("#imgTienda" + idTienda).html(image);
                    var titulo = `<h6>${data.nombreTienda}</h6>`;
                    $("#tituloTienda" + idTienda).html(titulo);

                    var horario = data.horario;
                    var horarioArray = horario.replace(/[()]/g, "").split(",");
                    var diasCierre = horarioArray.slice(2);
                    if (diasCierre.length === 0) {
                        diasCierre = "Abierto todos los dias";
                    } else {
                        if (diasCierre.some(elemento => !elemento)) {
                            diasCierre = "Abierto todos los dias";
                        }
                    }
                    if (estaAbierto(horarioArray)) {
                        var textito = `<div class="alert alert-success" role="alert">
                        <b>Negocio abierto.</b> Horario: ${horarioArray[0]} a ${horarioArray[1]} horas. Dias de cierre: ${diasCierre}</div>`;
                        $("#disponiblesHorario" + idTienda).html(textito);

                    } else {
                        var textito = `<div class="alert alert-warning" role="alert">
                        <b>Negocio cerrado.</b> Horario: ${horarioArray[0]} a ${horarioArray[1]} horas. Dias de cierre: ${diasCierre}</div>`;
                        $("#disponiblesHorario" + idTienda).html(textito);
                    }
                }
            });
        }





        function redirectStore(id) {
            window.location.href = "https://rutadelaseda.xyz/@" + id;
        }

        function productsMini(name, id) {
            $.ajax({
                type: "get",
                url: "objets/getMiniMenus.php",
                data: {

                    ids: name
                },
                dataType: "html",
                asycn: false,
                success: function(response) {
                    $("#mini" + id).html(response);


                }
            });
        }
    </script>
    <script src="js/paricles.js"></script>

    </html>
<?php
} else {
?>
    <!doctype html>
    <!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta property="og:title" content="RutaDeLaSeda | Tienda instantanea">
        <meta property="og:description" content="RutaDeLaSeda | Tienda instantanea">
        <meta property="og:image" content="images/rutadelaseda.png">
        <meta property="og:url" content="https://rutadelaseda.xyz/">
        <meta property="og:type" content="website">
        <meta property="og:image:width" content="500">
        <meta property="og:image:height" content="500">
        <title>RutaDeLaSeda | Tienda instantanea</title>
        <link rel="icon" type="image/x-icon" href="images/rutadelaseda.png" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <!-- jsFiddle will insert css and js -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
    <style>
        /**
 * @license
 * Copyright 2019 Google LLC. All Rights Reserved.
 * SPDX-License-Identifier: Apache-2.0
 */
        /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */


        /* 
 * Optional: Makes the sample page fill the window. 
 */
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .cristal {

            box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
            border-radius: 5px;
            background-color: rgba(245, 245, 245, .50);

            backdrop-filter: blur(5px);

        }

        #description {
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            background-color: #fff;
            border: 0;
            border-radius: 2px;
            box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
            margin: 10px;
            padding: 0 0.5em;
            font: 400 18px Roboto, Arial, sans-serif;
            overflow: hidden;
            font-family: Roboto;
            padding: 0;
            position: absolute;
            z-index: 2;
        }

        #pac-container {
            padding-bottom: 12px;

        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            margin-left: 12px;
            padding: 0 11px 0 13px;
            text-overflow: ellipsis;

        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #78c2ad;
            font-size: 18px;
            font-weight: 500;
            padding: 6px 12px;
        }

        #map {
            position: re;
            z-index: 1;
        }

        .cajita {
            box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;
        }

        .cajita2 {
            box-shadow: rgba(0, 0, 0, 0.56) 0px 22px 70px 4px;
        }

        .imagenCircular {
            width: 100px;
            height: 100px;
            margin-top: 30px;
            margin-left: 10px;
            border-radius: 50%;
            /* Esto hace que la imagen tenga forma circular */
            overflow: hidden;
            position: absolute;

            /* Esto asegura que la imagen no se salga de su contenedor */
            box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }

        .imagenCircular img {
            width: 100%;
            /* Ajusta el tamaño de la imagen al contenedor */
            height: auto;
            /* Mantiene la proporción original de la imagen */
            display: block;
            /* Asegura que la imagen se muestre correctamente */
        }

        .card {
            box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
        }
    </style>

    <body class="bg-primary">


        <div id="pac-card" class="col-12 cajita" style="border-radius: 12px; background-color: white;">
            <nav class="navbar navbar-expand-lg navbar-light" style="border:none; background-color: white;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="#"> <img src="images/logor.png" width="30" height="30" alt=""> RutaDeLaSeda</a>

                <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="../../register">Crear mi tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#startPub">Más información</a>
                        </li>


                    </ul>
                    <form class="d-flex" action="https://rutadelaseda.xyz/app/themp/smarticket.php" method="GET">
                        <input class="form-control my-2 me-sm-2" name="order" type="search" placeholder="¿Tiene una orden de compra?">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>
            <input type="hidden" id="lat">
            <input type="hidden" id="lng">

            <div class="col-12">

                <div id="type-selector" class="pac-controls" style="display: none;">
                    <input type="radio" name="type" id="changetype-all" checked="checked" />
                    <label for="changetype-all">All</label>

                    <input type="radio" name="type" id="changetype-establishment" />
                    <label for="changetype-establishment">establishment</label>

                    <input type="radio" name="type" id="changetype-address" />
                    <label for="changetype-address">address</label>

                    <input type="radio" name="type" id="changetype-geocode" />
                    <label for="changetype-geocode">geocode</label>

                    <input type="radio" name="type" id="changetype-cities" />
                    <label for="changetype-cities">(cities)</label>

                    <input type="radio" name="type" id="changetype-regions" />
                    <label for="changetype-regions">(regions)</label>
                </div>
                <br />
                <div id="strict-bounds-selector" class="pac-controls" style="display: none;">
                    <input type="checkbox" id="use-location-bias" value="" checked />
                    <label for="use-location-bias">Bias to map viewport</label>

                    <input type="checkbox" id="use-strict-bounds" value="" />
                    <label for="use-strict-bounds">Strict bounds</label>
                </div>
            </div>

            <div id="pac-container" class="d-flex justify-content-center container col-12 mt-5 mb-5">
                <div class="col-12">
                    <div class="col-12">

                        <h1 class="fw-bold lh-1">¡Encuentra productos locales rápidamente!</h1>
                    </div>
                    <br>
                    <div class="row col-12 mt-3 mb-5">
                        <div class=" mb-3 col-12 col-md-12 mb-3">

                            <input type="text" class="form-control" style="margin-left: 0px; margin-right: 0px;" id="pac-input" placeholder="¿Donde te encuentras?">
                        </div>
                        <h2 class="mt-3">Tiendas destacadas</h2>

                    </div>



                    <div id="infowindow-content">
                        <span id="place-name" class="title"></span><br />
                        <span id="place-address"></span>
                    </div>

                    <div class=" d-flex justify-content-center container mt-3">

                        <div class="col-12 row row-cols-1 row-cols-md-3 g-4" id="listaTienda"></div>
                    </div>


                </div>




            </div>


        </div>


        <div class="d-flex justify-content-center container col-12 mt-5 mb-5">
            <div class="embed-responsive embed-responsive-16by9 col-12" style="border-radius: 16px;">
                <video class="embed-responsive-item" controls>
                    <source src="images/media/Título (1).mp4" type="video/mp4">
                    Tu navegador no soporta la etiqueta de video.
                </video>
            </div>
        </div>
        <div class="col-12 cajita2" id="startPub" style="border-radius: 12px; background-color: white;">
            <div id="pac-container" class="d-flex justify-content-center container col-12 mt-5 mb-5">
                <div class="container col-xxl-8 px-4 py-5">
                    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                        <div class="col-10 col-sm-8 col-lg-6">
                            <img src="./images/telefonosMok.png" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                        </div>
                        <div class="col-lg-6">
                            <center>
                                <h2 class="fw-bold lh-1 mb-3">¡Diseña tu tienda en línea y empieza a vender hoy mismo!</h2>
                                <p class="lead">Comienza a crear tu tienda en minutos fácil y gratis.</p>
                            </center>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                                <center>
                                    <a href="https://wa.me/525578507299?text=Me%20gustaría%20conocer%20más%20información%20de%20la%20plataforma%20rutadelaseda" class="mb-3">
                                        <button type="button" class="btn btn-dark btn-lg px-4 me-md-2">Empezar ahora</button>
                                    </a>
                                    <br>
                                    <a name="" id="" class="btn btn-primary btn-lg px-4 me-md-2 mt-3" href="https://rutadelaseda.xyz/app/themp/page.php?id=ko7dah4p9hq41g6gojqdskof2g875%26YXJlYTNpQGdtYWlsLmNvbQ==" role="button">Ver demostración</a>

                                </center>


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
                        <div class="col-12 col-sm-8 col-lg-6">
                            <center>
                                <img src="./images/whatsVid.gif" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="250" style="border-radius: 12px;" loading="lazy">
                            </center>
                        </div>
                        <div class="col-lg-6">
                            <center>
                                <h2 class="fw-bold lh-1 mb-3">De tu catálogo a WhatsApp</h2>
                                <h2 class="fw-bold lh-1 mb-3 text-danger">¡la venta más fácil!</h2>

                            </center>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-2 mb-5">
                                <center>
                                    <h4>
                                        ¿Preparado para elevar tu negocio al siguiente nivel?
                                    </h4>
                                    <br>
                                    <a href="https://wa.me/525578507299?text=Me%20gustaría%20conocer%20más%20información%20de%20la%20plataforma%20rutadelaseda" class="mb-3">
                                        <button type="button" class="btn btn-dark btn-lg px-4 me-md-2">Empezar ahora</button>
                                    </a>
                                </center>



                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>

        <div style="height: 65%; border-radius: 16px; display: none;" id="map"></div>
        <!-- Footer -->
        <?php
        if ($_SESSION['types'] == 4) {
        ?>
            <footer class="bg-body-tertiary text-center fixed-bottom cristal">
                <center>
                    <div class="container row text-primary mt-3 mb-3">
                        <div class="col-6">
                            <center>
                                <a href="https://rutadelaseda.xyz/home" class="botonF1 text-primary">
                                    <i class="fas fa-shopping-cart fa-2x"></i>
                                </a>
                            </center>
                        </div>

                       <!--  <div class="col-4">
                            <center>
                                <a href="https://rutadelaseda.xyz/historial" class="botonF1 text-primary">
                                    <i class="fas fa-history fa-2x"></i></a>

                            </center>
                        </div> -->
                        <div class="col-6">
                            <center>
                                <a href="../../controllers/sessiondestroy.php" class="botonF1 text-primary">

                                    <i class="fas fa-power-off fa-2x"></i>
                                </a>

                            </center>
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

                            <a href="https://rutadelaseda.xyz/login2" class="btn btn-primary">
                                Iniciar sesion
                            </a>
                            <a href="https://rutadelaseda.xyz/register" class="ml-3 btn btn-outline-info btn-rounded">
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

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Aviso de privacidad y terminos de uso.</h5>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Política de privacidad</h1>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <p>Esta Política de Privacidad describe cómo Ruta de la Seda recopila, utiliza y comparte información cuando utilizas nuestra aplicación móvil Ruta de la Seda.</p>

                                        <h4>Información que Recopilamos</h4>
                                        <h5>Información que Nos Proporcionas</h5>
                                        <ul>
                                            <li><strong>Información de la Cuenta:</strong> Al crear una cuenta en la Aplicación, recopilamos tu nombre de usuario, dirección de correo electrónico y contraseña.</li>
                                            <li><strong>Información de Perfil:</strong> Puedes proporcionar información adicional en tu perfil, como tu nombre completo, dirección y número de teléfono.</li>
                                            <li><strong>Información de Transacciones:</strong> Recopilamos información sobre las transacciones que realizas a través de la Aplicación, como los productos que compras o vendes.</li>
                                        </ul>

                                        <h5>Información que Recopilamos Automáticamente</h5>
                                        <ul>
                                            <li><strong>Datos de Uso:</strong> Recopilamos información sobre cómo interactúas con la Aplicación, como las páginas que visitas y las acciones que realizas.</li>
                                            <li><strong>Información del Dispositivo:</strong> Recopilamos información sobre tu dispositivo móvil, incluyendo el modelo, sistema operativo e identificadores únicos.</li>
                                            <li><strong>Ubicación:</strong> La Aplicación puede recopilar tu ubicación precisa cuando la función de ubicación esté habilitada en tu dispositivo móvil. Esta información se utiliza para proporcionar funciones basadas en la ubicación, como la búsqueda de tiendas cercanas.</li>
                                        </ul>

                                        <h4>Uso de la Información</h4>
                                        <p>Utilizamos la información recopilada para:</p>
                                        <ul>
                                            <li>Proporcionar y mantener la funcionalidad de la Aplicación.</li>
                                            <li>Personalizar tu experiencia y ofrecerte contenido y anuncios relevantes.</li>
                                            <li>Procesar transacciones y facilitar la comunicación entre usuarios.</li>
                                            <li>Mejorar y optimizar nuestra Aplicación.</li>
                                        </ul>

                                        <h4>Compartir Información</h4>
                                        <p>No compartimos tu información personal con terceros, excepto en las siguientes circunstancias:</p>
                                        <ul>
                                            <li>Con tu consentimiento.</li>
                                            <li>Cuando sea necesario para procesar transacciones o proporcionar servicios solicitados por ti.</li>
                                            <li>Cuando sea requerido por ley o en respuesta a procesos legales.</li>
                                        </ul>

                                        <h4>Seguridad de la Información</h4>
                                        <p>Tomamos medidas para proteger la seguridad de tu información personal y mantenemos procedimientos para garantizar su seguridad.</p>

                                        <h4>Cambios en la Política de Privacidad</h4>
                                        <p>Podemos actualizar esta Política de Privacidad de vez en cuando. Te notificaremos cualquier cambio mediante la publicación de la Política de Privacidad actualizada en la Aplicación.</p>

                                        <h4>Contacto</h4>
                                        <p>Si tienes alguna pregunta sobre esta Política de Privacidad, contáctanos en contacto@rutadelaseda.xyz</a>.</p>
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Términos de Uso de Ruta de la Seda</h1>
                            </div>
                            <div class="container">
                                <h2>1. Uso de la Aplicación</h2>
                                <p>Al utilizar Ruta de la Seda, usted acepta utilizar la aplicación únicamente para los fines previstos y de acuerdo con estos términos de uso.</p>
                                <p>Usted es responsable de mantener la confidencialidad de su cuenta y contraseña, y de restringir el acceso a su dispositivo para evitar cualquier uso no autorizado de su cuenta.</p>

                                <h2>2. Gestión de Productos</h2>
                                <p>Los usuarios pueden agregar productos manualmente o utilizar la función de búsqueda integrada para obtener detalles automáticamente de una red de información de Google. Los usuarios son responsables de la precisión y la actualización constante del inventario de productos.</p>
                                <p>Ruta de la Seda no se hace responsable de la precisión de la información proporcionada por la función de búsqueda integrada y recomienda verificar la información antes de publicarla en la tienda.</p>

                                <h2>3. Personalización de Tiendas</h2>
                                <p>Los usuarios tienen la libertad de diseñar su tienda utilizando plantillas prediseñadas o creando diseños personalizados para una experiencia de compra única.</p>
                                <p>El contenido y el diseño de la tienda son responsabilidad exclusiva del usuario. Ruta de la Seda no se hace responsable de cualquier reclamación relacionada con el contenido de la tienda.</p>

                                <h2>4. Gestión de Vendedores</h2>
                                <p>Los usuarios pueden administrar fácilmente su equipo de ventas y asegurarse de que todos los productos estén representados de manera precisa y profesional.</p>
                                <p>Ruta de la Seda no se hace responsable de las transacciones realizadas entre vendedores y compradores. Cualquier disputa debe resolverse directamente entre las partes involucradas.</p>

                                <h2>5. Herramientas para Repartidores</h2>
                                <p>Los repartidores pueden visualizar las tiendas asociadas y acceder al historial de pedidos para proporcionar un servicio de entrega eficiente.</p>
                                <p>Los repartidores son responsables de mantener actualizada su información de perfil y de cumplir con los procedimientos de entrega establecidos por cada tienda.</p>

                                <h2>6. Modificaciones y Actualizaciones</h2>
                                <p>Ruta de la Seda se reserva el derecho de modificar, suspender o interrumpir cualquier parte de la aplicación en cualquier momento, con o sin previo aviso.</p>
                                <p>Se recomienda a los usuarios revisar periódicamente estos términos de uso para estar al tanto de cualquier cambio. El uso continuado de la aplicación después de la publicación de cambios constituirá la aceptación de dichos cambios.</p>

                                <h2>7. Contacto</h2>
                                <p>Si tiene alguna pregunta o inquietud sobre estos términos de uso, no dude en ponerse en contacto con nosotros en contacto@rutadelaseda.xyz.</p>

                                <p>Al utilizar Ruta de la Seda, usted reconoce haber leído, comprendido y aceptado estos términos de uso en su totalidad.</p>

                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" onclick="acepto()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                var valor = localStorage.getItem('avisoM');
                if (valor == "true") {} else {
                    var myModal = new bootstrap.Modal(document.getElementById('staticBackdrop'));
                    myModal.show();
                    localStorage.setItem('avisoM', 'true');
                }
                calcularPuntosProximos("19.6218644", "-99.1102578");
            });

            function acepto() {
                $("#staticBackdrop").hide();
                $('body').removeClass('modal-open'); //eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();
            }

            function showCart() {

                var parametro2 = $("#lat").val();
                var parametro3 = $("#lng").val();

                if (parametro2 && parametro3) {
                    /* calcularPuntosProximos(parametro2, parametro3); */
                    const url = `https://rutadelaseda.xyz/app/themp/page.php?id=i71oiev3bfnh3q0j6qhn6ermpa285%26contacto@rutadelaseda.xyz&lat=${parametro2}&lng=${parametro3}`;

                    // Redirige al usuario a la URL
                    window.location.href = url;
                } else {



                    Swal.fire({
                        title: '!Error!',
                        text: 'Selecciona una dirección valida',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    })
                }

            }
            /**
             * @license
             * Copyright 2019 Google LLC. All Rights Reserved.
             * SPDX-License-Identifier: Apache-2.0
             */
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {

                    center: {
                        lat: 19.4303926,
                        lng: -99.1372921
                    },
                    zoom: 13,
                    mapTypeControl: false,
                    disableDefaultUI: true, // Desactiva los controles predeterminados
                    gestureHandling: 'none'
                });
                const card = document.getElementById("pac-cards");
                const input = document.getElementById("pac-input");
                const biasInputElement = document.getElementById("use-location-bias");
                const strictBoundsInputElement = document.getElementById("use-strict-bounds");
                const options = {
                    fields: ["formatted_address", "geometry", "name"],
                    strictBounds: false,
                };

                map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

                const autocomplete = new google.maps.places.Autocomplete(input, options);

                // Bind the map's bounds (viewport) property to the autocomplete object,
                // so that the autocomplete requests use the current map bounds for the
                // bounds option in the request.
                autocomplete.bindTo("bounds", map);

                const infowindow = new google.maps.InfoWindow();
                const infowindowContent = document.getElementById("infowindow-content");

                infowindow.setContent(infowindowContent);

                const marker = new google.maps.Marker({
                    map,
                    anchorPoint: new google.maps.Point(0, -29),
                });

                autocomplete.addListener("place_changed", () => {
                    fillInAddress();
                    infowindow.close();
                    marker.setVisible(false);

                    const place = autocomplete.getPlace();

                    if (!place.geometry || !place.geometry.location) {
                        // User entered the name of a Place that was not suggested and
                        // pressed the Enter key, or the Place Details request failed.
                        window.alert("No details available for input: '" + place.name + "'");
                        return;
                    }

                    // If the place has a geometry, then present it on a map.
                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }

                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);
                    infowindowContent.children["place-name"].textContent = place.name;
                    infowindowContent.children["place-address"].textContent =
                        place.formatted_address;
                    infowindow.open(map, marker);
                });


                function fillInAddress() {

                    // Get the place details from the autocomplete object.
                    const place = autocomplete.getPlace();

                    console.log(place);

                    $("#lat").val(place.geometry.location["lat"]);
                    $("#lng").val(place.geometry.location["lng"]);

                    // After filling the form with address components from the Autocomplete
                    // prediction, set cursor focus on the second address line to encourage
                    // entry of subpremise information such as apartment, unit, or floor number.
                    showCart();
                }

                // Sets a listener on a radio button to change the filter type on Places
                // Autocomplete.
                function setupClickListener(id, types) {
                    const radioButton = document.getElementById(id);

                    radioButton.addEventListener("click", () => {
                        autocomplete.setTypes(types);
                        input.value = "";
                    });
                }

                setupClickListener("changetype-all", []);
                setupClickListener("changetype-address", ["address"]);
                setupClickListener("changetype-establishment", ["establishment"]);
                setupClickListener("changetype-geocode", ["geocode"]);
                setupClickListener("changetype-cities", ["(cities)"]);
                setupClickListener("changetype-regions", ["(regions)"]);
                biasInputElement.addEventListener("change", () => {
                    if (biasInputElement.checked) {
                        autocomplete.bindTo("bounds", map);
                    } else {
                        // User wants to turn off location bias, so three things need to happen:
                        // 1. Unbind from map
                        // 2. Reset the bounds to whole world
                        // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
                        autocomplete.unbind("bounds");
                        autocomplete.setBounds({
                            east: 180,
                            west: -180,
                            north: 90,
                            south: -90
                        });
                        strictBoundsInputElement.checked = biasInputElement.checked;
                    }

                    input.value = "";
                });
                strictBoundsInputElement.addEventListener("change", () => {
                    autocomplete.setOptions({
                        strictBounds: strictBoundsInputElement.checked,
                    });
                    if (strictBoundsInputElement.checked) {
                        biasInputElement.checked = strictBoundsInputElement.checked;
                        autocomplete.bindTo("bounds", map);
                    }

                    input.value = "";
                });
            }

            window.initMap = initMap;




            function calcularPuntosProximos(miLatitud, miLongitud) {
                function calcularDistancia(lat1, lon1, lat2, lon2) {
                    var R = 6371; // Radio de la Tierra en kilómetros
                    var dLat = toRad(lat2 - lat1);
                    var dLon = toRad(lon2 - lon1);
                    var a =
                        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    var distancia = R * c; // Distancia en kilómetros
                    return distancia;
                }

                function toRad(grados) {
                    return grados * Math.PI / 180;
                }

                function encontrarCoordenadasCercanas(miLatitud, miLongitud, coordenadas) {
                    var coordenadasCercanas = [];

                    coordenadas.forEach(function(coordenada) {
                        var distancia = calcularDistancia(miLatitud, miLongitud, coordenada.latitud, coordenada.longitud);
                        coordenadasCercanas.push({
                            coordenada: coordenada,
                            distancia: distancia,
                            id: coordenada.id,
                            image: coordenada.image,
                            name: coordenada.name,
                            phone: coordenada.phone,
                            category: coordenada.category
                        });
                    });

                    coordenadasCercanas.sort(function(a, b) {
                        return a.distancia - b.distancia;
                    });

                    return coordenadasCercanas.slice(0, 20); // Devuelve solo los primeros 10 resultados
                }

                // Ejemplo de uso


                var listaCoordenadas = [
                    <?php
                    $counter = 0;
                    $first = true;

                    while ($arreglo = mysqli_fetch_array($sql2)) {
                        if ($arreglo[0] == "346" || $arreglo[0] == "320" || $arreglo[0] == "374") {
                            if (!$first) {
                                echo ",\n"; // Agregar una coma y un salto de línea si no es el primer elemento
                            }
                            $first = false;
                    ?> {
                                latitud: "<?= $arreglo['lat'] ?>",
                                longitud: "<?= $arreglo['long'] ?>",
                                id: "<?= $arreglo[0] ?>",
                                image: "<?= $arreglo['logojpg'] ?>",
                                name: "<?= $arreglo['createdby'] ?>",
                                phone: "<?= $arreglo['phone'] ?>",
                                category: "<?= $arreglo['category'] ?>"
                            }
                    <?php
                            $counter++;
                        }
                    }
                    ?>
                ];


                var coordenadasCercanas = encontrarCoordenadasCercanas(miLatitud, miLongitud, listaCoordenadas);
                detalleTiendas(coordenadasCercanas);

            }

            function detalleTiendas(params) {

                var mensaje;
                var category;
                var numero;
                var numero2;
                params.forEach(function(coordenada) {
                    numero = coordenada.distancia;
                    numero2 = numero.toFixed(2).toString();
                    switch (coordenada.category) {
                        case "1":
                            category = "Alimentos";

                            break;
                        case "2":
                            category = "Moda";

                            break;
                        case "3":
                            category = "Moda";

                            break;
                        case "4":
                            category = "Jugetes";

                            break;
                        case "5":
                            category = "Videojuegos";

                            break;
                        case "6":
                            category = "Electrónica";

                            break;
                        case "7":
                            category = "Informática";

                            break;
                        case "8":
                            category = "Electrodomésticos";

                            break;
                        case "9":
                            category = "Varios";

                            break;
                        case "10":
                            category = "Adultos";

                            break;


                    }
                    if (numero2) {
                        mensaje = `
                    <div
              class="card mb-3 col-12 col-md-6"
              style="cursor: pointer"
              onclick="redirectStore(${coordenada.id})"
            >
            
              <div id="imgTienda${coordenada.id}"></div>
              <div class="imagenCircular">
                <img src="${coordenada.image}" alt="Descripción de la imagen">
                </div>
                <div id="disponiblesHorario${coordenada.id}"></div>
              <div class="card-body">
              <div class= "row">
              <div id="tituloTienda${coordenada.id}" class="col-12"></div>
              <div class="col-12"><h6 class="card-title"><span class="badge bg-info">${category}</span></h6></div>
              </div>
                    
                
                
                <p class="card-text mt-3">
                  <small class="text-muted"
                    >A ${numero2} Km de tu referenciá.</small
                  >
                </p>
              </div>
            </div>
                `;
                    }

                    $("#listaTienda").append(mensaje);
                    productsMini(coordenada.name, coordenada.id);
                    traerExtras(coordenada.id);
                });
            }

            function traerExtras(idTienda) {
                var entero = parseInt(idTienda);

                function parseTime(timeString) {
                    const [hours, minutes] = timeString.split(":").map(Number);
                    const date = new Date();
                    date.setHours(hours, minutes, 0, 0);
                    return date;
                }

                function estaAbierto(horario) {
                    const ahora = new Date();
                    const options = {
                        weekday: 'long',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: false
                    };
                    const diaActual = ahora.toLocaleString('es-ES', options).split(',')[0].toLowerCase();
                    const horaActual = ahora.getHours().toString().padStart(2, '0') + ":" + ahora.getMinutes().toString().padStart(2, '0');

                    const horaApertura = horario[0];
                    const horaCierre = horario[1];
                    const diasCierre = horario.slice(2);

                    const horaAperturaDate = parseTime(horaApertura);
                    const horaCierreDate = parseTime(horaCierre);
                    const horaActualDate = parseTime(horaActual);

                    // Verificar si es un día de cierre
                    if (diasCierre.includes(diaActual)) {
                        return false;
                    }

                    // Verificar si está dentro del horario de apertura y cierre
                    if (horaActualDate >= horaAperturaDate && horaActualDate <= horaCierreDate) {
                        return true;
                    } else {
                        // Caso especial para horarios de cierre después de medianoche (e.g., 22:00 - 02:00)
                        if (horaAperturaDate > horaCierreDate) {
                            if (horaActualDate >= horaAperturaDate || horaActualDate <= horaCierreDate) {
                                return true;
                            }
                        }
                        return false;
                    }
                }


                $.ajax({
                    type: "POST",
                    url: "../../controllers/tarerDatosExtras.php",
                    data: {
                        idTienda: entero
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        var data = response.data[0];
                        var image = `
    <div style="position: relative; width: 100%; height: 15vh; margin-top:10px; ">
        <img src="${data.banner}" style="border-radius: 9px; width: 100%; height: 100%; object-fit: cover;" alt="Banner" onerror="this.onerror=null;this.src='https://static.vecteezy.com/system/resources/thumbnails/004/141/669/small/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg';">
        <div style="position: absolute; bottom: 0; left: 0; width: 100%; height: 40%; background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 1) 100%);"></div>
    </div>
`;
                        $("#imgTienda" + idTienda).html(image);
                        var titulo = `<h6>${data.nombreTienda}</h6>`;
                        $("#tituloTienda" + idTienda).html(titulo);

                        var horario = data.horario;
                        var horarioArray = horario.replace(/[()]/g, "").split(",");
                        var diasCierre = horarioArray.slice(2);
                        if (diasCierre.length === 0) {
                            diasCierre = "Abierto todos los dias";
                        } else {
                            if (diasCierre.some(elemento => !elemento)) {
                                diasCierre = "Abierto todos los dias";
                            }
                        }
                        if (estaAbierto(horarioArray)) {
                            var textito = `<div class="alert alert-success" role="alert">
                        <b>Negocio abierto.</b> Horario: ${horarioArray[0]} a ${horarioArray[1]} horas. Dias de cierre: ${diasCierre}</div>`;
                            $("#disponiblesHorario" + idTienda).html(textito);

                        } else {
                            var textito = `<div class="alert alert-warning" role="alert">
                        <b>Negocio cerrado.</b> Horario: ${horarioArray[0]} a ${horarioArray[1]} horas. Dias de cierre: ${diasCierre}</div>`;
                            $("#disponiblesHorario" + idTienda).html(textito);
                        }
                    }
                });
            }

            function redirectStore(id) {
                window.location.href = "https://rutadelaseda.xyz/@" + id;
            }

            function productsMini(name, id) {
                $.ajax({
                    type: "get",
                    url: "objets/getMiniMenus.php",
                    data: {

                        ids: name
                    },
                    dataType: "html",
                    asycn: false,
                    success: function(response) {
                        $("#mini" + id).html(response);


                    }
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&callback=initMap&libraries=places&v=weekly" defer></script>
    </body>

    </html>
<?php
}
?>