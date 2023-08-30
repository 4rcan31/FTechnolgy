<?php
layouts();

?>


<!DOCTYPE html>
<html lang="es">
    <?php head('FAQ') ?>
  <body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
            <?php carrusel() ?>
      <!-- Fin del carousel  -->

    
            <!-- Primera fila -->
            <div class="row">
            <div class="col-12">



                <div class="card faq-card">
                    <div class="card-header">
                      1
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">¿Tengo algún tipo de garantía en la reparación del  producto?</h5>
                        </p>
                        <p class="card-text">Sí, tu reparación tiene una garantía de 6 meses siempre y cuando la falla que se presente sea de fabrica.</p>
                    </div>
                </div>



                <div class="card faq-card">
                    <div class="card-header">
                      2
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">¿Qué tipo de comida se puede poner en el dispensador?</h5>
                      <p class="card-text">Este dispensador está hecho para comida seca o croquetas para animal.</p>
                    </div>
                </div>

                <div class="card faq-card">
                    <div class="card-header">
                      3
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">¿Qué hacer si el dispensador falla? </h5>
                      <p class="card-text">Lo primero es revisar el manual de instrucciones, dónde podrás encontrar el problema y la posible solución, alguna de las causas puede ser que se atasco la comida, polvo en el mecanismo interno, etc. Si el problema persiste o no encuentras la solución llama al soporte técnico, al vendedor para una revisión y un posible cambio.</p>
                    </div>
                </div>


                <div class="card faq-card">
                    <div class="card-header">
                      4
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">¿El dispensador de comida se puede utilizar con cualquier mascota?</h5>
                      <p class="card-text">Por el momento solo es disponible y recomendable utilizarlos solo en perros y gatos.</p>
                    </div>
                </div>


                <div class="card faq-card">
                    <div class="card-header">
                      5
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">¿De qué material esta hecho el dispensador?</h5>
                      <p class="card-text">El dispensador esta compuesto por la carcaza que viene siendo de plastico resistente eco-amigable y el interior del plato es conformado por aluminio, para facilitar su limpieza.</p>
                    </div>
                </div>


                <div class="card faq-card">
                  <div class="card-header">
                    6
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">¿Cómo descargo la aplicación?</h5>
                    <p class="card-text">Puedes encontrar nuestra aplicación de manejo del dipensador en la Play Store.</p>
                  </div>
              </div>


                  
            </div>
        </div>
          <!-- Fin de la tercer columna de la primera fila -->


        </div>
        <!-- Fin de la primera fila -->



      <!-- Inicio del footer -->
        <?php footer(); ?>
      <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




   <?php scripts(); ?>
  </body>
</html>
