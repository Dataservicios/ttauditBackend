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

$query_detalle_puntos = "call sp_consulta_reporte_company_35";
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



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 2), ('¿Se encuentra abierto el establecimiento? ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 , 3), ('RESPUESTA') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 , 3), ('COMENTARIO') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 , 3), ('FOTO') );

/* APRONAX */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 2), ('APRONAX') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , 3), (' Dologyna ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , 3), (' Iraxen ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , 3), (' Sanaprox ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , 3), (' Maxiflam Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , 3), (' Dolocordralan Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , 3), (' Doloflam Extra Fuerte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , 3), (' Naproxeno ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , 3), (' Miopress Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , 3), (' Miodel ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , 3), (' Dolgramin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , 3), (' Breflex ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , 3), (' Doloaproxol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , 3), (' Dioxaflex ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , 3), (' Flogodistan ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , 3), (' Apronax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , 3), (' Prioridad ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , 3), (' Comentario') );


/* ASPIRINA forte */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 2), ('ASPIRINA FORTE') );


$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , 3), (' Dolofac ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , 3), (' Mifralivio x 100 ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , 3), (' Migrapac x 30 ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , 3), (' Panadol') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , 3), (' Panadol Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , 3), (' Kitadol  ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , 3), (' Acido Acetilsalicilico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , 3), (' Dolgramin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , 3), (' Cefadol ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , 3), (' Digravin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , 3), (' Migralivia ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , 3), (' Migrax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , 3), (' Migrodoroxina ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , 3), (' Migratapcin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , 3), (' Aspirina Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , 3), (' Prioridad') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , 3), (' Comentario') );


