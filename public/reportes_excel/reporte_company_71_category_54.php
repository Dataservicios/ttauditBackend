<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
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
            'rgb' => 'F5FFFA'
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

$query_detalle_puntos = "call sp_reporte_company_71_category_54";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T2', 'Ventana Salsas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Z2','Ventana Pastas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AF2','Ventana Aceites');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AL2','Ventana Galletas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AR2','Ventana Refrescos');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AX2','Ventana Detergentes');



/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('T2:Y2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Z2:AE2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AF2:AK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AL2:AQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AR2:AW2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AX2:BC2');





/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('T2:BC2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:BE3')->applyFromArray($style_1);


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
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);

$cabecera = array(
    'ID',
    'CANAL',
    'COMERCIO',
    'DIRECCION',
    'DISTRITO',
    'REGION',
    'UBIGEO',
    'LATITUD',
    'LONGITUD',
    'TIPO DE BODEGA',
    'AUDITOR',
    'FECHA',
    'HORA',
    '¿Se encuentra Abierto? Si/No',
    'Opciones',
    'FOTO',
    '¿Cliente permitió tomar información?',
    'Opciones',
    'Comentario',


    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',

    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',

    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',

    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',

    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',

    '¿Existe Ventana?',
    '¿La Ventana es visible?',
    '¿Como se encuentra la Ventana?',
    '¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)',
    '%SOD',
    'Foto',


    '¿ Es cliente perfecto ?',
    '¿Desde cuando es cliente perfecto?',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
    $valor = $cabecera[$row];
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

    $contador_columna_cabecera++;
}




$campos = array(
    array('store_id', '0'),
    array('type', '0'),
    array('fullname', '0'),
    array('address', '0'),
    array('district', '0'),
    array('region', '0'),
    array('ubigeo', '0'),
    array('latitude', '0'),
    array('longitude', '0'),
    array('tipo_bodega', '0'),
    array('Auditor', '0'),
    array('fecha', '0'),
    array('hora', '0'),
    
    array('1136_Respuesta', '0'),
    array('1136_Opciones', '0'),
    array('1136_Foto', '1'),

    array('1137_Respuesta', '0'),
    array('1137_Opciones', '0'),
    array('1137_Comentario', '0'),
    
    array('1139_526_Respuesta', '0'),
    array('1140_526_Respuesta', '0'),
    array('1141_526_Respuesta', '0'),
    array('1138_526_Respuesta', '0'),
    array('526_sod', '0'),
    array('526_foto', '1'),

    array('1139_527_Respuesta', '0'),
    array('1140_527_Respuesta', '0'),
    array('1141_527_Respuesta', '0'),
    array('1138_527_Respuesta', '0'),
    array('527_sod', '0'),
    array('527_foto', '1'),

    array('1139_528_Respuesta', '0'),
    array('1140_528_Respuesta', '0'),
    array('1141_528_Respuesta', '0'),
    array('1138_528_Respuesta', '0'),
    array('528_sod', '0'),
    array('528_foto', '1'),

    array('1139_529_Respuesta', '0'),
    array('1140_529_Respuesta', '0'),
    array('1141_529_Respuesta', '0'),
    array('1138_529_Respuesta', '0'),
    array('529_sod', '0'),
    array('529_foto', '1'),

    array('1139_530_Respuesta', '0'),
    array('1140_530_Respuesta', '0'),
    array('1141_530_Respuesta', '0'),
    array('1138_530_Respuesta', '0'),
    array('530_sod', '0'),
    array('530_foto', '1'),

    array('1139_531_Respuesta', '0'),
    array('1140_531_Respuesta', '0'),
    array('1141_531_Respuesta', '0'),
    array('1138_531_Respuesta', '0'),
    array('531_sod', '0'),
    array('531_foto', '1'),

    array('1143_Respuesta', '0'),
    array('1144_Comentario', '0'),


);



$contador_1 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

    $contador_1 ++;
    $contador_columna = 0;
    for ($row = 0; $row < count($campos) ; $row++) {
        $campo = $campos[$row][0];
        $tipo_campo = $campos[$row][1];

        if ($tipo_campo == "0") {
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
        } else {
            if (utf8_encode($rowEmp[$campo] ) == null || $rowEmp[$campo]   == "") {
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
            } else {
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
            }
        }
        $contador_columna++;
    }
}


$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE1")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a client�s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="Alicorp_Bodegas_71_Category_54.xlsx"');
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