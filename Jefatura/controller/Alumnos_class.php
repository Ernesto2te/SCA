<?php
require_once "../model/Alumnos_model.php";

class Alumnos 
{ 
    private $AlumnosM;
    
    function __construct (){
        $this->AlumnosM = new AlumnosModel();
    }

    function tablaAlumnoClass(){ 
        $convert = $this->AlumnosM->TablaAlumos();
        return $convert;
    }  

    function guardarAlumnoClass($NombreAlumno, $MatriculaAlumno, $aPaterno, $aMaterno, $Grupo){
        $this->AlumnosM->registrarAlumnoM($NombreAlumno, $MatriculaAlumno, $aPaterno, $aMaterno, $Grupo);
    }   



    function editarAlumno($MatriculaAlumno, $NombreAlumno,  $aPaterno, $aMaterno, $Grupo, $clave) {
        $actualizacionExitosa = $this->AlumnosM->editar_Alumnos($MatriculaAlumno, $NombreAlumno,  $aPaterno, $aMaterno, $Grupo, $clave);

        if ($actualizacionExitosa) {
            echo "Alumno editado exitosamente.";
        } else {
            echo "Clave duplicada o error al editar el alumno.";
        }
    }
    
}
?>
