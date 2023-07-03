<?php
include('conexion.php');
include('funciones.php');
sesion_usr();
$sesion=sesion_usr();

$admin = 2;


if(isset($_POST['funcion'])){

  $formulario = $_POST['funcion'];

    switch($formulario){

      ##########################################################
      #
      #                    Placas(FUNCIONANDO)
      #
      ##########################################################

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


      ##########################################################
      #
      #                   Dispositivos(FUNCIONANDO)
      #
      ##########################################################


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


      ##########################################################
      #
      #                    Roles(FUNCIONANDO)
      #
      ##########################################################


      case 'form_rol_agregar':

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


         


      case 'form_rol_modificar':

  

          $usrol = $_POST['usrol'];
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

          modificaRol($usrol,$nombre, $descripcion, $gral_lectura, $gral_escritura, $esp_lectura, $esp_escritura, $sec_lectura, $sec_escritura, $prod_lectura, $prod_escritura, $disp_lectura, $disp_escritura, $conexion);

        break;
    
    
        #Eliminar rol
        case 'func_rol_eliminar':
    
            $rol = $_POST['rol'];
    
            eliminaRol($rol, $conexion);
    
             break;


      ##########################################################
      #
      #                        Administrador
      #
      ##########################################################

      case 'form_usr_admin':
    
        $usuario = $_POST['usuario'];

        asignaAdministrador($usuario, $conexion);

      break;

      ##########################################################
      #
      #               Tipos de espacio (TERMINADO)
      #
      ##########################################################

      case 'form_esp_tipo_agregar':
        
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        agregarTipoEspacio($nombre,$descripcion,$conexion);
      break;


      case 'form_esp_tipo_modificar':
        
        $tipoEspacio = $_POST['tipoEspacio'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        modificarTipoEspacio($tipoEspacio, $nombre,$descripcion,$conexion); 
      break;

      case 'func_esp_tipo_eliminar':
        
        $tipoEspacio = $_POST['tipoEspacio'];
        
        eliminarTipoEspacio($tipoEspacio, $conexion); 

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