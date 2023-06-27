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

$consulta = "SELECT * FROM disp_mst, dum_mst, disp_tipo_mst WHERE disp_dum_id = dum_id AND disp_disp_tipo_id = disp_tipo_id";
$buscaDispositivos = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaDispositivos)>0){

  if($admin_sistema == 1 || administradorPlataforma($sesion, $conexion) == 1){
  # Si existe un registro despliega toda la informacion que exista
  ?>
    <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_disp_agregar();">
         <?php echo $i_agregar; ?> Crear nueva dispositivo
      </button></div>

   <div class="table-responsive">
              <table class="table text-dark">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Unidad que medirá</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
  <?php
    while($datos = mysqli_fetch_array($buscaDispositivos)){

            ?>
          <tr>
                <th scope="row"><?php echo $datos['disp_nom'];?></th>
                <td><?php echo $datos['disp_desc_gral'];?></td>
                <td><?php echo $datos['disp_tipo_nom'];?></td>
                <td><?php echo $datos['dum_nom'];?> (<?php echo $datos['dum_sigl'];?>)</td>
                <td>
                  <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_disp_modificar('<?php echo $datos['disp_id'];?>');"><?php echo $i_modificar; ?></button> 
                    <button class="btn btn-outline-dark" onclick="func_disp_eliminar('<?php echo $datos['disp_id'];?>')"><?php echo $i_basura; ?></button>

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

    <h1 class="text-body-emphasis"> No hay dispositivos en el sistema</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="form_disp_agregar();"> 
      Crear dispositivos
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