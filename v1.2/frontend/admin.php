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
    case 'form_rol_agregar':
         $booleanos = array(['No', 0],['Si', 1]);
        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo rol</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
 </div>
<form id="<?php echo $formulario ?>">
  
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
          <button type="button" id="btn_form" onclick="desabilitaFormBtn(); func_rol_agregar(obtenerIdForm())" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;


        case 'form_rol_modificar':
          $booleanos = array(['No', 0],['Si', 1]);

          $usrol = $_POST['usrol'];

          $consulta="SELECT * FROM usrol_mst WHERE usrol_id = '$usrol'";
          $buscaDatos = mysqli_query($conexion,$consulta);

          if(mysqli_num_rows($buscaDatos)>0){

            $dato = mysqli_fetch_array($buscaDatos);

         ?>
  
  <div class="offcanvas-header m-3">
  <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar rol</h5>
    <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
  </div>
 <form id="<?php echo $formulario ?>">
   
           <div class="form-floating text-light mb-3">
             <input type="text" id="txt_usrol_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $dato['usrol_nom'];?>">
             <label>Nombre</label>
           </div>
 
 
           <div class="form-floating text-light mb-3">
             <textarea type="text" id="txt_usrol_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $dato['usrol_desc'];?></textarea>
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
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_gral_lec'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
                                      <?php } ?>

 
                                     </select>
                                     <label>Lectura</label>
                                 </div>
                             </div>
                             <div class="col">
                             <div class="form-floating text-light mb-3">
                                     <select type="text" id="txt_usrol_gral_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                       <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_gral_esc'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
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
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_esp_lec'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
                                      <?php } ?>
 
                                     </select>
                                     <label>Lectura</label>
                                 </div>
                             </div>
                             <div class="col">
                             <div class="form-floating text-light mb-3">
                                     <select type="text" id="txt_usrol_esp_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                       <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_esp_esc'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
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
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_sec_lec'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
                                      <?php } ?>
 
                                     </select>
                                     <label>Lectura</label>
                                 </div>
                             </div>
                             <div class="col">
                             <div class="form-floating text-light mb-3">
                                     <select type="text" id="txt_usrol_sec_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                       <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_sec_esc'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
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
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_prod_lec'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
                                      <?php } ?>
 
                                     </select>
                                     <label>Lectura</label>
                                 </div>
                             </div>
                             <div class="col">
                             <div class="form-floating text-light mb-3">
                                     <select type="text" id="txt_usrol_prod_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                       <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_prod_esc'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
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
 
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_disp_lec'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
                                      <?php } ?>
 
                                     </select>
                                     <label>Lectura</label>
                                 </div>
                             </div>
                             <div class="col">
                             <div class="form-floating text-light mb-3">
                                     <select type="text" id="txt_usrol_disp_esc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                                       <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" selected value=""></option>
 
                                       
                                       <?php foreach ($booleanos as $valores) {
                                          $selected = $dato['usrol_disp_esc'] == $valores[1];
                                        ?>
                                          <option class="bg-none" style="background-color:#042f52; filter: blur(5px);" value="<?php echo $valores[1] ?>" <?php echo $selected ? 'selected' : ''; ?>><?php echo $valores[0] ?></option>
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
           <button type="button" id="btn_form" onclick="desabilitaFormBtn(); func_rol_modificar(obtenerIdForm(),'<?php echo $usrol;?>')" class="btn btn-outline-light">Aceptar</button>
           </div> 
         </form>
  
         <?php
          }else{
            ?>
             <div class="position-relative p-5 text-center text-light">
                  <?php echo $i_advertencia ?>
                  <h1 class="text-body-emphasis">¿Qué estas haciendo?</h1>
                  <button type="button" class="btn btn-outline-light text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
              </div>
            <?php
          }
         break;



        case 'form_usr_admin':

          ?>
 
          <div class="offcanvas-header m-3">
          <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Seleccione el usuario</h5>
            <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
          </div>
         <form id="<?php echo $formulario ?>">
           
                   
       
         <div class="form-floating text-light mb-3">
                      <select id="txt_usr_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
                      <option value="" selected>No asignado</option> 
                              <?php
                              # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                                    $consulta="SELECT * FROM usr_mst WHERE usr_id NOT IN ('$sesion') AND usr_id NOT IN ('1')";
                                      $buscarolesEspacio= mysqli_query($conexion,$consulta);
                                          while($valores= mysqli_fetch_array($buscarolesEspacio)){
                                              ?>
                                              <option class="bg-none" value="<?php echo $valores['usr_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['usr_nom']; ?></option>
                                              <?php
                                          }       
                              ?>
                        </select>
                      <label>Nombre del usuario</label>
                    </div>
         
                   <div class="text-center">
                   <button type="button" id="btn_form" onclick="desabilitaFormBtn(); func_usr_admin(obtenerIdForm());" class="btn btn-outline-light">Aceptar</button>
                   </div> 
                 </form>
          
                 <?php

          break;


          case 'form_esp_tipo_agregar':
            ?>

            <div class="offcanvas-header m-3">
             <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un tipo de espacio</h5>
               <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
             </div>
            <form id="<?php echo $formulario ?>">
              
                      <div class="form-floating text-light mb-3">
                        <input type="text" id="txt_esp_tipo_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
                        <label>Nombre del tipo de espacio:</label>
                      </div>
            
            
                      <div class="form-floating text-light mb-3">
                        <textarea type="text" id="txt_esp_tipo_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
                        <label>Descripción breve</label>
                      </div>
            
            
                      <div class="text-center">
                      <button type="button"  id="btn_form" onclick="func_esp_tipo_agregar(obtenerIdForm())" class="btn btn-outline-light">Aceptar</button>
                      </div> 
                    </form>
             
                    <?php
                    break;

                    case 'form_esp_tipo_modificar':

                      $variable = $_POST['variable'];

                      $consulta="SELECT * FROM esp_tipo_mst WHERE esp_tipo_id = '$variable'";
                      $buscaDatos = mysqli_query($conexion,$consulta);

                      if(mysqli_num_rows($buscaDatos)>0){

                        $dato = mysqli_fetch_array($buscaDatos);


                      ?>
          
                      <div class="offcanvas-header m-3">
                       <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar un tipo de espacio</h5>
                         <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
                       </div>
                      <form id="<?php echo $formulario ?>">
                        
                                <div class="form-floating text-light mb-3">
                                  <input type="text" id="txt_esp_tipo_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $dato['esp_tipo_nom'];?>">
                                  <label>Nombre del tipo de espacio:</label>
                                </div>
                      
                      
                                <div class="form-floating text-light mb-3">
                                  <textarea type="text" id="txt_esp_tipo_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $dato['esp_tipo_desc'];?></textarea>
                                  <label>Descripción breve</label>
                                </div>
                      
                      
                                <div class="text-center">
                                <button type="button"  id="btn_form" onclick="func_esp_tipo_modificar(obtenerIdForm(),'<?php echo $variable ?>')" class="btn btn-outline-light">Aceptar</button>
                                </div> 
                              </form>
                       
                              <?php
                      }else{
                        ?>
                         <div class="position-relative p-5 text-center text-light">
            <?php echo $i_advertencia ?>
            <h1 class="text-body-emphasis">¿Qué estas haciendo?</h1>
            <button type="button" class="btn btn-outline-light text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario();">Cerrar</button>
          </div>
                        <?php
                      }
                              break;


        default:
        echo 'Error al comunicar con el sistema';
        break;


        
          }}else{
            echo "<script>alert('¿Qué estas haciendo?')</script>";
          }
?>