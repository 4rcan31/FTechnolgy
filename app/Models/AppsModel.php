<?php 


class AppsModel extends BaseModel{


    public function getAppsNameByIdApp($id){   
        $this->prepare();
        $this->select(['name'])->from('apps')->where('id', $id);
        return $this->execute()->all();
    }

    public function getAppsByIdApp($id){   
        $this->prepare();
        $this->select(['*'])->from('apps')->where('id', $id);
        return $this->execute()->all();
    }

    public function existById(int $id){
        $this->prepare();
        $this->select(['id'])->from('apps')->where('id', $id);
        return $this->execute()->exist();
    }

    public function get(){   
        $this->prepare();
        $this->select(['*'])->from('apps');
        return $this->execute()->all('fetchAll');
    }

    public function getProductById(int $idProduct){
        $this->prepare();
        $this->select(['*'])->from('apps')->where('id', $idProduct);
        return $this->execute()->all();
    }
}