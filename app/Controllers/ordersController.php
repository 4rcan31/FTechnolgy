<?php


class ordersController extends BaseController{

    /**
    * @return OrdersModel
    */
    public function order(){
        return model('OrdersModel');
    }




    public function cancelOrder($request){
        /* 
            También se debe considerar la lógica de negocio detrás de la cancelación, 
            como si hay restricciones de tiempo o políticas específicas relacionadas con las cancelaciones.
            (Esto aun no esta en el sistema)
        */
        $this->validateCsrfTokenWithRedirection($request, 'panel/orders');
        $validate = validate($request);
        $validate->rule('required', [0]); // El índice 0 es el ID de la orden (este dato se pasa por url)
        if (!$validate->validate()) {
            Form::send('/panel/orders', ['Has modificado el HTML'], 'Error');
        }
        if (!$this->order()->existOrderById($validate->input(0))) {
            Form::send('/panel/orders', ['La orden no existe en el sistema'], 'Error');
        }
        $this->order()->cancelOrderByIdOrder($validate->input(0));
        Server::redirect('panel/orders');
        return;
    }
    
}