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
                avatar_serve VARCHAR(255) DEFAULT "' . serve('localhost:8080') . '",
                avatar_rute VARCHAR(255) DEFAULT "assets/images/panel/undraw_profile_2.svg",
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
            import('Encrypt/hasher.php', false, '/core');
            $this->insert('users')->values([
                'email' => 'admin@a.com',
                'password' => Hasher::make('123'),
                'name' => 'Admin',
                'user' => 'Admin'
            ]);
            $this->execute();
        });
    }
        
    public function down() {
        $this->dropIfExist("users");
    }
        
}