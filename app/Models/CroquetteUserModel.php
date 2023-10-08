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

    public function getStateConnectionByIdCroquette(int $idCroquette){
        $this->prepare();
        $this->select(["state"])->from('croquette_user')->where('id_croquette', $idCroquette);
        $response = $this->execute()->all();
        return $response && isset($response->state) ? $response->state === 1 : false;
    }


    /*
        Esta consulta se considera delicada y demandante en términos de rendimiento, 
        ya que actualiza todos los registros de la tabla en la columna "state" de la 
        tabla "croquetes_users". Sin embargo, esta consulta solo se ejecuta en circunstancias excepcionales, 
        es decir, cuando el servidor de comunicación de croquettes se desconecta o experimenta una interrupción. 
        En tales casos, se requiere esta actualización para cambiar el estado de todos los croquettes
        previamente conectados a "desconectados".
        Esta consulta se encuentra en la línea 333 (en el momento actual) del método 'setStateOffAllCroquettes' en el archivo 'CroqueteController.php'.
    */
    public function setStateOffAllCroquettes(){
        $this->prepare(); 
        $this->update($this->table, [
            'state'  => 0
        ]);
        return $this->execute();
    }
}