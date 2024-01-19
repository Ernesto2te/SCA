<?php
require_once "../../assets/librerias/conexion.php";
class carga extends Conexion{
    public function getcargamodel($matricula){

      
      $con = parent::Conectar();
      $arreglo=[];
      $sql= "WITH PeriodosDuplicados AS 
      ( SELECT alumnos.Nombres, alumnos.a_paternoA, alumnos.a_maternoA, alumnos.matricula, periodo.nombrePeriodo, ROW_NUMBER()
       OVER (PARTITION BY periodo.nombrePeriodo ORDER BY alumnos.matricula) 
       AS row_num FROM boletas
        INNER JOIN alumnos ON alumnos.id_alumno = boletas.id_alumno
         INNER JOIN materias_impartidas ON materias_impartidas.id_materiaImpartida = boletas.id_materiaImpartida
          INNER JOIN periodo ON periodo.id_periodo = materias_impartidas.id_periodo WHERE alumnos.matricula = ? ) 
          SELECT Nombres, a_paternoA, a_maternoA, matricula, nombrePeriodo FROM PeriodosDuplicados WHERE row_num = 1;";
      $stmt = $con->prepare($sql);
      $stmt->execute([$matricula]);
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arreglo[] = $row;
      }
      $data= [
        "cargas"=>$arreglo,
        "server" =>$_SERVER['SERVER_NAME'],
      ];
      return json_encode($data);
    }


}

?>