<?php 

require 'model/pdf.model.php';
class GenerateDocument{


 private $uid;
 private $token;

  public function __construct(string $uid,string $token) {
      $this->uid = $uid;
      $this->token = $token;
  }

 


 public function getInfo()
 {$model_pdf= new modelopdf();
   $resp = [];
   $data =$model_pdf-> infoalumnoM($this->uid);
   
   $resp =  [
     'nombre' => $data['Nombres'] . ' ' . $data['a_paternoA'] . ' ' . $data['a_maternoA'],
     'CURP' => $data['Curp'],
     'matricula' => $data['matricula'],
     'domicilio' => $data['Domicilio'],
     'tutor' => $data['NombreTutor'] . ' ' . $data['a_paternoT'] . ' ' . $data['a_maternoT'],
     'fechaIngre' => $data['fechaingreso'],
     'estatus' => $data['estadoAlumno'],
   ];
   
   return $resp;
 }

 
 public function getmaterias()
 {$model_pdf= new modelopdf();
   $data =$model_pdf-> infoalumnoMaterias($this->uid,$this->token);
   

   
   return $data;
 }

}



?>