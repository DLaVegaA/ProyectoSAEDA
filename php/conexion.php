<?php
    $conexion = mysqli_connect("localhost","root","","bdsaeda");
    $consulta = "SELECT * FROM alumno";
    $resultado = mysqli_query($conexion,$consulta);
?>