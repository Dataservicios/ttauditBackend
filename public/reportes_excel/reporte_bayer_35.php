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

$objPHPExcel->setActiveSheetIndex(1)->setCellValue('K2', 'Prioridades de APRONAX');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AB2', 'Prioridades de ASPIRINA FORTE');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('AS2', 'Prioridades de REDOXON');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('BL2', 'Prioridades de BEROCCA + SUPRADYN ');

/* Une las Celdas para la cabecera */

$objPHPExcel->setActiveSheetIndex(1)->mergeCells('K2:AA2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AB2:AR2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('AS2:BK2');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('BL2:CC2');


/* Aplica estilo a las cabeceras */

$objPHPExcel->setActiveSheetIndex(1)->getStyle('K2:CC2')->applyFromArray($style);
$objPHPExcel->setActiveSheetIndex(1)->getStyle('A3:CC3')->applyFromArray($style_1);


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
    'ESTUDIO',
    'REP',
    'CANAL',
    'RUC',
    'UBIGEO',
    'REGION',
    'DISTRITO',
    'COMERCIO',
    'DIRECCION',

    'Apronax',
    'Dologyna',
    'Iraxen',
    'Sanaprox',
    'Maxiflam Forte',
    'Dolocordralan Extra Fuerte',
    'Doloflam Extra Fuerte',
    'Naproxeno',//
    'Miopress Forte',
    'Miodel',
    'Dolgramin',
    'Breflex',
    'Doloaproxol',
    'Dioxaflex',
    'Flogodistan',//
    'Otros',
    'Comentario',

    'Aspirina Forte',
    'Dolofac',
    'Mifralivio x 100',
    'Migrapac x 30',
    'Panadol',
    'Panadol Forte',
    'Kitadol',
    'Acido Acetilsalicilico',//
    'Dolgramin',//484_534_bk_priority
    'Cefadol',//484_644_cr_priority
    'Digravin',//484_644_cs_priority
    'Migralivia',//484_644_ct_priority
    'Migrax',//484_644_cu_priority
    'Migrodoroxina',//484_644_cv_priority
    'Migratapcin',//484_644_cw_priority
    'Otros',
    'comentario',


    'Redoxon',
    'Mi vic',
    'Redoxin Tobo',
    'Efervit -C',
    'Redo-C',
    'Vitamina C Genfar',
    'Crevet',
    'Cebion',//
    'Easylife',//484_539_dh_priority
    'Sunlife',//484_539_di_priority
    'Efer-C',//484_539_dj_priority
    'Redoxvit',//484_539_dk_priority
    'Easy Vit C',//484_539_dl_priority
    'Redomax',//484_539_dm_priority
    'Redozinc',//484_539_dn_priority
    'Vitamina C',//484_539_do_priority
    'Sunvit',//484_539_dp_priority
    'Otros',
    'Comentario',


    'Berocca/Supradyn',
    'Oramin',
    'Multidayli',
    'Nutrastres',
    'Energy Forte',
    'Ceregen chico',
    'Viramine stress',
    'Stress formula-Mason',
    'Ca+Mg+Zn-Pharmatech',//
    'Infor',//484_645_da_priority
    'Vitaenergy',//484_645_db_priority
    'Vitathon',//484_645_dc_priority
    'Centrum',//484_645_de_priority
    'Centrum Silver',//484_645_df_priority
    'Pharmaton',//484_645_dg_priority
    'Biocord',//484_645_dq_priority
    'Otros',
    'Comentario',
);

$contador_columna_cabecera = 0;
for ($row = 0; $row < count($cabecera) ; $row++) {
    $valor = $cabecera[$row];
    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna_cabecera , 3), utf8_encode($valor ));

    $contador_columna_cabecera++;
}

