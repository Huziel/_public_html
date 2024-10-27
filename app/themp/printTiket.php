<?php $order = (isset($_GET['order']) ? $_GET['order'] : null); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impreción de ticket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .ticket {
            font-family: 'Courier New', Courier, monospace;
            width: 300px;
        }

        .ticket .header {
            text-align: center;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .ticket .item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .ticket .total {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-weight: bold;
        }

        .oculto {
            display: none;
        }

        .visible {
            display: inline-block;
        }
    </style>
</head>

<body class="container">

    <div id="ticketContent" class="row justify-content-center mt-5"></div>


    <button class="btn btn-secondary btn-lg btn-block mt-3" id="miBoton" onclick="printTicket()">Imprimir <i class="fas fa-print"></i></button>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            function toggleButton() {
                if ($(window).width() < 768) { // Puedes ajustar el tamaño del breakpoint según tus necesidades
                    $('#miBoton').hide();
                } else {
                    $('#miBoton').show();
                }
            }

            // Ejecutar la función al cargar la página
            toggleButton();

            // Ejecutar la función cada vez que se redimensiona la ventana
            $(window).resize(function() {
                toggleButton();
            });
        });
        $.ajax({
            type: "POST",
            url: "../../controllers/puntoVenta/tiketCompra.php",
            data: {
                order: "<?= $order ?>"
            },
            dataType: "json",
            success: function(response) {
                ticketData = response;
                document.getElementById('ticketContent').innerHTML = generateTicketHTML(ticketData);

            }
        });


        function generateTicketHTML(data) {
            const order = data.order[0];
            let html = `<div class="ticket col-12 col-md-4 border border-dark">
                <div class="header">${order.nombreTienda}</div>
                <div class="header">Orden: ${order.noOrder}</div>
                <div class="header">Fecha: ${order.fecha}</div>
                <div class="header">Cliente: ${order.nombre}</div>`;

            data.products.forEach(item => {
                html += `<div class="item">
                    <span>${item.nameProd} (x${item.cantidad})</span>
                    <span>$${item.precioBruto}</span>
                </div>`;
            });

            html += `<div class="total">
                <span>Total:</span>
                <span>$${order.total}</span>
                <span>Extra:</span>
                <span>$${order.extra}</span>
            </div></div>`;

            return html;
        }

        function printTicket() {
            const ticketContent = generateTicketHTML(ticketData);
            const printWindow = window.open('', '', 'width=400,height=600');
            printWindow.document.write('<html><head><title>Ticket</title>');
            printWindow.document.write('<style>.ticket { font-family: "Courier New", Courier, monospace; width: 300px; } .ticket .header { text-align: center; font-size: 18px; margin-bottom: 20px; } .ticket .item { display: flex; justify-content: space-between; margin: 5px 0; } .ticket .total { display: flex; justify-content: space-between; margin-top: 20px; font-weight: bold; }</style>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(ticketContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>

</body>

</html>