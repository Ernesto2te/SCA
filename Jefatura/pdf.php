<?php
require '../pdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',18); //Tipo de letra, Color negrita, Tamaño de la fuente  todo esto es obligatorio 
$pdf->Cell(180,12,'Kardex Academico',1,1,'C');  //Largo, ancho, texto , recuadro =1 no recuadro=0, C = centrar para orientar es en ingles
$pdf->Output(); //'I','Kardex.pdf'


?>