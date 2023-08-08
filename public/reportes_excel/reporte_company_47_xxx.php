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
			'rgb' => 'FFC000',
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

$objPHPExcel->createSheet(NULL, 0);
//$objPHPExcel->createSheet(NULL, 1);


/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

$query_detalle_puntos = "call sp_reporte_company_47";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N2' ,'Cliente compro bloqueador?');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q2' ,'Al cliente se le dejó volante');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S2' ,'Al cliente se le pegó material POP');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('N2' ,'Cliente vende Bloqueador en Sachet?');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Q2' ,'Precio de venta del bloqueador');



/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('N2:P2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q2:R2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S2:T2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('P2:Q2');
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R2:S2');



/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(0)->getStyle('N2:T2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:T3')->applyFromArray($style_1);

$objPHPExcel->setActiveSheetIndex(1)->getStyle('M2:Q2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:Q3')->applyFromArray($style_1);
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
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('K')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('L')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('M')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('N')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('O')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('P')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('Q')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('R')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('S')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(0)->getColumnDimension('T')->setWidth(20);


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
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('K')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('L')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('M')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('N')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('O')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('P')->setWidth(20);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('Q')->setWidth(20);



$cabecera = array(
	'ID',
	'COD. DISTRIBUIDOR',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'VENDEDOR',
	'AUDITOR',
	'FECHA',
	'HORA',

	'Respuesta',
	'Opciones',
	'Comentario',

	'Respuesta',
	'FOTO',

	'Respuesta',
	'FOTO',


);
$cabecera2 = array(
	'ID',
	'COD. DISTRIBUIDOR',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'VENDEDOR',
	'AUDITOR',
	'FECHA',
	'HORA',

	'Respuesta',
	'Opciones',
	'Comentario',

	'Respuesta',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

	$contador_columna_cabecera++;
}

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera2) ; $row++) {
	$valor = $cabecera2[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

	$contador_columna_cabecera++;
}

$campos = array(
	array('store_id', '0'),
	array('distributor', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('ejecutivo', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('627_Respuesta', '0'),
	array('627_Opciones', '0'),
	array('627_Comentario', '0'),

	array('628_Respuesta', '0'),
	array('628_Foto', '1'),

	array('629_Respuesta', '0'),
	array('629_Foto', '1'),

);

$campos2 = array(


	array('store_id', '0'),
	array('distributor', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('ejecutivo', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('630_Respuesta', '0'),
	array('630_Opciones', '0'),
	array('630_Comentario', '0'),

	array('631_Comentario', '0'),



);

$contador_1 = 3;
$contador_2 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {


	$contador_columna = 0;
	$contador_columna2 = 0;
	if ($rowEmp["627_Respuesta"] == null || $rowEmp["627_Respuesta"]   == "") {
		$contador_2 ++;
		for ($row = 0; $row < count($campos2) ; $row++) {
			$campo2 = $campos2[$row][0];
			$tipo_campo2 = $campos2[$row][1];
			if ($tipo_campo2 == "0") {

				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna2 , $contador_2), utf8_encode($rowEmp[$campo2]) );

			}

			$contador_columna2++;
		}
	} else{
		$contador_1 ++;
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





}

//$objPHPExcel->getActiveSheet()->setAutoFilter('A3:P3'); //Auto Filter
//$objPHPExcel->getActiveSheet()->setTitle('Nuevas Tiendas');

$objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('A3:S3'); //Auto Filter

$objPHPExcel->setActiveSheetIndex(0)->setTitle('Promotor Palmera');

$objPHPExcel->setActiveSheetIndex(1)->setAutoFilter('A3:P3'); //Auto Filter
$objPHPExcel->setActiveSheetIndex(1)->setTitle('Auditores TTAudit');

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
header('Content-Disposition: attachment;filename="Palmera_47.xlsx"');
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