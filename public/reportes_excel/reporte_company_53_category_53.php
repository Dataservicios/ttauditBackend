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

$query_detalle_puntos = "call sp_reporte_company_53_category_53";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T2', 'Ganchera Salsas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AD2','Ganchera Frutísimos');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AN2','Portafiche Multicategoría');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AX2','Exhibidores Margarinas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BH2','Exhibidor Galletas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BR2','Posavuelto Galletas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CB2','Cenefas DV(shelfttaker DV)');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CL2','Ganchera de grageados');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CV2','Cubos de impulso');




/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('T2:AC2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AD2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:AW2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AX2:BG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BH2:BQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BR2:CA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CB2:CK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CL2:CU2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CV2:DE2');




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('T2:DE2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:DG3')->applyFromArray($style_1);


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

$cabecera = array(
	'ID',
	'CANAL',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'LATITUD',
	'LONGITUD',
	'TIPO DE BODEGA',
	'AUDITOR',
	'FECHA',
	'HORA',
	'¿Se encuentra Abierto? Si/No',
	'Opciones',
	'FOTO',
	'¿Cliente permitió tomar informaciónn?',
	'Opciones',
	'Comentario',


	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',

	'¿ Se encontro exhibidor ?',
	'Aún no lo colocaron',
	'Cliente lo retiro',
	'Cliente lo perdio o lo rompio',
	'Cliente nunca lo acepto',
	'Otros',
	'Comentario',
	'Es visible?',
	'Está Contaminado',
	'Foto',


	'¿ Es cliente perfecto ?',
	'¿Desde cuando es cliente perfecto?',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);
		
	$contador_columna_cabecera++;
}	



	
$campos = array(
	array('store_id', '0'),
	array('type', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('tipo_bodega', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('756_Respuesta', '0'),
	array('756_Opciones', '0'),
	array('756_Foto', '1'),

	array('757_Respuesta', '0'),
	array('757_Opciones', '0'),
	array('757_Comentario', '0'),

	array('762_471_Respuesta_sino', '0'),
	array('762_471_a', '0'),
	array('762_471_b', '0'),
	array('762_471_c', '0'),
	array('762_471_d', '0'),
	array('762_471_e', '0'),
	array('762_471_e_comentario', '0'),
	array('471_visible', '0'),
	array('471_contaminated', '0'),
	array('471_foto', '1'),


	array('762_472_Respuesta_sino', '0'),
	array('762_472_a', '0'),
	array('762_472_b', '0'),
	array('762_472_c', '0'),
	array('762_472_d', '0'),
	array('762_472_e', '0'),
	array('762_472_e_comentario', '0'),
	array('472_visible', '0'),
	array('472_contaminated', '0'),
	array('472_foto', '1'),


	array('762_473_Respuesta_sino', '0'),
	array('762_473_a', '0'),
	array('762_473_b', '0'),
	array('762_473_c', '0'),
	array('762_473_d', '0'),
	array('762_473_e', '0'),
	array('762_473_e_comentario', '0'),
	array('473_visible', '0'),
	array('473_contaminated', '0'),
	array('473_foto', '1'),


	array('762_474_Respuesta_sino', '0'),
	array('762_474_a', '0'),
	array('762_474_b', '0'),
	array('762_474_c', '0'),
	array('762_474_d', '0'),
	array('762_474_e', '0'),
	array('762_474_e_comentario', '0'),
	array('474_visible', '0'),
	array('474_contaminated', '0'),
	array('474_foto', '1'),


	array('762_475_Respuesta_sino', '0'),
	array('762_475_a', '0'),
	array('762_475_b', '0'),
	array('762_475_c', '0'),
	array('762_475_d', '0'),
	array('762_475_e', '0'),
	array('762_475_e_comentario', '0'),
	array('475_visible', '0'),
	array('475_contaminated', '0'),
	array('475_foto', '1'),


	array('762_476_Respuesta_sino', '0'),
	array('762_476_a', '0'),
	array('762_476_b', '0'),
	array('762_476_c', '0'),
	array('762_476_d', '0'),
	array('762_476_e', '0'),
	array('762_476_e_comentario', '0'),
	array('476_visible', '0'),
	array('476_contaminated', '0'),
	array('476_foto', '1'),


	array('762_477_Respuesta_sino', '0'),
	array('762_477_a', '0'),
	array('762_477_b', '0'),
	array('762_477_c', '0'),
	array('762_477_d', '0'),
	array('762_477_e', '0'),
	array('762_477_e_comentario', '0'),
	array('477_visible', '0'),
	array('477_contaminated', '0'),
	array('477_foto', '1'),


	array('762_478_Respuesta_sino', '0'),
	array('762_478_a', '0'),
	array('762_478_b', '0'),
	array('762_478_c', '0'),
	array('762_478_d', '0'),
	array('762_478_e', '0'),
	array('762_478_e_comentario', '0'),
	array('478_visible', '0'),
	array('478_contaminated', '0'),
	array('478_foto', '1'),


	array('762_479_Respuesta_sino', '0'),
	array('762_479_a', '0'),
	array('762_479_b', '0'),
	array('762_479_c', '0'),
	array('762_479_d', '0'),
	array('762_479_e', '0'),
	array('762_479_e_comentario', '0'),
	array('479_visible', '0'),
	array('479_contaminated', '0'),
	array('479_foto', '1'),



	array('763_Respuesta', '0'),
    array('764_Comentario', '0'),

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
			 $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
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
header('Content-Disposition: attachment;filename="Alicorp_Estudio_10_53_Category_53.xlsx"');
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