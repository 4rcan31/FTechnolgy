<?php


class MessagesClientsModel extends BaseModel{

    public $table = 'contactus';


    public function saveMessage(string $from, string $message){
        $this->prepare();
        $this->insert($this->table)->values([
            'sender_user_name' => $from,
            'message_text' => $message
        ]);
        return $this->execute();
    }
}