<?php
    include './conexion.php';

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Aciertos = $_POST["aciertos"];
        $NoBoleta = $_POST["NoBoleta"];


        //obtiene id examen
        $sp_examenid = "ObtenerExamenId";
        $stmt = $conexion->prepare("CALL $sp_examenid(?, @idExamen)");
        $stmt->bind_param("i", $NoBoleta);
        $stmt->execute();

        if (!$stmt){
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        $stmt->close();

        $result = $conexion->query("SELECT @idExamen AS idExamen");
        $row = $result->fetch_assoc();
        $idExamen = $row["idExamen"];

        $consulta = "SELECT resultFisicaSecc FROM examen WHERE idExamen = ?";
        $stmt2 = $conexion->prepare($consulta);
        $stmt2->bind_param("s", $idExamen);
        $stmt2->execute();

        if (!$stmt2){
            die("Error al ejecutar la consulta: " . $conexion->error);
        }

        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();
        $resultFisicaSecc = $row2["resultFisicaSecc"];

        $stmt2->close();

        if (is_null($resultFisicaSecc)) {
            $sql_update = "UPDATE examen SET resultFisicaSecc = ? WHERE idExamen = ?";
            $stmt3 = $conexion->prepare($sql_update);
            $stmt3->bind_param("ss", $Aciertos, $idExamen);
            $stmt3->execute();

            if (!$stmt3) {
                echo "2";
            } else {
                $Examen = "./presentarExamen.php";
                echo $Examen;
            }
            
            $stmt3->close();

            /* $Examen = "./presentarExamen.php";

            echo $Examen; */
        }else{
            echo "1";
        }

        $conexion->close();
    }
?>