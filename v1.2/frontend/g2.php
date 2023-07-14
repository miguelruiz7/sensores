<?php
include('../backend/conexion.php');
error_reporting(0);

// Datos para la gráfica
$valores = array();


$dispositivo = $_GET['disp'];
$fecha_inicio = $_GET['txtInicio'];
$fecha_final = $_GET['txtFinal'];


// Consulta SQL
$consulta = "SELECT DISTINCT dato_val, dato_tpo FROM dato_mst, disp_det, disp_mst, disp_tipo_mst, dum_mst  WHERE dato_disp_id = '$dispositivo' AND dato_tpo >= '$fecha_inicio' AND dato_tpo <= '$fecha_final' AND disp_id = disp_disp_id AND disp_tipo_id = disp_disp_tipo_id AND disp_dum_id = dum_id  GROUP BY dato_val ORDER BY dato_tpo ASC;";

$resultado = mysqli_query($conexion, $consulta);
$valores = array(); // Array para almacenar los valores obtenidos

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $valores[] = array((float)$fila['dato_val'], $fila['dato_tpo']);
    }
}

$datos = $valores;


$consulta = "SELECT * FROM disp_det, disp_mst, disp_tipo_mst, dum_mst WHERE disp_id_ = '$dispositivo' AND disp_id = disp_disp_id  AND disp_tipo_id = disp_disp_tipo_id AND disp_dum_id = dum_id";
$resultado = mysqli_query($conexion, $consulta);
$dato = mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Gráfica Lineal con Chart.js</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
   <center> <canvas id="myChart" width="1000" height="600"></canvas> </center>

    <script>
        // Datos para la gráfica
        var datos = <?php echo json_encode($datos); ?>;

        // Obtener las etiquetas del eje X y los datos del eje Y
        var labels = datos.map(function(dato) {
            var fecha = new Date(dato[1]);
            var dia = fecha.getDay().toString().padStart(2, '0');
            var mes = fecha.getMonth().toString().padStart(2, '0');
            var anio = fecha.getFullYear().toString().padStart(2, '0');
            var hora = fecha.getHours().toString().padStart(2, '0');
            var minutos = fecha.getMinutes().toString().padStart(2, '0');
            var segundos = fecha.getSeconds().toString().padStart(2, '0');
            return dia +'/' + mes +'/' + anio +' '+ +hora + ':' + minutos + ':' + segundos;
        });
        var datosY = datos.map(function(dato) {
            return dato[0];
        });

        // Obtener referencia al elemento canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Crear la gráfica lineal
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '<?php echo $dato['disp_nom'] ?>',
                    data: datosY,
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1,
                    pointRadius: 2,
                    pointBackgroundColor: 'rgba(0, 123, 255, 1)',
                    pointBorderColor: 'rgba(0, 123, 255, 1)',
                    pointHoverRadius: 6,
                    pointHoverBackgroundColor: 'rgba(0, 123, 255, 1)',
                    pointHoverBorderColor: 'rgba(0, 123, 255, 1)'
                }]
            },
            options: {
                responsive: false,
                scales: {
                    x: {
                title: {
                    display: true,
                    text: 'TIEMPO'
                }
            },
                    y: {
                        title: {
                        display: true,
                         text: '<?php echo $dato['dum_sigl']; ?>'},
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
