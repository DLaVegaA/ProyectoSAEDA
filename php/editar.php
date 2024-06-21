<?php
include_once("./conexion.php");

session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['idAdmin'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.html");
    exit();
}

//include_once("cargaralumnos.php");
$escuelas = array(
    'CECyT 1 González Vázquez Vega',
    'CECyT 2 Miguel Bernard',
    'CECyT 3 Estanislao Ramírez Ruiz',
    'CECyT 4 Lázaro Cárdenas',
    'CECyT 5 Benito Juárez García',
    'CECyT 6 Miguel Othón de Mendizábal',
    'CECyT 7 Cuauhtémoc',
    'CECyT 8 Narciso Bassols García',
    'CECyT 9 Juan de Dios Bátiz',
    'CECyT 10 Carlos Vallejo Márquez',
    'CECyT 11 Wilfrido Massieu Pérez',
    'CECyT 12 José María Morelos y Pavón',
    'CECyT 13 Ricardo Flores Magón',
    'CECyT 14 Luis Enrique Erro',
    'CECyT 15 Diódoro Antúnez Echegaray',
    'CECYT 16 Hidalgo',
    'CECYT 17 León, Guanajuato',
    'CECYT 18 Zacatecas',
    'CECyT 19 Leona Vicario',
    'CET 1 Walter Cross Buchanan'
);



$NoBoleta= $_GET['NoBoleta'];

$querybuscar = mysqli_query($conexion, "SELECT * FROM Alumno WHERE NoBoleta='$NoBoleta'");

while($mostrar = mysqli_fetch_array($querybuscar))
{
    $noBoleta = $mostrar['NoBoleta'];
    $nombre = $mostrar['Nombre'];
    $apellidoPaterno = $mostrar['ApellidoPaterno'];
    $apellidoMaterno = $mostrar['ApellidoMaterno'];
    $curp = $mostrar['CURP'];
    $fechaNacimiento = $mostrar['FechaNacimiento'];
    $genero = $mostrar['Genero'];
    $discapacidad = $mostrar['Discapacidad'];

    //Obterer datos de contacto
    $calle = $mostrar['Calle'];
    $numeroC = $mostrar['NumeroC'];
    $entidadFederativa = $mostrar['EntidadFederativa'];
    $munAl = $mostrar['MunicipioAlcaldia'];
    $codigoPostal = $mostrar['CodigoPostal'];
    $telefono = $mostrar['Telefono'];
    $correo = $mostrar['Correo'];
    
    //Obterer datos de procedencia
    $escuelaProcedencia = $mostrar['EscuelaProcedencia'];
    //$nombreEscuela = $mostrar['NombreEscuela']; 
    $promedio = $mostrar['Promedio'];
    $escomOpcion = $mostrar['ESCOM_Opcion'];
}

?>
<html>
<head>
    <title>Modificar Alumno</title>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="../js/ProyectoJs.js"></script>
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            habilitarNomEsc();
        });
    </script>
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
            tr {
                min-height: 10px; /* o cualquier valor adecuado */
            }   
            
    input[type="text"].form-control.inputContacto {
        width: 400px; /* O el ancho que desees */
    }


        </style>
