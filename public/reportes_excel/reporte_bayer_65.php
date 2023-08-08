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

$query_detalle_puntos = "call sp_consulta_reporte_company_65";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K2', 'PRIORIDADES DE APRONAX');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T2', 'PRIORIDADES DE ASPIRINA FORTE');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AC2', 'PRIORIDADES DE CANESTEN');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2', 'PRIORIDADES DE SUPRADYN ');

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('K2:S2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('T2:AB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AC2:AJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AK2:AU2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('K2:AU2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:AU3')->applyFromArray($style_1);


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
	'Otros',
//	'Comentario',

	'Aspirina Forte',
	'Dolofac',
	'Mifralivio x 100',
	'Migrapac x 30',
	'Panadol',
	'Panadol Forte',
	'Kitadol',
	'Acido Acetilsalicilico',
	'Otros',
//	'comentario',


	'Canesten',
	'LAMISIL',
	'SILKA MEDIC',
	'LAFITIL',
	'HONGOCID',
	'MICOLIS',
	'CLOTRIMAZOL ',
	'Otros',
//	'Comentario',


	'Supradyn',
	'Biocord',
	'Infor x30',
	'infor x60',
	'Vitaenergy',
	'Vitathon',
	'Centrum',
	'Centrum Silver',
	'Pharmaton',
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

	array('942_534_a_priority','0') ,
	array('942_534_b_priority','0') ,
	array('942_534_c_priority','0') ,
	array('942_534_d_priority','0') ,
	array('942_534_e_priority','0') ,
	array('942_534_f_priority','0') ,
	array('942_534_g_priority','0') ,
	array('942_534_h_priority','0') ,
	array('942_534_ai_priority','0') ,

//	array('942_534_comentario_otros','1') ,

//Aspirina Forte
	array('942_644_p_priority','0') ,
	array('942_644_i_priority','0') ,
	array('942_644_j_priority','0') ,
	array('942_644_k_priority','0') ,
	array('942_644_l_priority','0') ,
	array('942_644_m_priority','0') ,
	array('942_644_n_priority','0') ,
	array('942_644_o_priority','0') ,
	array('942_644_ai_priority','0') ,
//	array('942_644_comentario_otros','1') ,

//Canesten
	array('942_643_de_priority','0') ,
	array('942_643_df_priority','0') ,
	array('942_643_dg_priority','0') ,
	array('942_643_dh_priority','0') ,
	array('942_643_di_priority','0') ,
	array('942_643_dj_priority','0') ,
	array('942_643_dk_priority','0') ,
	array('942_643_ai_priority','0') ,
//	array('942_643_comentario_otros','1') ,

//Supradyn
	array('942_536_ac_priority','0') ,
	array('942_536_eo_priority','0') ,
	array('942_536_ep_priority','0') ,
	array('942_536_eq_priority','0') ,
	array('942_536_er_priority','0') ,
	array('942_536_es_priority','0') ,
	array('942_536_et_priority','0') ,
	array('942_536_eu_priority','0') ,
	array('942_536_ew_priority','0') ,
	array('942_536_ai_priority','0'),
//	array('942_536_comentario_otros','1') ,
);



$contador_1 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

	//$rowEmp['441_Respuesta'] == 2   verifica solo los puntos abiertos
	if($rowEmp['939_Respuesta'] == 2) {

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
header('Content-Disposition: attachment;filename="Reporte_Bayer_65.xlsx"');
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