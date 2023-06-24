<?php
#Dependencias
include('../backend/conexion.php');
include('iconos.php');
include('../backend/funciones.php');


#Funciones
sesion_usr();
$sesion=sesion_usr();
$admin_sistema = administradorSistema($sesion, $conexion);

#Seleciona el formulario

if(isset($_POST['formulario'])){
$formulario = $_POST['formulario'];


switch($formulario){
  # Agrega un nuevo espacio
    case 'form_pl_agregar':
        ?>

<div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear una nueva placa</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
 </div>
<form id="<?php echo $formulario ?>">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_pl_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre del placa de desarollo:</label>
          </div>


          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_pl_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>


          <div class="text-center">
          <button type="button"  id="btn_form" onclick="desabilitaFormBtn(); func_pl_agregar(obtenerIdForm())" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;


        case 'form_pl_modificar':


          $placa = $_POST['placa'];

            #Consultamos la información primordial acerca del espacio
            $consulta = "SELECT * FROM pl_mst WHERE pl_id='$placa'";
            $buscaPlaca = mysqli_query($conexion, $consulta);
  
            if(mysqli_num_rows($buscaPlaca)>0){
              $datos = mysqli_fetch_array($buscaPlaca);
            }

          ?>

          
  
  <div class="offcanvas-header m-3">
   <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificando placa</h5>
     <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
   </div>
  <form id="<?php echo $formulario ?>">
    
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_pl_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datos['pl_nom']; ?>">
              <label>Nombre del placa de desarollo:</label>
            </div>
  
  
            <div class="form-floating text-light mb-3">
              <textarea type="text" id="txt_pl_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $datos['pl_desc']; ?></textarea>
              <label>Descripción breve</label>
            </div>
  
  
            <div class="text-center">
            <button type="button"  id="btn_form" onclick="desabilitaFormBtn(); func_pl_modificar(obtenerIdForm(),'<?php echo $placa ?>')" class="btn btn-outline-light">Aceptar</button>
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