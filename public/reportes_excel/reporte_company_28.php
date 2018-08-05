<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//ini_set('max_execution_time', 900);
//ini_set('memory_limit', '256M');
//set_time_limit(0);
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
            'rgb' => '000000'
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

//$query_detalle_puntos = "call sp_consulta_reporte_company_20_prueba";
$query_detalle_puntos = "call sp_consulta_reporte_company_28";
$resEmp = mysql_query($query_detalle_puntos, $conexion_db) or die(mysql_error());
$total_comercios = mysql_num_rows($resEmp);

/* Definen la Cabecera */
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3', 'Punto');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C3', 'Id');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('D3', 'Ruc');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('E3', 'Encuestado');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('F3', 'Distrito');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G3', 'Fecha');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('H3', 'Hora');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('I3', 'Auditor');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3', 'Foto');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B2', 'Punto');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('C2', 'Agente');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('G2', 'Día de Visita');

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8  + 2 , 2), ('1. Cliente Consumo masivo (id = 384)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9  + 2 , 2), ('2. Tipo de consumidor (id = 379)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13  + 2 , 2), ('3. Cuantas veces a la semana va al mercado (id = 380)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17  + 2 , 2), ('4. Ha visto las pantallas/televisores publicitarias en el cliente? (id = 381)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2 , 2), ('5. Que tipo de Publicidad recuerda haber visto en las pantallas  del cliente Mayorista (id = 382)') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2 , 2), ('6. El ver la publicidad en las pantallas influyó en su decisión de compra? (id = 383)') );



$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9  + 2, 3), ('Bodega') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10  + 2, 3), ('Mayorista') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11  + 2, 3), ('Consumidor Final') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12  + 2, 3), ('Otros') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13  + 2, 3), ('Todos los días') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14  + 2, 3), ('3 veces por semana') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15  + 2, 3), ('1 ves a la semana') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16  + 2, 3), ('menos de una vez a la semana') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2, 3), ('Muy agradable') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19  + 2, 3), ('Agradable') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20  + 2, 3), ('No le causa ninguna percepción') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21  + 2, 3), ('Desagradable') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2, 3), ('Comercial Suave Rindemax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, 3), ('Tecnología Smarcut') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, 3), ('Comercial Kotex Nocturna') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, 3), ('Empaque Kotex Nocturna') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, 3), ('Comercial Huggies Active Sec') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, 3), ('Comercial Kotex Normal') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, 3), ('Empaque Kotex Normal') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, 3), ('Tecnología Insta Centro') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, 3), ('Comercial Plenitud Active Fit') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, 3), ('Empaque Plenitud Active Fit') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, 3), ('Comercial Toallitas Humedas Huggies') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, 3), ('Tecnología de fibras naturales') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, 3), ('Empaque Active Fresh x48') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, 3), ('Empaque Suave Rindemax') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, 3), ('Empaque Huggies Active Sec') );

$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37  + 2, 3), ('Respuesta') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, 3), ('Le recordó que debe comprarlo') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, 3), ('Le inspiró confianza seguridad') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, 3), ('Le permitió conocer las variedades novedades') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, 3), ('Vió que eran productos de uso frecuente') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, 3), ('Le dio imagen a la marca') );
$objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, 3), ('Despertó curiosidad en probarlo') );

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('C2:F2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('G2:J2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('L2:O2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('P2:S2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('T2:X2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('Y2:AM2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AN2:AT2');

/* Aplica estilo a las cabeceras */
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B2:AT2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('B3:AT3')->applyFromArray($style_1);


/* Define el Ancho de las Celdas */
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




$contador_1 = 3;


/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

    $contador_1 ++;
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(1 , $contador_1), ($rowEmp['punto'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(2 , $contador_1), ($rowEmp['store_id'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(3 , $contador_1), $rowEmp['cadenaRuc']);
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(4 , $contador_1), ($rowEmp['encuestado'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(5 , $contador_1), ($rowEmp['district'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(6 , $contador_1), ($rowEmp['fecha'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(7 , $contador_1), ($rowEmp['hora'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 , $contador_1), ($rowEmp['auditor']."(".$rowEmp['auditor_id'].")" ));

    if (($rowEmp['Foto']) == null || ($rowEmp['Foto']) == "") {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9, $contador_1), '' );
    } else {
        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9, $contador_1), '=HYPERLINK( "'. ($rowEmp['Foto']) .'"  , "Foto" )' );
    }

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(8 + 2, $contador_1), ($rowEmp['384_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(9 + 2, $contador_1), ($rowEmp['379_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(10 + 2, $contador_1), ($rowEmp['379_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(11 + 2, $contador_1), ($rowEmp['379_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(12 + 2, $contador_1), ($rowEmp['379_c_otro'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(13 + 2, $contador_1), ($rowEmp['380_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(14 + 2, $contador_1), ($rowEmp['380_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(15 + 2, $contador_1), ($rowEmp['380_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(16 + 2, $contador_1), ($rowEmp['380_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(17 + 2, $contador_1), ($rowEmp['381_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(18  + 2, $contador_1), ($rowEmp['381_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(19  + 2, $contador_1), ($rowEmp['381_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(20  + 2, $contador_1), ($rowEmp['381_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(21  + 2, $contador_1), ($rowEmp['381_d'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(22  + 2, $contador_1), ($rowEmp['382_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(23  + 2, $contador_1), ($rowEmp['382_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(24  + 2, $contador_1), ($rowEmp['382_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(25  + 2, $contador_1), ($rowEmp['382_d'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(26  + 2, $contador_1), ($rowEmp['382_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(27  + 2, $contador_1), ($rowEmp['382_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(28  + 2, $contador_1), ($rowEmp['382_g'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(29  + 2, $contador_1), ($rowEmp['382_h'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(30  + 2, $contador_1), ($rowEmp['382_i'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(31  + 2, $contador_1), ($rowEmp['382_j'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(32  + 2, $contador_1), ($rowEmp['382_k'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(33  + 2, $contador_1), ($rowEmp['382_l'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(34  + 2, $contador_1), ($rowEmp['382_m'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(35  + 2, $contador_1), ($rowEmp['382_n'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(36  + 2, $contador_1), ($rowEmp['382_o'] ));

    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(37 + 2, $contador_1), ($rowEmp['383_Respuesta'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(38  + 2, $contador_1), ($rowEmp['383_a'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(39  + 2, $contador_1), ($rowEmp['383_b'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(40  + 2, $contador_1), ($rowEmp['383_c'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(41  + 2, $contador_1), ($rowEmp['383_e'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(42  + 2, $contador_1), ($rowEmp['383_f'] ));
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates(43  + 2, $contador_1), ($rowEmp['383_g'] ));


    $objPHPExcel->setActiveSheetIndex(1)->getStyle('B'.$contador_1.':C'.$contador_1)->applyFromArray($style_2);
    $objPHPExcel->setActiveSheetIndex(1)->getStyle('D'.$contador_1.':AT'.$contador_1)->applyFromArray($style_3);
}

$objPHPExcel->getActiveSheet()->setTitle('resumen');

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("REPORTE KCC")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="REPORTE_KCC_28.xlsx"');
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