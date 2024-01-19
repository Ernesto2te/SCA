<?php
require_once "../../assets/librerias/conexion.php";
require_once "../../auth/model/login_model.php";


class ModeloMasiva extends conexion
{
    
    function InsertarMasiva($apellidoP, $apellidoM, $NombreA, $matricula, $curp, $domicilio, $fechain, $estadoAlumno, $grupo)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $email = $_SESSION['email'];
        $pdo = parent::Conectar();
        $pdo->beginTransaction();
        
        try {
            // Validar si la matrícula ya existe
            $consulta = "SELECT COUNT(*) AS total FROM alumnos WHERE matricula = :matricula";
            $sql = $pdo->prepare($consulta);
            $sql->bindParam(':matricula', $matricula);
            $sql->execute();
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $total = $row['total'];
    
            if ($total > 0) {
                // La matrícula ya existe, lanzar una excepción
                throw new Exception("El alumno con la matrícula $matricula ya existe en la base de datos.");
            } else {
                    // Convertir el número serial de Excel a una fecha de PHP
        $baseDate = DateTime::createFromFormat('Y-m-d', '1899-12-30'); // Fecha base de Excel
        $fechaDateTime = $baseDate->add(new DateInterval('P' . intval($fechain) . 'D'));
        if ($fechaDateTime) {
            $fechaFormateada = $fechaDateTime->format('Y-m-d');
        } else {
            throw new Exception("Formato de fecha inválido: $fechain");
        }
    
                // Obtener el id del grupo basado en el nombre del grupo
                $consultaGrupo = "SELECT id_grupo FROM grupos WHERE Grupo = :grupo";
                $sqlGrupo = $pdo->prepare($consultaGrupo);
                $sqlGrupo->bindParam(':grupo', $grupo);
                $sqlGrupo->execute();
                $grupo = $sqlGrupo->fetch(PDO::FETCH_ASSOC);
                $idGrupo = $grupo['id_grupo'];
    
                // Insertar el nuevo alumno
                $sql = "INSERT INTO alumnos (a_paternoA, a_maternoA, Nombres, matricula, Curp, Domicilio, fechaingreso, estadoAlumno, id_grupo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $query = $pdo->prepare($sql);
                $query->execute([$apellidoP, $apellidoM, $NombreA, $matricula, $curp, $domicilio, $fechaFormateada, $estadoAlumno, $idGrupo]);
    
                $pdo->commit();
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = "Error: " . $e->getMessage();
        }
    
        if (!empty($errors)) {
            $errorMessage = implode("\n- ", $errors);
            echo "Error:\n--- " . $errorMessage;
        }
    }
    
    
}
    //Esto es para agregar datos desde la consola
    // $z= new ModeloMasiva();
    // $z->InsertarMasiva("AURELIO", "PADILLA", "TOMAS", "13VC0119");
    // var_dump($z);

?>