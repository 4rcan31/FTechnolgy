<?php
class apps_user extends Migration {
        
    public function up() {
        $this->create("apps_user", function($table) {
            $this->query('CREATE TABLE apps_user (
                id INT PRIMARY KEY AUTO_INCREMENT,
                id_apps INT NOT NULL UNIQUE,
                id_user INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("apps_user");
    }
        
}