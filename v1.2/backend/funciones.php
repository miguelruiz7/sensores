<?php

####################################################################################################
#                                                                                                  #
#                   Almacena funciones que controlan la sesion del usuario                         #
#                                                                                                  #
####################################################################################################


session_start();

#Validación de datos para acceso al sistema
function acceso($usuario,$password,$conexion){
    include('../frontend/iconos.php');
    $errores = '';
    $clasesusr = '';
    $clasespwd = '';
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
   
         #Valida si el usuario esta en la base de datos
        $usr=mysqli_query($conexion,"SELECT usr_usu FROM usr_mst WHERE usr_usu = '$usuario';");
        if (mysqli_num_rows($usr)==0)
        {
           # Limpiamos los campos
          if(isset($_SESSION['usuario'])){}else{
            $errores.= '<div class="alert spinner-grow text-dark" role="status"></div>';
            $errores.= '<div class="container"><div class="alert text-dark" role="status">No existe, verifica los datos</div></div>';

            $errores.= "<script>document.getElementById('login').reset();</script>";
            $errores.= "<script>document.getElementById('usuario').classList.remove('valido');</script>";
            $errores.= "<script>document.getElementById('contrasena').classList.remove('invalido');</script>";
            $errores.= "<script>document.getElementById('contrasena').classList.remove('valido');</script>";
          }
    
        }else{
            if(isset($_SESSION['usuario'])){}else{
            $clasesusr .= "<script>document.getElementById('usuario').classList.add('valido');</script>";
            }
        }
        
        #Valida si la contraseña coincide en la base de datos descifrada.
    $usr=mysqli_query($conexion,"SELECT usr_con FROM usr_mst WHERE usr_usu = '$usuario';");
    if (mysqli_num_rows($usr)>0)
    {
        $columnas = mysqli_fetch_array($usr);
        $hash= $columnas['usr_con'];
        if(password_verify($password, $hash) != 1){
            $clasespwd .= "<script>document.getElementById('contrasena').classList.add('invalido');</script>";
            $errores.= '<div class="alert spinner-grow text-dark" role="status"></div>';
            $errores.= '<div class="container"><div class="alert text-dark" role="status">Verifica los datos</div></div>';
        }else{
            $clasespwd .= "<script>document.getElementById('contrasena').classList.remove('invalido');</script>";
            $clasespwd .= "<script>document.getElementById('contrasena').classList.add('valido');</script>";
            #Selecciona el usuario
            $selusr=mysqli_query($conexion,"SELECT * FROM usr_mst WHERE usr_usu = '$usuario';");
            if(mysqli_num_rows($selusr)>0){
                    $selusuario = mysqli_fetch_array($selusr);
                    $usuario = $selusuario['usr_id'];
                  
            }
            #Se asigna la sesion en el sistema, posteriormente se dirige a la página principal
            $_SESSION['usr_id'] = $usuario;
          
            $errores.='<div class="spinner-border text-dark" role="status"><span class="visually-hidden">Loading...</span></div>';

            $errores.="<script type='text/javascript'> var n = 2; window.setInterval(function(){
                n--;
                // Si se cumple la condición te redirige a la página de inicio
                if(n == 0){
                location.href = 'espacios_mst.php';
            }
            },1000);
            </script>";
          
        }
    }
    }
    echo $errores;
    echo $clasesusr;
    echo $clasespwd;
    return;
}

# Comprueba que haya sesion
function sesion_usr(){
    if (isset($_SESSION['usr_id'])) {
        $sesion = $_SESSION['usr_id'];
    } else {
        $sesion = '';
       header('Location:acceso.php');
       exit();
    }
    return $sesion;
}


# Comprueba de que haya sesion nos redirige a la pagina principal
function sesion_login(){
    if (isset($_SESSION['usr_id']) || isset($_SESSION['admin_id']) ) {
        header('Location: espacios_mst.php');
    }
    return;
}

#Destruye las variables de sesion
function cerrarsesion(){
    unset($_SESSION["usr_id"]);
    if(isset($_GET['redirect'])) {
     header('Location: '.base64_decode($_GET['redirect']));  
    } else {
     header('Location:../frontend/acceso.php');  
    }
    return;
}



#Destruye las variables de la plataforma
function destruirvariables(){
 # unset($_SESSION["esp_id"]);
  unset($_SESSION["sec_id"]);
  return;
}


#Identifica si es administrador del sistema.
function administradorSistema($sesion, $conexion){         
  $consulta = "SELECT usr_sistema FROM usr_mst WHERE usr_id = '$sesion'";
  $detectarol = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($detectarol)>0){
          # Si existe un registro despliega toda la informacion que exista
          $dato = mysqli_fetch_array($detectarol);
          $resultado = $dato['usr_sistema'];
          
        }else{
          $resultado = '';
        }
        return $resultado;
}


#Identifica si es administrador de la plataforma.
function administradorPlataforma($sesion, $conexion){
  $consulta = "SELECT usr_admin FROM usr_det WHERE usr_usr_id='$sesion'";
  $esadminPlataforma = mysqli_query($conexion,$consulta);
  if(mysqli_num_rows($esadminPlataforma)>0){
    $valor = '1';
  }else{
    $valor = '0';
  }

  return $valor;
}


