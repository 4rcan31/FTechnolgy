<?php
NotifierPHP();
csrf();

class ContacController extends BaseController{

    /**
    * @return MessagesClientsModel
    */
    public function modelMessageClients(){
        return model('MessagesClientsModel');
    }

    public function newMessage($request){
        NotifierPHP::setInputs($request);
        if(!TokenCsrf::validateToken($request)){ NotifierPHP::send('/contact', ['Su Session expiro'], 'Error'); }
        $validate = validate($request);
        $validate->rule('required', ['address', 'message']); 
        $validate->rule('email', ['address']);
        if(!$validate->validate()){ NotifierPHP::send('/contact', $validate->err(), 'Error'); }

        $this->modelMessageClients()->saveMessage($validate->input('address'), $validate->input('message'));
        NotifierPHP::send('/contact', ['Gracias por tu comentario'], "Now");
    }
}