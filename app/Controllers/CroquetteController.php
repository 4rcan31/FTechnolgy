<?php

Form();


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

    /**
     * @return AppsUserModel
     */
    private function AppsUserModel() {
        return model('AppsUserModel');
    }

    /**
     * @return exceptionServerCroquetteModel
     */
    private function exceptionServerCroquetteModel() {
        return model('exceptionServerCroquetteModel');
    }

    public function useHoldClientCroquette(){
        return $this->CroquetteModelUser()->userHoldsCroquette(
            $this->clientAuth()->id
        );
    }

    public function getStateCroquetteClientAuth(){
        return $this->CroquetteModelUser()->stateByIdUser(
            $this->clientAuth()->id
        );
    }

    public function view($request){
        $validate = validate($request);
        $validate->rule('required', [0]);
        $this->validateFieldsWithRedirection(['Esa url esta mal'], '/panel/croquette', $validate);
        view('dashboard/Croquette/dashboard', arrayToObject([
            'token' => $validate->input(0),
            'state' => $this->getConnectionStatusByTokenCroquette($validate->input(0))
        ]));
    }


    public function connect($token){
        $croquette = $this->CroquetteModel();
        if(!$croquette->existByToken($token)){ Form::send('/', ["El codigo QR esta alterado, o esta roto, comuniquenos a nosotros si cree que se trata de un error"], 'Error');}
        if(!$this->AppsUserModel()->existAppWithIdUser( //Que solamente se inserte la app para ese usuario en el caso que aun no tiene esa app
            $this->clientAuth()->id
        )){
            $this->AppsUserModel()->insertNewApp(1, $this->clientAuth()->id); //Un 1 por que 1 es de croquette
        }   
        $this->CroquetteModelUser()->newCroquetteUser(
            $this->clientAuth()->id,
            $this->CroquetteModel()->getByToken($token)->id
        );
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

    public function ping(){
        $reponse = $this->newCommandSendCroquette('ping');
        return isset($reponse->message->response) &&
                $reponse->message->response == 'pong';
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



    public function connectServerCroquette(Array $sendData = null, $block = false){
        $socket = @stream_socket_client(
            "tcp://".$this->host(), 
            $errno, 
            $errstr, 
            30);
    
        if(!$socket){
            return arrayToObject([
                'res' => false,
                'message' => "No se pudo conectar a ".$this->host()." ($errno): $errstr"
            ]);
        }
    
        if($sendData !== null){
           // fwrite($socket, "SERVER_APP:$sendData");
            $sendData = array_merge([
                'typeApp' => 'SERVER_APP'
            ], $sendData);
            fwrite($socket, json_encode($sendData));
        }

        $response = fread($socket, 1024);
        $decodeJson = json_decode($response);
        
        $response = arrayToObject([
            'res' => true,
            'isJson' => ($decodeJson !== null),
            'message' => ($decodeJson !== null) ? $decodeJson : $response
        ]);
        
        if ($block) {
            fclose($socket); // Cierra la conexión si $block es true
        }
    
        return $response;
    }

    public function newCommandSendCroquette(string $command, Array $data = []){
        return $this->connectServerCroquette(array_merge([
            'command' => $command
        ], $data), true);
    }


    public function sendFood($request) {
        $tokenCroquette = $request['tokenCroquette'] ?? null;
        $redirection = '/panel/croquette/' . $tokenCroquette;
    
        if (!$this->CroquetteModel()->existByToken($tokenCroquette)) {
            Form::send('/', ["Alteraste el código HTML"], 'Error');
        }
        $validate = validate($request);
        $this->validateCsrfTokenWithRedirection($request, $redirection);
        $validate->rule('required', ['cantidad', 'tokenCroquette']);
        $this->validateFieldsWithRedirection(['Tienes que rellenar todos los campos'], $redirection, $validate);
        if (!is_numeric($validate->input('cantidad'))) {
            Form::send($redirection, ['Has modificado el HTML. La cantidad no es un número.'], 'Error');
        }
        if($this->ping()){
            $response = $this->newCommandSendCroquette('sendfood', [
                'tokenCroquette' => $tokenCroquette,
                'cantidad' => $validate->input('cantidad')
            ]);
            $status = isset($response->message->state) &&
            $response->message->state ? 
            "ok" : 'bad';
            server::redirect($redirection."?status=$status&message=".base64_encode($response->message->response));
        }else{
            Form::send('/panel/statusservices', ['Lo sentimos, el servidor de comunicación de Croquette está caído :c'], 'Error');
        }
    }

    public function scheduleQuantity($request) {
        $tokenCroquette = $request['tokenCroquette'] ?? null;
        $redirection = '/panel/croquette/' . $tokenCroquette;
    
        // Check if Croquette exists
        if (!$this->CroquetteModel()->existByToken($tokenCroquette)) {
            Form::send('/', ["Alteraste el código HTML"], 'Error');
            return;
        }
    
        $validate = validate($request);
    
        // Validate CSRF token
        $this->validateCsrfTokenWithRedirection($request, $redirection);
    
        // Define required fields
        $requiredFields = ['fecha', 'hora', 'tokenCroquette', 'cantidad'];
    
        // Validate required fields
        $validate->rule('required', $requiredFields);
        if (!$validate->validate()) {
            Form::send($redirection, ['Tienes que rellenar todos los campos'], 'Error');
            return;
        }
    
        // Validate cantidad and hora as numeric values
        if (!is_numeric($validate->input('cantidad'))) {
            Form::send($redirection, ['Has modificado el HTML. La cantidad no es un número.'], 'Error');
            return;
        }
    
        // Validate fecha as a valid date
        $date = new DateTime($validate->input('fecha'));
        $date = date_format($date, 'Y-m-d');
        if (!$this->validateDate($date)) {
            Form::send($redirection, ['La fecha no es válida'], 'Error');
            return;
        }
    
        // Validate hora as a valid time in 'H:i' format
        if (!$this->validateTime($validate->input('hora'), 'H:i')) {
            Form::send($redirection, ['La hora no es válida'], 'Error');
            return;
        }
    
        // All validations passed
    
        // Check server availability
        if ($this->ping()) {
                $response = $this->newCommandSendCroquette('scheduleQuantity', [
                    'date' => $date,
                    'tokenCroquette' => $tokenCroquette,
                    'time' => $validate->input('hora'),
                    'cantidad' => $validate->input('cantidad'),
                ]);
                $status = isset($response->message->response) &&
                $response->message->response ? 
                "ok" : 'bad';
                server::redirect($redirection."?status=$status&message=".base64_encode($response->message->response));
        } else {
            // Server is down
            Form::send('/panel/statusservices', ['Lo sentimos, el servidor de comunicación de Croquette está caído :c'], 'Error');
        }
    }
    

    /* 
        Sé que los métodos validateDate y validateTime no deberían ir aquí,
        deberían ir en el validador de Sao, pero es que, viejo, no tengo 
        tiempo ahora para estar tocando cables internos de Sao xd
    */

    public function validateDate($date, $dateFormat = 'Y-m-d', $posterior = true) {
        $currentDate = date($dateFormat);
        if (!strtotime($date) || ($posterior && $date < $currentDate) || (!$posterior && $date > $currentDate)) {
            return false; 
        }
    
        return true;
    }

    public function validateTime($time, $formatTime = 'H:i:s') {
        $timestamp = strtotime($time);
        if ($timestamp === false || date($formatTime, $timestamp) !== $time) {
            return false; 
        }
        return true; 
    }


    public function getConnectionStatusByTokenCroquette(string $tokenCroquette){
        return $this->CroquetteModelUser()->getStateConnectionByIdCroquette(
            $this->CroquetteModel()->getIdByToken($tokenCroquette)
        );
    }

    public function serverShutdownEvent($request){
        $validate = validate($request);
        $this->exceptionServerCroquetteModel()->newException(
           $validate->input('message'),
           $validate->input('error'),
           $validate->input('clientIp') ? $validate->input('clientIp') : null,
           $validate->input('host').":".$validate->input('port'),
           $validate->input('infoExtra') ? $validate->input('infoExtra') : null
        );
        $this->CroquetteModelUser()->setStateOffAllCroquettes();
        res($request);
    }


    
    
}