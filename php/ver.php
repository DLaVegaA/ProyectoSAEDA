<?php
include_once("conexion.php");

session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['idAdmin'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.html");
    exit();
}
$NoBoleta= $_GET['NoBoleta'];

$querybuscar = mysqli_query($conexion, "SELECT * FROM Alumno WHERE NoBoleta='$NoBoleta'");

?>


<html>
<head>
    <title>Revisar Alumno</title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
       
        <style>

            a,input[type="submit"],button
            {
	            font-size: 14px;
	            text-align:center;
	            width: 100px;
	            display: inline-block;
	            background-color:rgb(57, 123, 190);
	            padding: 6px 10px;
	            border-radius:5px;
	            text-decoration: none;
	            color:white;
	            border:1px solid black;
	            cursor:pointer;
            }
        </style>
</head>
<body>
<?php
if ($mostrar = mysqli_fetch_array($querybuscar, MYSQLI_ASSOC)) {
    echo '<div class="table-responsive">';
    echo '<table class="table table-bordered">';
    echo '<tr><th style="background-color: rgb(57, 123, 190);color:white"   colspan="4">Datos del Alumno</th></tr>';
    
    // Iterar sobre las columnas y valores
    foreach ($mostrar as $campo => $valor) {
        if (!is_numeric($campo)) {
            echo "<tr><td>$campo</td><td>$valor</td></tr>";
        }

    }
    echo '<tr>';
				
               echo '<td colspan="2">';
				echo '<a href="../CRUDadmin.php">Cancelar</a>';
				echo '</td>';
            echo '</tr>';
    echo '</table>';
} else {
    echo 'No se encontraron resultados para la boleta ' . $NoBoleta;
}
?>

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</body>
  
</html>