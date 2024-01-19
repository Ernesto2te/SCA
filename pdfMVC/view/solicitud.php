<?php

require '../assets/fpdf/fpdf.php';


$d = new GenerateDocument($uid,$token);
   $datos = $d->getinfo();
//separar la fecha

$fecha = explode('-', '');



$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->AddPage();
$pdf->SetTitle(utf8_decode('SCA PDF - Ficha academicá del estudiante '));

// encabezado de logos de carga academica
$pdf->Image('../assets/images/header_boleta.png', 60, 4, 100, 25, 'PNG');


$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 6, utf8_decode("FICHA ACADEMICA DEL ESTUDIANTE (KARDEK)"), 0, 0, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 6, 'DATOS DE LA ESCUELA ', 1, 0, 'C');
$pdf->Ln(6);
//INICIA TABLA DE ASIGNATURAS
$pdf->Cell(40, 30, '', 1, 0, 'C');
$pdf->Cell(100, 20, '', 1, 0, 'C');
$pdf->Cell(31, 20, '', 1, 0, 'C');
$pdf->Cell(25, 20, '', 1, 0, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 10, ' ', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 10, ' ', 1, 0, 'C');
$pdf->Ln(-20);


$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 8, '', 0, 0, 'C');
$pdf->Cell(12, 8, 'Nombre:', 0, 0, 'l');
$pdf->SetFont('Arial', 'b',8);
$pdf->Cell(88, 8, 'ESCUELA PREPARATORIA OFICIAL DEL ESTADO DE MEXICO', 0, 0, 'l');
$pdf->SetFont('Arial', '',8);

$pdf->Cell(32, 8, 'CCT:', 0, 0, 'l');
$pdf->Cell(15, 8, 'ZONAS:', 0, 0, 'l');
$pdf->Ln(4);
$pdf->SetFont('Arial', 'B',8);

$pdf->Cell(40, 8, '', 0, 0, 'C');
$pdf->Cell(100, 8, 'NUM.128', 0,0,'L');
$pdf->Cell(32, 8, '15EBH0255P', 0);
$pdf->Cell(10, 8, '053', 0);
$pdf->Ln(4);

$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(0, 12, '', 0, 0, 'C');
$pdf->Ln();

$pdf->SetFont('Arial', '', 8);
$pdf->Cell(40, 6, '', 0);
$pdf->Cell(0, 6, 'DOMICILIO: JOSE MARIA MORELOS #1, Col. CARLOS HANK GONZALEZ, CP. 55520, ECATEPE DE MORELOS', 0);

