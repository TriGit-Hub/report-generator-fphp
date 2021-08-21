<?php
require('fpdf.php');

// Datos de conexión
$mysqli = new mysqli("localhost", "root", "", "company");

if(mysqli_connect_errno()) {
	echo 'Conexion fallida: ', mysqli_connect_errno();
	exit();
}

$query = "SELECT * FROM employee";
$resultado = $mysqli->query($query);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 12);
$pdf->Cell(20, 6, 'ID', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'NOMBRE', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'SALARIO', 1, 0, 'C', 1);
$pdf->Cell(100, 6, 'IMG_DIR', 1, 1, 'C', 1);

while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(20, 6, $fila['id'], 1, 0, 'C');
	$pdf->Cell(60, 6, utf8_decode($fila['name']), 1, 0, 'C');
	$pdf->Cell(20, 6, utf8_decode($fila['salary']), 1, 0, 'C');
	$pdf->Cell(100, 6, utf8_decode($fila['img']), 1, 1, 'C');
}
$pdf->Output();
?>