<?php
session_start();

// Limpiar variables de sesión específicas si es necesario
unset($_SESSION['idAdmin']);
unset($_SESSION['usuario']);

// Destruir completamente la sesión
session_destroy();

// Redirigir a la página de inicio de sesión u otra página
header("Location: ../index.html");
exit();
?>