$pdf->Ln(14);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(0, 5, utf8_decode('DATOS DEL ALUMNO'), 1,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(90, 6, 'NOMBRE:', 1,0,'L');
$pdf->Cell(53, 6, 'CURP:', 1,0,'L');
$pdf->Cell(53, 6, 'MATRICULA:', 1,0,'L');
$pdf->Ln();
$pdf->Cell(0, 6,utf8_decode(  $datos['domicilio']), 1);
$pdf->Ln();

$pdf->Cell(0, 6,utf8_decode( 'TUTOR: '), 1);

$pdf->Ln(-12);
$pdf->Cell(15, 6,utf8_decode( ' '), 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(73, 6,utf8_decode( $datos['nombre']), 0);
$pdf->Cell(12, 6,utf8_decode( ''), 0);
$pdf->Cell(40, 6,utf8_decode( $datos['CURP']), 0);
$pdf->Cell(21, 6,utf8_decode( ''), 0);
$pdf->Cell(0, 6,utf8_decode( $datos['matricula']), 0);
$pdf->Ln();
$pdf->Cell(3, 6, '', 0);
$pdf->Ln();
$pdf->Cell(11, 6, '', 0);
$pdf->Cell(60, 6, utf8_decode($datos['tutor']), 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(30, 6, 'FECHA DE INGRESO:', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6, $datos['fechaIngre'], 0);
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(35, 6, 'ESTATUS DEL ALUMNO:', 0);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 6,$datos['estatus'] , 0);





$SEMESTRES=0;
$SUMAPROMEDIO=0;

$datosmate = $d->getmaterias();

if (!empty($datosmate['materias'])) {
    // Obtener un array que agrupe las materias por semestre
    $materiasPorSemestre = [];
    foreach ($datosmate['materias'] as $registro) {
        $semestre = $registro['semestre'];
        $materiasPorSemestre[$semestre][] = $registro;
    }

    // Iterar sobre los semestres y generar las tablas
    foreach ($materiasPorSemestre as $semestre => $materias) {
          // Calcular el promedio semestral de CALI_FINAL
          $totalCalificacionesSemestre = 0;
          $numMateriasSemestre = count($materias);
  
          foreach ($materias as $registro) {
              $totalCalificacionesSemestre += $registro['CALI_FINAL'];
          }
  
          $promedioSemestral = $numMateriasSemestre > 0 ? ($totalCalificacionesSemestre / $numMateriasSemestre) : 0;
          $totalCalificaciones = 0;
          $numCalificaciones = 0;
      
          // Iterar sobre todas las materias y sumar las calificaciones finales
          foreach ($datosmate['materias'] as $registro) {
              $calificacionFinal = $registro['CALI_FINAL'];
      
              // Verificar si la calificación final está definida
              if (isset($calificacionFinal)) {
                  $totalCalificaciones += $calificacionFinal;
                  $numCalificaciones++;
              }
          }
      
          // Calcular el promedio general
          $promedioGeneral = $numCalificaciones > 0 ? ($totalCalificaciones / $numCalificaciones) : 0;
      
        // Imprimir encabezado del semestre
        $pdf->Ln(10);
        $pdf->Cell(0, 6, '', 1);
        $pdf->Ln(0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(19, 6, 'Ciclo Escolar: ', 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(40, 6, $token, 0);
        $pdf->Cell(40, 6, 'SEMESTRE ' . $semestre, 0);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(27, 6, 'Promedio semestral:', 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(7, 6, number_format($promedioSemestral, 1), 0); // Mostrar el promedio con un decimal
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(25, 6, 'Promedio General:', 0);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(15, 6, number_format($promedioGeneral, 1), 0);
        
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 7);
        $pdf->Cell(75, 15, '', 1);
        $pdf->Cell(31, 10, '', 1);
        $pdf->Cell(30, 10, '', 1);
        $pdf->Cell(60, 10, '', 1);
        $pdf->Ln(0);
        $pdf->Cell(106, 10, '', 0);
        $pdf->Cell(0, 5, 'CALIFICACIONES', 0);
        $pdf->Ln();
        $pdf->Cell(75, 10, '', 0);
        $pdf->Cell(31, 5, 'FALTAS', 0);
        $pdf->Cell(30, 5, 'PARCIALES', 0);
        $pdf->Cell(60, 5, 'CALIFICACIONES EXTRAORDINARIAS', 0);
        $pdf->Ln();
        $pdf->Cell(75, 5, 'ASIGNATURA', 0);
        $pdf->SetFont('Arial', 'B', 6);
        
        $pdf->Cell(7, 5, '1ros', 1);
        $pdf->Cell(7, 5, '2do', 1);
        $pdf->Cell(7, 5, '3ero', 1);
        $pdf->Cell(10, 5, 'TOTAL', 1);
        
        $pdf->Cell(7, 5, '1ros', 1);
        $pdf->Cell(7, 5, '2do', 1);
        $pdf->Cell(7, 5, '3ero', 1);
        $pdf->Cell(9, 5, 'FINAL', 1);
        
        $pdf->Cell(6, 5, 'CAL', 1);
        $pdf->Cell(9, 5, 'FECHA', 1);
        $pdf->Cell(6, 5, 'CAL', 1);
        $pdf->Cell(9, 5, 'FECHA', 1);
        $pdf->Cell(6, 5, 'CAL', 1);
        $pdf->Cell(9, 5, 'FECHA', 1);
        $pdf->Cell(6, 5, 'CAL', 1);
        $pdf->Cell(9, 5, 'FECHA', 1);
        
        
        foreach ($materias as $registro) {
            $pdf->Ln();
            $pdf->Cell(75, 5, utf8_decode($registro['nombremateria']), 1);
            $pdf->Cell(7, 5, $registro['Faltas_P1'], 1);
            $pdf->Cell(7, 5, $registro['Faltas_P2'], 1);
            $pdf->Cell(7, 5, $registro['Faltas_P3'], 1);
            $pdf->Cell(10, 5, $registro['Faltas_FINAL'], 1);
            $pdf->Cell(7, 5, $registro['CALI_P1'], 1);
            $pdf->Cell(7, 5, $registro['CALI_P2'], 1);
            $pdf->Cell(7, 5, $registro['CALI_P3'], 1);
            $pdf->Cell(9, 5, $registro['CALI_FINAL'], 1);
            $pdf->Cell(6, 5, '', 1);
            $pdf->Cell(9, 5, '', 1);
            $pdf->Cell(6, 5, '', 1);
            $pdf->Cell(9, 5, '', 1);
            $pdf->Cell(6, 5, '', 1);
            $pdf->Cell(9, 5, '', 1);
            $pdf->Cell(6, 5, '', 1);
            $pdf->Cell(9, 5, '', 1);
        }
    }
} else {
    // No hay datos para imprimir
    $pdf->Ln();
    $pdf->Cell(100, 10, 'No hay datos disponibles', 1, 0, 'C');
}




$pdf->Output( 'BOLETA '.$datos['nombre'].'.PDF','I');

?>