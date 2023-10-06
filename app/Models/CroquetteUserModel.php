<?php

class CroquetteUserModel extends BaseModel{

    private $table = 'croquette_user';

    public function newCroquetteUser($idUser, $idCroquette){
        $this->prepare();
        $this->insert('croquette_user')->values([
            'id_user' => $idUser,
            'id_croquette' => $idCroquette
        ]);
        return $this->execute()->lastId();
    }


    public function belongsToUser(int $idCroquette){
        $this->prepare();
        $this->select(['id_croquette'])->from('croquette_user')->where('id_croquette', $idCroquette);
        return $this->execute()->exist();
    }

    public function setStateOn(int $idCroquette){
        $this->prepare();
        $this->update('croquette_user', [
            'state' => 1
        ])->where('id_croquette', $idCroquette);
        return $this->execute();
    }

    public function setStateOff(int $idCroquette){
        $this->prepare();
        $this->update('croquette_user', [
            'state' => 0
        ])->where('id_croquette', $idCroquette);
        return $this->execute();   
    }

    public function stateByIdUser(int $idUser){
        $this->prepare();
        $this->select(["state"])->from('croquette_user')->where('id_user', $idUser);
        $response = $this->execute()->all();
        return $response && isset($response->state) ? $response->state === 1 : false;
    }

    public function userHoldsCroquette(int $idUser){
        $this->prepare();
        $this->select(['*'])->from('croquette_user')->where('id_user', $idUser);
        return $this->execute()->exist();
    }

    public function getByIdUser(int $idUser){
        $this->prepare();
        $this->select(['*'])->from($this->table)->where('id_user', $idUser);
        return $this->execute()->all('fetchAll');
    }
}