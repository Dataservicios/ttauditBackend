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

$query_detalle_puntos = "call sp_consulta_reporte_company_30";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('O2', utf8_encode('Recomendaci�n APRONAX'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y2', utf8_encode('Recomendaci�n ASPIRINA FORTE'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AI2', utf8_encode('Recomendaci�n REDOXON'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AS2', utf8_encode('Recomendaci�n BEPANTHEN CREMA X 30 '));

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('O2:X2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Y2:AH2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AI2:AR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AS2:AV2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('O2:AV2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:AV3')->applyFromArray($style_1);


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

$cabecera = array(
	'REP',
	'ID',
	'CANAL',
	'RUC',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'AUDITOR',
	'FECHA',
	'HORA',
	'Bayer - Apronax',
	'Apronax',
	'Dologyna',
	'Iraxen',
	'Sanaprox',
	'Maxiflam Forte',
	'Dolocordralan Extra Fuerte',
	'Doloflam Extra Fuerte',
	'Naproxeno',
	'Otros',
	'Bayer - Aspirina Forte',
	'Dolofac',
	'Mifralivio x 100',
	'Migrapac x 30',
	'Panadol',
	'Panadol Forte',
	'Kitadol',
	'Acido Acetilsalicilico',
	'Aspirina Forte',
	'Otros',
	'Bayer - Redoxon',
	'Redoxon',
	'Mi vic',
	'Redoxin Tobo',
	'Efervit -C',
	'Redo-C',
	'Vitamina C Genfar',
	'Crevet',
	'Cebion',
	'Otros',
	'Bayer - BEPANTHEN CREMA X 30 ',
	'Bepanthen',
	'Mucovit',
	'Otros'
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), utf8_encode($valor ));
		
	$contador_columna_cabecera++;
}	



	
$campos = array(
	array('ejecutivo','0') ,
	array('store_id','0') ,
	array('type','0') ,
	array('cadenaRuc','0') ,
	array('fullname','0') ,
	array('address','0') ,
	array('district','0') ,
	array('region','0') ,
	array('ubigeo','0') ,
	array('latitude','0') ,
	array('longitude','0') ,
	array('Auditor','0') ,
	array('fecha','0') ,
	array('hora','0') ,
	array('Apronax','3') ,
	array('435_534_a','0') ,
	array('435_534_b','0') ,
	array('435_534_c','0') ,
	array('435_534_d','0') ,
	array('435_534_e','0') ,
	array('435_534_f','0') ,
	array('435_534_g','0') ,
	array('435_534_h','0') ,
	array('435_534_ab','0') ,
	array('Aspirina Forte','3') ,
	array('435_644_k','0') ,
	array('435_644_l','0') ,
	array('435_644_m','0') ,
	array('435_644_n','0') ,
	array('435_644_o','0') ,
	array('435_644_p','0') ,
	array('435_644_q','0') ,
	array('435_644_r','0') ,
	array('435_644_ab','0') ,
	array('Bayer - Redoxon','3') ,
	array('435_539_s','0') ,
	array('435_539_t','0') ,
	array('435_539_u','0') ,
	array('435_539_w','0') ,
	array('435_539_x','0') ,
	array('435_539_y','0') ,
	array('435_539_z','0') ,
	array('435_539_aa','0') ,
	array('435_539_ab','0') ,
	array('BEPANTHEN CREMA X 30 ','3') ,
	array('435_640_i','0') ,
	array('435_640_j','0') ,
	array('435_640_ab','0') 

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
			$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), $rowEmp[$campo] );
		} else {
			if ($tipo_campo == "3") {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), $campo);
			}else{
				if (utf8_encode($rowEmp[$campo] ) == null || utf8_encode($rowEmp[$campo]  ) == "") {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
				} else {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. $rowEmp[$campo] .'"  , "Foto" )' );
				}
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
header('Content-Disposition: attachment;filename=" Reporte Bayer Fase 2 Primera Quincena Julio.xlsx"');
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