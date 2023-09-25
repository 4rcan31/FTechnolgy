<?php
layouts();
$data = ViewData::get();
ViewData::unsetData();
?>


<!DOCTYPE html>
<html lang="en">

<?php headPanel('Estados servidor - Ftecnology') ?>

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
                    <?php pageHending('Estados de servidores y clientes'); ?>

                    <!-- Content Row -->
                    <div class="row">
                        <?php 

                        // Client Croquette
                        if(!$data->client_user_holds_client_croquette){
                            card('Client Croquette : ' . $data->messages->client_user_holds_client_croquette, 'Desconectado', 'signal', 'danger', 1);
                        }else{
                            $data->client_croquette ? 
                            card('Client Croquette : ' . $data->messages->client_croquette, 'Conectado', 'signal', 'success', 1) : 
                            card('Client Croquette : ' . $data->messages->client_croquette, 'Desconectado', 'signal', 'danger', 1);
                        }


                        // Client User
                        $data->client_user ? 
                        card('Client User : ' . $data->messages->client_user, 'Conectado', 'signal', 'success', 1) : 
                        card('Client User : ' . $data->messages->client_user, 'Desconectado', 'signal', 'danger', 1);

                        // Server Croquette
                        $data->server_croquette ? 
                        card('Server Croquette : ' . $data->messages->server_croquette, 'Conectado', 'signal', 'success', 1) : 
                        card('Server Croquette : ' . $data->messages->server_croquette, 'Desconectado', 'signal', 'danger', 1);

                        // Server App
                        $data->server_app ? 
                        card('Server App : ' . $data->messages->server_app, 'Conectado', 'signal', 'success', 1) : 
                        card('Server App : ' . $data->messages->server_app, 'Desconectado', 'signal', 'danger', 1);
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