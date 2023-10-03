<?php
class pets extends Migration {
        
    public function up() {
        $this->create("pets", function($table) {
            $this->query('CREATE TABLE pets (
                id INT PRIMARY KEY AUTO_INCREMENT,
                user_id INT NOT NULL,
                name VARCHAR(100) DEFAULT NULL,
                species VARCHAR(100) DEFAULT NULL,
                breed VARCHAR(100) DEFAULT NULL,
                age INT DEFAULT NULL,
                gender ENUM("Male", "Female", "Other") DEFAULT NULL,
                color VARCHAR(50) DEFAULT NULL,
                weight DECIMAL(5, 2) DEFAULT NULL,
                birthdate DATE DEFAULT NULL,
                avatar_serve VARCHAR(255) DEFAULT "' . serve($_ENV['APP_ADDRESS'].":".$_ENV['APP_PORT']) . '",
                avatar_rute VARCHAR(255) DEFAULT "assets/images/Logo.jpg",
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("pets");
    }
        
}