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

$query_detalle_puntos = "call sp_consulta_reporte_company_88";
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

/* APRONAX */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 2), ('Supradyn/Berocca') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), (' Supradyn/Berocca ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), (' Biocord ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), (' Vitathon ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), (' Pharmaton ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), (' Infor ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), (' Centrum ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), (' SSunvit (Cualquier variedad) ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), (' Verotonil ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), (' Ceregen ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), (' Multifort ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), (' Gamalate ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), (' Nat B ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), (' Full Spectrum ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), (' Multiactiv ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), (' Prevencel ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), (' GNC - Megamen ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), (' Astymin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), (' Helty ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), (' Vitacap ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), (' Complejo B ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), (' Oramin - F ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), (' Mason - Vitatrum ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), (' Energyforte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), (' Prioridad ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), (' Comentario') );


/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 2), ('EXHIBICION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), ('La farmacia cuenta con exhibición?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), ('Foto') );



//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 2), ('Si la respuesta es si, indicar que marcas de Bayer están exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), ('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), ('Bepanthen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), ('Canesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), ('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), ('Aspirina Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), ('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), ('Berocca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), ('Supradyn') );


//OTRAS PREGUNTAS?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 2), ('¿Tienes Apronax?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), ('Respuesta') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 2), ('¿ El dependiente intentó cambiar Apronax por otra marca?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 3), ('Respuesta ') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 2), ('¿ Por qué marca me intento cambiar?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 3), ('Aflamax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , 3), ('Breflex') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , 3), ('Dioxaflex') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , 3), ('Dolgramin') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , 3), ('Doloaproxol') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , 3), ('Dolocordralan Extra Fuerte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , 3), ('Doloflam Extra Fuerte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , 3), ('Dologyna') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , 3), ('Dolomuskqlar') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , 3), ('Flogodisten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , 3), ('Iraxen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , 3), ('Maxiflam Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , 3), ('Miodel') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 3), ('Miofedrol') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , 3), ('Miopress Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , 3), ('Naproxeno') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , 3), ('Paldolor') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , 3), ('Redex') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99  , 3), ('Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100  , 3), ('Comentario') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , 2), ('¿ Tiene Canesten ?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , 3), ('Respuesta ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 2), ('En caso No tenga Canesten preguntar ¿ por qué?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 3), ('Respuesta ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , 3), ('Comentario') );

/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , 2), ('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , 3), ('Gano') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , 3), ('Acepto Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , 3), ('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , 3), ('Ejecutivo') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , 3), ('Tipo') );


/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');//DATOS DE COMERCIO
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');//Se encuentra abierto el establecimiento?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:BP2');//
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BQ2:BS2');/* EXIHBIDOR */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BT2:CA2');/* Si la respuesta es si, indicar que marcas de Bayer están exhibidas */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CD2:CW2');/*¿Qué variable es importante para recomendar un producto o marca OTC (venta sin receta) por encima de otro?*/
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CY2:CZ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DA2:DD2');/* PREMIACION */

