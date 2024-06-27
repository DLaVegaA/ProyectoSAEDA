<?php
    session_start();

    error_log($_SESSION['NoBoleta']);

    if (!isset($_SESSION['NoBoleta'])) {
        header("Location: examen.html");
        exit();
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./presentarExamen.css">
    <script src="./js/validacionesRecuperarPDF.js"></script>
    <script src="./js/jquery-3.7.1.minpro.js"></script>
    <title>.::Aplicar Examen Diagnóstico::.</title>
    <title>Examen</title>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('btnElecSec').onclick = function() {
                window.location.href = './conexionSeccionElectronica.php';
            }
        });
    </script>
</head>
<body id="cuerpo">
    <!-- Nav principal -->
    <nav class="navbar navbar-expand-sm justify-content-sm-center sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://escom.ipn.mx/">
                <img src="./img/logoSAEDA.png" id="LogoESCOMNav" alt="ESCOM" width="60" height="48">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"">&#9776</span>
            </button>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item" id="navPrincipal">
                        <a class="nav-link menuPrin" href="./index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menuPrin" href="./proyectoAct.html">Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menuPrin" href="./recuperarPDF.html">Recuperar PDF</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menuPrin activo" href="./examen.html">Examen</a>
                    </li>
                </ul>
            </div>

            <span class="navbar-text justify-content-end" id="IPN">Instituto Politécnico Nacional</span>
        </div>
    </nav>

    <!--Contenido-->
    <div class="container">
        <div class="row">
            <div class="sm-12 text-center py-5" id="divAplicarExam">
                <h1>¡Bienvenido alumno de nuevo ingreso!</h1>
                <p class="pExamen">
                ¡Bienvenido a nuestro portal de exámenes diagnósticos! Aquí podrás evaluar tus conocimientos por materia, específicamente diseñados para la carrera de Ingeniería en Sistemas Computacionales (ISC).
                </p>
                <p class="estiloExamen">Cada sección del examen contiene preguntas relacionadas con una materia específica y tiene 
                un tiempo límite para completarlas. Ten en cuenta que, una vez que comiences una sección, no podrás salir 
                de ella ni pausarla. Si decides salir antes de terminar, solo se registrarán las respuestas seleccionadas 
                hasta ese momento.<br>
                ¡Prepárate y buena suerte!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 SecEx">
                <div class="row">
                    <div class="col-sm-6 nomSec">
                        <h3 class="EncabezadoSec">Electrónica</h3>
                        <p class="aciertosExamen" id="aciertosElec">aciertos examen</p>
                    </div>
                    <div class="col-sm-6 imgSec">
                        <img src="./img/upc.png" id="imgElecSec" alt="imagen seccion electronica" width="80" height="80">
                    </div>
                    <button class="btn btn-primary" id="btnElecSec">Empezar</button>
                </div>
            </div>
            <div class="col-sm-6 SecEx">
                <div class="row">
                    <div class="col-sm-6 nomSec">
                        <h3 class="EncabezadoSec">Programación</h3>
                        <p class="aciertosExamen" id="aciertosProg">aciertos examen</p>
                    </div>
                    <div class="col-sm-6 imgSec">
                        <img src="./img/desarrollo-movil.png" id="imgProgSec" alt="imagen seccion programacion" width="80" height="80">
                    </div>
                    <button class="btn btn-primary" id="btnProgSec">Empezar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 SecEx">
                <div class="row">
                    <div class="col-sm-6 nomSec">
                        <h3 class="EncabezadoSec">Física</h3>
                        <p class="aciertosExamen" id="aciertosFis">aciertos examen</p>
                    </div>
                    <div class="col-sm-6 imgSec">
                        <img src="./img/atomo.png" id="imgFisSec" alt="imagen seccion fisica" width="80" height="80">                        
                    </div>
                    <button class="btn btn-primary" id="btnFisSec">Empezar</button>
                </div>
            </div>
            <div class="col-sm-6 SecEx">
                <div class="row">
                    <div class="col-sm-6 nomSec">
                        <h3 class="EncabezadoSec">Cálculo</h3>
                        <p class="aciertosExamen" id="aciertosCal">aciertos examen</p>
                    </div>
                    <div class="col-sm-6 imgSec">
                        <img src="./img/integral.png" id="imgCalSec" alt="imagen seccion calculo" width="80" height="80">
                    </div>
                    <button class="btn btn-primary" id="btnCalSec">Empezar</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 contenedorBotones">
                <button class="btn btn-primary estBtn" id="btnEstadisticasEx">Ver estadísticas</button>
            </div>
            <div class="col-sm-6 contenedorBotones">
                <button class="btn btn-danger terBtn" id="btnTerminarEx">Terminar examen</button>
            </div>            
        </div>
    </div>
    <!-- Pie de página -->
    <footer class="text-center text-white" id="piePag">
        <div class="p-4 pb-0">
            <section class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <a href="https://escom.ipn.mx/">
                            <img src="./img/logoEscomBlanco.png" alt="ESCOM30Aniversario">
                        </a>
                        <a href="./login.html" class="text-white">Administrador</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="text-center p-3" id="derPiePag">
            © 2024 Página creada por: Anuar, Camila, Daniel, Angela y Oscar
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>