<?php
# Incluimos nuestras dependencias 
include('conexion.php');
include('funciones.php');

# Proporcionamos datos de nuestro servidor socket
$host = '0.0.0.0';
$port = 1234;

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, $host, $port);
socket_listen($socket);

echo "Servidor en ejecución. Esperando conexiones..." . PHP_EOL;

while (true) {
    $clientSocket = socket_accept($socket);
    
    // Configuramos un tiempo de espera de 5 segundos para la conexión
    socket_set_option($clientSocket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 5, 'usec' => 0));
    
    // Recibir el mensaje del cliente
    $valores = socket_read($clientSocket, 8192); // Aumentamos el tamaño del búfer
    
    if ($valores === false) {
        echo "Error al recibir datos: " . socket_strerror(socket_last_error($clientSocket)) . PHP_EOL;
        socket_close($clientSocket);
        continue;
    }

    // Procesar el mensaje recibido
    echo "Valores sensados: " . $valores . PHP_EOL;

    // Insertamos en la base de datos
    insertarDatos($valores, $conexion);

    socket_close($clientSocket);
}

// La función insertarDatos() debe estar definida en el archivo funciones.php
// y debe manejar la inserción de datos en la base de datos de manera óptima.

?>
