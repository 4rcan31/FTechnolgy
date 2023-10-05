<?php

csrf();
Form();
core('Encrypt/hasher.php', false);
class PanelViewsController extends BaseController{

    /**
     * @return UserModel
     */
    private function userModel() {
        return model('UserModel');
    }

    /**
    * @return PetsModel
    */
    public function pets(){
        return model('PetsModel');
    }

    /**
    * @return AppsModel
    */
    public function apps(){
        return model('AppsModel');
    }

    /**
    * @return OrdersModel
    */
    public function order(){
        return model('OrdersModel');
    }

        /**
    * @return CommetsOrderCEO
    */
    public function CommetsOrderCEO(){
        return model('CommetsOrderCEO');
    }




    public function userProfileData(){
        if(isset(Request::$cookies['session'])){
            $authenticableClient = Sauth::authenticableClient($_ENV['APP_KEY']);
            $idsApps = model('AppsUserModel')->getAppsIdByIdUser($authenticableClient->id);
            $user = $this->userModel()->getById($authenticableClient->id); //Esto devuelve un objeto
            $user->avatar = $user->avatar_serve.$user->avatar_rute;
            $appNames = [];
            
            foreach($idsApps as $idApp){
               $appNames[] = model('AppsModel')->getAppsNameByIdApp($idApp->id)->name;
            }
    
            return arrayToObject([
                'apps' => $appNames,
                'user' => $user,
                'order' => $this->order()->existById($this->clientAuth()->id)
            ]);
        }
        return [];
    }

    public function profilePet(){
        return $this->pets()->getAllByIdUser(Route::getData()->user->id);
    }

    public function profileUser(){
        return $this->userModel()->getById(Route::getData()->user->id);
    }

    
    public function clientAuth(){
        return Sauth::getPayLoadTokenClient(Request::$cookies['session'], $_ENV['APP_KEY']);
    }


    public function builtMessageAge($age){
        $messageAge = 'Tu mascota tiene ';
        if ($age['years'] > 0) {
            $messageAge .= $age['years'] . ' año' . ($age['years'] > 1 ? 's' : '') . ', ';
        }
        if ($age['months'] > 0) {
            $messageAge .= $age['months'] . ' mes' . ($age['months'] > 1 ? 'es' : '') . ', ';
        }
        if ($age['days'] > 0) {
            $messageAge .= " y ".$age['days'] . ' día' . ($age['days'] > 1 ? 's' : '') . ' ';
        }
        $messageAge .= 'de edad.';
        return $messageAge;
    }


    public function pageProfile(){
        $defaultMessagePetProfile = "Aun no has configurado los datos de tu mascota";
        $defaultImg = $this->profileUser()->avatar_serve . $this->profileUser()->avatar_rute;
        $profilePet = $this->profilePet();
        $name = ($profilePet !== false && $profilePet->name !== null) ?
        $profilePet->name : $defaultMessagePetProfile;
        $specie = ($profilePet !== false && $profilePet->species !== null) ?
        $profilePet->species : $defaultMessagePetProfile;
        $breed = ($profilePet !== false && $profilePet->breed !== null) ?
        $profilePet->breed : $defaultMessagePetProfile;
        $birthdate = ($profilePet !== false && $profilePet->birthdate !== null) ?
        $profilePet->birthdate : $defaultMessagePetProfile;
        $age = ($birthdate !== $defaultMessagePetProfile) ? 
        $this->builtMessageAge(
            import('Time/time.php', true, '/core')->calculateAgeFromBirthdate(date("Y-m-d", strtotime($birthdate)))
        ) :
        $defaultMessagePetProfile." (Este dato se actualizara automáticamente cuando pongas la fecha de nacimiento)";
        $gender = ($profilePet !== false && $profilePet->gender !== null) ? 
        $profilePet->gender : $defaultMessagePetProfile;
        $color = ($profilePet !== false && $profilePet->color !== null) ? 
        $profilePet->color : $defaultMessagePetProfile;
        $weight = ($profilePet !== false && $profilePet->weight !== null) ? 
        $profilePet->weight." kg" : $defaultMessagePetProfile;
        $avatar = ($profilePet !== false && $profilePet->avatar_serve !== null && $profilePet->avatar_rute !== null) ? 
        $profilePet->avatar_serve . $profilePet->avatar_rute : $defaultImg;
        
        $genderOptions = ['Male', 'Female', 'Other'];
        $selectedGender = $gender;
        $genderSelectOptions = '';
        foreach ($genderOptions as $option) {
            $isSelected = $option === $selectedGender ? 'selected' : '';
            $genderSelectOptions .= "<option value='$option' $isSelected>$option</option>";
        }
        view('dashboard/profile', arrayToObject([
            'user' => $this->profileUser(),
            'pet' => [
                'name' => $name,
                'specie' => $specie,
                'breed' => $breed,
                'birthdate' => $birthdate,
                'age' => $age,
                'gender' => $gender,
                'color' => $color,
                'weight' => $weight,
                'avatar' => $avatar,
                'genderSelectOptions' => $genderSelectOptions
            ]
        ]));
    }
    


