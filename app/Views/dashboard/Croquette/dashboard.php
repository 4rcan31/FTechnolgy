<?php
$token = ViewData::get()['token'];
layouts();
?>


<!DOCTYPE html>
<html lang="en">

<?php ob_start() ?>
<form class="form-login" method="POST" action="<?php route('api/v1/signal/croquette/sendfood') ?>">
    <?php TokenCsrf::input() ?>
    <b><label for="Emal">Cantidad (KG)</label></b>
    <input class="form-control" type="number" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
    <input  type="text" name="tokenCroquette" value="{{ token_croquette }}" hidden/>
    <br />
</form>
<?php $amount = ob_get_clean(); ?>

<?php ob_start() ?>

<form class="form-login" method="POST" action="">
    <?php TokenCsrf::input() ?>
    <b><label for="Date">Date</label></b>
    <input class="form-control" type="date" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
    <br />
    <b><label for="hour">Hora</label></b>
    <input class="form-control" type="time" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
    <input  type="text" name="tokenCroquette" value="{{ token_croquette }}" hidden/>
    <br />
</form>

<?Php $ProgramingModal = ob_get_clean() ?>

<?php headPanel('Croquette - Home') ?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php sidebar(); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php topBar(); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php pageHending('Croquette: '.substr($token, 0, 5), false, 'Desconectar y desanclar'); ?>

                    <!-- Content Row -->
                    <div class="row">

                        <?php
                        card('Kilo gramos dispensados', '50 kg', 'cat');
                        cardWithGraphic('Comida', 40, 'cookie-bite', 'info');
                        cardWithGraphic('Bateria', 70, 'bolt', 'info');
                        model('CroquetteUserModel')->stateByIdUser(Route::getData()->user->id) ?
                            card('Conexion', 'Conectado', 'signal', 'success') :
                            card('Conexion', 'Desconectado', 'signal', 'danger');
                        ?>
                    </div>

                    <div class="row">

                        <?php
                        card('Dispensar comida en tiempo real', Modal::returnButtonModal('Dispensar'), 'drumstick-bite', 'dark', 1);
                        Modal::create('Dispensar en tiempo real', $amount, "Enviar");
                        card('Programar dispensador', Modal::returnButtonModal('Programar'), 'drumstick-bite', 'dark', 1);
                        Modal::create('Programar dispensador', $ProgramingModal, 'Enviar');
                        ?>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php footerPanel(); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php scrollToTopButton() ?>

    <!-- Logout Modal-->
    <?php modalLogout() ?>

    <?php scriptsPanel() ?>
</body>

</html>