<?php


class PetsModel extends BaseModel{


    public function getAllByIdUser(int $idUser){
        $this->prepare();
        $this->select(['*'])->from('pets')->where('user_id', $idUser);
        return $this->execute()->all();
    }

    public function userConfigPet(int $idUser){
        $this->prepare();
        $this->select(['*'])->from('pets')->where('user_id', $idUser);
        return $this->execute()->exist();
    }

    public function insertNewName(string $name, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'name' => $name,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }

    public function updateName(string $name, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'name' => $name
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }

    public function insertNewSpecies(string $species, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'species' => $species,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateSpecies(string $species, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'species' => $species
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewBreed(string $breed, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'breed' => $breed,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateBreed(string $breed, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'breed' => $breed
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewAge(int $age, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'age' => $age,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateAge(int $age, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'age' => $age
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewGender(string $gender, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'gender' => $gender,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateGender(string $gender, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'gender' => $gender
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewColor(string $color, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'color' => $color,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateColor(string $color, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'color' => $color
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewWeight(float $weight, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'weight' => $weight,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateWeight(float $weight, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'weight' => $weight
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }
    
    public function insertNewBirthdate(string $birthdate, int $idUser){
        $this->prepare();
        $this->insert('pets')->values([
            'birthdate' => $birthdate,
            'user_id' => $idUser
        ]);
        return $this->execute()->lastId();
    }
    
    public function updateBirthdate(string $birthdate, int $idUser){
        $this->prepare();
        $this->update('pets', [
            'birthdate' => $birthdate
        ])->where('user_id', $idUser);
        return $this->execute()->lastId();
    }


    public function updateAvatar(string $ruteImg, int $idUser){
        $oldAvatar = $this->getAllByIdUser($idUser)->avatar_rute;
        $this->prepare();
        $this->update('pets', [
            'avatar_rute' => $ruteImg
        ])->where('id', $idUser);
        $this->execute();
        return $oldAvatar;
    }

    public function insertAvatar(string $ruteImg, int $idUser){
        $oldAvatar = $this->getAllByIdUser($idUser)->avatar_rute;
        $this->prepare();
        $this->insert('pets')->values([
            'avatar_rute' => $ruteImg,
            'user_id' => $idUser
        ]);
        $this->execute();
        return $oldAvatar;
    }
    
}