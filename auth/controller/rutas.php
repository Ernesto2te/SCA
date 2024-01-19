<?php
require_once '../controller/class.php';
$auth = "";
$key = "";
$accion = "";

if (!empty($_POST['auth'])) {
    $auth = $_POST['auth'];
}
if (!empty($_POST['key'])) {
    $key = $_POST['key'];
}
if (!empty($_POST['accion'])) {
    $accion = $_POST['accion'];
}

switch ($accion) {
    case 'AUTH':
        $c = new Authentication($auth, $key);
        echo (json_encode($c->login()));

        break;
}


?>