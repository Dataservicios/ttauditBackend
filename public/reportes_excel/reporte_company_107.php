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

$query_detalle_puntos = "call sp_consulta_reporte_company_107(107)";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3', 'ID'       );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'CANAL'    );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'RUC'      );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'COMERCIO' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'DIRECCION');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'DISTRITO' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'REGION'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'UBIGEO'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'LATITUD'  );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'LONGITUD' );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K3', 'AUDITOR'  );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('L3', 'FECHA'    );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M3', 'HORA'     );//13

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A2', 'DATOS DE COMERCIO');



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 2), ('¿Se encuentra abierto el establecimiento? ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 3), ('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , 3), ('COMENTARIO') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , 3), ('FOTO') );

/* Canesten */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 2), ('Canesten') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), (' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), (' Canesten ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), (' Clotrimazol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), (' Hongocid ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), (' Icaden ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), (' Lafitil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), (' Lamisil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), (' Micolis ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), (' Silka Medic ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), (' Terbinafina ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), (' Lamidizol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), (' Notil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), (' Portil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), (' Tricrem ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), (' Terbisil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), (' Iconyl D ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), (' Roxtil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), (' Quadriderm ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), (' Plumigil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), (' Telset ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), (' Comentario') );


/* ASPIRINA forte */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 2), (' Aspirina Forte') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), (' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), (' Acido Acetilsalicilico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), (' Aspirina Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), (' Bioelectro ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), (' CB zadol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), (' Cefadol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), (' Digravin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), (' Dolgramin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), (' Dolofac ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), (' Kitadol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 3), (' Migradorixina ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , 3), (' Migralivia ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , 3), (' Migra Tapsin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , 3), (' Migrax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , 3), (' Panadol Azul ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , 3), (' Panadol Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , 3), (' Dolo Neurobion ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , 3), (' Migrapac ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , 3), (' Vivarex ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , 3), (' Comentario') );


/* Desitin */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 2), (' Bepanthen Ungüento') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , 3), (' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , 3), (' Desitin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , 3), (' Dr. Zaidman ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , 3), (' Escaldex ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , 3), (' Hipogloss ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , 3), (' Nenegloss ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , 3), (' Nistagloss ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , 3), (' Nistazinc ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , 3), (' Ternesil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , 3), (' Bepanthen Ungüento ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , 3), (' Comentario') );



/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(126 , 2), ('EXHIBICION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(126 , 3), ('La farmacia cuenta con exhibición?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(127 , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128 , 3), ('Foto') );

//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(129 , 2), ('Si la respuesta es si, indicar que marcas de Bayer están exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(129 , 3), ('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(130 , 3), ('Bepanthen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(131 , 3), ('Canesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(132 , 3), ('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(133 , 3), ('Aspirina Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(134 , 3), ('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(135 , 3), ('Berocca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(136 , 3), ('Supradyn') );




/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137 , 2), ('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137 , 3), ('Gano') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(138 , 3), ('Acepto Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(139 , 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(140 , 3), ('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(141 , 3), ('Ejecutivo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(142 , 3), ('Tipo') );

/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');//DATOS DE COMERCIO
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');//Se encuentra abierto el establecimiento?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:BH2');//Canesten
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BI2:CX2');/* Aspirina 100 */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CY2:DV2');/* Bepanthen Ungüento */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DW2:DY2');/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DZ2:EG2');/* Si la respuesta es si, indicar que marcas de Bayer están exhibidas */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EH2:EK2');/* PREMIACION */

