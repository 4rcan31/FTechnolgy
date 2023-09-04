<?php
class apps extends Migration {
        
    public function up() {
        $this->create("apps", function($table) {
            $this->query('CREATE TABLE apps (
                id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');

            $this->prepare();
            $this->insert('apps')->values([
                'id' => 1,
                'name' => "Croquette App"
            ]);
            $this->execute();
        });
    }
        
    public function down() {
        $this->dropIfExist("apps");
    }
        
}