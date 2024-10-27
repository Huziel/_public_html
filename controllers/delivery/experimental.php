<?php
require('../../app/themp/objets/core.php');
$query = "SELECT * FROM liks WHERE lat <> 'null' GROUP BY createdby";
$sql = mysqli_query($con, $query);
?>
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
</style>
<div class="map-responsive aviso">
    <div id="capa-mapa" class="map-responsives"></div>
</div>
<div id="catalog"></div>
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
            zoom: 14,
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