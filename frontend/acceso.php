<?php include('../backend/info.php');
include('iconos.php'); 

include('../backend/controladorSesion.php');
sesion_login();

?>



<!doctype html>
<html lang="en">
<head>
    <title>Acceso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/app.css">
   <!-- <link rel="shorcut icon" href="css/img/icono.png">  -->
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css"> 
</head>
  <body id="cuerpo" class="text-center">
 
<main class="form-signin w-100 m-auto">
<!-- <img class="bd-placeholder-img " src="recursos/logo.png" width="150" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em"></text></img> -->
<header id="notificaciones" class="d-flex flex-wrap justify-content-center py-3 mb-4 border-0">
</header>
  <div id="formularios">
  <form id="login"  onsubmit="return false;">
   <div class="container-fluid">
</div>
<br>
<div class="form-floating text-dark">
      <input type="text" name="usuario" id="usuario" class="text-dark form-control border-bottom border-0 border-bottom-2 border-primary bg-transparent rounded-0" id="floatingInput" placeholder="Usuario" aria-autocomplete="none">
      <label class="h6 fw-dark" for="floatingInput"><?php echo $usr; ?> Usuario</label>
    </div>
   <div class="form-floating text-dark">
      <input type="password" name="contrasena" id="contrasena" class="form-control border-bottom border-0 border-bottom-2 border-primary bg-transparent rounded-0" id="floatingInput" placeholder="Contraseña" required aria-autocomplete="none">
      <label class="h6 fw-dark" for="floatingInput"><?php echo $i_llave; ?> Contraseña</label>
    </div>
   
    <button class="w-90 btn btn-lg btn-primary fw-dark m-3 rounded-0" type="button" onclick="iniciar()"><?php echo $entrar; ?> Entrar</button>
    <br>
  </form>
 
  </div>
 
</main>
<?php  ?>
<div class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-transparent text-center">
<h6 id="footer" class="text-dark p-3"><small>© <?php echo $anio;?> <?php echo $organizacion; ?> | <?php echo $version;?></small></h6>
  </div>
    <script src="jquery/jquery.min.js"></script>
    <script src="js/appSesion.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<div id="ultimo"></div>
  </body>
</html>
