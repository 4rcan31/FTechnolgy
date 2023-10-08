<?php
$faqs = ViewData::get(); 
//prettyPrint($faqs);
layouts();
?>


<!DOCTYPE html>
<html lang="en">

<?php headPanel('FAQ') ?>

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
                    <?php pageHending('Preguntas frecuentes'); ?>

                    <!-- Content Row -->
                    <div class="row">
                            <?php
                                foreach($faqs as $faq){
                                    card( 
                                    $faq->question,
                                    $faq->answer." $faq->create_at", 
                                    'question', 'primary', 1);
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