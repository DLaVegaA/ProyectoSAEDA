<?php 
include_once("./conexion.php");

$queryusuarios = mysqli_query($conexion, "SELECT * FROM salon ORDER BY idsalon asc");

?>