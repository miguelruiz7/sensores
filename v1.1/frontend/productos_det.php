<?php
# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones
if(isset($_SESSION['usr_id'])){

  # Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
  $sesion = $_SESSION['usr_id'];


$seccion = comprobarProductos();


if($seccion != ''){


# Consulta de las secciones
$consulta = "SELECT * FROM prod_mst, sec_mst WHERE prod_sec_id = '$seccion' AND sec_id = prod_sec_id";
$buscaSecciones = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaSecciones)>0){
  # Si existe un registro despliega toda la informacion que exista
  # Detecta el rol si es adminitrativo
  if(1 == 1) {
  ?>
  <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarSec(); ocultarCanvas('menuOffcanvas');">
         <?php echo $i_agregar; ?> Crear secciones
      </button></div>
      <?php
       }
       ?>
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 ">
  <?php
 

    while($datos = mysqli_fetch_array($buscaSecciones)){

            ?>
            <div class="col">
            <div class="card w-auto shadow-sm" style="width: 18rem;">
            <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 m-1">
              <div class="col"><h5 class="card-title"><?php echo $datos['sec_nom']; ?></h5></div>
              <div class="col text-center"><button class="btn btn-outline-danger" onclick="eliminarSeccion(<?php echo $datos['sec_id']; ?>)"><?php echo $i_basura; ?></button>
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formModificarSec(<?php echo $datos['sec_id']; ?>)"><?php echo $i_modificar; ?></button></div>
            
            </div>
  
           <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-3">
            <!--   <div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_placa; ?><span class="badge bg-secondary">0</span></h6></button></div>
              <div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_dispositivos; ?><span class="badge bg-secondary">0</span></h6></button></div>-->
              <div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_lista_prod; ?><span class="badge bg-secondary">0</span></h6></button></div>
            </div> 

            <div class="text-center">
            <!-- <button class="btn btn-outline-dark">Ver detalles</button> -->
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
    <h1 class="text-body-emphasis"> Aun no has creado productos</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarSec()"> 
      Crear producto
    </button>
   <a href="secciones_mst.php"><button class="btn btn-outline-dark px-5 mb-5" type="button"> 
      Regresar a secciones
    </button> </a>
  </div>

<?php
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