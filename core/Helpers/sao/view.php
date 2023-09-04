<?php


function view($html, $data = [], $route = '', $format = 'php'){
    try {
       // import('Views', false, '/core');
        core('Views', false); //Importamos todo el core de las vistas
        ViewData::setData($data);
        //Esto luego hay que cambiarlo para que se pueda settear desde los settings
        empty($route) ? import("Views/$html.$format", false) :   import("$route/$html.$format", false, '/'); 
        return true;
    } catch (\Throwable $th) {
        return false;
    }
}


function route($route){
    echo routePublic(trim($route, '/'));
}


function NotifierPHP(){
    core('Views/Notifier.php', false);
}