<?php
include('../backend/info.php');
include('iconos.php');
?>

<!doctype html>
<html lang="es">
<head>
    <title>Inicio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/app.css">
   <!-- <link rel="shorcut icon" href="css/img/icono.png">  -->
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> <!-- actualizo -->
</head>


<body id="cuerpo">
<div id="loader-container">
  <div class="loader"></div>

</div>
<iframe id="main" src="dashboard_mst.php"></iframe>
<!-- Navegacion -->
<nav id="navegacion_inf" class="navbar navbar-expand-sm  fixed-bottom">
  <div class="row row-cols-md-2 m-1 text-center text-light g-3" style="flex: auto;">
  <div class="col themed-grid-col"><button class="btn text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas" aria-controls="offcanvasRight"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
<path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"></path>
</svg></button></div>

<div class="col themed-grid-col" data-bs-toggle="offcanvas" href="#formulariosOffcanvas" role="button" aria-controls="offcanvasExample" onclick="formAgregarEsp()"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"></path>
</svg></div>

  </div>
</nav>

<!-- Menu -->
<div  class="offcanvas offcanvas-start" tabindex="-1" id="menuOffcanvas" aria-labelledby="offcanvasRightLabel" >
  <div id="sidebarmenu" class="offcanvas-body">
    <!-- Cuerpo -->
     <!-- Contenedor acerca del usuario -->
     <div class="d-flex justify-content-center align-items-center pb-3 mb-3 link-light text-decoration-none border-bottom">
     <!-- <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg> -->
     <!--  <img src="img/logo.png" width="35px" style="margin:5px"></img> -->

     
      <span class="fs-5 fw-semibold"><?php echo $titulo ?></span>
      <button type="button" class="btn text-light" data-bs-dismiss="offcanvas" aria-label="Close">Cerrar</button>
    </div>

    <div class="mb-0 container-fluid bg-none text-center p-3 border-bottom" >
    <svg class="bd-placeholder-img rounded-circle" width="70" height="70" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="white"></rect><text x="40%" y="52%" fill="#084f88" dy=".3em">M</text></svg>
<h5 class="fw-light text-light m-3">¡Hola!, Miguel Ruiz Zamora</h5>
<button type="button" class="btn btn-outline-light" >Cerrar sesión</button>
</div>




<div class="mb-0 container-fluid bg-none text-center p-3 border-bottom" >
<ul class="list-unstyled ps-0 ">
      <li class="mb-1">
        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#espacio" aria-expanded="true">
         <?php echo $i_espacio; ?> Mis espacios
        </button>
        <div class="collapse" id="espacio">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded">Espacios</a></li>
            <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded">Usuarios</a></li>
          </ul>
          
        </div>
      </li>  
    </ul>

    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#config" aria-expanded="true">
         <?php echo $i_ajustes; ?> Configuración
        </button>
        <div class="collapse" id="config">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="#" class="link-light d-inline-flex text-decoration-none rounded">Perfil</a></li>
          </ul>
        </div>
      </li>  
    </ul>  
</div>


<div class="mb-0 container-fluid bg-none text-center p-3">
<h6 id="footer justify-content-center" class="text-light p-3"><small>© <?php echo $anio;?> <?php echo $organizacion ?> | <?php echo $version;?></small></h6>
</div>
</div>
    </div>

<!-- Formularios -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="formulariosOffcanvas" aria-labelledby="offcanvasExampleLabel">
  <div id="sidebarmenu" class="offcanvas-body text-center">
     <div id="notificacionesform" class="sticky-top"></div>
  <div id="formularios_contenedor">

  </div>
  </div>
</div>



</div>
</div>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>