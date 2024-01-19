<?php 
class Conexion{
    protected $dbh;
    
    public function Conectar(){       
        try {
            $conectar = $this->dbh = new PDO("mysql:host=localhost;dbname=sca_1", "root", "", );
            return $conectar;
        } catch (PDOException $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();	
        }
    }

      
}

?>
