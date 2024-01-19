<?php
//ruta para periodo

require_once "../controller/periodo_class.php";
//Datos Periodo
$accion = ""; //Esto tiene que ir vacio para ser llenado posteriormente
$nombreP ="";
$StatusC = "";



//Datos periodo
if (!empty($_POST['nombrePeriodo'])) {
    $nombreP = $_POST['nombrePeriodo'];
}

if (!empty($_POST['StatusP'])) {
    $StatusC = $_POST['StatusP'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}


$objperiodo = new periodo();
$obj_ciclo= new  periodo();

switch ($accion) {
    case 'tablaPeriodo':
        $variablex = $objperiodo->tablaPeriodo();
        $data = array();

        if ($variablex) {  // Verifica si $variablex tiene un valor
            foreach ($variablex as $row) {
                $sub_array = array();
                $sub_array[] = $row['nombrePeriodo'];
                $sub_array[] = '<span class="' . ($row['StatusP'] === 'Activo' ? 'activo' : 'inactivo') . '">' . $row['StatusP'] . '</span>';
                $data[] = $sub_array;
            }
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;


        case 'guardarCiclo':
         
            $res = $obj_ciclo->guardarCiclo( $nombreP, $StatusC );
            echo ($res);
            break;
}


require_once "../controller/materias_class.php";

$NombreMaterias ="";
$ClaveMaterias = "";
$clave_matv = "";
    //Datos materias
if (!empty($_POST['NombreMat'])) {
    $NombreMaterias = $_POST['NombreMat'];
}

if (!empty($_POST['ClaveMat'])) {
    $ClaveMaterias= $_POST['ClaveMat'];
}
if (!empty($_POST['clave_matv'])) {
    $clave_matv= $_POST['clave_matv'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}

$obj_Materia = new Materias();
$obj_TMateria = new Materias();

switch ($accion) {
    case 'tablaMaterias':
        $variablex = $obj_TMateria->tablaMateria();
        $data = array();

        if ($variablex) {  // Verifica si $variablex tiene un valor
            foreach ($variablex as $row) {
                $sub_array = array();
                $sub_array[] = $row['NombreMat'];
                $sub_array[] = $row['ClaveMat'];
                $sub_array[] = '<button class="btn btn-outline-success editar-materia" data-nombre="'.$row['NombreMat'].'" data-clave="'.$row['ClaveMat'].'" data-toggle="modal" data-target="#modal-editar-reticula" style="color: #141313;">Editar Materia</button>';
                $data[] = $sub_array;
            }
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;

    case 'guardarMateria':
        
        $res = $obj_Materia->guardarMatClass($NombreMaterias, $ClaveMaterias);
        echo ($res);
        break;


    case 'editarMateria':
        $obj_TMateria = new Materias();
        echo ($obj_TMateria->editarMateria($NombreMaterias, $ClaveMaterias, $clave_matv));

        
        break;
    


    
}

//TODO: RUTA ALUMNOS

require_once "../controller/Alumnos_class.php";

$NombreAlumno ="";
$MatriculaAlumno ="";
$matricula_alumV = "";
$aPaterno = "";
$aMaterno = "";
$Grupo ="";

 //Datos Alumnos
 if (!empty($_POST['Nombres'])) {
    $NombreAlumno = $_POST['Nombres'];
}

if (!empty($_POST['matricula'])) {
    $MatriculaAlumno= $_POST['matricula'];
}
if (!empty($_POST['matricula_alumV'])) {
    $matricula_alumV= $_POST['matricula_alumV'];
}

if (!empty($_POST['a_paternoA'])) {
    $aPaterno= $_POST['a_paternoA'];
}
if (!empty($_POST['a_maternoA'])) {
    $aMaterno= $_POST['a_maternoA'];
}
if (!empty($_POST['Grupo'])) {
    $Grupo= $_POST['Grupo'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}
$obj_AlumnosT = new Alumnos();


switch ($accion) {
    case 'tablaAlumnos':
        $variablex = $obj_AlumnosT->tablaAlumnoClass();
        $data = array();

        if ($variablex) {  // Verifica si $variablex tiene un valor
            foreach ($variablex as $row) {
                $sub_array = array();
                $sub_array[] = $row['matricula'];
                $sub_array[] = $row['Nombres'];         
                $sub_array[] = $row['a_paternoA'];
                $sub_array[] = $row['a_maternoA'];
                $sub_array[] = $row['Grupo'];
                $sub_array[] = '<button class="btn btn-outline-success" id="EditarAlumnos" data-matricula="'.$row['matricula'].'" data-nombre="'.$row['Nombres'].'"   data-apaterno="'.$row['a_paternoA'].'"  data-amaterno="'.$row['a_maternoA'].'"  data-grupo="'.$row['Grupo'].'" data-toggle="modal" data-target="modal-Editar-alumno" " style="color: #141313;">Editar Alumnos</button>'; 
                $sub_array[] = '<button class="btn btn-outline-success EditarAlumnos" id="EditarAlumnos" 
                data-nombre="'.$row['Nombres'].'" 
                data-matricula="'.$row['matricula'].'"
                data-apaterno="'.$row['a_paternoA'].'"
                data-amaterno="'.$row['a_maternoA'].'"
                data-grupo="'.$row['Grupo'].'"
                data-toggle="modal" 
                data-target="#modal-Editar-alumno" 
                style="color: #141313;">Editar Alumnos</button>';

                $data[] = $sub_array;
            }
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;


        case 'guardarAlumno':
    
            $res = $obj_AlumnosT ->guardarAlumnoClass($MatriculaAlumno, $NombreAlumno,  $aPaterno, $aMaterno, $Grupo);
            echo ($res);
            break;


            case 'editarAlumno':
                $obj_AlumnosT = new Alumnos();
                echo ($obj_AlumnosT->editarAlumno($MatriculaAlumno, $NombreAlumno,  $aPaterno, $aMaterno, $Grupo, $matricula_alumV));
        
                
                break;



        }



//TODO: RUTA PROFESORES

require_once "../controller/Profesores_class.php";


$NombreMaestro="";
$ApaternoMaestro= "";
$AmaternoMaestro = "";
$ClaveMaestro = "";
$clave_ProfesorV= "";
$Correo= "";
$Contraseña= "";
$Id_Maestro = "";
$accion ="";

    //Datos materias
if (!empty($_POST['NombreMa'])) {
    $NombreMaestro = $_POST['NombreMa'];
}

if (!empty($_POST['Id_Maestro'])) {
    $Id_Maestro= $_POST['Id_Maestro'];
}


if (!empty($_POST['a_paternoJM'])) {
    $ApaternoMaestro = $_POST['a_paternoJM'];
}

if (!empty($_POST['a_maternoJM'])) {
    $AmaternoMaestro  = $_POST['a_maternoJM'];
}

if (!empty($_POST['Clave_Maestro'])) {
    $ClaveMaestro = $_POST['Clave_Maestro'];
}
if (!empty($_POST['clave_ProfesorV'])) {
    $clave_ProfesorV  = $_POST['clave_ProfesorV'];
}

if (!empty($_POST['CorreoRol'])) {
    $Correo = $_POST['CorreoRol'];
}


if (!empty($_POST['ContraseñaRol'])) {
    $Contraseña  = $_POST['ContraseñaRol'];
}


if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}

$obj_Tprofes = new Profesores();


switch ($accion) {
    case 'tablaProfes':
        $variablex = $obj_Tprofes->tablaProfesT();
        $data = array();

        if ($variablex) {  // Verifica si $variablex tiene un valor
            foreach ($variablex as $row) {
                $sub_array = array();
                $sub_array[] = $row['NombreMa'];
                $sub_array[] = $row['a_paternoJM'];
                $sub_array[] = $row['a_maternoJM'];
                $sub_array[] = $row['Clave_Maestro'];
                $sub_array[] = '<button class="btn btn-outline-success " id="btnEditarProfesor" data-NombreMa="'.$row['NombreMa'].'" data-a_paternoJM="'.$row['a_paternoJM'].'" data-a_maternoJM="'.$row['a_maternoJM'].'" data-Clave_Maestro="'.$row['Clave_Maestro'].'" data-toggle="modal" data-target="#modal-editar-profesor" style="color: #141313;">Editar Profesor</button>';
                $data[] = $sub_array;
            }
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );

        echo json_encode($results);
        break;

        case 'guardarProfe':
    
            $res =  $obj_Tprofes ->guardarProfeClass($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro);
            echo ($res);
            break;

            case 'editarProfesor':
                $obj_Tprofes = new Profesores();
            echo($obj_Tprofes->editarProfesor($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro, $clave_ProfesorV));
           
                break;
    
              
                case 'Buscar_maestro':
   
                    $obj_Tprofes = new Profesores();
                    $response = $obj_Tprofes->BuscarProf();
                    $json = json_encode($response);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        // Manejar el error de codificación JSON
                        echo "Error en la codificación JSON: " . json_last_error_msg();
                        exit;
                    }
                    echo $json;
break;

                    case 'guardarRol':
                        $res = $obj_Tprofes->guardarRolClass($Id_Maestro, $Correo, $Contraseña);
                        echo $res;
                        break;
                    
                    

        }




// todo: RUTA PARA CARGA MASIVA ESTUDIANTES
require_once "../controller/Carga_masiva_class.php";

$accion = "";
$apellido_paterno = "";
$apellido_materno = "";
$nombre_alumno = "";
$matriculas= "";
$CURP= "";
$DOMICILIO= "";
$FECHAINGRESO= "";
$estadoAlumno= "";
$GRUPO= "";



if (!empty($_POST['a_paternoA'])) {
    $apellido_paterno = $_POST['a_paternoA'];
}


if (!empty($_POST['a_maternoA'])) {
    $apellido_materno = $_POST['a_maternoA'];
}

if (!empty($_POST['Nombres'])) {
    $nombre_alumno = $_POST['Nombres'];
}

if (!empty($_POST['matricula'])) {
    $matriculas = $_POST['matricula'];
}

if (!empty($_POST['Curp'])) {
    $CURP = $_POST['Curp'];
}
if (!empty($_POST['Domicilio'])) {
    $DOMICILIO = $_POST['Domicilio'];
}
if (!empty($_POST['fechaingreso'])) {
    $FECHAINGRESO = $_POST['fechaingreso'];
}
if (!empty($_POST['estadoAlumno'])) {
    $estadoAlumno= $_POST['estadoAlumno'];
}
if (!empty($_POST['Grupo'])) {
    $GRUPO= $_POST['Grupo'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}

switch ($accion) {
    case 'insertar_carga_masiva':
        $obj_materiaa = new CargaMasiva();

        // Obtener los datos del archivo Excel
        $apellido_paterno = $_POST['a_paternoA'];
        $apellido_materno = $_POST['a_maternoA'];
        $nombre_alumno = $_POST['Nombres'];
        $matriculas = $_POST['matricula'];
        $CURP= $_POST['Curp'];
        $DOMICILIO= $_POST['Domicilio'];
        $FECHAINGRESO= $_POST['fechaingreso'];
        $estadoAlumno = $_POST['estadoAlumno'];
        $GRUPO = $_POST['Grupo'];
        
        
        // Contar la cantidad de registros recibidos
        $totalRegistros = count($matriculas);

        // Variable para verificar si se encontró el alumno en la base de datos
        $alumnoEncontrado = true;

        // Iterar sobre los registros y realizar alguna operación con cada dato
        for ($i = 0; $i < $totalRegistros; $i++) {

            $apellidoP = $apellido_paterno[$i];
            $apellidoM = $apellido_materno[$i];
            $NombreA   = $nombre_alumno[$i];
            $matricula = $matriculas[$i];
            $curp      = $CURP[$i];
            $domicilio = $DOMICILIO[$i];
            $fechain   = $FECHAINGRESO[$i];
            $estadoAlumno  = $estadoAlumno[$i];
            $grupo = $GRUPO[$i];
            
            
            $res = $obj_materiaa->Insertar_Carga_Masiva($apellidoP, $apellidoM, $NombreA, $matricula, $curp, $domicilio, $fechain, $estadoAlumno, $grupo);

            // Verificar si no se encontró el alumno en la base de datos
            if ($res === "Error: No se encontró el alumno en la base de datos.") {
                $alumnoEncontrado = false;
                break; // Salir del bucle si se encuentra un error
            }
        }
      
        // Verificar si se encontró el alumno en la base de datos
        // if ($alumnoEncontrado) {
        //     echo "Éxito";
        // } else {
        //     echo "Error: No se encontró el alumno en la base de datos.";
         }

    
//todo: carga masiva calificaciones 
require_once "../controller/Carga_masiva_calificaciones_class.php";
$Nombre_Periodo = "";
$nombre_DA = "";
$Doncentes_AE = "";
$docente = "";
$materia = "";
$grupo = "";
$semestre = "";


if (!empty($_POST['nombrePeriodo'])) {
    $Nombre_Periodo = $_POST['nombrePeriodo'];
}
if (!empty($_POST['NombreMa'])) {
    $docente  = $_POST['NombreMa'];
}
if (!empty($_POST['NombreMat'])) {
    $materia = $_POST['NombreMat'];
}
if (!empty($_POST['Grupo'])) {
    $grupo= $_POST['Grupo'];
}
if (!empty($_POST['nombreD'])) {
    $nombreDA = $_POST['nombreD'];
}
if (!empty($_POST['Doncentes_AE'])) {
    $Doncentes_AE = $_POST['Doncentes_AE'];
}
if (!empty($_POST['semestre'])) {
    $semestre  = $_POST['semestre'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}

switch ($accion) {
case 'Buscar_PeriodoD':
    $obj_materiaa = new  CargaMasivaCali();
    $response = $obj_materiaa ->BuscarPeri();
    $json = json_encode($response);
    $data = array();

    foreach ($response as $row) {
        $sub_array = array();
        $sub_array[] = $row['nombrePeriodo'];
        $data[] = $sub_array;
    }
    $response = json_encode($data);
    echo $response;
    break;

    case 'Buscar_Materias': // Cambia el nombre de la acción
        $obj_materiaa = new CargaMasivaCali();
        $res = $obj_materiaa->BuscarMat($nombre_DA); // No necesitas pasar $nombre_DA
        echo $res;
        break;

        case 'Buscar_MateriasDC': // Cambia el nombre de la acción
            $obj_materiaa = new CargaMasivaCali();
            $res = $obj_materiaa->BuscarMatDC($nombre_DA); // No necesitas pasar $nombre_DA
            echo $res;
            break;


        case 'insertar_asignacion_DOCENTE':
    
                $res = $obj_materiaa->guardarMATDOCClass($Nombre_Periodo, $docente, $materia, $grupo);
                echo ($res);
                break;
    
    

      // En tu archivo rutas.php
 case 'buscar_docenteD':
        $obj_materiaa = new CargaMasivaCali();
        $docentes = $obj_materiaa->BuscarDocente();
        echo json_encode($docentes);
        break;

        case 'buscar_docenteDC':
            $obj_materiaa = new CargaMasivaCali();
            $docentes = $obj_materiaa->BuscarDocenteDC();
            echo json_encode($docentes);
            break;
    

        case 'Buscar_PeriodoDC':
            $obj_materiaa = new  CargaMasivaCali();
            $response = $obj_materiaa ->BuscarPeriDC();
            $json = json_encode($response);
            $data = array();
        
            foreach ($response as $row) {
                $sub_array = array();
                $sub_array[] = $row['nombrePeriodo'];
                $data[] = $sub_array;
            }
            $response = json_encode($data);
            echo $response;
            break;

case 'insertar_asignacion_Cali':
    $obj_materiaa = new CargaMasivaCali();
    
    // Obtener los datos del archivo Excel
    $MATRICULAS = $_POST['matricula'] ?? array();
    $SEMESTRE = $_POST['Semestre'] ?? array();
    $FALTAS_P1 = $_POST['Faltas_P1'] ?? array();
    $FALTAS_P2 = $_POST['Faltas_P2'] ?? array();
    $FALTAS_P3 = $_POST['Faltas_P3'] ?? array();
    $FALTAS_FINAL = $_POST['Faltas_FINAL'] ?? array();
    $CALI_P1 = $_POST['CALI_P1'] ?? array();
    $CALI_P2 = $_POST['CALI_P2'] ?? array();
    $CALI_P3 = $_POST['CALI_P3'] ?? array();
    $CALI_FINAL = $_POST['CALI_FINAL'] ?? array();
    
    // Contar la cantidad de registros recibidos
    $totalRegistros = count($MATRICULAS);
    // echo($totalRegistros); // Esto podría interferir con la respuesta JSON
    
    // Variable para verificar si se encontró el alumno en la base de datos
    $alumnoEncontrado = true;

    // Iterar sobre los registros y realizar alguna operación con cada dato
    for ($i = 0; $i < $totalRegistros; $i++) {
        $matricula = $MATRICULAS[$i];
        $semestre = $SEMESTRE[$i];
        $faltaP1 = $FALTAS_P1[$i];
        $faltaP2 = $FALTAS_P2[$i];
        $faltaP3 = $FALTAS_P3[$i];
        $faltaFinal = $FALTAS_FINAL[$i];
        $caliP1 = $CALI_P1[$i];
        $caliP2 = $CALI_P2[$i];
        $caliP3 = $CALI_P3[$i];
        $caliFinal = $CALI_FINAL[$i];
        $res = $obj_materiaa->Insertar_Asig_EstudianteC($matricula, $semestre, $faltaP1,$faltaP2, $faltaP3, $faltaFinal, $caliP1, $caliP2, $caliP3, $caliFinal, $Nombre_Periodo, $docente, $materia, $grupo);

        // Verificar si no se encontró el alumno en la base de datos
        if ($res === "Error: No se encontró el alumno en la base de datos.") {
            $alumnoEncontrado = false;
            break; // Salir del bucle si se encuentra un error
        }
        // var_dump($res);
    }

    // Preparar la respuesta JSON
    $response = array(
        "status" => $alumnoEncontrado ? "success" : "error",
        "message" => $alumnoEncontrado ? "Datos registrados correctamente" : "Error: No se encontró el alumno en la base de datos.",
    );

    // Enviar respuesta JSON
    echo json_encode($response);

    break;

// //todo: ruta asignacion materias docente :3
// require_once "../controller/asignacion_materia_docente_class.php";
// $Nombre_Periodo = "";
// $nombre_DA = "";
// $Doncentes_AE = "";
// $docente = "";
// $materia = "";
// $grupo = "";


// if (!empty($_POST['nombrePeriodo'])) {
//     $Nombre_Periodo = $_POST['nombrePeriodo'];
// }
// if (!empty($_POST['NombreMa'])) {
//     $docente  = $_POST['NombreMa'];
// }
// if (!empty($_POST['NombreMat'])) {
//     $materia = $_POST['NombreMat'];
// }
// if (!empty($_POST['Grupo'])) {
//     $grupo= $_POST['Grupo'];
// }
// if (!empty($_POST['nombreD'])) {
//     $nombreDA = $_POST['nombreD'];
// }
// if (!empty($_POST['Doncentes_AE'])) {
//     $Doncentes_AE = $_POST['Doncentes_AE'];
// }

// if (!empty($_POST['accion'])) {
//     $accion = $_POST['accion'];
// }

// switch ($accion) {
// case 'Buscar_PeriodoMD':
//     $obj_materiaa = new  CargaMasivaCaliD();
//     $response = $obj_materiaa ->BuscarPeri();
//     $json = json_encode($response);
//     $data = array();

//     foreach ($response as $row) {
//         $sub_array = array();
//         $sub_array[] = $row['nombrePeriodo'];
//         $data[] = $sub_array;
//     }
 
//     echo $response;
//     break;

//     case 'Buscar_MateriasMD': // Cambia el nombre de la acción
//         $obj_materiaa = new CargaMasivaCaliD();
//         $res = $obj_materiaa->BuscarMat($nombre_DA); // No necesitas pasar $nombre_DA
//         echo $res;
//         break;

//       // En tu archivo rutas.php
//  case 'buscar_docenteMD':
//         $obj_materiaa = new CargaMasivaCaliD();
//         $docentes = $obj_materiaa->BuscarDocente();
//         echo json_encode($docentes);
//         break;

//  }

}
?>