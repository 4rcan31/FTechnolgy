<?php
class contactus extends Migration {
        
    public function up() {
        $this->create("contactus", function($table) {
            $this->query('CREATE TABLE contactus (
                id INT PRIMARY KEY AUTO_INCREMENT,
                sender_user_name VARCHAR(255) NOT NULL,
                message_text TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');
        });
    }
        
    public function down() {
        $this->dropIfExist("contactus");
    }
        
}