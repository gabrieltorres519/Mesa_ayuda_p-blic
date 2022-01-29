<?php
    require_once(realpath(dirname(__FILE__) . "/../../config/conexion.php")); //llamando la cadena de conexión
    session_destroy(); // Se destruye la sesión de usuario
    header("Location:".Conectar::ruta()."view/index.php"); // Enviar al login
    exit();
?>