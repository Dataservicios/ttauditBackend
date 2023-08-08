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
			'rgb' => 'FF0000',
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

$query_detalle_puntos = "call sp_consulta_reporte_company_61";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */




$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L2' ,'¿Se encuentra Abierto? Si/No');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('P2' ,'Permitio levantar Visbilidad?');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2' ,'Tiene corpóreo?');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U2' ,'En que estado se encuentra corpóreo?');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V2' ,'En que mal estado esta corpóreo');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('X2' ,'Por que no tiene corporeo');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Z2' ,'Por que no tiene Corporeo por deterioro');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2' ,'Tiene Bidonera');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AD2' ,'Si tiene bidonera en que estado se encuentra');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AE2','Si tiene bidonera por que esta en Mal estado');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AG2','Por que no tiene bidonera');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AI2','Si no tienen bidonera por que deterioro');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2','EN GENERAL, ¿QUÉ LE PARECIÓ LOS CORPÓREOS DE ASPIRINA FORTE O APRONAX? ');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AL2','EN GENERAL, ¿QUÉ LE PARECIÓ LAS BIDONERAS DE REDOXON, ASPIRINA FORTE O APRONAX? ');





/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:O2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('P2:R2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('S2:T2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('V2:W2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('X2:Y2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Z2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AC2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AE2:AF2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AG2:AH2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AI2:AJ2');




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('L2:AL2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:AL3')->applyFromArray($style_1);


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
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);




$cabecera = array(
	'ID',
	'CANAL',
	'RUC',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'AUDITOR',
	'FECHA',
	'HORA',

	'Respuesta',
	'Opciones',
	'Comentario',
	'FOTO',

	'Respuesta',
	'Opciones',
	'Comentario',

	'Respuesta',
	'FOTO',

	'Opciones',

	'Opciones',
	'Comentario',

	'Opciones',
	'Comentario',

	'Opciones',
	'Comentario',

	'Respuesta',
	'FOTO',

	'Opciones',

	'Opciones',
	'Comentario',

	'Opciones',
	'Comentario',

	'Opciones',
	'Comentario',

	'Opciones',

	'Opciones',

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
	array('cadenaRuc', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('854_Respuesta', '0'),
	array('854_Opciones', '0'),
	array('854_Comentario', '0'),
	array('854_Foto', '1'),

	array('855_Respuesta', '0'),
	array('855_Opciones', '0'),
	array('855_Comentario', '0'),

	array('857_Respuesta', '0'),
	array('857_Foto', '1'),

	array('858_Opciones', '0'),

	array('859_Opciones', '0'),
	array('859_Comentario', '0'),

	array('860_Opciones', '0'),
	array('860_Comentario', '0'),

	array('861_Opciones', '0'),
	array('861_Comentario', '0'),

	array('862_Respuesta', '0'),
	array('862_Foto', '1'),

	array('863_Opciones', '0'),

	array('864_Opciones', '0'),
	array('864_Comentario', '0'),

	array('865_Opciones', '0'),
	array('865_Comentario', '0'),

	array('866_Opciones', '0'),
	array('866_Comentario', '0'),

	array('867_Opciones', '0'),

	array('868_Opciones', '0'),


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
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		}

	$contador_columna++;
	}	
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:AJ3'); //Auto Filter

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
header('Content-Disposition: attachment;filename="Bayer_visibilidad_61.xlsx"');
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