/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:DD2')->applyFromArray($style);
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

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), ($rowEmp['1479_Respuesta']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), utf8_encode($rowEmp['1479_Comentario']));

	if (($rowEmp['1479_Foto']) == null || ($rowEmp['1479_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '');
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '=HYPERLINK( "' . ($rowEmp['1479_Foto']) . '"  , "Foto" )');
	}




	/* --- */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), ($rowEmp['1481_645_Respuesta'] ));
    $puntaje =0;
	if($rowEmp['1481_645_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), ($rowEmp['1483_645_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , $contador_1), utf8_encode($rowEmp['1483_645_comentario'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , $contador_1), ($rowEmp['1482_645_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), ($rowEmp['1482_645_a_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , $contador_1), ($rowEmp['1482_645_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), ($rowEmp['1482_645_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), ($rowEmp['1482_645_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , $contador_1), ($rowEmp['1482_645_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , $contador_1), ($rowEmp['1482_645_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), ($rowEmp['1482_645_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , $contador_1), ($rowEmp['1482_645_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), ($rowEmp['1482_645_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , $contador_1), ($rowEmp['1482_645_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , $contador_1), ($rowEmp['1482_645_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), ($rowEmp['1482_645_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , $contador_1), ($rowEmp['1482_645_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , $contador_1), ($rowEmp['1482_645_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , $contador_1), ($rowEmp['1482_645_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , $contador_1), ($rowEmp['1482_645_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), ($rowEmp['1482_645_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , $contador_1), ($rowEmp['1482_645_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , $contador_1), ($rowEmp['1482_645_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , $contador_1), ($rowEmp['1482_645_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , $contador_1), ($rowEmp['1482_645_k_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , $contador_1), ($rowEmp['1482_645_l'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , $contador_1), ($rowEmp['1482_645_l_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , $contador_1), ($rowEmp['1482_645_m'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , $contador_1), ($rowEmp['1482_645_m_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , $contador_1), ($rowEmp['1482_645_n'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , $contador_1), ($rowEmp['1482_645_n_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , $contador_1), ($rowEmp['1482_645_o'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , $contador_1), ($rowEmp['1482_645_o_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , $contador_1), ($rowEmp['1482_645_p'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , $contador_1), ($rowEmp['1482_645_p_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , $contador_1), ($rowEmp['1482_645_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , $contador_1), ($rowEmp['1482_645_q_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , $contador_1), ($rowEmp['1482_645_r'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , $contador_1), ($rowEmp['1482_645_r_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , $contador_1), ($rowEmp['1482_645_s'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , $contador_1), ($rowEmp['1482_645_s_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , $contador_1), ($rowEmp['1482_645_t'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , $contador_1), ($rowEmp['1482_645_t_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , $contador_1), ($rowEmp['1482_645_u'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , $contador_1), ($rowEmp['1482_645_u_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , $contador_1), ($rowEmp['1482_645_w'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , $contador_1), ($rowEmp['1482_645_w_priority'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , $contador_1), ($rowEmp['1482_645_x'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , $contador_1), ($rowEmp['1482_645_x_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , $contador_1), ($rowEmp['1482_645_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), ($rowEmp['1482_645_ai_priority'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), utf8_encode($rowEmp['1482_645_comentario_otros'] ));

	/* 	EXHIBICION  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , $contador_1), ($rowEmp['1480_Respuesta'] ));

//	contador para allar si gano según regla

	if($rowEmp['1480_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , $contador_1), ($rowEmp['1480_Comentario'] ));

	if (($rowEmp['1480_Foto']) == null || ($rowEmp['1480_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), '=HYPERLINK( "'. ($rowEmp['1480_Foto']) .'"  , "Foto" )' );
	}

//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71, $contador_1), ($rowEmp['1480_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72, $contador_1), ($rowEmp['1480_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73, $contador_1), ($rowEmp['1480_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74, $contador_1), ($rowEmp['1480_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75, $contador_1), ($rowEmp['1480_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , $contador_1), ($rowEmp['1480_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , $contador_1), ($rowEmp['1480_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , $contador_1), ($rowEmp['1480_h'] ));


    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , $contador_1), ($rowEmp['1485_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , $contador_1), ($rowEmp['1487_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , $contador_1), ($rowEmp['1489_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , $contador_1), ($rowEmp['1489_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , $contador_1), ($rowEmp['1489_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , $contador_1), ($rowEmp['1489_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , $contador_1), ($rowEmp['1489_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , $contador_1), ($rowEmp['1489_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , $contador_1), ($rowEmp['1489_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , $contador_1), ($rowEmp['1489_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , $contador_1), ($rowEmp['1489_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , $contador_1), ($rowEmp['1489_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , $contador_1), ($rowEmp['1489_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , $contador_1), ($rowEmp['1489_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , $contador_1), ($rowEmp['1489_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , $contador_1), ($rowEmp['1489_n'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , $contador_1), ($rowEmp['1489_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , $contador_1), ($rowEmp['1489_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , $contador_1), ($rowEmp['1489_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , $contador_1), ($rowEmp['1489_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 , $contador_1), ($rowEmp['1489_s'] ));

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , $contador_1), ($rowEmp['preg_1489_comentario'] ));


    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , $contador_1), ($rowEmp['1492_Respuesta'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , $contador_1), ($rowEmp['1493_Opciones'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , $contador_1), (utf8_encode($rowEmp['1493_Comentario'])));


	/* 	PREMIACION  */


		if ($rowEmp['store_premiado'] == 2) {
			$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104, $contador_1), ($rowEmp['store_premiado']));
		} else {

			if ($rowEmp['1479_Respuesta'] == 2) {
				if ($puntaje < 3) {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104, $contador_1), '0');
				}
			}

		}
	

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , $contador_1), ($rowEmp['1484_Respuesta'] ));

    if (($rowEmp['Foto_premiado']) == null || ($rowEmp['Foto_premiado']) == "") {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , $contador_1), '' );
   } else {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , $contador_1), '=HYPERLINK( "'. ($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
   }
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , $contador_1), utf8_encode($rowEmp['1484_comentario'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , $contador_1), utf8_encode($rowEmp['owner'] ));


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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_88.xlsx"');
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