</head>
<body>
<div class="table-responsive" id="formmodificar">
    <form method="POST" >
        <table class="table">
        <tr><th style="background-color: rgb(57, 123, 190);color:white"   colspan="4">Modificar Alumno</th></tr>
		     <tr> 
                <td>Número de Boleta </td>
                <td><input type="text" name="txtNoboleta" value="<?php echo $noBoleta;?>" required ></td>
            </tr>
            <tr> 
                <td>Nombre</td>
                <td><input type="text" name="txtNombre" value="<?php echo $nombre;?>" required></td>
            </tr>
            <tr> 
                <td>Apellido Paterno</td>
                <td><input type="text" name="txtApPat" value="<?php echo $apellidoPaterno;?>" required></td>
            </tr>
            <tr> 
                <td>Apellido Materno</td>
                <td><input type="text" name="txtApMat" value="<?php echo $apellidoMaterno;?>"required></td>
            </tr>
            <tr> 
                <td>Curp</td>
                <td><input type="text" name="txtCurp" value="<?php echo $curp;?>"required></td>
            </tr>
            <tr> 
                <td>Fecha Nacimiento</td>
                <td><input type="date" name="dateFecha" value="<?php echo $fechaNacimiento ;?>"required></td>
            </tr>
            <tr>
                <td>Género:</td>
                <td>
                <fieldset class="row mb-3">
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="generoRadio" id="masculinoRadio" value="Masculino" <?php echo ($genero == 'Masculino') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="masculinoRadio">Masculino</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="generoRadio" id="femeninoRadio" value="Femenino" <?php echo ($genero == 'Femenino') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="femeninoRadio">Femenino</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="generoRadio" id="otroRadio" value="Otro" <?php echo ($genero == 'Otro') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="otroRadio">Otro</label>
                        </div>
                    </div>
                </fieldset>
            </td>
            </tr>

            <tr> 
                <td >Discapacidad</td>
                <td>
                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">A fin de considerar sus necesidades y atenderlas, requerimos saber si usted es una persona:</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="auditivaRadio" value="Discapacidad auditiva" <?php echo ($discapacidad == 'Discapacidad auditiva') ? 'checked' : ''; ?> onclick="habilitarDis();">
                                            <label class="form-check-label" for="auditivaRadio">
                                            Con discapacidad auditiva.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="sillaRuedasRadio" value="Discapacidad motriz usuaria de silla de ruedas" <?php echo ($discapacidad == 'Discapacidad motriz usuaria de silla de ruedas') ? 'checked' : ''; ?> onclick="habilitarDis();">
                                            <label class="form-check-label" for="SillaRuedasRadio">
                                            Con discapacidad motriz usuaria de silla de ruedas.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="muletasRadio" value="Discapacidad motriz usuaria de muletas" <?php echo ($discapacidad == 'Discapacidad motriz usuaria de muletas') ? 'checked' : ''; ?> onclick="habilitarDis();">
                                            <label class="form-check-label" for="muletasRadio">
                                            Con discapacidad motriz usuaria de muletas.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="bastonRadio" value="Discapacidad motriz usuaria de bastón" <?php echo ($discapacidad == 'Discapacidad motriz usuaria de bastón') ? 'checked' : ''; ?> onclick="habilitarDis();">
                                            <label class="form-check-label" for="bastonRadio">
                                            Con discapacidad motriz usuaria de bastón.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="otraRadio" value="Otra" <?php echo ($discapacidad != 'Discapacidad auditiva' && $discapacidad !='Discapacidad motriz usuaria de silla de ruedas' && $discapacidad !='Discapacidad motriz usuaria de muletas' && $discapacidad !='Discapacidad motriz usuaria de bastón' && $discapacidad != 'Ninguna') ? 'checked' : ''; ?> onclick="habilitarDis();">
                                            <label class="form-check-label" for="otraRadio">
                                            Otra.
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discapacidadRadio" id="ningunaRadio" value="Ninguna" <?php echo ($discapacidad == 'Ninguna') ? 'checked' : ''; ?> onclick="habilitarDis();" >
                                            <label class="form-check-label" for="ningunaRadio">
                                            Ninguna
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-floating mb-3">
                               <input type="text" name="discapacidad" id="floatingDiscapacidad" class="form-control" placeholder=" " <?php echo ($discapacidad != 'Discapacidad auditiva' && $discapacidad !='Discapacidad motriz usuaria de silla de ruedas' && $discapacidad !='Discapacidad motriz usuaria de muletas' && $discapacidad !='Discapacidad motriz usuaria de bastón' && $discapacidad != 'Ninguna') ? 'value="' . $discapacidad . '"' : 'disabled="disabled"'; ?>>
                                <label for="floatingDiscapacidad">Discapacidad:</label>

                                </div>
                            </fieldset>
                </td>
            </tr>
            <tr> 
                <td>Calle</td>
                <td><input type="text" name="txtcall" value="<?php echo $calle;?>"required></td>
            </tr>
            <tr> 
                <td>Número</td>
                <td><input type="text" name="txtnumc" value="<?php echo $numeroC;?>"required></td>
            </tr>
            <tr> 
                <td>Entidad Federativa</td>
                <td><input type="text" name="txtentf" value="<?php echo $entidadFederativa;?>"required></td>
            </tr>
            <tr> 
                <td>Municipio o Alcaldia </td>
                <td><input type="text" name="txtmunAl" value="<?php echo $munAl;?>"required></td>
            </tr>
            <tr> 
                <td>CódigoPostal</td>
                <td><input type="text" name="txtcodpos" value="<?php echo $codigoPostal;?>"required></td>
            </tr>
            <tr> 
                <td>Teléfono</td>
                <td><input type="text" name="txttel" value="<?php echo $telefono;?>"required></td>
            </tr>
            <tr> 
                <td>Correo</td>
                <td><input  style="width: 200px;" class="form-control inputContacto col-12"  type="text" name="txtcor" value="<?php echo $correo;?>"required></td>
            </tr>
            <tr> 
                <td>Escuela Procedencia</td>
                <td><select name="txtescpro" id="floatingEscP" class="form-control" onchange="habilitarNomEsc();">
                                        <option value="CECyT 1 González Vázquez Vega" <?php echo ($escuelaProcedencia == 'CECyT 1 González Vázquez Vega') ? 'selected' : ''; ?>>CECyT 1 "González Vázquez Vega"</option>
                                        <option value="CECyT 2 Miguel Bernard" <?php echo ($escuelaProcedencia == 'CECyT 2 Miguel Bernard') ? 'selected' : ''; ?>>CECyT 2 "Miguel Bernard"</option>
                                        <option value="CECyT 3 Estanislao Ramírez Ruiz" <?php echo ($escuelaProcedencia == 'CECyT 3 Estanislao Ramírez Ruiz') ? 'selected' : ''; ?>>CECyT 3 "Estanislao Ramírez Ruiz"</option>
                                        <option value="CECyT 4 Lázaro Cárdenas" <?php echo ($escuelaProcedencia == 'CECyT 4 Lázaro Cárdenas') ? 'selected' : ''; ?>>CECyT 4 "Lázaro Cárdenas"</option>
                                        <option value="CECyT 5 Benito Juárez García" <?php echo ($escuelaProcedencia == 'CECyT 5 Benito Juárez García') ? 'selected' : ''; ?>>CECyT 5 "Benito Juárez García"</option>
                                        <option value="CECyT 6 Miguel Othón de Mendizábal" <?php echo ($escuelaProcedencia == 'CECyT 6 Miguel Othón de Mendizábal') ? 'selected' : ''; ?>>CECyT 6 "Miguel Othón de Mendizábal"</option>
                                        <option value="CECyT 7 Cuauhtémoc" <?php echo ($escuelaProcedencia == 'CECyT 7 Cuauhtémoc') ? 'selected' : ''; ?> >CECyT 7 "Cuauhtémoc"</option>
                                        <option value="CECyT 8 Narciso Bassols García" <?php echo ($escuelaProcedencia == 'CECyT 8 Narciso Bassols García') ? 'selected' : ''; ?>>CECyT 8 "Narciso Bassols García"</option>
                                        <option value="CECyT 9 Juan de Dios Bátiz" <?php echo ($escuelaProcedencia == 'CECyT 9 Juan de Dios Bátiz') ? 'selected' : ''; ?>>CECyT 9 "Juan de Dios Bátiz"</option>
                                        <option value="CECyT 10 Carlos Vallejo Márquez" <?php echo ($escuelaProcedencia == 'CECyT 10 Carlos Vallejo Márquez') ? 'selected' : ''; ?>>CECyT 10 "Carlos Vallejo Márquez"</option>
                                        <option value="CECyT 11 Wilfrido Massieu Pérez" <?php echo ($escuelaProcedencia == 'CECyT 11 Wilfrido Massieu Pérez') ? 'selected' : ''; ?>>CECyT 11 "Wilfrido Massieu Pérez"</option>
                                        <option value="CECyT 12 José María Morelos y Pavón" <?php echo ($escuelaProcedencia == 'CECyT 12 José María Morelos y Pavón') ? 'selected' : ''; ?>>CECyT 12 "José María Morelos y Pavón"</option>
                                        <option value="CECyT 13 Ricardo Flores Magón" <?php echo ($escuelaProcedencia == 'CECyT 13 Ricardo Flores Magón') ? 'selected' : ''; ?>>CECyT 13 "Ricardo Flores Magón"</option>
                                        <option value="CECyT 14 Luis Enrique Erro" <?php echo ($escuelaProcedencia == 'CECyT 14 Luis Enrique Erro') ? 'selected' : ''; ?>>CECyT 14 "Luis Enrique Erro"</option>
                                        <option value="CECyT 15 Diódoro Antúnez Echegaray" <?php echo ($escuelaProcedencia == 'CECyT 15 Diódoro Antúnez Echegaray') ? 'selected' : ''; ?>>CECyT 15 "Diódoro Antúnez Echegaray"</option>
                                        <option value="CECYT 16 Hidalgo" <?php echo ($escuelaProcedencia == 'CECYT 16 Hidalgo') ? 'selected' : ''; ?>>CECYT 16 "Hidalgo"</option>
                                        <option value="CECYT 17 León, Guanajuato" <?php echo ($escuelaProcedencia == 'CECYT 17 León, Guanajuato') ? 'selected' : ''; ?>>CECYT 17 "León, Guanajuato"</option>
                                        <option value="CECYT 18 Zacatecas" <?php echo ($escuelaProcedencia == 'CECYT 18 Zacatecas') ? 'selected' : ''; ?>>CECYT 18 "Zacatecas"</option>
                                        <option value="CECyT 19 Leona Vicario" <?php echo ($escuelaProcedencia == 'CECyT 19 Leona Vicario') ? 'selected' : ''; ?>>CECyT 19 “Leona Vicario”</option>
                                        <option value="CET 1 Walter Cross Buchanan" <?php echo ($escuelaProcedencia == 'CET 1 Walter Cross Buchanan') ? 'selected' : ''; ?>>CET 1 “Walter Cross Buchanan”</option>
                                        <option value="Otros" <?php echo (!in_array($escuelaProcedencia, $escuelas)) ? 'selected' : ''; ?>>Otra escuela</option>
                                    </select></td>
            </tr>
            <tr> 
                <td>Nombre Escuela</td>
                <td><input type="text" name="txtnomesc" id="floatingNomEsc" class="form-control" placeholder=" " disabled value="<?php echo $escuelaProcedencia;?>"></td>
            </tr>
            <tr> 
                <td>Promedio</td>
                <td><input type="text" name="txtprom" value="<?php echo $promedio;?>"required></td>
            </tr>
            <tr> 
                <td>Escom Opción</td>
                <td><input type="text" name="txtescomop" value="<?php echo $escomOpcion;?>"required></td>
            </tr>
    
            <tr>
				
                <td colspan="2">
				<a href="../CRUDadmin.php">Cancelar</a>
				<input type="submit"  name="btnmodificar" value="Modificar" onClick="javascript: return confirm('¿Deseas modificar a este usuario?');">
				</td>
            </tr> 


        </table>




    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</body>
  
