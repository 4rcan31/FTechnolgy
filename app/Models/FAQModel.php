<?php


class FAQModel extends BaseModel{

    public function get(){
        $this->prepare();
        $this->select(['*'])->from('faq');
        return $this->execute()->all('fetchAll');
    }
}