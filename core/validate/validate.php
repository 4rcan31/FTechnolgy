<?php


class Validate{
    public $datos;
    public $validates = [];
    public $msg = [];

    function __construct($datos){
        $this->datos = $datos;    
    }

    public function rule($rule, $campos, mixed $otros = null){
        if($rule === 'required'){
            array_push($this->validates, $this->required($campos));
        }else if($rule === 'contain'){
            array_push($this->validates, $this->contain($campos, $otros));
        }else if($rule == 'email'){
            array_push($this->validates, $this->email($campos));
        }else if($rule == 'is'){
            array_push($this->validates, $this->is($campos, $otros));
        }else if($rule == 'in'){
            array_push($this->validates, $this->in($otros, $campos));
        }else{
            res('Not validate named: '.$rule);
        }
    }

    private function email($campos){
        return $this->contain($campos, ['@']);
    }

    private function in($nedle, $array){
        return in_array($nedle, $array);
    }

    private function is(mixed $data, string $type): bool {
        if ($type === 'number') {
            return is_numeric($data);
        }
        return gettype($data) === $type;
    }
    
    

    public function required($campos){
        foreach($campos as $campo){
            if(!isset($this->datos[$campo])){
                array_push($this->msg, "El campo '$campo' no existe.");
                return false;
            }
            if((empty($this->datos[$campo]) && $this->datos[$campo] !== false) || $this->datos[$campo] === null){
                array_push($this->msg, "El campo $campo esta vacio.");
                return false;
            }
        }
        return true;
    }

    public function equals(string ...$data) {
        return count(array_unique($data)) === 1;
    }
    

    public function contain($sentenses, $contains){
        foreach($sentenses as $sentense){
            $input = $this->input($sentense);
            foreach($contains as $contain){
                if(!str_contains($input, $contain)){
                    array_push($this->msg, "$sentense no contiene $contain");
                    return false;
                }
            }
        }
        return true;
    }

    public function validate(){
        foreach($this->validates as $validate){
            if($validate === false){
                return false;
                break;
            }
        }
        return true;
    }

    public function input($index){
        if(isset($this->datos[$index])){
            return $this->datos[$index];
        }
        throw new Exception('El indice: "'.$index.'" no existe.'); 
    }  

    public function err(){
        return $this->msg;
    }
}