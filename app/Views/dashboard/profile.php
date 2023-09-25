<?php
$profile = ViewData::get();
layouts();
csrf();
?>


<!DOCTYPE html>
<html lang="en">

<?php headPanel('Profile') ?>

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

                    <div class="row">


                        <!-- Perfil de usuario -->
                        <div class="col-lg-6 border-right">
                        <?php pageHending('Perfil Usuario'); ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php cardWithText("Avatar", '<img src="'.$profile->avatar_serve . $profile->avatar_rute.'" alt="" height="168px">', 'default', 'Editar', [
                                        'title' => "Editar Avatar",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profile->id . '/' . "avatar", false) . '" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Elige una imagen</label>
                                                        <input type="file" class="form-control" name="avatar">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]) ?>
                                </div>
                                <div class="col-lg-8">
                                    <?php cardWithText("Email", $profile->email) ?>
                                    <?php cardWithText("Nombre", $profile->name, 'default', 'Editar', [
                                        'title' => "Editar nombre",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profile->id . '/' . "name", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Nuevo nombre</label>
                                                        <input type="text" class="form-control" id="newName" name="name">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]); ?>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText('Username', $profile->user) ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText("Creacion de cuenta", $profile->created_at) ?>
                                </div>
                            </div>
                        </div>


                        <!-- Perfil de mascota -->
                        <div class="col-lg-6">
                        <?php pageHending('Perfil Mascota'); ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php cardWithText("Avatar", '<img src="'.$profile->avatar_serve . $profile->avatar_rute.'" alt="" height="168px">') ?>
                                </div>
                                <div class="col-lg-8">
                                    <?php cardWithText("Email", $profile->email) ?>
                                    <?php cardWithText("Nombre", $profile->name) ?>
                                </div>
                            </div>
            
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText('Username', $profile->user) ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText("Creacion de cuenta", $profile->created_at) ?>
                                </div>
                            </div>
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