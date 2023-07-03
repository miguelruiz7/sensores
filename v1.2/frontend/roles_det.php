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

?>



<?php

$consulta = "SELECT * FROM usrol_mst WHERE usrol_id NOT IN ('1')";

$buscaUsuarios = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaUsuarios)>0){

  if(administradorSistema($sesion, $conexion) == 1){
  # Si existe un registro despliega toda la informacion que exista
  ?>
    <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_rol_agregar();">
         <?php echo $i_agregar; ?> Crear nuevo rol
      </button></div>

   <div class="table-responsive">
              <table class="table text-dark">
                <thead>
                  <tr>
                    <th scope="col">Nombre del Rol</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
  <?php
    while($datosUsuarios = mysqli_fetch_array($buscaUsuarios)){

            ?>
          <tr>
                <th scope="row"><?php echo $datosUsuarios['usrol_nom'];?></th>
                <td><?php echo $datosUsuarios['usrol_desc'];?></td>
                <td>
                   <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_rol_modificar('<?php echo $datosUsuarios['usrol_id'];?>');"><?php echo $i_modificar; ?></button>
                    <button class="btn btn-outline-dark" onclick="func_rol_eliminar('<?php echo $datosUsuarios['usrol_id'];?>')"><?php echo $i_basura; ?></button>
                  </td>
                </tr>
            <?php
    }
    ?>
    </div>
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

    <h1 class="text-body-emphasis"> No hay roles en el sistema</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="form_rol_agregar();"> 
      Crear rol.
    </button>
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