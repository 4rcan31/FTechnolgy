<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

require 'vendor/autoload.php'; // Asegúrate de incluir la ruta correcta a tus archivos de biblioteca
require 'app/Controllers/CroquetteController.php';


class WebSocketServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "Nuevo cliente conectado\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);

        if ($data && isset($data['type'])) {
            switch ($data['type']) {
                case 'authenticate':
                    $croquette = new CroquetteController;
                    if(!$croquette->verifyToken($data['token'])){
                        $from->send(json_encode([
                            'message' => "El token no es valido"
                        ]));
                        return;
                    }

                    $from->send(json_encode([
                        'message' => 'Tu croquette es valido!'
                    ]));
                    // Realiza la autenticación y verifica si el ID del Arduino es válido
                    // Puedes almacenar la relación entre el ID del usuario y el ID del Arduino aquí
                    // Si la autenticación es exitosa, puedes enviar una respuesta al Arduino
                    // por ejemplo: $from->send('{"type":"authenticated"}');
                    break;
                // Otros tipos de mensajes que puedas necesitar manejar
                default:
                    break;
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
        echo "Cliente desconectado\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocketServer()
        )
    ),
    8080 // Puerto en el que se ejecutará el servidor WebSocket
);

echo "Servidor WebSocket iniciado en el puerto 8080\n";

$server->run();
?>
