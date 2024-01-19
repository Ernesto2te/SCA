<?php
require_once "../../assets/librerias/conexion.php";
class periodoModel extends Conexion
{
 
 

      function periodo()
      {
          $con = parent::Conectar();
          $select_periodo = "SELECT * FROM periodo";
          $sql = $con->prepare($select_periodo);
          $sql->execute();
          $datos = $sql->fetchAll(PDO::FETCH_ASSOC);
          return $datos; // Devolver datos sin codificar a JSON
      }
  
  
      function registrarCicloM($nombreP, $StatusC)
      {
          $con = parent::Conectar();
      
          // Verificar si el periodo ya existe
          $select_periodo = "SELECT COUNT(*) FROM periodo WHERE nombrePeriodo = ?";
          $verificar = $con->prepare($select_periodo);
          $verificar->bindValue(1, $nombreP);
          $verificar->execute();
      
          if ($verificar->fetchColumn() > 0) {
              // Si el periodo ya existe, no hacemos nada y simplemente devolvemos un mensaje de error
              $mensaje_error = "¡Algunos datos se encuentran duplicados, intente nuevamente!";
              error_log($mensaje_error); // Agregar el mensaje de error al log
              echo $mensaje_error; // Devolver el mensaje de error
          } else {
              // Si el periodo no existe, procedemos a la inserción
              $insert_periodo = "INSERT INTO periodo (nombrePeriodo, StatusP) VALUES (?, ?)";
              $insertar = $con->prepare($insert_periodo);
              $insertar->bindValue(1, $nombreP);
              $insertar->bindValue(2, $StatusC);
              $insertar->execute();
      
              $mensaje_exito = "Periodo registrado correctamente!";
              error_log($mensaje_exito); // Agregar el mensaje de éxito al log
              echo $mensaje_exito; // Devolver el mensaje de éxito
          }
      }
      


  // function periodoActivo()
  // {
  //   $select_periodo = "SELECT * FROM periodo WHERE statusP = 'Activo'";
  //   $con = parent::Conectar();
  //   $sql = $con->prepare($select_periodo);
  //   $sql->execute();
  //   while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
  //     $x[] = $row;
  //   }
  //   return json_encode($x);
  // }
}
//Esto es para agregar datos desde la consola
// $z= new periodoModel();
// $z->registrarPeriodoModel("Enero-Junio-2023","Activo");
// var_dump($z);

//Llamar tabla para llenarla
// $z= new periodoModel(); 
// $z-> periodo();
// var_dump($z);
// Crear una instancia de la clase
// $resultado = new periodoModel();

// Llama al método dentro de la instancia
// $resultado  ->periodo();

// Utiliza var_dump para mostrar el contenido de la variable en la consola
// var_dump($resultado);?>