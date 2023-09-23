<?php
layouts();
$apps = ViewData::get();
ViewData::unsetData();
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

 
        <?php foreach($apps as $app):  ?>
          <div class="card" >
            <img
              src="<?php echo routePublic($app->avatar_rute) ?>"
              class="img-card-store"
            />
            <div class="card-body">
              <h5 class="card-title"><?php echo $app->name ?></h5>
              <p class="card-text">
                <?php echo  substr($app->description, 0, 56)."..."; ?>
              </p>
              <a href="<?php route('/see/'.$app->id) ?>" class="btn btn-primary">Leer mas</a>
            </div>
          </div>
          <?php endforeach; ?>


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
