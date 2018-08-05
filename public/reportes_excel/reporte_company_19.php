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

$query_detalle_puntos = "call sp_consulta_reporte_company_19";
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
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M3', 'HORA');//13

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', 'DATOS DE COMERCIO');



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 2), utf8_encode('¿Se encuentra abierto el establecimiento? ') );

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
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), utf8_encode(' Iraxen ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), utf8_encode(' Sanaprox ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), utf8_encode(' Maxiflam Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), utf8_encode(' Dolocordralan Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), utf8_encode(' Doloflam Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), utf8_encode(' Naproxeno ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), utf8_encode(' Apronax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), utf8_encode(' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), utf8_encode(' Prioridad ') );

/* ASPIRINA 500 */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 2), utf8_encode('ASPIRINA 100') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), utf8_encode(' Cor Asa ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), utf8_encode(' Cardiopress ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), utf8_encode(' Microass ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), utf8_encode(' Asa-81') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), utf8_encode(' Ecotrin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), utf8_encode(' Acido Acetilsalicilico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), utf8_encode(' Aspirina 100 ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), utf8_encode(' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), utf8_encode(' Prioridad ') );


/* BEPANTHEN CREMA X 30  */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 2), utf8_encode(' REDOXON ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), utf8_encode(' Mi Vic C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), utf8_encode(' Redoxin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), utf8_encode(' Efervit-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), utf8_encode(' Redo-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), utf8_encode(' Vitamina C Genfar ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), utf8_encode(' Crevet ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), utf8_encode(' Cebion ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), utf8_encode(' Redoxon ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), utf8_encode(' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), utf8_encode(' Prioridad ') );


/* SUPRADYN */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 2), utf8_encode(' SUPRADYN PRO NATAL ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80, 3), utf8_encode(' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81, 3), utf8_encode(' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82, 3), utf8_encode(' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83, 3), utf8_encode(' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84, 3), utf8_encode(' Madre ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85, 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86, 3), utf8_encode(' Vi-syneral ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87, 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88, 3), utf8_encode(' Gestavit DHA ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90, 3), utf8_encode(' Supradyn Pro natal ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91, 3), utf8_encode(' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , 3), utf8_encode(' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , 3), utf8_encode(' Prioridad ') );


/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 2), utf8_encode('EXHIBICION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 3), utf8_encode('La farmacia cuenta con exhibición?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , 3), utf8_encode('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , 3), utf8_encode('Foto') );



//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , 2), utf8_encode('Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97, 3), utf8_encode('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98, 3), utf8_encode('Aspirina 500') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99, 3), utf8_encode('Supradyn') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , 3), utf8_encode('Gynocanesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , 3), utf8_encode('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 3), utf8_encode('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , 3), utf8_encode('Berocca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , 3), utf8_encode('Otros') );

//TIENE STOCK APRONAX 275 MG?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , 2), utf8_encode('TIENE STOCK APRONAX 275 MG') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , 3), utf8_encode('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , 3), utf8_encode('COMENTARIO') );

//EN QUE CASO RECOMIENDA APRONAX 275?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , 2), utf8_encode('EN QUE CASO RECOMIENDA APRONAX 275') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , 3), utf8_encode(' Tipo de dolor leve ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , 3), utf8_encode(' Tipo de dolor fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , 3), utf8_encode(' Tratamiento corto plazo ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , 3), utf8_encode(' Otros ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , 3), utf8_encode(' Comentario ') );

//POR QUE NO HA COMPRADO APRONAX 275?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , 2), utf8_encode('POR QUE NO HA COMPRADO APRONAX 275') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , 3), utf8_encode(' No rota ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , 3), utf8_encode(' Nunca he comprado ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , 3), utf8_encode(' No sabia que existia ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , 3), utf8_encode(' Otros ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , 3), utf8_encode(' Comentario ') );

//¿El representante de ventas de Bayer le entrega material promocional al dependiente?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , 2), utf8_encode('EL REPRESENTANTE  DE VENTAS BAYER ENTREGA MATERIAL PROMOCIONAL AL DEPENDIENTE') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , 3), utf8_encode('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , 3), utf8_encode('COMENTARIO') );

//¿Esto influye en la recomendación del dependiente hacia el consumidor??
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , 2), utf8_encode('ESTO INFLUYE EN LA RECOMENDACION DEL DEPENDIENTE AL CONSUMIDOR') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , 3), utf8_encode('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , 3), utf8_encode('COMENTARIO') );

/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , 2), utf8_encode('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , 3), utf8_encode('Gano') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , 3), utf8_encode('Acepto Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , 3), utf8_encode('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , 3), utf8_encode('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , 3), utf8_encode('Ejecutivo') );


