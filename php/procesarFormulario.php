<?php
    include './conexion.php'; // Archivo de conexión
    require("./PDF/fpdf186/fpdf.php"); //FPDF

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //Creación del PDF
        class PDF extends FPDF
        {
            function header()
            {
                $this->Image('./PDF/imgs/logoPEM.fw.png', 10, 10, 200);
                $this->Ln(20);
            }

            function footer()
            {
                $this->SetY(-20);
                $this->SetFont('times', 'I', '10');
                $this->Cell(0, 15, 'Pagina '.$this->PageNo().'/{nb}', 0, 0, 'C');
            }
        }

        // Verificar si los campos están definidos y no están vacíos
        //Obterer datos de identidad
        $noBoleta = $_POST['NoBoleta'];
        $nombre = $_POST['Nombre'];
        $apellidoPaterno = $_POST['Apellido_Paterno'];
        $apellidoMaterno = $_POST['Apellido_Materno'];
        $curp = $_POST['CURP'];
        $fechaNacimiento = $_POST['Fecha'];
        $genero = $_POST['generoRadio'];
        $discapacidad = isset($_POST['discapacidadRadio']) ? $_POST['discapacidadRadio'] : '';

        //Obterer datos de contacto
        $calle = $_POST['Calle'];
        $numeroC = $_POST['NumeroC'];
        $entidadFederativa = $_POST['EntidadFederativa'];
        $munAl = $_POST['MunAl'];
        $codigoPostal = $_POST['CodigoPostal'];
        $telefono = $_POST['Telefono'];
        $correo = $_POST['correo'];
        
        //Obterer datos de procedencia
        if ($_POST['EscP'] == "Otros") 
        {
            $escuelaProcedencia = $_POST['NomEsc'];
        }else{
            $escuelaProcedencia = $_POST['EscP'];
        }
        /* $escuelaProcedencia = $_POST['EscP']; */
        /* $nombreEscuela = $_POST['NomEsc']; */
        $promedio = $_POST['Promedio'];
        $escomOpcion = $_POST['OpRadio'];

        // Llamar al procedimiento almacenado para obtener el ID del salón
        $sp_salon = 'ObtenerPrimerSalon';
        $stmt1 = $conexion->prepare("CALL $sp_salon(@salonId)");
        $stmt1->execute();

        // Verificar si se ejecutó correctamente
        if (!$stmt1) {
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        // Obtener el ID del salón después de llamar al procedimiento
        $result1 = $conexion->query("SELECT @salonId AS salonId");
        $salonRow = $result1->fetch_assoc();
        $salonId = $salonRow['salonId'];

        //insertar en la base de datos
        $sqlAlumno = "INSERT INTO Alumno (NoBoleta,idSalon , Nombre, ApellidoPaterno, ApellidoMaterno, CURP, FechaNacimiento, Genero, Discapacidad, Calle, numeroC, EntidadFederativa, MunicipioAlcaldia, CodigoPostal, Telefono, Correo, EscuelaProcedencia, Promedio, ESCOM_Opcion) 
            VALUES ('$noBoleta', '$salonId' , '$nombre', '$apellidoPaterno', '$apellidoMaterno', '$curp', '$fechaNacimiento', '$genero', '$discapacidad', '$calle', '$numeroC', '$entidadFederativa', '$munAl', '$codigoPostal', '$telefono', '$correo', '$escuelaProcedencia', '$promedio', '$escomOpcion')";

        if ($conexion->query($sqlAlumno) !== TRUE) {
            die("Error al insertar datos del alumno: " . $conexion->error);
        }

        // Obtener Número del salón
        
        $stm2 = $conexion->prepare("CALL ObtenerNoSalon(?, @salonNo)");
        $stm2->bind_param("s", $salonId);
        $stm2->execute();

        if (!$stm2) {
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        $result2 = $conexion->query("SELECT @salonNo AS salonNo");
        $row2 = $result2->fetch_assoc();
        $salonNo = $row2['salonNo'];

        // Obtener ID del horario

        $stm3 = $conexion->prepare("CALL ObteneridHorario(?, @horarioId)");
        $stm3->bind_param("s", $salonId);
        $stm3->execute();

        if (!$stm3) {
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        $result3 = $conexion->query("SELECT @horarioId AS horarioId");
        $row3 = $result3->fetch_assoc();
        $horarioId = $row3['horarioId'];

        // Obtener Horario
    
        $stm4 = $conexion->prepare("CALL ObtenerHorario(?, @Horario)");
        $stm4->bind_param("s", $horarioId);
        $stm4->execute();

        if (!$stm4) {
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        $result4 = $conexion->query("SELECT @Horario AS Horario");
        $row4 = $result4->fetch_assoc();
        $Horario = $row4['Horario'];

        // Obtener Dia

        $stm5 = $conexion->prepare("CALL ObtenerDia(?, @Dia)");
        $stm5->bind_param("s", $horarioId);
        $stm5->execute();

        if (!$stm5) {
            die("Error al ejecutar el procedimiento almacenado: " . $conexion->error);
        }

        $result5 = $conexion->query("SELECT @Dia AS Dia");
        $row5 = $result5->fetch_assoc();
        $Dia = $row5['Dia'];

        //AddPage(orientación[PORTRAIT, LANDSCAPE], tamaño[A3, A4, A5,LETTER, LEGAL], rotación)
        //SetFont(tipo[COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS], estilo[normal, B, I, U], tamaño)
        //Cell(ancho, alto, texto, bordes, salto de línea, alineación, rellenar, link)
        //Write(alto, texto, link)
        //OutPut(destino[I, D, F, S], nombre_archivo, utf8)

        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage('PORTRAIT', 'A4');
        $pdf->SetFont('arial', 'B', 10);
        $pdf->Write(25, utf8_decode('Instituto Politécnico Nacional'));
        $pdf->Ln(5);
        $pdf->Write(26, utf8_decode('Escuela Superior de Cómputo'));
        $pdf->Ln(5);
        $pdf->Write(27, 'Semestre: 2024-2');
        $pdf->Ln(5);
        $pdf->Write(28, 'Boleta: '.$noBoleta);
        $pdf->Ln(5);
        $pdf->SetFont('arial', 'B', 14);
        $pdf->Write(55, 'Datos registrados:');
        $pdf->Ln(31);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(52, 10, 'Nombre: '.$nombre, 1, 0);
        $pdf->Cell(70, 10, 'Apellido Paterno: '.$apellidoPaterno, 1, 0);
        $pdf->Cell(70, 10, 'Apellido Materno: '.$apellidoMaterno, 1, 1);
        $pdf->Cell(70, 10, 'CURP: '.$curp, 1, 0);
        $pdf->Cell(68, 10, 'Fecha de Nacimiento: '.$fechaNacimiento, 1, 0);
        $pdf->Cell(54, 10, 'Genero: '.$genero, 1, 1);
        $pdf->Cell(192, 10, utf8_decode('Discapacidad: '.$discapacidad), 1, 1);
        $pdf->Cell(65, 10, 'Calle: '.$calle, 1, 0);
        $pdf->Cell(45, 10, utf8_decode('Número: '.$numeroC), 1, 0);
        $pdf->Cell(82, 10, utf8_decode('Entidad Federatíva: '.$entidadFederativa), 1, 1);
        $pdf->Cell(90, 10, utf8_decode('Municipio/Alcaldía: '.$munAl), 1, 0);
        $pdf->Cell(45, 10, utf8_decode('Código postal: '.$codigoPostal), 1, 0);
        $pdf->Cell(57, 10, utf8_decode('Teléfono: '.$telefono), 1, 1);
        $pdf->Cell(90, 10, 'Correo: '.$correo, 1, 0);
        $pdf->Cell(40, 10, 'Promedio: '.$promedio, 1, 0);
        $pdf->Cell(62, 10, utf8_decode('ESCOM fue: '.$escomOpcion), 1, 1);
        $pdf->Cell(192, 10, utf8_decode('Escuela de Procedencia: '.$escuelaProcedencia), 1, 1);
        $pdf->SetFont('arial', '', 12);
        $pdf->Ln(5);
        $pdf->Write(5, utf8_decode('Para poder realizar tu examen simulacro recuerda presentarte el día y hora asignados en este PDF, así como también llegar con este este documento firmado, recuerda que debes llevar lápiz, goma, sacapuntas y una pluma negra o roja. En el inicio de la página puedes encontrar un croquis que te ayudara a llegar a tu laboratorio asignado.'));
        $pdf->Ln(10);
        $pdf->SetFont('arial', 'B', 12);
        $pdf->Cell(96, 10, 'Laboratorio: '.$salonId, 0, 0);
        $pdf->Cell(96, 10, 'Horario: ' . $Horario . ' ' . $Dia, 0, 1);
        $pdf->Ln(40);
        $pdf->Cell(192, 10, '__________________________________', 0, 1, 'C');
        $pdf->SetFont('times', 'B', '10');
        $pdf->Cell(192, 2, 'Firma del alumno.', 0, 1, 'C');

        $conexion->close(); // Cerrar la conexión

        $RegistroPDF = './PDF/'.$noBoleta.$curp.'ExamenSimulacro.pdf';
        $pdf->Output('F', $RegistroPDF);

        /* header("Location: ".$RegistroPDF); */

        /* echo $RegistroPDF; */

        if (file_exists($RegistroPDF))
        {
            echo $RegistroPDF;
        } else {
            echo "1";
        }

        /* header("Location: index.html"); */
    }
?>