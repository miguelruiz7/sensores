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
    case 'nuevoUsuario':
        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo usuario</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarUsuario');  revertirFormulario();">Cerrar</button>
 </div>
<form id="agregarUsuario">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usr_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre</label>
          </div>


          <div class="form-floating text-light mb-3">
            <select id="txt_usr_defadmin" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
                    <option class="bg-none text-dark" value=""  selected></option> 
                    <option class="bg-none text-dark" value="0"  >No</option> 
                    <option class="bg-none text-dark" value="1"  >Si</option> 
               </select>
            <label>Administrador por defecto</label>
          </div>

          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usr_usu" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre de usuario</label>
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
          <button type="button" id="funcion" value="agregaUsuario" onclick="agregarUsuario()" class="btn btn-outline-light">Aceptar</button>
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