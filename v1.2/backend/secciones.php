<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();


if(isset($_POST['funcion'])){

$funcion = $_POST['funcion'];

switch($funcion){
    
case 'cargarSeccion':
    $espacio = $_POST['espacio'];
cargaseccionEspacio($espacio);
break;

case 'agregarSeccion':
    $espacio = $_POST['espacio'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    agregarSeccion($espacio,$nombre,$descripcion,$conexion);

break;

case 'modificarSeccion':
    $seccion = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    modificarSeccion($seccion,$nombre,$descripcion,$conexion);

break;


case 'eliminarSeccion':
    $seccion = $_POST['id'];
    eliminarSeccion($seccion,$conexion);
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