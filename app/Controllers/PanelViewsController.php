<?php


class PanelViewsController extends BaseController{



    public function userProfileData(){
        if(isset(Request::$cookies['session'])){
            $data = [
                'apps' => []
            ];
            $idsApps = model('AppsUserModel')->getAppsIdByIdUser(Sauth::authenticableClient($_ENV['APP_KEY'])->id);
            foreach($idsApps as $idApp){
               array_push($data['apps'], model('AppsModel')->getAppsNameByIdApp($idApp->id)->name); 
            }
            $data['user'] = Sauth::authenticableClient($_ENV['APP_KEY']);
            return arrayToObject($data);
        }
        return [];
    }


    public function home(){
        view('dashboard/home');
    }
    
}