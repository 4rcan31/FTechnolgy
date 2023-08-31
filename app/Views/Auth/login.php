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
                <form class="form-login" method="POST" action="<?php route('/api/v1/auth/login') ?>">
                    <?php TokenCsrf::input(); ?>
                    <b><label for="Emal">Email</label></b>
                    <input class="form-control" type="text" name="email" id="User" placeholder="Enter your email" />
                    <br />
                    <b><label for="Emal">Contraseña</label></b>
                    <input class="form-control" type="password" name="password" id="Password" placeholder="Enter your Password" />
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

<?php 
NotifierPHP::print(); 
NotifierPHP::setValuesInputs();
NotifierPHP::destroyData();
?>