<?php


class UserModel extends BaseModel{


    public $table = 'users';

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
        return $this->execute()->exists();
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

    public function updatePhone(string $phone, int $idUser){
        $this->prepare();
        $this->update('users', [
            'phone_number' => $phone
        ])->where('id', $idUser);
        return $this->execute()->lastId();
    }

    public function updateAddress(string $address, int $idUser){
        $this->prepare();
        $this->update('users', [
            'address' => $address
        ])->where('id', $idUser);
        return $this->execute()->lastId();
    }

    public function getAdressAndPhoneByIdUser(int $idUser){
        $this->prepare();
        $this->select(['phone_number', 'address'])
            ->from($this->table)->where('id', $idUser);
        return $this->execute()->all();
    }
}