<?php
require("bdSQL.php");
require("dependencias/fpdf.php");

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

class PDF extends FPDF
{
    function Header()
    {
        // Logo o imagen de fondo
        $this->Image('img/fondoticket.jpg', 0, 0, 210, 297);
    }

    function AddItem($procId, $cantidad, $procName, $precio)
    {
        $anchoPagina = 210; // Ancho total de la página en mm
        $anchoCeldaIzquierda = 80; // Ancho de la primera celda
        $anchoCeldaDerecha = 10; // Ancho de la segunda celda

        // Calcular la posición de inicio de la celda izquierda para centrarla
        $xIzquierda = ($anchoPagina - $anchoCeldaIzquierda - $anchoCeldaDerecha) / 2;

        // Establecer la posición de la celda izquierda
        $this->SetX($xIzquierda);

        // Agregar la información con fuente en negrita
        $this->SetFont('Arial', 'B', 10);
        $this->Cell($anchoCeldaIzquierda, 10, $procId . ' x' . $cantidad . ' ' . $procName, 0, 0, 'L');
        $this->Cell($anchoCeldaDerecha, 10, '$' . $precio, 0, 1, 'R');
        $this->SetFont('Arial', '', 10); // Restaurar fuente regular
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10); // Establecer fuente en negrita para el encabezado
$pdf->Ln(10);
$pdf->Cell(190, 10, '======GAM.CO======', 0, 1, 'C');
$pdf->Cell(190, 10, '-Gaming sin Limites!-', 0, 1, 'C');
$pdf->Cell(190, 10, '-------------------------------------------------------------------------', 0, 1, 'C');
$pdf->Ln(5);

$subtotal = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->AddItem($row['proc_id'], $row['detpedido_cantidad'], $row['proc_name'], $row['prec_unitario'] * $row['detpedido_cantidad']);
        $total = $row['total'];
        $subtotal += ($row['prec_unitario'] * $row['detpedido_cantidad']);
        $envio = $row['envio'];
        $pais = $row['pais'];

        $metod_pago = $row['card_number'];
        $name_card = $row['card_name'];
        $dire_envio = $row['calle'] . ', ' . $row['fracc'] . ', ' . $row['zipcode'] . ', ' . $row['estado'] . ', ' . $row['ciudad'] . ', ' . $row['pais'];
    }

    if ($name_card == "OXXO") {
        $pago = "OXXO";
    } else {
        $pago = "Tarjeta";
    }

    if ($pais == "Mexico") {
        $impuesto = 0.16;
    } elseif ($pais == "America") {
        $impuesto = 0.20;
    } elseif ($pais == "Europa") {
        $impuesto = 0.35;
    } elseif ($pais == "Africa") {
        $impuesto = 0.05;
    } elseif ($pais == "Asia") {
        $impuesto = 0.09;
    } elseif ($pais == "Oceania") {
        $impuesto = 0.40;
    }

    // Detalles de la compra
    while ($row = $result->fetch_assoc()) {
        $pdf->AddItem($row['proc_id'], $row['detpedido_cantidad'], $row['proc_name'], $row['prec_unitario'] * $row['detpedido_cantidad']);
    }
    $pdf->Cell(190, 10, '-------------------------------------------------------------------------', 0, 1, 'C');

    // Resumen de la compra
    $anchoPagina = 210; // Ancho total de la página en mm
    $anchoCeldaIzquierda = 70; // Ancho de la primera celda
    $anchoCeldaDerecha = 60; // Ancho de la segunda celda
    $xIzquierda = ($anchoPagina - $anchoCeldaIzquierda - $anchoCeldaDerecha) / 2;

    $pdf->SetX($xIzquierda);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Ln(10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'SUBTOTAL:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, '$' . $subtotal, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'Impuesto:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, '$' . $impuesto * $subtotal, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'Direccion de Envio:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->MultiCell(0, 10, $dire_envio, 0, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'Costo de Envio:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, '$' . $envio, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'Metodo de Pago:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, $pago, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'Num. ref:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, $metod_pago, 0, 1, 'R');
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell($anchoCeldaIzquierda, 10, 'TOTAL:', 0, 0, 'R');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell($anchoCeldaDerecha, 10, '' . $total, 0, 1, 'R');

    $pdf->Cell(190, 10, '-------------------------------------------------------------------------', 0, 1, 'C');

    // Pie de página
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'Fecha: ' . date('Y-m-d H:i:s'), 0, 1, 'C');
    $pdf->Cell(0, 10, 'Gracias por tu compra!', 0, 1, 'C');
    $pdf->Image('img/frame.png', 90, $pdf->GetY() + 10, 30);
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
$pdf->Output();
?>
