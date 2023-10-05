<?php
class orders extends Migration {
        
    public function up() {
        $this->create("orders", function($table) {
            $this->query('CREATE TABLE orders (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT NOT NULL,
                user_id INT NOT NULL, 
                email VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                payment_status VARCHAR(20),
                tracking_number VARCHAR(255),
                shipping_date DATE,
                delivery_date DATE,
                notes TEXT DEFAULT NULL,
                payment_method VARCHAR(50),
                order_status VARCHAR(20),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        /* 
                payment_status VARCHAR(20), => para incluir un campo para registrar si el pago ha sido procesado o no. Esto puede ser útil para gestionar pedidos pendientes de pago.
                tracking_number VARCHAR(255), => Numero de seguimiento de la orden
                shipping_date DATE, => Fecha de envio
                delivery_date DATE, => Fecha de entrega
                notes TEXT, => Alguna nota adicional
                payment_method VARCHAR(50), => metodo de pago
                order_status VARCHAR(20), => Estado de la orden -> entregado, pendiente, en camino, en cola, en camino
        */
    public function down() {
        $this->dropIfExist("orders");
    }
        
}