<?php
  session_start();

  error_log($_SESSION['NoBoleta']);

  if (!isset($_SESSION['NoBoleta'])) {
      header("Location: examen.html");
      exit();
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./estiloExamen.css">
  <link rel="stylesheet" href="./recuperarPDFCSS.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Sección-Programación</title>
  <script src="./js/jquery-3.7.1.minpro.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('exam-form');
      const submitBtn = document.getElementById('submit-btn');
      const nextSectionBtn = document.getElementById('next-section-btn');
      const questions = form.querySelectorAll('.question');
      const modal = document.getElementById('resultModal');
      const resultText = document.getElementById('resultText');
      const closeBtn = document.getElementsByClassName('close')[0];

      submitBtn.style.display = 'none';
      nextSectionBtn.style.display = 'none';
      
      form.addEventListener('change', function () {
          let allAnswered = true;
          questions.forEach(function (question) {
              const inputs = question.querySelectorAll('input[type="radio"]');
              let answered = false;
              inputs.forEach(function (input) {
                  if (input.checked) {
                      answered = true;
                  }
              });
              if (!answered) {
                  allAnswered = false;
              }
          });

          if (allAnswered) {
            submitBtn.style.display = 'inline-block';
            nextSectionBtn.style.display = 'inline-block';
          } else {
            submitBtn.style.display = 'none';
            nextSectionBtn.style.display = 'none';
          }

          submitBtn.disabled = !allAnswered;
          nextSectionBtn.disabled = !allAnswered;
      });

      submitBtn.addEventListener('click', function () {
          const correctAnswers = {
                q1: 'a',
                q2: 'a',
                q3: 'b',
                q4: 'b',
                q5: 'a',
                q6: 'b',
                q7: 'c',
                q8: 'c',
                q9: 'b',
                q10: 'b',
                q11: 'b',
                q12: 'b',
                q13: 'a',
                q14: 'c',
                q15: 'c',
                q16: 'a',
                q17: 'd',
                q18: 'd',
                q19: 'a',
                q20: 'd'
          };

          let score = 0;
          questions.forEach(function (question, index) {
              const qNum = `q${index + 1}`;
              const userAnswer = form.elements[qNum].value;
              if (userAnswer === correctAnswers[qNum]) {
                  score++;
                  question.style.backgroundColor = 'lightgreen';
              } else {
                  question.style.backgroundColor = 'lightcoral';
              }
          });

          resultText.textContent = `Has acertado ${score} de 20 preguntas.`;
          modal.style.display = 'block';
          nextSectionBtn.disabled = false;

          // Ocultar el botón de "Revisar preguntas" y mostrar el botón de "Terminar sección"
          submitBtn.style.display = 'none';
          nextSectionBtn.style.display = 'inline-block';

          // Asignar el valor de aciertos al campo oculto y enviar el formulario
          document.getElementById('aciertos').value = score;
      });

      closeBtn.addEventListener('click', function () {
          modal.style.display = 'none';
      });

      window.addEventListener('click', function (event) {
          if (event.target == modal) {
              modal.style.display = 'none';
          }
      });

      /* nextSectionBtn.addEventListener('click', function () {
          if (nextSectionBtn.disabled) {
              event.preventDefault();
              return;
          }
          // Enviar el formulario al presionar el botón "Terminar sección"
          const correctAnswers = {
                q1: 'a',
                q2: 'a',
                q3: 'b',
                q4: 'b',
                q5: 'a',
                q6: 'b',
                q7: 'c',
                q8: 'c',
                q9: 'b',
                q10: 'b',
                q11: 'b',
                q12: 'b',
                q13: 'a',
                q14: 'c',
                q15: 'c',
                q16: 'a',
                q17: 'd',
                q18: 'd',
                q19: 'a',
                q20: 'd'
          };

          let score = 0;
          questions.forEach(function (question, index) {
              const qNum = `q${index + 1}`;
              const userAnswer = form.elements[qNum].value;
              if (userAnswer === correctAnswers[qNum]) {
                  score++;
                  question.style.backgroundColor = 'lightgreen';
              } else {
                  question.style.backgroundColor = 'lightcoral';
              }
          });

          document.getElementById('aciertos').value = score;
          form.submit();
      }); */
  });

  $(document).ready(function(){
    $("form#exam-form").submit(function(e){
        e.preventDefault();

        var aciertosE = $("#aciertos").val();
        var noBoleta = "<?php echo $_SESSION['NoBoleta']; ?>";

        $.ajax({
            type: "POST",
            url: "./php/resultadoProgramacion.php",
            data: {aciertos: aciertosE, NoBoleta: noBoleta},
            success: function(response){
                console.log(response);

                if(response == "1"){
                    alert("Error al guardar los datos");
                }else{
                    window.location.href = response;
                }
            }
        });
    });
  });
