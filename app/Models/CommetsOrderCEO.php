<?php

class CommetsOrderCEO extends BaseModel{

    private $table = 'order_comments_ceo';


    public function getCommetsByIdOrder(int $idOrder){
        $this->prepare();
        $this->select(['*'])->from($this->table)->where('id_order', $idOrder);
        return $this->execute()->all('fetchAll');
    }
}