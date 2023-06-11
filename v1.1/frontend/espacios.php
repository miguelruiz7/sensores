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
    case 'agregar':
        ?>
 
 <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo espacio</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="reseteaFormularios('agregarEspacio');  revertirFormulario();">Cerrar</button>
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
          <button type="button" id="funcion" value="agregaEspacio" onclick="agregarEspacio()" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
 
        <?php
        break;


        case 'modificarEspacio':
          #Modifica el espacio

          #Almacenamos los valores que halla traido el formulario
          $id = $_POST['id']; 

          #Consultamos la información primordial acerca del espacio
          $consulta = "SELECT * FROM esp_mst, espt_mst WHERE esp_id='$id' AND esp_espt_id = espt_id";
          $buscaEspacio = mysqli_query($conexion, $consulta);

          if(mysqli_num_rows($buscaEspacio)>0){
            $datosEspacio = mysqli_fetch_array($buscaEspacio);
          }
          ?>
        
   
   <div class="offcanvas-header m-3">
   <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modifica el espacio</h5>
     <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
   </div>
  <form id="modificaEspacio">
    
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_esp_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datosEspacio['esp_nom']; ?>">
              <label>Nombre del espacio</label>
            </div>
  
  
            <div class="form-floating text-light mb-3">
              <select id="txt_esp_espt_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="<?php echo $datosEspacio['espt_id'];?>" selected><?php echo $datosEspacio['espt_nom'];?></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                           $id_tipo_esp = $datosEspacio['esp_espt_id'];
                             $consulta="SELECT * FROM espt_mst WHERE espt_id NOT IN ('$id_tipo_esp')";
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
              <textarea type="text" id="txt_esp_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" ><?php echo $datosEspacio['esp_desc']; ?></textarea>
              <label>Descripción breve</label>
            </div>
  
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_esp_area" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" pattern="[0-9]+([\.,][0-9]+)?" value="<?php echo $datosEspacio['esp_area']; ?>">
              <label>Area del espacio</label>
            </div>
  
            <div class="form-floating text-light mb-3">
              <input type="text" id="txt_esp_geo" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datosEspacio['esp_geo']; ?>">
              <label>Ubicación geográfica</label>
            </div>
  
            <div class="text-center">
            <button type="button" id="funcion" value="modificarEspacio" onclick="modificarEspacio(<?php echo $id ?>);" class="btn btn-outline-light">Aceptar</button>
            </div> 
          </form>
   
          <?php
          break;

        case 'agregarSeccion':
          #Agrega una sección al espacio (NO FUNCIONA)
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


        case 'verUsuarios':
          #En lista a los usuarios que existen en los espacios
          ?>
      <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Usuarios</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
 </div>
          <?php
           #Consultamos la informacion de los usuarios que se encuentran en el espacio
          $id = $_POST['id']; 
          $consulta = "SELECT * FROM esp_mst, esp_det, usr_mst, usrol_mst WHERE esp_esp_id = '$id'  AND esp_usr_id = usr_id  AND esp_id = esp_esp_id  AND esp_usrol_id = usrol_id   ORDER BY usrol_id ASC;";
          $buscaUsuarios = mysqli_query($conexion, $consulta);


          $detRol = detectarRolUsuarioEspacio($id, $sesion, $conexion);

          if($detRol == 2) {

          if(mysqli_num_rows($buscaUsuarios)>0){
            ?>
            <div class="container m-2 text-center"> 
              <a href="usuarios_mst.php"><button class="btn btn-outline-light" onclick="revertirFormulario(); nuevoUsuario();">
           <?php echo $i_enlace; ?> Administrar usuarios
           </button></a>
           <button class="btn btn-outline-light" onclick="revertirFormulario();">
           <?php echo $i_agregar; ?> Asignar un usuario al espacio
           </button>
          </div>

         

             <div class="table-responsive">
              <table class="table text-light">
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
                <th scope="row"><?php if($datosUsuarios['usr_id'] == $sesion){ echo $datosUsuarios['usr_nom']." (Tú)";}else{echo $datosUsuarios['usr_nom'];}?></th>
                <td><?php echo $datosUsuarios['usrol_nom'];?> <?php if($datosUsuarios['esp_crea'] == $datosUsuarios['usr_id'] ){echo '(Creador)';}?></td>
                <td><?php echo $datosUsuarios['usr_usu'];?></td>
                <td><?php if($datosUsuarios['usr_id'] != $sesion){ if($datosUsuarios['usr_defadmin'] != 1){?><button class="btn btn-outline-light" onclick="revertirFormulario(); formModificaUsr('<?php echo $datosUsuarios['esp_usr_id']?>','<?php echo $datosUsuarios['esp_esp_id']?>');"><?php echo $i_modificar; ?></button>
                    <button class="btn btn-outline-light" onclick="eliminarUsuario('<?php echo $datosUsuarios['esp_id_']?>');"><?php echo $i_basura; ?></button>
                    <button class="btn btn-outline-light" onclick="contrasenaUsr();"><?php echo $i_llave; ?></button><?php } } ?></td>
              </tr>
           <?php

           }
          }
        }else{
          ?>

            <div class="position-relative p-5 text-center text-light">
            <?php echo $i_advertencia ?>
            <h1 class="text-body-emphasis">No tienes permisos</h1>
            <p class="col-lg-6 mx-auto mb-4">
              No tienes los suficientes privilegios para acceder a la siguiente información
            </p>
          </div>
        
        
        <?php
        }

           ?>
                </tbody>
              </table>    
        </div>
           <?php
       
        break;


        case 'modificarUsuario':
          $id = $_POST['usuario']; 
          $espacio = $_POST['espacio'];
          $consulta = "SELECT * FROM usr_mst, usrol_mst, esp_det WHERE usr_id='$id' AND esp_esp_id = '$espacio' AND usr_id = esp_usr_id  AND usrol_id = esp_usrol_id";
          $buscaUsuario = mysqli_query($conexion, $consulta);

          if(mysqli_num_rows($buscaUsuario)>0){

            $datosUsuario = mysqli_fetch_array($buscaUsuario);

          }

        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar usuario</h5>
   <button type="button" class="btn text-light"  onclick="revertirFormulario(); formUsuariosEsp(<?php echo $espacio; ?>)">Atras</button>
 </div>
<form id="modificaUsuario">
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_usr_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datosUsuario['usr_nom'];?>">
            <label>Nombre</label>
          </div>
          
          <div class="form-floating text-light mb-3">
              <select id="txt_esp_usrol_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" >
              <option value="<?php echo $datosUsuario['esp_usrol_id'];?>" selected><?php echo $datosUsuario['usrol_nom'].' ('.$datosUsuario['usrol_desc'].')'; ?></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                           $id_tipo_rol = $datosUsuario['esp_usrol_id'];
                             $consulta="SELECT * FROM usrol_mst WHERE usrol_id NOT IN ('$id_tipo_rol') AND usrol_id NOT IN ('1')";
                              $buscarolesEspacio= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscarolesEspacio)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['usrol_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['usrol_nom'].' ('.$valores['usrol_desc'].')'; ?></option>
                                      <?php
                                  }       
                      ?>
                 </select>
              <label>Modifica el rol</label>
            </div>


          <div class="text-center">
          <button type="button" id="funcion" value="modificarUsuario" onclick="modificarUsuario('<?php echo $id;?>','<?php echo $espacio;?>')" class="btn btn-outline-light">Aceptar</button>
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