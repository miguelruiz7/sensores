<?php
# Dependencias
  include('../backend/conexion.php');
  include('iconos.php');
  include('../backend/funciones.php');

# Funciones


#Verifica que exista sesion
if(isset($_SESSION['usr_id'])){

# Consulta de los espacios; consolidar para poder mostrar sus espacios de cada usuario
$sesion = $_SESSION['usr_id'];

?>



<?php

$consulta = "SELECT * FROM usr_mst WHERE usr_id NOT IN ('$sesion')";
$buscaUsuarios = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaUsuarios)>0){

  # Si existe un registro despliega toda la informacion que exista
  ?>
    <div class="container m-2 text-center"> <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="nuevoUsuario();">
         <?php echo $i_agregar; ?> Crear nuevo usuario
      </button></div>

   <div class="table-responsive">
              <table class="table text-dark">
                <thead>
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
  <?php
    while($datosUsuarios = mysqli_fetch_array($buscaUsuarios)){

            ?>
          <tr>
                <th scope="row"><?php echo $datosUsuarios['usr_nom'];?></th>
                <td><?php if($datosUsuarios['usr_sistema'] == 1){echo 'Administrador por defecto';}else{echo 'Usuario';}?></td>
                <td><?php echo $datosUsuarios['usr_usu'];?></td>
                <td>
                    <button class="btn btn-outline-dark" onclick=";"><?php echo $i_modificar; ?></button>
                    <button class="btn btn-outline-dark" onclick=";"><?php echo $i_basura; ?></button>
                    <button class="btn btn-outline-dark"  data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true"  onclick="formModificarCon('<?php echo $datosUsuarios['usr_id'];?>');"><?php echo $i_llave; ?></button>
                  </td>
                </tr>
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

    <h1 class="text-body-emphasis"> No existe ningún administrador en el sistema</h1>
    <p class="col-lg-6 mx-auto mb-4">
      Sin embargo puedes crear uno desde aquí
    </p>
    <button class="btn btn-outline-dark px-5 mb-5" type="button" data-bs-toggle="modal" data-bs-target="#formulariomodal" onclick="nuevoUsuario();"> 
      Crear usuario
    </button> 
  <?php
  }
  }else{
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