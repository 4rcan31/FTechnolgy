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
}