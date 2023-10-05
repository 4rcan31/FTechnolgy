<?php
/* 
    Nota: 
    para poner pendientes se puede hacer de esta manera:
                         <td>
            <span class="badge text-white bg-warning">Pendiente</span>
                                            </td>
                     <td>
                                                <span class="badge bg-success text-white">Completado</span>
                                            </td>
*/
$orders = ViewData::get();
layouts();
$defultpendiente = 'Pendiente';

/* 

    Notas a hacer:
    - Hacer que cuando el Estado de Orden este en "Entregado" no se pueda cancelar la orden
    - El estado de orden puede tener
        - Cancelado (significa que el usuario cancelo su orden)
        - Pendiente (la orden o entrega aun no se ha hecho)
        - Entregado (la orden ya fue entregada)
    - El Estado de pago puede tener
        - Cancelado (El usuario cancelo su orden)
        - Pendiente (El pago aun no se ha hecho en efectivo)
        - Pagado (El pago ya se hizo y se entrego el producto)
*/


function getStateClass($stateDB){
    $classMap = [
        'Pendiente' => 'warning',
        'Completo' => 'success',
        'Cancelado' => 'danger',
        'Entregado' => 'success'
    ];
    return isset($classMap[$stateDB]) ? $classMap[$stateDB] : '';
}

?>
<?php ob_start(); ?>

<form>
    <?php TokenCsrf::input(); ?>
    <div class="form-group">
        <label for="product">Producto:</label>
        <input type="text" name="product" class="form-control" readonly value="{{ product }}">
    </div>
    <div class="form-group">
        <label for="address">Dirección:</label>
        <textarea id="address" name="address" class="form-control" readonly>{{ address }}</textarea>
    </div>
    <div class="form-group">
        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" class="form-control" readonly value="{{ phone }}">
    </div>
    <div class="form-group">
        <label for="phone">Correo:</label>
        <input type="text" name="email" class="form-control" readonly value="{{ email }}">
    </div>
    <div class="form-group">
        <label for="tracker_code">Número de seguimiento:</label>
        <input type="text" name="tracker_code" class="form-control" readonly value="{{ trackerCode }}">
    </div>
    <div class="form-group">
        <label for="payment_method">Método de pago:</label>
        <input type="text" name="payment_method" class="form-control" readonly value="{{ payment_method }}">
    </div>
    <div class="form-group">
        <label for="shipping_date">Fecha de envío:</label>
        <input type="text" name="shipping_date" class="form-control" readonly value="{{ shipping_date }}">
    </div>
    <div class="form-group">
        <label for="payment_status">Fecha de entrega:</label>
        <input type="text" name="payment_status" class="form-control" readonly value="{{ delivery_date }}">
    </div>
    <div class="form-group">
        <label for="order_status">Estado de orden:</label>
        <input type="text" name="order_status" class="form-control" readonly value="{{ order_status }}">
    </div>
    <div class="form-group">
        <label for="payment_status">Estado de pago:</label>
        <input type="text" name="payment_status" class="form-control" readonly value="{{ payment_status }}">
    </div>
    <div class="form-group">
        <label for="notes">Nota del pedido:</label>
        <textarea name="notes" class="form-control" readonly>{{ notes }}</textarea>
    </div>
    <div class="form-group">
        <label for="comentsCeo">Comentarios del CEO:</label>
        <ul class="list-group">
            {{ commets_CEO }}
        </ul>
    </div>
</form>

<?php $modalTemplateSeeAll = ob_get_clean(); ?>

<?php ob_start(); ?>
<h4>¿Está seguro de que desea cancelar su pedido? Esta acción es irreversible.</h4>
<h5>Información de su pedido:</h5>
<form  action="<?php route('/api/v1/store/cancel') ?>/{{ id_order }}" method="POST">
    <?php TokenCsrf::input(); ?>
    <div class="form-group">
        <label for="product">Producto:</label>
        <input type="text" id="product" name="product" class="form-control" readonly value="{{ product }}">
    </div>
    <div class="form-group">
        <label for="tracker_code">Número de seguimiento:</label>
        <input type="text" id="tracker_code" name="tracker_code" class="form-control" readonly value="{{ trackerCode }}">
    </div>
    <div class="form-group">
        <label for="shipping_date">Fecha de envío:</label>
        <input type="text" id="shipping_date" name="shipping_date" class="form-control" readonly value="{{ shipping_date }}">
    </div>
    <div class="form-group">
        <label for="delivery_date">Fecha de entrega:</label>
        <input type="text" id="delivery_date" name="delivery_date" class="form-control" readonly value="{{ delivery_date }}">
    </div>
    <div class="form-group">
        <label for="order_status">Estado de orden:</label>
        <input type="text" id="order_status" name="order_status" class="form-control" readonly value="{{ order_status }}">
    </div>
    <div class="form-group">
        <label for="payment_status">Estado de pago:</label>
        <input type="text" id="payment_status" name="payment_status" class="form-control" readonly value="{{ payment_status }}">
    </div>
</form>

