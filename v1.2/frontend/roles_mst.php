<?php
#Incluimos nuestras dependencias.

include('../backend/conexion.php');
include('../backend/info.php');
include('iconos.php');
include('../backend/funciones.php');

sesion_usr();
// Almacenamos esto en variables
$sesion=sesion_usr();

# Limpiamos la seccion 
destruirvariables();

?>

<!doctype html>
<html lang="es">
<head>
    <title>Roles de usuario </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/app.css">
   <!-- <link rel="shorcut icon" href="css/img/icono.png">  -->
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
</head>

<body id="cuerpo">
    <header id="notificaciones" class="sticky-top"></header>

    <?php include('notificaciones.php'); ?>

<div id="encabezado">
                <!-- Apartado de botones y acciones o logos -->
                <button class="btn text-light m-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas" aria-controls="offcanvasRight" onclick="cargarMenu()"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
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
                <div id="contenedor_encabezado"><h1> Roles de usuario</h1></div>
             
            </div>
</div>
</div>

<div class="album py-5">
    <div id="roles"  class="container">
    <div id="loader" class="text-center">
    <div class="spinner-border text-dark" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
        </div>
    </div>
  </div>


<!-- Menu -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="menuOffcanvas" aria-labelledby="offcanvasRightLabel" >
  <div id="sidebarmenu" class="offcanvas-body">
     <div class="d-flex justify-content-center align-items-center pb-3 mb-3 link-light text-decoration-none border-bottom">    
      <span class="fs-5 fw-semibold"><?php echo $titulo ?></span>
      <button type="button" class="btn text-light" data-bs-dismiss="offcanvas" aria-label="Close">Cerrar</button>
    </div>
    <div id="contenedorMenu">

    </div>
</div>
</div>


<!-- Formularios modales -->
<?php include('formularios_modal.php'); ?>


    <script src="jquery/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>