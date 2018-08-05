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

$query_detalle_puntos = "call sp_consulta_reporte_company_11";
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
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'LATITUD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'LONGITUD');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'AUDITOR');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'FECHA');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M3', 'HORA');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', 'DATOS DE COMERCIO');



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 2), utf8_encode(' �Se encuentra abierto el establecimiento? ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 3), utf8_encode('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , 3), utf8_encode('COMENTARIO') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , 3), utf8_encode('FOTO') );

/* APRONAX */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 2), utf8_encode('APRONAX') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), utf8_encode(' Dologyna ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), utf8_encode(' Iraxen ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), utf8_encode(' Sanaprox ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), utf8_encode(' Maxiflam Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), utf8_encode(' Dolocordralan Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), utf8_encode(' Doloflam Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), utf8_encode(' Naproxeno ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), utf8_encode(' Otros') );


/* ASPIRINA 100 */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 2), utf8_encode('ASPIRINA 100') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), utf8_encode('Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), utf8_encode(' Cor Asa ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), utf8_encode(' Cardiopress ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), utf8_encode(' Microass ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), utf8_encode(' Panadol') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), utf8_encode(' Panadol Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), utf8_encode(' Acido Acetilsalic�lico') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), utf8_encode(' Kitadol') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), utf8_encode(' Otros') );


/* REDOXON */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 2), utf8_encode('REDOXON') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), utf8_encode(' Mi vic C') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), utf8_encode(' Redoxin Tubo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), utf8_encode(' Efervit -C') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), utf8_encode(' Redo-C tubo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), utf8_encode(' Vitamina C Genfar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), utf8_encode(' Crevet ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), utf8_encode(' Cebion ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), utf8_encode(' Otros') );


/* BEROCCA */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 2), utf8_encode('BEROCCA') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), utf8_encode(' Biocord / Oramin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), utf8_encode(' Multidayli ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), utf8_encode(' Nutrastres ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), utf8_encode(' Energy Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), utf8_encode(' Ceregen chico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), utf8_encode(' Varimine Stress ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), utf8_encode(' Stress Formula � Mason') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), utf8_encode(' Calcio+Mag+Zn � Pharmatech') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), utf8_encode(' Otros') );


/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 2), utf8_encode('Exhibici�n') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), utf8_encode('La farmacia cuenta con exhibici�n?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), utf8_encode('Foto') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 2), utf8_encode('Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), utf8_encode('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), utf8_encode('Aspirina 500') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), utf8_encode('Supradyn') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), utf8_encode('Gynocanesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), utf8_encode('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), utf8_encode('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), utf8_encode('Berocca') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 2), utf8_encode('Si la respuesta es No, indicar cual de los 4 motivos') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), utf8_encode('Porque Bayer no paga por exhibici�n') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), utf8_encode('Porque Bayer no propone exhibiciones') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), utf8_encode('Porque la competencia paga exhibiciones en efectivo / Vales') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), utf8_encode('Otros') );

