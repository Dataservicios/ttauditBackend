<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');
include("includes/configure.php");

$company_id=$_GET['company_id'];
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



//--------------------------------------------------------------------------

//-----------------------------------------------------------------------
//////////////////////////////////////////////////////////////////////////////
// tercer sheet para Premiación
//-----------------------------------------------------------------------
$objPHPExcel->createSheet(NULL, 0);
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Premiación');

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:R3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */

$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setAutoSize(true);




$cabecera = array(
	'ID',
	'CANAL',
	'MERCADO',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'TIPO DE BODEGA',
	'AUDITOR',
	'FECHA',
	'HORA',

    '¿ Se encuentra Abierto el punto ?',
    'Comentario',
    'FOTO',

	'¿ Cliente Aceptó Premio ?',
	'Comentario',
	'FOTO',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

	$contador_columna_cabecera++;
}




$campos = array(
	array('store_id', '0'),
	array('type', '0'),
	array('mercado', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('tipo_bodega', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('1_Respuesta', '0'),
    array('1_Comentario', '0'),
	array('1_Foto', '1'),

    array('2_Respuesta', '0'),
    array('2_Comentario', '0'),
    array('2_Foto', '1'),

);


//$query_detalle_premiados = "call sp_reporte_company_89_premiados";
$query_detalle_premiados = "call sp_alicorp_helena_premiados(".$company_id.")";
$resEmp = mysql_query($query_detalle_premiados, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
$contador_1 = 3;
/* Llenamos el detalle del reporte */
//$store_id = "";
$conatador_row = 3;
while ($rowEmp = mysql_fetch_assoc($resEmp)) {
	$contador_1 ++;
	$conatador_row ++ ;
	$contador_columna = 0;
	for ($row = 0; $row < count($campos) ; $row++) {
		$campo = $campos[$row][0];
		$tipo_campo = $campos[$row][1];



//		if($rowEmp['store_id'] != $store_id && $conatador_row != 4 ){
//			$objPHPExcel->setActiveSheetIndex(2)->getStyle('A'. $conatador_row .':P'. $conatador_row)->applyFromArray($style_3);
//		}

		if ($tipo_campo == "0") {
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		}
		//$store_id = $rowEmp['store_id'] ;
		$contador_columna++;
	}
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:R3'); //Auto Filter

//--------------------------------------------------------------------------
// Activando la primera hoja
$objPHPExcel->setActiveSheetIndex(0);



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
header('Content-Disposition: attachment;filename="Alicorp_Mayorista.xlsx"');
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