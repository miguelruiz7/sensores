<?php
include('../backend/conexion.php');
error_reporting(0);

function codificarUTF8($cadena){
    $iso_string = mb_convert_encoding($cadena, "ISO-8859-1", "UTF-8");
    return  $iso_string;
}

// Datos para la gráfica
$valores = array();

$dispositivo = $_GET['disp'];
$fecha_inicio = $_GET['txtInicio'];
$fecha_final = $_GET['txtFinal'];

/*
$fecha_inicio = '2023-07-04 13:38:53';
$fecha_final = '2023-07-04 14:00:55';
*/

// Consulta SQL
$consulta = "SELECT DISTINCT dato_val, dato_tpo FROM dato_mst, disp_det, disp_mst, disp_tipo_mst, dum_mst  WHERE dato_disp_id = '$dispositivo' AND dato_tpo >= '$fecha_inicio' AND dato_tpo <= '$fecha_final' AND disp_id = disp_disp_id AND disp_tipo_id = disp_disp_tipo_id AND disp_dum_id = dum_id  GROUP BY dato_val ORDER BY dato_tpo ASC;";

$resultado = mysqli_query($conexion, $consulta);
$valores = array(); // Array para almacenar los valores obtenidos

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $valores[] = array((float)$fila['dato_val'], $fila['dato_tpo']);
    }

    $datos = $valores;

    $consulta = "SELECT * FROM disp_det, disp_mst, disp_tipo_mst, dum_mst WHERE disp_id_ = '$dispositivo' AND disp_id = disp_disp_id  AND disp_tipo_id = disp_disp_tipo_id AND disp_dum_id = dum_id";
    $resultado = mysqli_query($conexion, $consulta);
    $dato = mysqli_fetch_array($resultado);

    // Tamaño de la imagen
    $alto = 400; // Ajusta el valor para dejar más espacio vertical

    // Calcula la cantidad de datos obtenidos
    $numDatos = count($datos);

    // Calcula el ancho de la gráfica en función de la cantidad de datos
    $ancho = max(1200, $numDatos * 100);

    // Crear una nueva imagen con el tamaño especificado
    $imagen = imagecreate($ancho, $alto);

    // Definir colores
    $fondo = imagecolorallocate($imagen, 255, 255, 255); // Fondo blanco
    $linea = imagecolorallocate($imagen, 0, 0, 0); // Línea negra
    $linea_gris = imagecolorallocate($imagen, 212, 212, 212); // Línea gris
    $texto = imagecolorallocate($imagen, 0, 0, 0); // Texto negro

    // Obtener los valores mínimo y máximo
    $valorMin = min(array_column($datos, 0));
    $valorMax = max(array_column($datos, 0));

    // Dibujar ejes
    imageline($imagen, 50, $alto - 50, 50, 50, $linea); // Eje Y
    imageline($imagen, 50, $alto - 50, $ancho - 50, $alto - 50, $linea); // Eje X

    // Dibujar el eje Y
    $valorY = $valorMin;
    $pasoY = ($alto - 100) / 10; // Calcular el paso en píxeles

    for ($i = 0; $i <= 10; $i++) {
        $y = $alto - 50 - $i * $pasoY; // Calcular la posición en Y

        imageline($imagen, 45, $y, $ancho - 50, $y, $linea_gris); // Dibujar raya del eje Y
        imagestring($imagen, 2, 10, $y - 7, $valorY . codificarUTF8($dato['dum_sigl']), $texto); // Mostrar el valor del eje Y

        $valorY += ($valorMax - $valorMin) / 10; // Incrementar el valor del eje Y
    }

    // Dibujar puntos y líneas
    $anchoBarra = ($ancho - 100) / $numDatos; // Ancho de cada barra
    $x = 50 + $anchoBarra / 2; // Coordenada X inicial

    for ($i = 0; $i < $numDatos; $i++) {
        $alturaBarra = ($datos[$i][0] - $valorMin) / ($valorMax - $valorMin) * ($alto - 100); // Altura de la barra
        $y = $alto - 50 - $alturaBarra; // Coordenada Y

        imagefilledrectangle($imagen, $x - 2, $y - 2, $x + 2, $y + 2, $linea); // Dibujar punto
        if ($i > 0) {
            imageline($imagen, $x - $anchoBarra, $yAnterior, $x, $y, $linea); // Dibujar línea
        }

        // Mostrar el valor del punto
        $valor = $datos[$i][0] . codificarUTF8($dato['dum_sigl']);
        imagestring($imagen, 2, $x - 10, $y - 15, $valor, $texto);

        // Mostrar la hora en el eje X en posición vertical
        $hora = date('d/m H:i:s', strtotime($datos[$i][1]));
        for ($j = 0; $j < strlen($hora); $j++) {
            imagestringup($imagen, 2, $x - 5, $alto - 50 - ($j * 10), $hora[$j], $texto);
        }

        $x += $anchoBarra; // Incrementar la coordenada X
        $yAnterior = $y; // Almacenar la coordenada Y anterior
    }

    // Agregar título a la gráfica
    $titulo = codificarUTF8("Histórico del " . $dato['disp_tipo_nom'] . " " . $dato['disp_nom'] . " del $fecha_inicio al $fecha_final");
    $titulo_x = ($ancho - imagefontwidth(5) * strlen($titulo)) / 2; // Calcular posición X del título
    imagestring($imagen, 5, $titulo_x, 10, $titulo, $texto);

    // Enviar encabezados de imagen
    header('Content-type: image/png');

    // Mostrar la imagen en el navegador
    imagepng($imagen);

    // Liberar memoria
    imagedestroy($imagen);

} else {
    ?>
    <script>alert('No hay datos en este periodo')</script>
    <?php
}
?>
