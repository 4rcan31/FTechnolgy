<?php


require_once 'core/WebSockets/server.php';


/* $server = new serverWS('localhost', 12345);
$server->listeningSocket($server);


$server->event('on', function($server){
    $server->console("Nuevo cliente conectado: ", 'client:address');
    $server->response();
});

$server->event('connected', function(){

});


$server->event('message', function($messsage, $client, $server){
    $client->send("Hola cliente, resibi tu mensaje ".$messsage);
    $server->console('Nuevo mensaje de cliente ', 'client:address');
});

$server->executeClients(); */

/* $server = new serverWS('localhost', 12345); 
$server->listeningSocket($server);


$server->event('connected', function($server){
    $server->console("New client connected: ", 'client:address');
});

$server->event('disconnected', function($server){
    $server->console('Client disconnected: ', 'client:address');
});

$server->event('message', function($messsage, $client, $server){
    if($messsage['message'] == 'ping'){
        $client->send([
            'message' => 'pong'
        ]);
    }
    $server->console('The new message of client: ', 'client:address', ' the message was: ', $messsage);
});


$server->executeClients();
 */


$server = new serverWS('localhost', 12345, 1024, 'UTC');
$server->listeningSocket($server);




$server->event('connected', function($client, $server){
    $server->console('New client connected ', 'client:address');
});

$server->event('disconnected', function($client, $server){
    $server->console('Client disconnected', 'client:address');
});

$server->event('message', function($client, $server){
    $server->console('A new message of client', 'client:address');
    $messsage = $client->message();
    $event = $messsage['message'];

    if($event === 'connect'){
        $server->session($client->client(), [
            'token' => $client->message()['token']
        ]);
        $client->send([
            'message' => "The Arduino was connected suscess"
        ]);
        $server->console("New Arduino was connected, the token was: ", $messsage['token']);
    }else if($event === 'ping'){
        $client->send([
            'message' => 'pong'
        ]);
    }
});


$server->event('send', function($client, $server){
    
});




$server->executeClients();