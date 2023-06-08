<?php
include('../backend/conexion.php');
include('iconos.php');



if(isset($_POST['formulario'])){
$formulario = $_POST['formulario'];
switch($formulario){
    case 'agregar':
        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo espacio</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarEspacio')">Cerrar</button>
 </div>
<form id="agregarEspacio">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_esp_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre del espacio</label>
          </div>


          <div class="form-floating text-light mb-3">
            <select id="txt_esp_espt_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
                    <option class="bg-none" value=""  selected></option> 
                    <?php
                    # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación

                           $consulta="SELECT * FROM espt_mst";
                            $buscatiposEspacio= mysqli_query($conexion,$consulta);
                                while($valores= mysqli_fetch_array($buscatiposEspacio)){
                                    ?>
                                    <option class="bg-none" value="<?php echo $valores['espt_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['espt_nom']; ?></option>
                                    <?php
                                } 
                                
                    ?>
               </select>
            <label>Tipo de espacio</label>
          </div>

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_esp_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_esp_area" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" pattern="[0-9]+([\.,][0-9]+)?">
            <label>Area del espacio</label>
          </div>

          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_esp_geo" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Ubicación geográfica</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="espacio" onclick="agregarEspacio()" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;



        // Formulario para agregar secciones en un espacio


        case 'agregarSeccion':
          echo "<script>alert('Formulario: Sección está trabajando')</script>"
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear una nueva sección</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarSeccion')">Cerrar</button>
 </div>
<form id="agregarSeccion">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_esp_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre de la seccion</label>
          </div>


   

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_esp_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>


          <div class="text-center">
          <button type="button" onclick="agregarSeccion()" class="btn btn-outline-light">Aceptar</button>
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