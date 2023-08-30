<?php
layouts();
/* Esto es solamente para prueba*/
$idProdcut = 2;
?>


<!DOCTYPE html>
<html lang="es">
    <?php head('Store') ?>
  <body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
            <?php carrusel() ?>
      <!-- Fin del carousel  -->

    
      <div class="container marketing">
        <!-- Primera fila -->
        <div class="row">
          <div class="card">
            <img
              src="<?php echo routePublic('assets/images/GatoDeHecho.png') ?>"
              class="img-card-store"
            />
            <div class="card-body">
              <h5 class="card-title">Croquette</h5>
              <p class="card-text">
                Croquette o Croquette Control es un dispensador de comid....
              </p>
              <a href="<?php route('/see/'.$idProdcut) ?>" class="btn btn-primary">ir a ver</a>
            </div>
          </div>
        </div>
        <!-- Fin de la primera fila -->
      </div>




      <!-- Inicio del footer -->
        <?php footer(); ?>
      <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




    <?php scripts(); ?>
  </body>
</html>