</script>
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-sm justify-content-sm-center sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="">
                <img src="./img/logoSAEDA.png" id="LogoESCOMNav" alt="ESCOM" width="60" height="48">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"">&#9776</span>
            </button>

            <span class="navbar-text justify-content-end" id="IPN">Instituto Politécnico Nacional</span>
        </div>
    </nav>

<!--contenido principal-->
<div class="container-fluid align-items-center justify-content-center d-flex" id="cuerpo">
  <div id="contenido">
    <h1>Sección de Programación</h1>
    <form id="exam-form" action="" method="post">
    <div class="question">
    <p>1. ¿Qué es un bucle en programación?</p>
    <label><input type="radio" name="q1" value="a"> Una estructura de control que repite un bloque de código varias veces.</label><br>
    <label><input type="radio" name="q1" value="b"> Una variable que almacena valores enteros.</label><br>
    <label><input type="radio" name="q1" value="c"> Un tipo de dato que representa números con decimales.</label><br>
    <label><input type="radio" name="q1" value="d"> Una función que ordena elementos en una lista.</label>
  </div>
  <div class="question">
    <p>2. ¿Cuál es la diferencia entre una variable local y una global en programación?</p>
    <label><input type="radio" name="q2" value="a"> Una variable local solo puede ser usada dentro de una función, mientras que una global puede ser accesada desde cualquier parte del programa.</label><br>
    <label><input type="radio" name="q2" value="b"> Una variable local solo puede contener números enteros, mientras que una global puede contener cualquier tipo de dato.</label><br>
    <label><input type="radio" name="q2" value="c"> Una variable local es más rápida de procesar que una global.</label><br>
    <label><input type="radio" name="q2" value="d"> Una variable global solo puede ser usada dentro de una función, mientras que una local puede ser accesada desde cualquier parte del programa.</label>
  </div>
  <div class="question">
    <p>3. ¿Qué es la recursividad en programación?</p>
    <label><input type="radio" name="q3" value="a"> Una técnica para ejecutar instrucciones en orden inverso.</label><br>
    <label><input type="radio" name="q3" value="b"> Un proceso mediante el cual una función se llama a sí misma.</label><br>
    <label><input type="radio" name="q3" value="c"> Un método para cifrar datos sensibles.</label><br>
    <label><input type="radio" name="q3" value="d"> Un tipo de variable que puede cambiar de valor durante la ejecución del programa.</label>
  </div>
  <div class="question">
    <p>4. ¿Qué es un array (o arreglo) en programación?</p>
    <label><input type="radio" name="q4" value="a"> Un conjunto de instrucciones que se ejecutan en secuencia.</label><br>
    <label><input type="radio" name="q4" value="b"> Un tipo de dato que almacena varios elementos del mismo tipo en una sola variable.</label><br>
    <label><input type="radio" name="q4" value="c"> Una estructura de control que decide qué acción ejecutar dependiendo de una condición.</label><br>
    <label><input type="radio" name="q4" value="d"> Un dispositivo de entrada para enviar datos al programa.</label>
  </div>
  <div class="question">
    <p>5. ¿Qué es la sintaxis en programación?</p>
    <label><input type="radio" name="q5" value="a"> El conjunto de reglas que definen cómo se escriben las instrucciones en un lenguaje de programación.</label><br>
    <label><input type="radio" name="q5" value="b"> El proceso de probar y depurar un programa.</label><br>
    <label><input type="radio" name="q5" value="c"> La velocidad a la que se ejecuta un programa.</label><br>
    <label><input type="radio" name="q5" value="d"> La cantidad de memoria que utiliza un programa.</label>
  </div>
  <div class="question">
    <p>6. ¿Qué es un algoritmo en programación?</p>
    <label><input type="radio" name="q6" value="a"> Un error en el código que provoca un mal funcionamiento del programa.</label><br>
    <label><input type="radio" name="q6" value="b"> Un conjunto de instrucciones que especifican cómo resolver un problema.</label><br>
    <label><input type="radio" name="q6" value="c"> Un tipo especial de variable que contiene solo dos valores posibles.</label><br>
    <label><input type="radio" name="q6" value="d"> Una variable que no puede ser modificada después de haber sido inicializada.</label>
  </div>
  <div class="question">
    <p>7. ¿Para qué se utiliza la estructura de control 'if' en programación?</p>
    <label><input type="radio" name="q7" value="a"> Para definir funciones en un programa.</label><br>
    <label><input type="radio" name="q7" value="b"> Para repetir un bloque de código varias veces.</label><br>
    <label><input type="radio" name="q7" value="c"> Para ejecutar un bloque de código solo si se cumple una condición específica.</label><br>
    <label><input type="radio" name="q7" value="d"> Para almacenar múltiples valores en una sola variable.</label>
  </div>
  <div class="question">
    <p>8. ¿Cuál es la función de una variable en programación?</p>
    <label><input type="radio" name="q8" value="a"> Almacenar múltiples valores en una sola estructura.</label><br>
    <label><input type="radio" name="q8" value="b"> Cambiar el tipo de dato de una variable durante la ejecución del programa.</label><br>
    <label><input type="radio" name="q8" value="c"> Guardar un solo valor que puede ser modificado o consultado durante la ejecución del programa.</label><br>
    <label><input type="radio" name="q8" value="d"> Controlar el flujo de ejecución de un programa.</label>
  </div>
  <div class="question">
    <p>9. ¿Cómo se declara una variable en C?</p>
    <label><input type="radio" name="q9" value="a"> variable tipo_dato nombre_variable;</label><br>
    <label><input type="radio" name="q9" value="b"> tipo_dato nombre_variable;</label><br>
    <label><input type="radio" name="q9" value="c"> nombre_variable tipo_dato;</label><br>
    <label><input type="radio" name="q9" value="d"> nombre_variable = tipo_dato;</label>
  </div>
  <div class="question">
    <p>10. ¿Qué es un tipo de dato en programación?</p>
    <label><input type="radio" name="q10" value="a"> Una función predefinida en un lenguaje de programación.</label><br>
    <label><input type="radio" name="q10" value="b"> Un conjunto de valores y operaciones que se pueden realizar con esos valores.</label><br>
    <label><input type="radio" name="q10" value="c"> La cantidad de memoria que ocupa una variable.</label><br>
    <label><input type="radio" name="q10" value="d"> La velocidad a la que se ejecuta un programa.</label>
  </div>
  <div class="question">
    <p>11. ¿Qué es una función en programación?</p>
    <label><input type="radio" name="q11" value="a"> Una instrucción que cambia el valor de una variable.</label><br>
    <label><input type="radio" name="q11" value="b"> Un bloque de código que realiza una tarea específica y puede ser llamado múltiples veces desde distintas partes del programa.</label><br>
    <label><input type="radio" name="q11" value="c"> Un valor que puede cambiar durante la ejecución del programa.</label><br>
    <label><input type="radio" name="q11" value="d"> Una estructura que almacena múltiples valores en una sola variable.</label>
  </div>
  <div class="question">
    <p>12. ¿Cómo se declara una lista (arreglo) en C?</p>
    <label><input type="radio" name="q12" value="a"> arreglo tipo_dato nombre_arreglo[tamaño];</label><br>
    <label><input type="radio" name="q12" value="b"> tipo_dato nombre_arreglo[tamaño];</label><br>
    <label><input type="radio" name="q12" value="c"> nombre_arreglo tipo_dato[tamaño];</label><br>
    <label><input type="radio" name="q12" value="d"> tipo_dato[tamaño] nombre_arreglo;</label>
  </div>
  <div class="question">
    <p>13. ¿Qué es una constante en programación?</p>
    <label><input type="radio" name="q13" value="a"> Una variable que no puede ser modificada después de haber sido inicializada.</label><br>
    <label><input type="radio" name="q13" value="b"> Un tipo de dato que almacena números con decimales.</label><br>
    <label><input type="radio" name="q13" value="c"> Una estructura de control que repite un bloque de código varias veces.</label><br>
    <label><input type="radio" name="q13" value="d"> Un error en el código que provoca un mal funcionamiento del programa.</label>
  </div>
  <div class="question">
    <p>14. ¿Qué está mal en el siguiente código en C?</p>
    <img src="./img/progra_01.PNG" class="img-right"><br>
    <label><input type="radio" name="q14" value="a"> La declaración de la variable num es incorrecta.</label><br>
    <label><input type="radio" name="q14" value="b"> Falta incluir la librería stdlib.h.</label><br>
    <label><input type="radio" name="q14" value="c"> No hay nada incorrecto en el código.</label><br>
    <label><input type="radio" name="q14" value="d"> El bucle for no debería tener inicialización de la variable i.</label><br>
  </div>
  <div class="question">
    <p>15. ¿Qué es la declaración de variables en programación?</p>
    <label><input type="radio" name="q15" value="a"> La parte del código que realiza operaciones matemáticas.</label><br>
    <label><input type="radio" name="q15" value="b"> El proceso de escribir un código sin errores.</label><br>
    <label><input type="radio" name="q15" value="c"> La asignación de un nombre y tipo de dato a una variable.</label><br>
    <label><input type="radio" name="q15" value="d"> Una función que cambia el valor de una variable.</label>
  </div>
  <div class="question">
    <p>16. ¿Qué devuelve este código en C?</p>
    <img src="./img/progra_02.PNG" class="img-right"><br>
    <label><input type="radio" name="q16" value="a"> 15</label><br>
    <label><input type="radio" name="q16" value="b"> 10</label><br>
    <label><input type="radio" name="q16" value="c"> 5</label><br>
    <label><input type="radio" name="q16" value="d"> 0</label><br><br>
  </div>
  <div class="question">
    <p>17. ¿Qué es la herencia en programación orientada a objetos?</p>
    <label><input type="radio" name="q17" value="a"> La capacidad de una clase para tener múltiples instancias.</label><br>
    <label><input type="radio" name="q17" value="b"> Una técnica para crear copias de seguridad de código.</label><br>
    <label><input type="radio" name="q17" value="c"> El proceso de escribir un código sin errores.</label><br>
    <label><input type="radio" name="q17" value="d"> La capacidad de una clase de heredar atributos y métodos de otra clase.</label>
  </div>
  <div class="question">
      <p>18. ¿Qué es la encapsulación en programación orientada a objetos?</p>
      <label><input type="radio" name="q18" value="a"> Una técnica para crear copias de seguridad de código.</label><br>
      <label><input type="radio" name="q18" value="b"> La capacidad de una clase para tener múltiples instancias.</label><br>
      <label><input type="radio" name="q18" value="c"> El proceso de escribir un código sin errores.</label><br>
      <label><input type="radio" name="q18" value="d"> La ocultación de los detalles internos de una clase y el acceso controlado a sus componentes.</label>
  </div>
  <div class="question">
      <p>19. ¿Qué es el polimorfismo en programación orientada a objetos?</p>
      <label><input type="radio" name="q19" value="a"> La capacidad de una función para cambiar su comportamiento dependiendo del tipo de dato que recibe.</label><br>
      <label><input type="radio" name="q19" value="b"> Una técnica para crear copias de seguridad de código.</label><br>
      <label><input type="radio" name="q19" value="c"> El proceso de escribir un código sin errores.</label><br>
      <label><input type="radio" name="q19" value="d"> La capacidad de una clase para tener múltiples instancias.</label>
  </div>
  <div class="question">
      <p>20. ¿Qué es una lista en programación?</p>
      <label><input type="radio" name="q20" value="a"> Una variable que puede almacenar varios valores.</label><br>
      <label><input type="radio" name="q20" value="b"> Una técnica para crear copias de seguridad de código.</label><br>
      <label><input type="radio" name="q20" value="c"> Una estructura de control que repite un bloque de código varias veces.</label><br>
      <label><input type="radio" name="q20" value="d"> Una estructura de datos que organiza elementos en una secuencia ordenada.</label>
  </div>
        <input type="hidden" name="usuario_id" value="1"> <!-- Este debe ser dinámico basado en el usuario logueado -->
        <input type="hidden" name="aciertos" id="aciertos">
        <button type="button" id="submit-btn" disabled>Revisar preguntas</button>
        <button type="submit" id="next-section-btn" disabled>Terminar sección</button>
    </form>
  </div>
</div>
  <!-- Modal -->
  <div id="resultModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p id="resultText"></p>
      <p>Tus respuestas se guardaron correctamente.</p>
    </div>
  </div>

<!--Pie de pagina-->
<footer class="text-center text-white" id="piePag">
        <div class="p-4 pb-0">
            <section class="">
                <div class="row d-flex justify-content-center">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="">
                                    <img src="./img/logoEscomBlanco.png" alt="ESCOM30Aniversario">
                                </a>
                            </div>
                        </div>       
                    </div>
                    <div class="col-sm-6">
                        <p>Si tienes algún problema con la pagina, tienes alguna duda o aclaración, comunicate con nosotros con el siguiente correo:</p>
                        <br>
                        <p>gestion.contacto.saeda@gmail.com</p>
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