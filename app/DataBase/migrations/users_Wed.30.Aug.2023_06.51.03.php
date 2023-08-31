<?php
class users extends Migration {
        
    public function up() {
        $this->create("users", function($table) {
            $this->query('CREATE TABLE users (
                id INT PRIMARY KEY AUTO_INCREMENT,
                email VARCHAR(255) NOT NULL UNIQUE,
                name VARCHAR(100) NOT NULL,
                user VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                remember_token VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');            
        });
    }
        
    public function down() {
        $this->dropIfExist("users");
    }
        
}