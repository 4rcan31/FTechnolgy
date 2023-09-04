<?php 
NotifierPHP();


class CroquetteController extends BaseController{



    public function connect($token){
        $croquette = model('CroquetteModel');
        if(!$croquette->existByToken($token)){ NotifierPHP::send('/', ["El codigo QR esta alterado, o esta roto, comuniquenos a nosotros si cree que se trata de un error"], 'Error');}
        $row = $croquette->getByToken($token);
        model('AppsUserModel')->insertNewApp(1, Sauth::authenticableClient($_ENV['APP_KEY'])->id); //Un 1 por que 1 es de croquette
        model('CroquetteUserModel')->newCroquetteUser(Sauth::authenticableClient($_ENV['APP_KEY'])->id, $row->id);
        Server::redirect('panel/dashboard');
    }


    public function verifyToken($token){
        return model('CroquetteModel')->existByToken($token);
    }
}