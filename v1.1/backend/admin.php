<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();

$admin = 2;


if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

switch($formulario){

  #Insertar rol
    case 'agregaRol':

    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $gral_lectura = $_POST['gral_lectura'];
    $gral_escritura = $_POST['gral_escritura'];
    $esp_lectura = $_POST['esp_lectura'];
    $esp_escritura = $_POST['esp_escritura'];
    $sec_lectura = $_POST['sec_lectura'];
    $sec_escritura = $_POST['sec_escritura'];
    $prod_lectura = $_POST['prod_lectura'];
    $prod_escritura = $_POST['prod_escritura'];
    $disp_lectura = $_POST['disp_lectura'];
    $disp_escritura = $_POST['disp_escritura'];
  
    insertaRol($nombre, $descripcion, $gral_lectura, $gral_escritura, $esp_lectura, $esp_escritura, $sec_lectura, $sec_escritura, $prod_lectura, $prod_escritura, $disp_lectura, $disp_escritura, $conexion);

     break;


    #Eliminar rol
    case 'eliminaRol':

        $rol = $_POST['rol'];

        
        
        eliminaRol($rol, $conexion);

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