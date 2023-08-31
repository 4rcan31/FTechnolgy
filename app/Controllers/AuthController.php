<?php
csrf();
NotifierPHP();
core('Encrypt/hasher.php', false);

class AuthController extends BaseController{


    public function register($request){
        NotifierPHP::setInputs($request);
        if(!TokenCsrf::validateToken($request)){ NotifierPHP::send('/register', ['Su Session expiro'], 'Error'); }
        $validate = validate($request);
        $validate->rule('required', ['email', 'user', 'password', 'PasswordConfirm', 'name']); 
        $validate->rule('email', ['email']);
        if(!$validate->validate()){ NotifierPHP::send('/register', $validate->err(), 'Error'); }
        $user = model('UserModel');
        if($user->existUserByEmail($validate->input('email'))){ NotifierPHP::send('/login', ['Ya estas registrado, logueate!'], 'Error');}
        if($validate->input('password') != $validate->input('PasswordConfirm')){ NotifierPHP::send('/register', ['Las contrasenas no son iguales'], 'Error');}
        $idUser = $user->insertNewUser(
            $validate->input('email'),
            $validate->input('name'),
            $validate->input('user'),
            Hasher::make($validate->input('password'))
        );
        /* 
            To do: Poder crear tiempos de session ya que por el momento la session dura tan solo 7 dias, pero por cookie
        */
        Sauth::NewAuthServerSave('users', 'remember_token', $idUser);
        /* Si quiere un Auth en el cliente guardando el token ya sea firmado o guardado */
        Sauth::NewAuthClient([
            'id' => $idUser
        ],$_ENV['APP_KEY']);
        NotifierPHP::send('/panel/dashboard', ['Se ha registrado correctamente!'], 'Notice');
        return;
    }

    public function logout(){
        $idUserClient = Sauth::getPayLoadTokenClient(Request::$cookies['session'], $_ENV['APP_KEY'], 'id');
        Sauth::logoutClient();
        Sauth::logoutServer('users', 'remember_token', $idUserClient);
        NotifierPHP::send('/', ['Se cerro session correctamente'], 'Notice');
        return;
    }


    public function login($request){
        NotifierPHP::setInputs($request);
        if(!TokenCsrf::validateToken($request)){ NotifierPHP::send('/register', ['Su Session expiro'], 'Error'); }
        $validate = validate($request);
        $validate->rule('required', ['email', 'password']); 
        $validate->rule('email', ['email']);
        if(!$validate->validate()){ NotifierPHP::send('/register', $validate->err(), 'Error'); }
        $user = model('UserModel');
        if(!$user->existUserByEmail($validate->input('email'))){ NotifierPHP::send('/register', ['Aun no estas registrado, registrate!'], 'Error');}
        $row = $user->selectEmailAndPassword($validate->input('email'));
        if(!Hasher::verify($validate->input('password'), $row->password)){ NotifierPHP::send('/login', ['Las credenciales no son correctas'], 'Error'); }
        Sauth::NewAuthServerSave('users', 'remember_token', $row->id);
        Sauth::NewAuthClient([
            'id' => $row->id
        ],$_ENV['APP_KEY']);
        NotifierPHP::send('/panel/dashboard', ['Te has logeado correctamente!'], 'Notice');
        return;
    }
}