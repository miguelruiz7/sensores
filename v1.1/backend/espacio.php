<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();



$admin = 2;


if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

switch($formulario){

  #Insertar espacio
    case 'agregaEspacio':
      #Variables
      $nombre = $_POST['nombre'];
      $espacio = $_POST['espacio'];
      $descripcion = $_POST['descripcion'];
      $area = $_POST['area'];
      $ubicacion = $_POST['ubicacion'];
  
      insertaEspacio($nombre, $descripcion, $area, $ubicacion, $espacio, $conexion, $sesion);

     break;
     
  #Eliminar espacio
    case 'eliminarEspacio':
      #Variables
      $id = $_POST['id'];  
      $detRol = detectarRolUsuarioEspacio($id, $sesion, $conexion);
      $detCreador = detectarCreador($id, $conexion);

      if(1 == 1){
        if($detCreador == $sesion){
      eliminaEspacio($id, $conexion);
        }else{
          ?>
        <script>muestraMensajes('Solamente el administrador puede eliminar','error');</script>
        <?php
        }
      }else{
        ?>
        <script>muestraMensajes('No tienes los privilegios suficientes para eliminar','error');</script>
        <?php
      }

    break;

  #Modificar espacio
    case 'modificarEspacio':

      $id = $_POST['id'];
      $nombre = $_POST['nombre'];
      $espacio = $_POST['espacio'];
      $descripcion = $_POST['descripcion'];
      $area = $_POST['area'];
      $ubicacion = $_POST['ubicacion'];
     
      $detRol = detectarRolUsuarioEspacio($id, $sesion, $conexion);

      if($detRol == $admin){
        actualizaEspacio($id, $nombre, $descripcion, $area, $ubicacion, $espacio, $conexion);
      }else{
        ?>
        <script>muestraMensajes('No tienes los privilegios suficientes para actualizar','error'); revertirFormularios();</script>
        <?php
      }

    break;

  #Eliminar usuario
    case 'eliminarUsuario':
      $usuario = $_POST['usuario'];  

      eliminaUsuario($usuario, $conexion);

    break;


  #Modificar usuario
    case 'modificarUsuario':
      $id_usuario = $_POST['id'];  
      $id_espacio = $_POST['espacio']; 
      $nombre = $_POST['nombre']; 
      $id_rol = $_POST['rol'];
    
       modificaUsuario($id_usuario,$id_espacio,$nombre,$id_rol,$conexion);

    break;

    
  #Asigna a espacio usuario
  case 'asignarUsuario':
    $id_espacio = $_POST['espacio']; 
    $nombre = $_POST['nombre']; 
    $id_rol = $_POST['rol'];
  
     asignarUsuario($nombre,$id_espacio,$id_rol,$conexion);

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