<?php
class apps extends Migration {
        
    public function up() {
        $this->create("apps", function($table) {
            $this->query('CREATE TABLE apps (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL UNIQUE,
                description TEXT NOT NULL,
                avatar_serve VARCHAR(255) DEFAULT "' . serve($_ENV['APP_ADDRESS'].":".$_ENV['APP_PORT']) . '",
                avatar_rute VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');

            $this->prepare();
            $this->insert('apps')->values([
                'id' => 1,
                'name' => "Croquette",
                'avatar_rute' => 'assets/images/GatoDeHecho.png',
                'description' => 'Croquette o Croquette Control es un dispensador de comida para mascotas, el cual permite al dueño brindar un cuidado alimenticio personalizado a través de una aplicación '
            ]);
            $this->execute();
        });
    }
        
    public function down() {
        $this->dropIfExist("apps");
    }
        
}