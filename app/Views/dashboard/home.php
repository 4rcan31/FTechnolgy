<?php

layouts();
?>


<!DOCTYPE html>
<html lang="en">

<?php headPanel('Home') ?>

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
                    <?php pageHending('Apps conectadas', true, 'reporte'); ?>

                    <!-- Content Row -->
                    <div class="row">
                        <?php 
                        //prettyPrint(Route::getData()->croquettes);
                        if(empty(objectToArray(Route::getData()->apps))){
                            card('Ninguna app conectada', 'Hola '.Route::getData()->user->name.", aun no tienes ninguna app conectada a FTecnology", 'paw', 'warning', 1);
                        }else{
                            foreach(Route::getData()->apps as $app){
                                card($app->name, $app->name, 'paw', 'info', 1);
                            }
                        }
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