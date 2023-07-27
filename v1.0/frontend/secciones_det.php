<?php

include('../backend/conexion.php');
include('iconos.php');


$consulta = "SELECT * FROM esp_mst";
$buscaEspacio = mysqli_query($conexion, $consulta) ;
if(mysqli_num_rows($buscaEspacio)>0){
    $datos = mysqli_fetch_array($buscaEspacio);
?>
 <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 ">
<?php
    while($datos){

            ?>
            <!-- Se crea una nueva tarjeta -->
            <div class="col">
            <div class="card shadow-sm" style="width: 18rem;">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
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
    <h1 class="text-body-emphasis">Aun no has creado ninguna sección</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="formAgregarSec()">
      Crear sección
    </button>
  </div>
  <?php
}

?>