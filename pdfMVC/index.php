<?php
require 'controller/class.php';
session_start();
//datos de la URL
$uid = isset($_GET['uid']) ? $_GET['uid'] : '0000X000';
$token = isset($_GET['token']) ? $_GET['token'] : 'RETURN';
$result = "";

   IF(!$uid){
         require 'view/error.php';

   }
   else{
      require 'view/solicitud.php'; 
   }


?>