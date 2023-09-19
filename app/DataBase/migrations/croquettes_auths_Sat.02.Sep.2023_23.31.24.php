<?php
class croquettes_auths extends Migration {
        
    public function up() {
        $this->create("croquettes_auths", function($table) {
            $this->prepare();
            $this->query('CREATE TABLE croquettes_auths (
                id INT PRIMARY KEY AUTO_INCREMENT,
                token VARCHAR(255) NOT NULL UNIQUE,
                in_use TINYINT(1) DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )');

            $this->prepare();
            $this->insert('croquettes_auths')->values([
                'token' => 'a20412736e926666573981193f5319ff78a5bccbc958df73d6e6bfce311193f6'
            ]);
            $this->execute();
            $this->prepare();
            $this->insert('croquettes_auths')->values([
                'token' => '2fedc89a55934e8a4188e7b2e9bd19d11020db9ead0475064331fa6dbf7e0ff5'
            ]);
            $this->execute();
        });
    }
        
    public function down() {
        $this->dropIfExist("croquettes_auths");
    }
        
}