<?php
require_once "../../assets/librerias/conexion.php";



class ProfesModel extends Conexion
{
 
 

      function Profes()
      {
          $con = parent::Conectar();
          $select_maestros = "SELECT * FROM maestros";
          $sql = $con->prepare( $select_maestros);
          $sql->execute();
          $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
          return $datos; // Devolver datos sin codificar a JSON
      }
  
      function registrarProfeM($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro)
      {
          $con = parent::Conectar();
      
          // Verificar si el profesor ya existe
          $select_profesor = "SELECT COUNT(*) FROM maestros WHERE Clave_Maestro = ? AND a_paternoJM = ? AND a_maternoJM = ?";
          $verificar = $con->prepare($select_profesor);
          $verificar->bindValue(1, $ClaveMaestro); // Corregido, debe ser la clave del maestro
          $verificar->bindValue(2, $ApaternoMaestro);
          $verificar->bindValue(3, $AmaternoMaestro);
          $verificar->execute();
      
          if ($verificar->fetchColumn() > 0) {
              // Si el profesor ya existe, no hacemos nada y simplemente devolvemos un mensaje de error
              $mensaje_error = "¡El profesor ya existe, intente con otro!";
              error_log($mensaje_error); // Agregar el mensaje de error al log
              echo $mensaje_error; // Devolver el mensaje de error
          } else {
              // Si el profesor no existe, procedemos a la inserción
              $insert_profesor = "INSERT INTO maestros (NombreMa, a_paternoJM, a_maternoJM, Clave_Maestro) VALUES (?, ?, ?, ?)";
              $insertar = $con->prepare($insert_profesor);
              $insertar->bindValue(1, $NombreMaestro);
              $insertar->bindValue(2, $ApaternoMaestro);
              $insertar->bindValue(3, $AmaternoMaestro);
              $insertar->bindValue(4, $ClaveMaestro);
              $insertar->execute();
      
              $mensaje_exito = "Profesor registrado correctamente!";
              error_log($mensaje_exito); // Agregar el mensaje de éxito al log
              echo $mensaje_exito; // Devolver el mensaje de éxito
          }
      }
      

      function editar_profesor($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro, $clave) {
        $pdo = parent::Conectar();
        session_start();
    
        try {
            $pdo->beginTransaction();
    
            // Verificar si la nueva clave es diferente de la clave actual y si no está en uso
            if ($ClaveMaestro != $clave) {
                $consulta_duplicados = "SELECT * FROM maestros WHERE Clave_Maestro = ?";
                $stmt_duplicados = $pdo->prepare($consulta_duplicados);
                $stmt_duplicados->execute([$ClaveMaestro]);
    
                if ($stmt_duplicados->rowCount() > 0) {
                    $pdo->rollback();  // Asegurarse de deshacer la transacción
                    return ["error" => "La nueva clave de maestro ya está en uso."];
                }
            }
    
            // Actualizar la información del maestro en la tabla "maestros"
            $update_maestro = "UPDATE maestros SET NombreMa = ?, a_paternoJM = ?, a_maternoJM = ?, Clave_Maestro = ? WHERE Clave_Maestro = ?";
            $stmt_maestro = $pdo->prepare($update_maestro);
            $stmt_maestro->execute([$NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro, $clave]);
    
            $pdo->commit();
            return ["success" => "Maestro editado exitosamente"];
        } catch (PDOException $e) {
            $pdo->rollback();  // Asegurarse de deshacer la transacción en caso de error
            error_log("Error al editar el maestro: " . $e->getMessage());  // Registrar el error
            return ["error" => "Error al editar el maestro: " . $e->getMessage()];
        }
    }
    
    function obtenerProfesores()
    {
        $sql = "SELECT Id_Maestro, NombreMa, a_paternoJM, a_maternoJM FROM maestros";
        $pdo = parent::Conectar();
        $query = $pdo->prepare($sql);
        $query->execute();
    
        $options = [];
    
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            // Concatenar nombre y apellidos
            $nombreCompleto = $row["NombreMa"] . ' ' . $row["a_paternoJM"] . ' ' . $row["a_maternoJM"];
            $options[] = [
                "id" => $row["Id_Maestro"],
                "nombreCompleto" => $nombreCompleto
            ];
        }
    
        return $options;
    }
    
    function guardarRolM($IdMaestro, $Correo, $Contraseña) {
        $pdo = parent::Conectar();
    
        try {
            $pdo->beginTransaction();
    
            $contraseñaHash = password_hash($Contraseña, PASSWORD_DEFAULT);
    
            $sql = "UPDATE maestros SET CorreoRol = ?, ContraseñaRol = ? WHERE Id_Maestro = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$Correo, $contraseñaHash, $IdMaestro]);
    
            $pdo->commit();
            return "Información de usuario actualizada correctamente para el maestro.";
        } catch (PDOException $e) {
            $pdo->rollback(); // Asegurarse de deshacer la transacción en caso de error
            error_log("Error al actualizar la información del maestro: " . $e->getMessage());  // Registrar el error
            return "Error al actualizar la información del maestro: " . $e->getMessage();
        }
    }
    
}




//    $z= new MateriasModel();
//    $z->editar_Materia("Editado", "MFSS", "CCM");
//  var_dump ($z);