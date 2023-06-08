<?php

  include('../backend/conexion.php');
  include('iconos.php');
?>

<?php
$consulta = "SELECT * FROM esp_mst";
$buscaEspacio = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaEspacio)>0){
  ?>
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 ">
  <?php
    while($datos = mysqli_fetch_array($buscaEspacio)){

            ?>
            <!-- Se crea una nueva tarjeta -->
            <div class="col">
            <div class="card w-auto shadow-sm" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title"><?php echo $datos['esp_nom']; ?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_ubicacion; ?><?php echo $datos['esp_geo']; ?></h6>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
              <div class="col text-center"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_placa; ?><span class="badge bg-secondary">0</span></h6></div>
              <div class="col text-center"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_dispositivos; ?><span class="badge bg-secondary">0</span></h6></div>
              <div class="col text-center"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_espacio_borde; ?><span class="badge bg-secondary">0</span></h6></div>
              <div class="col text-center"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_personas; ?><span class="badge bg-secondary">0</span></h6></div>
            </div>
        
           <!-- <p class="card-text"><?php echo $i_detalles; ?><?php echo $datos['esp_desc']; ?></p> -->
           
           <!-- <a href="#" class="card-link">Card link</a> -->
           <!-- <a href="#" class="card-link">Another link</a> -->

           <button class="btn btn-outline-dark">Ver detalles</button>
           <button class="btn btn-outline-danger" onclick="eliminarEspacio(<?php echo $datos['esp_id']; ?>)">Eliminar</button>
  
            </div>
            </div>
            </div>
            <!-- Finaliza la creación -->
            <?php
    }
    ?>
    </div>
   <?php

}else{
  ?>
 
  <div class="position-relative p-5 text-center bg-body">
    <?php echo $i_advertencia ?>
    <h1 class="text-body-emphasis">Aun no has creado espacios</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarEsp()">
      Crear espacio
    </button>
  </div>
  <?php
}

?>