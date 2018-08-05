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
			'rgb' => '0A5478',
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

/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

$query_detalle_puntos = "call sp_reporte_company_54";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2' ,'Datos Punto Auditado');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O2' ,'Esta Abierto el local?');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S2' ,'Permitio actualizar POS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V2' ,'Foto Voucher de inicio');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('W2' ,'Fotos sticker de POS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('X2' ,'Ingresar modelos de POS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y2' ,'Ingresar numeros de terminales');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Z2' ,'Foto Interior comercio');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA2' ,'Foto de voucher final');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB2' ,'Foto de constancia de instalación');

/* Une las Celdas para la cabecera0*/

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:N2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('O2:R2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S2:U2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(0)->getStyle('A2:AB2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:AB3')->applyFromArray($style_1);


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
$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);

$cabecera = array(
	'ID',
	'COMERCIO',
	'DIRECCION ACTUAL',
	'DIRECCION ANTERIOR',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'CONTACTO ACTUAL',
	'CONTACTO ANTERIOR',
	'AUDITOR',
	'FECHA',
	'HORA',

	'Respuesta',
	'Opciones',
	'Texto_Otros',
	'FOTO',
	
	'Permitio actualizar POS',
	'Opciones',
	'Texto_Otros',

	'FOTO',

	'FOTO',

	'MODELOS',

	'TERMINALES',

	'FOTO',

	'FOTO',

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
	array('fullname', '0'),
	array('address', '0'),
	array('address1', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('owner', '0'),
	array('contact1', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('771_Respuesta', '0'),
	array('771_Opciones', '0'),
	array('771_c_otro', '0'),
	array('771_Foto', '1'),

	array('772_Respuesta', '0'),
	array('772_Opciones', '0'),
	array('772_b_otro', '0'),

	array('773_Foto', '1'),

	array('775_Foto', '1'),

	array('776_Comentario', '0'),

	array('777_Comentario', '0'),

	array('778_Foto', '1'),

	array('779_Foto', '1'),

	array('780_Foto', '1'),
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
		}

	$contador_columna++;
	}	
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:AB3'); //Auto Filter
$objPHPExcel->getActiveSheet()->setTitle('Resumen');




//-----------------------------------------------------------------------
//////////////////////////////////////////////////////////////////////////////
// Segunda sheet para galeria de fotos
//-----------------------------------------------------------------------
$objPHPExcel->createSheet(NULL, 1);
$objPHPExcel->setActiveSheetIndex(1)->setTitle('Fotos de POS');

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:O3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */

$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('L')->setAutoSize(true);




$cabecera = array(
	'ID',
	'COMERCIO',
	'DIRECCION ACTUAL',
	'DIRECCION ANTERIOR',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'CONTACTO ACTUAL',
	'CONTACTO ANTERIOR',
	'AUDITOR',
	'FECHA',
	'HORA',
	'FOTO',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

	$contador_columna_cabecera++;
}




$campos = array(
	array('store_id', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('address1', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('owner', '0'),
	array('contact1', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),
	array('foto', '1'),

);

//mysql_free_result ($resEmp);
//mysql_close($conexion_db);
//$conexion_db = mysql_connect("localhost", "root", "irmagaguevara");
//mysql_select_db("ttaudit_auditors", $conexion_db);
error_reporting(E_ALL ^ E_DEPRECATED);
mysql_close($conexion_db);
$conexion_db = mysql_connect("104.197.133.79", "root", "Fbrsjgfc09");
mysql_select_db("ttaudit_auditors", $conexion_db);

$query_detalle_puntos = "call sp_reporte_company_54_galery";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
$contador_1 = 3;
/* Llenamos el detalle del reporte */
$store_id = "";
$conatador_row = 3;
while ($rowEmp = mysql_fetch_assoc($resEmp)) {
	$contador_1 ++;
	$conatador_row ++ ;
	$contador_columna = 0;
	for ($row = 0; $row < count($campos) ; $row++) {
		$campo = $campos[$row][0];
		$tipo_campo = $campos[$row][1];



		if($rowEmp['store_id'] != $store_id && $conatador_row != 4 ){
			$objPHPExcel->setActiveSheetIndex(1)->getStyle('A'. $conatador_row .':O'. $conatador_row)->applyFromArray($style_3);
		}

		if ($tipo_campo == "0") {
			$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		}
		$store_id = $rowEmp['store_id'] ;
		$contador_columna++;
	}
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:O3'); //Auto Filter


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
header('Content-Disposition: attachment;filename="Kasnet_54_Estudio1.xlsx"');
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