#Verifica que permisos tiene de lectura y escritura en el espacio
function rolPlataforma($sesion, $espacio, $conexion){
  $consulta = "SELECT * FROM esp_det, usrol_mst WHERE esp_usr_id='$sesion' AND esp_esp_id = '$espacio' AND usrol_id = esp_usrol_id";
  $rolPlataforma = mysqli_query($conexion,$consulta);
  if(mysqli_num_rows($rolPlataforma)>0){
   $datos = mysqli_fetch_array($rolPlataforma);

   #Aqui ingresamos las variables

  # General
    $usrol_gral_lec = $datos['usrol_gral_lec'];
    $usrol_gral_esc = $datos['usrol_gral_esc'];

  # Espacio
    $usrol_esp_lec  = $datos['usrol_esp_lec'];
    $usrol_esp_esc  = $datos['usrol_esp_esc'];
  
  # Secciones
    $usrol_sec_lec  = $datos['usrol_sec_lec'];
    $usrol_sec_esc  = $datos['usrol_sec_esc'];

  # Productos
    $usrol_prod_lec = $datos['usrol_prod_lec'];
    $usrol_prod_esc = $datos['usrol_prod_esc'];


  # Dispositivos
    $usrol_disp_lec	= $datos['usrol_disp_lec'];
    $usrol_disp_esc = $datos['usrol_disp_esc'];



   $valores = array('usrol_gral_lec' => $usrol_gral_lec, 'usrol_gral_esc' => $usrol_gral_esc, 'usrol_esp_lec' => $usrol_esp_lec, 'usrol_esp_esc' => $usrol_esp_esc, 'usrol_prod_lec' => $usrol_prod_lec, 'usrol_prod_esc' => $usrol_prod_esc, 'usrol_sec_lec' => $usrol_sec_lec, 'usrol_sec_esc' => $usrol_sec_esc, 'usrol_disp_lec' => $usrol_disp_lec,  'usrol_disp_esc' => $usrol_disp_esc);
   
  }else{
    $valores = '';
  }

  return $valores;
}

####################################################################################################
#                                                                                                  #
#                                           Socket                                                 #
#                                                                                                  #
####################################################################################################


function insertarDatos($documento, $conexion)
{
    $datos = json_decode($documento);

    // Verificar si el JSON es válido
    if ($datos === null) {
        echo 'Error: JSON mal formado.' . PHP_EOL;
        return;
    }

    $id = $datos->id;
    $valores = $datos->valor;

    date_default_timezone_set('America/Mexico_City');
    $fecha_cap = date('Y-m-d H:i:s', time());

    // Verificar si el dispositivo existe en la tabla disp_det usando una consulta preparada
    $consulta = "SELECT disp_id_ FROM disp_det WHERE disp_id_ = ?";
    $stmt = mysqli_prepare($conexion, $consulta);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        // El dispositivo existe, insertar datos en la tabla dato_mst usando una consulta preparada
        $consultaInsertar = "INSERT INTO dato_mst VALUES (NULL, ?, ?, ?)";
        $stmtInsertar = mysqli_prepare($conexion, $consultaInsertar);
        mysqli_stmt_bind_param($stmtInsertar, 'sss', $valores, $fecha_cap, $id);
        $conecta = mysqli_stmt_execute($stmtInsertar);

        if ($conecta) {
            echo 'Los datos han sido transferidos a la base de datos (dispositivo: ' . $id . ', valor: ' . $valores . ', fecha_cap: ' . $fecha_cap . ')' . PHP_EOL;
        } else {
            echo 'Fallo al insertar datos.' . PHP_EOL;
        }

        mysqli_stmt_close($stmtInsertar);
    } else {
        echo 'Los datos no han sido transferidos a la base de datos (dispositivo: ' . $id . ', valor: ' . $valores . ', fecha_cap: ' . $fecha_cap . ')' . PHP_EOL;
    }

}



####################################################################################################
#                                                                                                  #
#                   Almacena funciones que funcionan en la vista del placas                        #
#                                                                                                  #
####################################################################################################


function insertaPlaca($nombre, $descripcion, $conexion){

    $consulta = "INSERT INTO pl_mst VALUES (NULL, '$nombre', '$descripcion')";
  
    $insertarPlaca = mysqli_query($conexion, $consulta);
  
    if($insertarPlaca){
      ?>
      <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'), cargarPlacas();  </script>
      <?php
    }else{
        ?>
      <script>muestraMensajes('Ocurre un error verifica',''); </script>
      <?php
    }
  
   return;
}


function modificaPlaca($placa, $nombre, $descripcion, $conexion){

  $consulta = "UPDATE  pl_mst SET pl_nom = '$nombre', pl_desc = '$descripcion' WHERE pl_id = '$placa'";

  $modificarPlaca = mysqli_query($conexion, $consulta);

  if($modificarPlaca){
    ?>
    <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'), cargarPlacas();  </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurre un error verifica',''); </script>
    <?php
  }

 return;
}


function eliminaPlaca($placa, $conexion){

  $consulta = "DELETE FROM pl_mst WHERE pl_id = '$placa'";

  $eliminarPlaca = mysqli_query($conexion, $consulta);

  if($eliminarPlaca){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); cargarPlacas(); </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurre un error verifica',''); </script>
    <?php
  }

 return;
}


