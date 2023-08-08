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

$query_detalle_puntos = "call sp_consulta_reporte_company_118(118)";
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
/* Redoxon */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 2), ('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), (' Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), (' Redoxon ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), (' Mi vic ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), (' Efervit -C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), (' Genfar ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), (' Easylife ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), (' Sunlife ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), (' Efer-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), (' Redoxvit ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), (' Easy Vit C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), (' Redomax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), (' Redozinc ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), (' Vitamina C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), (' Sunvit ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), (' Cafevret ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), (' Mason ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), (' Prioridad ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), (' Comentario') );


/* Aspirina 100 */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 2), ('Aspirina 100') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), (' Cor Asa ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), (' Cardiopress ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), (' Microass ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), (' Assa-81 ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), (' Ecotrin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), (' Acido Acetilsalicilico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), (' Aspirina 100 ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), (' Cardioaspirina ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), (' Irrigor ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), (' Dupirina ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), (' Comentario') );

/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 2), ('EXHIBICION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), ('La farmacia cuenta con exhibición?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 3), ('Foto') );



//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 2), ('Si la respuesta es si, indicar que marcas de Bayer están exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 3), ('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , 3), ('Bepanthen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , 3), ('Canesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , 3), ('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , 3), ('Aspirina Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , 3), ('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , 3), ('Berocca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , 3), ('Supradyn') );


/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , 2), ('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , 3), ('Gano') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , 3), ('Acepto Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , 3), ('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , 3), ('Ejecutivo') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 3), ('Tipo') );

/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');//DATOS DE COMERCIO
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');//Se encuentra abierto el establecimiento?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:AZ2');//Redoxon
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BA2:BZ2');/* Aspirina 100 */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CA2:CC2');/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CD2:CK2');/* Si la respuesta es si, indicar que marcas de Bayer están exhibidas */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CL2:CN2');/* PREMIACION */

