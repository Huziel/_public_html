<?php
session_start();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$idSession = session_id();
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$sessionN = (isset($_GET['session']) ? $_GET['session'] : null);
$keyP = (isset($_GET['pr']) ? $_GET['pr'] : null);
if ($id) {
    require('./objets/core.php');
    require('./objets/head.php');
    $query_v = "SELECT * FROM `liks` WHERE createdby = '$id';";
    $queryUp = "UPDATE `liks` SET `session` = '$idSession' WHERE `liks`.`serial` = '$id'";
    $sql = mysqli_query($con, $query_v);

    while ($arreglo = mysqli_fetch_array($sql)) {
        $idStore = $arreglo[0];
        $number = $arreglo[3];
        $serialC = $arreglo[1];
        $session = $arreglo[4];
        $logo = $arreglo[12];
        $nameP = $arreglo[5];
        $costos = $arreglo['color'];
        $paypal = $arreglo['paypal'];
        $lat = $arreglo['lat'];
        $long = $arreglo['long'];
    }
    $queryColors = "SELECT * FROM `colores` WHERE idStore = '$idStore'";
    $sqlColor = mysqli_query($con, $queryColors);
    while ($arregloColor = mysqli_fetch_array($sqlColor)) {
        $coloruno = $arregloColor[2];
        $colordos = $arregloColor[3];
        $colortres = $arregloColor[4];
        $colorcuatro = $arregloColor[5];
        $colorcinco = $arregloColor[6];
    }
    $taxes  = $costos;
    $part = explode("|", $taxes);
    $precioBase = $part[0];
    $precioMedio = $part[1];
    $precioLargo = $part[2];
    $tiempoComi = $part[3];


    $query_apa = "SELECT * FROM `apartados` WHERE `apartados`.`tienda` = '$idStore'";
    $sqlApa = mysqli_query($con, $query_apa);
    while ($arregloA = mysqli_fetch_array($sqlApa)) {
        $valueApartado = $arregloA[2];
    }
    $query_Tienda = "SELECT * FROM `temasTienda` WHERE `temasTienda`.`userId` = '$idStore'";
    $sqlTiend = mysqli_query($con, $query_Tienda);
    while ($arregloTien = mysqli_fetch_array($sqlTiend)) {
        $theme = $arregloTien[2];
    }
    switch ($theme) {

        default:
            $theme = '<link rel="stylesheet" href="css/bootstrapM.min.css">';
            break;
    }
?>

    <!DOCTYPE html>
    <html lang="en">


    <head>

        <meta property="og:type" content="website" />
        <meta property="og:title" content="<?= $nameP ?>" />
        <meta property="og:description" content="<?= $nameP ?>" />
        <meta property="og:image" content="<?= $logo ?>" />
        <title>RutaDeLaSeda</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="images/gotaverde.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/stylesM.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.3.3/sketchy/bootstrap.min.css" integrity="sha512-y4F259NzBXkxhixXEuh574bj6TdXVeS6RX+2x9wezULTmAOSgWCm25a+6d0IQxAnbg+D4xIEJoll8piTADM5Gg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
        <style>
            .abs-center {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 50vh;
            }

            .boxes {
                box-shadow: rgba(0, 0, 0, 0.3) 0px 19px 38px, rgba(0, 0, 0, 0.22) 0px 15px 12px;
            }

            .video-fluid {
                max-width: 100%;
                height: auto;
            }

            body {

                background-color: <?= $colorBack ?> !important;

                background-position: center;
                /* Center the image */
                background-repeat: no-repeat;
                /* Do not repeat the image */
                background-size: cover;
            }

            .jumbotron {

                box-shadow: 0 0 1rem 0 rgba(0, 0, 0, .2);
                border-radius: 5px;
                background-color: rgba(255, 255, 255, .15);

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
                box-shadow: 0 0 4px 1px rgba(0, 0, 0, .4);
                vertical-align: middle;
            }

            .menuC {

                background-color: #ced4da;
                border-radius: 15px;

                background: rgba(255, 255, 255, .90);
                -webkit-backdrop-filter: blur(5px);
                backdrop-filter: blur(5px);
                border: 1.5px solid rgba(209, 213, 219, 0.3);
                margin-top: 15px;
                margin-bottom: 15px;
            }

            .dataTables_wrapper .dataTables_filter {
                width: 100%;
                text-align: center;
            }

            #map {
                height: 500px;
                width: 100%;
            }

            /* 
 * Optional: Makes the sample page fill the window. 
 */


            #floating-panel {

                display: none;

            }
        </style>
    </head>

    <body class="bg-light text-white"">
    <a href=" https://rutadelaseda.xyz/@<?= $idStore ?>" class="btn btn-dark">
        <i class="fas fa-arrow-left"></i>
        </a>
        <div class=" viewP">
        </div>
        <?php
        if ($precioBase == 0) {
        } else {
        ?>
            <center><button type="button" onclick="noSend()" class="btn btn-secondary">Recoger en tienda</button></center>

        <?php
        }
        ?>
        <br>
        <input type="hidden" id="TotVal">
        <input type="hidden" id="envio">

        <input type="hidden" id="lat1">
        <input type="hidden" id="long1">
        <input type="hidden" id="resEnv" value="Envio">
        <div id="floating-panel">
            <b>Mode of Travel: </b>
            <select id="mode">
                <option value="DRIVING">Driving</option>
                <option value="WALKING">Walking</option>
                <option value="BICYCLING">Bicycling</option>
                <option value="TRANSIT">Transit</option>
            </select>
        </div>
        <?php
        if ($precioBase == 0) {
        ?>
            <div class="container" style="display: none;">

                <center>
                    <div style="border-radius: 16px;" id="map"></div>
                </center>
                <br>


            </div>
        <?php
        } else {
        ?>
            <div class="container">

                <center>
                    <div style="border-radius: 16px;" id="map"></div>
                </center>
                <br>


            </div>
        <?php
        }
        ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"></h4>
            <p>Este es un precio aproximado, el total puede variar segun el tipo de pedido.</p>
            <p class="mb-0"></p>
        </div>

        <br>
        <center>
            <button type="button" id="buttonsPay" class="btn btn-success  btn-lg mb-2" data-bs-toggle="modal" data-bs-target="#pedido_modal">
                <?php
                if ($precioBase == 0) {
                ?>
                    Continuar cotizando <i class="fas fa-shopping-cart"></i>
            </button>
        <?php
                } else {
        ?>

        <?php
                }
                if ($valueApartado && $valueApartado > 0) {
        ?>
            <h4 class="titleHide">Ó</h4>
            <button type="button" onclick="apliApartado()" class="btn btn-secondary  btn-lg mt-2 titleHide">
                Apartar productos <i class="fas fa-shopping-basket"></i>
            </button>
        <?php
                }
        ?>



        <input type="hidden" id="valueApartadoIn" name="valueApartadoIn" value="">
        <script>
            function noSend() {
                $.ajax({
                    type: "POST",
                    url: "objets/countP.php",
                    data: {
                        serial: "<?= $serialC ?>"
                    },
                    dataType: "html",
                    success: function(data) {

                        $("#countPr").html(data);
                        $("#envioT").html('$' + '0');
                        $("#TotVal").val(data);
                        let newStr = data.slice(1)
                        let subT = parseFloat(newStr);
                        let totEnMas = subT;
                        $("#totT").html('$' + totEnMas.toFixed(2));
                        $("#resEnv").val("Recoge en tienda");
                        $("#envio").val(0);

                        Swal.fire({
                            title: 'Estaremos preparando su pedido',
                            icon: 'info',
                            timer: 2000,
                            timerProgressBar: true
                        })

                    }

                });

            }

            function apliApartado() {
                $(".titleHide").hide();
                $.ajax({
                    type: "POST",
                    url: "objets/countP.php",
                    data: {
                        serial: "<?= $serialC ?>"
                    },
                    dataType: "html",
                    success: function(data) {

                        $("#countPr").html(data);
                        $("#envioT").html('$' + '0');
                        $("#TotVal").val(data);
                        let newStr = data.slice(1)
                        let subT = parseFloat(newStr);
                        let totEnMas = subT;

                        let valor = totEnMas;
                        let porcentaje = <?= $valueApartado ?>;
                        let valorConPorcentajeQuitado = valor - (valor * (porcentaje / 100));


                        $("#valueApartadoIn").val(valorConPorcentajeQuitado);


                        $("#totT").html('$' + valorConPorcentajeQuitado.toFixed(2));
                        $("#resEnv").val("Apartado");
                        $("#envio").val(0);

                        Swal.fire({
                            title: 'Haz aplicado un apartado',
                            icon: 'info',
                            timer: 2000,
                            timerProgressBar: true
                        })

                    }

                });
            }
        </script>

        </center>
        <br>
        <div class="modal bg-dark" id="pedido_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog">
            <div class="modal-dialog " role="document">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Para finalizar!</h5>

                    </div>
                    <div class="modal-body">
                        <div class="form-group">

                            <div id="formulario" class="formulario">
                                <label class="col-form-label text-dark" for="inputDefault">Confirma tu número donde te podamos contactar</label>
                                <input class="form-control" id="nombre" value="<?php if ($_SESSION['nameClienteUnique']) {
                                                                                    echo $_SESSION['nameClienteUnique'];
                                                                                } else {
                                                                                    echo $_SESSION['nombre'];
                                                                                }  ?>" placeholder="Nombre" type="hidden" name="Nombre">
                                <br>
                                <input class="form-control" id="numeroTelUser" placeholder="WhatsApp" type="number" value="<?= $_SESSION['phone'] ?>" name="">
                                <br>
                                <div class="d-grid gap-2">
                                    <button type="button" name="btnOrder" id="btnOrder" onclick="OrderCProduct()" class="btn btn-success">
                                        Confirmar
                                    </button>
                                </div>

                                <div class="progress" id="idCompraProgress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                </div>
                                <br>

                                <input type="hidden" class="form-control" id="status" readonly>

                            </div>
                            <div class="row">
                                <div class="col-12">

                                    <div id="buttonWhats"></div>
                                    <br>
                                    <center>
                                        <h3 class="textoRancio text-primary">Agilizar pedido o cotizar envio nacional</h3>
                                    </center>
                                    <br>
                                    <div class="alert alert-success textoRancio text-primary" role="alert">
                                        Para consultar el estado inmediato de tu pedido, contáctanos por WhatsApp haciendo click en el siguiente botón.

                                    </div>
                                    <br>
                                    <button type="button" style="display: none;" onclick="orderWhats(event)" class="btn btn-outline-success btn-block boxshadowD" id="submit"><i class="fab fa-whatsapp"></i> Enviar mensaje</button>
                                    <br>
                                </div>

                            </div>

                            <br>

                          



                        </div>

                    </div>
                </div>
            </div>
        </div>




    </body>


    </html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#idCompraProgress').hide();
            $('#buttonsPay').hide();
            $('.textoRancio').hide();
            changeBootstrapColors();
        });

        function validarTelefono(numero, digitosEsperados) {
            // Elimina espacios, guiones y paréntesis que puedan estar en el número
            const numeroLimpio = numero.replace(/\D/g, '');

            // Verifica si el número tiene la cantidad de dígitos esperados
            if (numeroLimpio.length === digitosEsperados) {
                return true; // El número es válido
            } else {
                return false; // El número no tiene el tamaño correcto
            }
        }


        function changeBootstrapColors() {




            const style = document.createElement('style');

            var primo = "<?= $coloruno ?>";
            var secon = "<?= $colordos ?>";
            var lights = "<?= $colortres ?>";
            var darks = "<?= $colorcuatro ?>";
            var cuccessI = "<?= $colorcinco ?>";

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
.alert-success {
    color: var(--dark) !important;
    background-color: var(--colorcinco) !important;
    border-color: var(--primary) !important;
}
`;

            document.head.appendChild(style);
        }

        function viewP() {

            $.ajax({
                type: 'POST',
                url: 'cartTableCotizador.php',
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

                    $(".viewP").html(data);
                },
                error: function(data) {

                    alert("Problemas al tratar de enviar el formulario");
                },
            });
        };

        viewP();
        /* setInterval(viewP, 115000); */

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
                    viewP();
                    var totalEnvio = $("#envio").val();

                    initMap();
                }
            });
        }

        function isMobile() {
            if (sessionStorage.desktop)
                return false;
            else if (localStorage.mobile)
                return true;
            var mobile = ['iphone', 'ipad', 'android', 'blackberry', 'nokia', 'opera mini', 'windows mobile', 'windows phone', 'iemobile'];
            for (var i in mobile)
                if (navigator.userAgent.toLowerCase().indexOf(mobile[i].toLowerCase()) > 0) return true;
            return false;
        }

        const buttonSubmit = document.querySelector('#submit');
        const urlDesktop = 'https://api.whatsapp.com/';
        const urlMobile = 'https://api.whatsapp.com/';

        function orderWhats(event) {
            event.preventDefault();
            buttonSubmit.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>'
            buttonSubmit.disabled = true
            setTimeout(() => {
                let pedido = document.querySelector('#pedidoBack').value
                let tot = document.querySelector('#TotVal').value
                let str = tot
                let newStr = str.slice(1)
                let newVal = parseFloat(newStr)
                let totEn = parseFloat(document.querySelector('#envio').value)
                let totEnMas = String(newVal + totEn)
                let apellidos = document.querySelector('#nombre').value

                let telefono = document.querySelector('#phoneIn').value
                let tienda = document.querySelector('#nameStore').value
                let orden = document.querySelector('#orden').value
                let status = document.querySelector('#status').value
                let lat1 = document.querySelector('#lat1').value
                let long1 = document.querySelector('#long1').value
                let resEnv = document.querySelector('#resEnv').value
                let mensaje = 'send?phone=+52' + telefono + '&text=Nueva Orden 🛵 (' + tienda + ')(no.' + orden + ')%0A*Pedido de:*%0A' + apellidos + '%0A*Pedido:*%0A' + pedido + '%0A*Total - ' + resEnv + ':*%0A' + totEnMas + '%0A*Puede consultar su ticket en: *%0A' + 'https://rutadelaseda.xyz/app/themp/smarticket.php?order=' + orden + ''
                if (isMobile()) {
                    function OrderC() {
                        var orden = document.querySelector('#orden').value
                        var lat1 = document.querySelector('#lat1').value
                        var long1 = document.querySelector('#long1').value
                        var totEn = parseFloat(document.querySelector('#envio').value)
                        var tot = document.querySelector('#TotVal').value
                        $.ajax({
                            type: "POST",
                            url: "orderC.php",
                            data: {
                                order: order,
                                serial: "<?= $serialC ?>",
                                session: "<?= $idSession ?>",
                                lat: lat1,
                                long: long1,
                                tot: tot,
                                totEnv: totEn
                            },
                            dataType: "html",
                            success: function(response) {

                            }
                        });
                    }

                    window.open(urlMobile + mensaje, '_blank')
                } else {


                    window.open(urlDesktop + mensaje, '_blank')

                }
                buttonSubmit.innerHTML = '<i class="fab fa-whatsapp"></i> Enviar WhatsApp'
                buttonSubmit.disabled = false
                location.reload();
            }, 3000);
        }
    </script>




    <script>
        function initMap() {
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const directionsService = new google.maps.DirectionsService();
            const traficService = new google.maps.DistanceMatrixService();


            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: {
                    lat: <?= $lat ?>,
                    lng: <?= $long ?>
                },
            });

            //almacenamos en variables la longitud y latitud
            var iLongitud = <?= $long ?>,
                iLatitud = <?= $lat ?>;
            $("#lat1").val(iLatitud);
            $("#long1").val(iLongitud);
            //pasamos las variables por ajax



            directionsRenderer.setMap(map);
            calculateAndDisplayRoute(traficService, directionsService, directionsRenderer, iLongitud, iLatitud);
            document.getElementById("mode").addEventListener("change", () => {
                calculateAndDisplayRoute(traficService, directionsService, directionsRenderer, iLongitud, iLatitud);
            });



        }

        function calculateAndDisplayRoute(traficService, directionsService, directionsRenderer, iLongitud, iLatitud) {
            const selectedMode = document.getElementById("mode").value;

            /*  console.log(iLongitud);
             console.log(iLatitud); */
            directionsService
                .route({
                    origin: {
                        lat: <?= $lat ?>,
                        lng: <?= $long ?>
                    },
                    destination: {
                        lat: iLatitud,
                        lng: iLongitud
                    },
                    // Note that Javascript allows us to access the constant
                    // using square brackets and a string value as its
                    // "property."
                    travelMode: google.maps.TravelMode["DRIVING"],
                })
                .then((response) => {
                    // Aqui con el response podemos acceder a la distancia como texto
                    /*  console.log(response.routes[0].legs[0].distance.text); */
                    // Obtenemos la distancia como valor numerico en metros
                    /* console.log(response.routes[0].legs[0].distance.value); */
                    /*  console.log(response.routes[0].legs[0].duration.value); */
                    /* console.log(response); */
                    /* var time = (response.routes[0].legs[0].duration.value) / 60;

                    var km = response.routes[0].legs[0].distance.value / 1000;
                    var totalEnvio;

                    if (km <= 1) {
                        totalEnvio = 35;
                        $("#envio").val(totalEnvio);
                    } else if (km < 15) {
                        totalEnvio = ((km * 7) + (time * 1.8) + (35));
                        $("#envio").val(totalEnvio);

                    } else if (km > 15) {
                        totalEnvio = ((km * 4) + (time * 1.8) + (35));
                        $("#envio").val(totalEnvio);
                    }


                    counPr(totalEnvio); */



                    directionsRenderer.setDirections(response);
                })
                .catch((e) =>
                    window.alert("Directions request failed due to " + status)
                );
            const request = {
                origins: [{
                    lat: <?= $lat ?>,
                    lng: <?= $long ?>
                }],
                destinations: [{
                    lat: iLatitud,
                    lng: iLongitud
                }],
                travelMode: google.maps.TravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                avoidHighways: false,
                avoidTolls: false,
                drivingOptions: {
                    departureTime: new Date(Date.now()), // for the time N milliseconds from now.
                    trafficModel: 'optimistic'
                }
            };
            traficService.getDistanceMatrix(request).then((response) => {
                /* console.log(response);
                console.log(response.rows[0].elements[0].distance.value);
                console.log(response.rows[0].elements[0].duration_in_traffic.value); */

                var time = (response.rows[0].elements[0].duration_in_traffic.value) / 60;

                var km = response.rows[0].elements[0].distance.value / 1000;
                var totalEnvio;

                if (km <= 5) {
                    totalEnvio = <?= $precioBase ?>;
                } else if (km <= 15) {
                    totalEnvio = <?= $precioBase ?> + (km - 5) * <?= $precioMedio ?>;
                } else {
                    totalEnvio = <?= $precioBase ?> + (15 - 5) * <?= $precioMedio ?> + (km - 15) * <?= $precioLargo ?>;
                }

                totalEnvio += time * <?= $tiempoComi ?>;


                counPr(totalEnvio);
            });

        }

        function counPr(totalEnvio) {
            $.ajax({
                type: "POST",
                url: "objets/countP.php",
                data: {
                    serial: "<?= $serialC ?>"
                },
                dataType: "html",
                success: function(data) {

                    $("#countPr").html(data);
                    $("#envioT").html('$' + totalEnvio.toFixed(2));
                    $("#TotVal").val(data);
                    let newStr = data.slice(1)
                    let subT = parseFloat(newStr);

                    let EnV = parseFloat(totalEnvio);
                    let totEnMas = subT + EnV;
                    $("#totT").html('$' + totEnMas.toFixed(2));
                    if (isNaN(totEnMas)) {
                        $('#buttonsPay').hide();
                        window.location.href = "https://rutadelaseda.xyz";
                    } else {
                        $('#buttonsPay').show();
                    }

                    /* initPayPalButton() */
                    ;


                }

            });

        }

        function OrderCProduct() {
            
            var orden = document.querySelector('#orden').value
            var lat1 = document.querySelector('#lat1').value
            var long1 = document.querySelector('#long1').value
            var totEn = parseFloat(document.querySelector('#envio').value)
            var tot = document.querySelector('#TotVal').value
            var nameU = document.querySelector('#nombre').value
            var tels = document.querySelector('#numeroTelUser').value
            // Ejemplo de uso:
            const numeroTelefono = tels;
            const digitos = 10;

            if (validarTelefono(numeroTelefono, digitos)) {
                $("#numeroTelUser").hide();
            $("#btnOrder").hide();
            $('#idCompraProgress').show();
                $.ajax({
                    type: "POST",
                    url: "orderC.php",
                    data: {
                        order: orden,
                        serial: "<?= $serialC ?>",
                        session: "<?= $idSession ?>",
                        lat: lat1,
                        long: long1,
                        tot: tot,
                        totEnv: totEn,
                        nameU: nameU,
                        tel: tels
                    },
                    dataType: "html",
                    success: function(response) {
                        $('.textoRancio').show();
                        $('#idCompraProgress').hide();
                        $("#buttonWhats").html(response);

                        $("#smart-button-container").css("display", "block");

                        $("#submit").css("display", "block");
                        $("#numeroTelUser").css("display", "none");
                        $("#nameU").css("display", "none");
                        var inputSelector = '#orderInputCopy';

                        // Seleccionar el input y copiar su valor al portapapeles
                        var inputElement = $(inputSelector);
                        inputElement.select(); // Seleccionar el texto en el input
                        document.execCommand('copy');
                        sendApartadoOrder(orden);


                    }
                });
            } else {
                alert("El número de teléfono no es válido.");
            }

        }

        function sendApartadoOrder(orden) {
            var orderDesVal = $("#valueApartadoIn").val();
            if (orderDesVal == 0 || orderDesVal == null) {
                console.log("No hay descuento");
            } else {
                $.ajax({
                    type: "POST",
                    url: "../../controllers/client/addOrderApartado.php",
                    data: {
                        desc: orderDesVal,
                        order: orden
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                    }
                });
            }

        }

        function enviarNotificac(token) {
            $.ajax({
                type: "POST",
                url: "../../controllers/androidFirebase.php",
                data: {
                    idToken: token,
                    message: "Tiene una nueva orden de compra"
                },
                dataType: "html",
                success: function(response) {
                    console.log(response);
                }
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&callback=initMap&v=weekly" defer></script>
<?php
}
