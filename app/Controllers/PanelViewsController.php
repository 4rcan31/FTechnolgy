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
            ]);
        }
        return [];
    }


    public function pageProfile(){
        view('dashboard/profile', $this->userModel()->getById(
            Route::getData()->user->id
        ));
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
                $ruteImageOld = $this->userModel()->updateAvatar(File::lastFileUploadInfo('rute:upload'), $idUser);
                File::delete($ruteImageOld, '/public');
                Server::redirect('/panel/profile');
            }
            Form::send('/panel/profile', ['Ocurrio un error al subir la imagen.'], 'Error'); 
        }
    }
}