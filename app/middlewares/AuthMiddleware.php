<?php


class AuthMiddleware{



    public function session(){
        return $this->middlewareAuthServerAndClient();
    }

    public function middlewareAuthServerAndClient(){
        
        if(!isset(Request::$cookies['session'])){
            return false;
        }
        $idUserClient = Sauth::getPayLoadTokenClient(Request::$cookies['session'], $_ENV['APP_KEY'], 'id');
        return Sauth::middlewareAuthServerAndClient(
            Request::$cookies['session'],
            $_ENV['APP_KEY'],
            'users',
            'remember_token', 
            $idUserClient
        );

    }
}