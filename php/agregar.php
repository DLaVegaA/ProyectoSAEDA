<?php include_once("./conexion.php");


    $noBoleta = $_POST['txtNoboleta'];
    $nombre = $_POST['txtNombre'];
    $apellidoPaterno = $_POST['txtApPat'];
    $apellidoMaterno = $_POST['txtApMat'];
    $curp = $_POST['txtCurp'];
    $fechaNacimiento = $_POST['dateFecha'];
    $genero = $_POST['generoRadio'];
   // $discapacidad = isset($_POST['discapacidadRadio']) ? $_POST['discapacidadRadio'] : '';
   $discapacidad = $_POST['discapacidadRadio'];
   
    if ($discapacidad != 'Discapacidad auditiva' && $discapacidad !='Discapacidad motriz usuaria de silla de ruedas' && $discapacidad !='Discapacidad motriz usuaria de muletas' && $discapacidad !='Discapacidad motriz usuaria de bastón' && $discapacidad != 'Ninguna') {
        $discapacidad = $_POST['discapacidad'];
    }
    
    $calle = $_POST['txtcall'];
    $numeroC = $_POST['txtnumc'];
    $entidadFederativa = $_POST['EntidadFederativa'];
    $munAl = $_POST['MunAl'];
    $codigoPostal = $_POST['txtcodpos'];
    $telefono = $_POST['txttel'];
    $correo = $_POST['txtcor'];
    

    $escuelaProcedencia = $_POST['EscP'];
    if ($escuelaProcedencia==='Otros') {
     $escuelaProcedencia=$_POST['NomEsc'];
    }
 

    
   
    //$nombreEscuela = $_POST['NomEsc']; 
    $promedio = $_POST['txtprom'];
    $escomOpcion = $_POST['txtescomop'];

    $sp_salon = 'ObtenerPrimerSalon';
    $stmt = $conexion->prepare("CALL $sp_salon(@salonId)");
    $stmt->execute();

    // Verificar si se ejecutó correctamente
    if (!$stmt) {
        die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
    }

    // Obtener el ID del salón después de llamar al procedimiento
    $result = $conexion->query("SELECT @salonId AS salonId");
    $salonRow = $result->fetch_assoc();
    $salonId = $salonRow['salonId'];
    
    $sqlAlumno = "INSERT INTO Alumno (NoBoleta,idSalon , Nombre, ApellidoPaterno, ApellidoMaterno, CURP, FechaNacimiento, Genero, Discapacidad, Calle, numeroC, EntidadFederativa, MunicipioAlcaldia, CodigoPostal, Telefono, Correo, EscuelaProcedencia, Promedio, ESCOM_Opcion) 
    VALUES ('$noBoleta', '$salonId' , '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$curp', '$fechaNacimiento', '$genero', '$discapacidad', '$calle', '$numeroC', '$entidadFederativa', '$munAl', '$codigoPostal', '$telefono', '$correo', '$escuelaProcedencia', '$promedio', '$escomOpcion')";

if ($conexion->query($sqlAlumno) !== TRUE) {
    die("Error al insertar datos del alumno: " . $conexion->error);
}


    header("Location: ../CRUDadmin.php");
?>