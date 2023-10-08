<?php
csrf();
Form();
core('Encrypt/hasher.php', false);
class PetController extends BaseController{


    /**
    * @return PetsModel
    */
    public function pets(){
        return model('PetsModel');
    }


    public function clientAuth(){
        return Sauth::getPayLoadTokenClient(Request::$cookies['session'], $_ENV['APP_KEY']);
    }



    public function edit($request){
        if (!TokenCsrf::validateToken($request)) {
            Form::send('/panel/profile', ['Su sesión expiró'], 'Error');
        }
    
        $validate = validate($request);
        $validate->rule('required', [0]);
        if (!$validate->validate()) {
            Form::send('/panel/profile', ['Has modificado el HTML'], 'Error');
        }
    
        $event = $validate->input(1);
    
        $fields = [
            'name' => 'Nombre',
            'species' => 'Especie',
            'breed' => 'Raza',
            'age' => 'Edad',
            'gender' => 'Género',
            'color' => 'Color',
            'weight' => 'Peso',
            'birthdate' => 'Fecha de Nacimiento',
            'avatar' => "Foto"
        ];
    
        if (array_key_exists($event, $fields)) {
            $field = $event;
            $fieldName = $fields[$field];
    
            $validate->rule("required", [$field]);
    
            if ($field == 'age' || $field == 'weight') {
                $validate->rule('numeric', $field); //Estro creo que no funciona aun xd
            } elseif ($field == 'gender') {
                $validate->rule('in', ['Male', 'Female', 'Other']);
            }

    
            if (!$validate->validate()) {
                Form::send('/panel/profile', ["Tienes que rellenar {$fieldName}"], 'Error');
            }

            if($event == 'avatar'){
                if(!File::setFile($request['avatar'])){ Form::send('/panel/profile', ['Tu archivo es invalido!'], 'Error'); }
                File::setHost(serve($_ENV['APP_ADDRESS'].":".$_ENV['APP_PORT']));
                if(File::upload()){
                    $this->pets()->updateAvatar(File::lastFileUploadInfo('rute:upload'), $this->clientAuth()->id);
                    $this->pets()->userConfigPet($this->clientAuth()->id) ? 
                    $this->pets()->updateAvatar(File::lastFileUploadInfo('rute:upload'), $this->clientAuth()->id) :
                    $this->pets()->insertAvatar(File::lastFileUploadInfo('rute:upload'), $this->clientAuth()->id);
                    Server::redirect('/panel/profile');
                }

            }else{
                $this->pets()->userConfigPet($this->clientAuth()->id) ? 
                $this->pets()->{"update{$field}"}($validate->input($field), $this->clientAuth()->id) : 
                $this->pets()->{"insertNew{$field}"}($validate->input($field), $this->clientAuth()->id);
            }

            Form::send('/panel/profile', ['Los cambios se guardaron con éxito'], 'Success');
        }
        Form::send('/panel/profile', ['Ese evento no existe, modificaste el html!'], 'Success');
      
    }
    
    
    
}