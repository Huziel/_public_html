<?php
$id = (isset($_GET['id']) ? $_GET['id'] : null);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MagicMenu</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/stylesM.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }

        .botoncito {
            background-color: #ffc8dd;
            border-color: #ffc8dd;
            color: white;
        }
    </style>

</head>

<body>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Magic Menu</h1>
                <p class="lead fw-normal text-white-50 mb-0">¡Publica tu catálgo y haz que te encuentren más fácil!</p>

                <center>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="d-grid gap-2" style="margin-top: 20px ;">
                                <a href="login" class="btn btn-outline-light mt-auto" style="border-color: #ffafcc;">Crear catálogo gratis</a>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="d-grid gap-2" style="margin-top: 20px ;">
                                <a href="MagicMenu_1_1.3.apk" class="btn btn-outline-info mt-auto">Descargar App <i class="fab fa-android"></i></a>
                            </div>
                        </div>
                    </div>
                </center>
            </div>
        </div>
    </header>

    <section class="py-5 abs-center">
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row justify-content-center align-self-center">
                <center>
                    <div class="col-4">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_VgPRtS.json" background="transparent" speed="1" style="width: 100%;" loop autoplay></lottie-player>
                    </div>
                </center>
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <br>
                        <div>
                            <div class="form-group">

                                <input type="text" class="form-control" name="" id="searchC" onkeyup="catalogV()" aria-describedby="helpId" placeholder="Busca lo que mas se te antoje">
                                <br>
                                <center>
                                    <h3 class="lead fw-normal">¡Encuentra cientos de catalogos!</h3>
                                    <br>
                                    <p>Publica tu contenido y vende mas rápido</p>
                                </center>
                            </div>
                            <div id="catalog"></div>
                        </div>


                    </div>
                </div>


            </div>

        </div>
    </section>
    <section class="py-5 abs-center" style="background-color: #ffafcc;">
        <div class="container px-4 px-lg-5 mt-5">
            <form action="page.php" method="get">
                <div class="row">
                    <div class="col-12">
                        <!--  <div class="form-group">
                                        <label for="">Categoria</label>
                                        <select class="form-control" name="cat" onchange="selectState()" id="cate">
                                            <option value="0">Seleccione uno</option>
                                            <option value="1">Alimentos</option>
                                            <option value="2">Moda</option>
                                            <option value="3">Moda infantil</option>
                                            <option value="4">Jugetes</option>
                                            <option value="5">Videojuegos</option>
                                            <option value="6">Electrónica</option>
                                            <option value="7">Informática</option>
                                            <option value="8">Electrodomésticos</option>
                                            <option value="9">Varios</option>

                                        </select>
                                    </div> -->
                        <!--  <br>
                                </div>
                                <div class="col-12">
                                    <div id="state"></div>
                                    <br>
                                </div>
                                <div class="col-12">
                                    <div id="locale"></div>
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <div id="viewMenu"></div>
                            </div> -->
                        <center>
                            <h3>
                                Buscar catalogo por codigo
                            </h3>
                        </center>
                        <div class="form-group">
                            <label for="">Codigo de acceso</label>
                            <input required type="text" class="form-control" value="<?= $id ?>" name="id" id="keys" aria-describedby="helpId" placeholder="Introduce tu codigo de acceso">
                        </div>
                        <br>
                        <center>

                            <br>
                            <div class="row ">
                                <div class="col-12">
                                    <br>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-outline-dark mt-auto">Vér Catalogo</button>
                                    </div>
                                </div>

                            </div>




                        </center>
            </form>
        </div>

    </section>

    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; MagicMenu 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script>
        function selectState() {
            var data = document.getElementById("cate").value;
            $.ajax({
                type: "get",
                url: "objets/getState.php",
                data: {
                    id: data,
                },
                dataType: "html",
                success: function(response) {
                    $("#state").html(response);
                },
            });
        }

        function selectLocale() {
            var data = document.getElementById("states").value;
            $.ajax({
                type: "get",
                url: "objets/getLocale.php",
                data: {
                    id: data,
                },
                dataType: "html",
                success: function(response) {
                    $("#locale").html(response);
                },
            });
        }

        function viewMenus() {
            var datas = document.getElementById("localess").value;
            var data = document.getElementById("cate").value;
            $.ajax({
                type: "get",
                url: "objets/getMenus.php",
                data: {
                    ids: datas,
                    cate: data,
                },
                dataType: "html",
                success: function(response) {
                    $("#viewMenu").html(response);
                },
            });
        }

        function addkeyIn(data) {
            $("#keys").val(data);
        }

        function catalogV() {
            var datas = document.getElementById("searchC").value;
            $.ajax({
                type: "get",
                url: "objets/getMenusSearch.php",
                data: {
                    ids: datas,
                },
                dataType: "html",
                success: function(response) {
                    $("#catalog").html(response);
                }
            });
        }
        catalogV();
    </script>
</body>

</html>