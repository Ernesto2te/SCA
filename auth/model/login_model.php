<?php
require_once "../../assets/librerias/conexion.php";

class login extends Conexion
{
    function iniciarSesion($email, $password)
    {
        try {
            // Preparar la consulta SQL para obtener los datos del maestro
            $query = "SELECT CorreoRol, ContraseñaRol, NombreMa, a_paternoJM, a_maternoJM
                      FROM maestros
                      WHERE CorreoRol = :email";

            $con = parent::Conectar();
            $stmt = $con->prepare($query);

            // Asignar los valores a los parámetros de la consulta
            $stmt->bindParam(':email', $email);

            // Ejecutar la consulta
            $stmt->execute();

            // Verificar si se encontró un usuario con ese correo
            if ($stmt->rowCount() > 0) {
                // Obtener los datos del usuario
                $data = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verificar la contraseña
                if (password_verify($password, $data['ContraseñaRol'])) {
                    // Las credenciales son válidas
                    // Iniciar sesión y almacenar la información en variables de sesión
                    session_start();
                    $_SESSION['email'] = $email;
                    $_SESSION['nombre'] = $data['NombreMa'] . ' ' . $data['a_paternoJM'] . ' ' . $data['a_maternoJM'];

                    return $data;
                } else {
                    // La contraseña no coincide
                    return json_encode(['error' => 'Credenciales inválidas']);
                }
            } else {
                // No se encontró un usuario con ese correo
                return json_encode(['error' => 'Correo no encontrado']);
            }
        } catch (PDOException $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}



//Comprobar que inicie sesion

// ];

// echo json_encode($response);
?>