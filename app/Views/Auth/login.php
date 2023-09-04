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
                    <?php 
                        TokenCsrf::input(); 
                        NotifierPHP::addInput('email', 'text', 'Email', 'form-control', 'Escribe tu email');
                        NotifierPHP::addInput('password', 'password', 'Contraseña', 'form-control', 'Escribe tu contraseña');
                        NotifierPHP::PrintInputs();
                    ?>
                      <label for="register">Si no tienes cuenta,
                        <a href="<?php route('/register') ?>">registrate</a></label> <br><br>
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

