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
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
</head>

<body id="cuerpo">
<div id="encabezado">
                <!-- Apartado de botones y acciones o logos -->
                <button class="btn text-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas" aria-controls="offcanvasRight"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
</svg></button> 
            </div>
<div class="wrapper d-flex align-items-stretch">

<div id="contenido">
            <div style="color: blue;">
                <!-- Apartado de botones y acciones o logos -->
            </div>



            <div id="contenedor">
                <!-- aqui va el contenido de la paginación -->
                <div id="contenedor_encabezado"><?php echo $i_espacios; ?><h1> Mis secciones (Espacio exterior)</h1></div>
            </div>
        </div>
</div>



<div class="album py-5">
    <div id="secciones"  class="container">

      
    </div>
  </div>


<!-- Menu -->
<?php include('menu_lateral.php'); ?>

<!-- Formularios modales -->
<?php include('formularios_modal.php'); ?>

    <script src="jquery/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>