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

$query_detalle_puntos = "call sp_reporte_company_3_category_51";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R2', utf8_encode('DEX'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2', utf8_encode('N.FID.ESPIGA DE ORO SPAGHE.500G20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V2', utf8_encode('NU. FID.NICOLINI SPAGHETTI �500GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y2', utf8_encode('NU.FID.DON VITTORIO SPAG.500GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2', utf8_encode('NU.FID.DON VITTORIO LING.GR.500GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AE2', utf8_encode('NU.FID.DON VITTORIO CANU.RAY.250GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AH2', utf8_encode('NU.FID.DON VITTORIO COD.RAY.250G 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2', utf8_encode('NU.FID.DON VITTORIO CAB.ANG.250GR 40BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AN2', utf8_encode('FID.LAVAGGI SPAGHETTI 500GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AQ2', utf8_encode('FID.LAVAGGI CODO RAYA.F.PLUS 250GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AT2', utf8_encode('FID.LAVAGGI TALLARIN 500GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AW2', utf8_encode('FID.ALIANZA SPAGHETTI 500G 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AZ2', utf8_encode('NU. FID.NICOLINI CODO CHICO 250GR 20BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BC2', utf8_encode('FID.LAVAGGI CABELLO ANGEL 250GR 40BOL'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BF2', utf8_encode('FID.ALIANZA CODO RAYADO 250G 20BOL'));



/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('S2:U2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('V2:X2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Y2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AE2:AG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AH2:AJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AK2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:AP2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AQ2:AS2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AT2:AV2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AW2:AY2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AZ2:BB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BC2:BE2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BF2:BH2');




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('R2:BH2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:BH3')->applyFromArray($style_1);


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
	'Se encuentra Abierto? Si/No',
	'Comentario',
	'FOTO',
	'�Cliente permiti� tomar informaci�n?',
	'Nombre DEX',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado',
	'Se encontro',
	'Precio OK',
	'Precio Encontrado'
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), utf8_encode($valor ));
		
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
	array('148_Respuesta', '0'),
	array('148_Comentario', '0'),
	array('148_Foto', '1'),
	array('150_Respuesta', '0'),
	array('149_Comentario', '0'),
	array('611_result_product', '0'),
	array('611_result_price', '0'),
	array('611_price', '0'),
	array('612_result_product', '0'),
	array('612_result_price', '0'),
	array('612_price', '0'),
	array('613_result_product', '0'),
	array('613_result_price', '0'),
	array('613_price', '0'),
	array('614_result_product', '0'),
	array('614_result_price', '0'),
	array('614_price', '0'),
	array('615_result_product', '0'),
	array('615_result_price', '0'),
	array('615_price', '0'),
	array('616_result_product', '0'),
	array('616_result_price', '0'),
	array('616_price', '0'),
	array('617_result_product', '0'),
	array('617_result_price', '0'),
	array('617_price', '0'),
	array('618_result_product', '0'),
	array('618_result_price', '0'),
	array('618_price', '0'),
	array('619_result_product', '0'),
	array('619_result_price', '0'),
	array('619_price', '0'),
	array('620_result_product', '0'),
	array('620_result_price', '0'),
	array('620_price', '0'),
	array('621_result_product', '0'),
	array('621_result_price', '0'),
	array('621_price', '0'),
	array('622_result_product', '0'),
	array('622_result_price', '0'),
	array('622_price', '0'),
	array('623_result_product', '0'),
	array('623_result_price', '0'),
	array('623_price', '0'),
	array('624_result_product', '0'),
	array('624_result_price', '0'),
	array('624_price', '0')

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
			 $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo] ));
		} else {
			if (utf8_encode($rowEmp[$campo] ) == null || utf8_encode($rowEmp[$campo]  ) == "") {
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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_3_Category_51.xlsx"');
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