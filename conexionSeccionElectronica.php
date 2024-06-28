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
  <title>Sección-Electronica</title>
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
            /* nextSectionBtn.style.display = 'inline-block'; */
        } else {
            submitBtn.style.display = 'none';
            nextSectionBtn.style.display = 'none';
        }
        
        submitBtn.disabled = !allAnswered;
        nextSectionBtn.disabled = !allAnswered;
      });

      submitBtn.addEventListener('click', function () {
          const correctAnswers = {
              q1: 'c',
              q2: 'd',
              q3: 'b',
              q4: 'c',
              q5: 'b',
              q6: 'a',
              q7: 'a',
              q8: 'b',
              q9: 'a',
              q10: 'b',
              q11: 'b',
              q12: 'c',
              q13: 'b',
              q14: 'b',
              q15: 'b',
              q16: 'c',
              q17: 'c',
              q18: 'b',
              q19: 'c',
              q20: 'a'
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
              q1: 'c',
              q2: 'd',
              q3: 'b',
              q4: 'c',
              q5: 'b',
              q6: 'a',
              q7: 'a',
              q8: 'b',
              q9: 'a',
              q10: 'b',
              q11: 'b',
              q12: 'c',
              q13: 'b',
              q14: 'b',
              q15: 'b',
              q16: 'c',
              q17: 'c',
              q18: 'b',
              q19: 'c',
              q20: 'a'
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
            url: "./php/resultadoElectronica.php",
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
    <!-- Nav principal -->
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
    <h1>Sección de Electronica</h1>
    <form id="exam-form" action="" method="post">
  <div class="question">
    <p>1. Los interruptores o swiches se utilizan en los circuitos para:</p>
    <label><input type="radio" name="q1" value="a"> Regular la señal que pasa por ellos.</label><br>
    <label><input type="radio" name="q1" value="b"> Aumentar el volumen en un parlante.</label><br>
    <label><input type="radio" name="q1" value="c"> Interrumpir el paso de corriente.</label><br>
    <label><input type="radio" name="q1" value="d"> Encender una luz.</label>
  </div>
  <div class="question">
    <p>2. Se utiliza para ensamblar sin soldaduras prototipos o circuitos prueba. </p>
    <label><input type="radio" name="q2" value="a"> La placa fenólica</label><br>
    <label><input type="radio" name="q2" value="b"> El cautín</label><br>
    <label><input type="radio" name="q2" value="c"> El relevador</label><br>
    <label><input type="radio" name="q2" value="d"> El protoboard</label>
  </div>
  <div class="question">
    <p>3. En un circuito, la función básica de una resistencia es:</p>
    <label><input type="radio" name="q3" value="a"> Calentar el circuito</label><br>
    <label><input type="radio" name="q3" value="b"> Regular el paso de los electrones</label><br>
    <label><input type="radio" name="q3" value="c"> Ayudan a la función de los transistores</label><br>
    <label><input type="radio" name="q3" value="d"> Conectarse con capacitores y bobinas</label>
  </div>
  <div class="question">
    <p>4. Una resistencia de 1/2 W con los colores rojo-rojo-amarillo-dorado tiene un valor de:</p>
    <label><input type="radio" name="q4" value="a"> 22 000 ohmios, 10% (22 KΩ)</label><br>
    <label><input type="radio" name="q4" value="b"> 2.200 ohmios, 5% (2.2 KΩ)</label><br>
    <label><input type="radio" name="q4" value="c"> 220000 ohmios, 5% (220 KΩ)</label><br>
    <label><input type="radio" name="q4" value="d"> 2.2 ohms, 10 %</label>
  </div>
  <div class="question">
    <p>5. Los materiales semiconductores se caracterizan por:</p>
    <label><input type="radio" name="q5" value="a"> Ser muy buenos conductores.</label><br>
    <label><input type="radio" name="q5" value="b"> Tienen una mala conductividad.</label><br>
    <label><input type="radio" name="q5" value="c"> Pueden ser conductores o aislantes dependiendo de un estímulo externo.</label><br>
    <label><input type="radio" name="q5" value="d"> Ser muy malos conductores.</label>
  </div>
  <div class="question">
    <p>6. El _____________ es marcado por una línea pintada sobre el cuerpo del diodo.</p>
    <img src="./img/diodo.PNG" class="img-right"><br>
    <label><input type="radio" name="q6" value="a"> Ánodo</label><br>
    <label><input type="radio" name="q6" value="b"> Catodo</label><br>
    <label><input type="radio" name="q6" value="c"> Resistencia</label><br>
    <label><input type="radio" name="q6" value="d"> Componente Electrónico</label>
  </div>  
  <div class="question">
    <p>7. ¿Qué componente electrónico permite el flujo de corriente en un solo sentido?</p>
    <label><input type="radio" name="q7" value="a"> Diodo</label><br>
    <label><input type="radio" name="q7" value="b"> Resistencia</label><br>
    <label><input type="radio" name="q7" value="c"> Capacitor</label><br>
    <label><input type="radio" name="q7" value="d"> Transistor</label>
  </div>
  <div class="question">
      <p>8. ¿Cuál es la unidad de medida de la resistencia eléctrica?</p>
      <label><input type="radio" name="q8" value="a"> Voltio</label><br>
      <label><input type="radio" name="q8" value="b"> Ohmio</label><br>
      <label><input type="radio" name="q8" value="c"> Vatio</label><br>
      <label><input type="radio" name="q8" value="d"> Amperio</label>
  </div>
  <div class="question">
      <p>9. ¿Qué ley establece que la corriente que fluye a través de un conductor es directamente proporcional al voltaje aplicado e inversamente proporcional a la resistencia?</p>
      <label><input type="radio" name="q9" value="a"> Ley de Ohm</label><br>
      <label><input type="radio" name="q9" value="b"> Ley de Kirchhoff</label><br>
      <label><input type="radio" name="q9" value="c"> Ley de Gauss</label><br>
      <label><input type="radio" name="q9" value="d"> Ley de Faraday</label>
  </div>
  <div class="question">
      <p>10. ¿Qué tipo de circuito tiene al menos un camino cerrado para la corriente eléctrica?</p>
      <label><input type="radio" name="q10" value="a"> Serie</label><br>
      <label><input type="radio" name="q10" value="b"> Paralelo</label><br>
      <label><input type="radio" name="q10" value="c"> Mixto</label><br>
      <label><input type="radio" name="q10" value="d"> Complejo</label>
  </div>
  <div class="question">
      <p>11. ¿Qué componente electrónico almacena energía en forma de campo eléctrico?</p>
      <label><input type="radio" name="q11" value="a"> Diodo</label><br>
      <label><input type="radio" name="q11" value="b"> Capacitor</label><br>
      <label><input type="radio" name="q11" value="c"> Resistencia</label><br>
      <label><input type="radio" name="q11" value="d"> Inductor</label>
  </div>
  <div class="question">
      <p>12. ¿Qué es un amplificador operacional?</p>
      <label><input type="radio" name="q12" value="a"> Un dispositivo para amplificar señales de radio</label><br>
      <label><input type="radio" name="q12" value="b"> Un componente para sumar tensiones</label><br>
      <label><input type="radio" name="q12" value="c"> Un circuito integrado utilizado para amplificar señales eléctricas</label><br>
      <label><input type="radio" name="q12" value="d"> Un tipo de transistor</label>
  </div>
  <div class="question">
      <p>13. ¿Qué ley establece que la suma algebraica de las corrientes que entran y salen de un nodo en un circuito eléctrico es igual a cero?</p>
      <label><input type="radio" name="q13" value="a"> Ley de Ohm</label><br>
      <label><input type="radio" name="q13" value="b"> Ley de Kirchhoff de las corrientes</label><br>
      <label><input type="radio" name="q13" value="c"> Ley de Kirchhoff de las tensiones</label><br>
      <label><input type="radio" name="q13" value="d"> Ley de Faraday</label>
  </div>
  <div class="question">
      <p>14. ¿Qué tipo de circuito permite que la corriente tenga más de un camino para fluir?</p>
      <label><input type="radio" name="q14" value="a"> Serie</label><br>
      <label><input type="radio" name="q14" value="b"> Paralelo</label><br>
      <label><input type="radio" name="q14" value="c"> Mixto</label><br>
      <label><input type="radio" name="q14" value="d"> Complejo</label>
  </div>
  <div class="question">
      <p>15. ¿Qué componente electrónico se utiliza para cambiar la magnitud de una señal eléctrica?</p>
      <label><input type="radio" name="q15" value="a"> Diodo</label><br>
      <label><input type="radio" name="q15" value="b"> Transistor</label><br>
      <label><input type="radio" name="q15" value="c"> Capacitor</label><br>
      <label><input type="radio" name="q15" value="d"> Inductor</label>
  </div>
  <div class="question">
      <p>16. ¿Qué es un oscilador en electrónica?</p>
      <label><input type="radio" name="q16" value="a"> Un componente que almacena energía eléctrica</label><br>
      <label><input type="radio" name="q16" value="b"> Un dispositivo para medir voltaje</label><br>
      <label><input type="radio" name="q16" value="c"> Un circuito que genera una señal periódica</label><br>
      <label><input type="radio" name="q16" value="d"> Un componente para regular la corriente</label>
  </div>
  <div class="question">
      <p>17. ¿Qué ley establece que la suma de las tensiones en un lazo de un circuito es cero?</p>
      <label><input type="radio" name="q17" value="a"> Ley de Ohm</label><br>
      <label><input type="radio" name="q17" value="b"> Ley de Kirchhoff de las corrientes</label><br>
      <label><input type="radio" name="q17" value="c"> Ley de Kirchhoff de las tensiones</label><br>
      <label><input type="radio" name="q17" value="d"> Ley de Faraday</label>
  </div>
  <div class="question">
      <p>18. ¿Qué es un transistor en electrónica?</p>
      <label><input type="radio" name="q18" value="a"> Un dispositivo para medir corriente</label><br>
      <label><input type="radio" name="q18" value="b"> Un componente para amplificar señales</label><br>
      <label><input type="radio" name="q18" value="c"> Un componente que almacena energía eléctrica</label><br>
      <label><input type="radio" name="q18" value="d"> Un componente que resiste el flujo de corriente</label>
  </div>
  <div class="question">
      <p>19. ¿Qué es un circuito integrado (CI) en electrónica?</p>
      <label><input type="radio" name="q19" value="a"> Un dispositivo para convertir energía eléctrica en energía mecánica</label><br>
      <label><input type="radio" name="q19" value="b"> Un componente que regula la corriente eléctrica</label><br>
      <label><input type="radio" name="q19" value="c"> Un conjunto de circuitos impresos en un solo chip</label><br>
      <label><input type="radio" name="q19" value="d"> Un componente que controla la frecuencia de una señal</label>
  </div>
  <div class="question">
      <p>20. ¿Qué es la capacitancia en electrónica?</p>
      <label><input type="radio" name="q20" value="a"> La capacidad de un componente para almacenar energía eléctrica</label><br>
      <label><input type="radio" name="q20" value="b"> La resistencia al flujo de corriente de un componente</label><br>
      <label><input type="radio" name="q20" value="c"> La capacidad de un componente para regular el voltaje</label><br>
      <label><input type="radio" name="q20" value="d"> La capacidad de un componente para cambiar la magnitud de una señal</label>
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

  <!--Validaciones de las preguntas y conexion con la base-->

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