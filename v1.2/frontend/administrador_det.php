<?php
# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones


#Verifica que exista sesion
if(isset($_SESSION['usr_id'])){

# Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
$sesion = $_SESSION['usr_id'];
$admin_sistema = administradorSistema($sesion, $conexion);

?>



<?php

$consulta = "SELECT * FROM usr_det, usr_mst WHERE usr_id = usr_usr_id";
$buscaAdministrador = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaAdministrador)>0){

  $datosAdministrador = mysqli_fetch_array($buscaAdministrador);

  if($admin_sistema == 1 || administradorPlataforma($sesion, $conexion) == 1){
  # Si existe un registro despliega toda la informacion que exista
  ?>
  <div class="container m-2 text-center"> 
<p>Administrador actual: </p>  

<p class="fw-bold"><?php echo $datosAdministrador['usr_nom'] ?></p>  

</div>

    <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_usr_admin();">
         Cambiar a un administrador de la plataforma 
      </button></div>

  
   <?php
}else{
   # Muestra alguna tarjeta que despliegue restriccion
   ?>
      <div class="position-relative p-5 text-center text-dark">
            <?php echo $i_advertencia ?>
            <h1 class="text-body-emphasis">No tienes permisos</h1>
            <p class="col-lg-6 mx-auto mb-4">
              No tienes los suficientes privilegios para acceder a la siguiente información
            </p>
          </div>
   <?php
  }}else{
     # Muestra alguna tarjeta que despliegue alguna informacion de que no hay ningun registro para administrador
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>

    <h1 class="text-body-emphasis"> No hay ningún administrador </h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes asignar uno desde aquí
    </p>
    <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_usr_admin();">
         Asigna un administrador de la plataforma 
      </button></div>
    </div>

  <?php
  }
  }else{
    #Muestra una tarjeta que despliegue informacion de que inicie sesion
     ?>
     <div class="position-relative p-5 text-center bg-body">
       <?php echo $i_advertencia ?>
       <h1 class="text-body-emphasis">Sesión caducada</h1>
       <p class="col-lg-6 mx-auto mb-4">
         Inicie sesión
       </p>
      <a href="acceso.php"> <button class="btn btn-outline-dark px-5 mb-5" type="button"> Iniciar sesion</button></a>
     </div>
     <?php
  }
?>