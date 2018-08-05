<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//ini_set('max_execution_time', 900);
//ini_set('memory_limit', '256M');
//set_time_limit(0);
date_default_timezone_set('America/Lima');
include("includes/configure.php");


if (PHP_SAPI == 'cli')
    die('This example should only be run from a Web Browser');

/** Include PHPExcel */

require_once dirname(__FILE__) . '/includes/Classes/PHPExcel.php';

$columna_inicial = 1;

//generar_hoja_excel(calcular_query_sino_sin_comment(27));


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$objWorksheet = $objPHPExcel->getActiveSheet();

// Negrita con Fondo Gris
$style =  array(
    'font'    => array(
        'size' => '11',
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000'
            )
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'argb' => '7A8B8B',
        )
    )
);

// Negrita con Fondo Verde y Letra Blanca

$style_1 =  array(
    'font'    => array(
        'size' => '9',
        'bold'      => true,
        'color'     => array(
            'argb' => 'F5FFFA'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000'
            )
        )
    ),
    'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
            'argb' => '00C957',
        )
    )
);

// Negrita con Letra Verde
$style_2 =  array(
    'font'    => array(
        'size' => '9',
        'bold'      => true,
        'color'     => array(
            'argb' => '00C957'
        )
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000'
            )
        )
    )
);

// Letra Normal
$style_3 =  array(
    'font'    => array(
        'size' => '9'
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000'
            )
        )
    )
);

// Negrita con Letra Negra
$style_4 =  array(
    'font'    => array(
        'size' => '9',
        'bold'      => true
    ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000'
            )
        )
    )
);

$objPHPExcel->createSheet(NULL, 1);

/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

//$query_detalle_puntos = "call sp_consulta_reporte_company_20_prueba";
$query_detalle_puntos = "SELECT 
  `stores`.`id`,
  `stores`.`fullname`,
  `stores`.`address`,
  `stores`.`district`,
  `stores`.`region`,
  `stores`.`ubigeo`,
  `stores`.`codclient`,
  `stores`.`latitude`,
  `stores`.`longitude`,
  `control_time`.`lat_close`,
  `control_time`.`long_close`,
  `control_time`.`lat_open`,
  `control_time`.`long_open`,
  `control_time`.`time_open`,
  `control_time`.`time_close`,
  `control_time`.`created_at`,
  `control_time`.`updated_at`
FROM
  `control_time`
  INNER JOIN `stores` ON (`control_time`.`store_id` = `stores`.`id`)
WHERE
  `control_time`.`company_id` = '".$_GET['company_id']."' AND 
  `control_time`.`user_id` = '".$_GET['user_id']."' AND 
  `stores`.`ubigeo` = '".$_GET['ubigeo']."'";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera ttaudit.com/reportes_excel/reporte_tracking_filter.php?company_id=51&user_id=247&ubigeo=JUNIN&auditor=Franco*/
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'Comercio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'Dirección');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'Distrito');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'Provincia');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'Departamento');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'Latitud');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'Longitud');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'Fecha/hora');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'Auditor');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'Fecha/Hora Inicio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'Latitud Inicio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M3', 'Longitud Inicio');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N3', 'Fecha/Hora Fin');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('O3', 'Latitud Fin');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P3', 'Longitud Fin');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q3', 'Demora (min.)');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B2', 'Nombre PDV');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C2', 'Dirección');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I2', 'Día de Visita');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K2', 'Datos Tracking');


/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('C2:H2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('I2:J2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('K2:Q2');


/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:Q2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:Q3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);

$contador_1 = 3;


/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

    $contador_1 ++;
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(0 , $contador_1), ($rowEmp['id'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), utf8_encode($rowEmp['fullname'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), utf8_encode($rowEmp['address']));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), utf8_encode($rowEmp['district'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4 , $contador_1), utf8_encode($rowEmp['region'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 , $contador_1), utf8_encode($rowEmp['ubigeo'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6, $contador_1), ($rowEmp['latitude'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7, $contador_1), ($rowEmp['longitude'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8, $contador_1), ($rowEmp['time_close'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9, $contador_1), utf8_encode($_GET['auditor'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10, $contador_1), ($rowEmp['time_open'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11, $contador_1), ($rowEmp['lat_open'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12, $contador_1), ($rowEmp['long_open'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), ($rowEmp['time_close'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), ($rowEmp['lat_close'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), ($rowEmp['long_close'] ));

    $segundos=strtotime($rowEmp['time_close']) - strtotime($rowEmp['time_open']);
    $diferencia_dias=intval($segundos/60);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16, $contador_1), ($diferencia_dias));


    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':Q'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('Resumen Rutas Auditor');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE IBK")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_RUTAS_AUDITOR.xlsx"');
header('Cache-Control: max-age=0');

// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


function coordinates($x,$y){
    return PHPExcel_Cell::stringFromColumnIndex($x).$y;
}
?>