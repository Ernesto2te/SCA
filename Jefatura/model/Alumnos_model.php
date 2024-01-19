<?php
require_once "../../assets/librerias/conexion.php";



class AlumnosModel extends Conexion
{
 
 
    function TablaAlumos()
    {
        $con = parent::Conectar();
        $select_alumnos = "SELECT alumnos.*, grupos.Grupo 
                           FROM alumnos 
                           LEFT JOIN grupos ON alumnos.id_grupo = grupos.id_grupo";
        
        $sql = $con->prepare($select_alumnos);
        $sql->execute();
        $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        return $datos; // Devolver datos con el nombre del grupo
    }
    

      function registrarAlumnoM($NombreAlumno, $MatriculaAlumno, $aPaterno, $aMaterno, $Grupo)
      {
          $con = parent::Conectar();
      
          // Verificar si el alumno ya existe
          $select_alumno = "SELECT COUNT(*) FROM alumnos WHERE Matricula = ?";
          $verificar = $con->prepare($select_alumno);
          $verificar->bindValue(1, $MatriculaAlumno);
          $verificar->execute();
      
          if ($verificar->fetchColumn() > 0) {
              // Si el alumno ya existe, no hacemos nada y simplemente devolvemos un mensaje de error
              $mensaje_error = "¡El alumno ya existe, intente con otra matrícula!";
              error_log($mensaje_error); // Agregar el mensaje de error al log
              echo $mensaje_error; // Devolver el mensaje de error
          } else {
              // Si el alumno no existe, procedemos a la inserción
              $insert_alumno = "INSERT INTO alumnos (Nombres, Matricula, a_paternoA, a_maternoA, Grupo) VALUES (?, ?, ?, ?, ?)";
              $insertar = $con->prepare($insert_alumno);
              $insertar->bindValue(1, $NombreAlumno);
              $insertar->bindValue(2, $MatriculaAlumno);
              $insertar->bindValue(3, $aPaterno);
              $insertar->bindValue(4, $aMaterno);
              $insertar->bindValue(5, $Grupo);
              $insertar->execute();
      
              $mensaje_exito = "Alumno registrado correctamente!";
              error_log($mensaje_exito); // Agregar el mensaje de éxito al log
              echo $mensaje_exito; // Devolver el mensaje de éxito
          }
      }
      


      function editar_Alumnos($MatriculaAlumno,  $NombreAlumno, $aPaterno, $aMaterno, $Grupo,  $clave) {
        $con = parent::Conectar();
    
        // Verifica si la nueva clave es diferente de la clave actual
        if ($MatriculaAlumno != $clave) {
            // Verifica si existe una materia con la nueva clave
            $consulta_duplicados = "SELECT * FROM alumnos WHERE matricula = ?";
            $verificar_duplicados = $con->prepare($consulta_duplicados);
            $verificar_duplicados->bindValue(1, $MatriculaAlumno);
            $verificar_duplicados->execute();
    
            if ($verificar_duplicados->rowCount() > 0) {
                // Existe otra materia con la misma nueva clave
                return "Matricula duplicada";
            }
        }
    
        // Procede a actualizar la materia
        $update_materia = "UPDATE alumnos SET matricula = ?, Nombres = ?, a_paternoA = ?, a_maternoA = ?, Grupo = ?  WHERE matricula = ?";
        $actualizar = $con->prepare($update_materia);
        
        // Intenta ejecutar la consulta de actualización
        if ($actualizar->execute([$MatriculaAlumno,  $NombreAlumno, $aPaterno, $aMaterno, $Grupo,  $clave])) {
            return "Alumno editado exitosamente";
        } else {
            // Manejar el caso en que la actualización falle
            return "Error al editar al alumno";
        }
    }
    


    }
