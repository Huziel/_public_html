// Variable global para almacenar el número de elementos
var numeroElementosAnterior = 0;

// Función para realizar la petición AJAX y verificar cambios
function notification(user) {
  $.ajax({
    type: "post",
    url: "/controllers/notifi/notifi.php",
    data: { user: user },
    dataType: "json",
    success: function (response) {
      
      // Obtener el número de elementos en la respuesta
      var numeroElementos = response.data.length;

      // Mostrar la respuesta en la consola (puedes eliminar esta línea si no es necesario)
      /* console.log(response); */

      // Verificar si el número de elementos ha cambiado desde la última petición
      if (numeroElementos > numeroElementosAnterior) {
        // Accionar el sonido (reemplaza esto con tu lógica para reproducir el sonido)

        // Llamar a la función para reproducir el sonido cuando sea necesario
        if (numeroElementosAnterior != 0) {
          Swal.fire("¡Nueva orden de compra!");
          /* var audio = new Audio("/dashboard/sounds/vozia.mp3");
          audio.play(); */
          console.log("Notify");
        }
        

        // Actualizar el número de elementos anterior
        numeroElementosAnterior = numeroElementos;
      }
    },
  });
}
function showPed(){
  $.ajax({
    type: "post",
    url: "url",
    data: "data",
    dataType: "dataType",
    success: function (response) {
      
    }
  });
}