    public function home(){
        view('dashboard/home');
    }

    public function statusServer(){
        $data = arrayToObject([
            'server_app' => true,
            'server_croquette' => false,
            'client_croquette' => false,
            'client_user' => true,
            'client_user_holds_client_croquette' => false,
            'messages' => [] // Inicializamos un arreglo para almacenar mensajes asociados a eventos
        ]);
    
        /** @var CroquetteController $croquette */
        $croquette = import('Controllers/CroquetteController.php');
        $connection = $croquette->connectServerCroquette('ping', true);
        $data->server_croquette = $connection->res;
        $data->client_user_holds_client_croquette = $croquette->useHoldClientCroquette();
        $data->client_croquette = $croquette->getStateCroquetteClientAuth();

        // Agregamos mensajes según las condiciones, con eventos asociados
        if(!$data->client_user_holds_client_croquette) {
            $data->messages->client_user_holds_client_croquette = "Todavía no posees un croquette.";
        }

        if(!$data->server_croquette) {
            $data->messages->server_croquette = "El servidor de comunicación de croquette está caído.";
        }

        !$data->client_croquette ? 
        $data->messages->client_croquette = "Aún no has encendido tu croquette" :
        $data->messages->client_croquette = "Tu Croquette está conectado!";
        

        if ($connection->message === 'pong') {
            $data->messages->server_croquette = "El servidor de comunicación de croquette está conectado (se recibió un pong).";
        }
        $data->messages->server_app = "La aplicación está funcionando.";
        $data->messages->client_user = "Ya estás conectado.";

        view('dashboard/statusServer', $data);
    }


    public function editProfile($request){
        if(!TokenCsrf::validateToken($request)){Form::send('/panel/profile', ['Su Session expiro'], 'Error');}
        if(!isset($request[0]) || !isset($request[1])){ Form::send('/panel/profile', ['Has modificado el html.'], 'Error'); }
        list($idUser, $event) = $request;
        if($event == 'name'){
            if(!isset($request['name'])){ Form::send('/panel/profile', ['Tienes que rellenas el nuevo nombre.'], 'Error'); }
            $this->userModel()->updateName($request['name'], $idUser);
            Server::redirect('/panel/profile');
        }else if($event == 'avatar'){
            if(!isset($request['avatar'])){ Form::send('/panel/profile', ['Tienes que subir una imagen.'], 'Error'); }
            if(!File::setFile($request['avatar'])){ Form::send('/panel/profile', ['Tu archivo es invalido!'], 'Error'); }
            File::setHost(serve($_ENV['APP_ADDRESS'].":".$_ENV['APP_PORT']));
            if(File::upload()){
                $this->userModel()->updateAvatar(File::lastFileUploadInfo('rute:upload'), $idUser);
                Server::redirect('/panel/profile');
            }
            Form::send('/panel/profile', ['Ocurrio un error al subir la imagen.'], 'Error'); 
        }else if($event == "address"){
            $validate = validate($request);
            $validate->rule('required', ['address']);
            if(!$validate->validate()){ Form::send('/panel/profile', ['Tienes que rellenar tu direccion'], 'Error'); }
            $this->userModel()->updateAddress(
                $validate->input('address'),
                $this->clientAuth()->id
            );
             Server::redirect('/panel/profile');
        }else if($event == 'phone'){
            $validate = validate($request);
            $validate->rule('required', ['phone_number']);
            $validate->rule('phone', ['phone_number']);
            if(!$validate->validate()){Form::send('/panel/profile', ['Tienes que rellenar tu numero'], 'Error');}
            $this->userModel()->updatePhone(
                $validate->input('phone_number'),
                $this->clientAuth()->id
            );
             Server::redirect('/panel/profile');
        }else{
            Form::send('/panel/profile', ["El evento $event no existe, has mofidificado el html"], 'Error');
        }
    }

    public function store(){
        view('dashboard/store', $this->apps()->get());
    }

    public function ordersView(){
        $orders = $this->order()->getByIdUser(
            $this->clientAuth()->id
        );
       
    
        foreach($orders as $index => $order){
            $orders->{$index}->product = $this->apps()->getProductById($order->product_id);
            $orders->{$index}->commets =  $this->CommetsOrderCEO()->getCommetsByIdOrder($order->id);
        }
        /* 
            Justo aca es donde serviria hacer un inner join xD pero Sao aun no soporta 
            relaciones en las migraciones nada mas, pero en su orm si
        */
        view('dashboard/orders', $orders);
    }
}