/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:CN2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:CP3')->applyFromArray($style_1);

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

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), ($rowEmp['2041_Respuesta']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), utf8_encode($rowEmp['2041_Comentario']));

	if (($rowEmp['2041_Foto']) == null || ($rowEmp['2041_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '');
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '=HYPERLINK( "' . ($rowEmp['2041_Foto']) . '"  , "Foto" )');
	}


	/* APRONAX */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), ($rowEmp['2043_539_Respuesta'] ));
	$puntaje =0;
	if($rowEmp['2043_539_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17, $contador_1), ($rowEmp['2045_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18, $contador_1), utf8_encode($rowEmp['2045_539_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19, $contador_1), ($rowEmp['2044_539_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20, $contador_1), ($rowEmp['2044_539_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21, $contador_1), ($rowEmp['2044_539_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22, $contador_1), ($rowEmp['2044_539_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23, $contador_1), ($rowEmp['2044_539_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24, $contador_1), ($rowEmp['2044_539_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25, $contador_1), ($rowEmp['2044_539_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26, $contador_1), ($rowEmp['2044_539_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27, $contador_1), ($rowEmp['2044_539_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28, $contador_1), ($rowEmp['2044_539_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29, $contador_1), ($rowEmp['2044_539_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30, $contador_1), ($rowEmp['2044_539_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31, $contador_1), ($rowEmp['2044_539_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32, $contador_1), ($rowEmp['2044_539_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33, $contador_1), ($rowEmp['2044_539_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34, $contador_1), ($rowEmp['2044_539_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35, $contador_1), ($rowEmp['2044_539_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36, $contador_1), ($rowEmp['2044_539_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37, $contador_1), ($rowEmp['2044_539_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38, $contador_1), ($rowEmp['2044_539_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39, $contador_1), ($rowEmp['2044_539_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40, $contador_1), ($rowEmp['2044_539_k_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41, $contador_1), ($rowEmp['2044_539_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42, $contador_1), ($rowEmp['2044_539_l_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43, $contador_1), ($rowEmp['2044_539_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44, $contador_1), ($rowEmp['2044_539_m_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45, $contador_1), ($rowEmp['2044_539_n'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46, $contador_1), ($rowEmp['2044_539_n_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47, $contador_1), ($rowEmp['2044_539_o'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48, $contador_1), ($rowEmp['2044_539_o_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49, $contador_1), ($rowEmp['2044_539_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50, $contador_1), ($rowEmp['2044_539_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51, $contador_1), utf8_encode($rowEmp['2044_539_comentario_otros'] ));


	/* ASPIRINA FORTE */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , $contador_1), ($rowEmp['2043_538_Respuesta'] ));
	if($rowEmp['2043_538_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , $contador_1), ($rowEmp['2045_538_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , $contador_1), utf8_encode($rowEmp['2045_538_comentario'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , $contador_1), ($rowEmp['2044_538_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , $contador_1), ($rowEmp['2044_538_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , $contador_1), ($rowEmp['2044_538_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , $contador_1), ($rowEmp['2044_538_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , $contador_1), ($rowEmp['2044_538_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , $contador_1), ($rowEmp['2044_538_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , $contador_1), ($rowEmp['2044_538_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , $contador_1), ($rowEmp['2044_538_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , $contador_1), ($rowEmp['2044_538_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , $contador_1), ($rowEmp['2044_538_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , $contador_1), ($rowEmp['2044_538_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), ($rowEmp['2044_538_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), ($rowEmp['2044_538_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , $contador_1), ($rowEmp['2044_538_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , $contador_1), ($rowEmp['2044_538_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), ($rowEmp['2044_538_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , $contador_1), ($rowEmp['2044_538_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , $contador_1), ($rowEmp['2044_538_i_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , $contador_1), ($rowEmp['2044_538_j'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , $contador_1), ($rowEmp['2044_538_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , $contador_1), ($rowEmp['2044_538_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , $contador_1), ($rowEmp['2044_538_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , $contador_1), utf8_encode($rowEmp['2044_538_comentario_otros'] ));

	/* 	EXHIBICION  */

	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78  , $contador_1), ($rowEmp['2042_Respuesta'] ));

//	contador para allar si gano según regla

	if($rowEmp['2042_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}

	    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79  , $contador_1), ($rowEmp['2042_Comentario'] ));

	if (($rowEmp['2042_Foto']) == null || ($rowEmp['2042_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80  , $contador_1), '=HYPERLINK( "'. ($rowEmp['2042_Foto']) .'"  , "Foto" )' );
	}

//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas

        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81  , $contador_1), ($rowEmp['2042_a'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82  , $contador_1), ($rowEmp['2042_b'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83  , $contador_1), ($rowEmp['2042_c'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84  , $contador_1), ($rowEmp['2042_d'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85  , $contador_1), ($rowEmp['2042_e'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86   , $contador_1), ($rowEmp['2042_f'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87   , $contador_1), ($rowEmp['2042_g'] ));
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88   , $contador_1), ($rowEmp['2042_h'] ));

	/* 	PREMIACION  */
      //  $valor_row = $rowEmp['2046_Respuesta'];

        if ($rowEmp['2046_Respuesta'] == "2" && $rowEmp['store_premiado'] == "2") {
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), ($rowEmp['store_premiado']));
        } elseif ($rowEmp['2046_Respuesta'] == "0" && $rowEmp['2041_Respuesta']=='2' ) {
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), '0');
        }  elseif ($rowEmp['2046_Respuesta'] == null  && $rowEmp['store_premiado'] ==  null && $rowEmp['2041_Respuesta']=='2' ){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), '0');
        }  elseif ($rowEmp['2046_Respuesta'] == null  && $rowEmp['store_premiado'] ==  null && $rowEmp['2041_Respuesta']=='0' ){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), '');
        }  elseif ($rowEmp['2046_Respuesta'] == null  && $rowEmp['store_premiado'] ==  null && $rowEmp['2041_Respuesta']=='2' ){
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), '');
        }
        else {
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89, $contador_1), $rowEmp['store_premiado']);
        }


	

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , $contador_1), ($rowEmp['2046_Respuesta'] ));

    if (($rowEmp['Foto_premiado']) == null || ($rowEmp['Foto_premiado']) == "") {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , $contador_1), '' );
   } else {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , $contador_1), '=HYPERLINK( "'. ($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
   }
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , $contador_1), utf8_encode($rowEmp['2046_comentario'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , $contador_1), utf8_encode($rowEmp['owner'] ));

   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , $contador_1), utf8_encode($rowEmp['2046_Respuesta']));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , $contador_1), utf8_encode($rowEmp['store_premiado']));






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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_118.xlsx"');
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