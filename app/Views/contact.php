<?php
layouts();

?>


<!DOCTYPE html>
<html lang="es">
    <?php head('Contact') ?>
  <body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
            <?php carrusel() ?>
      <!-- Fin del carousel  -->



      <div>
        <h3 class="programa">Redes Sociales</h3>
        <p class="leader">¡No te olvides de seguirnos en todas nuestras redes sociales para enterarte de 
          todas nuestras actualizaciones y estar en contacto contigo en el momento que lo necesites!
        </p>
<br>        
        <div class="d-flex container-fluid flex-wrap px-2 justify-content-center">
          <div class="card my-2 mx-2" style="width: 21rem;">
            <div class="card-body">
              <h5 class="card-title">Instagram</h5>
              <div class="d-flex justify-content-center my-3">
                <img src="<?php echo routePublic('assets/images/chuchis.jpg') ?>" alt="" height="150">
              </div>
              <a href="https://instagram.com/_ftechnology?igshid=ZDc4ODBmNjlmNQ==" target="_blank"
                class="btn btn-outline-secondary col-12 social-btn" tabindex="-1" role="button" aria-disabled="true">
                <img src="<?php echo routePublic('assets/images/Instagram.png') ?>" alt="" height="30">
              </a>
            </div>
          </div>
          <div class="card my-2 mx-2" style="width: 21rem;">
            <div class="card-body">
              <h5 class="card-title">Facebook</h5>
              <div class="d-flex justify-content-center my-3">
                <img src="<?php echo routePublic('assets/images/mimidosChuchisMichi.jpg') ?>" alt="" height="150">
              </div>
              <a href="" target="_blank"
                class="btn btn-outline-secondary col-12 social-btn" tabindex="-1" role="button" aria-disabled="true">
                <img src="<?php echo routePublic('assets/images/facebook.png') ?>" alt="" height="30">
              </a>
            </div>
          </div>
          <div class="card my-2 mx-2" style="width: 21rem;">
            <div class="card-body">
              <h5 class="card-title">Twitter</h5>
              <div class="d-flex justify-content-center my-3">
                <img src="<?php echo routePublic('assets/images/perritoGato.jpg') ?>" alt="" height="150">
              </div>
              <a href="https://twitter.com/ftechnology495" target="_blank"
                class="btn btn-outline-secondary col-12 social-btn" tabindex="-1" role="button" aria-disabled="true">
                <img src="<?php echo routePublic('assets/images/Twitter.png') ?>" alt="" height="30">
              </a>
            </div>
          </div>
          <div class="card my-2 mx-2" style="width: 21rem;">
            <div class="card-body">
              <h5 class="card-title">Youtube</h5>
              <div class="d-flex justify-content-center my-3">
                <img src="<?Php echo routePublic('assets/images/perrosygatos.jpg') ?>" alt="" height="150">
              </div>
              <a href="https://youtube.com/@FTechnology" target="_blank"
                class="btn btn-outline-secondary col-12 social-btn" tabindex="-1" role="button" aria-disabled="true">
                <img src="<?php echo routePublic('assets/images/youtube.png') ?>" alt="" height="30">
              </a>
            </div>
          </div>
          <div class="card my-2 mx-2" style="width: 21rem;">
            <div class="card-body">
              <h5 class="card-title">Gmail</h5>
              <div class="d-flex justify-content-center my-3">
                <img src="<?php echo routePublic('assets/images/chuchiComiendoseMichi.jpg') ?>" alt="" height="150">
              </div>
              <a href="ftechnology495@gmail.com" target="_blank"
                class="btn btn-outline-secondary col-12 social-btn" tabindex="-1" role="button" aria-disabled="true">
                <img src="<?php echo routePublic('assets/images/correo.png') ?>" alt="" height="30">
              </a>
            </div>
          </div>




      <!-- Inicio del footer -->
        <?php footer(); ?>
      <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




    <?php scripts(); ?>
  </body>
</html>
