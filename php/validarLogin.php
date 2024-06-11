<?php
    session_start();
    include './conexion.php';

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $Usuario = trim($_POST['usuario']);
        $Contra = trim($_POST['contraseña']);

        $consulta = "SELECT idAdmin, usuario, contraseña FROM administrador WHERE usuario = ? LIMIT 1";
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param('s', $Usuario);
        $stmt->execute();
        $stmt->bind_result($idAdmin, $Usuario_db, $Contra_db);
        $stmt->fetch();
        $stmt->close();

        if ($Contra == $Contra_db && $Usuario==$Usuario_db)
        {
            $_SESSION['idAdmin'] = $idAdmin;
            $_SESSION['usuario'] = $Usuario;
            $CRUD = "./CRUDadmin.php";
            echo $CRUD;
        } else {
            echo "1";
        }

        $conexion->close();
    }
?>