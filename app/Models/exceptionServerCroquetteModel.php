<?php

class exceptionServerCroquetteModel extends BaseModel{

    private $table = 'exception_server_croquette';


    public function newException($message, $stack_trace, $client_ip, $server_ip, $additional_info) {
        $this->prepare();
        $this->insert($this->table)->values([
            'message' => $message,
            'stack_trace' => $stack_trace,
            'client_ip' => $client_ip,
            'server_ip' => $server_ip,
            'additional_info' => $additional_info
        ]);
        return $this->execute()->lastId();
    }
    
}