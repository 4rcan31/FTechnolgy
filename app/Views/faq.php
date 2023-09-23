<?php
layouts();
$faqs = ViewData::get();
ViewData::unsetData();
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
              <?php foreach($faqs as $faq): ?>
                <div class="card faq-card">
                    <div class="card-header">
                     <?php echo $faq->id ?>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $faq->question ?></h5>
                        </p>
                        <p class="card-text"><?php echo $faq->answer ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
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
