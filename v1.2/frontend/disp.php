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
    case 'form_disp_agregar':
        ?>

<div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo dispositivo</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
 </div>
<form id="<?php echo $formulario ?>">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_disp_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre del dispositivo:</label>
          </div>


          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_disp_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="form-floating text-light mb-3">
              <select id="txt_disp_dum_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="" selected></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                     
                             $consulta="SELECT * FROM dum_mst WHERE dum_id NOT IN ('1')";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['dum_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['dum_nom']; ?> (<?php echo $valores['dum_sigl']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                 </select>
              <label>Unidad que medira</label>
            </div>

            <div class="form-floating text-light mb-3">
              <select id="txt_disp_disp_tipo_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="" selected></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                     
                             $consulta="SELECT * FROM disp_tipo_mst WHERE disp_tipo_id NOT IN ('1')";
                              $buscatiposDisp= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposDisp)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['disp_tipo_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['disp_tipo_nom']; ?></option>
                                      <?php
                                  }           
                      ?>
                 </select>
              <label>Seleccione el tipo de dispositivo</label>
            </div>


          <div class="text-center">
          <button type="button"  id="btn_form" onclick="desabilitaFormBtn(); func_disp_agregar(obtenerIdForm())" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;


        
        case 'form_disp_modificar':
          $dispositivo = $_POST['dispositivo'];

            #Consultamos la información primordial acerca del espacio
            $consulta = "SELECT * FROM disp_mst, dum_mst, disp_tipo_mst WHERE disp_id='$dispositivo' AND disp_dum_id = dum_id AND disp_disp_tipo_id = disp_tipo_id";
            $buscaPlaca = mysqli_query($conexion, $consulta);
  
            if(mysqli_num_rows($buscaPlaca)>0){
              $datos = mysqli_fetch_array($buscaPlaca);
            }

          ?>

          
  
  <div class="offcanvas-header m-3">
   <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificando dispositivo</h5>
     <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
   </div>
  <form id="<?php echo $formulario ?>">
    
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_disp_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datos['disp_nom']; ?>">
              <label>Nombre del placa de desarollo:</label>
            </div>
  
  
            <div class="form-floating text-light mb-3">
              <textarea type="text" id="txt_disp_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $datos['disp_desc_gral']; ?></textarea>
              <label>Descripción breve</label>
            </div>

            <div class="form-floating text-light mb-3">
              <select id="txt_disp_dum_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="<?php echo $datos['disp_dum_id']; ?>" selected><?php echo $datos['dum_nom']; ?></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                        $unidad = $datos['disp_dum_id'];
                             $consulta="SELECT * FROM dum_mst WHERE dum_id NOT IN ('1') AND dum_id NOT IN ('$unidad')";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['dum_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['dum_nom']; ?> (<?php echo $valores['dum_sigl']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                 </select>
              <label>Unidad que medira</label>
            </div>


            <div class="form-floating text-light mb-3">
              <select id="txt_disp_disp_tipo_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="<?php echo $datos['disp_disp_tipo_id']; ?>" selected><?php echo $datos['disp_tipo_nom']; ?></option>  
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                      $tipo = $datos['disp_disp_tipo_id'];
                             $consulta="SELECT * FROM disp_tipo_mst WHERE disp_tipo_id NOT IN ('1') AND disp_tipo_id NOT IN ('$tipo')";
                              $buscatiposDisp= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposDisp)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['disp_tipo_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['disp_tipo_nom']; ?></option>
                                      <?php
                                  }           
                      ?>
                 </select>
              <label>Seleccione el tipo de dispositivo</label>
            </div>
  
  
            <div class="text-center">
            <button type="button"  id="btn_form" onclick="desabilitaFormBtn(); func_disp_modificar(obtenerIdForm(),'<?php echo $dispositivo ?>')" class="btn btn-outline-light">Aceptar</button>
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