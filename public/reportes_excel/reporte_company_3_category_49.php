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

$query_detalle_puntos = "call sp_reporte_company_3_category_49";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R2', utf8_encode('DEX'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2', utf8_encode('GALLETA MARGARITA CUBANITA 6PQT 6PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V2', utf8_encode('GALLETAS VICTORIA ZAS TORRE 36PQT'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y2', utf8_encode('GALL.VICTORIA CHOCOBUM 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2', utf8_encode('NUE.GALL.VICT.CASINO VAINILLA 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AE2', utf8_encode('NUE.GALL.VICT.CASINO MENTA 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AH2', utf8_encode('NUE.GALL.VICT.CASINO CHOCO.6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2', utf8_encode('NUE.GALL.VICT.CASINO FRESA 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AN2', utf8_encode('NU.GALL.VICT INTEGRAC.MIEL C/F 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AQ2', utf8_encode('NU.GALL.VICT.INTEGR.SALV.TRIGO 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AT2', utf8_encode('NUE.GALL.VICTORIA TENTACI.CHO.6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AW2', utf8_encode('NUE.GALL.VICTORIA TENTACI.NAR.6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AZ2', utf8_encode('NUE.GALL.VICTORIA TENTACI.COCO 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BC2', utf8_encode('NU.GALLETA VICTORIA SODA 6PQT 36PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BF2', utf8_encode('NUE.GALL.VICTORIA CHOMP NARAN.6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BI2', utf8_encode('GALL.VICTORIA GLACITAS FRE.32G 6PQT8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BL2', utf8_encode('GALL.VICTORIA GLACITAS TOFF.32G 6PQT8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BO2', utf8_encode('GALL.VICTORIA GLACI.CHO.NIE.32G 6PQT8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BR2', utf8_encode('N. GALL.SAYON MARGARITA BLANCA 6PQT 6PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BU2', utf8_encode('NUE.GALL.VICTORIA TENTACI.VAIN.6PQT 8PCK       '));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BX2', utf8_encode('GALL.VICTORIA INTEGRAC.QUINUA 9PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CA2', utf8_encode('GALL.VICTORIA GLACITAS CHOC.32G 6PQT8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CD2', utf8_encode('NUE.GALL.VICTORIA CHOMP CHOCO.6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CG2', utf8_encode('GALLETA VICTORIA WAZZU 6PQT 20PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CJ2', utf8_encode('NUE.GALL.VICT.CASINO ALFAJOR 6PQT 8PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CM2', utf8_encode('GALLETA SAYON SODA CRACK 10PQT 4PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CP2', utf8_encode('GALLETAS FIGURITAS DIA 55GR 3BOL 30PQT'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CS2', utf8_encode('N.GALL.SODA DIA 10PQT 10PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CV2', utf8_encode('NU. GALL.VAINILLA DIA 10PQT 10PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CY2', utf8_encode('GALLETA VAINILLA DIA 8PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DB2', utf8_encode('N.GALL.SODA DIA 8PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DE2', utf8_encode('DULCE RELLENA CHOCOLATE 8PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DH2', utf8_encode('DULCE RELLENA COCO 8PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DK2', utf8_encode('DULCE RELLENA FRESA 8PQT 5PCK'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DN2', utf8_encode('DULCE RELLENA VAINILLA 8PQT 5PCK'));



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
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BI2:BK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BL2:BN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BO2:BQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BR2:BT2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BU2:BW2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BX2:BZ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CA2:CC2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CD2:CF2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CG2:CI2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CJ2:CL2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CM2:CO2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CP2:CR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CS2:CU2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CV2:CX2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CY2:DA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DB2:DD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DE2:DG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DH2:DJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DK2:DM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DN2:DP2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('R2:DN2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:DN3')->applyFromArray($style_1);


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
	'¿Cliente permitió tomar información?',
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
	array('570_result_product', '0'),
	array('570_result_price', '0'),
	array('570_price', '0'),
	array('571_result_product', '0'),
	array('571_result_price', '0'),
	array('571_price', '0'),
	array('572_result_product', '0'),
	array('572_result_price', '0'),
	array('572_price', '0'),
	array('573_result_product', '0'),
	array('573_result_price', '0'),
	array('573_price', '0'),
	array('574_result_product', '0'),
	array('574_result_price', '0'),
	array('574_price', '0'),
	array('575_result_product', '0'),
	array('575_result_price', '0'),
	array('575_price', '0'),
	array('576_result_product', '0'),
	array('576_result_price', '0'),
	array('576_price', '0'),
	array('577_result_product', '0'),
	array('577_result_price', '0'),
	array('577_price', '0'),
	array('578_result_product', '0'),
	array('578_result_price', '0'),
	array('578_price', '0'),
	array('579_result_product', '0'),
	array('579_result_price', '0'),
	array('579_price', '0'),
	array('580_result_product', '0'),
	array('580_result_price', '0'),
	array('580_price', '0'),
	array('581_result_product', '0'),
	array('581_result_price', '0'),
	array('581_price', '0'),
	array('582_result_product', '0'),
	array('582_result_price', '0'),
	array('582_price', '0'),
	array('583_result_product', '0'),
	array('583_result_price', '0'),
	array('583_price', '0'),
	array('584_result_product', '0'),
	array('584_result_price', '0'),
	array('584_price', '0'),
	array('585_result_product', '0'),
	array('585_result_price', '0'),
	array('585_price', '0'),
	array('586_result_product', '0'),
	array('586_result_price', '0'),
	array('586_price', '0'),
	array('587_result_product', '0'),
	array('587_result_price', '0'),
	array('587_price', '0'),
	array('588_result_product', '0'),
	array('588_result_price', '0'),
	array('588_price', '0'),
	array('589_result_product', '0'),
	array('589_result_price', '0'),
	array('589_price', '0'),
	array('590_result_product', '0'),
	array('590_result_price', '0'),
	array('590_price', '0'),
	array('591_result_product', '0'),
	array('591_result_price', '0'),
	array('591_price', '0'),
	array('592_result_product', '0'),
	array('592_result_price', '0'),
	array('592_price', '0'),
	array('593_result_product', '0'),
	array('593_result_price', '0'),
	array('593_price', '0'),
	array('594_result_product', '0'),
	array('594_result_price', '0'),
	array('594_price', '0'),
	array('595_result_product', '0'),
	array('595_result_price', '0'),
	array('595_price', '0'),
	array('596_result_product', '0'),
	array('596_result_price', '0'),
	array('596_price', '0'),
	array('597_result_product', '0'),
	array('597_result_price', '0'),
	array('597_price', '0'),
	array('598_result_product', '0'),
	array('598_result_price', '0'),
	array('598_price', '0'),
	array('599_result_product', '0'),
	array('599_result_price', '0'),
	array('599_price', '0'),
	array('600_result_product', '0'),
	array('600_result_price', '0'),
	array('600_price', '0'),
	array('601_result_product', '0'),
	array('601_result_price', '0'),
	array('601_price', '0'),
	array('602_result_product', '0'),
	array('602_result_price', '0'),
	array('602_price', '0'),
	array('603_result_product', '0'),
	array('603_result_price', '0'),
	array('603_price', '0')

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


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_3_Category_49.xlsx"');
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