<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $NoBoleta = $_POST['NoBoleta'];
        $CURP = $_POST['CURP'];
        $NombrePDF = './PDF/'.$NoBoleta.$CURP.'ExamenSimulacro.pdf';

        if (file_exists($NombrePDF))
        {
            /* header('Location: '.$NombrePDF); */
            echo $NombrePDF;
        } else {
            echo "1";
        }
    }
?>