/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:EG2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:EM3')->applyFromArray($style_1);

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

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(0, $contador_1), ($rowEmp['store_id']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1, $contador_1), ($rowEmp['type']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2, $contador_1),  ($rowEmp['cadenaRuc']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3, $contador_1), utf8_encode($rowEmp['fullname']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4, $contador_1), utf8_encode($rowEmp['address']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5, $contador_1), utf8_encode($rowEmp['district']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6, $contador_1), utf8_encode($rowEmp['region']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7, $contador_1), ($rowEmp['ubigeo']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8, $contador_1), ($rowEmp['latitude']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9, $contador_1), ($rowEmp['longitude']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10, $contador_1), utf8_encode($rowEmp['Auditor']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11, $contador_1), ($rowEmp['fecha']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12, $contador_1), ($rowEmp['hora']));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), ($rowEmp['1839_Respuesta']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), utf8_encode($rowEmp['1839_Comentario']));

	if (($rowEmp['1839_Foto']) == null || ($rowEmp['1839_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '');
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '=HYPERLINK( "' . ($rowEmp['1839_Foto']) . '"  , "Foto" )');
	}


	/* Canesten */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16, $contador_1), ($rowEmp['1841_643_Respuesta'] ));
	$puntaje =0;
	if($rowEmp['1841_643_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17, $contador_1), ($rowEmp['1843_643_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18, $contador_1), utf8_encode($rowEmp['1843_643_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19, $contador_1), ($rowEmp['1842_643_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20, $contador_1), ($rowEmp['1842_643_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21, $contador_1), ($rowEmp['1842_643_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22, $contador_1), ($rowEmp['1842_643_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23, $contador_1), ($rowEmp['1842_643_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24, $contador_1), ($rowEmp['1842_643_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25, $contador_1), ($rowEmp['1842_643_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26, $contador_1), ($rowEmp['1842_643_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27, $contador_1), ($rowEmp['1842_643_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28, $contador_1), ($rowEmp['1842_643_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29, $contador_1), ($rowEmp['1842_643_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30, $contador_1), ($rowEmp['1842_643_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31, $contador_1), ($rowEmp['1842_643_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32, $contador_1), ($rowEmp['1842_643_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33, $contador_1), ($rowEmp['1842_643_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34, $contador_1), ($rowEmp['1842_643_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35, $contador_1), ($rowEmp['1842_643_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36, $contador_1), ($rowEmp['1842_643_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37, $contador_1), ($rowEmp['1842_643_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38, $contador_1), ($rowEmp['1842_643_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39, $contador_1), ($rowEmp['1842_643_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40, $contador_1), ($rowEmp['1842_643_k_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41, $contador_1), ($rowEmp['1842_643_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42, $contador_1), ($rowEmp['1842_643_l_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43, $contador_1), ($rowEmp['1842_643_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44, $contador_1), ($rowEmp['1842_643_m_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45, $contador_1), ($rowEmp['1842_643_n'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46, $contador_1), ($rowEmp['1842_643_n_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47, $contador_1), ($rowEmp['1842_643_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48, $contador_1), ($rowEmp['1842_643_o_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49, $contador_1), ($rowEmp['1842_643_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50, $contador_1), ($rowEmp['1842_643_p_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51, $contador_1), ($rowEmp['1842_643_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52, $contador_1), ($rowEmp['1842_643_q_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53, $contador_1), ($rowEmp['1842_643_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54, $contador_1), ($rowEmp['1842_643_r_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55, $contador_1), ($rowEmp['1842_643_s'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56, $contador_1), ($rowEmp['1842_643_s_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57, $contador_1), ($rowEmp['1842_643_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58, $contador_1), ($rowEmp['1842_643_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59, $contador_1), utf8_encode($rowEmp['1842_643_comentario_otros'] ));


	/* ASPIRINA FORTE */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60  , $contador_1), ($rowEmp['1841_644_Respuesta'] ));
	if($rowEmp['1841_644_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61  , $contador_1), ($rowEmp['1843_644_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62  , $contador_1), utf8_encode($rowEmp['1843_644_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63  , $contador_1), ($rowEmp['1842_644_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64  , $contador_1), ($rowEmp['1842_644_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65  , $contador_1), ($rowEmp['1842_644_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66  , $contador_1), ($rowEmp['1842_644_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67  , $contador_1), ($rowEmp['1842_644_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68  , $contador_1), ($rowEmp['1842_644_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69  , $contador_1), ($rowEmp['1842_644_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70  , $contador_1), ($rowEmp['1842_644_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71  , $contador_1), ($rowEmp['1842_644_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72  , $contador_1), ($rowEmp['1842_644_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73  , $contador_1), ($rowEmp['1842_644_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74  , $contador_1), ($rowEmp['1842_644_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75  , $contador_1), ($rowEmp['1842_644_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76  , $contador_1), ($rowEmp['1842_644_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77  , $contador_1), ($rowEmp['1842_644_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  , $contador_1), ($rowEmp['1842_644_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  , $contador_1), ($rowEmp['1842_644_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  , $contador_1), ($rowEmp['1842_644_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  , $contador_1), ($rowEmp['1842_644_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  , $contador_1), ($rowEmp['1842_644_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  , $contador_1), ($rowEmp['1842_644_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  , $contador_1), ($rowEmp['1842_644_k_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  , $contador_1), ($rowEmp['1842_644_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86  , $contador_1), ($rowEmp['1842_644_l_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87  , $contador_1), ($rowEmp['1842_644_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88  , $contador_1), ($rowEmp['1842_644_m_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89  , $contador_1), ($rowEmp['1842_644_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90  , $contador_1), ($rowEmp['1842_644_o_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91  , $contador_1), ($rowEmp['1842_644_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92  , $contador_1), ($rowEmp['1842_644_p_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93  , $contador_1), ($rowEmp['1842_644_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94  , $contador_1), ($rowEmp['1842_644_q_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95  , $contador_1), ($rowEmp['1842_644_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96  , $contador_1), ($rowEmp['1842_644_r_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97  , $contador_1), ($rowEmp['1842_644_s'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98  , $contador_1), ($rowEmp['1842_644_s_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  , $contador_1), ($rowEmp['1842_644_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , $contador_1), ($rowEmp['1842_644_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , $contador_1), utf8_encode($rowEmp['1842_644_comentario_otros'] ));


    /* Bepanthen Ungüento */

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , $contador_1), ($rowEmp['1841_844_Respuesta'] ));
    if($rowEmp['1841_844_Respuesta'] == 2 ) {
        $puntaje =  $puntaje + 1 ;
    }
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , $contador_1), ($rowEmp['1843_844_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , $contador_1), utf8_encode($rowEmp['1843_844_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , $contador_1), ($rowEmp['1842_844_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , $contador_1), ($rowEmp['1842_844_a_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , $contador_1), ($rowEmp['1842_844_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , $contador_1), ($rowEmp['1842_844_b_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , $contador_1), ($rowEmp['1842_844_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , $contador_1), ($rowEmp['1842_844_c_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , $contador_1), ($rowEmp['1842_844_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , $contador_1), ($rowEmp['1842_844_d_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , $contador_1), ($rowEmp['1842_844_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , $contador_1), ($rowEmp['1842_844_e_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , $contador_1), ($rowEmp['1842_844_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , $contador_1), ($rowEmp['1842_844_f_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , $contador_1), ($rowEmp['1842_844_g'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , $contador_1), ($rowEmp['1842_844_g_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , $contador_1), ($rowEmp['1842_844_h'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , $contador_1), ($rowEmp['1842_844_h_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , $contador_1), ($rowEmp['1842_844_i'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , $contador_1), ($rowEmp['1842_844_i_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , $contador_1), ($rowEmp['1842_844_ai'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , $contador_1), ($rowEmp['1842_844_ai_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , $contador_1), utf8_encode($rowEmp['1842_844_comentario_otros'] ));

	/* 	EXHIBICION  */
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(126  , $contador_1), ($rowEmp['1840_Respuesta'] ));
//	contador para allar si gano según regla

	if($rowEmp['1840_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(127  , $contador_1), ($rowEmp['1840_Comentario'] ));

	if (($rowEmp['1840_Foto']) == null || ($rowEmp['1840_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128  , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128  , $contador_1), '=HYPERLINK( "'. ($rowEmp['1840_Foto']) .'"  , "Foto" )' );
	}

    //Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(129  , $contador_1), ($rowEmp['1840_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(130  , $contador_1), ($rowEmp['1840_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(131  , $contador_1), ($rowEmp['1840_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(132  , $contador_1), ($rowEmp['1840_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(133  , $contador_1), ($rowEmp['1840_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(134   , $contador_1), ($rowEmp['1840_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(135   , $contador_1), ($rowEmp['1840_g'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(136   , $contador_1), ($rowEmp['1840_h'] ));



	/* 	PREMIACION  */
        $valor_row = $rowEmp['1844_Respuesta'];

		if ($rowEmp['1844_Respuesta'] == "2" && $rowEmp['store_premiado'] == "2") {
			    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), ($rowEmp['store_premiado']));
			   // $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), '2');
		} elseif ($rowEmp['1844_Respuesta'] == "0" && $rowEmp['1839_Respuesta']=='2' ) {
            //$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), '0');
//			if ($rowEmp['1839_Respuesta'] == 2) {
//				if ($puntaje < 3) {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), '0');
//				}
//			}

        }  elseif ($rowEmp['1844_Respuesta'] == null  && $rowEmp['store_premiado'] ==  null && $rowEmp['1839_Respuesta']=='2' ){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), '0');
		}  elseif ($rowEmp['1844_Respuesta'] == null  && $rowEmp['store_premiado'] ==  null && $rowEmp['1839_Respuesta']=='0' ){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137, $contador_1), '');
        }
	

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(138 , $contador_1), ($rowEmp['1844_Respuesta'] ));

    if (($rowEmp['Foto_premiado']) == null || ($rowEmp['Foto_premiado']) == "") {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(139 , $contador_1), '' );
   } else {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(139 , $contador_1), '=HYPERLINK( "'. ($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
   }
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(140 , $contador_1), utf8_encode($rowEmp['1844_comentario'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(141 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(142 , $contador_1), utf8_encode($rowEmp['owner'] ));




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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_107.xlsx"');
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

foreach ($companies as $company_data)
{
	if ($this->pollArray[$company_data->id]['queRecomendo']<>0)
	{
		$totalOrdenado = $this->getTotalOptionForPollId($this->pollArray[$company_data->id]['queRecomendo'],0,$product_id,$ejecutivo,"0",$cadena,1);

		foreach ($totalOrdenado as $valor)
		{
			if ($valor['respuesta']=='Apronax') {$apronax[$company_data->id] = array('nombre' => $valor['respuesta'],'cantidad' => $valor['cantidad']);$sw=1;}
			$comp[] = array('nombre' => $valor['respuesta'],'cantidad' => $valor['cantidad']);
		}
	}
}


//dd($comp);
$result = array_intersect_assoc($comp[0],$comp[1]);dd($result);


?>