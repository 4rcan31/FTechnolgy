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
                <form class="form-register">
                    <b><label for="Emal">Email</label></b>
                    <input class="form-control" type="text" name="Email" id="Email" placeholder="Enter your Email" />
                    <br />
                    <b><label for="Emal">Usuario</label></b>
                    <input class="form-control" type="text" name="User" id="User" placeholder="Enter your username" />
                    <br />
                    <b><label for="Emal">Contraseña</label></b>
                    <input class="form-control" type="text" name="Password" id="Password" placeholder="Enter your Password" />
                    <br />
                    <b><label for="Emal">Confirma tu contraseña</label></b>
                    <input class="form-control" type="text" name="PasswordConfirm" id="PasswordComfirm" placeholder="Enter your Password" />
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