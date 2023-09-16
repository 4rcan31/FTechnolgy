<?php
$host = "localhost"; // Reemplaza con la dirección IP o el nombre de host del servidor
$port = 12345; // Reemplaza con el puerto del servidor al que deseas conectarte

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

if ($socket === false) {
    echo "Error creando el socket: " . socket_strerror(socket_last_error()) . "\n";
    exit(1);
}

if (!socket_connect($socket, $host, $port)) {
    echo "Error conectando al servidor: " . socket_strerror(socket_last_error()) . "\n";
    exit(1);
}

echo "Conectado al servidor en $host:$port\n";

// A partir de este punto, puedes enviar y recibir datos desde el servidor usando el socket.

// Ejemplo de envío de datos al servidor
$message = "ping";
socket_write($socket, $message, strlen($message));

// Ejemplo de lectura de datos del servidor
$response = socket_read($socket, 2048); // Lee hasta 2048 bytes de datos del servidor
echo "Respuesta del servidor: $response\n";

// Cierra la conexión cuando hayas terminado
socket_close($socket);