/* REDOXON  */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , 2), (' REDOXON ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , 3), (' Mi Vic C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , 3), (' Redoxin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , 3), (' Efervit-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , 3), (' Redo-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 , 3), (' Vitamina C Genfar ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , 3), (' Crevet ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , 3), (' Cebion ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , 3), (' Easylife ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , 3), (' Sunlife ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , 3), (' Efer-C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , 3), (' Redoxvit ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , 3), (' Easy Vit C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , 3), (' Redomax ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , 3), (' Redozinc ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , 3), (' Vitamina C ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , 3), (' Sunvit ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , 3), (' Redoxon ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(126 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(127 , 3), (' Comentario') );


/* BEROCCA + SUPRADYN */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128 , 2), (' BEROCCA / SUPRADYN ') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128 , 3), (' Recomienda') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(129 , 3), (' Stock') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(130 , 3), (' Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(131 , 3), (' Oramin ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(132 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(133 , 3), (' Multidayli ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(134 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(135 , 3), (' Nutrastres ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(136 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137 , 3), (' Energy Forte ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(138 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(139 , 3), (' Ceregen chico ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(140 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(141 , 3), (' Viramine stress ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(142 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(143 , 3), (' Stress formula-Mason ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(144 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(145 , 3), (' Ca+Mg+Zn-Pharmatech ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(146 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(147 , 3), (' Infor ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(148 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(149 , 3), (' Vitaenergy ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(150 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(151 , 3), (' Vitathon ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(152 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(153 , 3), (' Centrum ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(154 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(155 , 3), (' Centrum Silver ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(156 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(157 , 3), (' Pharmaton ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(158 , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(159 , 3), (' Biocord ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(160  , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(161  , 3), (' Berocca/Supradyn ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(162  , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(163  , 3), (' Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(164  , 3), (' Prioridad ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(165  , 3), (' Comentario') );


/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(166 , 2), ('EXHIBICION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(166 , 3), ('La farmacia cuenta con exhibición?') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(167 , 3), ('Comentario') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(168 , 3), ('Foto') );



//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(169 , 2), ('Si la respuesta es si, indicar que marcas de Bayer están exhibidas') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(169  , 3), ('Apronax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(170 , 3), ('Bepanthen') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(171 , 3), ('Canesten') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(172 ,  3), ('Aspirina 100') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(173 , 3), ('Aspirina Forte') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(174 , 3), ('Redoxon') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(175 , 3), ('Berocca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(176 , 3), ('Supradyn') );


//OTRAS PREGUNTAS?
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(177 , 2), ('OTROS') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(177 , 3), (' ¿De 10 clientes que vienen a comprar algún medicamento para dolor muscular, cuantos te piden tu recomendación? ') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(178 , 3), (' ¿De 10 clientes que vienen a comprar algún medicamento para dolor de cabeza, cuantos te piden tu recomendación? ') );


/* PREMIACION */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(179 , 2), ('PREMIACION') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(179 , 3), ('Gano') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(180 , 3), ('Acepto Premio') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(181 , 3), ('Foto') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(182 , 3), ('Comentario') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(183 , 3), ('Ejecutivo') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(184 , 3), ('Tipo') );


/* Une las Celdas para la cabecera */
//$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:C2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A2:M2');//DATOS DE COMERCIO
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('N2:P2');//�Se encuentra abierto el establecimiento?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Q2:AZ2');//APRONAX
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BA2:CJ2');/* ASPIRINA forte */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CK2:DX2');/* REDOXON */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DY2:FJ2');/* BEROCCA + SUPRADIN  */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('FK2:FM2');/* EXHIBICION */
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('FN2:FU2');//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('FV2:FW2');//otros?
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('FX2:GA2');/* PREMIACION */

/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('A2:GA2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:GC3')->applyFromArray($style_1);


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

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13, $contador_1), ($rowEmp['481_Respuesta']));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14, $contador_1), utf8_encode($rowEmp['481_Comentario']));

	if (($rowEmp['481_Foto']) == null || ($rowEmp['481_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '');
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15, $contador_1), '=HYPERLINK( "' . ($rowEmp['481_Foto']) . '"  , "Foto" )');
	}


	/* APRONAX */
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 , $contador_1), ($rowEmp['483_534_Respuesta'] ));
	$puntaje =0;
	if($rowEmp['483_534_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 , $contador_1), ($rowEmp['485_534_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18 , $contador_1), utf8_encode($rowEmp['485_534_comentario'] ));



	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19 , $contador_1), ($rowEmp['484_534_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20 , $contador_1), ($rowEmp['484_534_b_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21 , $contador_1), ($rowEmp['484_534_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22 , $contador_1), ($rowEmp['484_534_c_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23 , $contador_1), ($rowEmp['484_534_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24 , $contador_1), ($rowEmp['484_534_d_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25 , $contador_1), ($rowEmp['484_534_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26 , $contador_1), ($rowEmp['484_534_e_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27 , $contador_1), ($rowEmp['484_534_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28 , $contador_1), ($rowEmp['484_534_f_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29 , $contador_1), ($rowEmp['484_534_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30 , $contador_1), ($rowEmp['484_534_g_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31 , $contador_1), ($rowEmp['484_534_h'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32 , $contador_1), ($rowEmp['484_534_h_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33 , $contador_1), ($rowEmp['484_534_bi'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34 , $contador_1), ($rowEmp['484_534_bi_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35 , $contador_1), ($rowEmp['484_534_bj'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36 , $contador_1), ($rowEmp['484_534_bj_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 , $contador_1), ($rowEmp['484_534_bk'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38 , $contador_1), ($rowEmp['484_534_bk_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39 , $contador_1), ($rowEmp['484_534_bl'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40 , $contador_1), ($rowEmp['484_534_bl_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41 , $contador_1), ($rowEmp['484_534_bm'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42 , $contador_1), ($rowEmp['484_534_bm_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43 , $contador_1), ($rowEmp['484_534_bn'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(44 , $contador_1), ($rowEmp['484_534_bn_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(45 , $contador_1), ($rowEmp['484_534_bo'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(46 , $contador_1), ($rowEmp['484_534_bo_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(47 , $contador_1), ($rowEmp['484_534_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(48 , $contador_1), ($rowEmp['484_534_a_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(49 , $contador_1), ($rowEmp['484_534_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(50 , $contador_1), ($rowEmp['484_534_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(51 , $contador_1), utf8_encode($rowEmp['484_534_comentario_otros'] ));


	/* ASPIRINA FORTE */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(52 , $contador_1), ($rowEmp['483_644_Respuesta'] ));
	if($rowEmp['483_644_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(53 , $contador_1), ($rowEmp['485_644_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(54 , $contador_1), utf8_encode($rowEmp['485_644_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(55 , $contador_1), ($rowEmp['484_644_i'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(56 , $contador_1), ($rowEmp['484_644_i_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(57 , $contador_1), ($rowEmp['484_644_j'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(58 , $contador_1), ($rowEmp['484_644_j_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(59 , $contador_1), ($rowEmp['484_644_k'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(60 , $contador_1), ($rowEmp['484_644_k_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(61 , $contador_1), ($rowEmp['484_644_l'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(62 , $contador_1), ($rowEmp['484_644_l_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(63 , $contador_1), ($rowEmp['484_644_m'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(64 , $contador_1), ($rowEmp['484_644_m_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(65 , $contador_1), ($rowEmp['484_644_n'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(66 , $contador_1), ($rowEmp['484_644_n_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(67 , $contador_1), ($rowEmp['484_644_o'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(68 , $contador_1), ($rowEmp['484_644_o_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(69 , $contador_1), ($rowEmp['484_644_cq'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(70 , $contador_1), ($rowEmp['484_644_cq_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(71 , $contador_1), ($rowEmp['484_644_cr'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(72 , $contador_1), ($rowEmp['484_644_cr_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(73 , $contador_1), ($rowEmp['484_644_cs'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(74 , $contador_1), ($rowEmp['484_644_cs_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(75 , $contador_1), ($rowEmp['484_644_ct'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(76 , $contador_1), ($rowEmp['484_644_ct_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(77 , $contador_1), ($rowEmp['484_644_cu'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(78 , $contador_1), ($rowEmp['484_644_cu_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(79 , $contador_1), ($rowEmp['484_644_cv'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(80 , $contador_1), ($rowEmp['484_644_cv_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(81 , $contador_1), ($rowEmp['484_644_cw'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(82 , $contador_1), ($rowEmp['484_644_cw_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(83 , $contador_1), ($rowEmp['484_644_p'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(84 , $contador_1), ($rowEmp['484_644_p_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(85 , $contador_1), ($rowEmp['484_644_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(86 , $contador_1), ($rowEmp['484_644_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(87 , $contador_1), utf8_encode($rowEmp['484_644_comentario_otros'] ));

	/* REDOXON  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(88 , $contador_1), ($rowEmp['483_539_Respuesta'] ));
	if($rowEmp['483_539_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(89 , $contador_1), ($rowEmp['485_539_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(90 , $contador_1), utf8_encode($rowEmp['485_539_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(91 , $contador_1), ($rowEmp['484_539_r'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(92 , $contador_1), ($rowEmp['484_539_r_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(93 , $contador_1), ($rowEmp['484_539_s'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(94 , $contador_1), ($rowEmp['484_539_s_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(95 , $contador_1), ($rowEmp['484_539_t'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(96 , $contador_1), ($rowEmp['484_539_t_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(97 , $contador_1), ($rowEmp['484_539_u'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(98 , $contador_1), ($rowEmp['484_539_u_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(99 , $contador_1), ($rowEmp['484_539_w'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(100 , $contador_1), ($rowEmp['484_539_w_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(101 , $contador_1), ($rowEmp['484_539_x'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(102 , $contador_1), ($rowEmp['484_539_x_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(103 , $contador_1), ($rowEmp['484_539_y'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(104 , $contador_1), ($rowEmp['484_539_y_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(105 , $contador_1), ($rowEmp['484_539_dh'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(106 , $contador_1), ($rowEmp['484_539_dh_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(107 , $contador_1), ($rowEmp['484_539_di'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(108 , $contador_1), ($rowEmp['484_539_di_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(109 , $contador_1), ($rowEmp['484_539_dj'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(110 , $contador_1), ($rowEmp['484_539_dj_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(111 , $contador_1), ($rowEmp['484_539_dk'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(112 , $contador_1), ($rowEmp['484_539_dk_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(113 , $contador_1), ($rowEmp['484_539_dl'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(114 , $contador_1), ($rowEmp['484_539_dl_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(115 , $contador_1), ($rowEmp['484_539_dm'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(116 , $contador_1), ($rowEmp['484_539_dm_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(117 , $contador_1), ($rowEmp['484_539_dn'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(118 , $contador_1), ($rowEmp['484_539_dn_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(119 , $contador_1), ($rowEmp['484_539_do'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(120 , $contador_1), ($rowEmp['484_539_do_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(121 , $contador_1), ($rowEmp['484_539_dp'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(122 , $contador_1), ($rowEmp['484_539_dp_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(123 , $contador_1), ($rowEmp['484_539_q'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(124 , $contador_1), ($rowEmp['484_539_q_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(125 , $contador_1), ($rowEmp['484_539_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(126 , $contador_1), ($rowEmp['484_539_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(127 , $contador_1), utf8_encode($rowEmp['484_539_comentario_otros'] ));


	/*  BEROCAA + SUPRADYN*/


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(128  , $contador_1), ($rowEmp['483_645_Respuesta'] ));
	if($rowEmp['483_645_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(129  , $contador_1), ($rowEmp['485_645_Respuesta'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(130  , $contador_1), utf8_encode($rowEmp['485_645_comentario'] ));


	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(131  , $contador_1), ($rowEmp['484_645_aa'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(132  , $contador_1), ($rowEmp['484_645_aa_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(133  , $contador_1), ($rowEmp['484_645_ab'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(134 , $contador_1), ($rowEmp['484_645_ab_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(135 , $contador_1), ($rowEmp['484_645_ac'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(136 , $contador_1), ($rowEmp['484_645_ac_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(137 , $contador_1), ($rowEmp['484_645_ad'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(138 , $contador_1), ($rowEmp['484_645_ad_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(139 , $contador_1), ($rowEmp['484_645_ae'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(140 , $contador_1), ($rowEmp['484_645_ae_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(141 , $contador_1), ($rowEmp['484_645_af'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(142 , $contador_1), ($rowEmp['484_645_af_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(143 , $contador_1), ($rowEmp['484_645_ag'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(144 , $contador_1), ($rowEmp['484_645_ag_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(145 , $contador_1), ($rowEmp['484_645_ah'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(146 , $contador_1), ($rowEmp['484_645_ah_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(147 , $contador_1), ($rowEmp['484_645_da'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(148 , $contador_1), ($rowEmp['484_645_da_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(149 , $contador_1), ($rowEmp['484_645_db'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(150 , $contador_1), ($rowEmp['484_645_db_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(151 , $contador_1), ($rowEmp['484_645_dc'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(152 , $contador_1), ($rowEmp['484_645_dc_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(153 , $contador_1), ($rowEmp['484_645_de'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(154 , $contador_1), ($rowEmp['484_645_de_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(155 , $contador_1), ($rowEmp['484_645_df'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(156 , $contador_1), ($rowEmp['484_645_df_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(157 , $contador_1), ($rowEmp['484_645_dg'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(158 , $contador_1), ($rowEmp['484_645_dg_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(159 , $contador_1), ($rowEmp['484_645_dq'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(160 , $contador_1), ($rowEmp['484_645_dq_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(161 , $contador_1), ($rowEmp['484_645_z'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(162 , $contador_1), ($rowEmp['484_645_z_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(163 , $contador_1), ($rowEmp['484_645_ai'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(164  , $contador_1), ($rowEmp['484_645_ai_priority'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(165  , $contador_1), utf8_encode($rowEmp['484_645_comentario_otros'] ));

	/* 	EXHIBICION  */

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(166 , $contador_1), ($rowEmp['482_Respuesta'] ));

//	contador para allar si gano según regla

	if($rowEmp['482_Respuesta'] == 2 ) {
		$puntaje =  $puntaje + 1 ;
	}

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(167 , $contador_1), ($rowEmp['482_Comentario'] ));

	if (($rowEmp['482_Foto']) == null || ($rowEmp['482_Foto']) == "") {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(168 , $contador_1), '' );
	} else {
		$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(168 , $contador_1), '=HYPERLINK( "'. ($rowEmp['482_Foto']) .'"  , "Foto" )' );
	}

//Si la respuesta es si, indicar que marcas de Bayer est�n exhibidas

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(169, $contador_1), ($rowEmp['482_a'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(170, $contador_1), ($rowEmp['482_b'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(171, $contador_1), ($rowEmp['482_c'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(172, $contador_1), ($rowEmp['482_d'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(173, $contador_1), ($rowEmp['482_e'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(174 , $contador_1), ($rowEmp['482_f'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(175 , $contador_1), ($rowEmp['482_g'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(176 , $contador_1), ($rowEmp['482_h'] ));


	//TIENE STOCK APRONAX 275 MG

	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(177 , $contador_1), utf8_encode($rowEmp['487_comentario'] ));
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(178 , $contador_1), utf8_encode($rowEmp['488_comentario'] ));


	/* 	PREMIACION  */


		if ($rowEmp['store_premiado'] == 2) {
			$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(179, $contador_1), ($rowEmp['store_premiado']));
		} else {

			if ($rowEmp['481_Respuesta'] == 2) {
				if ($puntaje < 3) {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(179, $contador_1), '0');
				}
			}

		}
	

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(180 , $contador_1), ($rowEmp['486_Respuesta'] ));

    if (($rowEmp['Foto_premiado']) == null || ($rowEmp['Foto_premiado']) == "") {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(181 , $contador_1), '' );
   } else {
       $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(181 , $contador_1), '=HYPERLINK( "'. ($rowEmp['Foto_premiado']) .'"  , "Foto" )' );
   }
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(182 , $contador_1), utf8_encode($rowEmp['486_comentario'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(183 , $contador_1), utf8_encode($rowEmp['ejecutivo'] ));
   $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(184 , $contador_1), utf8_encode($rowEmp['owner'] ));
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
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_35.xlsx"');
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