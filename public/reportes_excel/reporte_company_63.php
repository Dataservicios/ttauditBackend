<?php
error_reporting(E_ALL);
ini_set('max_execution_time', 900);
ini_set('memory_limit', '2048M');
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
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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
			//'rgb' => 'FF0000'
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
			'rgb' => '5EB423',
		)
	)
);

// Negrita con Letra Verde
$style_2 =  array(
	'font'    => array(
		'size' => '9',
		'bold'      => true,
		'color'     => array(
			'argb' => 'FE000B'
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

// SOLO BORDE TOP
$style_3 =  array(

	'borders' => array(
		'top' => array(
			'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
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

$objPHPExcel->createSheet(NULL, 0);

/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

$query_detalle_puntos = "call sp_reporte_company_63";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P2' ,'Preguntas Generales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X2' ,'Presencia de Productos');



/* Une las Celdas para la cabecera0*/

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('P2:W2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('X2:AI2');






/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(0)->getStyle('P2:AI2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:AO3')->applyFromArray($style_1);


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
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);



$cabecera = array(
	'ID',
	'CODIGO CLIENTE',
	'DISTRIBUIDOR',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'CODIGO VENDEDOR',
    'NOMBRE VENDEDOR',
	'AUDITOR',
	'FECHA',
	'HORA',

	'¿Se encuentra Abierto? Si/No',
	'Opciones',
	'Texto Otros',
	'FOTO',

	'Cliente es "CLIENTE PERFECTO"',
	'Cliente es "CLIENTE PERFECTO" DE LAVANDERIA',
	'Cliente permitio trabajar gondola',
	'Foto gondola',

	'Ariel (cualquier presentación)',
	'Bolivar (cualquier presentación)',
	'Ace (cualquier presentación)',
	'Opal (cualquier presentación)',
	'Sapalio (cualquier presentación)',
	'Marsella (cualquier presentación)',
	'Suavizante Bolivar (sachets)',
	'Suavizante Bolivar (frascos)',
	'Downy (sachets)',
	'Downy (frascos)',
	'Suavitel (sachets)',
	'Suavitel (frascos)',

	'Cliente Compró por categoría',
	'CATEGORÍA SUAVIZANTES.',
	'CATEGORÍA DETERGENTES',
	'CATEGORÍA QUITAMANCHAS',
	'CATEGORÍA JABÓN DE LAVAR',
    'RUBRO',
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);
		
	$contador_columna_cabecera++;
}	




$campos = array(
	array('store_id', '0'),
	array('codclient', '0'),
	array('distributor', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('880_Comentario', '0'),
	array('ejecutivo', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('879_Respuesta', '0'),
	array('879_Opciones', '0'),
	array('879_otro', '0'),
	array('879_Foto', '1'),


	array('883_Respuesta', '0'),
	array('884_Respuesta', '0'),
	array('901_Respuesta', '0'),
	array('901_Foto', '1'),

	array('885_a', '0'),
	array('885_b', '0'),
	array('885_c', '0'),
	array('885_d', '0'),
	array('885_e', '0'),
	array('885_f', '0'),
	array('885_g', '0'),
	array('885_h', '0'),
	array('885_i', '0'),
	array('885_j', '0'),
	array('885_k', '0'),
	array('885_l', '0'),

    array('961_Respuesta', '0'),
    array('961_a', '0'),
    array('961_b', '0'),
    array('961_c', '0'),
    array('961_d', '0'),

    array('rubro', '0'),
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
			 $objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		} else if ($tipo_campo == "2") {
			if($rowEmp['832_59_Respuesta']){
				if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
				} else {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Ver Galeria" )' );
				}
			}

			if($rowEmp['832_60_Respuesta']){
				if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
				} else {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Ver Galeria" )' );
				}
			}

			if($rowEmp['832_61_Respuesta']){
				if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
				} else {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Ver Galeria" )' );
				}
			}

			if($rowEmp['832_62_Respuesta']){
				if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
				} else {
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Ver Galeria" )' );
				}
			}


		}

	$contador_columna++;
	}	
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:AO3'); //Auto Filter
$objPHPExcel->getActiveSheet()->setTitle('Resumen');


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
header('Content-Disposition: attachment;filename="Alicorp_Promotorias_63.xlsx"');
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