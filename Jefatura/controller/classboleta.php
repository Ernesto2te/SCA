<?php

class Boleta
{
  private $matricula;

  public function __construct($matricula)
  {
    $this->matricula = $matricula;
  }

  public function GETcargas(){
    require_once("../model/modelcarga_boleta.php");

    $cargamodel =new carga();
    $resultado = $cargamodel-> getcargamodel($this->matricula);
    echo $resultado;
}

  
}
?>