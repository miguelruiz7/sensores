<?php
function conteoUsuarios($id,$conexion){
    $consulta = "SELECT COUNT(esp_usr_id) as usuarios FROM esp_det WHERE esp_esp_id = $id;";
    $conteoUsuarios = mysqli_query($conexion, $consulta);
    
    if(mysqli_num_rows($conteoUsuarios)>0){
        $dato = mysqli_fetch_array($conteoUsuarios);
    }

    $conteo = $dato['usuarios'];

    return $conteo;
}