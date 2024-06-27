<?php
    session_start();
    include 'conexion.php';

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $noBoleta = $_SESSION['NoBoleta'];
    $realizoExamen = 1;

    $sql = "UPDATE alumno SET RealizoExamen = ? WHERE NoBoleta = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $realizoExamen, $noBoleta);
    $stmt->execute();
    $stmt->close();
    $conexion->close();
    
    unset($_SESSION['NoBoleta']);

    // Destruir completamente la sesión
    session_destroy();

    // Redirigir a la página de inicio de sesión u otra página
    header("Location: ../index.html");
    exit();
?>