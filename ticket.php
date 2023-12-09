<?php
require("bdSQL.php");
session_start();
$usr_id = $_SESSION['usr_id'];

// Consulta SQL para obtener la fila con el pagado_id máximo para el usr_id dado
$sql_max_pagado_id = "SELECT MAX(pagado_id) AS max_pagado_id
                    FROM pagados
                    WHERE usr_id = $usr_id";

$result_max_pagado_id = $conn->query($sql_max_pagado_id);

if ($result_max_pagado_id->num_rows > 0) {
    $row_max_pagado_id = $result_max_pagado_id->fetch_assoc();
    $max_pagado_id = $row_max_pagado_id['max_pagado_id'];

    // Consulta principal utilizando el pagado_id máximo
    $sql = "SELECT *
            FROM det_pedido AS dp
            INNER JOIN pagados AS p ON dp.pagado_id = p.pagado_id
            INNER JOIN users AS u ON p.usr_id = u.usr_id
            INNER JOIN direccion AS d ON p.dir_id = d.dir_id
            INNER JOIN pagos AS pg ON p.pago_id = pg.pago_id
            INNER JOIN productos AS pr ON dp.proc_id = pr.proc_id
            WHERE u.usr_id = $usr_id AND p.pagado_id = $max_pagado_id";

    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
    <link rel="stylesheet" href="css/style_ticket.css">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
</head>

<body>
    <div class="ticket">
        <div class="header">
            <h2>======GAM.CO======</h2>
            <p>-Gaming sin Limites!-</p>
            <p id="fecha"></p>
            <div class="top">
                <span>ID   Cant.   Producto</span>
                <span>PRECIO</span>
            </div>
        </div>

        <?php
        $subtotal=0;
        if ($result->num_rows > 0) {
            echo '<div class="items">';
            while ($row = $result->fetch_assoc()) {
                echo '<div class="item">';
                echo '<span>' . $row['proc_id'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['detpedido_cantidad'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['proc_name'] . '</span>';
                echo '<span>$' . $row['prec_unitario']*$row['detpedido_cantidad'] .'</span>';
                echo '</div>';
                $total= $row['total'];
                $subtotal += ($row['prec_unitario']*$row['detpedido_cantidad']);
                $envio=$row['envio'];
                $pais=$row['pais'];
            }

            if ($pais == "Mexico") {
                $impuesto = .16;
            } elseif ($pais == "America") {
                $impuesto = .20;
            } elseif ($pais == "Europa") {
                $impuesto = .35;
            } elseif ($pais == "Africa") {
                $impuesto = .05;
            } elseif ($pais == "Asia") {
                $impuesto = .09;
            } elseif ($pais == "Oceania") {
                $impuesto = .40;
            }
            echo '</div>';
           
            echo '<div class="total">';

            echo '<span>SUBTOTAL:</span>';

            echo '<span id="values">$' . $subtotal. '</span> <br>';

            echo '<span>IMPUESTO:</span>';

            echo '<span id="values">$' . $impuesto*$subtotal . '</span> <br>';

            echo '<span>ENVIO:</span>';

            echo '<span id="values">$' . $envio. '</span> <br>';
        
            echo '<span>TOTAL:</span>';
     
            echo '<span id="values">' . $total. '</span>';
           
            echo '</div>';

            
            echo '<div class="footer">';
            echo '<p>¡Gracias por tu compra!</p>';
            echo '<img src="img/frame.png" class="qr">';
            echo '</div>';
        } else {
            echo "No se encontraron resultados.";
        }
        ?>
    </div>

    <script>
        function actualizarFecha() {
            var fechaElemento = document.getElementById('fecha');
            var fechaActual = new Date();
            var opcionesFecha = { year: 'numeric', month: 'long', day: 'numeric' };

            fechaElemento.textContent = 'Fecha: ' + fechaActual.toLocaleDateString('es-ES', opcionesFecha);
        }

        window.onload = function() {
            actualizarFecha();
        };
    </script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
