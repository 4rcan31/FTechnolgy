<?php
Form();
class storeController extends BaseController{

    /**
    * @return OrdersModel
    */
    public function order(){
        return model('OrdersModel');
    }

    /**
     * @return UserModel
    */
    private function users() {
        return model('UserModel');
    }

    public function newOrder($request){
        $this->validateCsrfTokenWithRedirection($request, 'panel/store');
        $validate = validate($request);
        $validate->rule('required', [0, 'address', 'phone', 'email']);
        if(!$validate->validate()){
            Form::send('/panel/store', ['Has modificado el html'], 'Error');
        }

        $profile = $this->users()->getAdressAndPhoneByIdUser(
            $this->clientAuth()->id
        );
        
        if ($profile->phone_number === null || $profile->address === null) {
            Form::send('/panel/profile', ['Configura tu número de teléfono o dirección'], 'Error');
        }
        
        
    
        $this->order()->new(
            $this->clientAuth()->id,
            $validate->input(0), //Esto es el id del producto (Equivale al id de la app)
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