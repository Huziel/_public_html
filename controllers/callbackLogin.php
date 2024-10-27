<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>RutaDeLaSeda | Iniciar sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.css" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="../app/themp/images/gotaverde.png" />
    <link href="../dashboard/views/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="../dashboard/views/css/sb-admin-2.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/4.6.2/sketchy/bootstrap.min.css" integrity="sha512-8HIl1gmLSbt7dBuv4WKQQJCHKvOaW/BgHZcbQoj5wI0ZPmK9XBeolj8sZtFRd88rpuaoLjJemuj9GkPd4se7Iw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
</head>

<body class="bg-gradient-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Continua con Google!</h1>
                                    </div>
                                    <center>
                                        <div id="g_id_signin" style="border-radius: 20px;"></div> <!-- Contenedor del botón de Google -->
                                    </center>

                                    <form class="user" style="display: none;">
                                        <div class="form-group">
                                            <input type="email" required name="mail" class="form-control form-control-user" id="mail" aria-describedby="emailHelp" placeholder="Usuario" />
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <input type="password" class="form-control form-control-user" name="pass" id="pass" placeholder="Contraseña" />
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-success btn-block btn-user" id="botonMostra" type="button">Mostrar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="rememberMe" />
                                                <label for="rememberMe"> Recuerdame </label>
                                            </div>
                                        </div>
                                        <a onclick="login()" class="btn btn-success btn-user btn-block">Acceder</a>
                                    </form>

                                    <hr />
                                    <div class="text-center" style="display: none;">
                                        <a class="small" href="register">Crear cuenta</a>
                                        <br />
                                        <a class="small" href="recover">Olvidé mi contraseña</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="../dashboard/views/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../dashboard/views/vendor/jquery-easing/jquery.easing.js"></script>
    <script src="../dashboard/views/js/sb-admin-2.js"></script>
    <script src="../dashboard/views/js/scripts.js"></script>

    <script>
        $(document).ready(function() {
            $("#botonMostra").click(function() {
                var passwordField = $("#pass");
                var fieldType = passwordField.attr("type");

                if (fieldType === "password") {
                    passwordField.attr("type", "text");
                    $(this).text("Ocultar");
                } else {
                    passwordField.attr("type", "password");
                    $(this).text("Mostrar");
                }
            });

            const savedPassword = localStorage.getItem("pass");
            const savedMail = localStorage.getItem("mail");
            if (savedPassword) {
                $("#pass").val(savedPassword);
                $("#rememberMe").prop("checked", true);
            }
            if (savedMail) {
                $("#mail").val(savedMail);
                $("#rememberMe").prop("checked", true);
            }
        });

        function handleCredentialResponse(response) {
            console.log("Respuesta del servidor:", response);
            const token = response.credential;

            if (!token) {
                console.error("El token de Google está vacío");
                return;
            }

            fetch("register.controller.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "id_token=" + token,
                })
                .then((response) => response.json())
                .then((data) => {
                    console.log("Datos recibidos:", data);
                    if (data.statusG == "1" || data.statusG == "2") {
                        var utf8Name = unescape(encodeURIComponent(data.nameG));
                        var name = btoa(utf8Name);
                        window.location.href = "https://rutadelaseda.xyz/controllers/continueLoginA.php?name=" + name + "&idToken=" + data.idTokenG;
                    }
                })
                .catch((error) => console.error("Error:", error));
        }

        window.onload = function() {
            // Inicializar el ID de Google
            google.accounts.id.initialize({
                client_id: "794936788729-jf5jug4aut3caoa6kpilouiugt4h9o7h.apps.googleusercontent.com",
                callback: handleCredentialResponse,
                auto_select: false // No seleccionar automáticamente si no hay sesión activa
            });

            // Mostrar el prompt si ya hay sesión activa o el botón si no
            google.accounts.id.prompt((notification) => {
                if (notification.isNotDisplayed() || notification.isSkippedMoment()) {
                    google.accounts.id.renderButton(
                        document.getElementById("g_id_signin"), // Contenedor del botón
                        {
                            theme: "outline",
                            size: "large"
                        } // Opciones de personalización del botón
                    );
                }
            });
        };
    </script>

    <script src="https://accounts.google.com/gsi/client" async defer></script>
</body>

</html>