<?php
#Dependencias
include('../backend/conexion.php');
include('iconos.php');
include('../backend/funciones.php');


#Funciones
sesion_usr();
$sesion=sesion_usr();



#Seleciona el formulario

if(isset($_POST['formulario'])){
$formulario = $_POST['formulario'];
switch($formulario){
  # Agrega un nuevo espacio
    case 'form_usr_agregar':

        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo usuario</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarUsuario');  revertirFormulario();">Cerrar</button>
 </div>
<form id="<?php echo $formulario ?>">

          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usr_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre</label>
          </div>


          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usr_usu" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Id de usuario</label>
          </div>


          <div class="form-floating text-light mb-3">
            <input type="password" id="txt_usr_con" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Contraseña</label>
          </div>


          
          <div class="form-floating text-light mb-3">
            <input type="password" id="txt_usr_con_con" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Confirma contraseña</label>
          </div>

        

          <div class="text-center">
          <button type="button" id="btn_form" onclick="func_usr_agregar(obtenerIdForm())" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;


          # Agrega un nuevo espacio
    case 'modificarContrasena':

      $id = $_POST['usuario'];

      $consulta = "SELECT * FROM usr_mst WHERE usr_id = '$id'";
$buscaUsuario = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaUsuario)>0){
  $buscaNombre = mysqli_fetch_array($buscaUsuario);
}

      ?>

<div class="offcanvas-header m-3">
<h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar claves de acceso</h5>
 <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="modificarContrasena">

        <div class="form-floating text-light mb-3">
          <input type="text" id="txt_usr_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $buscaNombre['usr_nom']; ?> " disabled>
          <label>Nombre</label>
        </div>


        <div class="form-floating text-light mb-3">
          <input type="password" id="txt_usr_con" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
          <label>Contraseña</label>
        </div>


        
        <div class="form-floating text-light mb-3">
          <input type="password" id="txt_usr_con_con" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
          <label>Confirma contraseña</label>
        </div>

      

        <div class="text-center">
        <button type="button" id="funcion" value="modificarContrasena" onclick="modificarContrasena('<?php echo $id;?>')" class="btn btn-outline-light">Aceptar</button>
        </div> 
      </form>

      <?php
      break;



             # Agrega un nuevo espacio
    case 'modificarDatos':

      $id = $_POST['usuario'];

      $consulta = "SELECT * FROM usr_mst WHERE usr_id = '$id'";
      $buscaUsuario = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($buscaUsuario)>0){
  $buscaNombre = mysqli_fetch_array($buscaUsuario);
}

      ?>

<div class="offcanvas-header m-3">
<h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar datos</h5>
 <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
</div>
<form id="modificarDatos">

        <div class="form-floating text-light mb-3">
          <input type="text" id="txt_usr_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $buscaNombre['usr_nom']; ?> " >
          <label>Nombre</label>
        </div>
      

        <div class="text-center">
        <button type="button" id="funcion" value="modificarDatos" onclick="modificarDatos('<?php echo $id;?>')" class="btn btn-outline-light">Aceptar</button>
        </div> 
      </form>

      <?php
      break;


      


        default:
        echo 'Error al comunicar con el sistema';
        break;


        
          }}else{
            echo "<script>alert('¿Qué estas haciendo?')</script>";
          }
?>