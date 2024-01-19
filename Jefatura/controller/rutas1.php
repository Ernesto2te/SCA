<?php
require_once ("classboleta.php");
$matricula="";

$accion = "";
$array="";
$data="";
//////// assigning values to variables/////////////

if (!empty($_POST['matricula'])) {
    $matricula = $_POST['matricula'];
}

if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
} else {
    header('Location: ../../');
    session_destroy();
}



$boleta = new Boleta($matricula);

switch ($accion) {


   case 'GURLSI':
    echo json_encode( [
        'status' => true,
        // CUANDO SE HACEN PRUEBAS EN EL LOCALHOST
        'url' => "https://".$_SERVER['SERVER_NAME']."/SCA/pdfMVC/?uid=".$matricula,

        // CUANDO SE MONTA EN EL SERVIDOR WEB 
        //'url' => "https://".$_SERVER['SERVER_NAME']."/pdfMVC/?uid=".$matricula,
    ]);
        break;
    case 'GETcargas':
        echo ($boleta->GETcargas());
    break;
}
?>