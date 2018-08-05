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

$query_detalle_puntos = "call sp_consulta_reporte_company_9";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ID');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'CANAL');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'RUC');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'COMERCIO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'DIRECCION');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'DISTRITO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'REGION');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'UBIGEO');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'AUDITOR');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'FECHA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'HORA');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', 'DATOS DE COMERCIO');



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 , 2), utf8_encode('1. ¿Se encuentra abierto el establecimiento? (id = 67)') );
//$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 2), utf8_encode('3. Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí? (id = 73)') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 , 3), utf8_encode('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 , 3), utf8_encode('COMENTARIO') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 3), utf8_encode('FOTO') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , 2), utf8_encode('APRONAX') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , 3), utf8_encode('RECOMIENDA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , 3), utf8_encode('STOCK') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), utf8_encode('EXHIBICION') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), utf8_encode('FOTO') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 2), utf8_encode('GINOCANESTEN') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), utf8_encode('RECOMIENDA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), utf8_encode('EXHIBICION') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), utf8_encode('FOTO') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 2), utf8_encode('ASPIRINA') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), utf8_encode('RECOMIENDA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), utf8_encode('EXHIBICION') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), utf8_encode('FOTO') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 2), utf8_encode('SUPRADYN') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), utf8_encode('RECOMIENDA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), utf8_encode('EXHIBICION') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), utf8_encode('FOTO') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 2), utf8_encode('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), utf8_encode('PREMIADO') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), utf8_encode('FOTO') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 2), utf8_encode('¿Recibió Premio?') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), utf8_encode('RESPUESTA') );




/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:K2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:N2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('O2:R2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('S2:U2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('V2:X2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Y2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AC2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AD2:AD2');



/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:AD2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:AD3')->applyFromArray($style_1);


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




$contador_1 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

	$contador_1 ++;

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(0 , $contador_1), utf8_encode($rowEmp['store_id'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), utf8_encode($rowEmp['type'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), utf8_encode($rowEmp['cadenaRuc'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), utf8_encode($rowEmp['fullname'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4 , $contador_1), utf8_encode($rowEmp['address'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 , $contador_1), utf8_encode($rowEmp['district'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 , $contador_1), utf8_encode($rowEmp['region'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7 , $contador_1), utf8_encode($rowEmp['ubigeo'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 , $contador_1), utf8_encode($rowEmp['Auditor'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9 , $contador_1), utf8_encode($rowEmp['fecha'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10 , $contador_1), utf8_encode($rowEmp['hora'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 , $contador_1), utf8_encode($rowEmp['103_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 , $contador_1), utf8_encode($rowEmp['103_Comentario'] ));

	if (utf8_encode($rowEmp['103_Foto']) == null || utf8_encode($rowEmp['103_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['103_Foto']) .'"  , "Foto" )' );
	}


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , $contador_1), utf8_encode($rowEmp['71_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , $contador_1), utf8_encode($rowEmp['104_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), utf8_encode($rowEmp['72_534_Respuesta'] ));

	if (utf8_encode($rowEmp['72_534_Foto']) == null || utf8_encode($rowEmp['72_534_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['72_534_Foto']) .'"  , "Foto" )' );
	}


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , $contador_1), utf8_encode($rowEmp['71_537_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , $contador_1), utf8_encode($rowEmp['72_537_Respuesta'] ));

	if (utf8_encode($rowEmp['72_537_Foto']) == null || utf8_encode($rowEmp['72_537_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['72_537_Foto']) .'"  , "Foto" )' );
	}


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , $contador_1), utf8_encode($rowEmp['71_535_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), utf8_encode($rowEmp['72_535_Respuesta'] ));

	if (utf8_encode($rowEmp['72_535_Foto']) == null || utf8_encode($rowEmp['72_535_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['72_535_Foto']) .'"  , "Foto" )' );
	}


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , $contador_1), utf8_encode($rowEmp['71_536_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , $contador_1), utf8_encode($rowEmp['72_536_Respuesta'] ));

	if (utf8_encode($rowEmp['72_536_Foto']) == null || utf8_encode($rowEmp['72_536_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['72_536_Foto']) .'"  , "Foto" )' );
	}

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , $contador_1), utf8_encode($rowEmp['store_premiado'] ));

	if (utf8_encode($rowEmp['Foto_premiado']) == null || utf8_encode($rowEmp['Foto_premiado']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
	}


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , $contador_1), utf8_encode($rowEmp['105_Respuesta'] ));




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


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_9.xlsx"');
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