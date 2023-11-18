<?php


class AppsUserModel extends BaseModel{


    public function insertNewApp($idCroquette, $idUser){
        $this->prepare();
        $this->insert('apps_user')->values([
            'id_user' => $idUser,
            'id_apps' => $idCroquette
        ]);
        return $this->execute();
    }


    public function getAppsIdByIdUser(int $id){
        $this->prepare();
        $this->select(['id'])->from('apps_user')->where('id_user', $id);
        return $this->execute()->all('fetchAll');
    }

    public function existAppWithIdUser(int $idUser){
        $this->prepare();
        $this->select(['id'])->from('apps_user')->where('id_user', $idUser);
        return $this->execute()->exists();
    }
}