</html>

<?php
	
	if(isset($_POST['btnmodificar']))
{    
    $noBoleta1 = $_POST['txtNoboleta'];
	$nombre1= $_POST['txtNombre'];
    $apellidoPaterno1= $_POST['txtApPat'];
    $apellidoMaterno1=  $_POST['txtApMat'];
	$curp1= $_POST['txtCurp'];
    $fechaNacimiento1 = $_POST['dateFecha'];
    $genero1 =  $_POST['generoRadio'];
    $discapacidad1 = $_POST['discapacidadRadio'];
    if ($discapacidad1 != 'Discapacidad auditiva' && $discapacidad1 !='Discapacidad motriz usuaria de silla de ruedas' && $discapacidad1 !='Discapacidad motriz usuaria de muletas' && $discapacidad1 !='Discapacidad motriz usuaria de bastón' && $discapacidad1 != 'Ninguna') {
        $discapacidad1 = $_POST['discapacidad'];
    }
    $calle1 =  $_POST['txtcall'];

    $numeroC1 = $_POST['txtnumc'];
    $entidadFederativa1 = $_POST['txtentf'];
    $munAl1 = $_POST['txtmunAl'];
    $codigoPostal1 = $_POST['txtcodpos'];
    $telefono1 = $_POST['txttel'];
    $correo1 = $_POST['txtcor'];
    $escuelaProcedencia1 =$_POST['txtescpro'];
   if ($escuelaProcedencia1==='Otros') {
    $escuelaProcedencia1=$_POST['txtnomesc'];
   }


    
    //$nombreEscuela1 =$_POST['txtnomesc'];
    $promedio1 = $_POST['txtprom'];
    $escomOpcion1 = $_POST['txtescomop'];
   




    $querymodificar = mysqli_query($conexion, "UPDATE Alumno SET `NoBoleta`='$noBoleta1',`Nombre`='$nombre1',`ApellidoPaterno`='$apellidoPaterno1',`ApellidoMaterno`='$apellidoMaterno1',`CURP`='$curp1',`FechaNacimiento`='$fechaNacimiento1',`Genero`='$genero1',`Discapacidad`='$discapacidad1',`Calle`='$calle1',`NumeroC`='$numeroC1',`EntidadFederativa`='$entidadFederativa1',`MunicipioAlcaldia`='$munAl1',`CodigoPostal`='$codigoPostal1',`Telefono`='$telefono1',`Correo`='$correo1',`EscuelaProcedencia`='$escuelaProcedencia1',`Promedio`='$promedio1',`ESCOM_Opcion`='$escomOpcion1',`idSalon`='$idsalon' WHERE NoBoleta=$NoBoleta");
    echo "<script>window.location.href = '../CRUDadmin.php';</script>";

    
}
?>

    
    