/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 2), utf8_encode('Premiaci�n') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), utf8_encode('Gan�') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 3), utf8_encode('Acept� Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , 3), utf8_encode('Ejecutivo') );


/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:AB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AC2:AN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AO2:AZ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BA2:BM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BN2:BP2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BQ2:BW2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BX2:CA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CB2:CD2');




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:CD2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:CE3')->applyFromArray($style_1);


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
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 , $contador_1), utf8_encode($rowEmp['latitude'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9 , $contador_1), utf8_encode($rowEmp['longitude'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10 , $contador_1), utf8_encode($rowEmp['Auditor'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 , $contador_1), utf8_encode($rowEmp['fecha'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 , $contador_1), utf8_encode($rowEmp['hora'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , $contador_1), utf8_encode($rowEmp['106_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , $contador_1), utf8_encode($rowEmp['106_Comentario'] ));

	if (utf8_encode($rowEmp['106_Foto']) == null || utf8_encode($rowEmp['106_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['106_Foto']) .'"  , "Foto" )' );
	}


	/* APRONAX */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), utf8_encode($rowEmp['108_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), utf8_encode($rowEmp['108_534_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , $contador_1), utf8_encode($rowEmp['110_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , $contador_1), utf8_encode($rowEmp['110_534_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), utf8_encode($rowEmp['109_534_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , $contador_1), utf8_encode($rowEmp['109_534_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), utf8_encode($rowEmp['109_534_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), utf8_encode($rowEmp['109_534_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , $contador_1), utf8_encode($rowEmp['109_534_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , $contador_1), utf8_encode($rowEmp['109_534_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), utf8_encode($rowEmp['109_534_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , $contador_1), utf8_encode($rowEmp['109_534_af'] ));


	
	/* ASPIRINA 100 */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), utf8_encode($rowEmp['108_538_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , $contador_1), utf8_encode($rowEmp['108_538_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , $contador_1), utf8_encode($rowEmp['110_538_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), utf8_encode($rowEmp['110_538_comentario'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , $contador_1), utf8_encode($rowEmp['109_538_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , $contador_1), utf8_encode($rowEmp['109_538_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , $contador_1), utf8_encode($rowEmp['109_538_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , $contador_1), utf8_encode($rowEmp['109_538_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), utf8_encode($rowEmp['109_538_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , $contador_1), utf8_encode($rowEmp['109_538_n'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , $contador_1), utf8_encode($rowEmp['109_538_ae'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , $contador_1), utf8_encode($rowEmp['109_538_af'] ));

	
	/* REDOXON */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , $contador_1), utf8_encode($rowEmp['108_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , $contador_1), utf8_encode($rowEmp['108_539_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , $contador_1), utf8_encode($rowEmp['110_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , $contador_1), utf8_encode($rowEmp['110_539_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , $contador_1), utf8_encode($rowEmp['109_539_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , $contador_1), utf8_encode($rowEmp['109_539_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , $contador_1), utf8_encode($rowEmp['109_539_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , $contador_1), utf8_encode($rowEmp['109_539_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , $contador_1), utf8_encode($rowEmp['109_539_s'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , $contador_1), utf8_encode($rowEmp['109_539_t'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , $contador_1), utf8_encode($rowEmp['109_539_u'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , $contador_1), utf8_encode($rowEmp['109_539_af'] ));



	
	/* BEROCCA */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , $contador_1), utf8_encode($rowEmp['108_540_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , $contador_1), utf8_encode($rowEmp['108_540_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , $contador_1), utf8_encode($rowEmp['110_540_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , $contador_1), utf8_encode($rowEmp['110_540_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , $contador_1), utf8_encode($rowEmp['109_540_w'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , $contador_1), utf8_encode($rowEmp['109_540_x'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , $contador_1), utf8_encode($rowEmp['109_540_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , $contador_1), utf8_encode($rowEmp['109_540_z'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , $contador_1), utf8_encode($rowEmp['109_540_aa'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , $contador_1), utf8_encode($rowEmp['109_540_ab'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , $contador_1), utf8_encode($rowEmp['109_540_ac'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , $contador_1), utf8_encode($rowEmp['109_540_ad'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , $contador_1), utf8_encode($rowEmp['109_540_af'] ));



	/* 	EXHIBICION  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , $contador_1), utf8_encode($rowEmp['107_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), utf8_encode($rowEmp['107_Comentario'] ));

	if (utf8_encode($rowEmp['107_Foto']) == null || utf8_encode($rowEmp['107_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['107_Foto']) .'"  , "Foto" )' );
	}



	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , $contador_1), utf8_encode($rowEmp['107_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , $contador_1), utf8_encode($rowEmp['107_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), utf8_encode($rowEmp['107_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , $contador_1), utf8_encode($rowEmp['107_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , $contador_1), utf8_encode($rowEmp['107_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , $contador_1), utf8_encode($rowEmp['107_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , $contador_1), utf8_encode($rowEmp['107_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , $contador_1), utf8_encode($rowEmp['107_h'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , $contador_1), utf8_encode($rowEmp['107_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , $contador_1), utf8_encode($rowEmp['107_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , $contador_1), utf8_encode($rowEmp['107_k'] ));

	/* 	PREMIACION  */

	 $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , $contador_1), utf8_encode($rowEmp['store_premiado'] ));
	 $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , $contador_1), utf8_encode($rowEmp['111_Respuesta'] ));

	 if (utf8_encode($rowEmp['Foto_premiado']) == null || utf8_encode($rowEmp['Foto_premiado']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
	}

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_11.xlsx"');
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