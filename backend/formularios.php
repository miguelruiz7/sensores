<?php
include('../backend/conexion.php');

include('../backend/controladorSesion.php');
sesion_usr();
// Almacenamos esto en variables
$sesion=sesion_usr();
$rol_defecto = rol_defecto($sesion, $conexion);

if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

switch($formulario){
    case 'espacio':
        $nombre = $_POST['nombre'];
        $espacio = $_POST['espacio'];
        $descripcion = $_POST['descripcion'];
        $area = $_POST['area'];
        $ubicacion = $_POST['ubicacion'];

        $consulta = "INSERT INTO esp_mst VALUES (NULL, '$nombre', '$descripcion','$area','$ubicacion','$espacio')";
        $agregaEspacio = mysqli_query($conexion, $consulta);

        if($agregaEspacio){
          $consulta = "SELECT MAX(esp_id) AS ultimo_valor FROM esp_mst";
            $buscaEspacio = mysqli_query($conexion, $consulta);
            if(mysqli_num_rows($buscaEspacio)>0){
              $obtenerDatos = mysqli_fetch_array($buscaEspacio);
            }

            $espacio_id = $obtenerDatos['ultimo_valor'];

            if($rol_defecto == 1){ 
              $rol = 2;
            }
          
          //Inserción
          $consulta = "INSERT INTO esp_det VALUES (NULL, '$espacio_id','$sesion', '$rol');";
          $agregaEspacioUsuario = mysqli_query($conexion, $consulta);
          if($agregaEspacioUsuario){
            ?>
            <script>muestraMensajes('Se agrego exitosamente',''); $('#formulariomodal').modal('hide');  cargarEspacios(); revertirFormulario() </script>
            <?php
          }else{
            ?>
          <script>muestraMensajesFormularios('Ocurrio algún error verifica (1)','error');</script>
          <?php
          }
        }else{
          ?>
          <script>muestraMensajesFormularios('Ocurrio algún error verifica (2)','error');</script>
          <?php
        }
      


        break;

        case 'eliminarEspacio':
          $id = $_POST['id'];  
          $detectaRolUsr = detectarRolEspacio($id, $sesion, $conexion);
          if($detectaRolUsr == 2 ){
          $consulta = "DELETE FROM esp_det WHERE esp_esp_id ='$id'";
          $eliminaEspacioUsuario = mysqli_query($conexion, $consulta); 
          
           if($eliminaEspacioUsuario){
          $consulta = "DELETE FROM esp_mst WHERE esp_id ='$id'";
          $eliminaEspacio = mysqli_query($conexion, $consulta);
  
          if($eliminaEspacio){
            ?>
            <script>muestraMensajes('Se eliminó exitosamente',''); cargarEspacios();  </script>
            <?php
          }else{
              ?>
            <script>muestraMensajes('Ocurrio algún error verifica (2)','error');</script>
            <?php
          }
        }else{
          ?>
          <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
          <?php
        }
      }else{
        ?>
        <script>muestraMensajes('No tienes privilegios para eliminar','error');</script>
        <?php
      }
  
          break;


          case 'modificarEspacio':

            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $espacio = $_POST['espacio'];
            $descripcion = $_POST['descripcion'];
            $area = $_POST['area'];
            $ubicacion = $_POST['ubicacion'];
    
    
            $consulta = "UPDATE esp_mst SET esp_nom = '$nombre', esp_desc = '$descripcion', esp_area ='$area', esp_geo ='$ubicacion', esp_espt_id ='$espacio' WHERE esp_id='$id'";
    
            $modificaEspacio = mysqli_query($conexion, $consulta);
    
            if($modificaEspacio){
              ?>
              <script>muestraMensajes('Se modificó exitosamente',''); $('#formulariomodal').modal('hide');  cargarEspacios(); revertirFormulario(); </script>
              <?php
            }else{
                ?>
              <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
              <?php
            }
    
    
            break;


            case 'eliminarUsuario':
              $usuario = $_POST['usuario'];  

             
              #Consulta para determinar a que espacio pertenece antes de eliminar
              $consulta = "SELECT * FROM esp_det WHERE esp_id_ = '$usuario'";
              $buscaEspacioUsr = mysqli_query($conexion, $consulta);

              if(mysqli_num_rows($buscaEspacioUsr)>0){
                $datos = mysqli_fetch_array($buscaEspacioUsr);
              }

                #Almacenar el dato en una variable
              $espacio = $datos['esp_esp_id'];

              #Identificamos el rol para que unicamente el admin elimine
              $detectaRolUsr = detectarRolUsuario($sesion, $conexion);
              
              if($detectaRolUsr == 2 ){
              $consulta = "DELETE FROM esp_det WHERE esp_id_ ='$usuario'";
              $eliminaUsuario = mysqli_query($conexion, $consulta); 
              
               if($eliminaUsuario){
                ?>
                <script>muestraMensajes('Se eliminó exitosamente al usuario',''); formUsuariosEsp('<?php echo $espacio; ?>');</script>
                <?php

            }else{
              ?>
              <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
              <?php
            }
          }else{
            ?>
            <script>muestraMensajes('No tienes privilegios para eliminar','error');</script>
            <?php
          }
      
              break;



              case 'modificarUsuario':
                $id_usuario = $_POST['id'];  
                $id_espacio = $_POST['espacio']; 
                $nombre = $_POST['nombre']; 
                $id_rol = $_POST['rol'];
              
                $detectaRolUsr = detectarRolUsuario($sesion, $conexion);
                if($detectaRolUsr == 2 ){
                 
                $consulta = "UPDATE esp_det SET esp_usrol_id = '$id_rol' WHERE esp_usr_id ='$id_usuario' AND esp_esp_id ='$id_espacio'";
                $modificaRol = mysqli_query($conexion, $consulta); 

                 if($modificaRol){
             
                  $consulta = "UPDATE usr_mst SET usr_nom = '$nombre' WHERE usr_id ='$id_usuario'";
                  $modificaNombre = mysqli_query($conexion, $consulta); 

                  if($modificaNombre){
                    ?>
                    <script>muestraMensajes('Se modificaron los datos',''); formUsuariosEsp(<?php echo $id_espacio; ?>);</script>
                    <?php
                  }else{
                    ?>
                    <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
                    <?php

                  }
  
              }else{
                ?>
                <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
                <?php
              }
            }else{
              ?>
              <script>muestraMensajes('No tienes privilegios para eliminar','error');</script>
              <?php
            }

                break;


        default:
        echo 'Error al comunicar con el sistema';
        break;

          }}else{
            ?>
           <script>alert('¿Qué estas haciendo?'); window.location.href='../frontend/index.php';</script>
            <?php
          }
?>