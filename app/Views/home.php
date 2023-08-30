<?php
layouts();

?>


<!DOCTYPE html>
<html lang="es">
    <?php head('Home') ?>
  <body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
            <?php carrusel() ?>
      <!-- Fin del carousel  -->

    


      
      <div class="container marketing">
          

        <!-- Inicio de la segunda fila -->
        <hr class="divider" />
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">
              ¿Quiénes somos?
              <span class="text-muted">Conoce un poco más acerca de FTechnology</span>
            </h2>
            <p class="lead">
              Somos una empresa dedicada a intervenir en el cuidado básico alimenticio de las mascotas, 
              haciendo uso de tecnología a la vanguardia, permitiendo conectar a los dueños y sus mascotas con nuestro producto. 
            </p>
          </div>
          <div class="col-md-5">
            <img src="<?php echo routePublic('assets/images/Logo.jpg') ?>" alt="" class="img-fluid" width="275" height="275">
          </div>
        </div>
        <!-- Fin de la segunda fila -->




        <!-- Inicio de la tercer fila -->
        <hr class="divider" />
        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">
              Nuestra historia
              <span class="text-muted">A cerca del nacimiento de FT</span>
            </h2>
            <p class="lead">
              Este emprendimiento nació gracias a una idea de solución conjunta que tuvimos a causa de una problemática muy común actualmente. 
              Detectamos en los jóvenes y personas solteras una preocupación en el cuidado de sus mascotas al dejarlas solas, 
              especialmente en su alimentación. Como un grupo de amigos decidimos complementarnos con nuestras habilidades y decidimos encontrar una solución a esa problemática,
              diseñando un producto práctico y útil para nuestros clientes; y así es como nuestras ideas comenzaron a crecer hasta formarse en un emprendimiento con mucho éxito y trayendo una solución.
            </p>
          </div>
          <div class="col-md-5 order-md-1">
            <img src="<?php echo routePublic('assets/images/EjemploDispensador2.jpg') ?>" alt="" class="img-fluid" width="500" height="500">
          </div>
        </div>
        <!-- Fin de la tercer fila -->



        <!-- Inicio de la cuarta fila -->
        <hr class="divider" />
        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">
              Acciones sociales
              <span class="text-muted">De esta maner FTechnology impacta en la sociedad</span>
            </h2>
            <p class="lead">
              A base de medios tecnológicos llevamos a cabo elementos que permiten al dueño conocer las cantidades de comida que su mascota ingiere en un periodo de tiempo determinado, 
              logrando así llevar un control sobre una dieta sana y equilibrada a sus mascotas. Rompiendo una barrera entre distancia y necesidades que este cuidado requería.
            </p>
          </div>
          <div class="col-md-5">
            <img src="<?php echo routePublic('assets/images/EjemploDispensador5.jpg') ?>" alt="" class="img-fluid" width="500" height="500">
          </div>
        </div>
        <hr class="divider" />
      </div>
      <!-- Fin de la cuarta fila -->



      <!-- Inicio del footer -->
        <?php footer(); ?>
      <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




    <?php scripts(); ?>
  </body>
</html>
