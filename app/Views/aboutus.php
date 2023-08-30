<?php
layouts();

?>


<!DOCTYPE html>
<html lang="es">
    <?php head('About Us') ?>
  <body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
            <?php carrusel() ?>
      <!-- Fin del carousel  -->

    
        
      <div class="container marketing">



        
        <!-- Inicio de la primera fila -->
        <hr class="divider" />
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">
              Misión
            </h2>
            <p class="lead">
              Crear un elemento de unificación entre las mascotas junto a sus dueños permitiendo un cuidado a distancia de buena calidad.
            </p>
          </div>
          <div class="col-md-5">
            <img src="<?php echo routePublic('assets/images/Distancia.jpg') ?>" alt="" class="img-fluid" width="500" height="500">
          </div>
        </div>
        <!-- Fin de la primera fila -->


        <!-- Inicio de la segunda fila -->
        <hr class="divider" />
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">
              Visión
            </h2>
            <p class="lead">
              Ser una empresa salvadoreña más reconocida en el cuidado de mascotas a distancia.
            </p>
          </div>
          <div class="col-md-5 order-md-1">
            <img src="<?php echo routePublic('assets/images/Trabajo.jpg') ?>" alt="" class="img-fluid" width="500" height="500">
          </div>
        </div>
        <!-- Fin de la segunda fila -->
        
        
        <!-- Primera fila -->
        <div class="row">

          <!-- Primera columna de la primera fila -->
          <hr class="divider" />
          <h3>Nuestro equipo de trabajo</h3> 
          <div class="row featurette">
            <div class="col-lg-4">
              <img src="<?Php echo routePublic('assets/images/Keren_Guerrero.jpg') ?>" alt="" class="rounded-circle" width="140" height="140">
              <h2>Keren Guerrero</h2>
              <p>
                Encargada de Diseño Gráfico
              </p>
            </div>
            <!-- Fin de la primera columna de la primera fila -->
  
  
            <!-- Segunda columna de la primera fila -->
            <div class="col-lg-4">
              <img src="<?php echo routePublic('assets/images/Noé_Molina.jpeg') ?>" alt="" class="rounded-circle" width="140" height="140">
              <h2>Noé Molina  </h2>
              <p>Encargado de Contaduria</p>
            </div>
            <!-- Fin de la segunda columna de la primera fila -->
  
  
            <!-- Inicio de la tercer columna de la primera fila -->
            <div class="col-lg-4">
              <img src="<?php echo routePublic('assets/images/Yara_Linares.jpg') ?>" alt="" class="rounded-circle" width="140" height="140">
              <h2>Yara Linares</h2>
              <p>
                Encargada de Multimedia
              </p>
            </div>
            <!-- Fin de la tercer columna de la primera fila -->
  
          </div>
          <!-- Fin de la primera fila -->
        
          <br>
  
          <!-- Primera fila-Segunda parte -->
          <div class="row">
  
            <!-- Primera columna de la primera fila-Segunda parte -->
              <div class="col-lg-4">
                <img src="<?php echo routePublic('assets/images/Gracia_Mendez.jpg') ?>" alt="" class="rounded-circle" width="140" height="140">
                <h2>Gracia Méndez</h2>
                <p>
                  Encargada de Marketing
                </p>
              </div>
              <!-- Fin de la primera columna de la primera fila- Segunda parte -->
    
    
              <!-- Segunda columna de la primera fila- Segunda parte -->
              <div class="col-lg-4">
                <img src="<?php echo routePublic('assets/images/Gabriela_Mejia.jpg') ?>" alt="" class="rounded-circle" width="140" height="140">
                <h2>Gabriela Mejia</h2>
                <p>
                  Encargada de la Administración Empresarial
                </p>
              </div>
              <!-- Fin de la segunda columna de la primera fila- Segunda parte -->
    
    
              <!-- Inicio de la tercer columna de la primera fila- Segunda parte -->
              <div class="col-lg-4">
                <img src="<?php echo routePublic('assets/images/Judith_Cruz.jpeg') ?>" alt="" class="rounded-circle" width="140" height="140">
                <h2>Judith Palacios</h2>
                <p>
                Encargada de Diseño Gráfico
                </p>
              </div>
              <!-- Fin de la tercer columna de la primera fila- SEgunda parte -->
    
            </div>
            <!-- Fin de la primera fila-Segunda parte -->
  
          <br>
  
        <!-- Primera fila- Tercera parte -->
        <div class="row featurette">
          <div class="row">
  
            <!-- Inicio de la primera columna de la primera fila- Tercera parte -->
      <div class="col-lg-4">
        <img src="<?php echo routePublic('assets/images/Rodrigo_Franco.jpeg') ?>" alt="" class="rounded-circle" width="140" height="140">
        <h2>Rodrigo Franco</h2>
        <p>
        Encargado de Programación
        </p>
      </div>


      <!-- Inicio del footer -->
        <?php footer(); ?>
      <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




    <?php scripts(); ?>
  </body>
</html>
