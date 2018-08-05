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

$query_detalle_puntos = "call sp_reporte_company_15_plazavea";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M2', utf8_encode('Cabecera'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2', utf8_encode('Lateral'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y2', utf8_encode('Ruma'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AE2', utf8_encode('Mesa de Carga'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2', utf8_encode('Muro de Valor'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AQ2', utf8_encode('Cabecera Fija'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AW2', utf8_encode('Cabecera'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BC2', utf8_encode('Lateral'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BI2', utf8_encode('Ruma'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BO2', utf8_encode('Chimenea'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BU2', utf8_encode('Venta Cruzada'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CA2', utf8_encode('Ganchera'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CG2', utf8_encode('Mesa de Carga'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CM2', utf8_encode('Muro de Valor'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CS2', utf8_encode('Punto de Caja'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CY2', utf8_encode('Don Vittorio - Largos y cortos 500gr - 16% Descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DB2', utf8_encode('Capri Envasado - 3x2 Capri 1lt - 3x2'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DE2', utf8_encode('Alacena - Descuento Precio en todo Alacena - 25% de descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DH2', utf8_encode('Bolivar - Descuento precio 2.85lt - 30% Descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DK2', utf8_encode('Papas Cocinero - Papas Cocinero - Rebaja'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DN2', utf8_encode('Margaritas Sayon - MM Todo Margarita 3x2 - 3X2'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DQ2', utf8_encode('Victoria - MM Todo victoria 3x2 - 3X2'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DT2', utf8_encode('Bolivar -  Todo Bolivar 4.5kg - 33% de descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DW2', utf8_encode('Opal -  Todo Opal 4.5kg 2 en 1 (BATEAS por la compra de opal 2 en 1 4.5kg llevate gratis una batea) - 33% de descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('DZ2', utf8_encode('Bolivar Liquido - Descuento Todo Liquido 1.9lt - 33% de descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EC2', utf8_encode('Opal Liquido -  Todo Opal Liquido 1.9lt - 33% de descuento'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EF2', utf8_encode('Opal -  Todo Opal 2.6Kg - 33% de descuento'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EI2', utf8_encode('Ventana Detergentes'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EK2', utf8_encode('Ventana Aceites'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EM2', utf8_encode('Ventana Galletas'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EO2', utf8_encode('Ventana Pastas'));

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('M1', utf8_encode('Exhibiciones Programadas'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AW1', utf8_encode('Exhibiciones Adicionales'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('CY1', utf8_encode('Carteleria Promociones'));
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('EI1', utf8_encode('SOD Ventanas'));



/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('M1:AV1');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AW1:CX1');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CY1:EH1');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EI1:EP1');


$objPHPExcel->setActiveSheetIndex(1)->mergeCells('M2:R2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('S2:X2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Y2:AD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AE2:AJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AK2:AP2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AQ2:AV2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AW2:BB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BC2:BH2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BI2:BN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BO2:BT2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BU2:BZ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CA2:CF2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CG2:CL2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CM2:CR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CS2:CX2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('CY2:DA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DB2:DD2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DE2:DG2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DH2:DJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DK2:DM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DN2:DP2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DQ2:DS2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DT2:DV2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DW2:DY2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('DZ2:EB2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EC2:EE2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EF2:EH2');

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EI2:EJ2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EK2:EL2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EM2:EN2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('EO2:EP2');





/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('M1:EP1')->applyFromArray($style_1);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('M2:EP2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:EP3')->applyFromArray($style_1);


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
	'AUDITOR',
	'FECHA',
	'HORA',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',
	'Categoria',
	'Marca',
	'Se encontro',
	'Carteleria',
	'Contaminada',
	'Foto',

	'Se encontro',
	'Comunicacion correcta',
	'Foto',

	'Se encontro',
	'Comunicacion correcta',
	'Foto',

	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'Se encontro',
	'Comunicacion correcta',
	'Foto',
	'%SoD',
	'Foto',
	'%SoD',
	'Foto',
	'%SoD',
	'Foto',
	'%SoD',
	'Foto'
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), utf8_encode($valor ));
		
	$contador_columna_cabecera++;
}	



	
$campos = array(
	array('store_id', '0'),
	array('cadenaRuc', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('latitude', '0'),
	array('longitude', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),
	array('exhibicion_programada_cabecera_categoria', '0'),
	array('exhibicion_programada_cabecera_marca', '0'),
	array('exhibicion_programada_cabecera_encontro', '0'),
	array('exhibicion_programada_cabecera_carteleria', '0'),
	array('exhibicion_programada_cabecera_contaminated', '0'),
	array('exhibicion_programada_cabecera_foto', '1'),
	array('exhibicion_programada_lateral_categoria', '0'),
	array('exhibicion_programada_lateral_marca', '0'),
	array('exhibicion_programada_lateral_encontro', '0'),
	array('exhibicion_programada_lateral_carteleria', '0'),
	array('exhibicion_programada_lateral_contaminated', '0'),
	array('exhibicion_programada_lateral_foto', '1'),
	array('exhibicion_programada_ruma_categoria', '0'),
	array('exhibicion_programada_ruma_marca', '0'),
	array('exhibicion_programada_ruma_encontro', '0'),
	array('exhibicion_programada_ruma_carteleria', '0'),
	array('exhibicion_programada_ruma_contaminated', '0'),
	array('exhibicion_programada_ruma_foto', '1'),
	array('exhibicion_programada_mesacarga_categoria', '0'),
	array('exhibicion_programada_mesacarga_marca', '0'),
	array('exhibicion_programada_mesacarga_encontro', '0'),
	array('exhibicion_programada_mesacarga_carteleria', '0'),
	array('exhibicion_programada_mesacarga_contaminated', '0'),
	array('exhibicion_programada_mesacarga_foto', '1'),
	array('exhibicion_programada_murovalor_categoria', '0'),
	array('exhibicion_programada_murovalor_marca', '0'),
	array('exhibicion_programada_murovalor_encontro', '0'),
	array('exhibicion_programada_murovalor_carteleria', '0'),
	array('exhibicion_programada_murovalor_contaminated', '0'),
	array('exhibicion_programada_murovalor_foto', '1'),
	array('exhibicion_programada_cabecerafija_categoria', '0'),
	array('exhibicion_programada_cabecerafija_marca', '0'),
	array('exhibicion_programada_cabecerafija_encontro', '0'),
	array('exhibicion_programada_cabecerafija_carteleria', '0'),
	array('exhibicion_programada_cabecerafija_contaminated', '0'),
	array('exhibicion_programada_cabecerafija_foto', '1'),
	array('exhibicion_adicional_cabecera_categoria', '0'),
	array('exhibicion_adicional_cabecera_marca', '0'),
	array('exhibicion_adicional_cabecera_encontro', '0'),
	array('exhibicion_adicional_cabecera_carteleria', '0'),
	array('exhibicion_adicional_cabecera_contaminated', '0'),
	array('exhibicion_adicional_cabecera_marca', '0'),
	array('exhibicion_adicional_lateral_categoria', '0'),
	array('exhibicion_adicional_lateral_marca', '0'),
	array('exhibicion_adicional_lateral_encontro', '0'),
	array('exhibicion_adicional_lateral_carteleria', '0'),
	array('exhibicion_adicional_lateral_contaminated', '0'),
	array('exhibicion_adicional_lateral_foto', '1'),
	array('exhibicion_adicional_ruma_categoria', '0'),
	array('exhibicion_adicional_ruma_marca', '0'),
	array('exhibicion_adicional_ruma_encontro', '0'),
	array('exhibicion_adicional_ruma_carteleria', '0'),
	array('exhibicion_adicional_ruma_contaminated', '0'),
	array('exhibicion_adicional_ruma_foto', '1'),
	array('exhibicion_adicional_chimenea_categoria', '0'),
	array('exhibicion_adicional_chimenea_marca', '0'),
	array('exhibicion_adicional_chimenea_encontro', '0'),
	array('exhibicion_adicional_chimenea_carteleria', '0'),
	array('exhibicion_adicional_chimenea_contaminated', '0'),
	array('exhibicion_adicional_chimenea_foto', '1'),
	array('exhibicion_adicional_ventacruzada_categoria', '0'),
	array('exhibicion_adicional_ventacruzada_marca', '0'),
	array('exhibicion_adicional_ventacruzada_encontro', '0'),
	array('exhibicion_adicional_ventacruzada_carteleria', '0'),
	array('exhibicion_adicional_ventacruzada_contaminated', '0'),
	array('exhibicion_adicional_ventacruzada_foto', '1'),
	array('exhibicion_adicional_ganchera_categoria', '0'),
	array('exhibicion_adicional_ganchera_marca', '0'),
	array('exhibicion_adicional_ganchera_encontro', '0'),
	array('exhibicion_adicional_ganchera_carteleria', '0'),
	array('exhibicion_adicional_ganchera_contaminated', '0'),
	array('exhibicion_adicional_ganchera_foto', '1'),
	array('exhibicion_adicional_mesacarga_categoria', '0'),
	array('exhibicion_adicional_mesacarga_marca', '0'),
	array('exhibicion_adicional_mesacarga_encontro', '0'),
	array('exhibicion_adicional_mesacarga_carteleria', '0'),
	array('exhibicion_adicional_mesacarga_contaminated', '0'),
	array('exhibicion_adicional_mesacarga_foto', '1'),
	array('exhibicion_adicional_murovalor_categoria', '0'),
	array('exhibicion_adicional_murovalor_marca', '0'),
	array('exhibicion_adicional_murovalor_encontro', '0'),
	array('exhibicion_adicional_murovalor_carteleria', '0'),
	array('exhibicion_adicional_murovalor_contaminated', '0'),
	array('exhibicion_adicional_murovalor_foto', '1'),
	array('exhibicion_adicional_puntocaja_categoria', '0'),
	array('exhibicion_adicional_puntocaja_marca', '0'),
	array('exhibicion_adicional_puntocaja_encontro', '0'),
	array('exhibicion_adicional_puntocaja_carteleria', '0'),
	array('exhibicion_adicional_puntocaja_contaminated', '0'),
	array('exhibicion_adicional_puntocaja_foto', '1'),
	
	array('promociones_publicity_308_result', '0'),
	array('promociones_publicity_308_comunicacion', '0'),
	array('promociones_publicity_308_foto', '1'),

	array('promociones_publicity_309_result', '0'),
	array('promociones_publicity_309_comunicacion', '0'),
	array('promociones_publicity_309_foto', '1'),

	array('promociones_publicity_310_result', '0'),
	array('promociones_publicity_310_comunicacion', '0'),
	array('promociones_publicity_310_foto', '1'),

	array('promociones_publicity_311_result', '0'),
	array('promociones_publicity_311_comunicacion', '0'),
	array('promociones_publicity_311_foto', '1'),

	array('promociones_publicity_312_result', '0'),
	array('promociones_publicity_312_comunicacion', '0'),
	array('promociones_publicity_312_foto', '1'),

	array('promociones_publicity_313_result', '0'),
	array('promociones_publicity_313_comunicacion', '0'),
	array('promociones_publicity_313_foto', '1'),

	array('promociones_publicity_314_result', '0'),
	array('promociones_publicity_314_comunicacion', '0'),
	array('promociones_publicity_314_foto', '1'),

	array('promociones_publicity_315_result', '0'),
	array('promociones_publicity_315_comunicacion', '0'),
	array('promociones_publicity_315_foto', '1'),

	array('promociones_publicity_316_result', '0'),
	array('promociones_publicity_316_comunicacion', '0'),
	array('promociones_publicity_316_foto', '1'),

	array('promociones_publicity_317_result', '0'),
	array('promociones_publicity_317_comunicacion', '0'),
	array('promociones_publicity_317_foto', '1'),

	array('promociones_publicity_318_result', '0'),
	array('promociones_publicity_318_comunicacion', '0'),
	array('promociones_publicity_318_foto', '1'),

	array('promociones_publicity_319_result', '0'),
	array('promociones_publicity_319_comunicacion', '0'),
	array('promociones_publicity_319_foto', '1'),

	array('28_sod', '0'),
	array('28_foto', '1'),
	array('29_sod', '0'),
	array('29_foto', '1'),
	array('30_sod', '0'),
	array('30_foto', '1'),
	array('31_sod', '0'),
	array('31_foto', '1')
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
			 $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo] ));
		} else {
			if (utf8_encode($rowEmp[$campo] ) == null || utf8_encode($rowEmp[$campo]  ) == "") {
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


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_FINAL_COMPANY_15_Plaza_Vea.xlsx"');
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