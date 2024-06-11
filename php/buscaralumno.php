<?php
include_once("./conexion.php");



session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['idAdmin'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.html");
    exit();
}


    $buscar = $_POST['txtbuscar'];

    $queryusuarios = mysqli_query($conexion, "SELECT NoBoleta,Nombre,ApellidoPaterno,ApellidoMaterno,CURP FROM Alumno WHERE NoBoleta LIKE '".$buscar."%'");

    $numerofila = 0;

    while ($mostrar = mysqli_fetch_array($queryusuarios)) {
        $numerofila++;
        echo "<tr>";
        echo "<td>".$numerofila."</td>";
        echo "<td>".$mostrar['NoBoleta']."</td>";
        echo "<td>".$mostrar['Nombre']."</td>";
        echo "<td>".$mostrar['ApellidoPaterno']."</td>";    
        echo "<td>".$mostrar['ApellidoMaterno']."</td>";  
        echo "<td>".$mostrar['CURP']."</td>";
        echo "<td style='width:26%'><a href=\"./php/ver.php?NoBoleta=$mostrar[NoBoleta]\" class='btn btn-info'>Revisar</a>  <a href=\"./php/editar.php?NoBoleta=$mostrar[NoBoleta]\" class='btn btn-primary'>Modificar</a>  <a href=\"./php/eliminar.php?NoBoleta=$mostrar[NoBoleta]\" onClick=\"return confirm('¿Estás seguro de eliminar a $mostrar[Nombre]?')\" class='btn btn-danger'>Eliminar</a></td>";    
}

?>
