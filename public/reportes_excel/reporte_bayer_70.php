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

$query_detalle_puntos = "call sp_consulta_reporte_company_70";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K2', 'PRIORIDADES DE APRONAX');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2', 'PRIORIDADES DE BEPANTHEN');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AN2', 'PRIORIDADES DE REDOXON');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BB2', 'PRIORIDADES DE ASPITINA 100 ');

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('K2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:BA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BB2:BJ2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('K2:BJ2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:BJ3')->applyFromArray($style_1);


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
	'ID',
	'FECHA',
	'REP',
	'CANAL',
	'RUC',
	'UBIGEO',
	'REGION',
	'DISTRITO',
	'COMERCIO',
	'DIRECCION',

//
//
//	'LATITUD',
//	'LONGITUD',
//	'AUDITOR',
//
//	'HORA',

	'Apronax',
	'Dologyna',
	'Iraxen',
	'Sanaprox',
	'Maxiflam Forte',
	'Dolocordralan Extra Fuerte',
	'Doloflam Extra Fuerte',
	'Naproxeno',
	'Miopress Forte',
	'Miodel',
	'Dolgramin',
	'Breflex',
	'Doloaproxol',
	'Dioxaflex',
	'Flogodisten',
	'Aflamax',
	'Otros',
//	'Comentario',

	'Bepanthen',
	'Mucovit',
	'Apipol',
	'Aquasol',
	'Dermafar',
	'Cicatricure',
	'Eucerin',
	'Magistral',
	'Regenerum',
	'Biopiel',
	'Emolan',
	'Otros',
//	'comentario',


	'Redoxon',
	'Mi Vit C',
	'Efervit -C',
	'Genfar',
	'Easylife',
	'Sunlife',
	'Efer-C ',
	'Redoxvit ',
	'Easy Vit C ',
	'Redomax ',
	'Redozinc ',
	'Vitamina C ',
	'Sunvit ',
	'Otros',
//	'Comentario',


	'Aspirina 100',
	'Cor Asa',
	'Cardiopress',
	'Microass',
	'Assa-81',
	'Ecotrin',
	'Acido Acetilsalicilico',
	'Cardioaspirina',
	'Otros',
//	'Comentario',
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), utf8_encode($valor ));

	$contador_columna_cabecera++;
}




$campos = array(

	array('store_id','0') ,
	array('fecha','0') ,
	array('ejecutivo','0') ,
	array('type','0') ,
	array('cadenaRuc','0') ,
	array('ubigeo','0') ,
	array('region','0') ,
	array('district','0') ,
	array('fullname','0') ,
	array('address','0') ,



//	array('latitude','0') ,
//	array('longitude','0') ,
//	array('Auditor','0') ,

//	array('hora','0') ,

// Apronax

	array('1022_534_a_priority','0') ,
	array('1022_534_b_priority','0') ,
	array('1022_534_c_priority','0') ,
	array('1022_534_d_priority','0') ,
	array('1022_534_e_priority','0') ,
	array('1022_534_f_priority','0') ,
	array('1022_534_g_priority','0') ,
	array('1022_534_h_priority','0') ,
	array('1022_534_i_priority','0') ,
	array('1022_534_j_priority','0') ,
	array('1022_534_k_priority','0') ,
	array('1022_534_l_priority','0') ,
	array('1022_534_m_priority','0') ,
	array('1022_534_n_priority','0') ,
	array('1022_534_o_priority','0') ,
	array('1022_534_p_priority','0') ,
	array('1022_534_ai_priority','0') ,

//	array('1022_534_comentario_otros','1') ,

//Aspirina Forte
	array('1022_640_a_priority','0') ,
	array('1022_640_b_priority','0') ,
	array('1022_640_c_priority','0') ,
	array('1022_640_d_priority','0') ,
	array('1022_640_e_priority','0') ,
	array('1022_640_f_priority','0') ,
	array('1022_640_g_priority','0') ,
	array('1022_640_h_priority','0') ,
	array('1022_640_i_priority','0') ,
	array('1022_640_j_priority','0') ,
	array('1022_640_k_priority','0') ,
	array('1022_640_ai_priority','0') ,
//	array('1022_640_comentario_otros','1') ,

//Canesten
	array('1022_539_a_priority','0') ,
	array('1022_539_b_priority','0') ,
	array('1022_539_c_priority','0') ,
	array('1022_539_d_priority','0') ,
	array('1022_539_e_priority','0') ,
	array('1022_539_f_priority','0') ,
	array('1022_539_g_priority','0') ,
	array('1022_539_h_priority','0') ,
	array('1022_539_i_priority','0') ,
	array('1022_539_j_priority','0') ,
	array('1022_539_k_priority','0') ,
	array('1022_539_l_priority','0') ,
	array('1022_539_m_priority','0') ,
	array('1022_539_ai_priority','0') ,
//	array('1022_539_comentario_otros','1') ,

//Supradyn
	array('1022_538_g_priority','0') ,
	array('1022_538_a_priority','0') ,
	array('1022_538_b_priority','0') ,
	array('1022_538_c_priority','0') ,
	array('1022_538_d_priority','0') ,
	array('1022_538_e_priority','0') ,
	array('1022_538_f_priority','0') ,
	array('1022_538_h_priority','0') ,
	array('1022_538_ai_priority','0'),
//	array('1022_538_comentario_otros','1') ,
);



$contador_1 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

	//$rowEmp['441_Respuesta'] == 2   verifica solo los puntos abiertos
	if($rowEmp['1019_Respuesta'] == 2) {

		$contador_1 ++;
		$contador_columna = 0;
		for ($row = 0; $row < count($campos) ; $row++) {
			$campo = $campos[$row][0];
			$tipo_campo = $campos[$row][1];
			if ($tipo_campo == "0") {
				if ($rowEmp[$campo]  == null || $rowEmp[$campo]  == "") {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '0' );
				}else{
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo])  );
				}

			} else {
				if ($tipo_campo == "1") {
					$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
				}else{
					if ($tipo_campo == "3") {
						$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), $campo);
					}else{
						if ($rowEmp[$campo]  == null || $rowEmp[$campo]  == "") {
							$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
						} else {
							$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. $rowEmp[$campo] .'"  , "Foto" )' );
						}
					}
				}

			}
			$contador_columna++;
		}
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
header('Content-Disposition: attachment;filename="Reporte_Bayer_70.xlsx"');
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