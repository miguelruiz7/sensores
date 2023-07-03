<?php
function insertarDatos($documento, $conexion){
   $datos = json_decode($documento);
   $id = $datos->id;
   $valores = $datos->valor;
   date_default_timezone_set('America/Mexico_City');
   $fecha_cap = date('Y-m-d H:i:s', time());
   
  

   $consulta = "SELECT disp_id_ FROM disp_det WHERE disp_id_ = '$id'";
   $checarDispositivos = mysqli_query($conexion, $consulta);

   if(mysqli_num_rows($checarDispositivos)>0){

   $consultaInsertar = "INSERT INTO dato_mst VALUES (NULL, '$valores','$fecha_cap', '$id')";

   $conecta = mysqli_query($conexion, $consultaInsertar);

   if($conecta){
    echo 'Los datos han sido transferidos a la base de datos (dispositivo: '.$id.', valor: '.$valores.', fecha_cap: '.$fecha_cap.')'. PHP_EOL;
   }else{
    echo 'Fallo'. PHP_EOL;
   }
   
   }else{
      echo 'Los datos no han sido transferidos a la base de datos (dispositivo: '.$id.', valor: '.$valores.', fecha_cap: '.$fecha_cap.')'. PHP_EOL;
   }

}