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
    case 'nuevoRol':
         $booleanos = array(['No', 0],['Si', 1]);
        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo rol</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
 </div>
<form id="agregarRol">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usrol_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre</label>
          </div>


          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_usrol_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>


          <div class="container m-1 text-white text-center">
                <div class="row row-cols-2">
                    <div class="col">
                    General
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_gral_lec" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Lectura</label>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_gral_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Escritura</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                    Espacios
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_esp_lec" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Lectura</label>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_esp_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Escritura</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                    Secciones
                    <div class="container text-center">
                        <div class="row">
                        <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_sec_lec" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Lectura</label>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_sec_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Escritura</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                    Productos
                    <div class="container text-center">
                        <div class="row">
                        <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_prod_lec" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Lectura</label>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_prod_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Escritura</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                    Dispositivos
                    <div class="container text-center">
                        <div class="row">
                        <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_disp_lec" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Lectura</label>
                                </div>
                            </div>
                            <div class="col">
                            <div class="form-floating text-light mb-3">
                                    <select type="text" id="txt_usrol_disp_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                      <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>

                                      <?php foreach($booleanos as $valores) { ?>
                                            <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>"><?php echo $valores[0] ?></option>
                                      <?php } ?>

                                    </select>
                                    <label>Escritura</label>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

          <div class="text-center">
          <button type="button" id="funcion" value="agregaRol" onclick="agregarRol()" class="btn btn-outline-light">Aceptar</button>
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