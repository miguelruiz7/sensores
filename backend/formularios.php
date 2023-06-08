<?php
include('../backend/conexion.php');
include('iconos.php');


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
          ?>
          <script>muestraMensajes('Se agrego exitosamente',''); $('#formulariomodal').modal('hide');  cargarEspacios(); </script>
          <?php
        }else{
            ?>
          <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
          <?php
        }


        break;

        case 'eliminarEspacio':
          $id = $_POST['id'];  


          $consulta = "DELETE FROM esp_mst WHERE esp_id ='$id'";
  
          $eliminaEspacio = mysqli_query($conexion, $consulta);
  
          if($eliminaEspacio){
            ?>
            <script>muestraMensajes('Se eliminó exitosamente',''); cargarEspacios(); </script>
            <?php
          }else{
              ?>
            <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
            <?php
          }
  
  
          break;



    


        default:
        echo 'Error al comunicar con el sistema';
        break;

          }}else{
            echo "<script>alert('¿Qué estas haciendo?')</script>";
          }
?>