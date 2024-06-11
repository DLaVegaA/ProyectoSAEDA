<?php
include_once("./conexion.php");

    session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['idAdmin'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.html");
    exit();
}
    $noBoleta = $_GET['NoBoleta'];
 
    mysqli_query($conexion, "DELETE FROM Alumno WHERE NoBoleta='$noBoleta'");
    header("Location: ../CRUDadmin.php");

?>