$campos = array(
    array('store_id','0') ,
    array('','2') ,
    array('ejecutivo','0') ,
    array('type','0') ,
    array('cadenaRuc','0') ,
    array('ubigeo','0') ,
    array('region','0') ,
    array('district','0') ,
    array('fullname','0') ,
    array('address','0') ,

// Apronax

    array('484_534_a_priority','0') ,
    array('484_534_b_priority','0') ,
    array('484_534_c_priority','0') ,
    array('484_534_d_priority','0') ,
    array('484_534_e_priority','0') ,
    array('484_534_f_priority','0') ,
    array('484_534_g_priority','0') ,
    array('484_534_h_priority','0') ,
    array('484_534_bi_priority','0') ,
    array('484_534_bj_priority','0') ,
    array('484_534_bk_priority','0') ,
    array('484_534_bl_priority','0') ,
    array('484_534_bm_priority','0') ,
    array('484_534_bn_priority','0') ,
    array('484_534_bo_priority','0') ,
    array('484_534_ai_priority','0') ,


    array('484_534_comentario_otros','1') ,

//Aspirina Forte
    array('484_644_p_priority','0') ,
    array('484_644_i_priority','0') ,
    array('484_644_j_priority','0') ,
    array('484_644_k_priority','0') ,
    array('484_644_l_priority','0') ,
    array('484_644_m_priority','0') ,
    array('484_644_n_priority','0') ,
    array('484_644_o_priority','0') ,
    array('484_644_cq_priority','0') ,
    array('484_644_cr_priority','0') ,
    array('484_644_cs_priority','0') ,
    array('484_644_ct_priority','0') ,
    array('484_644_cu_priority','0') ,
    array('484_644_cv_priority','0') ,
    array('484_644_cw_priority','0') ,

    array('484_644_ai_priority','0') ,
    array('484_644_comentario_otros','1') ,

//Redoxon
    array('484_539_q_priority','0') ,
    array('484_539_r_priority','0') ,
    array('484_539_s_priority','0') ,
    array('484_539_t_priority','0') ,
    array('484_539_u_priority','0') ,
    array('484_539_w_priority','0') ,
    array('484_539_x_priority','0') ,
    array('484_539_y_priority','0') ,
    array('484_539_dh_priority','0') ,
    array('484_539_di_priority','0') ,
    array('484_539_dj_priority','0') ,
    array('484_539_dk_priority','0') ,
    array('484_539_dl_priority','0') ,
    array('484_539_dm_priority','0') ,
    array('484_539_dn_priority','0') ,
    array('484_539_do_priority','0') ,
    array('484_539_dp_priority','0') ,

    array('484_539_ai_priority','0') ,
    array('484_539_comentario_otros','1') ,

//Berocca + Supradiyn
    array('484_645_z_priority','0') ,
    array('484_645_aa_priority','0') ,
    array('484_645_ab_priority','0') ,
    array('484_645_ac_priority','0') ,
    array('484_645_ad_priority','0') ,
    array('484_645_ae_priority','0') ,
    array('484_645_af_priority','0') ,
    array('484_645_ag_priority','0') ,
    array('484_645_ah_priority','0') ,
    array('484_645_da_priority','0') ,
    array('484_645_db_priority','0') ,
    array('484_645_dc_priority','0') ,
    array('484_645_de_priority','0') ,
    array('484_645_df_priority','0') ,
    array('484_645_dg_priority','0') ,
    array('484_645_dq_priority','0') ,

    array('484_645_ai_priority','0'),
    array('484_645_comentario_otros','1') ,
);



$contador_1 = 3;
/* Llenamos el detalle del reporte */
while ($rowEmp = mysql_fetch_assoc($resEmp)) {

    //$rowEmp['441_Respuesta'] == 2   verifica solo los puntos abiertos
    if($rowEmp['481_Respuesta'] == 2) {

        $contador_1 ++;
        $contador_columna = 0;
        for ($row = 0; $row < count($campos) ; $row++) {
            $campo = $campos[$row][0];
            $tipo_campo = $campos[$row][1];
            if ($tipo_campo == "0") {
                if ($rowEmp[$campo]  == null || $rowEmp[$campo]  == "") {
                    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '0' );
                }else{
                    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
                }

            } else {
                if ($tipo_campo == "1") {
                    $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), utf8_encode($rowEmp[$campo]) );
                }else{
                    if ($tipo_campo == "3") {
                        $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), $campo);
                    }else{
                        if ($tipo_campo == "2") {
                            $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), 'Estudio 2Q AGOSTO' );
                        }else{
                            if ($rowEmp[$campo]  == null || $rowEmp[$campo]  == "") {
                                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '' );
                            } else {
                                $objPHPExcel->setActiveSheetIndex(1)->setCellValue(coordinates($contador_columna , $contador_1), '=HYPERLINK( "'. $rowEmp[$campo] .'"  , "Foto" )' );
                            }
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


// Redirect output to a clients web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

//header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Content-Disposition: attachment;filename="Reporte_Bayer_35.xlsx"');
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