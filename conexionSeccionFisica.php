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
  <title>Sección de Física</title>
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
            q2: 'c',
            q3: 'a',
            q4: 'b',
            q5: 'a',
            q6: 'a',
            q7: 'a',
            q8: 'b',
            q9: 'a',
            q10: 'b',
            q11: 'c',
            q12: 'b',
            q13: 'a',
            q14: 'd',
            q15: 'c',
            q16: 'b',
            q17: 'a',
            q18: 'b',
            q19: 'b',
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
              q2: 'c',
              q3: 'a',
              q4: 'b',
              q5: 'a',
              q6: 'a',
              q7: 'a',
              q8: 'b',
              q9: 'a',
              q10: 'b',
              q11: 'c',
              q12: 'b',
              q13: 'a',
              q14: 'd',
              q15: 'c',
              q16: 'b',
              q17: 'a',
              q18: 'b',
              q19: 'b',
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
            url: "./php/resultadoFisica.php",
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
    <h1>Sección de Física</h1>
    <form id="exam-form" action="" method="post">
  <div class="question">
    <p>1. ¿Cuál de las siguientes magnitudes es escalar?</p>
    <label><input type="radio" name="q1" value="a"> Velocidad</label><br>
    <label><input type="radio" name="q1" value="b"> Fuerza</label><br>
    <label><input type="radio" name="q1" value="c"> Energía</label><br>
    <label><input type="radio" name="q1" value="d"> Temperatura</label>
  </div>
  <div class="question">
    <p>2. Un cuerpo se desplaza con movimiento rectilíneo uniforme (MRU) si:</p>
    <label><input type="radio" name="q2" value="a"> Su velocidad cambia constantemente.</label><br>
    <label><input type="radio" name="q2" value="b"> Su aceleración es cero.</label><br>
    <label><input type="radio" name="q2" value="c"> Su velocidad es constante y diferente de cero.</label><br>
    <label><input type="radio" name="q2" value="d"> Su velocidad cambia con el tiempo.</label>
  </div>
  <div class="question">
    <p>3. ¿Cuál de las siguientes fórmulas representa correctamente la segunda ley de Newton?</p>
    <label><input type="radio" name="q3" value="a">  F = m * a </label><br>
    <label><input type="radio" name="q3" value="b"> F = 1/(m * a)</label><br>
    <label><input type="radio" name="q3" value="c"> a = (Vf - Vo )/ t</label><br>
    <label><input type="radio" name="q3" value="d"> m = v * d</label>
  </div>
  <div class="question">
    <p>4. La energía cinética de un cuerpo depende de:</p>
    <label><input type="radio" name="q4" value="a"> Su posición.</label><br>
    <label><input type="radio" name="q4" value="b"> Su velocidad y masa.</label><br>
    <label><input type="radio" name="q4" value="c"> Su forma y tamaño.</label><br>
    <label><input type="radio" name="q4" value="d"> Su temperatura.</label>
  </div>
  <div class="question">
    <p>5. ¿Cuál es la unidad de medida de la energía en el sistema internacional?</p>
    <label><input type="radio" name="q5" value="a"> Joule (J)</label><br>
    <label><input type="radio" name="q5" value="b"> Voltio (V)</label><br>
    <label><input type="radio" name="q5" value="c"> Newton (N)</label><br>
    <label><input type="radio" name="q5" value="d"> Watt (W)</label>
  </div>
  <div class="question">
    <p>6. ¿Qué tipo de energía se produce debido a la vibración de partículas?</p>
    <label><input type="radio" name="q6" value="a"> Energía térmica</label><br>
    <label><input type="radio" name="q6" value="b"> Energía cinética</label><br>
    <label><input type="radio" name="q6" value="c"> Energía mecánica</label><br>
    <label><input type="radio" name="q6" value="d"> Energía potencial</label>
  </div>  
  <div class="question">
    <p>7. La ley de la conservación de la energía establece que:</p>
    <label><input type="radio" name="q7" value="a"> La energía no se puede crear ni destruir, solo se transforma.</label><br>
    <label><input type="radio" name="q7" value="b"> La energía total en un sistema aislado siempre aumenta.</label><br>
    <label><input type="radio" name="q7" value="c"> La energía se puede crear en cualquier momento.</label><br>
    <label><input type="radio" name="q7" value="d"> La energía solo puede transformarse en calor.</label>
  </div>
  <div class="question">
      <p>8. ¿Qué ley física se utiliza para explicar la reflexión de la luz?</p>
      <label><input type="radio" name="q8" value="a"> Ley de Ohm</label><br>
      <label><input type="radio" name="q8" value="b"> Ley de Snell</label><br>
      <label><input type="radio" name="q8" value="c"> Ley de Faraday</label><br>
      <label><input type="radio" name="q8" value="d"> Ley de la reflexión</label>
  </div>
  <div class="question">
      <p>9. ¿Cuál es la unidad de medida de la frecuencia en el sistema internacional?</p>
      <label><input type="radio" name="q9" value="a"> Hertz (Hz)</label><br>
      <label><input type="radio" name="q9" value="b"> Pascal (Pa)</label><br>
      <label><input type="radio" name="q9" value="c"> Tesla (T)</label><br>
      <label><input type="radio" name="q9" value="d"> Newton (N)</label>
  </div>
  <div class="question">
      <p>10. ¿Qué es la ley de Hooke en la física?</p>
      <label><input type="radio" name="q10" value="a"> Una ley que describe la refracción de la luz.</label><br>
      <label><input type="radio" name="q10" value="b"> Una ley que describe la relación entre la fuerza y la deformación elástica.</label><br>
      <label><input type="radio" name="q10" value="c"> Una ley que describe la relación entre la fuerza y la aceleración.</label><br>
      <label><input type="radio" name="q10" value="d"> Una ley que describe la caída libre de los cuerpos.</label>
  </div>
  <div class="question">
      <p>11. ¿Cuál de los siguientes no es un tipo de onda?</p>
      <label><input type="radio" name="q11" value="a"> Onda electromagnética</label><br>
      <label><input type="radio" name="q11" value="b"> Onda transversal</label><br>
      <label><input type="radio" name="q11" value="c"> Onda térmica</label><br>
      <label><input type="radio" name="q11" value="d"> Onda longitudinal</label>
  </div>
  <div class="question">
      <p>12. ¿Qué es un circuito eléctrico en física?</p>
      <label><input type="radio" name="q12" value="a"> Un conjunto de cables y conectores.</label><br>
      <label><input type="radio" name="q12" value="b"> Un conjunto de componentes eléctricos conectados por conductores.</label><br>
      <label><input type="radio" name="q12" value="c"> Un conjunto de baterías conectadas.</label><br>
      <label><input type="radio" name="q12" value="d"> Un conjunto de resistencias eléctricas.</label>
  </div>
  <div class="question">
      <p>13. ¿Cuál es la unidad de medida del campo magnético en el sistema internacional?</p>
      <label><input type="radio" name="q13" value="a"> Tesla (T)</label><br>
      <label><input type="radio" name="q13" value="b"> Weber (Wb)</label><br>
      <label><input type="radio" name="q13" value="c"> Ohm (Ω)</label><br>
      <label><input type="radio" name="q13" value="d"> Voltio (V)</label>
  </div>
  <div class="question">
        <p>14. ¿Cuál de las siguientes leyes se utiliza para determinar la dirección de la fuerza magnética sobre una carga eléctrica en movimiento?</p>
        <label><input type="radio" name="q14" value="a"> Ley de Gauss</label><br>
        <label><input type="radio" name="q14" value="b"> Ley de Ohm</label><br>
        <label><input type="radio" name="q14" value="c"> Ley de Faraday</label><br>
        <label><input type="radio" name="q14" value="d"> Ley de Lorentz</label>
      </div>
      <div class="question">
        <p>15. ¿Qué tipo de espejos son capaces de formar imágenes reales y virtuales?</p>
        <label><input type="radio" name="q15" value="a"> Espejos convexos</label><br>
        <label><input type="radio" name="q15" value="b"> Espejos planos</label><br>
        <label><input type="radio" name="q15" value="c"> Espejos cóncavos</label><br>
        <label><input type="radio" name="q15" value="d"> Espejos dispersores</label>
      </div>
      <div class="question">
        <p>16. ¿Qué tipo de lente se utiliza para corregir la miopía?</p>
        <label><input type="radio" name="q16" value="a"> Lente convergente</label><br>
        <label><input type="radio" name="q16" value="b"> Lente divergente</label><br>
        <label><input type="radio" name="q16" value="c"> Lente biconvexa</label><br>
        <label><input type="radio" name="q16" value="d"> Lente bicóncava</label>
      </div>
      <div class="question">
        <p>17. ¿Cuál de las siguientes afirmaciones describe mejor el principio de Pascal?</p>
        <label><input type="radio" name="q17" value="a"> La presión aplicada a un fluido se transmite por igual en todas direcciones.</label><br>
        <label><input type="radio" name="q17" value="b"> La presión en un fluido es inversamente proporcional al volumen.</label><br>
        <label><input type="radio" name="q17" value="c"> La presión en un fluido aumenta con la profundidad.</label><br>
        <label><input type="radio" name="q17" value="d"> La presión en un fluido depende solo de la altura del líquido.</label>
      </div>
      <div class="question">
        <p>18. ¿Qué ley física explica la flotación de los cuerpos en un líquido?</p>
        <label><input type="radio" name="q18" value="a"> Ley de Hooke</label><br>
        <label><input type="radio" name="q18" value="b"> Ley de Arquímedes</label><br>
        <label><input type="radio" name="q18" value="c"> Ley de Newton</label><br>
        <label><input type="radio" name="q18" value="d"> Ley de Boyle</label>
      </div>
      <div class="question">
        <p>19. ¿Cuál es la unidad de medida de la capacitancia en el sistema internacional?</p>
        <label><input type="radio" name="q19" value="a"> Ohm (Ω)</label><br>
        <label><input type="radio" name="q19" value="b"> Faradio (F)</label><br>
        <label><input type="radio" name="q19" value="c"> Tesla (T)</label><br>
        <label><input type="radio" name="q19" value="d"> Voltio (V)</label>
      </div>
      <div class="question">
        <p>20. ¿Cuál de los siguientes dispositivos se utiliza para medir la intensidad de corriente eléctrica?</p>
        <label><input type="radio" name="q20" value="a"> Amperímetro</label><br>
        <label><input type="radio" name="q20" value="b"> Voltímetro</label><br>
        <label><input type="radio" name="q20" value="c"> Galvanómetro</label><br>
        <label><input type="radio" name="q20" value="d"> Termómetro</label>
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