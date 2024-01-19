<?php 

require_once "../assets/librerias/conexion.php";
class modelopdf extends  Conexion {
      
    function infoalumnoM($matricula){
        $conn = parent::Conectar();
  
        $sql = "SELECT alumnos.*,tutores.NombreTutor,tutores.a_paternoT,tutores.a_maternoT FROM alumnos 
        INNER JOIN tutores on tutores.id_alumno=alumnos.id_alumno
         WHERE alumnos.matricula =?";
        $stmt1 = $conn->prepare($sql);
        $stmt1->execute([$matricula]);
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
  
        return $result;
      }

      function infoalumnoMaterias($matricula,$periodo){
        $conn = parent::Conectar();
  

                //obtener las asignaturas asignadas a la carga
        $materias = " SELECT materias.NombreMat , boletas.* FROM boletas 
        INNER JOIN materias_impartidas on materias_impartidas.id_materiaImpartida=boletas.id_materiaImpartida 
        INNER JOIN materias on materias.id_materia = materias_impartidas.id_materia
        INNER JOIN alumnos on alumnos.id_alumno=boletas.id_alumno 
        INNER JOIN periodo on periodo.id_periodo=materias_impartidas.id_periodo 
        WHERE alumnos.matricula=?
        and periodo.nombrePeriodo=? ORDER by boletas.semestre;
        ";
        $stmt = $conn->prepare($materias);
        $stmt->execute([$matricula,$periodo]);
        $data_materias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $mat_asignadas = [];

        foreach($data_materias as $materia)
        {
        array_push($mat_asignadas,
        [
            'nombremateria' => $materia['NombreMat'],
            'semestre' => $materia['semestre'],
            'Faltas_P1' => $materia['Faltas_P1'],
            'Faltas_P2' => $materia['Faltas_P2'],
            'Faltas_P3' => $materia['Faltas_P3'],
            'Faltas_FINAL' => $materia['Faltas_FINAL'],
            'CALI_P1' => $materia['CALI_P1'],
            'CALI_P2' => $materia['CALI_P2'],
            'CALI_P3' => $materia['CALI_P3'],
            'CALI_FINAL' => $materia['CALI_FINAL'],
        ],

        );

        }
        $data = [
            'materias' => $mat_asignadas
            ];
        return $data;
      }
  
    
}
?>
