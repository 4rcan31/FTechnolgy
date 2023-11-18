<?php
$apps = ViewData::get();
$user = Route::getData()->user; 
layouts();
csrf();
?>


<!DOCTYPE html>
<html lang="en">

<?php headPanel('Store') ?>

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
                    <?php pageHending('Tienda'); ?>

                    <!-- Content Row -->

                    <?php ob_start(); ?>
                    <div class="order-form">
                        <div class="row">
                            <div class="col-6">
                                <p>{{ description }}</p>
                                <p>Precio: ${{ price }}</p>
                            </div>
                            <div class="col-6">
                                <img src="{{ image }}" alt="">
                            </div>
                        </div>

                        <h5>Orden de Compra</h5>
                        <form method="POST" action="<?php route('/api/v1/store/buy') ?>/{{ id_producto }}">
                            <?php TokenCsrf::input(); ?>
                            <div class="form-group">
                                <label for="direccion">Dirección de Envío:</label>
                                <textarea id="direccion" name="address" class="form-control" readonly>{{ address }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono:</label>
                                <input type="text" name="phone" class="form-control" readonly value="{{ phone }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo:</label>
                                <input type="text" name="email" class="form-control" readonly value="{{ email }}">
                            </div>
                            <small><b>NOTA: </b>Si deseas cambiar estos datos, debes ir a <a href="<?php route('/panel/profile') ?>">Perfil</a></small>
                            <div class="form-group">
                                <label for="direccion">Mensaje adicional</label>
                                <textarea  name="message" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    <?php 
                    $html = ob_get_clean(); 
                    ?>


                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            foreach ($apps as $app) {
                                $user->address = $user->address ?? "Aun no has llenado tu dirección";
                                $user->phone_number = $user->phone_number ?? "Aun no has llenado tu teléfono";                                
                                $html = str_replace('{{ id_producto }}', $app->id, $html);
                                $html = str_replace('{{ description }}', $app->description, $html);
                                $html = str_replace('{{ image }}', route($app->avatar_rute, false), $html);
                                $html = str_replace('{{ price }}', $app->price, $html);
                                $html = str_replace('{{ phone }}', $user->phone_number, $html);
                                $html = str_replace('{{ email }}', $user->email, $html);
                                $html = str_replace('{{ address }}', $user->address, $html);
                                cardWithText(
                                    $app->name,
                                    substr($app->description, 0, 56) . "...",
                                    'default',
                                    'Ver mas',
                                    [
                                        'title' => $app->name,
                                        'html' => $html,
                                        'buttonSave' => 'Ordenar'
                                    ]
                                );
                            }
                            ?>
                        </div>
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