<?php
class order_comments extends Migration {
        
    public function up() {
        $this->create("order_comments_ceo", function($table) {
            $this->query('CREATE TABLE order_comments_ceo (
                id INT PRIMARY KEY AUTO_INCREMENT,
                id_order INT,
                id_staff INT,
                priority VARCHAR(20),
                comment_status VARCHAR(20),
                attachment VARCHAR(255) DEFAULT NULL,
                private_note TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )');
        });

        /* 
        
            comment_status (VARCHAR(20)): Representa el estado del comentario, como "Pendiente", "Resuelto" o "En revisión".
            attachment (VARCHAR(255)): Almacena una referencia a cualquier archivo adjunto relacionado con el comentario, como una imagen o un archivo PDF.
            private_note (TEXT): Este campo se utiliza para almacenar notas privadas que no son visibles para el cliente y son solo para uso interno.
            id_staff (INT): Guarda el id del staff que hizo ese comentario
        */
    }
        
    public function down() {
        $this->dropIfExist("order_comments");
    }
        
}