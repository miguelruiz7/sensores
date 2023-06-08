<?php
$ruta_base = basename($_SERVER['PHP_SELF']);
?>



<div  class="offcanvas offcanvas-start" tabindex="-1" id="menuOffcanvas" aria-labelledby="offcanvasRightLabel" >
  <div id="sidebarmenu" class="offcanvas-body">
     <div class="d-flex justify-content-center align-items-center pb-3 mb-3 link-light text-decoration-none border-bottom">    
      <span class="fs-5 fw-semibold"><?php echo $titulo ?></span>
      <button type="button" class="btn text-light" data-bs-dismiss="offcanvas" aria-label="Close">Cerrar</button>
    </div>

    <div class="mb-0 container-fluid bg-none text-center p-3 border-bottom" >
    <svg class="bd-placeholder-img rounded-circle" width="70" height="70" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="white"></rect><text x="40%" y="52%" fill="#084f88" dy=".3em">M</text></svg>
<h5 class="fw-light text-light m-3">¡Hola!, Miguel Ruiz Zamora</h5>
<button type="button" class="btn btn-outline-light" >Cerrar sesión</button>
</div>

<div class="mb-0 container-fluid bg-none text-center p-3 border-bottom mt-3" >
<ul class="list-unstyled ps-0 ">
      <li class="mb-1">
       <!-- Botones para agregar -->

       <?php if($ruta_base == 'index.php'){ ?>
            <!-- Agregar espacio -->
      <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarEsp(); ocultarCanvas('menuOffcanvas');">
         <?php echo $i_agregar; ?> Crear espacio
      </button>
      <?php }  ?>

      <?php if($ruta_base == 'secciones.php'){ ?>
            <!-- Agregar seccion -->
      <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formAgregarSec()">
         <?php echo $i_agregar; ?> Crear sección
      </button>
      <?php }  ?>

      </li>

   
      <?php if($ruta_base != 'index.php'){ ?>
            <!-- Agregar seccion -->
            <li class="mb-1">
               <!-- Boton para volver a inicio -->  
      <a href="index.php"><button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light"  aria-expanded="true">
         <?php echo $i_casa; ?> Volver a inicio
      </button></a>
            </li>
      <?php }  ?>

    </ul> 
</div>


<div class="mb-0 container-fluid bg-none text-center p-3">
<h6 id="footer justify-content-center" class="text-light p-3"><small>© <?php echo $anio;?> <?php echo $organizacion ?> | <?php echo $version;?></small></h6>
</div>
</div>
</div>