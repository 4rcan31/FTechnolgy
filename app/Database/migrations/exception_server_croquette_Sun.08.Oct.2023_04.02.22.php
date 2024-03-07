<?php
class exception_server_croquette extends Migration {
        
    public function up() {
        $this->create("exception_server_croquette", function($table) {
            $this->query('CREATE TABLE exception_server_croquette (
                id INT PRIMARY KEY AUTO_INCREMENT,
                message TEXT NOT NULL,
                stack_trace TEXT,
                client_ip VARCHAR(45) DEFAULT NULL,
                server_ip VARCHAR(45),
                additional_info TEXT,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("exception_server_croquette");
    }
        
}