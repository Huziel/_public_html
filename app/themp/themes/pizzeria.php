
<head>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= $nameP ?>" />
    <meta property="og:description" content="<?= $nameP ?>" />
    <meta property="og:image" content="<?= $logo ?>" />
    <title><?= $nameP ?></title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="images/gotaverde.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/stylesM.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/particles.css">
    <link rel="stylesheet" href="css/bootstrapJournal.min.css">
    <link rel="stylesheet" href="css/page.css">
</head>
<div id="particles-js" class="loader"></div>


<nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top ">
    <a class="navbar-brand" href="#">
        <img src="<?= $logo ?>" width="200px" class="d-inline-block align-top" alt="">
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Categorias
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" onclick="viewPList()"><?= $arreglo[0] ?>Todo</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    while ($arreglo = mysqli_fetch_array($sqlCat)) {
                    ?>
                        <a class="dropdown-item" onclick="viewPList('<?= $arreglo[0] ?>')"><?= $arreglo[0] ?></a>
                    <?php
                    }
                    ?>
                </div>
            </li>

        </ul>
        <div class="form-inline my-2 my-lg-0">
            <input type="text" id="myInputTextField" class="" style=" font-size: 20px; background-color: transparent; text-align: center;border: 0; outline: none;" placeholder="Buscar">


        </div>
    </div>
</nav>
<br>
<br>
<br>

<center>
    <div class="card text-center mb-3 mt-3">

        <div class="card-body">
            <?= $nota ?>
        </div>

    </div>
</center>


<div class="viewPList"></div>

<footer class="py-3 cristal fixed-bottom">
    <center>
        <div class="container row text-primary">
            <div class="col-3">
                <center><a href="https://rutadelaseda.xyz/" class="botonF1 text-primary"> <i class="fas fa-store fa-2x"></i></a></center>
            </div>
            <div class="col-3">
                <center> <a href="https://wa.me/+52<?= $wha ?>" class="botonF1 text-primary" target="_blank"> <i class="fab fa-whatsapp fa-2x"></i></a></center>
            </div>
            <div class="col-3">
                <center> <a href="https://www.google.com/maps/place/<?= $lat ?>,<?= $long ?>" class="botonF1 text-primary" target="_blank"> <i class="fas fa-map-marker-alt fa-2x"></i></a></center>
            </div>
            <div class="col-3">
                <center>


                    <form>
                        <button type="button" data-bs-toggle="modal" onclick="viewTable()" data-bs-target="#exampleModal2" class="botonF1 text-primary animate__animated animate__heartBeat animate__infinite infinite">
                            <span>
                                <i class="fa fa-shopping-basket fa-2x"></i>
                            </span>
                    </form>

                    </button>
                    <span class="badge badge-secondary">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                <div class="countPrs"></div>

                            </font>
                        </font>
                    </span>
                </center>
            </div>

        </div>
    </center>

</footer>


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

                <button type="button" class="btn btn-secondary" onclick="closemodal()" data-dismiss="modal">Seguir viendo</button>
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
                <?php
                if ($precioBase >= 1) {
                ?>
                    <form action="localizador.php" target="_blank" method="get">
                        <input type="hidden" value="<?= $nameP ?>" name="id">
                        <button type="submit" class="btn btn-block text-primary animate__animated animate__pulse animate__infinite infinite">
                            <span>
                                Realizar compra <i class="fa fa-shopping-basket "></i>
                            </span>

                        </button>
                    </form>
                <?php

                } else {
                ?>
                    <form action="cart2.php" target="_blank" method="get">
                        <input type="hidden" value="<?= $nameP ?>" name="id">
                        <button type="submit" class="btn btn-block text-primary animate__animated animate__pulse animate__infinite infinite">
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
  
                <button type="button" class="btn btn-secondary" onclick="closemodal2()" data-dismiss="modal">Seguir viendo</button>
            </div>
        </div>
    </div>
</div>

</html>
<script>
    function viewPList(cat) {

        $.ajax({
            type: 'POST',
            url: 'timerProtect.php',
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

                alert("Problemas al tratar de enviar el formulario");
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
                $(".countPrs").html(data);
            }
        });

    }
    window.onload = counPrs();
    setInterval(counPrs, 5000);

    function hiden() {
        $("#particles-js").fadeOut("slow");
        document.getElementsByTagName('body')[0].style.overflow = 'visible';
    }
    window.setTimeout(hiden, 2000);
</script>
<script>
    function viewTable() {
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
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="js/paricles.js"></script>