<?php 

//Incluimos el controlador de sesion
    include('controladorSesion.php');
//Incluimos nuestro fichero de conexión
    include('conexion.php');

//Recibimos los datos del formulario con su repectivo escape de caracteres para prevenir inyecciones SQL
   if(isset($_SESSION['usuario'])){
    mysqli_real_escape_string($conexion, $usuario = $_SESSION['usuario']);
   }else{
    mysqli_real_escape_string($conexion, $usuario = $_REQUEST['usuario']);
   }
    mysqli_real_escape_string($conexion, $password = $_POST['contrasena']);   
//Llamamos a la funcion de acceso.
       acceso($usuario,$password,$conexion);
?>
       
