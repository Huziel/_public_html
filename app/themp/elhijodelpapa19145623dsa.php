<!DOCTYPE html>
<html lang="en">
<?php
require('./objets/core.php');
$id = (isset($_GET['id']) ? $_GET['id'] : null);
$query_v = "SELECT * FROM `token` WHERE token = '$id';";
$sql = mysqli_query($con, $query_v);
$count = mysqli_num_rows($sql);
if($count>0){
require('./objets/head.php');
?>

<body>
	<div class="container">

		<div class="container-fluid" style="margin-top: 100px;">


			<div class="row">
				<div class="col-md-2">
				</div>
				<div class="col-md-8">
					<form role="form" id="formulario" action="./objets/validate.php" method="POST">
						<center>
							<div class="form-group">

								<label for="exampleInputEmail1">
									<i class="fas fa-user"></i>
								</label>
								<input type="text" name="correo" readonly class="form-control" id="exampleInputEmail1" value="<?=$id?>" />
							</div>
							<div class="form-group">

								<label for="exampleInputPassword1">
									<i class="fas fa-key"></i>
								</label>
								<input type="password" name="pass" class="form-control" id="exampleInputPassword1" required />
							</div>

							
							<button type="submit" id="btnEnviar" class="btn btn-primary">
								<i class="fas fa-check"></i>
							</button>
						</center>

					</form>
					<br>
					<div class="respuesta"></div>
				</div>
				<div class="col-md-2">
				</div>
			</div>


		</div>

	</div>

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
<?php
}
?>