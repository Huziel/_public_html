function login() {
  $.ajax({
    type: "post",
    url: "controllers/login.controller.php",
    data: { mail: $("#mail").val(), pass: $("#pass").val() },
    dataType: "json",
    success: function (response) {
      /* console.log(response); */

      if (response.ok == "false") {
        Swal.fire({
          title: "!Error!",
          text: response.id,
          icon: "error",
          confirmButtonText: "Ok",
        });
      } else {
        /* if (response.data.id) {
          console.log("idToken=" + response.data.id);
        } else {
          console.log("idToken=0");
        } */
        const password = document.getElementById("pass").value;
        const mail = document.getElementById("mail").value;
        const rememberMe = document.getElementById("rememberMe").checked;

        if (rememberMe) {
          localStorage.setItem("pass", password);
          localStorage.setItem("mail", mail);
        } else {
          localStorage.removeItem("pass");
          localStorage.removeItem("mail");
        }
        setTimeout(function () {
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

function showPr(user) {
  $.ajax({
    type: "get",
    url: "controllers/products.controller.php",
    data: { created: user },
    dataType: "json",
    success: function (response) {
      for (i = 0; i < response.data.length; i++) {
        var activesIn = response.data[i].active;
        if (activesIn == 0) {
          var clasesita = "bg-primary";
        } else {
          var clasesita = "bg-light";
        }
        var precio = parseFloat(response.data[i].number);
        var modelT =
          "<tr class='" +
          clasesita +
          "' id ='" +
          response.data[i].id +
          "'><td>" +
          response.data[i].keyy +
          "<br>" +
          response.data[i].var +
          "</td>" +
          "<td>" +
          response.data[i].category +
          "</td>" +
          "<td>" +
          accounting.formatMoney(precio, "$", 2, ",", ".") +
          "</td><td><img width='100' src=" +
          response.data[i].link +
          " class='img-fluid rounded' alt='Responsive image'></td></tr>";
        $("#pTable tbody").append(modelT);
      }
      $("tr").click(function () {
        var theLink = $(this).attr("id");
        detPShow(theLink);
        $("#modalProd").modal("show");
      });

      $("#pTable").DataTable({
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
        },
      });
      $("#resultT").hide();
    },
  });
}
function detPShow(theLink) {
  console.log(theLink);
  $("#CardResPRela").empty();
  $("#imgDetailsP").empty();
  $.ajax({
    type: "post",
    url: "controllers/productsDetails.controller.php",
    data: { id: theLink },
    dataType: "json",
    success: function (response) {
      var imgP =
        "<img src='" +
        response.response.link +
        "' class='img-fluid rounded' alt='Responsive image'>";
      $("#imgPD").html(imgP);
      $("#namePD").val(response.response.keyy);

      $("#variablePD").val(response.response.var);
      $("#precioPD").val(response.response.number);
      $("#idPD").val(response.response.id);
      $("#descrPD").val(response.response.dscr);
      $("#stockInp").val(response.stock.stock);
      $("#barcodeInputID").val(response.response.code);
      var selectElement = document.getElementById("activeProduct");
      var optionToChange = selectElement.options[0];
      let resActive = response.response.active;
      optionToChange.value = resActive;
      if (resActive == 0) {
        var sino = "NO";
      } else {
        var sino = "SI";
      }
      optionToChange.textContent = sino;
      for (i = 0; i < response.files.length; i++) {
        var modelImgP =
          "<div class='col-4 mb-3'><img src='" +
          response.files[i].picture +
          "' class='img-fluid rounded' alt='Responsive image'>" +
          "<button onclick='borrarImgPr(" +
          response.files[i].id +
          "," +
          response.response.id +
          ")' type='button' class='btn btn-primary btn-block'><i class='fas fa-trash'></i> Borrar</button>" +
          "</div>";
        $("#imgDetailsP").append(modelImgP);
      }
    },
  });
}

document
  .querySelector(".custom-file-input")
  .addEventListener("change", function (e) {
    var fileName = document.getElementById("imageP").files[0].name;
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
  });
document.querySelector(".impd").addEventListener("change", function (e) {
  var fileName = document.getElementById("imagePDSI").files[0].name;
  var nextSibling = e.target.nextElementSibling;
  nextSibling.innerText = fileName;
});

$("#imagePD").on("change", function () {
  $("#labelPD").html("Archivos seleccionados");
});
$("#imageP").on("change", function () {
  $("#imagePLable").html("Archivos seleccionados");
});
$("#file-input").on("change", function () {
  $("#labelPDEX").html("Archivo subido");
});
$("#imagePDS").on("change", function () {
  $("#labelPDS").html("Archivos seleccionados");
});
$("#formularioProductoNuevo").submit(function (e) {
  e.preventDefault();
  var form_data = new FormData(this);
  $("#result").show();
  $("#resultT").show();
  $.ajax({
    type: "post",
    url: "controllers/products.controller.php",
    data: form_data,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (answ) {
      $(".imagenesdelproductito").show();
      $("#previewImgProd").html("");
      console.log(answ);
      if (answ.ok == "true") {
        for (i = 0; i < answ.array.data.length; i++) {
          var mens =
            "<div class='alert alert-dismissible alert-light'><center><p class='mb-0'>" +
            answ.array.data[i] +
            "</p></center></div>";

          $("#infoPicture").append(mens);
        }
        Swal.fire({
          title: "!Producto agregado!",

          icon: "success",
          confirmButtonText: "Cool",
        });
      } else {
        if (answ.ok == "aux") {
          Swal.fire({
            title: "!Producto agregado!",

            icon: "success",
            confirmButtonText: "Cool",
          });
        } else {
          Swal.fire({
            title: "!Error!",
            text: answ.data,
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      }

      var table = $("#pTable").DataTable();
      table.destroy();
      $("#tbodyP").empty();
      var param = $("#createdby").val();
      setTimeout(showPr, 1000, param);
      $("#result").hide();
    },
  });
});
$("#formularioProductoEditar").submit(function (e) {
  e.preventDefault();
  var form_data = new FormData(this);
  $("#resultPD").show();
  $("#resultT").show();
  $.ajax({
    type: "post",
    url: "controllers/productsEdit.controller.php",
    data: form_data,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (answ) {
      console.log(answ);
      if (answ.ok == "true") {
        Swal.fire({
          title: "!Producto editado!",

          icon: "success",
          confirmButtonText: "Cool",
        });
        detPShow(answ.id);
      } else {
        if (answ.ok == "aux") {
          Swal.fire({
            title: "!Producto editado!",

            icon: "success",
            confirmButtonText: "Cool",
          });
          detPShow(answ.id);
        } else {
          Swal.fire({
            title: "!Error!",
            text: answ.data,
            icon: "error",
            confirmButtonText: "Ok",
          });
        }
      }

      var table = $("#pTable").DataTable();
      table.destroy();
      $("#tbodyP").empty();
      var param = $("#createdby").val();
      setTimeout(showPr, 1000, param);
      $("#resultPD").hide();
    },
  });
});
$(document).ready(function () {
  $("#result").hide();
  $("#resultPD").hide();
});
function borrarProduc() {
  var id = $("#idPD").val();
  Swal.fire({
    title: "¿Realmente desea ejecutar este cambio?",
    showDenyButton: true,

    confirmButtonText: "Borrar",
    denyButtonText: `No borrar`,
  }).then((result) => {
    /* Read more about isConfirmed, isDenied below */
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: "controllers/productsErase.controller.php",
        data: { id: id },
        dataType: "json",
        success: function (response) {
          console.log(response);
          if (response.ok == "true") {
            Swal.fire({
              title: "!Producto eliminado!",

              icon: "success",
              confirmButtonText: "Cool",
            });
            function CierraPopup() {
              $("#modalProd").modal("hide"); //ocultamos el modal
              $("body").removeClass("modal-open"); //eliminamos la clase del body para poder hacer scroll
              $(".modal-backdrop").remove(); //eliminamos el backdrop del modal
            }
            CierraPopup();
          } else {
            Swal.fire({
              title: "!Error!",
              text: answ.data,
              icon: "error",
              confirmButtonText: "Ok",
            });
          }
          var table = $("#pTable").DataTable();
          table.destroy();
          $("#tbodyP").empty();
          var param = $("#createdby").val();
          setTimeout(showPr, 1000, param);
          $("#resultPD").hide();
        },
      });
    } else if (result.isDenied) {
      Swal.fire("Cambios cancelados", "", "info");
    }
  });
}
function borrarImgPr(id, idP) {
  $.ajax({
    type: "post",
    url: "controllers/productsImgErase.controller.php",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.ok == "true") {
        Swal.fire({
          title: "!Imagen eliminada!",

          icon: "success",
          confirmButtonText: "Cool",
        });
        detPShow(idP);
      } else {
        response.fire({
          title: "!Error!",
          text: answ.data,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    },
  });
}
Dropzone.autoDiscover = false;
$("form#videoCat").dropzone({
  url: "/file/post",
  acceptedFiles: ".mp4",
  paramName: "file",
  maxFiles: "1",
  filesizeBase: "1000",
  maxFilesize: "6250",
  addRemoveLinks: "true",
});
$("form#ImgCatA").dropzone({
  url: "controllers/logoEditCat.php",
  acceptedFiles: "image/*",
  paramName: "file",
  maxFiles: 1,
  maxFilesize: 50, // Tamaño máximo en megabytes
  filesizeBase: 1000, // Factor de conversión de bytes a kilobytes (1000 bytes = 1 kilobyte)
  addRemoveLinks: true,
  dictDefaultMessage: "Selecciona la imagen",
  dictFallbackMessage:
    "Tu navegador no soporta la carga de archivos arrastrándolos y soltándolos.",
  dictFallbackText:
    "Por favor, utiliza el formulario de reserva de abajo como en los viejos tiempos.",
  dictFileTooBig:
    "El archivo es muy grande ({{filesize}}MB). Tamaño máximo de archivo: {{maxFilesize}}MB.",
  dictInvalidFileType: "No puedes subir archivos de este tipo.",
  dictResponseError: "El servidor respondió con {{statusCode}} código.",
  dictCancelUpload: "Cancelar subida",
  dictCancelUploadConfirmation:
    "¿Estás seguro de que quieres cancelar esta subida?",
  dictRemoveFile: "Eliminar archivo",
  dictRemoveFileConfirmation: null,
  dictMaxFilesExceeded: "No puedes subir más archivos.",
});
$("form#ImgCatB").dropzone({
  url: "controllers/subirBanner.php",
  acceptedFiles: "image/*",
  paramName: "file",
  maxFiles: 1,
  maxFilesize: 6.25, // Tamaño máximo en megabytes
  filesizeBase: 1000, // Factor de conversión de bytes a kilobytes (1000 bytes = 1 kilobyte)
  addRemoveLinks: true,
  dictDefaultMessage: "Selecciona la imagen",
  dictFallbackMessage:
    "Tu navegador no soporta la carga de archivos arrastrándolos y soltándolos.",
  dictFallbackText:
    "Por favor, utiliza el formulario de reserva de abajo como en los viejos tiempos.",
  dictFileTooBig:
    "El archivo es muy grande ({{filesize}}MB). Tamaño máximo de archivo: {{maxFilesize}}MB.",
  dictInvalidFileType: "No puedes subir archivos de este tipo.",
  dictResponseError: "El servidor respondió con {{statusCode}} código.",
  dictCancelUpload: "Cancelar subida",
  dictCancelUploadConfirmation:
    "¿Estás seguro de que quieres cancelar esta subida?",
  dictRemoveFile: "Eliminar archivo",
  dictRemoveFileConfirmation: null,
  dictMaxFilesExceeded: "No puedes subir más archivos.",
  success: function (file, response) {
    var json = JSON.parse(response);
    Swal.fire({
      title: "Archivo subido con éxito",
      text: json.data,
      icon: "info",
      confirmButtonText: "Ok",
    });
  },
  error: function (file, errorMessage, xhr) {
    Swal.fire({
      title: "Error al subir el archivo",
      text: errorMessage,
      icon: "error",
      confirmButtonText: "Ok",
    });
  },
});
function guardarDats() {
  var idTienda = $("#idIn").val();
  var nombreTienda = $("#nombreTienda").val();
  var texto1 = $("#descrTienda").val();
  var facebook = $("#facebook").val();
  var instagram = $("#instagram").val();
  var youtube = $("#youtube").val();
  var mercadoLibre = $("#mercadoLibre").val();
  var transf1 = $("#transferencia1").val();
  var transf2 = $("#transferencia2").val();
  var namebancIn1 = $("#namebancIn1").val();
  var namePropie1 = $("#namePropie1").val();
  var namebancIn2 = $("#namebancIn2").val();
  var namePropie2 = $("#namePropie2").val();

  $.ajax({
    type: "post",
    url: "controllers/agregarDatostiendas.php",
    data: {
      idTienda: idTienda,
      nombreTienda: nombreTienda,
      texto1: texto1,
      facebook: facebook,
      instagram: instagram,
      youtube: youtube,
      mercadoLibre: mercadoLibre,
      transf1: transf1,
      transf2: transf2,
      namebancIn1: namebancIn1,
      namePropie1: namePropie1,
      namebancIn2: namebancIn2,
      namePropie2: namePropie2,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.ok == "true") {
        Swal.fire({
          title: response.data,
          icon: "info",
          confirmButtonText: "Ok",
        });
      } else {
        Swal.fire({
          title: response.data,
          icon: "error",
          confirmButtonText: "Ok",
        });
      }
    },
  });
}
function traerDatosExtraTienda(idTienda) {
  var entero = parseInt(idTienda);
  $.ajax({
    type: "POST",
    url: "controllers/tarerDatosExtras.php",
    data: { idTienda: entero },
    dataType: "json",
    success: function (response) {
      /* console.log(response); */
      var data = response.data[0];
      $("#nombreTienda").val(data.nombreTienda);
      /* $("#nombreTiendaQR").text(data.nombreTienda); */
      $("#descrTienda").val(data.texto1);
      $("#facebook").val(data.facebook);
      $("#instagram").val(data.instagram);
      $("#youtube").val(data.youtube);
      $("#mercadoLibre").val(data.mercadoLibre);
      $("#transferencia1").val(data.transf1);
      $("#transferencia2").val(data.transf2);
      $("#namebancIn1").val(data.nameBanc1);
      $("#namePropie1").val(data.namePrope1);
      $("#namebancIn2").val(data.nameBanc2);
      $("#namePropie2").val(data.namePrope2);
      $("#ImgCatB").css({
        width: "100%",
        height: "100%",
        border: "2px dashed #ccc",
        "background-image": 'url("' + data.banner + '")',
        "background-size": "cover",
        "background-position": "center",
        "border-radius": "16px",
        "text-align": "center",
      });
      var horario = data.horario;
      var horarioArray = horario.replace(/[()]/g, "").split(",");
      $("#horarioIn1").val(horarioArray[0]);
      $("#horarioIn2").val(horarioArray[1]);
      var newArray = horarioArray;
      newArray.splice(0, 2);
      $("#diasSemanas").val(newArray);
    },
    error: function (xhr, status, error) {
      console.error("Error al cargar los datos:", error);
    },
  });
}
function guardarKeyDis() {
  $.ajax({
    type: "POST",
    url: "controllers/guardarTokenFirebase.php",
    data: { token: localStorage.getItem("androidParam") },
    dataType: "html",
    success: function (response) {
      console.log(response);
     
    },
  });
}
guardarKeyDis();
