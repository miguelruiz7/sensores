<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();



$admin = 2;


if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

switch($formulario){

  #Insertar usuario
    case 'form_usr_agregar':
      #Variables
      $nombre = $_POST['nombre'];
     # $rol = $_POST['rol'];
      $usuario = $_POST['usuario'];
      $contrasena = $_POST['contrasena'];
      $contrasenacon = $_POST['contrasenacon'];
  
      insertaUsuario($nombre, $usuario, $contrasena, $contrasenacon, $conexion);

     break;


     
  #Modificar contrasena usuario
    case 'modificarContrasena':
      #Variables
      $usuario = $_POST['usuario'];
      $contrasena = $_POST['contrasena'];
      $contrasenacon = $_POST['contrasenacon'];
  
      modificarContrasena($usuario,$contrasena,$contrasenacon,$conexion);

     break;


        
  #Modificar datos usuario
    case 'modificarDatos':
      #Variables
      $usuario = $_POST['usuario'];
      $nombre = $_POST['nombre'];
  
      modificarDatos($usuario,$nombre,$conexion);

     break;



    #Modificar datos usuario
    case 'eliminarUsuario':
      #Variables
      $usuario = $_POST['usuario'];
    
      eliminarUsuario($usuario,$conexion);
      
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