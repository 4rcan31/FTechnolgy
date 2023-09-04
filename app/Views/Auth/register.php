<?php
layouts();
csrf();
NotifierPHP();
?>


<!DOCTYPE html>
<html lang="es">
<?php head('Register') ?>
<body>
    <?php headerhtml() ?>
    <!-- Inicio de todo el contenido de la app -->
    <main>

        <div class="container marketing">
            <!-- Primera fila -->
            <div class="row">
                <form class="form-register" method="POST" action="<?php route('/api/v1/auth/register') ?>">
                    <?php TokenCsrf::input(); ?>
                    <b><label for="Emal">Email</label></b>
                    <input class="form-control" type="text" name="email" id="Email" placeholder="Enter your Email" />
                    <br />
                    <b><label for="Emal">Nombre</label></b>
                    <input class="form-control" type="text" name="name" id="Name" placeholder="Enter your name" />
                    <br />
                    <b><label for="Emal">Usuario</label></b>
                    <input class="form-control" type="text" name="user" id="User" placeholder="Enter your username" />
                    <br />
                    <b><label for="Emal">Contraseña</label></b>
                    <input class="form-control" type="password" name="password" id="Password" placeholder="Enter your Password" />
                    <br />
                    <b><label for="Emal">Confirma tu contraseña</label></b>
                    <input class="form-control" type="password" name="PasswordConfirm" id="PasswordComfirm" placeholder="Enter your Password" />
                    <br />
                    <label for="register">Si ya tienes cuenta,
                        <a href="<?php route('/login') ?>">inicia sesión</a></label>
                    <br /><br />
                    <button type="submit" class="btn btn-secondary">Registrarse</button>
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
