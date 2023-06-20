<?php
# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones


# Verifica que exista sesion
if(isset($_SESSION['usr_id'])){

# Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
$sesion = $_SESSION['usr_id'];
$admin_sistema = administradorSistema($sesion, $conexion);


if($admin_sistema == 1){
$consulta = "SELECT * FROM esp_mst";
}else{
$consulta = "SELECT * FROM esp_mst, esp_det WHERE esp_usr_id = '$sesion' AND esp_id = esp_esp_id";
}


$buscaEspacio = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaEspacio)>0){
  # Si existe un registro despliega toda la informacion que exista
  
  # Detecta el rol si es adminitrativo
  if(administradorPlataforma($sesion, $conexion) == 1) {
  ?>
  <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarEsp(); ocultarCanvas('menuOffcanvas');">
         <?php echo $i_agregar; ?> Crear espacio
      </button></div>
      <?php
       }
       ?>
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 ">
  <?php
 
 

    while($datos = mysqli_fetch_array($buscaEspacio)){

      $funcionesRol = rolPlataforma($sesion,$datos['esp_id'],$conexion);

            ?>
            <div class="col">
            <div class="card w-auto shadow-sm" style="width: 18rem;">
            <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 m-1">
              <div class="col"><h5 class="card-title"><?php echo $datos['esp_nom']; ?></h5></div>
              <div class="col text-center"><?php if($admin_sistema == 1 || $funcionesRol['usrol_esp_esc'] == 1 ) {?><button class="btn btn-outline-danger" onclick="eliminarEspacio(<?php echo $datos['esp_id']; ?>)"><?php echo $i_basura; ?></button><?php } ?>
              <?php if( $admin_sistema == 1 || $funcionesRol['usrol_esp_esc'] == 1) {?><button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formModificarEsp(<?php echo $datos['esp_id']; ?>)"><?php echo $i_modificar; ?></button><?php } ?></div>
            
            </div>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_ubicacion; ?><?php echo $datos['esp_geo']; ?></h6>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3">
          
              <div class="col text-center"><button class="btn p-2 " onclick="cargarSeccionesEspacio('<?php echo $datos['esp_id']; ?>')"><h6 class="card-subtitle text-body-secondary"><?php //echo $i_espacio_borde; ?> Secciones: <span class="badge bg-secondary"><?php echo conteoSecciones($datos['esp_id'], $conexion) ?></span></h6></button></div>
              <div class="col text-center"> <?php if($admin_sistema == 1 || $funcionesRol['usrol_gral_lec'] == 1) { ?><button class="btn p-2 " data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formUsuariosEsp(<?php echo $datos['esp_id']; ?>)"><h6 class="card-subtitle text-body-secondary"><?php //echo $i_personas; ?> Usuarios: <span class="badge bg-secondary"><?php echo conteoUsuarios($datos['esp_id'], $conexion) ?></span></h6></button><?php } ?></div>
            </div>

            <div class="text-center">
            
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
  ?>
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>

    <?php if(administradorPlataforma($sesion, $conexion) == 1) { ?> <h1 class="text-body-emphasis"> Aun no has creado espacios</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarEsp()"> 
      Crear espacio
    </button>  <?php }else{
      
        # Muestra alguna tarjeta que despliegue alguna informacion de que no hay ningun registro para quien no sea administrador 
      ?>
      <h1 class="text-body-emphasis"> Aun no te asignan espacio</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Espera que te asignen uno o contacta con tu administrador
    </p>

    <?php } ?>
  </div>
  <?php }}else{
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