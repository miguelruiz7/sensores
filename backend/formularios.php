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
          $consulta = "SELECT * FROM esp_mst WHERE esp_nom = '$nombre' AND esp_desc = '$descripcion'";
            $buscaEspacio = mysqli_query($conexion, $consulta);
            if(mysqli_num_rows($buscaEspacio)>0){
              $obtenerDatos = mysqli_fetch_array($buscaEspacio);
            }

            $espacio_id = $obtenerDatos['esp_id'];

            if($rol_defecto == 1){ 
              $rol = 2;
            }
          
          //Inserción
          $consulta = "INSERT INTO aeu_mst VALUES ('$sesion', '$espacio_id', '$rol');";
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
          $detectaRolUsr = detectarRolEspacio($sesion, $id, $conexion);
          if($detectaRolUsr == 2 ){
          $consulta = "DELETE FROM aeu_mst WHERE aeu_esp_id ='$id'";
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
              $espacio = $_POST['espacio'];  

              $detectaRolUsr = detectarRolEspacio($sesion, $espacio, $conexion);
              if($detectaRolUsr == 2 ){
              $consulta = "DELETE FROM aeu_mst WHERE aeu_usr_id ='$usuario' AND aeu_esp_id ='$espacio'";
              $eliminaUsuario = mysqli_query($conexion, $consulta); 
              
               if($eliminaUsuario){
                ?>
                <script>muestraMensajes('Se eliminó exitosamente al usuario',''); formUsuariosEsp(<?php echo $espacio; ?>);</script>
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

        default:
        echo 'Error al comunicar con el sistema';
        break;

          }}else{
            ?>
           <script>alert('¿Qué estas haciendo?'); window.location.href='../frontend/index.php';</script>
            <?php
          }
?>