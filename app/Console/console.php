<?php



Jenu::command('serve:chat', function(){
    $port = Jenu::get(0, "Fill the port");
    Jenu::executeNodeProcess("Server/server.js $port");
}, 'Run chat server test', 'FTechnology:Test'); 

Jenu::command('croquettes:auth', function(){
    $db = new DataBase;
    $db->select(['*'])->from('croquettes_auths');
    $croquettes = $db->execute()->all('fetchAll');
    foreach ($croquettes as $croquette) {
        $status = ($croquette->in_use === 0) ? 'Not used' : 'In use'; 
        Jenu::printRow();
        Jenu::success("Croquette $croquette->id", false);
        Jenu::success("Token: $croquette->token", false);
        Jenu::success("created_at: $croquette->created_at", false);
        Jenu::success("Status: $status", false); // Corregido "Estado" a "Status"
        Jenu::success('Link: ' . serve($_ENV['APP_ADDRESS'].":".$_ENV['APP_PORT'])."api/v1/signal/croquette/connect/" . "$croquette->token", false);
        Jenu::printRow();
    }
}, 'See all authenticated Croquette clients', 'FTechnology:Croquette'); 

Jenu::command('croquettes:onuse', function () {
    $db = new DataBase;
    $db->select(['*'])->from('croquettes_auths');
    $croquettes = $db->execute()->all('fetchAll');
    foreach ($croquettes as $croquette) {
        if($croquette->in_use === 1){
            Jenu::printRow(250);
            Jenu::success("Croquette $croquette->id", false);
            Jenu::success("Token: $croquette->token", false);
            Jenu::success("created_at: $croquette->created_at", false);
            Jenu::printRow(250);
        }      
    }
}, 'See all Croquettes that belong to a user (because they are in use)', 'FTechnology:Croquette'); 

Jenu::command('croquettes:unused', function () {
    $db = new DataBase;
    $db->prepare();
    $db->select(['*'])->from('croquettes_auths');
    $croquettes = $db->execute()->all('fetchAll');
    foreach ($croquettes as $croquette) {
        if($croquette->in_use === 0){
            Jenu::printRow(250);
            Jenu::success("Croquette $croquette->id", false);
            Jenu::success("Token: $croquette->token", false);
            Jenu::success("created_at: $croquette->created_at", false);
            Jenu::printRow(250);
        }      
    }
}, 'See all unused Croquettes (not belonging to anybody)', 'FTechnology:Croquette'); 

Jenu::command('croquettes:online', function(){
    $db = new DataBase;
    $db->prepare();
    $db->select(['*'])->from('croquette_user')->where('state', 1);
    $croquettesOnline = $db->execute()->all('fetchAll');
    if (empty(get_object_vars($croquettesOnline))) {
        Jenu::warn("No hay ningún croquette online en este momento");
        exit;
    }
    foreach($croquettesOnline as $croquetteOnline){
        $db->prepare();
        $db->select(['*'])->from('croquettes_auths')->where('id', $croquetteOnline->id_croquette);
        $dataCroquettesOnline = $db->execute()->all();
        Jenu::printRow();
        Jenu::success("id: ".$dataCroquettesOnline->id, false);
        Jenu::success("Token: ".$dataCroquettesOnline->token, false);
        Jenu::success("Created_at: ".$dataCroquettesOnline->created_at, false); 
        Jenu::printRow();
    }
}, 'See all Croquettes connected to the Croquette server (online Croquettes)', 'FTechnology:Croquette'); 
    Jenu::command('croquettes:offline', function(){
        $db = new DataBase;
        $db->prepare();
        $db->select(['*'])->from('croquette_user')->where('state', 0);
        $croquettesOnline = $db->execute()->all('fetchAll');
        if (empty(get_object_vars($croquettesOnline))) {
            Jenu::warn("No hay ningún croquette offline en este momento");
            exit;
            foreach($croquettesOnline as $croquetteOnline){
                $db->prepare();
                $db->select(['*'])->from('croquettes_auths')->where('id', $croquetteOnline->id_croquette);
                $dataCroquettesOnline = $db->execute()->all();
                Jenu::printRow();
                Jenu::success("id: ".$dataCroquettesOnline->id, false);
                Jenu::success("Token: ".$dataCroquettesOnline->token, false);
                Jenu::success("Created_at: ".$dataCroquettesOnline->created_at, false);
                Jenu::printRow();
            }
        }
    } , 'See all Croquettes disconnected from the Croquette server (offline Croquettes)', 'FTechnology:Croquette'); 
    
    Jenu::command('serve:croquette', function(){ // Esto no está funcionando a la perfección
        $host = Jenu::get(0, "Fill Host", '127.0.0.1');
        $port = Jenu::get(1, 'Fill port', '8081');
        Jenu::executeNodeProcess("Server/croquette.js $host $port");
    }, 'Run Croquette server with Node.js (Still in development) WARNING: This command doesn\'t work fine', 'FTechnology:Croquette'); 
    
    




/* Jenu::command('serve:client', function(){
    $host = Jenu::isset(0, 'Fill the host');
    $port = Jenu::isset(1, 'Fill the port');
 


    Jenu::executeNodeProcess("Server/client.js $host $port");
}); */



