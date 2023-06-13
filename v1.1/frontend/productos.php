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
        case 'agregarSeccion':

          $seccion = $_SESSION['esp_id'];

          #Agrega una sección al espacio (NO FUNCIONA)
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear una nueva sección</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarSeccion')">Cerrar</button>
 </div>
<form id="agregarSeccion">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_sec_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre de la seccion</label>
          </div>

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_sec_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="agregarSeccion" onclick="agregarSeccion('<?php echo $seccion; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <?php
        break;

        case 'modificarSeccion':
          #Modifica el espacio

          #Almacenamos los valores que halla traido el formulario
          $id = $_POST['id']; 

          #Consultamos la información primordial acerca del espacio
          $consulta = "SELECT * FROM sec_mst WHERE sec_id='$id'";
          $buscaSeccion = mysqli_query($conexion, $consulta);

          if(mysqli_num_rows($buscaSeccion)>0){
            $datosSeccion = mysqli_fetch_array($buscaSeccion);
          }
          ?>
        
   
   <div class="offcanvas-header m-3">
   <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modifica la seccion</h5>
     <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
   </div>
  <form id="modificaSeccion">
    
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_sec_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datosSeccion['sec_nom']; ?>">
              <label>Nombre de la seccion</label>
            </div>
  
            <div class="form-floating text-light mb-3">
              <textarea type="text" id="txt_sec_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" ><?php echo $datosSeccion['sec_desc']; ?></textarea>
              <label>Descripción breve</label>
            </div>
  
            <div class="text-center">
            <button type="button" id="funcion" value="modificarSeccion" onclick="modificarSeccion(<?php echo $id ?>);" class="btn btn-outline-light">Aceptar</button>
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