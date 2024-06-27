<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['idAdmin'])) {
    // Redirigir al usuario a la página de inicio de sesión

    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./Proyecto.css">
    <script src="./js/ProyectoJs.js"></script>

    <title>.::CrudAdmin::.</title>

</head>

<body>
    <div class="container-fluid mt-3 d-flex align-items-center justify-content-center text-white " id="piePag">
        <div class="row">
            <div class=" text-center ">
                <h1>Bienvenido Administrador</h1>
                <h3>¿Qué es lo que desea hacer?</h3>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-sm justify-content-sm-center sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://escom.ipn.mx/">
                <img src="./img/logoSAEDA.png" id="LogoESCOMNav" alt="ESCOM" width="60" height="48">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon">&#9776</span>
            </button>

            <div class="collapse navbar-collapse justify-content-sm-center" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item" id="navPrincipal">
                        <a class="nav-link menuPrin activo" id="botcrudalumno" href="#crudalumno">Alumnos</a>
                    </li>
                   <li class="nav-item" id="navSecundario" hidden>
                        <a class="nav-link menuPrin" id="botcrudsalon" href="#crudsalon">Salones</a>
                    </li>
                </ul>
            </div>
            
            <span class="navbar-text justify-content-end" id="IPN">Instituto Politécnico Nacional</span>
        </div>
    </nav>
    <section id="crudalumno">
        <div class="d-flex flex-column flex-md-row bd-highlight mb-3 align-items-center justify-content-center">
            <div class="me-md-auto p-2 bd-highlight text-center">
                <h2>Alumnos</h2>
            </div>
            <div id="barrabuscar" class="d-flex align-items-center p-2 bd-highlight">
                <form method="POST" class="d-flex align-items-center">
                    <div class="input-group">
                        <button type="submit" class="btn btn-secondary" name="btnbuscar">Buscar</button>
                        <input type="text" class="form-control form-control-sm" name="txtbuscar" id="cajabuscar" placeholder="&#128270; Ingresar Número de Boleta">
                    </div>
                </form>
            </div>
            <div class="ms-md-auto p-2 bd-highlight text-center">
                <button type="button" class="btn btn-secondary" id="botonagregar" onclick="window.location.href='formnuevo.html'">Añadir Alumno</button>


            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Número de Boleta</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody id="mytable">
                    <tr>
                        <th scope="row" colspan="5">Loading...</th>
                    </tr>
                </tbody>
            </table>
        </div>
   
    </section>

    

    <section id="crudsalon">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">idsalon</th>
                        <th scope="col">Capacidad Maxima</th>
                        <th scope="col">Alumnos Registrados</th>
                        <th scope="col">Horario</th>
                    </tr>
                </thead>
                <tbody id="mytable2">
                    <tr>
                        <th scope="row" colspan="5">Loading...</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- <footer class="text-center text-white" id="piePag">
        <div class="p-4 pb-0">
            <section class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <a href="https://escom.ipn.mx/">
                            <img src="./img/escom.png" alt="ESCOM30Aniversario">
                        </a>
                        <a href="./php/cerrarSesion.php" class="text-white">Cerrar Sesión</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="text-center p-3" id="derPiePag">
            © 2023 Página creada por: Anuar, Imanol, Adolfo y Lucas
        </div>
    </footer> -->

    <footer class="text-center text-white" id="piePag">
        <div class="p-4 pb-0">
            <section class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-6">
                        <a href="https://escom.ipn.mx/">
                            <img src="./img/logoEscomBlanco.png" alt="ESCOM30Aniversario">
                        </a>                      
                    </div>
                    <div class="col-sm-6">
                        <a href="./php/cerrarSesion.php" class="text-white">Cerrar Sesión</a>
                    </div>
                </div>
            </section>
        </div>
        <div class="text-center p-3" id="derPiePag">
            © 2024 Página creada por: Anuar, Camila, Daniel, Angela y Oscar
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        document.getElementById("botcrudsalon").addEventListener("click",function(){
            document.getElementById("crudalumno").style.display="none";
            document.getElementById("crudsalon").style.display="block";



        });
        document.getElementById("botcrudalumno").addEventListener("click",function(){
            document.getElementById("crudalumno").style.display="block";
            document.getElementById("crudsalon").style.display="none";



        });


        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("crudsalon").style.display="none";



        });




        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('#crudalumno form').addEventListener('submit', function (event) {
                event.preventDefault();
                fetch('./php/buscaralumno.php', {
                        method: 'POST',
                        body: new FormData(this)
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById('mytable').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });

            cargarAlumnos();
        });

        function cargarAlumnos() {
            fetch('./php/cargaralumnos.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById('mytable').innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>

</html>
