<?php
layouts();
?>


<!DOCTYPE html>
<html lang="es">
<?php head('Product - ') ?>
<body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>
        <!-- Inicio del carousel  -->
        <?php carrusel() ?>
        <!-- Fin del carousel  -->


        <div class="container marketing">
            <!-- Inicio de la primer fila -->
            <hr class="divider" />
            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading">Croquette</h2>
                    <p class="lead">
                        Croquette o Croquette Control es un dispensador de comida para
                        mascotas, el cual permite al dueño brindar un cuidado alimenticio
                        personalizado a través de una aplicación
                    </p>
                </div>
                <div class="col-md-5">
                    <img  src="<?php echo routePublic('assets/images/GatoDeHecho.png') ?>" alt="" class="img-fluid" width="350" height="350" />
                </div>
            </div>
            <hr class="divider" />
        </div>
        <!-- Fin de la primer fila -->




        <!-- Inicio del footer -->
        <?php footer(); ?>
        <!-- Fin del footer -->



    </main>
    <!-- Fin de todo el contenido de la app -->




    <?php scripts(); ?>
</body>

</html>