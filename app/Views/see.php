<?php
layouts();
$app = ViewData::get();
ViewData::unsetData();
?>


<!DOCTYPE html>
<html lang="es">
<?php head('Product - '.$app->name) ?>
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
                    <h2 class="featurette-heading"><?php echo $app->name ?></h2>
                    <p class="lead">
                        <?php echo $app->description ?>
                    </p>
                </div>
                <div class="col-md-5">
                    <img  src="<?php echo routePublic($app->avatar_rute) ?>" alt="" class="img-fluid" width="350" height="350" />
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