<?php
class croquette extends Migration {
        
    public function up() {
        $this->create("croquette", function($table) {
            $this->query('CREATE TABLE croquette (
                id INT PRIMARY KEY AUTO_INCREMENT,
                id_croquette_user INT NOT NULL,
                event_type VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("croquette");
    }
        
}