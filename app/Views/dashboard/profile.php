<?php
$profiles = ViewData::get();
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
                                    <?php cardWithText("Avatar", '<img src="'.$profiles->user->avatar_serve . $profiles->user->avatar_rute.'" alt="" height="168px">', 'default', 'Editar', [
                                        'title' => "Editar Avatar",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profiles->user->id . '/' . "avatar", false) . '" method="POST" enctype="multipart/form-data">
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
                                    <?php cardWithText("Email", $profiles->user->email) ?>
                                    <?php cardWithText("Nombre", $profiles->user->name, 'default', 'Editar', [
                                        'title' => "Editar nombre",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profiles->user->id . '/' . "name", false) . '" method="POST">
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
                                    <?php cardWithText('Username', $profiles->user->user) ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText("Creacion de cuenta", $profiles->user->created_at) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText("Telefono", $profiles->user->phone_number, 'default', 'Editar', [
                                        'title' => "Editar nombre",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profiles->user->id . '/' . "phone", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Nuevo Telefono</label>
                                                        <input type="text" class="form-control" id="newName" name="phone_number">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]); ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <?php cardWithText("Direccion", $profiles->user->address, 'default', 'Editar', [
                                        'title' => "Editar nombre",
                                        'html' => '<form action="' . route('api/v1/auth/edit/profile/' . $profiles->user->id . '/' . "address", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Nueva direccion</label>
                                                        <textarea id="address" name="address" class="form-control" name="address" required></textarea>
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]); ?>
                                </div>
                            </div>

                        </div>


                        <!-- Perfil de mascota -->
                        <div class="col-lg-6">
                        <?php pageHending('Perfil Mascota'); ?>
                            <div class="row">
                                <div class="col-lg-4">
                                    <?php cardWithText("Avatar", '<img src="'.$profiles->pet->avatar.'" alt="" height="168px">', 'default', 'Editar', [
                                        'title' => "Editar Avatar de mascota",
                                        'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "avatar", false) . '" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Elige una imagen</label>
                                                        <input type="file" class="form-control" name="avatar">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Guardar'
                                    ]) ?>
                                </div>
                                <div class="col-lg-8">
                                    <?php cardWithText("Nombre", $profiles->pet->name, 'default', 'Editar', [
                                        'title' => "Editar nombre de la mascota",
                                        'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "name", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newName">Nuevo nombre</label>
                                                        <input type="text" class="form-control" id="newName" name="name">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]) ?>
                                   <?php cardWithText('Edad', $profiles->pet->age) ?>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Peso", $profiles->pet->weight, 'default', 'Editar', [
                                    'title' => "Editar peso de la mascota",
                                    'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "weight", false) . '" method="POST">
                                                <div class="form-group">
                                                    '.TokenCsrf::getInput().'
                                                    <label for="newWeight">Nueva fecha de nacimiento</label>
                                                    <input type="number" class="form-control" id="newWeight" name="weight">
                                                </div>
                                            </form>',
                                    'buttonSave' => 'Editar'
                                ]) ?>
                                </div>
                            </div>

            
                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Especie", $profiles->pet->specie, 'default', 'Editar', [
                                            'title' => "Editar especie de la mascota",
                                            'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "species", false) . '" method="POST">
                                                        <div class="form-group">
                                                            '.TokenCsrf::getInput().'
                                                            <label for="newSpecies">Nueva especie</label>
                                                            <input type="text" class="form-control" id="newSpecies" name="species">
                                                        </div>
                                                    </form>',
                                            'buttonSave' => 'Editar'
                                        ]) ?>
                                </div>
                            </div>

                            


                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Género", $profiles->pet->gender, 'default', 'Editar', [
                                        'title' => "Editar género de la mascota",
                                        'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "gender", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newGender">Nuevo género</label>
                                                        <select class="form-control" id="newGender" name="gender">
                                                            ' . $profiles->pet->genderSelectOptions . '
                                                        </select>
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]) ?>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Raza", $profiles->pet->breed, 'default', 'Editar', [
                                        'title' => "Editar raza de la mascota",
                                        'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "breed", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newBreed">Nueva raza</label>
                                                        <input type="text" class="form-control" id="newBreed" name="breed">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Color", $profiles->pet->color, 'default', 'Editar', [
                                        'title' => "Editar color de la mascota",
                                        'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "color", false) . '" method="POST">
                                                    <div class="form-group">
                                                        '.TokenCsrf::getInput().'
                                                        <label for="newColor">Nuevo color</label>
                                                        <input type="text" class="form-control" id="newColor" name="color">
                                                    </div>
                                                </form>',
                                        'buttonSave' => 'Editar'
                                    ]) ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                <?php cardWithText("Fecha de Nacimiento", $profiles->pet->birthdate, 'default', 'Editar', [
                                    'title' => "Editar fecha de nacimiento de la mascota",
                                    'html' => '<form action="' . route('api/v1/auth/edit/pet/' . $profiles->user->id . '/' . "birthdate", false) . '" method="POST">
                                                <div class="form-group">
                                                    '.TokenCsrf::getInput().'
                                                    <label for="newBirthdate">Nueva fecha de nacimiento</label>
                                                    <input type="date" class="form-control" id="newBirthdate" name="birthdate">
                                                </div>
                                            </form>',
                                    'buttonSave' => 'Editar'
                                ]) ?>
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