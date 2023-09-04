<?php
class croquette_user extends Migration {
        
    public function up() {
        $this->create("croquette_user", function($table) {
            $this->query('CREATE TABLE croquette_user (
                id INT PRIMARY KEY AUTO_INCREMENT,
                id_croquette INT NOT NULL UNIQUE,
                id_user INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("croquette_user");
    }
        
}