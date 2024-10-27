<?php


$name =  base64_decode((isset($_GET['name']) ? $_GET['name'] : null));
$idToken = (isset($_GET['idToken']) ? $_GET['idToken'] : null);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>RutaDeLaSeda | Iniciar sesión</title>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.css"
        integrity="sha512-n1PBkhxQLVIma0hnm731gu/40gByOeBjlm5Z/PgwNxhJnyW1wYG8v7gPJDT6jpk0cMHfL8vUGUVjz3t4gXyZYQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link
        rel="icon"
        type="image/x-icon"
        href="../app/themp/images/gotaverde.png" />
    <!-- Custom fonts for this template-->
    <link
        href="../dashboard/views/vendor/fontawesome-free/css/all.min.css"
        rel="stylesheet"
        type="text/css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="../dashboard/views/css/sb-admin-2.css" rel="stylesheet" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="bg-gradient-dark">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group">
                                            <input
                                                type="email"
                                                required
                                                name="mail"
                                                class="form-control form-control-user"
                                                id="mail"
                                                aria-describedby="emailHelp"
                                                placeholder="Usuario" />
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group mb-2">
                                                <input
                                                    type="password"
                                                    class="form-control form-control-user"
                                                    name="pass"
                                                    id="pass"
                                                    placeholder="Contraseña" />
                                                <div class="input-group-prepend">
                                                    <button
                                                        class="btn btn-success btn-block btn-user"
                                                        style="
                                border-top-right-radius: 10rem;
                                border-bottom-right-radius: 10rem;
                              "
                                                        id="botonMostra"
                                                        type="button">
                                                        Mostrar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="icheck-primary">
                                                <input type="checkbox" id="rememberMe" />
                                                <label for="rememberMe"> Recuerdame </label>
                                            </div>
                                        </div>

                                        <a
                                            onclick="login()"
                                            class="btn btn-success btn-user btn-block">
                                            Acceder
                                        </a>
                                    </form>

                                    <hr />

                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">¿Perdio su contraseña?</a>
                                    </div> -->
                                    <div class="text-center">
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
    <!-- sweetalert -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.8/sweetalert2.min.js"
        integrity="sha512-FbWDiO6LEOsPMMxeEvwrJPNzc0cinzzC0cB/+I2NFlfBPFlZJ3JHSYJBtdK7PhMn0VQlCY1qxflEG+rplMwGUg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <!-- Bootstrap core JavaScript-->
    <script
        src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
        crossorigin="anonymous"></script>
    <script src="../dashboard/views/vendor/bootstrap/js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../dashboard/views/vendor/jquery-easing/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../dashboard/views/js/sb-admin-2.js"></script>
    <script src="../dashboard/views/js/scripts.js"></script>
    <script>
        $(document).ready(function() {
            login2('<?= $name ?>', '<?= $idToken ?>');
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
            const savedmail = localStorage.getItem("mail");
            if (savedPassword) {
                document.getElementById("pass").value = savedPassword;
                document.getElementById("rememberMe").checked = true;
            }
            if (savedmail) {
                document.getElementById("mail").value = savedmail;
                document.getElementById("rememberMe").checked = true;
            }

        });


        function login2(mail, pass) {
            
            $.ajax({
                type: "post",
                url: "login.controller.php",
                data: {
                    mail: mail,
                    pass: pass
                },
                dataType: "json",
                success: function(response) {
                    /* console.log(response); */

                    if (response.ok == "false") {
                        Swal.fire({
                            title: "!Error!",
                            text: response.id,
                            icon: "error",
                            confirmButtonText: "Ok",
                        });
                    } else {
                        setTimeout(function() {
                            window.location.href = "home";
                        }, 3000);
                        Swal.fire({
                            title: "Inicio correcto",

                            icon: "success",
                            confirmButtonText: "Cool",
                        });
                    }
                },
            });
        }
        
    </script>
</body>

</html>