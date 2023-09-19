<?php

use function PHPSTORM_META\type;

NotifierPHP();


class CroquetteController extends BaseController{

    /**
     * @return CroquetteModel
     */
    private function CroquetteModel() {
        return model('CroquetteModel');
    }

    /**
     * @return CroquetteUserModel
     */
    private function CroquetteModelUser() {
        return model('CroquetteUserModel');
    }


    public function connect($token){
        $croquette = $this->CroquetteModel();
        if(!$croquette->existByToken($token)){ NotifierPHP::send('/', ["El codigo QR esta alterado, o esta roto, comuniquenos a nosotros si cree que se trata de un error"], 'Error');}
        $row = $croquette->getByToken($token);
        model('AppsUserModel')->insertNewApp(1, Sauth::authenticableClient($_ENV['APP_KEY'])->id); //Un 1 por que 1 es de croquette
        model('CroquetteUserModel')->newCroquetteUser(Sauth::authenticableClient($_ENV['APP_KEY'])->id, $row->id);
        $croquette->setInUse($token);
        Server::redirect('panel/dashboard');
    }

    private function responseCroquetteModel(bool $state, string $message, string $token){
        res([
            'state' => $state, 
            'message' => $message, 
            'token' => $token
        ]);
    }


    private function verifyToken($token){
        return $this->CroquetteModel()->existByToken($token);
    }

    private function sendResponseVerifyToken($token){
        if(!$this->verifyToken($token)){ //Esto solamente  valida que el token exista y si sea de un croquette
            $this->responseCroquetteModel(
                false, 
                'Hubo un error al verificar el token de croquette (El token no existe o no es valido)', 
                $token);
         }
         return true;
    }

    private function sendResponseBelongsToUser(int $idCroquette, string $token){
        if(!$this->CroquetteModelUser()->belongsToUser($idCroquette)){
            $this->responseCroquetteModel(
                false,
                'Este croquette aun no le pertenece a nadie todavia, escanee el codigo qr en la parte inferior de Croquette para anclarlo :)',
                $token );
        }
        return true;
    }




    public function setStatusConnection($request){
        /* 
            1. Validad que el token sea verdadero
            2. Validar que ese token ya es de una persona
                2.1 Si no es de una persona pues decirle en el lcd que ese token aun no esta registrado para alguien
            3. Si es de una persona pues setear el state como on 
        */
        $request = arrayToObject($request);
        $this->sendResponseVerifyToken($request->token);
        //Validad que el croquette sea de alguien
        $idCroquette = $this->CroquetteModel()->getIdByToken($request->token);
        $this->sendResponseBelongsToUser($idCroquette, $request->token);
        $this->CroquetteModelUser()->setStateOn($idCroquette);
        $this->responseCroquetteModel(
            true,
            "Croquette App ha sido conectado con exito, listo para recibir indicaciones!",
            $request->token
        );
        return;
    }

    public function newDisconnection($token){
        $this->sendResponseVerifyToken($token);
        $idCroquette = $this->CroquetteModel()->getIdByToken($token);
        $this->sendResponseBelongsToUser($idCroquette, $token);
        $this->CroquetteModelUser()->setStateOff($idCroquette);
    }
}