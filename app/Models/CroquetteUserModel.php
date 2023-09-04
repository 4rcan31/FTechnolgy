<?php

class CroquetteUserModel extends BaseModel{



    public function newCroquetteUser($idUser, $idCroquette){
        $this->prepare();
        $this->insert('croquette_user')->values([
            'id_user' => $idUser,
            'id_croquette' => $idCroquette
        ]);
        return $this->execute()->lastId();
    }
}