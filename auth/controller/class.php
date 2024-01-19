<?php
require_once "../model/login_model.php";

class Authentication {
    private $auth;
    private $key;

    public function __construct(string $auth, string $key) {
        $this->auth = $auth;
        $this->key = $key;
    }

    public function login() {
        $resp = array();
        date_default_timezone_set('America/Mexico_City');
        $time = date('d/m/y h:i:s');
        $times = strtotime('+30 minutes', strtotime($time));

        $loginModel = new login(); // Crear instancia de la clase login
        $data = $loginModel->iniciarSesion($this->auth, $this->key); // Llamar a la función iniciarSesion()

        if (empty($data)) {
            $resp = array(
                "found" => false,
                "msg" => "Correo incorrecto y/o contraseña incorrecta"
            );
        } else {
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $token = substr(str_shuffle($permitted_chars), 0, 10);

            $resp = array(
                "found" => true,
                "NombreMa" => $data["NombreMa"],
                "a_paternoJM" => $data["a_paternoJM"],
                "a_maternoJM" => $data["a_maternoJM"],
                "msg" => "Inicio de sesión exitoso",
                "key" => $token
            );
        }

        return $resp;
    }
}



// $authenticator = new Authentication('alimentarias@itsvc.edu.mx', 'IIAL1234');
// $result = $authenticator->login();
// print_r($result);

?>
