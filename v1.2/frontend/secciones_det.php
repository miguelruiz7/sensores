<?php
# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones
if(isset($_SESSION['usr_id'])){

  # Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
  $sesion = $_SESSION['usr_id'];
  $admin_sistema = administradorSistema($sesion, $conexion);
  $admin_plataforma = administradorPlataforma($sesion,$conexion);


  $espacio = comprobarSeccion();

  # 
  $funcionesRol = rolPlataforma($sesion, $espacio, $conexion);

if($espacio != ''){


# Consulta de las secciones
$consulta = "SELECT * FROM sec_mst, esp_mst WHERE sec_esp_id = '$espacio' AND esp_id = sec_esp_id";
$buscaSecciones = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaSecciones)>0){
  # Si existe un registro despliega toda la informacion que exista
  # Detecta el rol si es adminitrativo
 
  ?>
  <div class="container m-2 text-center"> <?php  if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_sec_esc'] == 1 ) { ?> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarSec(); ocultarCanvas('menuOffcanvas');">
         <?php echo $i_agregar; ?> Crear secciones
      </button> <?php } ?>
      <a href="espacios_mst.php"><button class="btn btn-outline-dark" type="button"> <?php echo $i_atras; ?>
      Regresar a espacios
    </button> </a></div>
   
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-3 ">
  <?php
 

    while($datos = mysqli_fetch_array($buscaSecciones)){


           

            ?>
          <div class="card mb-3">
  <div class="row g-0">
    <div class="col-md-4">
    <div class=" w-auto" >
            <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 m-3">
              <div class="col"><h5 class="card-title"><?php echo $datos['sec_nom']; ?></h5></div>
              <div class="col text-center"> <?php if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_sec_esc'] == 1) { ?><button class="btn btn-outline-danger" onclick="eliminarSeccion(<?php echo $datos['sec_id']; ?>)"><?php echo $i_basura; ?></button>
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formModificarSec(<?php echo $datos['sec_id']; ?>)"><?php echo $i_modificar; ?></button></div> <?php } ?>
            
            </div>
  
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-3">
               <!--<div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_placa; ?><span class="badge bg-secondary">0</span></h6></button></div>
              <div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_dispositivos; ?><span class="badge bg-secondary">0</span></h6></button></div>-->
              <div class="col text-center"><button class="btn p-2"><h6 class="card-subtitle  text-body-secondary" onclick="cargarProductosSeccion('<?php echo $datos['sec_id']; ?>')"><?php //echo $i_lista_prod; ?> Productos: <span class="badge bg-secondary"><?php echo conteoProductosSeccion($datos['sec_id'],$conexion); ?></span></h6></button></div>
            </div> 
            
            <!-- Un link colapsado -->
            <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#variables" aria-expanded="true">
         <?php echo $i_variables; ?> Variables
        </button>
        <div class="collapse" id="variables">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="roles_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Roles de usuario</a></li>
            <li><a href="tipos_esp_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Tipos de espacios</a></li>
            <li><a href="dum_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Unidades de medida</a></li>
          </ul>
        </div>

            <div class="text-center">
            <!-- <button class="btn btn-outline-dark">Ver detalles</button> -->
            </div>
            </div>
            </div>
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Mediciones:</h5>
        <?php

        $seccion = $datos['sec_id'];

$consulta = "SELECT DISTINCT disp_id, disp_nom, dum_sigl FROM  disp_mst, disp_det, pl_det, prod_mst, dum_mst WHERE prod_sec_id = '$seccion'  AND disp_pl_id = pl_id_ AND disp_disp_id = disp_id AND prod_id = pl_prod_id AND dum_id = disp_dum_id";
$buscaDispositivosSecciones = mysqli_query($conexion, $consulta);
if(mysqli_num_rows($buscaDispositivosSecciones)>0){
?>

<div class="table-responsive">
            <table class="table small">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Dispositivo</th>
      <th scope="col">Valor (Promedio):</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
<?php
  while($datos = mysqli_fetch_array($buscaDispositivosSecciones)){
    if($datos['dum_sigl'] != '*'){
?>
    <tr>
      <th scope="row"><?php echo $datos['disp_nom']; ?></th>
      <td><?php echo sensorizarDispositivoPromedios($datos['disp_id'], $conexion).' '.$datos['dum_sigl'] ?></td>
    </tr>
    <?php
}}
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
</div>
            <?php
    }
    ?>
    </div>
   <?php
}else{
  # Muestra alguna tarjeta que despliegue alguna informacion de que no hay ningun registro para administrador
  if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_sec_esc'] == 1) {
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>
    <h1 class="text-body-emphasis"> Aun no has creado secciones</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarSec()"> 
      Crear secciones
    </button>
    <a href="espacios_mst.php"><button class="btn btn-outline-dark px-5 mb-5" type="button"> 
      Regresar a espacios
    </button> </a>
  </div>

  <?php }else{ ?>

<div class="position-relative p-5 text-center bg-body">
  <?php echo $i_advertencia ?>
  <h1 class="text-body-emphasis"> Aun no han creado secciones</h1>
  
  <p class="col-lg-6 mx-auto mb-4">
    Continua navegando en la plataforma
  </p>
 
 <a href="espacios_mst.php"><button class="btn btn-outline-dark px-5 mb-5" type="button"> 
    Regresar a espacios
  </button> </a>
</div>

<?php
}}}else{
  
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