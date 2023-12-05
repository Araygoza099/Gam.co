<?php
require('fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetX(20);
// Agregar el logotipo
$pdf->Image('logo.png', 10, 10, 30);

// Agregar el nombre del instituto
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Universidad Autonoma de Aguascalientes', 0, 1, 'C');

// Agregar el nombre del director
$pdf->SetFont('Arial', 'I', 12);
$pdf->Cell(0, 10, 'Director: Dr.Cesar Arnoldo Gutierrez Pasillas', 0, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Por la presente se certifica que:', 0, 1, 'C');
$pdf->Ln(2);

$nombre =  $_POST["nombre"];
$apellidos=$_POST["apellidos"];
$curso = $_POST["nomcurso"];
$duracion=$_POST["durcurso"];
$fecha = $_POST["Fecha"];

$pdf->Cell(0, 10,  $nombre . ' ' . $apellidos, 0, 1, 'C');
$pdf->Cell(0, 10, 'Ha completado satisfactoriamente el curso de:', 0, 1, 'C');
$pdf->Cell(0, 10, $curso . ' en ' . $duracion . ' horas.', 0, 1, 'C');
$pdf->Cell(0, 10, 'Fecha de emision: ' . $fecha, 0, 1, 'C');


// Agregar la firma del director
$pdf->Image('firma.png', 90, 90, 40);
// Agregar una línea recta
$pdf->SetLineWidth(0.5); // Grosor de la línea
$pdf->SetDrawColor(0, 0, 0); // Color de la línea (negro)
$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
$pdf->Ln(30);
$pdf->Cell(0, 10, 'Dr.Cesar Arnoldo Gutierrez Pasillas', 0, 1, 'C');



// Salvar o mostrar el PDF
$pdf->Output('constancia.pdf', 'D')

?>