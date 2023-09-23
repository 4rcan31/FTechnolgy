<?php


function view($html, $data = [], $route = '', $format = 'php'){
    try {
        core('Views', false);
        ViewData::setData($data);
        // Asegúrate de que $route esté configurado correctamente según tus necesidades.
        $viewPath = empty($route) ? "Views/$html.$format" : "$route/$html.$format";
        import($viewPath, false);
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