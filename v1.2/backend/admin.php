<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();

$admin = 2;


if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

    switch($formulario){

    case 'form_pl_agregar':

      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];

     insertaPlaca($nombre, $descripcion, $conexion);
    
    break;


    case 'form_pl_modificar':


      $placa = $_POST['placa'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];

     modificaPlaca($placa, $nombre, $descripcion, $conexion);

    
    break;

    case 'func_pl_eliminar':

      $placa = $_POST['placa'];

    eliminaPlaca($placa,$conexion);
    
    break;


    case 'form_disp_agregar':

      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $unidad = $_POST['unidad'];
      $tipo = $_POST['tipo'];

     insertaDispositivo($nombre, $descripcion, $unidad, $tipo, $conexion);
    
    break;


    case 'func_disp_eliminar':

      $dispositivo = $_POST['dispositivo'];
      eliminaDispositivo($dispositivo,$conexion);
    
    break;


    case 'form_disp_modificar':

      $dispositivo = $_POST['dispositivo'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $unidad = $_POST['unidad'];
      $tipo = $_POST['tipo'];

     modificaDispositivo($dispositivo, $nombre, $descripcion, $unidad, $tipo, $conexion);

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
?>