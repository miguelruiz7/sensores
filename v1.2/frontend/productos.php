<?php
#Dependencias
include('../backend/conexion.php');
include('iconos.php');
include('../backend/funciones.php');


#Funciones
sesion_usr();
$sesion=sesion_usr();


$espacio = comprobarSeccion();
$seccion = comprobarProductos();

$admin_sistema = administradorSistema($sesion, $conexion);
$funcionesRol = rolPlataforma($sesion, $espacio, $conexion);



#Seleciona el formulario


if(isset($_POST['formulario'])){
$formulario = $_POST['formulario'];
switch($formulario){
        case 'agregarProducto':

          $producto = $_SESSION['sec_id'];


            
       


          #Agrega una sección al espacio (NO FUNCIONA)
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear un nuevo producto</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
 </div>
<form id="agregarProducto">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_prod_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Nombre del producto</label>
          </div>

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_prod_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="agregarProducto" onclick="agregarProducto('<?php echo $producto; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <?php
        break;



        case 'modificarProducto':

          $producto = $_POST['producto'];

             #Consultamos la información primordial acerca de la placa
             $consulta = "SELECT * FROM prod_mst WHERE prod_id='$producto'";
             $buscaProducto = mysqli_query($conexion, $consulta);
   
             if(mysqli_num_rows($buscaProducto)>0){
               $datosProducto = mysqli_fetch_array($buscaProducto);
             }


        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar producto</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close"data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
 </div>
<form id="modificarProducto">
  
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_prod_nom" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput" value="<?php echo $datosProducto['prod_nom']?>">
            <label>Nombre del producto</label>
          </div>

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_prod_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $datosProducto['prod_desc']?></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="modificarProducto" onclick="modificarProducto('<?php echo $producto; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <?php
        break;



        case 'placasProducto':
          #En lista a los usuarios que existen en los espacios
          ?>
      <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Placas</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
 </div>
          <?php
           #Consultamos la informacion de los usuarios que se encuentran en el espacio
          $id = $_POST['producto']; 
          $consulta = "SELECT *, pl_det.pl_desc AS descripcion_gral FROM pl_det, pl_mst WHERE pl_prod_id = '$id' AND  pl_id = pl_pl_id";
          $buscaPlacas = mysqli_query($conexion, $consulta);


        

          if($admin_sistema == 1 || $funcionesRol['usrol_disp_lec'] == 1) {

          if(mysqli_num_rows($buscaPlacas)>0){
            ?>
            <div class="container m-2 text-center"> 
           <button class="btn btn-outline-light" onclick="revertirFormulario(); formAgregarPlaca('<?php echo $id;?>');">
           <?php echo $i_agregar; ?> Agregar placa
           </button>
          </div>

         

             <div class="table-responsive">
              <table class="table text-light">
                <thead>
                  <tr>
                  <th scope="col">Id de placa</th>
                    <th scope="col">Nombre de la placa</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Direccion IP</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
            <?php

             

           while($datosPlaca = mysqli_fetch_array($buscaPlacas)){

            ?>
             <tr>
                <th scope="row"><?php echo $datosPlaca['pl_id_'];?></th>
                <td><?php echo $datosPlaca['pl_nom'];?></td>
                <td><?php echo $datosPlaca['descripcion_gral'];?></td>
                <td><?php echo $datosPlaca['pl_ip'];?></td>
                <td><button class="btn btn-outline-light" onclick="revertirFormulario(); formModificarPlaca('<?php echo $datosPlaca['pl_id_']?>');"><?php echo $i_modificar; ?></button>
                    <button class="btn btn-outline-light" onclick="eliminarPlaca('<?php echo $datosPlaca['pl_id_']?>','<?php echo $datosPlaca['pl_prod_id']?>');"><?php echo $i_basura; ?></button></td>
              </tr>
           <?php

           }
          }else{
            ?>

            <div class="position-relative p-5 text-center text-light">
            <?php echo $i_advertencia ?>
            <h1 class="text-body-emphasis">No hay ninguna placa</h1>
            <p class="col-lg-6 mx-auto mb-4">
              Sin embargo puedes crearlos desde aquí
            </p>
            <button class="btn btn-outline-light px-5 mb-5" type="button"  onclick="revertirFormulario(); formAgregarPlaca('<?php echo $id;?>');"> 
              Crear placa
            </button>
          </div>
        
        
        <?php
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

        case 'agregarPlaca':

          $producto = $_POST['producto'];

          #Agrega una sección al espacio (NO FUNCIONA)
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Crear una placa</h5>
   <button type="button" class="btn text-light" onclick="revertirFormulario(); formPlacas('<?php echo $producto; ?>');">Volver a placas</button>
 </div>
<form id="agregarPlaca">
  
          <div class="form-floating text-light mb-3">
            <select type="text" id="txt_pl_pl_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
              <option value=""></option>
              <?php
                           $consulta="SELECT * FROM pl_mst";
                            $buscaCatPlacas= mysqli_query($conexion,$consulta);
                                while($valores= mysqli_fetch_array($buscaCatPlacas)){
                                    ?>
                                    <option class="bg-none" value="<?php echo $valores['pl_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['pl_nom']; ?></option>
                                    <?php
                                } 
                                
                    ?>
              </select>
            <label>Seleccione una placa</label>
          </div>

          <div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_pl_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"></textarea>
            <label>Descripción breve</label>
          </div>

          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_pl_ip" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <label>Dirección IP</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="agregarPlaca" onclick="agregarPlaca('<?php echo $producto; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <?php
        break;


        case 'modificarPlaca':

          $placa = $_POST['placa'];

          
          #Consultamos la información primordial acerca de la placa
          $consulta = "SELECT * FROM pl_det, prod_mst WHERE pl_id_='$placa' AND pl_prod_id = prod_id";
          $buscaPlaca = mysqli_query($conexion, $consulta);

          if(mysqli_num_rows($buscaPlaca)>0){
            $datosPlaca = mysqli_fetch_array($buscaPlaca);
          }

          #Agrega una sección al espacio (NO FUNCIONA)
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar una placa</h5>
   <button type="button" class="btn text-light" onclick="revertirFormulario(); formPlacas('<?php echo $datosPlaca['pl_prod_id']; ?>');">Volver a placas</button>
 </div>
<form id="modificarPlaca">


<div class="form-floating text-light mb-3">
            <textarea type="text" id="txt_pl_desc" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"><?php echo $datosPlaca['pl_desc']; ?></textarea>
            <label>Descripción breve</label>
          </div>

  
        
          <div class="form-floating text-light mb-3">
            <input type="text" id="txt_pl_ip" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput"  value="<?php echo $datosPlaca['pl_ip']; ?>">
            <label>Dirección IP</label>
          </div>

          <div class="form-floating text-light mb-3">
            <select type="text" id="txt_pl_prod_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <option value="<?php echo $datosPlaca['pl_prod_id']; ?>" selected><?php echo $datosPlaca['prod_nom']; ?></option> 
           
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                       $producto = $datosPlaca['pl_prod_id'];
                             $consulta="SELECT * FROM prod_mst WHERE prod_sec_id = '$seccion' AND prod_id NOT IN ('$producto')";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['prod_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['prod_nom']; ?></option>
                                      <?php
                                  }           
                      ?>
                 </select>
            <label>Selecciona el producto:</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="modificarPlaca" onclick="modificarPlaca('<?php echo $placa; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <?php
        break;


        case 'dispositivosProducto':
          #En lista a los usuarios que existen en los espacios
          ?>
      <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Dispositivos</h5>
   <button type="button" class="btn text-light"  data-bs-dismiss="modal" aria-label="Close" data-bs-dismiss="modal" aria-label="Close" onclick="revertirFormulario()">Cerrar</button>
 </div>
          <?php
           #Consultamos la informacion de los usuarios que se encuentran en el espacio
          $id = $_POST['producto']; 




            #CORREGIR ESTA CLAVE DE CONSULTA QUERY
            
          $consulta = "SELECT * FROM disp_mst, disp_det, pl_mst, pl_det, disp_tipo_mst WHERE pl_prod_id = '$id' AND disp_disp_id = disp_id AND disp_tipo_id = disp_disp_tipo_id  AND  disp_pl_id = pl_id_ AND  pl_pl_id = pl_id";
          $buscaPlacas = mysqli_query($conexion, $consulta);


          if($admin_sistema == 1 || $funcionesRol['usrol_disp_lec'] == 1) {

          if(mysqli_num_rows($buscaPlacas)>0){
            ?>
            <div class="container m-2 text-center"> 
           <button class="btn btn-outline-light" onclick="revertirFormulario(); formAgregarDispositivos('<?php echo $id ?>'); ">
           <?php echo $i_agregar; ?> Agregar dispositivo
           </button>
          </div>

         

             <div class="table-responsive">
              <table class="table text-light">
                <thead>
                  <tr>
                  <th scope="col">Id de dispositivo</th>
                    <th scope="col">Nombre del dispositivo</th>
                    <th scope="col">Tipo de dispositivo</th>
                    <th scope="col">Placa</th>
                  <!--  <th scope="col">Puertos</th> -->
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody>
            <?php

             

           while($datosPlaca = mysqli_fetch_array($buscaPlacas)){

            ?>
             <tr>
                <th scope="row"><?php echo $datosPlaca['disp_id_'];?></th>
                <td><?php echo $datosPlaca['disp_nom'];?></td>
                <td><?php echo $datosPlaca['disp_tipo_nom'];?></td>
                <td><?php echo $datosPlaca['pl_nom']." (".$datosPlaca['pl_id_'].")";?></td>
               <!-- <td><?php echo detectapuertoDisp($datosPlaca['disp_id'],$conexion);?></td> -->
                <td><button class="btn btn-outline-light" onclick="formModificarDispositivos('<?php echo $datosPlaca['disp_id_'];?>','<?php echo $id;?>')" ><?php echo $i_modificar; ?></button>
                    <button class="btn btn-outline-light" onclick="eliminarDispositivo('<?php echo $datosPlaca['disp_id_'];?>','<?php echo $id;?>')" ><?php echo $i_basura; ?></button></td>
              </tr>
           <?php

           }
          }else{
            ?>

            <div class="position-relative p-5 text-center text-light">
            <?php echo $i_advertencia ?>
            <h1 class="text-body-emphasis">No hay ningun dispositivo</h1>
            <p class="col-lg-6 mx-auto mb-4">
              Sin embargo puedes crearlos desde aquí
            </p>
            <button class="btn btn-outline-light px-5 mb-5" type="button"  onclick="revertirFormulario(); formAgregarDispositivos('<?php echo $id ?>'); "> 
              Crear dispositivo
            </button>
          </div>
        
        
        <?php
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


        case 'agregarDispositivo':

          $producto = $_POST['producto'];

          #Agrega una sección al espacio (NO FUNCIONA)
        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Agregar un dispositivo</h5>
   <button type="button" class="btn text-light" onclick="revertirFormulario(); formDispositivos('<?php echo $producto; ?>');">Volver a dispositivos</button>
 </div>
<form id="agregarDispositivo">
  
          <div class="form-floating text-light mb-3">
            <select type="text" id="txt_disp_disp_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <option value="" selected></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                     
                             $consulta="SELECT * FROM disp_mst";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['disp_id'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['disp_nom']; ?> (<?php echo $valores['disp_desc_gral']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                 </select>
            <label>Dispositivo</label>
          </div>


          <div class="form-floating text-light mb-3">
            <select type="text" id="txt_disp_pl_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <option value="" selected></option> 
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                     
                             $consulta="SELECT * FROM pl_mst, pl_det WHERE pl_prod_id = '$producto' AND pl_id = pl_pl_id";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['pl_id_'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['pl_nom']; ?> (<?php echo $valores['pl_id_']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                 </select>
            <label>Selecciona la placa:</label>
          </div>
                                  

          <div class="text-center">
          <button type="button" id="funcion" value="agregarDispositivo" onclick="agregarDispositivo('<?php echo $producto; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <script>

  // Obtener el campo de texto
 
  /*

  // Escuchar el evento 'keyup' para detectar cambios mientras se escribe en el campo de texto
  document.getElementById('txt_disp_pto').addEventListener('keyup', function() {
    const texto = document.getElementById('txt_disp_pto').value; // Obtener el valor del campo de texto
    const textoSeparado = texto.replace(/\s+/g, ','); // Reemplazar todos los espacios por comas

    document.getElementById('txt_disp_pto').value = textoSeparado; // Asignar el nuevo valor al campo de texto
  });
  */
</script>



        <?php
        break;

        case 'modificarDispositivo':

          $dispositivo = $_POST['dispositivo'];
          $producto = $_POST['producto'];

          #Agrega una sección al espacio (NO FUNCIONA)

          $consulta = "SELECT * FROM disp_det WHERE disp_id_ = '$dispositivo'";
          $buscaDispositivo = mysqli_query($conexion, $consulta);
          if(mysqli_num_rows($buscaDispositivo)>0){
            $datos = mysqli_fetch_array($buscaDispositivo);
          }


        ?>
         <div class="offcanvas-header m-3">
 <h5 class="offcanvas-title text-light" id="offcanvasExampleLabel">Modificar un dispositivo</h5>
   <button type="button" class="btn text-light" onclick="revertirFormulario(); formDispositivos('<?php echo $producto; ?>');">Volver a dispositivos</button>
 </div>
<form id="modificarDispositivo">
  
          <div class="form-floating text-light mb-3">
            <select type="text" id="txt_disp_pl_id" class="form-control border-bottom border-0 border-bottom-2 border-light bg-transparent rounded-0 text-white" id="floatingInput">
            <option value="" selected></option> 
            <optgroup label="Placas de este producto: " style="background-color:#042f52; filter: blur(5px);">
          
                      <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                           $placa = $datos['disp_pl_id'];
                           echo $placa;
                             $consulta="SELECT * FROM pl_mst, pl_det WHERE pl_prod_id = '$producto' AND pl_id_ NOT IN ('$placa') AND pl_id = pl_pl_id";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['pl_id_'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['pl_nom']; ?> (<?php echo $valores['pl_id_']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                        </optgroup>
                        <optgroup label="Placas de otros productos: " style="background-color:#042f52; filter: blur(5px);">
                        <?php
                      # Queda pendiente realizar el código mientras que no evaluen el diagrama de entidad relación
                     
                             $consulta="SELECT * FROM pl_mst, pl_det, prod_mst WHERE pl_prod_id NOT IN  ('$producto') AND pl_id = pl_pl_id AND prod_id = pl_prod_id";
                              $buscatiposUnidad= mysqli_query($conexion,$consulta);
                                  while($valores= mysqli_fetch_array($buscatiposUnidad)){
                                      ?>
                                      <option class="bg-none" value="<?php echo $valores['pl_id_'];?>" style="background-color:#042f52; filter: blur(5px);"><?php echo $valores['pl_nom']; ?> (<?php echo $valores['pl_id_']; ?>), (<?php echo $valores['prod_nom']; ?>)</option>
                                      <?php
                                  }           
                      ?>
                      
                      </optgroup>
                 </select>
            <label>Selecciona la placa:</label>
          </div>

          <div class="text-center">
          <button type="button" id="funcion" value="modificarDispositivo" onclick="modificarDispositivo('<?php echo $dispositivo; ?>','<?php echo $producto; ?>')" class="btn btn-outline-light">Aceptar</button>
          </div> 
        </form>
        <script>
/*
  // Obtener el campo de texto
 

  // Escuchar el evento 'keyup' para detectar cambios mientras se escribe en el campo de texto
  document.getElementById('txt_disp_pto').addEventListener('keyup', function() {
    const texto = document.getElementById('txt_disp_pto').value; // Obtener el valor del campo de texto
    const textoSeparado = texto.replace(/\s+/g, ','); // Reemplazar todos los espacios por comas

    document.getElementById('txt_disp_pto').value = textoSeparado; // Asignar el nuevo valor al campo de texto
  });
  */
</script>



        <?php
        break;

        default:
        echo 'Error al comunicar con el sistema';
        break;


        
          }}else{
            echo "<script>alert('¿Qué estas haciendo?')</script>";
          }
?>