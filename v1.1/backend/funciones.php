<?php

####################################################################################################
#                                                                                                  #
#                   Almacena funciones que controlan la sesion del usuario                         #
#                                                                                                  #
####################################################################################################


session_start();
function acceso($usuario,$password,$conexion){
    include('../frontend/iconos.php');
    $errores = '';
    $clasesusr = '';
    $clasespwd = '';
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
         //Valida si los campos estan vacios
        if(empty($usuario) or empty($password)){
            /* $errores .= "<div class='alert alert-dismissible bg-dark text-dark fade show' role='alert'>
            Datos vacíos. $alerta
          </div>"; */
        }
        
        //Valida si el usuario esta en la base de datos
        $usr=mysqli_query($conexion,"SELECT usr_usu FROM usr_mst WHERE usr_usu = '$usuario';");
        if (mysqli_num_rows($usr)==0)
        {
           /*  $errores .= "<div class='alert alert-dismissible bg-dark text-dark fade show' role='alert'><center>
            Este usuario no se encuentra en nuestros registros. $alerta</center>
          </div>";  */
      
          // Limpiamos los campos
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
        
        //Valida si la contraseña coincide en la base de datos descifrada.
    $usr=mysqli_query($conexion,"SELECT usr_con FROM usr_mst WHERE usr_usu = '$usuario';");
    if (mysqli_num_rows($usr)>0)
    {
        $columnas = mysqli_fetch_array($usr);
        $hash= $columnas['usr_con'];
        if(password_verify($password, $hash) != 1){
            $clasespwd .= "<script>document.getElementById('contrasena').classList.add('invalido');</script>";
            /* $errores .= "<div class='alert alert-dismissible bg-dark text-dark fade show' role='alert'><center>
            Credenciales incorrectas. $alerta</center>
          </div>";  */
          $errores.= '<div class="alert spinner-grow text-dark" role="status"></div>';
          $errores.= '<div class="container"><div class="alert text-dark" role="status">Verifica los datos</div></div>';
        }else{
            $clasespwd .= "<script>document.getElementById('contrasena').classList.remove('invalido');</script>";
            $clasespwd .= "<script>document.getElementById('contrasena').classList.add('valido');</script>";
            //Selecciona el usuario
            $selusr=mysqli_query($conexion,"SELECT * FROM usr_mst WHERE usr_usu = '$usuario';");
            if(mysqli_num_rows($selusr)>0){
                    $selusuario = mysqli_fetch_array($selusr);
                    $usuario = $selusuario['usr_id'];
                  
            }

            $_SESSION['usr_id'] = $usuario;

           /* $errores .= "<div class='alert alert-dismissible bg-dark text-dark fade show' role='alert'><center>
            Bienvenido; $nombre. $alerta</center>
          </div>"; */
         
          $errores.='<div class="spinner-border text-dark" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>';

            $errores.="<script type='text/javascript'>
            var n = 2;
            window.setInterval(function(){
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


function sesion_admin(){
  if (isset($_SESSION['admin_id'])) {
      $sesion = $_SESSION['admin_id'];
  } else {
      $sesion = '';
     header('Location:acceso.php');
     exit();
  }
  return $sesion;
}

function sesion_login(){
    if (isset($_SESSION['usr_id']) || isset($_SESSION['admin_id']) ) {
        header('Location: espacios_mst.php');
    }
    return;
}

function cerrarsesion(){
    unset($_SESSION["usr_id"]);
    if(isset($_GET['redirect'])) {
     header('Location: '.base64_decode($_GET['redirect']));  
    } else {
     header('Location:../frontend/acceso.php');  
    }
    return;
}

function destruirvariables(){
 # unset($_SESSION["esp_id"]);
  unset($_SESSION["sec_id"]);
  return;
}



function administradorSistema($sesion, $conexion){         
  $consulta = "SELECT * FROM usr_mst WHERE usr_id = '$sesion'";
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
#                   Almacena funciones que funcionan en la vista del espacio                       #
#                                                                                                  #
####################################################################################################


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

function conteoUsuarios($id,$conexion){
  $consulta = "SELECT COUNT(esp_usr_id) as usuarios FROM esp_det WHERE esp_esp_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['usuarios'];

  return $conteo;
}

function conteoSecciones($id,$conexion){
  $consulta = "SELECT COUNT(sec_id) as secciones FROM sec_mst WHERE sec_esp_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['secciones'];

  return $conteo;
}

#Inserta en el espacio
function insertaEspacio($nombre, $descripcion, $area, $ubicacion, $espacio, $conexion, $sesion){
     
    
    $consulta = "INSERT INTO esp_mst VALUES (NULL, '$nombre', '$descripcion','$area','$ubicacion','$espacio', '$sesion')";
    $agregaEspacio = mysqli_query($conexion, $consulta);

    if($agregaEspacio){
      $consulta = "SELECT MAX(esp_id) AS ultimo_valor FROM esp_mst";
        $buscaEspacio = mysqli_query($conexion, $consulta);
        if(mysqli_num_rows($buscaEspacio)>0){
          $obtenerDatos = mysqli_fetch_array($buscaEspacio);
        }

        $espacio_id = $obtenerDatos['ultimo_valor'];
      
      //Inserción
      $consulta = "INSERT INTO esp_det VALUES (NULL, '$espacio_id','$sesion', '2');";
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
  
   return;
}


#Elimina en el espacio
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


#Actualiza en el espacio
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

#Elimina el espacio
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

#Modifica el usuario.
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

# Asigna a un usuario a un espacio
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

function comprobarSeccion(){
  if(isset($_SESSION['esp_id'])){
    $espacio = $_SESSION['esp_id'];
    }else{
      header('Location:espacios_mst.php');
    }
    return $espacio;
}

# Carga una nueva seccion para espacio
function cargaseccionEspacio($espacio){
  
  $_SESSION['esp_id'] = $espacio;

  if(isset($_SESSION['esp_id'])){
  ?>
  <script>muestraMensajes('Cargando secciones (<?php echo $_SESSION['esp_id'] ;?>) ...','error'); 
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
    $errores .= "<script>muestraMensajesFormularios('Usuario existente','notificacionesform','error')</script>";
  }


  if($contrasena != $contrasenacon){
    $errores .= "<script>muestraMensajesFormularios('Contraseñas incorrectas','notificacionesform','error')</script>";
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

# Modifica la contraseña
function modificarContrasena($usuario, $contrasena, $contrasenacon, $conexion){

  $errores = '';

  if($contrasena != $contrasenacon){
    $errores .= "<script>muestraMensajesFormularios('Las contraseñas no coinciden','notificacionesform','error')</script>";
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

#Elimina la seccion (AUN NO FUNCIONA)
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

function eliminarProducto($producto, $conexion){
     
  $consulta = "DELETE FROM pl_mst WHERE pl_prod_id ='$producto'";
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




function agregarPlaca($producto, $nombre, $descripcion, $ip, $conexion){

  $consulta = "INSERT INTO pl_mst VALUES (NULL, '$nombre', '$descripcion', '$ip', '$producto')";

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



function modificarPlaca($placa, $producto, $nombre, $descripcion, $ip, $conexion){

  $consulta = "UPDATE pl_mst SET pl_nom = '$nombre', pl_desc = '$descripcion', pl_ip = '$ip' WHERE pl_id ='$placa'";

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






function eliminarPlaca($placa, $producto, $conexion){
     
  $consulta = "DELETE FROM pl_mst WHERE pl_id ='$placa'";
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


function conteoPlacasProducto($id,$conexion){
  $consulta = "SELECT COUNT(pl_id) as placas FROM pl_mst WHERE pl_prod_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['placas'];

  return $conteo;
}


function conteoDispositivosProducto($id,$conexion){
  $consulta = "SELECT COUNT(disp_id) as dispositivos FROM disp_mst WHERE disp_prod_id = $id;";
  $conteoUsuarios = mysqli_query($conexion, $consulta);
  
  if(mysqli_num_rows($conteoUsuarios)>0){
      $dato = mysqli_fetch_array($conteoUsuarios);
  }

  $conteo = $dato['dispositivos'];

  return $conteo;
}


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



function agregarDispositivo($producto, $nombre, $unidad, $placa, $tipo, $puerto, $conexion){
   $errores = '';

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




  if($errores == ''){
  $consulta = "INSERT INTO disp_mst VALUES (NULL, '$nombre', '$unidad', '$placa', '$tipo','$producto')";

  $insertarDispositivo = mysqli_query($conexion, $consulta);

  if($insertarDispositivo){
 
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

  }else{
      ?>
    <script>muestraMensajesFormularios('Ocurrio algún error verifica','error');</script>
    <?php 
  }
  
}

#echo $errores;

 return;

}


function modificarDispositivo($dispositivo, $producto, $nombre, $unidad, $placa, $tipo, $conexion){

  $errores = '';

 if($errores == ''){
 $consulta = "UPDATE disp_mst SET disp_nom = '$nombre', disp_dum_id =  '$unidad', disp_pl_id = '$placa', disp_disp_tipo_id = '$tipo' WHERE disp_id = '$dispositivo'";

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


function eliminarDispositivo($dispositivo, $producto, $conexion){
  
      
  $consulta = "DELETE FROM dato_mst WHERE dato_disp_id ='$dispositivo'";
  $eliminaDatos = mysqli_query($conexion, $consulta); 

  if($eliminaDatos){
    
  $consulta = "DELETE FROM disp_det WHERE disp_disp_id ='$dispositivo'";
  $eliminaPuertos = mysqli_query($conexion, $consulta); 

  if($eliminaPuertos){
  $consulta = "DELETE FROM disp_mst WHERE disp_id ='$dispositivo'";
  $eliminaDispositivo = mysqli_query($conexion, $consulta); 

  if($eliminaDispositivo){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); revertirFormulario(); formDispositivos('<?php echo $producto; ?>') </script>
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




?>