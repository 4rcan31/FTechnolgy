<?php

layouts();
?>


<!DOCTYPE html>
<html lang="en">

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
                    <?php pageHending('Croquette'); ?>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <?php 
                            card('Kilo gramos dispensados', '50 kg', 'cat');
                            cardWithGraphic('Comida', 40, 'cookie-bite', 'info');
                            cardWithGraphic('Bateria', 70, 'bolt', 'info');
                            model('CroquetteUserModel')->stateByIdUser(Route::getData()->user->id) ? 
                            card('Conexion', 'Conectado', 'signal', 'success') :
                            card('Conexion', 'Desconectado', 'signal', 'danger');
                            //card('Conexion', 'Desconectado', 'signal', 'danger');
                        ?>
                    </div>



                    <div class="row">
                   
                        <?php 
                            $html = '<form class="form-login" method="POST" action="'.routePublic("api/v1/signal/croquette/sendfood").'">
                            '.TokenCsrf::getInput().'
                            <b><label for="Emal">Cantidad (KG)</label></b>
                                <input class="form-control" type="number" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
                            <br />
                            <button type="submit" class="btn btn-primary">
                               Enviar
                            </button>
                        </form>';
                            card('Dispensar comida en tiempo real', Modal::returnButtonModal('Dispensar'), 'drumstick-bite', 'dark', 1);
                            Modal::create('Dispensar en tiempo real', $html);




                            $html = '<form class="form-login" method="POST" action="'.routePublic("api/v1/signal/croquette/sendfood").'">
                                    '.TokenCsrf::getInput().'
                                    <b><label for="Date">Date</label></b>
                                    <input class="form-control" type="date" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
                                        <br />
                                    <b><label for="hour">Hora</label></b>
                                        <input class="form-control" type="time" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" />
                                    <br />
                                    <button type="submit" class="btn btn-primary">
                                    Enviar
                                    </button>
                                </form>';
                            card('Programar dispensador', Modal::returnButtonModal('Programar'), 'drumstick-bite', 'dark', 1);
                            Modal::create('Programar dispensador', $html);
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