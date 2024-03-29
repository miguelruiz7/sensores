<?php
##############################
#                            #
# Checar el modulo de placas #
#                            #
##############################

# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones
if(isset($_SESSION['usr_id'])){

  # Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
  $sesion = $_SESSION['usr_id'];


$seccion = comprobarProductos();
$espacio = comprobarSeccion();


$admin_sistema = administradorSistema($sesion, $conexion);
$admin_plataforma = administradorPlataforma($sesion,$conexion);
$funcionesRol = rolPlataforma($sesion, $espacio, $conexion);




if($seccion != ''){


# Consulta de las secciones
$consulta = "SELECT * FROM prod_mst, sec_mst WHERE prod_sec_id = '$seccion' AND sec_id = prod_sec_id";
$buscaProductos = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaProductos)>0){
  # Si existe un registro despliega toda la informacion que exista
  # Detecta el rol si es adminitrativo
  if(1 == 1) {
  ?>
  <div class="container mb-5 text-center"> <?php if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_prod_esc'] == 1) { ?> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarProd();">
         <?php echo $i_agregar; ?> Crear producto
      </button> <?php } ?>
      <a href="secciones_mst.php"><button class="btn btn-outline-dark" type="button"> <?php echo $i_atras; ?>
      Regresar a secciones
    </button></a>
    </div>
  
      <?php
       }
       ?>
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 ">
  <?php
 

    while($datos = mysqli_fetch_array($buscaProductos)){

            ?>
            <div class="col">
            <div class="card w-auto shadow-sm" style="width: 18rem;">
            <div class="card-body">

            
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 m-1">
              <div class="col"><h5 class="card-title"><?php echo $datos['prod_nom']; ?></h5></div>
              <div class="col text-center mb-3"> <?php if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_prod_esc'] == 1) { ?><button class="btn btn-outline-danger" onclick="eliminarProducto(<?php echo $datos['prod_id']; ?>)"><?php echo $i_basura; ?></button>
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formModificarProd(<?php echo $datos['prod_id']; ?>)"><?php echo $i_modificar; ?></button><?php } ?></div>
            </div>
  
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
        <div class="col text-center">   <?php if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_disp_lec'] == 1) { ?> <button class="btn p-2  " data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formPlacas(<?php echo $datos['prod_id']; ?>)"><h6 class="card-subtitle  text-body-secondary"><?php //echo $i_placa; ?> Placas: <span class="badge bg-secondary"><?php echo conteoPlacasProducto($datos['prod_id'],$conexion); ?></span></h6></button></div>
            <?php  if(conteoPlacasProducto($datos['prod_id'],$conexion)>0){  ?>  <div class="col text-center"> <button class="btn p-2" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formDispositivos(<?php echo $datos['prod_id']; ?>)"><h6 class="card-subtitle mb-2 text-body-secondary"><?php //echo $i_dispositivos; ?>Disp: <span class="badge bg-secondary"><?php echo conteoDispositivosProducto($datos['prod_id'],$conexion); ?></span></h6></button><?php } } ?></div> 
            </div> 
            


<?php
# CORREGIR -- ESCALA BASES DE DATOS Y MODIFICA EN TABLAS. 
$producto = $datos['prod_id'];
$consulta = "SELECT * FROM pl_det, disp_mst, disp_det, dum_mst WHERE  pl_prod_id = '$producto' AND dum_id = disp_dum_id AND disp_id = disp_disp_id AND disp_pl_id = pl_id_";
$buscaDispositivos = mysqli_query($conexion, $consulta);
if(mysqli_num_rows($buscaDispositivos)>0){
?>

<div class="table-responsive">
            <table class="table small">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Dispositivo</th>
      <th scope="col">Valores</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
  while($datosDispositivos = mysqli_fetch_array($buscaDispositivos)){

    $siglas = $datosDispositivos['dum_sigl'];

    if($siglas != '*'){
      $siglas_def = $datosDispositivos['dum_sigl'];
    }else{
      $siglas_def = '';
    }

?>
    <tr>
      <th scope="row"><?php echo $datosDispositivos['disp_nom']; ?></th>
      <td><?php echo sensorizarDispositivo($datosDispositivos['disp_id_'], $conexion)." ".$siglas_def; ?></td>
     <td><?php if ($datosDispositivos['dum_sigl'] != '*') { ?><button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="form_disp_historico('<?php echo $datosDispositivos['disp_id_'] ?>')">Datos historicos</button> <?php } ?></td>  
    </tr>
    <?php
}
?>
  </tbody>
</table>
</div>
          
            <?php
}else{
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia_pequeno ?>
    <h6 class="text-body-emphasis">No hay ningún dispositivo</h6>
  </div>

<?php 
} ?>
  </div>
    </div>
      </div>
<?php

    }
    ?>
    </div>
    
   <?php
}else{


  if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_prod_esc'] == 1) {


  # Muestra alguna tarjeta que despliegue alguna informacion de que no hay ningun registro para administrador
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>
    <h1 class="text-body-emphasis"> Aun no has creado productos</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarProd()"> 
      Crear producto
    </button>
   <a href="secciones_mst.php"><button class="btn btn-outline-dark px-5 mb-5" type="button"> 
      Regresar a secciones
    </button> </a>
  </div>

  <?php }else{ ?>

  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>
    <h1 class="text-body-emphasis"> Aun no han creado productos</h1>
    
    <p class="col-lg-6 mx-auto mb-4">
      Continua navegando en la plataforma
    </p>
   
   <a href="secciones_mst.php"><button class="btn btn-outline-dark px-5 mb-5" type="button"> 
      Regresar a secciones
    </button> </a>
  </div>

<?php 
}
}}else{
  
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>
    <h1 class="text-body-emphasis">Valor vació</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Verifica que haya algún valor
    </p>
  </div>

<?php 
}
}else{
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