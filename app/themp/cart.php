<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idSession = session_id();
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$sessionN = (isset($_GET['session']) ? $_GET['session'] : null);
$keyP = (isset($_GET['pr']) ? $_GET['pr'] : null);
if ($id) {
    $parametro2 = (isset($_GET['parametro2']) ? $_GET['parametro2'] : null);
    $parametro3 = (isset($_GET['parametro3']) ? $_GET['parametro3'] : null);
    $parametro4 = (isset($_GET['parametro4']) ? $_GET['parametro4'] : null);
    $parametro5 = (isset($_GET['parametro5']) ? $_GET['parametro5'] : null);

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
    if ($parametro4 && $parametro5) {
        $lat = $parametro4;
        $long = $parametro5;
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
        <?= $theme ?>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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

    <body class="text-white"">
    <a href=" https://rutadelaseda.xyz/@<?= $idStore ?>" class="btn btn-dark">
        <i class="fas fa-arrow-left"></i>
        </a>
        <br>
        <center>
            <div class=" mb-3">
                <a name="" id="" class="btn btn-success btn-lg btn-block text-light" href="smarticket.php" role="button">¿Ya tiene una orden en proceso?</a>
            </div>
        </center>
        <div class="viewP"></div>
        <?php
        if ($id != null) {
        ?>
            <div class="container" id="buttonsPay">
                <?php
                if ($precioBase == 0) {
                } else {
                ?>
                    <center><button type="button" onclick="noSend()" class="btn btn-secondary btn-lg btn-block text-light"><i class="fas fa-store"></i> Recoger en tienda</button></center>


                <?php
                }
                ?>
                <br>
                <center><button type="button" class="btn btn-success btn-lg btn-block text-light animate__animated animate__pulse animate__infinite" data-bs-toggle="modal" data-bs-target="#pedido_modal" onclick="funcionModal()">

                        <i class="fas fa-check"></i> Finalizar pedido


                    </button></center>
            </div>
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


        <br>
        <center>

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
                                <label class="col-form-label text-dark" for="inputDefault">Confirma tu número y nombre para poder contactarte</label>
                                <input class="form-control" id="nombre" value="<?php if ($_SESSION['nameClienteUnique']) {
                                                                                    echo $_SESSION['nameClienteUnique'];
                                                                                } else {
                                                                                    echo $_SESSION['nombre'];
                                                                                }  ?>" placeholder="Nombre" name="Nombre">
                                <br>
                                <input class="form-control" id="numeroTelUser" value="<?= $_SESSION['phone'] ?>" placeholder="WhatsApp" type="number" name="">
                                <br>
                                <div class="d-grid gap-2">
                                    <button type="button" name="btnOrder" id="btnOrder" onclick="OrderCProduct()" class="btn btn-primary text-light">
                                        Confirmar
                                    </button>
                                </div>

                                <div class="progress" id="idCompraProgress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                </div>
                                <br>

                                <input type="hidden" class="form-control" id="status" readonly>

                            </div>

                            <br>

                            <div class="row">
                                <div class="col-12">

                                    <div id="buttonWhats"></div>
                                    <br>
                                    <center>
                                        <h3 class="textoRancio">Agilizar pedido</h3>
                                    </center>

                                    <br>
                                    <div class="alert alert-success textoRancio" role="alert">
                                        Para consultar el estado inmediato de tu pedido, contáctanos por WhatsApp haciendo click en el siguiente botón.

                                    </div>
                                    <br>
                                    <button type="button" style="display: none;" onclick="orderWhats(event)" class="btn btn-outline-success btn-block boxshadowD" id="submit"><i class="fab fa-whatsapp"></i> Enviar mensaje</button>
                                    <br>
                                </div>

                            </div>
                            <!-- <center>
                                <h3 class="textoRancio">También puede pagar con Paypal</h3>
                            </center> -->

                            <br>


                        </div>

                    </div>
                </div>
            </div>
        </div>



    </body>


    </html>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
        funcionModal();

        function funcionModal() {
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
        }

        function viewP() {

            $.ajax({
                type: 'POST',
                url: 'cartTable.php',
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
            var iLongitud = <?= $parametro3 ?>,
                iLatitud = <?= $parametro2 ?>;
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


                if (km <= 1) {
                    totalEnvio = <?= $precioBase ?>;
                    $("#envio").val(totalEnvio);
                } else if (km > 1 && km <= 5) {
                    totalEnvio = ((km * <?= $precioMedio ?>) + (time * <?= $tiempoComi ?>) + (<?= $precioBase ?>));
                    $("#envio").val(totalEnvio);

                } else if (km > 5) {
                    totalEnvio = ((km * <?= $precioLargo ?>) + (time * <?= $tiempoComi ?>) + (<?= $precioBase ?>));
                    $("#envio").val(totalEnvio);
                }


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
                    console.log(totEnMas);
                    if (isNaN(totEnMas)) {
                        $('#buttonsPay').hide();
                        window.location.href = "https://rutadelaseda.xyz";
                    } else {
                        $('#buttonsPay').show();
                    }
                    $("#totT").html('$' + totEnMas.toFixed(2));


                    /* initPayPalButton(); */

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
            const numeroTelefono = tels;
            const digitos = 10;
            if (nameU != '') {
                if (validarTelefono(numeroTelefono, digitos)) {
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



                        }
                    });
                } else {
                    alert("El número de teléfono no es válido.");
                }
            } else {
                alert("El nombre está vacío");
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
    <script src="../../dashboard/views/js/autoFillGoogle.js"></script>
<?php
}
