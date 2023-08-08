<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');
include("includes/configure.php");

$company_id=$_GET['company_id'];
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
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
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
			//'rgb' => 'FF0000'
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
			'rgb' => 'FF0000',
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

// SOLO BORDE TOP
$style_3 =  array(

	'borders' => array(
		'top' => array(
			'style' => PHPExcel_Style_Border::BORDER_DOUBLE,
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

$objPHPExcel->createSheet(NULL, 0);

/* Ejecuta el Store Procedure que tiene el resumen del reporte */
//mysql_query("call sp_reporte_dia_company_8", $conexion_db) or die(mysql_error());

//$query_detalle_puntos = "call sp_reporte_company_89";
$query_detalle_puntos = "call sp_alicorp_helena_v2(".$company_id.")";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
/* Definen la Cabecera */
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('S2' ,'Ventana Alacena'   );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('V2' ,'Ventana salsas Don Vittorio'   );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y2' ,'Ventana Refrescos (Negrita,Kanu,Frutisimos)'   );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AB2','Ventana postres Negrita'   );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE2','Cortina Alacena+Don Vittorio'   );
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('AH2','Cajonera Salsas,Refrescos y/o Postres'   );
/* Une las Celdas para la cabecera0*/
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('S2:U2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('V2:X2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('Y2:AA2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AB2:AD2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AE2:AG2');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('AH2:AJ2');
/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(0)->getStyle('S2:AJ2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(0)->getStyle('A3:AJ3')->applyFromArray($style_1);
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
$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setAutoSize(true);



$cabecera = array(
	'ID',
	'CANAL',
	'MERCADO',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
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
//
	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',

	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',

	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',

	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',

	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',

	'¿Existe Ventana?',
	'¿Cumple Visibilidad?',
	'Foto',


);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);
		
	$contador_columna_cabecera++;
}	

$campos = array(
	array('store_id', '0'),
	array('type', '0'),
	array('mercado', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('tipo_bodega', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('1_Respuesta', '0'),
	array('1_Opciones', '0'),
	array('1_Foto', '1'),

    array('2_Respuesta', '0'),
    array('2_Opciones', '0'),
    array('2_Comentario', '0'),

    array('3_1_Respuesta', '0'),
    array('4_1_Respuesta', '0'),
    array('3_1_Foto', '1'),


    array('3_2_Respuesta', '0'),
    array('4_2_Respuesta', '0'),
    array('3_2_Foto', '1'),

    array('3_3_Respuesta', '0'),
    array('4_3_Respuesta', '0'),
    array('3_3_Foto', '1'),

    array('3_4_Respuesta', '0'),
    array('4_4_Respuesta', '0'),
    array('3_4_Foto', '1'),

    array('3_5_Respuesta', '0'),
    array('4_5_Respuesta', '0'),
    array('3_5_Foto', '1'),

    array('3_6_Respuesta', '0'),
    array('4_6_Respuesta', '0'),
    array('3_6_Foto', '1'),

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
			 $objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		}

	$contador_columna++;
	}	
}

$objPHPExcel->getActiveSheet()->setAutoFilter('A3:AJ3'); //Auto Filter
$objPHPExcel->getActiveSheet()->setTitle('Visibilidad');




//-----------------------------------------------------------------------
//////////////////////////////////////////////////////////////////////////////
// Segunda sheet para galeria de fotos
//-----------------------------------------------------------------------
$objPHPExcel->createSheet(NULL, 1);
$objPHPExcel->setActiveSheetIndex(1)->setTitle('Presencia de Producto');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('S2'  ,'ALACENA mayonesa 100cc'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('T2'  ,'ALACENA mayonesa 500 cc'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('U2'  ,'ALACENA mayonesa light'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('V2'  ,'ALACENA ketchup'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('W2'  ,'ALACENA mostaza'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('X2'  ,'ALACENA Uchucuta'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Y2'  ,'ALACENA Tari'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('Z2'  ,'ALACENA salsa de rocoto'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AA2' ,'ALACENA huancaina'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2' ,'ALACENA salsa de tomate'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AC2' ,'DON VITTORIO salsa roja 200gr'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AD2' ,'DON VITTORIO salsa roja 400gr'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AE2' ,'NEGRITA gelatina'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AF2' ,'NEGRITA gelatina diet'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AG2' ,'NEGRITA mazamorra morada'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AH2' ,'NEGRITA mazamorra (durazno o piña)'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AI2' ,'FRUTISIMOS refrescos'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AJ2' ,'NEGRITA refrescos (sabores frutales)'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AK2' ,'NEGRITA refrescos (cebada o emoliente)'   );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AL2' ,'KANU refrescos'   );


$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(1)->getColumnDimension('L')->setAutoSize(true);

$objPHPExcel->setActiveSheetIndex(1)->getStyle('S2:AL2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:AL3')->applyFromArray($style_1);

$cabecera = array(
    'ID',
    'CANAL',
    'MERCADO',
    'COMERCIO',
    'DIRECCION',
    'DISTRITO',
    'REGION',
    'UBIGEO',
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
//
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
    'Respuesta',
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
    array('mercado', '0'),
    array('fullname', '0'),
    array('address', '0'),
    array('district', '0'),
    array('region', '0'),
    array('ubigeo', '0'),
    array('tipo_bodega', '0'),
    array('Auditor', '0'),
    array('fecha', '0'),
    array('hora', '0'),

    array('1_Respuesta', '0'),
    array('1_Opciones', '0'),
    array('1_Foto', '1'),

    array('2_Respuesta', '0'),
    array('2_Opciones', '0'),
    array('2_Comentario', '0'),

    array('3_1_Respuesta', '0'),
    array('3_2_Respuesta', '0'),
    array('3_3_Respuesta', '0'),
    array('3_4_Respuesta', '0'),
    array('3_5_Respuesta', '0'),
    array('3_6_Respuesta', '0'),
    array('3_7_Respuesta', '0'),
    array('3_8_Respuesta', '0'),
    array('3_9_Respuesta', '0'),
    array('3_10_Respuesta', '0'),
    array('3_11_Respuesta', '0'),
    array('3_12_Respuesta', '0'),
    array('3_13_Respuesta', '0'),
    array('3_14_Respuesta', '0'),
    array('3_15_Respuesta', '0'),
    array('3_16_Respuesta', '0'),
    array('3_17_Respuesta', '0'),
    array('3_18_Respuesta', '0'),
    array('3_19_Respuesta', '0'),
    array('3_20_Respuesta', '0'),
);


error_reporting(E_ALL ^ E_DEPRECATED);
mysql_close($conexion_db);
$conexion_db = mysql_connect("104.197.133.79", "root", "Fbrsjgfc09");
mysql_select_db("ttaudit_auditors", $conexion_db);

$query_detalle_premiados = "call sp_alicorp_helena_products_v2(".$company_id.")";
$resEmp = mysql_query($query_detalle_premiados, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
$contador_1 = 3;

$conatador_row = 3;
while ($rowEmp = mysql_fetch_assoc($resEmp)) {
    $contador_1 ++;
    $conatador_row ++ ;
    $contador_columna = 0;
    for ($row = 0; $row < count($campos) ; $row++) {
        $campo = $campos[$row][0];
        $tipo_campo = $campos[$row][1];

        if ($tipo_campo == "0") {
            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
        } else if ($tipo_campo == "1") {
            if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
            } else {
                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
            }
        }
        $contador_columna++;
    }
}



$objPHPExcel->getActiveSheet()->setAutoFilter('A3:AL3'); //Auto Filter

//--------------------------------------------------------------------------

//-----------------------------------------------------------------------
//////////////////////////////////////////////////////////////////////////////
// tercer sheet para Premiación
//-----------------------------------------------------------------------
$objPHPExcel->createSheet(NULL, 2);
$objPHPExcel->setActiveSheetIndex(2)->setTitle('Premiación');

$objPHPExcel->setActiveSheetIndex(2)->getStyle('A3:N3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */

$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->setActiveSheetIndex(2)->getColumnDimension('N')->setAutoSize(true);


$cabecera = array(
	'ID',
	'CANAL',
	'MERCADO',
	'COMERCIO',
	'DIRECCION',
	'DISTRITO',
	'REGION',
	'UBIGEO',
	'TIPO DE BODEGA',
	'AUDITOR',
	'FECHA',
	'HORA',

	'¿ Cliente Aceptó Premio ?',
	'FOTO',

);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
	$valor = $cabecera[$row];
	$objPHPExcel->setActiveSheetIndex(2)->setCellValue(coordinates($contador_columna_cabecera , 3), $valor);

	$contador_columna_cabecera++;
}


$campos = array(
	array('store_id', '0'),
	array('type', '0'),
	array('mercado', '0'),
	array('fullname', '0'),
	array('address', '0'),
	array('district', '0'),
	array('region', '0'),
	array('ubigeo', '0'),
	array('tipo_bodega', '0'),
	array('Auditor', '0'),
	array('fecha', '0'),
	array('hora', '0'),

	array('1_Respuesta', '0'),
	array('1_Foto', '1'),

);

error_reporting(E_ALL ^ E_DEPRECATED);
mysql_close($conexion_db);
$conexion_db = mysql_connect("104.197.133.79", "root", "Fbrsjgfc09");
mysql_select_db("ttaudit_auditors", $conexion_db);

$query_detalle_premiados = "call sp_alicorp_helena_premiados_v2(".$company_id.")";
$resEmp = mysql_query($query_detalle_premiados, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);
$contador_1 = 3;

$conatador_row = 3;
while ($rowEmp = mysql_fetch_assoc($resEmp)) {
	$contador_1 ++;
	$conatador_row ++ ;
	$contador_columna = 0;
	for ($row = 0; $row < count($campos) ; $row++) {
		$campo = $campos[$row][0];
		$tipo_campo = $campos[$row][1];

		if ($tipo_campo == "0") {
			$objPHPExcel->setActiveSheetIndex(2)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
		} else if ($tipo_campo == "1") {
			if ($rowEmp[$campo] == null || $rowEmp[$campo]   == "") {
				$objPHPExcel->setActiveSheetIndex(2)->setCellValue(coordinates($contador_columna , $contador_1), '' );
			} else {
				$objPHPExcel->setActiveSheetIndex(2)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. utf8_encode($rowEmp[$campo]) .'"  , "Foto" )' );
			}
		}
		$contador_columna++;
	}
}
$objPHPExcel->getActiveSheet()->setAutoFilter('A3:N3'); //Auto Filter


//--------------------------------------------------------------------------
// Activando la primera hoja
$objPHPExcel->setActiveSheetIndex(0);


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
header('Content-Disposition: attachment;filename="Alicorp_Mayorista.xlsx"');
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