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

$query_detalle_puntos = "call sp_reporte_company_38_category_53";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */


$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T2', 'Ganchera Salsas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AD2','Ganchera Frutísimos');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AN2','Portafiche Multicategoría');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AX2','Exhibidores Margarinas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BH2','Exhibidor Galletas');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BR2','Posavuelto Galletas');




/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('T2:AC2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AD2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:AW2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AX2:BG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BH2:BQ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BR2:CA2');




/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('T2:CA2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:CD3')->applyFromArray($style_1);


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

	'¿ Es cliente perfecto ?',
	'¿Desde cuando es cliente perfecto?',
	'¿Ha sido premiado por ser cliente perfecto?'
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
	array('508_Respuesta', '0'),
	array('508_Opciones', '0'),
	array('508_Foto', '1'),
	array('509_Respuesta', '0'),
	array('509_Opciones', '0'),
	array('509_Comentario', '0'),

	
	array('514_420_Respuesta_sino', '0'),
	array('514_420_a', '0'),
	array('514_420_b', '0'),
	array('514_420_c', '0'),
	array('514_420_d', '0'),
	array('514_420_e', '0'),
	array('514_420_e_comentario', '0'),
	array('420_visible', '0'),
	array('420_contaminated', '0'),
	array('420_foto', '1'),


	array('514_421_Respuesta_sino', '0'),
	array('514_421_a', '0'),
	array('514_421_b', '0'),
	array('514_421_c', '0'),
	array('514_421_d', '0'),
	array('514_421_e', '0'),
	array('514_421_e_comentario', '0'),
	array('421_visible', '0'),
	array('421_contaminated', '0'),
	array('421_foto', '1'),


	array('514_422_Respuesta_sino', '0'),
	array('514_422_a', '0'),
	array('514_422_b', '0'),
	array('514_422_c', '0'),
	array('514_422_d', '0'),
	array('514_422_e', '0'),
	array('514_422_e_comentario', '0'),
	array('422_visible', '0'),
	array('422_contaminated', '0'),
	array('422_foto', '1'),


	array('514_423_Respuesta_sino', '0'),
	array('514_423_a', '0'),
	array('514_423_b', '0'),
	array('514_423_c', '0'),
	array('514_423_d', '0'),
	array('514_423_e', '0'),
	array('514_423_e_comentario', '0'),
	array('423_visible', '0'),
	array('423_contaminated', '0'),
	array('423_foto', '1'),


	array('514_424_Respuesta_sino', '0'),
	array('514_424_a', '0'),
	array('514_424_b', '0'),
	array('514_424_c', '0'),
	array('514_424_d', '0'),
	array('514_424_e', '0'),
	array('514_424_e_comentario', '0'),
	array('424_visible', '0'),
	array('424_contaminated', '0'),
	array('424_foto', '1'),


	array('514_425_Respuesta_sino', '0'),
	array('514_425_a', '0'),
	array('514_425_b', '0'),
	array('514_425_c', '0'),
	array('514_425_d', '0'),
	array('514_425_e', '0'),
	array('514_425_e_comentario', '0'),
	array('425_visible', '0'),
	array('425_contaminated', '0'),
	array('425_foto', '1'),

	array('515_Respuesta', '0'),
    array('516_Comentario', '0'),
    array('517_Respuesta', '0'),
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
header('Content-Disposition: attachment;filename="Alicorp_Estudio_7_38_Category_53.xlsx"');
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