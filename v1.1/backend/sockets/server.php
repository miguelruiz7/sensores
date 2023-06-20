<?php
#Incluimos nuestras dependencias 
include('conexion.php');
include('funciones.php');

#Proporcionamos datos de nuestro servidor socket
$host = '0.0.0.0';
$port = 1234;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $host, $port);
socket_listen($socket);

echo "Servidor en ejecución. Esperando conexiones..." . PHP_EOL;

while (true) {
    $clientSocket = socket_accept($socket);
    // Recibir el mensaje del cliente
    $valores = socket_read($clientSocket, 1024);

// Procesar el mensaje recibido
#echo "Valores sensados: " . $valores . PHP_EOL;

//Insertamos en la base de datos
insertarDatos($valores, $conexion);

}


?>