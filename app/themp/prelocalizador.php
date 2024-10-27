<?php
$id = (isset($_GET['id']) ? $_GET['id'] : null);
?>
<!doctype html>
<!--
 @license
 Copyright 2019 Google LLC. All Rights Reserved.
 SPDX-License-Identifier: Apache-2.0
-->
<html lang="en">

<head>
    <title>Place Autocomplete</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    #map {
        height: 100%;
    }

    /* 
 * Optional: Makes the sample page fill the window. 
 */
    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
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
    }

    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
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
        width: 400px;
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
</style>

<body>

    <div style="height: 60%;" id="map"></div>
    <div class="" id="pac-card" style="border-radius: 12px; background-color: white;">
        <input type="hidden" id="lat">
        <input type="hidden" id="lng">
        <input type="hidden" id="id" value="<?= $id ?>">
        <div>
            <div id="title" class="bg-secondary">Dirección de origen <i class="fa-solid fa-location-dot"></i></div>
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
        <div id="pac-container">
            <div class="input-group mb-3">
                <input class="form-control" id="pac-input" type="text" placeholder="¿A dónde quieres que llegue?" />
            </div>
            <br>
            <center>
                <div class="d-grid align-items-center justify-content-center gap-2">
                    <button type="button" name="" id="" onclick="showCart()" class="btn btn-secondary">Confirmar dirección</button>

                </div>
            </center>
            <script>
                function showCart() {
                    var parametro1 = $("#id").val();
                    var parametro2 = $("#lat").val();
                    var parametro3 = $("#lng").val();

                    if (parametro2 && parametro3) {
                        const url = `localizador.php?id=${parametro1}&prelat=${parametro2}&prelong=${parametro3}`;

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
            </script>

        </div>
    </div>
    <div id="infowindow-content">
        <span id="place-name" class="title"></span><br />
        <span id="place-address"></span>
    </div>

    <script>
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
            });

            const geocoder = new google.maps.Geocoder();
            const marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29),
            });

            const infowindow = new google.maps.InfoWindow();
            const infowindowContent = document.getElementById("infowindow-content");
            infowindow.setContent(infowindowContent);

            const autocomplete = new google.maps.places.Autocomplete(document.getElementById("pac-input"), {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            });

            autocomplete.bindTo("bounds", map);

            autocomplete.addListener("place_changed", () => {
                infowindow.close();
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) {
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // Si la ubicación tiene una geometría, centra el mapa en ella
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                // Coloca el marcador en la ubicación seleccionada
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);

                // Guarda los datos de la ubicación seleccionada
                $("#lat").val(place.geometry.location.lat());
                $("#lng").val(place.geometry.location.lng());
                $("#address").val(place.formatted_address);

                // Muestra la dirección en el InfoWindow
                infowindowContent.children["place-name"].textContent = place.name;
                infowindowContent.children["place-address"].textContent = place.formatted_address;
                infowindow.open(map, marker);
            });

            // Añadir evento de clic en el mapa para seleccionar manualmente una ubicación
            google.maps.event.addListener(map, 'click', function(event) {
                const clickedLocation = event.latLng;
                marker.setPosition(clickedLocation);
                marker.setVisible(true);

                const lat = clickedLocation.lat();
                const lng = clickedLocation.lng();

                // Actualizar los campos ocultos
                $("#lat").val(lat);
                $("#lng").val(lng);

                // Usar geocodificación inversa para obtener la dirección
                geocoder.geocode({
                    location: clickedLocation
                }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            const address = results[0].formatted_address;
                            $("#pac-input").val(address);
                            $("#address").val(address);

                            infowindowContent.children["place-name"].textContent = "Ubicación seleccionada";
                            infowindowContent.children["place-address"].textContent = address;
                            infowindow.open(map, marker);
                        } else {
                            Swal.fire({
                                title: '¡Error!',
                                text: 'No se encontraron resultados para esta ubicación',
                                icon: 'error',
                                confirmButtonText: 'Entendido'
                            });
                        }
                    } else {
                        Swal.fire({
                            title: '¡Error!',
                            text: 'El servicio de geocodificación falló: ' + status,
                            icon: 'error',
                            confirmButtonText: 'Entendido'
                        });
                    }
                });
            });
        }


        window.initMap = initMap;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDs8c8PjH9-lLk3LXN7C0Lwsvap4QHWYps&callback=initMap&libraries=places&v=weekly" defer></script>
</body>

</html>