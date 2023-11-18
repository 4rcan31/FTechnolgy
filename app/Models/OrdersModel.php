<?php

class OrdersModel extends BaseModel{

    private $table = 'orders';


    public function new(
        int $idUser,
        int $idProduct,
        string $email,
        string $address,
        string $phone,
        string $payment_status, 
        string $tracking_number,
        null|string $shipping_date,
        string $notes,
        string $payment_method,
        string $order_status
    ) {
        $this->prepare();
        $this->insert('orders')->values([
            'product_id' => $idProduct,
            'user_id' => $idUser,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'payment_status' => $payment_status,
            'tracking_number' => $tracking_number,
            'shipping_date' => $shipping_date,
            'notes' => $notes,
            'payment_method' => $payment_method,
            'order_status' => $order_status
        ]);
        return $this->execute()->lastId();
    }


    public function existById(int $idUser){
        $this->prepare();
        $this->select(['id'])->from('orders')->where('user_id', $idUser);
        return $this->execute()->exists();
    }

    public function getByIdUser(int $idUser) {
        $this->prepare();
        $this->select(['*'])
             ->from('orders')
             ->where('user_id', $idUser)
             ->orderBy('CASE WHEN order_status = "Cancelado" THEN 1 ELSE 0 END');
        return $this->execute()->all('fetchAll');
    }
    

    public function cancelOrderByIdOrder(int $idOrder){
        $this->prepare();
        $this->update('orders', [
            'order_status' => 'Cancelado',
            'payment_status' => 'Cancelado'
        ])->where('id', $idOrder);
        return $this->execute()->lastId();
    }

    public function existOrderById(int $idOrder){
        $this->prepare();
        $this->select(["*"])->from($this->table)->where('id', $idOrder);
        return $this->execute()->exists();
    }
    
}