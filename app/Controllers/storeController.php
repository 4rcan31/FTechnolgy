<?php
Form();
class storeController extends BaseController{

    /**
    * @return OrdersModel
    */
    public function order(){
        return model('OrdersModel');
    }

    public function clientAuth(){
        return Sauth::getPayLoadTokenClient(Request::$cookies['session'], $_ENV['APP_KEY']);
    }


    public function newOrder($request){
        $this->validateCsrfTokenWithRedirection($request, 'panel/store');
        $validate = validate($request);
        $validate->rule('required', [0, 'address', 'phone', 'email']);
        if(!$validate->validate()){
            Form::send('/panel/store', ['Has modificado el html'], 'Error');
        }
        $this->order()->new(
            $this->clientAuth()->id,
            $validate->input(0), //Esto es el id del producto
            $validate->input('email'),
            $validate->input('address'),
            $validate->input('phone'),
            'Pendiente', // Estado de pago (Por defecto, pendiente)
            $this->generateTrackingCode(),
            NULL, // Fecha de envío (es null porque aún no se ha enviado, solo ordenado)
            $validate->input('message'),
            'Efectivo', // Método de pago (Por defecto, efectivo)
            'Pendiente' // Estado de orden (Por defecto, pendiente)
        );  
        Server::redirect('panel/orders');
    }

    private function generateTrackingCode(){
        $code = [
            token(1),
            token(2),
            $this->clientAuth()->id
        ];
        shuffle($code); 
        return implode('', $code);
    }
    
}