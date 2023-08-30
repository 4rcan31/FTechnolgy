<?php
layouts();
?>


<!DOCTYPE html>
<html lang="es">
<?php head('Login') ?>

<body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>


        <div class="container marketing">
            <!-- Primera fila -->
            <div class="row">
                <form class="form-login">
                    <b><label for="Emal">Usuario</label></b>
                    <input class="form-control" type="text" name="User" id="User" placeholder="Enter your username" />
                    <br />
                    <b><label for="Emal">Contraseña</label></b>
                    <input class="form-control" type="text" name="Password" id="Password" placeholder="Enter your Password" />
                    <br />
                    <label for="register">Si no tienes cuenta,
                        <a href="<?Php route('/register') ?>">registrate</a></label>
                    <br /><br />
                    <button type="submit" class="btn btn-secondary">
                        Iniciar sesión
                    </button>
                </form>
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