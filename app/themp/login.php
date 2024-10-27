<!DOCTYPE html>
<html lang="en">
<?php
require('./objets/core.php');
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$query_v = "SELECT * FROM `token` WHERE token = '$id';";
$sql = mysqli_query($con, $query_v);
$count = mysqli_num_rows($sql);

require('./objets/head.php');
?>
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
    <style>
        .abs-center {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;
        }
    </style>
</head>
<body style = "background-color: white;">

	
	
	
	<header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Accede a tu catalogo</h1>
                <p class="lead fw-normal text-white-50 mb-0">¡Crea infinidad de catálogos para cualquier negocio!</p>
            </div>
        </div>
    </header>

    <section class="py-5 abs-center">
        <div class="container px-4 px-lg-5 mt-5">

            <div class="row justify-content-center align-self-center">
                <center>
                    <div class="col-4">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets1.lottiefiles.com/packages/lf20_6ch5rxd6.json"  background="transparent"  speed="1"  style="width: 100%; height: ;"  loop  autoplay></lottie-player>
                        </div>
                </center>
                <div class="jumbotron jumbotron-fluid" style = "border-radius: 15px">
                    <div class="container">
                        <form role="form" class="" id="formulario" action="./objets/validate.php" method="POST">
								<center>
									<div class="form-group">

										<label class="" for="exampleInputEmail1">
											<i class="fas fa-user"></i> Nombre de la tienda(NO SE PERMITEN ESPACIOS NI CARACTERES ESPECIALES)
										</label>
										<input type="text" name="correo" placeholder="El nombre de tu tienda" class="form-control boxshadowD" id="exampleInputEmail1" onkeypress="return check(event)">
									</div>
									<div class="form-group">

										<label class="" for="exampleInputPassword1">
											<i class="fas fa-key"></i> Contraseña
										</label>
										<br>
										<input type="password" name="pass" class="form-control boxshadowD" id="exampleInputPassword1" placeholder="Ponle llave para que nadie te lo robe." required />
										<small class="">Si no tienes contraseña solo crea una</small>
									</div>


									<button type="submit" id="btnEnviar" class="btn btn-outline-dark mt-auto">
										<i class="fas fa-check"></i> Vér mi menú
									</button>
								</center>

							</form>
							<br>
							<div class="respuesta"></div>

                    </div>
                </div>


            </div>

        </div>
    </section>
	
 <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; MagicMenu 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>

<script type="text/javascript">
	$(document).ready(function() {
		$("#formulario").bind("submit", function() {
			// Capturamnos el boton de envío
			var btnEnviar = $("#btnEnviar");
			$.ajax({
				type: $(this).attr("method"),
				url: $(this).attr("action"),
				data: $(this).serialize(),
				beforeSend: function() {
					/*
					 * Esta función se ejecuta durante el envió de la petición al
					 * servidor.
					 * */
					// btnEnviar.text("Enviando"); Para button 
					btnEnviar.val("Enviando"); // Para input de tipo button
					btnEnviar.attr("disabled", "disabled");
				},
				complete: function(data) {
					/*
					 * Se ejecuta al termino de la petición
					 * */
					btnEnviar.val("Iniciar");
					btnEnviar.removeAttr("disabled");
				},
				success: function(data) {
					/*
					 * Se ejecuta cuando termina la petición y esta ha sido
					 * correcta
					 * */
					if ((data === "Inicio correcto")) {
						window.location.href = "dashboard/dashboard"
					}
					$(".respuesta").html(data);

				},
				error: function(data) {
					/*
					 * Se ejecuta si la peticón ha sido erronea
					 * */
					alert("Problemas al tratar de enviar el formulario");
				}
			});
			// Nos permite cancelar el envio del formulario
			return false;
		});
	});
</script>
<script>
	function check(e) {
		tecla = (document.all) ? e.keyCode : e.which;

		//Tecla de retroceso para borrar, siempre la permite
		if (tecla == 8) {
			return true;
		}

		// Patrón de entrada, en este caso solo acepta numeros y letras
		patron = /[A-Za-z0-9]/;
		tecla_final = String.fromCharCode(tecla);
		return patron.test(tecla_final);
	}
</script>