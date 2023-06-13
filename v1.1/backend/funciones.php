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
                    $admin = $selusuario['usr_sistema'];
            }
            $_SESSION['usr_id'] = $usuario;

           /* $errores .= "<div class='alert alert-dismissible bg-dark text-dark fade show' role='alert'><center>
            Bienvenido; $nombre. $alerta</center>
          </div>"; */
          if($admin == 1){
            $errores.='<div class="spinner-border text-dark" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>';

            $errores.="<script type='text/javascript'>
            var n = 2;
            window.setInterval(function(){
                n--;
                // Si se cumple la condición te redirige a la página de inicio
                if(n == 0){
                location.href = 'admin_mst.php';
            }
            },1000);
            </script>";
          }else{
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





####################################################################################################
#                                                                                                  #
#                   Almacena funciones que funcionan en la vista del espacio                       #
#                                                                                                  #
####################################################################################################

function detectarRolUsuarioEspacio($espacio, $sesion, $conexion){         
  $consulta = "SELECT * FROM esp_mst, esp_det WHERE esp_esp_id = '$espacio' AND esp_usr_id = '$sesion'";
  $detectarol = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($detectarol)>0){
          # Si existe un registro despliega toda la informacion que exista
          $dato = mysqli_fetch_array($detectarol);
          $resultado = $dato['esp_usrol_id'];
          
        }else{
          $resultado = '';
        }

        

        return $resultado;
}



function detectarRolNativo($sesion, $conexion){         
  $consulta = "SELECT * FROM usr_mst WHERE usr_id = '$sesion'";
  $detectarol = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($detectarol)>0){
          # Si existe un registro despliega toda la informacion que exista
          $dato = mysqli_fetch_array($detectarol);
          $resultado = $dato['usr_defadmin'];
          
        }else{
          $resultado = '';
        }

        

        return $resultado;
}

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

#Modifica el espacio y el nombre
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
  <script>muestraMensajes('Cargando secciones <?php echo $_SESSION['esp_id'] ;?> ...','error'); 
   setInterval(function() {
   window.location.href="secciones_mst.php"
}, 1500);

</script>
  <?php
 # header('Location:../secciones_mst.php');
  } 
return;
}

#Destruye la seccion que se haya creado anteriormente

####################################################################################################
#                                                                                                  #
#                         Almacena funciones que controlan la vista usuarios                       #
#                                                                                                  #
####################################################################################################

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


#Elimina el espacio
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

#Elimina en el espacio
function eliminarSeccion($seccion, $conexion){
     
  $consulta = "DELETE FROM sec_mst WHERE sec_id ='$seccion'";
  $eliminaSeccion = mysqli_query($conexion, $consulta); 

  if($eliminaSeccion){
    ?>
    <script>muestraMensajes('Se eliminó exitosamente',''); cargarSecciones();  </script>
    <?php
  }else{
      ?>
    <script>muestraMensajes('Ocurrio algún error verifica','error');</script>
    <?php
  }


 return;
}


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




?>