<?php
require_once "../model/periodo_model.php";
class periodo 
{ 
     private $PeriodoM;
     
    function __construct (){
        $this->PeriodoM= new periodoModel();
    }

    function tablaPeriodo(){ 
       
        $convert=$this->PeriodoM->periodo();
       return($convert);  //linea 14 //liinea 14
    }  

    // function periodoActivo(){ 
       
    //     $convert=$this->PeriodoM->periodoActivo();
    //     echo ($convert);
    // }  


    function guardarCiclo($nombreP, $StatusC ){
        $this->PeriodoM->registrarCicloM($nombreP, $StatusC);
    } 

    
}   


//Esto es para agregar datos desde la consola
// $z= new periodo();
// $z->registrarPeriodo("Diciembre-2022");
// var_dump($z); 

// $z= new periodo();
// $z->tablaPeriodo();
// var_dump($z);


?>