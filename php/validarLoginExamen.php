<?php
    session_start();
    include './conexion.php';

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $Uboleta = trim($_POST['NoBoleta']);
        $Ccurp = trim($_POST['CURP']);

        $consulta = "SELECT NoBoleta, CURP FROM alumno WHERE NoBoleta = ? LIMIT 1";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param('s', $Uboleta);
        $stmt->execute();
        $stmt->bind_result($NoBoleta_bd, $CURP_bd);
        $stmt->fetch();
        $stmt->close();

        if ($Ccurp == $CURP_bd && $Uboleta == $NoBoleta_bd)
        {
            $_SESSION['NoBoleta'] = $NoBoleta_bd;
            /* $_SESSION['usuario'] = $Usuario; */
            $Examen = "./presentarExamen.php";
            echo $Examen;
        } else {
            echo "1";
        }

        $conexion->close();
    }
?>