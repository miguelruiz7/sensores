<?php
// Cargar la librería PhpSpreadsheet
require '../backend/phpspreadsheet/src/';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Datos de ejemplo
$datos = array(
    array('Nombre', 'Edad', 'Ciudad'),
    array('Juan', 25, 'Madrid'),
    array('María', 30, 'Barcelona'),
    array('Pedro', 28, 'Valencia')
);

// Crear un nuevo objeto Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Iterar sobre los datos y escribirlos en el archivo Excel
$row = 1;
foreach ($datos as $fila) {
    $col = 1;
    foreach ($fila as $valor) {
        $sheet->setCellValueByColumnAndRow($col, $row, $valor);
        $col++;
    }
    $row++;
}

// Establecer el nombre del archivo
$nombreArchivo = 'datos_excel.xlsx';

// Guardar el archivo Excel
$writer = new Xlsx($spreadsheet);
$writer->save($nombreArchivo);

// Enlace para descargar el archivo
echo "Exportación exitosa. Puedes descargar el archivo <a href='$nombreArchivo'>aquí</a>.";
?>
