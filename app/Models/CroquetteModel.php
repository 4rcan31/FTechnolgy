<?php


class CroquetteModel extends BaseModel{


    function existByToken($token){
        $this->prepare();
        $this->select(['*'])->from('croquettes_auths')->where('token', $token);
        return $this->execute()->exist();
    }

    public function getByToken($token){
        $this->prepare();
        $this->select(["*"])->from('croquettes_auths')->where('token', $token);
        return $this->execute()->all();
    }
}