<?php $modalTemplateCancelOrder = ob_get_clean(); ?>

<!DOCTYPE html>
<html lang="en">

<?php headPanel('Ordenes de compra') ?>



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
                    <?php pageHending('Ordenes de compra'); ?>
                    <style>
                        /* Estilo personalizado para el badge */
                        .badge {
                            font-size: inherit;
                            /* Tamaño de fuente igual al del elemento contenedor */
                        }
                    </style>
                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabla de ordenes</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>N</th>
                                            <th>Producto</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Numero de seguimiento</th>
                                            <th>Método de pago</th>
                                            <th>Fecha de envío</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Estado de orden</th>
                                            <th>Estado de pago</th>
                                            <th>Informacion</th>
                                            <th>Cancelar</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>N</th>
                                            <th>Producto</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Numero de seguimiento</th>
                                            <th>Método de pago</th>
                                            <th>Fecha de envío</th>
                                            <th>Fecha de Entrega</th>
                                            <th>Estado de orden</th>
                                            <th>Estado de pago</th>
                                            <th>Informacion</th>
                                            <th>Cancelar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                        <!-- 
                                        Quitare de la tabla cosas que no van a cambiar como:
                                        email
                                        Fecha de orden


                                     -->
                                        <?php foreach ($orders as $n => $order) : ?>
                                            <tr>
                                                <td><?php echo $n + 1 ?></td>
                                                <td><?php echo $order->product->name ?></td>
                                                <td><?php echo $order->address ?></td>
                                                <td><?php echo $order->phone ?></td>
                                                <td><?php echo $order->tracking_number ?></td>
                                                <td><?php echo $order->payment_method ?></td>
                                                <td><?php echo $order->shipping_date ?></td>
                                                <td><?php echo $order->delivery_date ?></td>
                                                <td>
                                                    <span class="badge text-white bg-<?php echo getStateClass( $order->order_status) ?>">
                                                        <?php echo $order->order_status ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge text-white bg-<?php echo getStateClass($order->payment_status) ?>">
                                                        <?php echo $order->payment_status ?>
                                                    </span>
                                                <td>
                                                    <?php
                                                    Modal::returnButtonModal(
                                                        null,
                                                        '<button type="button" class="btn btn-primary">Ver todo</button>',
                                                        true
                                                    );
/* 
                                                    $comentariosStatic = [
                                                        "Su pedido ya va en camino",
                                                        'Tenemos un problema con su pedido, contáctenos',
                                                        'Su pedido se entregó pero no se le encontró en casa'
                                                    ]; */

                                                    $comentariosHtml = empty((array)$order->commets) ?
                                                    "El CEO no ha hecho ningún comentario" :
                                                    '<li class="list-group-item">' . implode('</li><li class="list-group-item">', (array)$order->commets) . '</li>';
                                                

                                                    $modalContentSeeAllClone = $modalTemplateSeeAll;
                                                    $modalContentSeeAllClone = str_replace('{{ commets_CEO }}', $comentariosHtml, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ product }}', $order->product->name, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ address }}', $order->address, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ phone }}', $order->phone, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ trackerCode }}', $order->tracking_number, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ payment_method }}', $order->payment_method, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace(
                                                        '{{ shipping_date }}',
                                                        $order->shipping_date ?? "Aún no programado",
                                                        $modalContentSeeAllClone
                                                    );
                                                    $modalContentSeeAllClone = str_replace(
                                                        '{{ delivery_date }}',
                                                        $order->delivery_date ?? "Aún no programado",
                                                        $modalContentSeeAllClone
                                                    );
                                                    $modalContentSeeAllClone = str_replace('{{ order_status }}', $order->order_status, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ payment_status }}', $order->payment_status, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ email }}', $order->email, $modalContentSeeAllClone);
                                                    $modalContentSeeAllClone = str_replace('{{ notes }}', empty($order->notes) ? "No se especificó ninguna nota" : $order->notes, $modalContentSeeAllClone);

                                                    Modal::create(
                                                        'Vista del producto <br><small>Nota: para ver los comentarios que nosotros le hemos hecho sobre su pedido, baje toda esa tarjeta</small>',
                                                        $modalContentSeeAllClone
                                                    );
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $modalContentCancelOrderClone = $modalTemplateCancelOrder;
                                                    $modalContentCancelOrderClone = str_replace('{{ product }}', $order->product->name, $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ trackerCode }}', $order->tracking_number, $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ shipping_date }}', $order->shipping_date ?? "Aún no programado", $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ delivery_date }}', $order->delivery_date ?? "Aún no programado", $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ order_status }}', $order->order_status, $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ payment_status }}', $order->payment_status, $modalContentCancelOrderClone);
                                                    $modalContentCancelOrderClone = str_replace('{{ id_order }}', $order->id, $modalContentCancelOrderClone);
                                                    Modal::returnButtonModal(null, ' <button type="button" class="btn btn-danger">Cancelar pedido</button>', true);
                                                    Modal::create('Cancelando pedido', $modalContentCancelOrderClone, "Sí, deseo cancelarlo");
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>

</html>