<?php 

//Creamos nuestra clase conexionDB
class conexionDB {
    //Convertimos nuestra conexionDB en variable pública
    public $conexion;
    public function prueba_sensores(){

		//Datos principales de la conexión
			$host = "localhost";    
			$basededatos = "sensores_bd"; 
			$usuariodb = "root";    
			$clavedb = ""; 
            
			$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);
		
			
      //Asignamos la conexion a conexion
      $this-> conexion = $conexion;

    }

    public function prueba_sensores_PDO(){

      //Datos principales de la conexión
        $host = "localhost";    
        $basededatos = "sensores_bd"; 
        $usuariodb = "root";    
        $clavedb = ""; 
            
        $conexionPDO = new PDO('mysql:host='.$host.';dbname='.$basededatos.'',''.$usuariodb.'',''.$clavedb.'');
        
        //Asignamos la conexion a conexion
        $this-> conexion = $conexionPDO;
  
      }
  }


$conecta = new conexionDB();
$conecta -> prueba_sensores();
$conexion = $conecta ->conexion;



$conecta = new conexionDB();
$conecta -> prueba_sensores_PDO();
$conexionPDO = $conecta ->conexion;

?>
