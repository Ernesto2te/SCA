<?php
require_once "../model/Profesores_model.php";

class Profesores
{ 
     private $ProfesM;
     
    function __construct (){
        $this->ProfesM= new ProfesModel();
    }

    function tablaProfesT(){ 
       
        $convert=$this->ProfesM->Profes();
       return($convert);  //linea 14 //liinea 14
    }  

    function guardarProfeClass($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro){
        $this->ProfesM->registrarProfeM($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro);
    } 
 

    function editarProfesor($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro, $clave) {
        // Imprimir los valores recibidos para depuración
        echo "Nombre Maestro: " . $NombreMaestro . "\n";
        echo "Apellido Paterno: " . $ApaternoMaestro . "\n";
        echo "Apellido Materno: " . $AmaternoMaestro . "\n";
        echo "Clave Maestro: " . $ClaveMaestro . "\n";
        echo "Clave Original: " . $clave . "\n";
    
        // Llamada a la función del modelo
        $resultado = $this->ProfesM->editar_profesor($NombreMaestro, $ApaternoMaestro, $AmaternoMaestro, $ClaveMaestro, $clave);
        if (isset($resultado['error'])) {
            // Manejar el error
            echo $resultado['error'];
        } else {
            // Confirmar éxito
            echo $resultado['success'];
        }
    }

    function BuscarProf()
    {

        $alm =  $this->ProfesM->obtenerProfesores();
        // $json = json_encode($alm);
        // echo ($json);

       
        return  $alm;
        
    }


    function guardarRolClass($Id_Maestro, $Correo, $Contraseña){
        $this->ProfesM->guardarRolM($Id_Maestro, $Correo, $Contraseña);
    } 
}
?>