<?php
class users extends Migration {
        
    public function up() {
        $this->create("users", function($table) {
            $this->prepare();
            $this->query('CREATE TABLE users (
                id INT PRIMARY KEY AUTO_INCREMENT,
                email VARCHAR(255) NOT NULL UNIQUE,
                name VARCHAR(100) NOT NULL,
                user VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                remember_token VARCHAR(255),
                phone_number VARCHAR(255) DEFAULT NULL,
                address TEXT DEFAULT NULL,
                avatar_serve VARCHAR(255) DEFAULT "' . serve($_ENV['APP_ADDRESS'] . ":" . $_ENV['APP_PORT']) . '",
                avatar_rute VARCHAR(255) DEFAULT "assets/images/Logo.jpg",
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
            import('Encrypt/hasher.php', false, '/core');
            $this->insert('users')->values([
                'email' => 'admin@a.co',
                'password' => Hasher::make('123'),
                'name' => 'Admin',
                'user' => 'Admin'
            ]);
            $this->execute();

            //Nota: https://stackoverflow.com/questions/38433603/mysql2error-blob-text-geometry-or-json-column-body-cant-have-a-default-v
        });
    }
        
    public function down() {
        $this->dropIfExist("users");
    }
        
}