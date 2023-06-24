<?php
include('../backend/conexion.php');
include('../backend/info.php');
include('iconos.php');
include('../backend/funciones.php');

$ruta_base = basename($_SERVER['PHP_SELF']);


?>
    <?php
if(isset($_SESSION['usr_id'])){
  $sesion = $_SESSION['usr_id'];
  $admin_sistema = administradorSistema($sesion, $conexion);

?>

    <div class="mb-0 container-fluid bg-none text-center p-3 border-bottom" >

    <?php
$consulta = "SELECT * FROM usr_mst WHERE usr_id = '$sesion'";
$infoUsuario = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($infoUsuario)>0){
  # Si existe un registro despliega toda la informacion que exista
  $datos = mysqli_fetch_array($infoUsuario);
}


  ?>


    <svg class="bd-placeholder-img rounded-circle" width="70" height="70" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="white"></rect><text x="40%" y="52%" fill="#084f88" dy=".3em"><?php echo substr($datos['usr_nom'],0,1) ?></text></svg>
<h5 class="fw-light text-light m-3">¡Hola!, <?php echo $datos['usr_nom']; ?></h5>
<button type="button" class="btn btn-outline-light" onclick="cerrarSesion()">Cerrar sesión</button>
</div>

<?php

if($admin_sistema == 1) {

  ?>
<div class="mb-0 container-fluid bg-none text-center p-3 border-bottom mt-3" >
  <h6 class="text-light">ADMINISTRACION DEL SISTEMA</h6>
<ul class="list-unstyled ps-0 ">    
     <li class="mb-1">
        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#config" aria-expanded="true">
         <?php echo $i_variables; ?> Variables
        </button>
        <div class="collapse" id="config">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="roles_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo $i_roles_usu; ?> Roles de usuario</a></li>
          </ul>
        </div>
      </li>
    </ul> 
</div>
<?php
}
  ?>

<div class="mb-0 container-fluid bg-none text-center p-3 border-bottom mt-3" >
  <h6 class="text-light">PLATAFORMA</h6>
<ul class="list-unstyled ps-0 ">
   <li class="mb-1">
          <a href="espacios_mst.php"><button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light">
            <?php echo $i_espacio_borde; ?> Espacios
            </button></a>
    </li>
    <li class="mb-1">
          <a href="pl_mst.php"><button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light">
            <?php echo $i_placa; ?> Placas
            </button></a>
    </li>
    <li class="mb-1">
          <a href="disp_mst.php"><button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light">
            <?php echo $i_dispositivos; ?> Dispositivos
            </button></a>
    </li>
    <?php if($admin_sistema == 1 || administradorPlataforma($sesion, $conexion) == 1){ ?>
    <li class="mb-1">
          <a href="usuarios_mst.php"><button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light">
            <?php echo $i_personas; ?> Usuarios
            </button></a>
    </li>
    <?php } ?>
    
     <!-- <li class="mb-1">
        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#config" aria-expanded="true">
         <?php echo $i_ajustes; ?> Configuración
        </button>
        <div class="collapse" id="config">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded">Perfil</a></li>
          </ul>
        </div>
      </li> -->
   
    </ul> 
</div>


<div class="mb-0 container-fluid bg-none text-center p-3">
<h6 id="footer justify-content-center" class="text-light p-3"><small>© <?php echo $anio;?> <?php echo $organizacion ?> | <?php echo $version;?></small></h6>
</div>

<?php
}else{
?>
<div class="position-relative p-5 text-center text-light">
    <?php echo $i_advertencia ?>
    <p class="col-lg-6 mx-auto mb-4">
      Sesión caducada
    </p>
   <a href="acceso.php"> <button class="btn btn-outline-light px-5 mb-5" type="button" > 
      Inicia sesión
    </button> </a>
</div>
<?php
}
?>
