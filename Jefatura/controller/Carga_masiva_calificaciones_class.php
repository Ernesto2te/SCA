<?php
//AQUI VA EL MODELO
require "../model/carga_calificaciones_model.php";


class CargaMasivaCali
{

    private $PeriodoME;
    private $nombre_materiaE;
    private $Doncentes_AEE;
    private $GUardarAsignacion;

    function __construct( $Doncentes_AEE = null, $nombre_materiaE = null)
    {

        $this->PeriodoME = new ModeloAsigC();
        $this->nombre_materiaE =  $nombre_materiaE;
        $this->Doncentes_AEE =  $Doncentes_AEE;
        $this->GUardarAsignacion = new ModeloAsigC();
      

        // $this->Aestudiante= new ModeloAsig();
    }
    function BuscarMat($nombre_DA)
    {
        $x = new ModeloAsigC();
        $alm = $x->buscarMaterias($nombre_DA);
    
        echo ($alm);
    }
    
    function BuscarMatDC($nombre_DA)
    {
        $x = new ModeloAsigC();
        $alm = $x->buscarMateriasDC($nombre_DA);
    
        echo ($alm);
    }
    


    function BuscarDocente() {
        $x = new ModeloAsigC();
        return $x->buscarDocente();
    }

    function BuscarDocenteDC() {
        $x = new ModeloAsigC();
        return $x->buscarDocenteDC();
    }


    function BuscarPeri()
    {


        $alm = $this->PeriodoME->buscarPeriodo();
        // $json = json_encode($alm);
        // echo ($json);
        return  $alm;
    }

    function BuscarPeriDC()
    {


        $alm = $this->PeriodoME->buscarPeriodoDC();
        // $json = json_encode($alm);
        // echo ($json);
        return  $alm;
    }

    function Insertar_Asig_EstudianteC($matricula, $semestre, $faltaP1,$faltaP2, $faltaP3, $faltaFinal, $caliP1, $caliP2, $caliP3, $caliFinal, $Nombre_Periodo, $docente1, $materia, $grupo) {
        // Depuración: Imprimir los parámetros recibidos
    
        // Continuar con la ejecución normal de la función
        $alm = $this->GUardarAsignacion->InsertarAsignacionEstudianteM(
            $matricula, $semestre, $faltaP1, $faltaP2, $faltaP3, $faltaFinal,
            $caliP1, $caliP2, $caliP3, $caliFinal, $Nombre_Periodo, $docente1, $materia, $grupo
        );
        echo ($alm);
    }


    function guardarMATDOCClass($Nombre_Periodo, $docente, $materia, $grupo) {
        // Depuración: Imprimir los parámetros recibidos
    //    echo ( $Nombre_Periodo);
    //     var_dump("docente:", $docente);
    //     var_dump("materia:", $materia);
    //     var_dump("grupo:", $grupo);
    //     flush();
        // Continuar con la ejecución normal de la función
        $alm = $this->GUardarAsignacion->guardarMATDOCCClass($Nombre_Periodo, $docente, $materia, $grupo);
        echo ($alm);
    }
    
    
}

?>