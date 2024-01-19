<?php
// require_once "../../assets/librerias/conexion.php";
// require_once "../../auth/model/login_model.php";

// class  ModeloAsigCD extends conexion {

//     function buscarMaterias($nombre_DA)
//     {
//         $sql = "SELECT MI.id_materia, M.NombreMat
//                 FROM materias_impartidas MI
//                 INNER JOIN materias M ON MI.id_materia = M.id_materia";
    
//         $pdo = parent::Conectar();
//         $query = $pdo->prepare($sql);
//         $query->execute();
    
//         $materias = array(); // Crear un arreglo para almacenar las materias
    
//         while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
//             $materia = array(
//                 "id_materia" => $row["id_materia"],
//                 "NombreMat" => $row["NombreMat"]
//             );
//             $materias[] = $materia;
//         }
    
//         // Devolver el resultado como JSON
//         echo json_encode($materias, JSON_UNESCAPED_UNICODE);
//     }
    
//   function buscarPeriodo()
//   {
//     $sql = "SELECT * FROM periodo ";
//     $pdo = parent::Conectar();
//     $query = $pdo->prepare($sql);
//     $query->execute();

//     while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
//       $x[] = $row;
//     }
//     return ($x);
//   }

//   function buscarDocente() {
//     $sql = "SELECT DISTINCT m.Id_Maestro, CONCAT(m.NombreMa, ' ', m.a_paternoJM,  ' ', m.a_maternoJM) AS NombreCompleto 
//             FROM maestros m
//             INNER JOIN materias_impartidas mi ON m.Id_Maestro = mi.Id_Maestro";
    
//     $pdo = parent::Conectar();
//     $query = $pdo->prepare($sql);
//     $query->execute();

//     $docentes = array();
//     while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
//         $docentes[] = array(
//             "id" => $row["Id_Maestro"],
//             "nombreCompleto" => $row["NombreCompleto"]
//         );
//     }
//     return $docentes;
// }
  
  


//   function InsertarAsignacionEstudianteM($matricula, $semestre, $faltaP1, $faltaP2, $faltaP3, $faltaFinal, $caliP1, $caliP2, $caliP3, $caliFinal, $Nombre_Periodo, $docente1, $materia, $grupo)
//   {
//       try {
//           $pdo = parent::Conectar();
//           $pdo->beginTransaction();

//           // Obtener el ID del alumno
//           $query_alumno = "SELECT id_alumno FROM alumnos WHERE matricula = ?";
//           $stmt_alumno = $pdo->prepare($query_alumno);
//           $stmt_alumno->execute([$matricula]);
//           $id_alumno = $stmt_alumno->fetchColumn();

//           if (!$id_alumno) {
//               $error_message = "Error: No se encontró el alumno en la base de datos.";
//               error_log($error_message);
//               return $error_message;
//           }

//           // Obtener el ID del período
//           $query_periodo = "SELECT id_periodo FROM periodo WHERE nombrePeriodo = ?";
//           $stmt_periodo = $pdo->prepare($query_periodo);
//           $stmt_periodo->execute([$Nombre_Periodo]);
//           $id_periodo = $stmt_periodo->fetchColumn();

//           if (!$id_periodo) {
//               return "Error: No se encontró el período en la base de datos.";
//           }

//           // Obtener el ID de la materia
//           $query_mat = "SELECT id_materia FROM materias WHERE NombreMat = ?";
//           $stmt_mat = $pdo->prepare($query_mat);
//           $stmt_mat->execute([$materia]);
//           $id_materia = $stmt_mat->fetchColumn();

//           if (!$id_materia) {
//               return "Error: No se encontró la materia en la base de datos.";
//           }

//           // Obtener el ID del docente
//           $query_docente = "SELECT Id_Maestro FROM maestros WHERE CONCAT(NombreMa, ' ', a_paternoJM, ' ', a_maternoJM) = ?";
//           $stmt_docente = $pdo->prepare($query_docente);
//           $stmt_docente->execute([$docente1]);
//           $id_docente = $stmt_docente->fetchColumn();

//           if (!$id_docente) {
//               return "Error: No se encontró el docente en la base de datos.";
//           }

         

//           // Obtener el ID de la materia impartida
//           $query_materiaIM = "SELECT id_materiaImpartida FROM materias_impartidas WHERE id_periodo = ? AND id_materia = ? AND Id_Maestro = ?";
//           $stmt_materiaIM = $pdo->prepare($query_materiaIM);
//           $stmt_materiaIM->execute([$id_periodo, $id_materia, $id_docente]);
//           $id_materiaImpartida = $stmt_materiaIM->fetchColumn();

//           if (!$id_materiaImpartida) {
//               $error_message = "Error: No se encontró la materia impartida en la base de datos.";
//               error_log($error_message);
//               return $error_message;
//           }

//           // Verificar si la calificación ya ha sido asignada
//           $query_verificar = "SELECT COUNT(*) FROM boletas WHERE id_alumno = ? AND id_materiaImpartida = ?";
//           $stmt_verificar = $pdo->prepare($query_verificar);
//           $stmt_verificar->execute([$id_alumno, $id_materiaImpartida]);
//           $existe_calificacion = $stmt_verificar->fetchColumn();

//           if ($existe_calificacion > 0) {
//               return "Error: La calificación ya ha sido asignada previamente.";
//           }

//           // Insertar la calificación
//           $sql = "INSERT INTO boletas (id_alumno, id_materiaImpartida, semestre, Faltas_P1, Faltas_P2, Faltas_P3, Faltas_FINAL, CALI_P1, CALI_P2, CALI_P3, CALI_FINAL) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
//           $query = $pdo->prepare($sql);
//           $query->execute([$id_alumno, $id_materiaImpartida, $semestre, $faltaP1, $faltaP2, $faltaP3, $faltaFinal, $caliP1, $caliP2, $caliP3, $caliFinal]);
//           $id_calificacion = $pdo->lastInsertId();

//           $pdo->commit();
//           echo json_encode(array("status" => "success", "message" => "Los datos se cargaron correctamente"));
//       } catch (Exception $e) {
//           $pdo->rollBack();
//           echo "Error: " . $e->getMessage();
//       }
//   }

// }

