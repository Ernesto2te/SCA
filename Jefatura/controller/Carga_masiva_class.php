<?php

require "../model/Carga_masiva_model.php";


class CargaMasiva
{

    
    private $GUardarMasiva;

    function __construct()
    {
        
        $this->GUardarMasiva = new ModeloMasiva();

        
    }

    function Insertar_Carga_Masiva($apellidoP, $apellidoM, $NombreA, $matricula, $curp, $domicilio, $fechain, $estadoAlumno, $grupo)
    {
        $alm = $this->GUardarMasiva->InsertarMasiva($apellidoP, $apellidoM, $NombreA, $matricula, $curp, $domicilio, $fechain, $estadoAlumno, $grupo);
        return $alm;
    }
}
?>