####################################################################################################
#                                                                                                  #
#                   Almacena funciones que funcionan en la vista del dispositivos                  #
#                                                                                                  #
####################################################################################################


function insertaDispositivo($nombre, $descripcion, $unidad, $tipo, $conexion){

  $consulta = "INSERT INTO disp_mst VALUES (NULL, '$nombre', '$descripcion','$unidad','$tipo')";

  $insertarDispositivo = mysqli_query($conexion, $consulta);

  if($insertarDispositivo){
    ?>
    <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'), cargarDispositivos();  </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurre un error verifica',''); </script>
    <?php
  }

 return;
}


function modificaDispositivo($dispositivo, $nombre, $descripcion, $unidad, $tipo, $conexion){

$consulta = "UPDATE disp_mst SET disp_nom = '$nombre', disp_desc_gral = '$descripcion', disp_dum_id = '$unidad', disp_disp_tipo_id = '$tipo' WHERE disp_id = '$dispositivo'";

$modificarDispostivivo = mysqli_query($conexion, $consulta);

if($modificarDispostivivo){
  ?>
  <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'), cargarPlacas();  </script>
  <?php
}else{
    ?>
  <script>muestraMensajes('Ocurre un error verifica',''); </script>
  <?php
}

return;
}


function eliminaDispositivo($dispositivo, $conexion){

$consulta = "DELETE FROM disp_mst WHERE disp_id = '$dispositivo'";

$eliminarDispositivo = mysqli_query($conexion, $consulta);

if($eliminarDispositivo){
  ?>
  <script>muestraMensajes('Se eliminó exitosamente',''); cargarPlacas(); </script>
  <?php
}else{
    ?>
  <script>muestraMensajes('Ocurre un error verifica',''); </script>
  <?php
}

return;
}





####################################################################################################
#                                                                                                  #
#                   Almacena funciones que funcionan en la vista del espacio                       #
#                                                                                                  #
####################################################################################################

# Detecta el creador del espacio
function detectarCreador($espacio, $conexion){
$consulta = "SELECT * FROM esp_mst  WHERE esp_id = '$espacio'";
$detectarolNativo = mysqli_query($conexion, $consulta);

      if(mysqli_num_rows($detectarolNativo)>0){
        # Si existe un registro despliega toda la informacion que exista
        $dato = mysqli_fetch_array($detectarolNativo);
        $resultado = $dato['esp_crea'];
        
      }else{
        $resultado = '';
      }
      return $resultado;
}

#Contea el numero de usuarios que existen en el espacio
function conteoUsuarios($id,$conexion){
  $consulta = "SELECT COUNT(esp_usr_id) as usuarios FROM esp_det WHERE esp_esp_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['usuarios'];

  return $conteo;
}

#Contea el numero de usuarios que existen en las secciones
function conteoSecciones($id,$conexion){
  $consulta = "SELECT COUNT(sec_id) as secciones FROM sec_mst WHERE sec_esp_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['secciones'];

  return $conteo;
}

#Crea un nuevo espacio
function insertaEspacio($nombre, $descripcion, $area, $ubicacion, $espacio, $conexion, $sesion){
     
    
    $consulta = "INSERT INTO esp_mst VALUES (NULL, '$nombre', '$descripcion','$area','$ubicacion','$espacio')";
    $agregaEspacio = mysqli_query($conexion, $consulta);

    if($agregaEspacio){
        ?>
        <script>muestraMensajes('Se agrego exitosamente',''); $('#formulariomodal').modal('hide');  cargarEspacios(); revertirFormulario() </script>
        <?php
      
    }else{
      ?>
      <script>muestraMensajesFormularios('Ocurrio algún error verifica (2)','error');</script>
      <?php
    } 
  
   return;
}