/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');//DATOS DE COMERCIO
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');//�Se encuentra abierto el establecimiento?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:AL2');//APRONAX
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AM2:BF2');/* ASPIRINA 100 */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BG2:CB2');/* REDOXON */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CC2:CP2');/* SUPRADYN PRO NATAL */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CQ2:CS2');/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CT2:DA2');//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DB2:DC2');//¿TIENE STOCK APRONAX 275 MG?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DD2:DH2');//¿EN QUE CASO RECOMIENDA APRONAX 275?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DI2:DM2');//¿POR QUE NO HA COMPRADO APRONAX 275?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DN2:DO2');//¿EL DE VENTAS BAYER ENTREGA MATERIAL PROMOCIONAL AL DEPENDIENTE?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DP2:DQ2');//¿ESTO INFLUYE EN LA RECOMENDACIÓN DEL DEPENDIENTE AL CONSUMIDOR?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DR2:DU2');/* PREMIACION */




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:DU2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:DF3')->applyFromArray($style_1);


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

	$contador_1++;

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(0, $contador_1), utf8_encode($rowEmp['store_id']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1, $contador_1), utf8_encode($rowEmp['type']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2, $contador_1), utf8_encode($rowEmp['cadenaRuc']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3, $contador_1), utf8_encode($rowEmp['fullname']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4, $contador_1), utf8_encode($rowEmp['address']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5, $contador_1), utf8_encode($rowEmp['district']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6, $contador_1), utf8_encode($rowEmp['region']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7, $contador_1), utf8_encode($rowEmp['ubigeo']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8, $contador_1), utf8_encode($rowEmp['latitude']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9, $contador_1), utf8_encode($rowEmp['longitude']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10, $contador_1), utf8_encode($rowEmp['Auditor']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11, $contador_1), utf8_encode($rowEmp['fecha']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12, $contador_1), utf8_encode($rowEmp['hora']));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), utf8_encode($rowEmp['206_Respuesta']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), utf8_encode($rowEmp['206_Comentario']));

	if (utf8_encode($rowEmp['206_Foto']) == null || utf8_encode($rowEmp['206_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '');
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '=HYPERLINK( "' . utf8_encode($rowEmp['206_Foto']) . '"  , "Foto" )');
	}


	/* APRONAX */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), utf8_encode($rowEmp['208_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), utf8_encode($rowEmp['208_534_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , $contador_1), utf8_encode($rowEmp['210_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , $contador_1), utf8_encode($rowEmp['210_534_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), utf8_encode($rowEmp['209_534_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , $contador_1), utf8_encode($rowEmp['209_534_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), utf8_encode($rowEmp['209_534_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), utf8_encode($rowEmp['209_534_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , $contador_1), utf8_encode($rowEmp['209_534_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , $contador_1), utf8_encode($rowEmp['209_534_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), utf8_encode($rowEmp['209_534_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , $contador_1), utf8_encode($rowEmp['209_534_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), utf8_encode($rowEmp['209_534_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , $contador_1), utf8_encode($rowEmp['209_534_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , $contador_1), utf8_encode($rowEmp['209_534_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), utf8_encode($rowEmp['209_534_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , $contador_1), utf8_encode($rowEmp['209_534_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , $contador_1), utf8_encode($rowEmp['209_534_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , $contador_1), utf8_encode($rowEmp['209_534_z'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , $contador_1), utf8_encode($rowEmp['209_534_z_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), utf8_encode($rowEmp['209_534_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , $contador_1), utf8_encode($rowEmp['209_534_y_priority'] ));


	/* ASPIRINA 100 */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , $contador_1), utf8_encode($rowEmp['208_538_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , $contador_1), utf8_encode($rowEmp['208_538_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , $contador_1), utf8_encode($rowEmp['210_538_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , $contador_1), utf8_encode($rowEmp['210_538_comentario'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , $contador_1), utf8_encode($rowEmp['209_538_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , $contador_1), utf8_encode($rowEmp['209_538_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , $contador_1), utf8_encode($rowEmp['209_538_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , $contador_1), utf8_encode($rowEmp['209_538_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , $contador_1), utf8_encode($rowEmp['209_538_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , $contador_1), utf8_encode($rowEmp['209_538_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , $contador_1), utf8_encode($rowEmp['209_538_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , $contador_1), utf8_encode($rowEmp['209_538_k_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , $contador_1), utf8_encode($rowEmp['209_538_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , $contador_1), utf8_encode($rowEmp['209_538_l_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , $contador_1), utf8_encode($rowEmp['209_538_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , $contador_1), utf8_encode($rowEmp['209_538_m_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , $contador_1), utf8_encode($rowEmp['209_538_aa'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , $contador_1), utf8_encode($rowEmp['209_538_aa_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , $contador_1), utf8_encode($rowEmp['209_538_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , $contador_1), utf8_encode($rowEmp['209_538_y_priority'] ));


	/* REDOXON  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , $contador_1), utf8_encode($rowEmp['208_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , $contador_1), utf8_encode($rowEmp['208_539_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , $contador_1), utf8_encode($rowEmp['210_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , $contador_1), utf8_encode($rowEmp['210_539_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , $contador_1), utf8_encode($rowEmp['209_539_n'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , $contador_1), utf8_encode($rowEmp['209_539_n_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , $contador_1), utf8_encode($rowEmp['209_539_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , $contador_1), utf8_encode($rowEmp['209_539_o_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), utf8_encode($rowEmp['209_539_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), utf8_encode($rowEmp['209_539_p_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , $contador_1), utf8_encode($rowEmp['209_539_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , $contador_1), utf8_encode($rowEmp['209_539_q_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), utf8_encode($rowEmp['209_539_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , $contador_1), utf8_encode($rowEmp['209_539_r_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , $contador_1), utf8_encode($rowEmp['209_539_s'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , $contador_1), utf8_encode($rowEmp['209_539_s_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , $contador_1), utf8_encode($rowEmp['209_539_t'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , $contador_1), utf8_encode($rowEmp['209_539_t_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , $contador_1), utf8_encode($rowEmp['209_539_ab'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , $contador_1), utf8_encode($rowEmp['209_539_ab_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , $contador_1), utf8_encode($rowEmp['209_538_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , $contador_1), utf8_encode($rowEmp['209_538_y_priority'] ));


	/*  SUPRADYN PRO NATAL  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , $contador_1), utf8_encode($rowEmp['208_642_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , $contador_1), utf8_encode($rowEmp['208_642_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , $contador_1), utf8_encode($rowEmp['210_642_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , $contador_1), utf8_encode($rowEmp['210_642_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , $contador_1), utf8_encode($rowEmp['209_642_u'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , $contador_1), utf8_encode($rowEmp['209_642_u_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , $contador_1), utf8_encode($rowEmp['209_642_w'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , $contador_1), utf8_encode($rowEmp['209_642_w_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , $contador_1), utf8_encode($rowEmp['209_642_x'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , $contador_1), utf8_encode($rowEmp['209_642_x_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , $contador_1), utf8_encode($rowEmp['209_642_ac'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , $contador_1), utf8_encode($rowEmp['209_642_ac_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , $contador_1), utf8_encode($rowEmp['209_642_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , $contador_1), utf8_encode($rowEmp['209_642_y_priority'] ));

	/* 	EXHIBICION  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , $contador_1), utf8_encode($rowEmp['207_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , $contador_1), utf8_encode($rowEmp['207_Comentario'] ));

	if (utf8_encode($rowEmp['207_Foto']) == null || utf8_encode($rowEmp['207_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['207_Foto']) .'"  , "Foto" )' );
	}

//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , $contador_1), utf8_encode($rowEmp['207_a'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , $contador_1), utf8_encode($rowEmp['207_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 , $contador_1), utf8_encode($rowEmp['207_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , $contador_1), utf8_encode($rowEmp['207_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , $contador_1), utf8_encode($rowEmp['207_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , $contador_1), utf8_encode($rowEmp['207_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , $contador_1), utf8_encode($rowEmp['207_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , $contador_1), utf8_encode($rowEmp['207_k'] ));


	//TIENE STOCK APRONAX 275 MG
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , $contador_1), utf8_encode($rowEmp['212_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , $contador_1), utf8_encode($rowEmp['212_comentario'] ));

	//EN QUE CASO RECOMIENDA APRONAX 275
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , $contador_1), utf8_encode($rowEmp['215_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , $contador_1), utf8_encode($rowEmp['215_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , $contador_1), utf8_encode($rowEmp['215_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , $contador_1), utf8_encode($rowEmp['215_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , $contador_1), utf8_encode($rowEmp['215_Comentario'] ));

	// POR QUE NO HA COMPRADO APRONAX 275
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , $contador_1), utf8_encode($rowEmp['216_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , $contador_1), utf8_encode($rowEmp['216_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , $contador_1), utf8_encode($rowEmp['216_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , $contador_1), utf8_encode($rowEmp['216_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , $contador_1), utf8_encode($rowEmp['216_Comentario'] ));

	//EL DE VENTAS BAYER ENTREGA MATERIAL PROMOCIONAL AL DEPENDIENTE
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , $contador_1), utf8_encode($rowEmp['213_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , $contador_1), utf8_encode($rowEmp['213_comentario'] ));

	//ESTO INFLUYE EN LA RECOMENDACIÓN DEL DEPENDIENTE AL CONSUMIDOR
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , $contador_1), utf8_encode($rowEmp['214_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , $contador_1), utf8_encode($rowEmp['214_comentario'] ));

	/* 	PREMIACION  */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , $contador_1), utf8_encode($rowEmp['store_premiado'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , $contador_1), utf8_encode($rowEmp['211_Respuesta'] ));

    if (utf8_encode($rowEmp['Foto_premiado']) == null || utf8_encode($rowEmp['Foto_premiado']) == "") {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , $contador_1), '' );
   } else {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
   }
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , $contador_1), utf8_encode($rowEmp['211_comentario'] ));

   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));


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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_19.xlsx"');
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