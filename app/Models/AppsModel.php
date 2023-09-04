<?php 


class AppsModel extends BaseModel{


    public function getAppsNameByIdApp($id){   
        $this->prepare();
        $this->select(['name'])->from('apps')->where('id', $id);
        return $this->execute()->all();
    }
}