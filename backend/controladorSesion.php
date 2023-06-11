<?php
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
                location.href = 'index.php';
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




function sesion_login(){
    if (isset($_SESSION['usr_id'])) {
        header('Location: index.php');
    }
    return;
}


function rol_defecto($sesion, $conexion){
    $consulta = "SELECT usr_defadmin FROM usr_mst WHERE usr_id = '$sesion'" ;
$buscaRolPrincipal = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaRolPrincipal)>0){
  # Si existe un registro despliega toda la informacion que exista
  $muestradatos = mysqli_fetch_array($buscaRolPrincipal);
}

$rol_defecto = $muestradatos['usr_defadmin'];

return $rol_defecto;
}


function detectarRolEspacio($espacio, $sesion, $conexion){         
    $consulta = "SELECT * FROM esp_mst, esp_det WHERE esp_esp_id = '$espacio' AND esp_usr_id = '$sesion'";
    $detectarol = mysqli_query($conexion, $consulta);

          if(mysqli_num_rows($detectarol)>0){
            # Si existe un registro despliega toda la informacion que exista
            $dato = mysqli_fetch_array($detectarol);
          }

            $resultado = $dato['esp_usrol_id'];

  return $resultado;
}



function detectarRolUsuario($sesion, $conexion){         
  $consulta = "SELECT * FROM esp_det WHERE esp_usr_id = '$sesion'";
  $detectarol = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($detectarol)>0){
          # Si existe un registro despliega toda la informacion que exista
          $dato = mysqli_fetch_array($detectarol);
        }

          $resultado = $dato['esp_usrol_id'];

return $resultado;
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
?>