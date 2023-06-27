<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();


if(isset($_POST['funcion'])){

$funcion = $_POST['funcion'];

switch($funcion){
    
case 'cargarProductos':
    $seccion = $_POST['seccion'];
cargaproductosSeccion($seccion);
break;


case 'agregarProducto':
    $seccion = $_POST['seccion'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    agregarProducto($seccion,$nombre,$descripcion,$conexion);

break;

case 'modificarProducto':
    $producto = $_POST['producto'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    modificarProducto($producto,$nombre,$descripcion,$conexion);

break;

case 'eliminarProducto':
    $producto = $_POST['producto'];
    eliminarProducto($producto,$conexion);
break;

case 'agregarPlaca':
    $producto = $_POST['producto'];
    $placa = $_POST['placa'];
    $descripcion = $_POST['descripcion'];
    $ip =  $_POST['ip'];

    agregarPlaca($producto,$placa,$descripcion,$ip,$conexion);

break;


case 'modificarPlaca':
    $placa = $_POST['placa'];
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    $ip =  $_POST['ip'];

    modificarPlaca($placa, $producto, $descripcion,$ip,$conexion);
break;

case 'eliminarPlaca':
    $placa = $_POST['placa'];
    $producto = $_POST['producto'];
    eliminarPlaca($placa, $producto,$conexion);
break;

case 'agregarDispositivo':
    $producto = $_POST['producto'];
    $dispositivo = $_POST['dispositivo'];
    $placa = $_POST['placa'];

    agregarDispositivo($producto,$dispositivo,$placa,$conexion);

break;

case 'modificarDispositivo':
    $dispositivo = $_POST['dispositivo'];
    $producto = $_POST['producto'];
    $nombre = $_POST['nombre'];
    $unidad = $_POST['unidad'];
    $placa = $_POST['placa'];
    $tipo = $_POST['tipo'];

    modificarDispositivo($dispositivo,$producto,$nombre,$unidad,$placa,$tipo,$conexion);

break;

case 'eliminarDispositivo':
    $dispositivo = $_POST['dispositivo'];
    $producto = $_POST['producto'];
    eliminarDispositivo($dispositivo, $producto,$conexion);
    
break;


default:
?>
<script>muestraMensajes('No se encontró la función, verifica','error');</script>
<?php
break;

}
}else{
    ?>
           <script>alert('¿Qué estas haciendo?'); window.location.href='../frontend/index.php';</script>
    <?php
}