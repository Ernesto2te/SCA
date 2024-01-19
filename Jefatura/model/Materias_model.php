<?php
require_once "../../assets/librerias/conexion.php";



class MateriasModel extends Conexion
{
 
 

      function Materias()
      {
          $con = parent::Conectar();
          $select_materias = "SELECT * FROM materias";
          $sql = $con->prepare($select_materias);
          $sql->execute();
          $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
          return $datos; // Devolver datos sin codificar a JSON
      }
  
function registrarMatM($NombreMaterias, $ClaveMaterias)
{
    $con = parent::Conectar();

    // Verificar si la materia ya existe
    $select_materia = "SELECT COUNT(*) FROM materias WHERE NombreMat = ?";
    $verificar = $con->prepare($select_materia);
    $verificar->bindValue(1, $NombreMaterias);
    $verificar->execute();

    if ($verificar->fetchColumn() > 0) {
        // Si la materia ya existe, no hacemos nada y simplemente devolvemos un mensaje de error
        $mensaje_error = "¡La materia ya existe, intente con otra!";
        error_log($mensaje_error); // Agregar el mensaje de error al log
        echo $mensaje_error; // Devolver el mensaje de error
    } else {
        // Si la materia no existe, procedemos a la inserción
        $insert_materia = "INSERT INTO materias (NombreMat, ClaveMat) VALUES (?, ?)";
        $insertar = $con->prepare($insert_materia);
        $insertar->bindValue(1, $NombreMaterias);
        $insertar->bindValue(2, $ClaveMaterias);
        $insertar->execute();

        $mensaje_exito = "Materia registrada correctamente!";
        error_log($mensaje_exito); // Agregar el mensaje de éxito al log
        echo $mensaje_exito; // Devolver el mensaje de éxito
    }
}

function editar_Materia($NombreMaterias, $ClaveMaterias, $clave) {
    $con = parent::Conectar();

    // Verifica si la nueva clave es diferente de la clave actual
    if ($ClaveMaterias != $clave) {
        // Verifica si existe una materia con la nueva clave
        $consulta_duplicados = "SELECT * FROM materias WHERE ClaveMat = ?";
        $verificar_duplicados = $con->prepare($consulta_duplicados);
        $verificar_duplicados->bindValue(1, $ClaveMaterias);
        $verificar_duplicados->execute();

        if ($verificar_duplicados->rowCount() > 0) {
            // Existe otra materia con la misma nueva clave
            return "Clave duplicada";
        }
    }

    // Procede a actualizar la materia
    $update_materia = "UPDATE materias SET NombreMat = ?, ClaveMat = ? WHERE ClaveMat = ?";
    $actualizar = $con->prepare($update_materia);
    
    // Intenta ejecutar la consulta de actualización
    if ($actualizar->execute([$NombreMaterias, $ClaveMaterias, $clave])) {
        return "Materia editada exitosamente";
    } else {
        // Manejar el caso en que la actualización falle
        return "Error al editar la materia";
    }
}

}



//    $z= new MateriasModel();
//    $z->editar_Materia("Editado", "MFSS", "CCM");
//  var_dump ($z);