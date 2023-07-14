<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            <div class="col">
            <div class="card w-auto shadow-sm" style="width: 18rem;">
            <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 g-3 m-3">
              <div class="col"><h5 class="card-title"><?php echo $datos['sec_nom']; ?></h5></div>
              <div class="col text-center"> <?php if($admin_sistema == 1 || $admin_plataforma == 1 || $funcionesRol['usrol_sec_esc'] == 1) { ?><button class="btn btn-outline-danger" onclick="eliminarSeccion(<?php echo $datos['sec_id']; ?>)"><?php echo $i_basura; ?></button>
              <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formulariomodal" aria-expanded="true" onclick="formModificarSec(<?php echo $datos['sec_id']; ?>)"><?php echo $i_modificar; ?></button></div> <?php } ?>
            
            </div>
  
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-1 g-3">
               <!--<div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_placa; ?><span class="badge bg-secondary">0</span></h6></button></div>
              <div class="col text-center"><button class="btn"><h6 class="card-subtitle mb-2 text-body-secondary"><?php echo $i_dispositivos; ?><span class="badge bg-secondary">0</span></h6></button></div>-->
              <div class="col text-center"><button class="btn p-2"><h6 class="card-subtitle  text-body-secondary" onclick="cargarProductosSeccion('<?php echo $datos['sec_id']; ?>')"><?php //echo $i_lista_prod; ?> Productos: <span class="badge bg-secondary"><?php echo conteoProductosSeccion($datos['sec_id'],$conexion); ?></span></h6></button></div>
            </div> 
            
            <!-- Un link colapsado -->
            <button class="btn d-inline-flex align-items-center rounded border-0 collapsed text-light" data-bs-toggle="collapse" data-bs-target="#variables" aria-expanded="true">
         <?php echo $i_variables; ?> Variables
        </button>
        <div class="collapse" id="variables">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="roles_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Roles de usuario</a></li>
            <li><a href="tipos_esp_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Tipos de espacios</a></li>
            <li><a href="dum_mst.php" class="link-light d-inline-flex text-decoration-none rounded"> <?php echo '(!)'; ?> Unidades de medida</a></li>
          </ul>
        </div>

            <div class="text-center">
            <!-- <button class="btn btn-outline-dark">Ver detalles</button> -->
            </div>
            </div>
            </div>
            </div>
            </div> 