<?php
require '../pdf/fpdf.php';
require_once "../assets/librerias/conexion.php";
 
// Iniciar el buffer de salida
// ob_start();
class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../assets/images/ejemplos/itsvc_logo7.jpg', 10, 5, 30, 0, '');
        // Posición actual
        $x = $this->GetX();
        $y = $this->GetY();

        $this->Image('../assets/images/ejemplos/gobierno-logo.png', 160, $y, 35, 0, '');
        $this->Image('../assets/images/ejemplos/tecnm.png', 160, $y+20, 35, 0, ''); // Agregamos +20 para bajar la imagen 

        $this->Ln(9);
        $this->SetFont('Arial', 'B', 13);
        $this->Cell(75);
        $this->Cell(30, 5, 'INSTITUTO TECNOLOGICO SUPERIOR DE', 0, 1, 'C');
        $this->Cell(75);
        $this->Cell(30, 5, 'VENUSTIANO CARRANZA', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 13);

        $this->Ln(15);
    } 

    function Footer()
    {
        $this->SetY(-18);
        $this->SetFont('Arial', 'I',12);
        // $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' ',0,0,'C' ); 
        $this->Ln();
        $this->Cell(50);
        $this->Cell(100,5,'Este documento no posee validez oficial y tiene unicamente caracter referencial.',0,1,'C');
        $this->SetFont('Arial','I',5);
    } 

    function BodyText($file)
    {
        // LEO ARCHIVO TXT
        $txt = file_get_contents($file);
        // INSERTO FUENTE Y TAMAÑO
        $this->SetFont('Arial','',12);
        // JUSTIFICO TEXTO
        $this->MultiCell(0,5,$txt);
        // INGRESO SALTO LINEA
        $this->Ln();
        // AÑADO TEXTO FIN CAPITULO EN ITÁLICA
        $this->SetFont('','I');
        $this->Cell(0,5,'(fin del capítulo)');
    }
}
// Obtener la matrícula de la URL
$matricula = $_GET['matricula'] ?? '';

if (!empty($matricula)) {
    // Crear objeto de conexión
    $con = new Conexion();
    $dbh = $con->Conectar();

    // Consulta a la base de datos para obtener el nombre del estudiante
    $query = "SELECT nombre_alumno, apellido_paterno, apellido_materno FROM alumnos WHERE matriculaE = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$matricula]);

    $nombreEstudiante = "";
    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nombreEstudiante = $row['nombre_alumno'] . " " . $row['apellido_paterno'] . " " . $row['apellido_materno'];
    }

    // Crear el objeto PDF
    $pdf = new PDF();
    $pdf->AddPage('P', 'Legal');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Ln(5);

    // Texto del certificado
    $pdf->MultiCell(0, 5, 'LA DIRECCION GENERAL DEL INSTITUTO TECNOLOGICO SUPERIOR DE VENUSTIANO CARRANZA CLAVE 21EIT1005P CERTIFICA QUE SEGUN CONSTANCIAS QUE EXISTEN EN EL ARCHIVO ESCOLAR DE ESTE INSTITUTO EL C.' . $nombreEstudiante . ' CURSO LAS ASIGNATURAS QUE INTEGRAN EL PLAN DE ESTUDIOS DE LA CARRERA DE DEL PERIODO COMPRENDIDO DE CON LOS RESULTADOS QUE A CONTINUACION ANOTAN CON LA MATRICULA ' . $matricula . '', 0, 'J');

    // Encabezado de la tabla
    $pdf->Ln(8);
    $pdf->SetFillColor(232, 232, 230);
    $pdf->SetFont('arial', 'B', 12);
    // $pdf->Cell(30, 10, 'Matricula', 1, 0, 'C');
    $pdf->Cell(65, 10, 'Materia', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Clave', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Calificacion', 1, 0, 'C');
    $pdf->Cell(35, 10, 'Observaciones', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Creditos', 1, 1, 'C');

    // Consulta a la base de datos
    $query = "SELECT alumnos.nombre_alumno, alumnos.apellido_paterno, alumnos.apellido_materno, alumnos.matriculaE, materias.nombre_mat, materias.clave_mat, calificaciones.calificacion, calificaciones.observaciones, materias.creditos_totales, carrera.nombreCarrera, materias_impartidas.id_materiaImpartida, calificaciones.nivel_desempeno, calificaciones.tipo_curso
        FROM materias_impartidas
        INNER JOIN materias ON materias_impartidas.id_materia = materias.id_materia
        INNER JOIN calificaciones ON materias_impartidas.id_materiaimpartida = calificaciones.id_materiaimpartida
        INNER JOIN alumnos ON calificaciones.id_alumno = alumnos.id_alumno
        INNER JOIN carrera ON carrera.id_carrera = materias_impartidas.id_carrera
        WHERE matriculaE = ?";
    $stmt = $dbh->prepare($query);
    $stmt->execute([$matricula]);

    // Ciclo para agregar filas a la tabla y calcular el promedio
    $total_creditos = 0;
    $total_calificaciones = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(65, 10, utf8_decode($row['nombre_mat']), 1, 0, 'C');
        $pdf->Cell(30, 10, $row['clave_mat'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['calificacion'], 1, 0, 'C');
        $pdf->Cell(35, 10, utf8_decode($row['observaciones']), 1, 0, 'C');
        $pdf->Cell(30, 10, $row['creditos_totales'], 1, 1, 'C');

        $total_creditos += $row['creditos_totales'];
        $total_calificaciones += $row['calificacion'] * $row['creditos_totales'];
    }

    // Calcular el promedio
    $promedio = 0;
    if ($total_creditos > 0) {
      $promedio = round($total_calificaciones / $total_creditos, 2);
    }
    
    // Agregar una fila al final de la tabla con el promedio
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(65, 10, 'Promedio:', 1, 0, 'C');
    $pdf->Cell(60, 10, '', 0, 0, 'C');
    $pdf->Cell(30, 10, '', 0, 0, 'C');
    $pdf->Cell(35, 10, '', 0, 0, 'C');
    $pdf->Cell(-30, 10, $promedio, 1, 1, 'C');

    // Cerrar la conexión a la base de datos
    $dbh = null;
    ob_end_clean();

    // Salida del PDF
    $pdf->Output('I', 'Certificado_de_calificaciones.pdf');
} else {
     // Redireccionar a otra página
     header("Location: error_kardex.php");
     exit();
}

// Liberar el buffer de salida
// ob_end_flush();