#Elimina el espacio
function eliminaEspacio(int $espacio_id, $conexion){


  $consulta = "DELETE FROM sec_mst WHERE sec_esp_id ='$espacio_id'";
  $eliminaSecciones = mysqli_query($conexion, $consulta); 

  if($eliminaSecciones){
    $consulta = "DELETE FROM esp_det WHERE esp_esp_id ='$espacio_id'";
    $eliminaEspacioUsuario = mysqli_query($conexion, $consulta); 
    
     if($eliminaEspacioUsuario){
    $consulta = "DELETE FROM esp_mst WHERE esp_id ='$espacio_id'";
    $eliminaEspacio = mysqli_query($conexion, $consulta);

    if($eliminaEspacio){
      ?>
      <script>muestraMensajes('Se eliminó exitosamente',''); cargarEspacios();  </script>
      <?php
    }else{
        ?>
      <script>muestraMensajes('Ocurrio algún error verifica (3)','error');</script>
      <?php
    }
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

   return;
}


#Actualiza el espacio
function actualizaEspacio($id, $nombre, $descripcion, $area, $ubicacion, $espacio, $conexion){
     
    
    $consulta = "UPDATE esp_mst SET esp_nom = '$nombre', esp_desc = '$descripcion', esp_area ='$area', esp_geo ='$ubicacion', esp_esp_tipo_id ='$espacio' WHERE esp_id='$id'";

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

   return;
}

#Elimina el usuario del espacio
function eliminaUsuario($usuario, $conexion){
      
      #Consulta para determinar a que espacio pertenece antes de eliminar
      $consulta = "SELECT * FROM esp_det WHERE esp_id_ = '$usuario'";
      $buscaEspacioUsr = mysqli_query($conexion, $consulta);

      if(mysqli_num_rows($buscaEspacioUsr)>0){
        $datos = mysqli_fetch_array($buscaEspacioUsr);
      }

        #Almacenar el dato en una variable
      $espacio = $datos['esp_esp_id'];


      $consulta = "DELETE FROM esp_det WHERE esp_id_ ='$usuario'";
      $eliminaUsuario = mysqli_query($conexion, $consulta); 
      
        if($eliminaUsuario){
        ?>
        <script>muestraMensajes('Se eliminó exitosamente al usuario',''); revertirFormulario(); formUsuariosEsp('<?php echo $espacio; ?>');</script>
        <?php

    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
      <?php
    }
}

#Modifica el usuario en el espacio
function modificaUsuario($usuario, $espacio, $nombre, $rol, $conexion){

        
    $consulta = "UPDATE esp_det SET esp_usrol_id = '$rol' WHERE esp_usr_id ='$usuario' AND esp_esp_id ='$espacio'";
    $modificaRol = mysqli_query($conexion, $consulta); 

     if($modificaRol){
 
      $consulta = "UPDATE usr_mst SET usr_nom = '$nombre' WHERE usr_id ='$usuario'";
      $modificaNombre = mysqli_query($conexion, $consulta); 

      if($modificaNombre){
        ?>
        <script>muestraMensajes('Se modificaron los datos',''); revertirFormulario(); formUsuariosEsp(<?php echo $espacio; ?>);</script>
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

}

# Asigna a un usuario en un espacio
function asignarUsuario($usuario, $espacio, $rol, $conexion){
   $errores = '';
   #Consulta para saber si ya existe en el espacio
   $consulta = "SELECT esp_usr_id FROM esp_det WHERE esp_usr_id = '$usuario' AND esp_esp_id = '$espacio'";
   $existeEspacio = mysqli_query($conexion, $consulta); 
   if(mysqli_num_rows($existeEspacio)>0){
    $errores .= "<script>muestraMensajesFormularios('Este usuario ya se encuentra en este espacio','notificacionesform','error')</script>";
   }

  if($errores == ''){
  $consulta = "INSERT INTO esp_det VALUES (NULL, '$espacio','$usuario','$rol')";
  $asignarEspacio = mysqli_query($conexion, $consulta); 

   if($asignarEspacio){
      ?>
      <script>muestraMensajes('Se asigno el usuario un espacio',''); revertirFormulario(); formUsuariosEsp(<?php echo $espacio; ?>);</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
      <?php

    }
  }

  echo $errores;
 return;
}


#Comprueba que haya una variable de espacio en el modulo de seccion
function comprobarSeccion(){
  if(isset($_SESSION['esp_id'])){
    $espacio = $_SESSION['esp_id'];
    }else{
      header('Location:espacios_mst.php');
    }
    return $espacio;
}

# Carga la secciones de un espacio
function cargaseccionEspacio($espacio){
  
  $_SESSION['esp_id'] = $espacio;

  if(isset($_SESSION['esp_id'])){
  ?>
  <script>muestraMensajes('Cargando secciones...','error'); 
   setInterval(function() {
   window.location.href="secciones_mst.php"
}, 1500);

</script>
  <?php
 # header('Location:../secciones_mst.php');
  } 
return;
}

####################################################################################################
#                                                                                                  #
#                         Almacena funciones que controlan la vista usuarios                       #
#                                                                                                  #
####################################################################################################

# Agrega un usuario al sistema
function insertaUsuario($nombre, $usuario, $contrasena, $contrasenacon, $conexion){
  $errores = "";

  $consulta = "SELECT usr_usu FROM usr_mst WHERE usr_usu ='$usuario'";
  $buscaNombreUsuario = mysqli_query($conexion, $consulta);
  if(mysqli_num_rows($buscaNombreUsuario)>0){
    $errores .= "<script>habilitaFormBtn(); muestraMensajes('Usuario existente','notificacionesform','error')</script>";
  }


  if($contrasena != $contrasenacon){
    $errores .= "<script>habilitaFormBtn(); muestraMensajes('Contraseñas incorrectas','notificacionesform','error')</script>";
  }
   
  $contrasena = password_hash($contrasena,PASSWORD_DEFAULT);

  if($errores == ''){
  $consulta = "INSERT INTO usr_mst VALUES (NULL, '$usuario', '$nombre','$contrasena','0')";
  $agregaUsuario = mysqli_query($conexion, $consulta);
  if($agregaUsuario){
        ?>
        <script>muestraMensajes('Se agrego exitosamente',''); $('#formulariomodal').modal('hide');  cargarEspacios(); revertirFormulario() </script>
        <?php

  }else{
        ?>
        <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
        <?php
  }
  }

  echo $errores;
  return;

}

# Modifica la contraseña del usuario
function modificarContrasena($usuario, $contrasena, $contrasenacon, $conexion){

  $errores = '';

  if($contrasena != $contrasenacon){
    $errores .= "<script>habilitaFormBtn(); muestraMensajes('Las contraseñas no coinciden','notificacionesform','error')</script>";
  }


  if($errores == ''){
  $consulta = "UPDATE usr_mst SET usr_con = '$contrasena' WHERE usr_id = '$usuario'";
  $modificaContrasena = mysqli_query($conexion, $consulta);
  if($modificaContrasena){
    ?>
    <script>muestraMensajes('Se modificó exitosamente',''); $('#formulariomodal').modal('hide'); revertirFormulario() </script>
    <?php
  }else{
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error'); $('#formulariomodal').modal('hide');  cargarEspacios(); revertirFormulario() </script>
    <?php
  }
}

  echo $errores;
}


# Modifica los datos del usuario
function modificarDatos($usuario, $nombre, $conexion){

  $errores = '';



  if($errores == ''){
  $consulta = "UPDATE usr_mst SET usr_nom = '$nombre' WHERE usr_id = '$usuario'";
  $modificaContrasena = mysqli_query($conexion, $consulta);
  if($modificaContrasena){
    ?>
    <script>muestraMensajes('Se modificó exitosamente los datos',''); $('#formulariomodal').modal('hide'); revertirFormulario() </script>
    <?php
  }else{
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }
}

  echo $errores;
}


#Elimina el usuario
function eliminarUsuario($usuario, $conexion){
  $consulta = "DELETE FROM esp_det WHERE esp_usr_id ='$usuario'";
  $eliminaUsuarioEspacio = mysqli_query($conexion, $consulta); 

  if($eliminaUsuarioEspacio){
  $consulta = "DELETE FROM usr_mst WHERE usr_id ='$usuario'";
  $eliminaUsuario = mysqli_query($conexion, $consulta); 
  
    if($eliminaUsuario){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente al usuario',''); revertirFormulario();</script>
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
}

####################################################################################################
#                                                                                                  #
#                         Almacena funciones que controlan la vista seccion                        #
#                                                                                                  #
####################################################################################################

#Modifica la seccion
function modificarSeccion($seccion, $nombre, $descripcion, $conexion){

  $consulta = "UPDATE sec_mst SET sec_nom = '$nombre', sec_desc = '$descripcion' WHERE sec_id='$seccion'";

  $modificaSeccion = mysqli_query($conexion, $consulta);

  if($modificaSeccion){
    ?>
    <script>muestraMensajes('Se modificó exitosamente',''); $('#formulariomodal').modal('hide');  cargarSecciones(); revertirFormulario(); </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}

#Elimina la seccion
function eliminarSeccion($seccion, $conexion){
     
  $consulta = "DELETE FROM sec_mst WHERE sec_id ='$seccion'";
  $eliminaSeccion = mysqli_query($conexion, $consulta); 

  if($eliminaSeccion){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); cargarSecciones();  </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurrio algún error verifica (1)','error');</script>
    <?php
  }
 

 return;
}

# Agrega una nueva sección
function agregarSeccion($espacio, $nombre, $descripcion, $conexion){

  $consulta = "INSERT INTO sec_mst VALUES (NULL, '$nombre', '$descripcion', '$espacio')";

  $insertarSeccion = mysqli_query($conexion, $consulta);

  if($insertarSeccion){
    ?>
    <script>muestraMensajes('Se agregó exitosamente',''); $('#formulariomodal').modal('hide');  cargarSecciones(); revertirFormulario(); </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}

#Comprueba que exista una sección de un producto
function comprobarProductos(){
  if(isset($_SESSION['sec_id'])){
    $espacio = $_SESSION['sec_id'];
    }else{
      header('Location:espacios_mst.php');
    }
    return $espacio;
}

# Carga una nueva seccion para espacio
function cargaproductosSeccion($seccion){
  
  $_SESSION['sec_id'] = $seccion;

  if(isset($_SESSION['sec_id'])){
  ?>
  <script>muestraMensajes('Cargando productos ...','error'); 
   setInterval(function() {
   window.location.href="productos_mst.php"
}, 1500);

</script>
  <?php
 # header('Location:../secciones_mst.php');
  } 
return;
}

# Contea los productos en la sección
function conteoProductosSeccion($id,$conexion){
  $consulta = "SELECT COUNT(prod_id) as productos FROM prod_mst WHERE prod_sec_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['productos'];

  return $conteo;
}

####################################################################################################
#                                                                                                  #
#                         Almacena funciones que controlan la vista productos                      #
#                                                                                                  #
####################################################################################################


# Crea un nuevo producto
function agregarProducto($seccion, $nombre, $descripcion, $conexion){

  $consulta = "INSERT INTO prod_mst VALUES (NULL, '$nombre', '$descripcion', '$seccion')";

  $insertarProducto = mysqli_query($conexion, $consulta);

  if($insertarProducto){
    ?>
    <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario();  $('#formulariomodal').modal('hide');  cargarProductos(); </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}

#Modifica un producto
function modificarProducto($producto, $nombre, $descripcion, $conexion){

  $consulta = "UPDATE prod_mst SET prod_nom = '$nombre', prod_desc = '$descripcion' WHERE prod_id = '$producto'";

  $modificarProducto = mysqli_query($conexion, $consulta);

  if($modificarProducto){
    ?>
    <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide');  cargarProductos();  </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}

#Elimina un producto 
function eliminarProducto($producto, $conexion){
     
  $consulta = "DELETE FROM pl_det WHERE pl_prod_id ='$producto'";
  $eliminaPlacas = mysqli_query($conexion, $consulta); 

  if($eliminaPlacas){

  $consulta = "DELETE FROM prod_mst WHERE prod_id ='$producto'";
  $eliminaProducto = mysqli_query($conexion, $consulta); 

  if($eliminaProducto){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); revertirFormulario(); formPlacas('<?php echo $producto; ?>') </script>
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


 return;
}



#Agrega una placa en el producto
function agregarPlaca($producto, $placa, $descripcion, $ip, $conexion){

  $consulta = "INSERT INTO pl_det VALUES (NULL,'$descripcion', '$ip', '$producto','$placa')";

  $insertarPlaca = mysqli_query($conexion, $consulta);

  if($insertarPlaca){
    ?>
    <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); formPlacas('<?php echo $producto; ?>'); </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}


#Modifica una placa en el producto

function modificarPlaca($placa, $producto, $descripcion, $ip, $conexion){

  $consulta = "UPDATE pl_det SET  pl_desc = '$descripcion', pl_ip = '$ip', pl_prod_id = '$producto' WHERE pl_id_ ='$placa'";

  $modificaPlaca = mysqli_query($conexion, $consulta);

  if($modificaPlaca){
    ?>
    <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); formPlacas('<?php echo $producto; ?>') </script>
    <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;

}





#Agrega una placa en el producto

function eliminarPlaca($placa, $producto, $conexion){
     
  $consulta = "DELETE FROM pl_det WHERE pl_id_ ='$placa'";
  $eliminaPlaca = mysqli_query($conexion, $consulta); 

  if($eliminaPlaca){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); revertirFormulario(); formPlacas('<?php echo $producto; ?>') </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }


 return;
}


#Contea las placas en el producto

function conteoPlacasProducto($id,$conexion){
  $consulta = "SELECT COUNT(pl_id_) as placas FROM pl_det WHERE pl_prod_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['placas'];

  return $conteo;
}

#Contea los dispositivos en el producto
function conteoDispositivosProducto($id,$conexion){
  $consulta = "SELECT COUNT(disp_id_) as dispositivos FROM pl_det, disp_det WHERE pl_prod_id = $id AND pl_id_ = disp_pl_id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['dispositivos'];

  return $conteo;
}

#Trae el ultimo registro del sensor a censar (PROBARLO)
/* function sensorizarDispositivo($dispositivo, $conexion){

  $consulta = "SELECT * FROM dato_mst WHERE dato_disp_id = '$dispositivo' ORDER BY dato_tpo DESC LIMIT 1";
  $sensorizaDispositivo = mysqli_query($conexion, $consulta);
  if(mysqli_num_rows($sensorizaDispositivo)>0){
    $valor = mysqli_fetch_array($sensorizaDispositivo);
  
  
  echo $valor['dato_val'];

}else{
  echo 'No hay valores';
}

  return;

}
*/

#Trae el ultimo registro del sensor a censar mediante la fecha
function sensorizarDispositivo($dispositivo, $conexion) {
  date_default_timezone_set('America/Mexico_City');
  $fecha_cap = date('Y-m-d H:i', time());
  $consulta = "SELECT * FROM dato_mst WHERE dato_disp_id = '$dispositivo' AND dato_tpo LIKE '%$fecha_cap%' ORDER BY dato_id DESC LIMIT 1";
  $sensorizaDispositivo = mysqli_query($conexion, $consulta);
  
  if (mysqli_num_rows($sensorizaDispositivo) > 0) {
    $valor = mysqli_fetch_array($sensorizaDispositivo);
    echo $valor['dato_val'];
  } else {
    echo 'No se esta sensorizando';
  }

  return;
}



function sensorizarDispositivoPromedios($dispositivo, $conexion) {
  date_default_timezone_set('America/Mexico_City');
  $fecha_cap = date('Y-m-d H:i', time());
  $consulta = "SELECT prod_sec_id, disp_id, AVG(dato_val) AS promedio_valor
  FROM dato_mst, disp_mst, disp_det, pl_det, prod_mst
  WHERE disp_id = '$dispositivo' AND dato_tpo LIKE '%$fecha_cap%'
      AND disp_pl_id = pl_id_
      AND disp_disp_id = disp_id
      AND prod_id = pl_prod_id
      AND dato_disp_id = disp_id_
  GROUP BY disp_id LIMIT 1";
  $sensorizaDispositivo = mysqli_query($conexion, $consulta);
  
  if (mysqli_num_rows($sensorizaDispositivo) > 0) {
    $valor = mysqli_fetch_array($sensorizaDispositivo);
   /* if(is_numeric($valor['promedio_valor'])){
    echo $valor['promedio_valor'];
    } */
      $promedio_valor =  $valor['promedio_valor'];

      if (preg_match('/^[0-9]+(?:\.[0-9]+)?$/', $promedio_valor)) {
        echo $promedio_valor;
    }
    

  } else {
    echo 'No se esta sensorizando';
  }

  return;
}

#Detecta los puertos del dispositivo
function detectapuertoDisp($dispositivo, $conexion) {
  $consulta = "SELECT * FROM disp_det WHERE disp_disp_id = '$dispositivo'";
  $detectaPuerto = mysqli_query($conexion, $consulta);
  
  if (mysqli_num_rows($detectaPuerto) > 0) {
    /* 
    while($valor = mysqli_fetch_array($detectaPuerto)){
      */

    /*  if(end($valor)){
      echo $valor['disp_pto'].". ";
      }else{
      echo $valor['disp_pto'].", ";
      }

      */
      $resultados = mysqli_fetch_all($detectaPuerto, MYSQLI_ASSOC);
      foreach ($resultados as $valor) {
        $disp_pto = $valor['disp_pto'];

        if ($valor === end($resultados)) {
            echo $disp_pto.". ";
        } else {
            echo $disp_pto.", ";
        }
    } 
/*
    }
    */
  } else {
    echo 'No se han configurado puertos';
  }

  return;
}


#Agrega un dispositivo en un producto
function agregarDispositivo($producto, $dispositivo,$placa, $conexion){
   $errores = '';


   /*
  $ptos_usados = '';

  $arreglo_ptos = explode(",", $puerto);

  foreach($arreglo_ptos as $puertos){
    $consulta = "SELECT disp_pto FROM disp_det WHERE disp_pto = '$puertos'";
   
    $consultaPuertos = mysqli_query($conexion, $consulta);
    if(mysqli_num_rows($consultaPuertos)>0){
      $ptos_usados .= $puertos.", ";
    }
  }
  

if($ptos_usados != ''){
$errores .= "1";
?>
<script>muestraMensajesFormularios('Los puertos <?php echo $ptos_usados ?> se encuentran ya ocupados','notificacionesform','error');</script>
<?php
} 
*/



  if($errores == ''){
  $consulta = "INSERT INTO disp_det VALUES (NULL, '$placa', '$dispositivo')";

  $insertarDispositivo = mysqli_query($conexion, $consulta);

  if($insertarDispositivo){
     /*
    #Ejecuta el ultimo registro insertado
    $consulta = "SELECT max(disp_id) AS ultimo_dispositivo FROM disp_mst";
    $ultimoDispositivo = mysqli_query($conexion, $consulta);
    if(mysqli_num_rows($ultimoDispositivo)>0){
      $ultimo = mysqli_fetch_array($ultimoDispositivo);
      $dispositivo = $ultimo['ultimo_dispositivo'];
    }
    

    $ptos_insertados = '';

    foreach($arreglo_ptos as $puertos){
      $consulta = "INSERT INTO disp_det VALUES ('$puertos', '$placa','$dispositivo')";
      $insertarPuertos = mysqli_query($conexion, $consulta);
      if($insertarPuertos){
        $ptos_insertados .= $puertos;
      }  
    }

      if($ptos_insertados != ''){
        ?>
        <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); formDispositivos('<?php echo $producto; ?>'); </script>
        <?php
      }
*/
         ?>
        <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); formDispositivos('<?php echo $producto; ?>'); </script>
        <?php
  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php 
  }
  
}

#echo $errores;

 return;

}

#Modifica el dispositivo en un producto
function modificarDispositivo($dispositivo, $producto, $placa, $conexion){

  $errores = '';

 if($errores == ''){
 $consulta = "UPDATE disp_det SET disp_pl_id = '$placa' WHERE disp_id_ = '$dispositivo'";

 $actualizarDispositivo = mysqli_query($conexion, $consulta);

 if($actualizarDispositivo){
       ?>
       <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); formDispositivos('<?php echo $producto; ?>'); </script>
       <?php
 }else{
     ?>
   <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
   <?php 
 }
 
}

#echo $errores;

return;

}

#Elimina el dispositivo en el producto
function eliminarDispositivo($dispositivo, $producto, $conexion){
  

  $consulta = "DELETE FROM disp_det WHERE disp_id_ ='$dispositivo'";
  $eliminaDispositivo = mysqli_query($conexion, $consulta); 

  if($eliminaDispositivo){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); revertirFormulario(); formDispositivos('<?php echo $producto; ?>') </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }

 return;
}


####################################################################################################
#                                                                                                  #
#                     Almacena funciones que controlan el modulo administrativo                    #
#                                                                                                  #
####################################################################################################

####################################################################################################
#                                               Roles                                              #
####################################################################################################

function insertaRol($nombre, $descripcion, $gral_lectura, $gral_escritura, $esc_lectura, $esc_escritura, $sec_lectura, $sec_escritura, $prod_lectura, $prod_escritura, $disp_lectura, $disp_escritura, $conexion){
    
  $consulta = "INSERT INTO usrol_mst VALUES (NULL, '$nombre', '$descripcion', '$gral_lectura', '$gral_escritura','$esc_lectura','$esc_escritura','$sec_lectura','$sec_escritura', '$prod_lectura','$prod_escritura', '$disp_lectura','$disp_escritura','1')";
  $insertarRol = mysqli_query($conexion, $consulta);

  if($insertarRol){
  ?>
   <script>muestraMensajes('Se agregó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'); cargarRoles();</script>
  <?php
  }else{
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }

}


function modificaRol($usrol, $nombre, $descripcion, $gral_lectura, $gral_escritura, $esp_lectura, $esp_escritura, $sec_lectura, $sec_escritura, $prod_lectura, $prod_escritura, $disp_lectura, $disp_escritura, $estado, $conexion){
    
  $consulta = "UPDATE usrol_mst SET 
  usrol_nom = '$nombre', 
  usrol_desc = '$descripcion', 
  usrol_gral_lec = '$gral_lectura', 
  usrol_gral_esc = '$gral_escritura',
  usrol_esp_lec = '$esp_lectura',
  usrol_esp_esc = '$esp_escritura',
  usrol_sec_lec = '$sec_lectura',
  usrol_sec_esc = '$sec_escritura', 
  usrol_prod_lec = '$prod_lectura',
  usrol_prod_esc = '$prod_escritura', 
  usrol_disp_lec = '$disp_lectura',
  usrol_disp_esc = '$disp_escritura',
  usrol_estado = '$estado' WHERE usrol_id ='$usrol'";

  $modificarRol = mysqli_query($conexion, $consulta);

  if($modificarRol){
  ?>
   <script>muestraMensajes('Se modificó exitosamente',''); revertirFormulario(); $('#formulariomodal').modal('hide'); cargarRoles();</script>
  <?php
  }else{
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }

}

function eliminaRol($rol, $conexion){

  $consulta = "DELETE FROM usrol_mst WHERE usrol_id = $rol";
  $eliminarRol = mysqli_query($conexion, $consulta);

  if($eliminarRol){
  ?>
   <script>muestraMensajes('Se eliminó exitosamente',''); cargarRoles();</script>
  <?php
  }else{
    
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }

}


####################################################################################################
#                                        Administrador                                             #
####################################################################################################


function asignaAdministrador($usuario, $conexion){
  if($usuario == ''){
    $consulta = "TRUNCATE usr_det";
    $vaciarAdministrador = mysqli_query($conexion, $consulta);
    if($vaciarAdministrador){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se modificó exitosamente',''); cargarRoles();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }
  }else{
   

    $consulta = "SELECT * FROM usr_det";
    $verificaAdministrador = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($verificaAdministrador)>0){
      
    $consulta = "UPDATE usr_det SET usr_usr_id = '$usuario'";
    $actualizaAdministrador = mysqli_query($conexion, $consulta);
    if($actualizaAdministrador){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se modificó exitosamente',''); cargarRoles();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

    }else{

    $consulta = "INSERT INTO usr_det VALUES ('$usuario', '1')";
    $asignarAdministrador = mysqli_query($conexion, $consulta);
    if($asignarAdministrador){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se modificó exitosamente',''); cargarRoles();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

    }

  }

}


####################################################################################################
#                                       Tipos de espacios                                          #
####################################################################################################

function agregarTipoEspacio($nombre, $descripcion,$conexion){

  $consulta = "INSERT INTO esp_tipo_mst VALUES (NULL, '$nombre', '$descripcion','1')";
    $agregarTipoEspacio = mysqli_query($conexion, $consulta);

    if($agregarTipoEspacio){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se agregó exitosamente',''); cargarTiposEspacio();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

}

function modificarTipoEspacio($tipoEspacio, $nombre, $descripcion,$estado, $conexion){

  $consulta = "UPDATE esp_tipo_mst SET esp_tipo_nom = '$nombre', esp_tipo_desc = '$descripcion', esp_tipo_estado ='$estado' WHERE esp_tipo_id = '$tipoEspacio'";
    $modificarTipoEspacio = mysqli_query($conexion, $consulta);

    if($modificarTipoEspacio){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se modificó exitosamente',''); cargarTiposEspacio();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

}

function eliminarTipoEspacio($tipoEspacio,$conexion){

  $consulta = "DELETE FROM esp_tipo_mst WHERE esp_tipo_id = '$tipoEspacio' ";
    $eliminarTipoEspacio = mysqli_query($conexion, $consulta);

    if($eliminarTipoEspacio){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se eliminó exitosamente',''); cargarTiposEspacio();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

}

####################################################################################################
#                                       Unidades de medida                                         #
####################################################################################################

function  agregarUnidadMedida($nombre,$siglas,$conexion){
  $consulta = "INSERT INTO dum_mst VALUES (NULL, '$nombre', '$siglas','1')";
  $agregarUnidadMedida = mysqli_query($conexion, $consulta);

  if($agregarUnidadMedida){
    ?>
    <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se agregó exitosamente',''); cargarUnidadesMedida();</script>
    <?php
  }else{
    ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }
}


function modificarUnidadMedida($unidad, $nombre, $siglas,$estado, $conexion){

  $consulta = "UPDATE dum_mst SET dum_nom = '$nombre', dum_sigl = '$siglas', dum_estado ='$estado' WHERE dum_id = '$unidad'";
    $modificarTipoEspacio = mysqli_query($conexion, $consulta);

    if($modificarTipoEspacio){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se modificó exitosamente',''); cargarUnidadesMedida();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

}


function eliminarUnidadMedida($unidad,$conexion){

  $consulta = "DELETE FROM dum_mst WHERE dum_id = '$unidad'";
    $eliminarUnidadMedida = mysqli_query($conexion, $consulta);

    if($eliminarUnidadMedida){
      ?>
      <script>revertirFormulario(); $('#formulariomodal').modal('hide'); muestraMensajes('Se eliminó exitosamente',''); cargarTiposEspacio();</script>
      <?php
    }else{
      ?>
      <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
      <?php
    }

}


?>