<?php
function conteoUsuarios($id,$conexion){
    $consulta = "SELECT COUNT(aeu_usr_id) as usuarios FROM `aeu_mst` WHERE aeu_esp_id = $id;";
    $conteoUsuarios = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($conteoUsuarios)>0){
        $dato = mysqli_fetch_array($conteoUsuarios);
    }

    $conteo = $dato['usuarios'];

    return $conteo;
}