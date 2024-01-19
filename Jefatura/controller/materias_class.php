<?php
require_once "../model/Materias_model.php";
class Materias 
{ 
     private $MateriasM;
     
    function __construct (){
        $this->MateriasM= new MateriasModel();
    }

    function tablaMateria(){ 
       
        $convert=$this->MateriasM->Materias();
       return($convert);  //linea 14 //liinea 14
    }  

    // function periodoActivo(){ 
       
    //     $convert=$this->PeriodoM->periodoActivo();
    //     echo ($convert);
    // }  


    function guardarMatClass($NombreMaterias, $ClaveMaterias){
        $this->MateriasM->registrarMatM($NombreMaterias, $ClaveMaterias);
    } 
 

    function editarMateria($NombreMaterias, $ClaveMaterias, $clave) {
        $actualizacionExitosa = $this->MateriasM->editar_Materia($NombreMaterias, $ClaveMaterias, $clave);
      
        if ($actualizacionExitosa) {
            echo "Materia editada exitosamente.";
        } else {
            echo "Clave duplicada o error al editar la materia.";
        }
    }
    
    
}   
