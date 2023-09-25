<?php


class UserModel extends BaseModel{




    public function insertNewUser($email, $name, $user, $password){
        $this->prepare();
        $this->insert('users')->values([
            'email' => $email,
            'name' => $name,
            'user' => $user,
            'password' => $password
        ]);
        return $this->execute()->lastId();
    }

    public function existUserByEmail(string $email){
        $this->prepare(); 
        $this->select(['email'])->from('users')->where('email', $email);
        return $this->execute()->exist();
    }


    public function selectEmailAndPassword(string $email){
        $this->prepare();
        $this->select(['email', 'password', 'id'])->from('users')->where('email', $email);
        return $this->execute()->all();
    }

    public function getByEmail($email){
        $this->prepare();
        $this->select(['*'])->from('users')->where('email', $email);
        return $this->execute()->all();
    }

    public function getById(int $id){
        $this->prepare();
        $this->select(['*'])->from('users')->where('id', $id);
        return $this->execute()->all();
    }

    public function updateName(string $newName, int $idUser){
        $this->prepare();
        $this->update('users', [
            'name' => $newName
        ])->where('id', $idUser);
        return $this->execute()->lastId();
    }

    public function updateAvatar(string $ruteImg, int $idUser){
        $oldAvatar = $this->getById($idUser)->avatar_rute;
        $this->prepare();
        $this->update('users', [
            'avatar_rute' => $ruteImg
        ])->where('id', $idUser);
        $this->execute();
        return $oldAvatar;
    }
}