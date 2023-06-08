<?php
// Crear un socket de escucha
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Error al crear el socket: " . socket_strerror(socket_last_error()) . "\n";
    exit;
}

// Vincular el socket a una dirección y puerto
$resultado = socket_bind($socket, '10.10.100.57', 1211);
if ($resultado === false) {
    echo "Error al vincular el socket: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Escuchar conexiones entrantes
$resultado = socket_listen($socket);
if ($resultado === false) {
    echo "Error al escuchar el socket: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Aceptar una conexión entrante
$clienteSocket = socket_accept($socket);
if ($clienteSocket === false) {
    echo "Error al aceptar la conexión: " . socket_strerror(socket_last_error($socket)) . "\n";
    exit;
}

// Leer los comandos del cliente y controlar el LED
while (true) {
    $comando = socket_read($clienteSocket, 1024);
    if ($comando === 'ON') {
           // Enviar señal para encender el LED en la Raspberry Pi
           // (puedes usar algún otro método para comunicarte con la Raspberry Pi, como una API REST)
           // Ejemplo: realizar una solicitud HTTP a la Raspberry Pi
           $url = 'http://10.10.100.57/encender_led.php';
           $response = file_get_contents($url);

           // Enviar respuesta al cliente
           socket_write($clienteSocket, $response, strlen($response));
       } elseif ($comando === 'OFF') {
           // Enviar señal para apagar el LED en la Raspberry Pi
           // Ejemplo: realizar una solicitud HTTP a la Raspberry Pi
           $url = 'http://10.10.100.57/apagar_led.php';
           $response = file_get_contents($url);

           // Enviar respuesta al cliente
           socket_write($clienteSocket, $response, strlen($response));
       }
   }

   // Cerrar el socket del cliente
   socket_close($clienteSocket);

   // Cerrar el socket de escucha
   socket_close($socket);
   ?>
