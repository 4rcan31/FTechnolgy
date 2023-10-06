<?php


class CroquetteModel extends BaseModel{

    private $table = 'croquettes_auths';

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

    public function setInUse($token){
        $this->prepare();
        $this->update('croquettes_auths', [
            'in_use' => 1
        ])->where('token', $token);
        return $this->execute();
    }

    public function getIdByToken(string $token){
        $this->prepare();
        $this->select(['id'])->from('croquettes_auths')->where('token', $token);
        return $this->execute()->all()->id;
    }

    public function getById(int $idCroquette){
        $this->prepare();
        $this->select(['*'])->from($this->table)->where('id', $idCroquette);
        return $this->execute()->all();
    }



}