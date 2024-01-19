<?php
session_start();

// Verificar si el usuario no está autenticado
if (!isset($_SESSION['email'])) {
  // Redirigir a la página de inicio de sesión
  header("Location: login.php");
  exit();
}
?>