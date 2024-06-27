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
  <title>Examen de Matemáticas</title>
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
            q1: 'c',
            q2: 'b',
            q3: 'd',
            q4: 'a',
            q5: 'd',
            q6: 'a',
            q7: 'c',
            q8: 'b',
            q9: 'a',
            q10: 'c',
            q11: 'a',
            q12: 'a',
            q13: 'c',
            q14: 'b',
            q15: 'b',
            q16: 'a',
            q17: 'c',
            q18: 'b',
            q19: 'd',
            q20: 'b'
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
            q2: 'b',
            q3: 'd',
            q4: 'a',
            q5: 'd',
            q6: 'a',
            q7: 'c',
            q8: 'b',
            q9: 'a',
            q10: 'c',
            q11: 'a',
            q12: 'a',
            q13: 'c',
            q14: 'b',
            q15: 'b',
            q16: 'a',
            q17: 'c',
            q18: 'b',
            q19: 'd',
            q20: 'b'
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
            url: "./php/resultadoMat.php",
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
    <h1>Sección de Matemáticas</h1>
    <form id="exam-form" action="" method="post">
    <div class="question">
    <p>1. ¿Cuál es una solución de la ecuación 2𝑥^2−3x+1=0?</p>
    <label><input type="radio" name="q1" value="a"> x= 1</label><br>
    <label><input type="radio" name="q1" value="b"> x= 1/2</label><br>
    <label><input type="radio" name="q1" value="c"> x= 1/2  x= 1</label><br>
    <label><input type="radio" name="q1" value="d"> x= 2</label>
  </div>
  <div class="question">
    <p>2. ¿Cuál es la solución del sistema de ecuaciones? </p>
    <img src="./img/mat_01.PNG" class="img-right"><br>
    <label><input type="radio" name="q2" value="a"> x=1, y=2</label><br>
    <label><input type="radio" name="q2" value="b"> x=2, y=1</label><br>
    <label><input type="radio" name="q2" value="c"> x=2, y=-1</label><br>
    <label><input type="radio" name="q2" value="d"> x=1, y=-1</label>
  </div>
  <div class="question">
    <p>3. ¿Cuál es la factorización de 𝑥^3−3𝑥^2+3x−1?</p>
    <label><input type="radio" name="q3" value="a"> (x-1)(x^2-1)</label><br>
    <label><input type="radio" name="q3" value="b"> (x+1)^3</label><br>
    <label><input type="radio" name="q3" value="c"> (x+1)(x^2+1)</label><br>
    <label><input type="radio" name="q3" value="d"> (x-1)^3</label>
  </div>
  <div class="question">
    <p>4.¿Cuál es el intervalo de la solución para (2𝑥−5)/(𝑥+3)≤1?</p>
    <label><input type="radio" name="q4" value="a"> x≤1</label><br>
    <label><input type="radio" name="q4" value="b"> x≥1</label><br>
    <label><input type="radio" name="q4" value="c"> x<−3</label><br>
    <label><input type="radio" name="q4" value="d"> x>−3</label>
  </div>
  <div class="question">
    <p>5. Resuelve la ecuación (3/(𝑥+2))+ (2/(𝑥−3))=1.</p>
    <label><input type="radio" name="q5" value="a"> x=1 y x=3</label><br>
    <label><input type="radio" name="q5" value="b"> x=1</label><br>
    <label><input type="radio" name="q5" value="c"> x=-1</label><br>
    <label><input type="radio" name="q5" value="d"> x=1, x=−6</label>
  </div>
  <div class="question">
    <p>6. ¿Cuál es el valor de x en la ecuación 2^x=16?</p>
    <label><input type="radio" name="q6" value="a"> x=2</label><br>
    <label><input type="radio" name="q6" value="b"> x=3</label><br>
    <label><input type="radio" name="q6" value="c"> x=4</label><br>
    <label><input type="radio" name="q6" value="d"> x=5</label>
  </div>  
  <div class="question">
    <p>7. ¿Cuál es el valor de x en la ecuacion log₂(x)=3?</p>
    <label><input type="radio" name="q7" value="a"> x=2</label><br>
    <label><input type="radio" name="q7" value="b"> x=4</label><br>
    <label><input type="radio" name="q7" value="c"> x=8</label><br>
    <label><input type="radio" name="q7" value="d"> x=16</label>
  </div>
  <div class="question">
      <p>8. ¿Cuál es el valor de x en la ecuación x^3-3x+2=0?</p>
      <label><input type="radio" name="q8" value="a"> x=1, x=-2</label><br>
      <label><input type="radio" name="q8" value="b"> x=1, x=2</label><br>
      <label><input type="radio" name="q8" value="c"> x=1, x=-1</label><br>
      <label><input type="radio" name="q8" value="d"> x=-1, x=-2</label>
  </div>
  <div class="question">
      <p>9.  ¿Cuál es la expansión de (x+2)^3?</p>
      <label><input type="radio" name="q9" value="a"> x^3+6x^2+12x+8</label><br>
      <label><input type="radio" name="q9" value="b"> x^3+4x^2+4x+8</label><br>
      <label><input type="radio" name="q9" value="c"> x^3+8x+8</label><br>
      <label><input type="radio" name="q9" value="d"> x^3+3x^2+3x+8</label>
  </div>
  <div class="question">
      <p>10. ¿Cuál es el determinante de la siguiente matriz?</p>
      <img src="./img/mat_02.PNG" class="img-right"><br>
      <label><input type="radio" name="q10" value="a"> 0</label><br>
      <label><input type="radio" name="q10" value="b"> 2</label><br>
      <label><input type="radio" name="q10" value="c"> -2</label><br>
      <label><input type="radio" name="q10" value="d"> 4</label>
  </div>
  <div class="question">
      <p>11. ¿Cuál es la derivada de f(x)=x^3-4x^2+x-7?</p>
      <label><input type="radio" name="q11" value="a"> 3x^2-8x+1</label><br>
      <label><input type="radio" name="q11" value="b"> 3x^2-4x+1</label><br>
      <label><input type="radio" name="q11" value="c"> 3x^2-4</label><br>
      <label><input type="radio" name="q11" value="d"> x^3+4x^2</label>
  </div>
  <div class="question">
      <p>12. ¿Cuál es la integral indefinida de f(2x^2-3x+1)?</p>
      <label><input type="radio" name="q12" value="a"> 2/3x^3-3/2x^2+x+C</input></label><br>
      <label><input type="radio" name="q12" value="b"> 2/3x^3+3/2x^2+x+C</label><br>
      <label><input type="radio" name="q12" value="c"> 2/3x^3-3x+C</label><br>
      <label><input type="radio" name="q12" value="d"> 2/3x^3-3x^2+C</label>
  </div>
  <div class="question">
      <p>13. ¿Cuál es la derivada de f(x)=(3x^2+2x+1)^4?</p>
      <label><input type="radio" name="q13" value="a"> 12x(3x^2+2x+1)^3</label><br>
      <label><input type="radio" name="q13" value="b"> 12x(3x^2+2x+1)^3-8(3x^2+2x+1)^3</label><br>
      <label><input type="radio" name="q13" value="c"> 12x(3x^2+2x+1)^3+8(3x^2+2x+1)^3</label><br>
      <label><input type="radio" name="q13" value="d"> 12x(3x^2+2x+1)^3+4(3x^2+2x+1)^3</label>
  </div>
  <div class="question">
      <p>14. Cuál es el limite de :</p>
      <img src="./img/mat_03.PNG" class="img-right"><br>
      <label><input type="radio" name="q14" value="a"> 0</label><br>
      <label><input type="radio" name="q14" value="b"> 1</label><br>
      <label><input type="radio" name="q14" value="c"> -1</label><br>
      <label><input type="radio" name="q14" value="d"> ∞</label>
  </div>
  <div class="question">
      <p>15. Cuál es el resultado de :</p>
      <img src="./img/mat_04.PNG" class="img-right"><br>
      <label><input type="radio" name="q15" value="a"> xe^-∫e^xdx</label><br>
      <label><input type="radio" name="q15" value="b"> xe^x-e^x+C</label><br>
      <label><input type="radio" name="q15" value="c"> ∫e^xdx</label><br>
      <label><input type="radio" name="q15" value="d"> xe^x+e^x+C</label>
  </div>
  <div class="question">
      <p>16. ¿Cuál es la derivada de f(x)=5x 3−3x2+2x−1?</p>
      <label><input type="radio" name="q16" value="a"> 15x^2-6x+2</label><br>
      <label><input type="radio" name="q16" value="b"> 15x^2-6x</label><br>
      <label><input type="radio" name="q16" value="c"> 15x^2+6x-1</label><br>
      <label><input type="radio" name="q16" value="d"> 10x^2-6x+2</label>
  </div>
  <div class="question">
      <p>17. ¿Cuál es la derivada de f(x)=x^2+2x+1 en x=1?</p>
      <label><input type="radio" name="q17" value="a"> 1</label><br>
      <label><input type="radio" name="q17" value="b"> 2</label><br>
      <label><input type="radio" name="q17" value="c"> 3</label><br>
      <label><input type="radio" name="q17" value="d"> 4</label>
  </div>
  <div class="question">
      <p>18. ¿Cuál es la derivada de la funcion en el punto  x=0?</p>
      <img src="./img/mat_05.PNG" class="img-right"><br>
      <label><input type="radio" name="q18" value="a"> e</label><br>
      <label><input type="radio" name="q18" value="b"> 1</label><br>
      <label><input type="radio" name="q18" value="c"> 0</label><br>
      <label><input type="radio" name="q18" value="d"> ∞</label>
  </div>
  <div class="question">
      <p>19. ¿Cuál es la integral indefinida de ∫3x^2dx?</p>
      <label><input type="radio" name="q19" value="a"> x^3-C</label><br>
      <label><input type="radio" name="q19" value="b"> 3x^3+C</label><br>
      <label><input type="radio" name="q19" value="c"> x^3</label><br>
      <label><input type="radio" name="q19" value="d"> x^3+C</label>
  </div>
  <div class="question">
      <p>20. ¿Cuál es el valor de la derivada de la funcion f(x)=e^x en x=0?</p>
      <label><input type="radio" name="q20" value="a"> e</label><br>
      <label><input type="radio" name="q20" value="b"> 1</label><br>
      <label><input type="radio" name="q20" value="c"> 0</label><br>
      <label><input type="radio" name="q20" value="d"> ∞</label>
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