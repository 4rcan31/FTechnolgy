<?php
Form();
csrf();

class ContacController extends BaseController{

    /**
    * @return MessagesClientsModel
    */
    public function modelMessageClients(){
        return model('MessagesClientsModel');
    }

    public function newMessage($request){
        Form::setInputs($request);
        if(!TokenCsrf::validateToken($request)){ Form::send('/contact', ['Su Session expiro'], 'Error'); }
        $validate = validate($request);
        $validate->rule('required', ['address', 'message']); 
        $validate->rule('email', ['address']);
        if(!$validate->validate()){ Form::send('/contact', $validate->err(), 'Error'); }

        $this->modelMessageClients()->saveMessage($validate->input('address'), $validate->input('message'));
        Form::send('/contact', ['Gracias por tu comentario'], "Now");
    }
}