<?php
$croquette = ViewData::get();
layouts();
?>


<!DOCTYPE html>
<html lang="en">

<?php ob_start() ?>
<form class="form-login" method="POST" action="<?php route('api/v1/signal/croquette/sendfood') ?>">
    <?php TokenCsrf::input() ?>
    <b><label for="Email">Cantidad (KG)</label></b>
    <input class="form-control" type="text" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
    <input type="text" name="tokenCroquette" value="{{ token_croquette }}" hidden />
    <br />
</form>
<?php $sendFoodWithQuantityForm = ob_get_clean(); ?>

<?php ob_start() ?>
<form class="form-login" method="POST" action="<?php route('api/v1/signal/croquette/schedulequantity') ?>">
    <?php TokenCsrf::input() ?>
    <b><label for="Date">Fecha</label></b>
    <input class="form-control" type="date" name="fecha" id="User" placeholder="Ingresa la fecha" />
    <br />
    <b><label for="Hour">Hora</label></b>
    <input class="form-control" type="time" name="hora" id="User" placeholder="Ingresa la hora" />
    <input type="text" name="tokenCroquette" value="{{ token_croquette }}" hidden />
    <br />
    <b><label for="Email">Cantidad (KG)</label></b>
    <input class="form-control" type="text" name="cantidad" id="User" placeholder="Ingresa la cantidad en kg" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
    <br />
</form>
<?php $setDateForSendFoodForm = ob_get_clean() ?>


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
                    <?php pageHending('Croquette: ' . substr($croquette->token, 0, 5), false, 'Desconectar y desanclar'); ?>

                    <!-- Content Row -->
                    <div class="row">

                        <?php

                        card('Kilo gramos dispensados', '50 kg', 'cat');
                        cardWithGraphic('Comida', 40, 'cookie-bite', 'info');
                        cardWithGraphic('Bateria', 70, 'bolt', 'info');
                        $croquette->state ? 
                        card('Conexion', 'Conectado', 'signal', 'success') :
                        card('Conexion', 'Desconectado', 'signal', 'danger');
                        ?>
                    </div>

                    <div class="row">

                        <?php
                        $sendFoodWithQuantityForm = str_replace('{{ token_croquette }}', $croquette->token, $sendFoodWithQuantityForm);
                        $setDateForSendFoodForm = str_replace('{{ token_croquette }}', $croquette->token, $setDateForSendFoodForm);

                        card('Dispensar comida en tiempo real', Modal::returnButtonModal('Dispensar'), 'drumstick-bite', 'dark', 1);
                        Modal::create('Dispensar en tiempo real', $sendFoodWithQuantityForm, "Enviar");
                        card('Programar dispensador', Modal::returnButtonModal('Programar'), 'drumstick-bite', 'dark', 1);
                        Modal::create('Programar dispensador', $setDateForSendFoodForm, 'Enviar');
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <ul class="list-group" id="response">

                            </ul>
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

    <script>
        const currentUrl = window.location.search;
        const badResponse = "¡Algo salió mal! Comprueba la conexión de tu croquette en las cartas de arriba";
        if (currentUrl.includes("?")) {
            const searchParams = new URLSearchParams(currentUrl);
            let messageResponse = searchParams.get('message');
           // Decodificar la cadena en base64 y especificar la codificación de caracteres UTF-8
            messageResponse = messageResponse ? decodeURIComponent(escape(atob(messageResponse))) : badResponse;


            let typeResponse = searchParams.get('status');
            typeResponse = (typeResponse !== 'ok' || messageResponse === badResponse) ? 'danger' : 'success';

            const ul = document.getElementById("response");
            const html = `<li class="list-group-item list-group-item-${typeResponse} mb-4">${messageResponse}</li>`;
            ul.innerHTML = html;
        }
    </script>



</body>

</html>