<?php


function controller($controller, $function, $data = 'nulldata'){
    $controller = import('controllers/'.$controller.'.php');
    if($data == 'nulldata'){
     try{
         return $controller->{$function}();
     }catch(\Throwable $th){
         throw new Exception('La funcion '.$function." espera parametros que no fueron definidos.");
         return;
     }
    }else{
        return $controller->{$function}($data);
    
    }
 }
 