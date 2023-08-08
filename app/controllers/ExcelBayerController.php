<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 5/07/2017
 * Time: 06:01
 */
use Maatwebsite\Excel\Facades\Excel;

class ExcelBayerController extends BaseController {


    private $company_id;

    public function index()
    {

    }


    public function productsPriceCompetity79()
    {

        Excel::create('Bayer precio competencia 79', function($excel) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Precio Competencia 1', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_67_68_69_70_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Apronax 550mg",
                    "Apronax 275mg",
                    "Dolocordralan Extra Fuerte 50 mg",
                    "Doloflam Extra Fuerte 400mg",
                    "Miodel Relax",
                    "Miopress Forte",
                    "Iraxen 550mg",
                    "Dolgramin",
                    "Dologina 550mg",
                    "Breflex ST (200mg/35mg)",
                    "Flogodisten",
                    "Dioxaflex",
                    "Comentario",

                    "Aspirina Forte",
                    "Aspirina 500 mg",
                    "Panadol 500 mg",
                    "Panadol Forte 500mg",
                    "Kitadol 500g Migraña",
                    "Migralivia",
                    "Cefadol",
                    "Digravin",
                    "Migrax",
                    "Comentario",

                    "Aspirina 100",
                    "ASSA-81 X 100mg",
                    "Cor-Asa 100mg",
                    "Cardioaspirina EC 100mg",
                    "Ecotrin 100mg",
                    "Comentario",

                    "Berocca plus x 30",
                    "Berocca Plus x 10 comp eferv",
                    "Supradyn cápsulas x 30",
                    "Supradyn Comp. Efervescente x 10",
                    "Ceregen x 325 ml",
                    "Ceregen x 180 ml",
                    "Vitathon Capsula Blanda x35",
                    "Pharmaton cápsulas x30",
                    "Centrum Tabletas x 30",
                    "Centrum Silver tabletas x 30",
                    "Sunvit Multidaily",
                    "Infor",
                    "Multifort",
                    "Biocord",
                    "Comentario"

                    );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:BM'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Precio Competencia 2', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_71_72_73_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Redoxon Doble acción x 3 tubos x 10",
                    "Sunlife",
                    "RedoxVit",
                    "Mi Vit",
                    "Vitamina C Genfar Tab. Mast 500 mg x 144",
                    "Easylife",
                    "Efer-C caja x 3 Sachets x12",
                    "Redomax",
                    "Comentario",

                    "Supradyn Pronatal Tab x 30",
                    "Vi-Syneral Pronatal Tab x 30",
                    "Natele cap blanda x 28",
                    "Maddre DSS caja x 30 Tab",
                    "Gestavit dha caps x 30",
                    "Comentario",

                    "Bepanthen crema x 30 gr",
                    "Bepanthen Crema x 100 g",
                    "Mucovit x 30 gr x 1",
                    "Aquasol A  30 G",
                    "Dermafar",
                    "Cicatricure",
                    "Apipol Ungüento",
                    "Regenerum",
                    "Bepanthen Ungüento 30G",
                    "Hipoglos Pomada 35 G",
                    "Desitin",
                    "Canesten 30G",
                    "Hongocid ungüento x 15 gr",
                    "Lamisil crema x 1%",
                    "Lafitil",
                    "Silka Medic",
                    "Icaden",
                    "Gyno-Canesten Cap vag +apl 500 mg",
                    "Volusol crema vag 2% x 15 gr",
                    "Femstat ovulos x 100 mg x 3",
                    "Desitin 57G",
                    "Desitin 113G",
                    "Zaidman Pote 100G",
                    "Simond´s 60G",
                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:BB'.count($data));
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
            });
        })->export('xls');
    }

    public function productsPriceCompetityAll79()
    {

        Excel::create('Bayer precio competencia 79', function($excel) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Dolor de Cuerpo', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_67_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Apronax 550mg",
                    "Apronax 275mg",
                    "Dolocordralan Extra Fuerte 50 mg",
                    "Doloflam Extra Fuerte 400mg",
                    "Miodel Relax",
                    "Miopress Forte",
                    "Iraxen 550mg",
                    "Dolgramin",
                    "Dologina 550mg",
                    "Breflex ST (200mg/35mg)",
                    "Flogodisten",
                    "Dioxaflex",
                    "Comentario",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

//                $sheet->setColumnFormat(array(
//                    'V' => '0.00',
//                    'W' => '0.00',
//                    'X' =>  \PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00,
//                ));

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//
//                   // $sheet->setCellValueExplicitByColumnAndRow(22, $i + 4, $sheet->getCell('V' . ($i + 4))->getValue(), \PHPExcel_Cell_DataType::TYPE_NUMERIC);
//                    //$sheet->setCellValueExplicitByColumnAndRow(23, $i + 4, $sheet->getCell('W' . ($i + 4))->getValue(), \PHPExcel_Cell_DataType::TYPE_NUMERIC);
////                    $sheet->setCellValueExplicit('V' . ($i + 4), $sheet->getCell('V' . ($i + 4))->getValue(), \PHPExcel_Cell_DataType::TYPE_NUMERIC);
////                    $sheet->setCellValueExplicit('W' . ($i + 4), $sheet->getCell('W' . ($i + 4))->getValue(), \PHPExcel_Cell_DataType::TYPE_NUMERIC);
////                    $sheet->setCellValueExplicit('X' . ($i + 4), $sheet->getCell('V' . ($i + 4))->getValue(), \PHPExcel_Cell_DataType::TYPE_NUMERIC);
////                    $sheet->getStyle('V' . ($i + 4))->getNumberFormat()->setFormatCode('###,###,###.##');
////                    $sheet->getStyle('W' . ($i + 4))->getNumberFormat()->setFormatCode('###,###,###.##');
////                    $sheet->getStyle('X' . ($i + 4))->getNumberFormat()->setFormatCode('###,###,###.##');
//
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                //$sheet->setAutoFilter('A4:AY'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

//                $sheet->mergeCells('O3:R3');
//
//                $sheet->cell('O3', function($cell) {
//                    $cell->setValue('¿ Se encuentra abierto el punto ?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('thin','thin','thin','thin');
//                });
//                $sheet->mergeCells('S3:U3');
//                $sheet->cell('S3', function($cell) {
//                    $cell->setValue('¿ Cliente Permitio tomar información ?');
//                    $cell->setFontColor('#fefffe');
//                    $cell->setAlignment('center');
//                    $cell->setBackground('#0e5a97');
//                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });

            });
            $excel->sheet('Dolor de Cabeza', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_68_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Aspirina Forte",
                    "Aspirina 500 mg",
                    "Panadol 500 mg",
                    "Panadol Forte 500mg",
                    "Kitadol 500g Migraña",
                    "Migralivia",
                    "Cefadol",
                    "Digravin",
                    "Migrax",
                    "Comentario",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
               // $sheet->setAutoFilter('A4:AE'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Cardio', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_69_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",

                    "AUDITOR",
                    "FECHA",
                    "HORA",

//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Aspirina 100",
                    "ASSA-81 X 100mg",
                    "Cor-Asa 100mg",
                    "Cardioaspirina EC 100mg",
                    "Ecotrin 100mg",
                    "Comentario",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
               // $sheet->setAutoFilter('A4:AA'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Multivitaminico', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_70_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Berocca plus x 30",
                    "Berocca Plus x 10 comp eferv",
                    "Supradyn cápsulas x 30",
                    "Supradyn Comp. Efervescente x 10",
                    "Ceregen x 325 ml",
                    "Ceregen x 180 ml",
                    "Vitathon Capsula Blanda x35",
                    "Pharmaton cápsulas x30",
                    "Centrum Tabletas x 30",
                    "Centrum Silver tabletas x 30",
                    "Sunvit Multidaily",
                    "Infor",
                    "Multifort",
                    "Biocord",
                    "Comentario"

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                //$sheet->setAutoFilter('A4:AJ'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitamina C', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_71_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Redoxon Doble acción x 3 tubos x 10",
                    "Sunlife",
                    "RedoxVit",
                    "Mi Vit",
                    "Vitamina C Genfar Tab. Mast 500 mg x 144",
                    "Easylife",
                    "Efer-C caja x 3 Sachets x12",
                    "Redomax",
                    "Comentario",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                //$sheet->setAutoFilter('A4:AD'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitaminas Pronatales', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_72_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Supradyn Pronatal Tab x 30",
                    "Vi-Syneral Pronatal Tab x 30",
                    "Natele cap blanda x 28",
                    "Maddre DSS caja x 30 Tab",
                    "Gestavit dha caps x 30",
                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
               // $sheet->setAutoFilter('A4:AA'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

//                $sheet->cell('O3', function($cell) {
//                    $cell->setValue('¿ Se encuentra abierto el punto ?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('thin','thin','thin','thin');
//                });
//                $sheet->mergeCells('S3:U3');
//                $sheet->cell('S3', function($cell) {
//                    $cell->setValue('¿ Cliente Permitio tomar información ?');
//                    $cell->setFontColor('#fefffe');
//                    $cell->setAlignment('center');
//                    $cell->setBackground('#0e5a97');
//                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Derma', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_73_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
//                    "LATITUD",
//                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",
//                    "Foto",
//                    "Respuesta",
//                    "Opciones",
//                    "Comentario",

                    "Bepanthen crema x 30 gr",
                    "Bepanthen Crema x 100 g",
                    "Mucovit x 30 gr x 1",
                    "Aquasol A  30 G",
                    "Dermafar",
                    "Cicatricure",
                    "Apipol Ungüento",
                    "Regenerum",
                    "Bepanthen Ungüento 30G",
                    "Hipoglos Pomada 35 G",
                    "Desitin",
                    "Canesten 30G",
                    "Hongocid ungüento x 15 gr",
                    "Lamisil crema x 1%",
                    "Lafitil",
                    "Silka Medic",
                    "Icaden",
                    "Gyno-Canesten Cap vag +apl 500 mg",
                    "Volusol crema vag 2% x 15 gr",
                    "Femstat ovulos x 100 mg x 3",
                    "Desitin 57G",
                    "Desitin 113G",
                    "Zaidman Pote 100G",
                    "Simond´s 60G",
                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);


                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                //$sheet->setAutoFilter('A4:AT'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

//                $sheet->cell('O3', function($cell) {
//                    $cell->setValue('¿ Se encuentra abierto el punto ?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('thin','thin','thin','thin');
//                });
//                $sheet->mergeCells('S3:U3');
//                $sheet->cell('S3', function($cell) {
//                    $cell->setValue('¿ Cliente Permitio tomar información ?');
//                    $cell->setFontColor('#fefffe');
//                    $cell->setAlignment('center');
//                    $cell->setBackground('#0e5a97');
//                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
        })->export('xls');

    }


    public function productsPriceCompetityAll($company_id) {

        Excel::create('Bayer precio competencia', function($excel) use ($company_id) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Dolor de Cuerpo', function($sheet) use ($company_id) {
               // $sqlcoord="CALL sp_price_prod_comp_cat_67_comp_79";
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",67)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Apronax 550mg",
                    "Apronax 275mg",
                    "Dolocordralan Extra Fuerte 50 mg",
                    "Doloflam Extra Fuerte 400mg",
                    "Miodel Relax",
                    "Miopress Forte",
                    "Iraxen 550mg",
                    "Dolgramin",
                    "Dologina 550mg",
                    "Breflex ST (200mg/35mg)",
                    "Flogodisten",
                    "Dioxaflex",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:Y'.(count($data)+4));
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('A'.(count($data)+4).':Y'.(count($data)+4), function($cells) {
                    $cells->setBorder('none','none','double','none');
                });

                // CALCULOS CON FORMULAS
//                $sheet->setCellValue('L'.(count($data)+5),'PROMEDIO');
//                $sheet->setCellValue('L'.(count($data)+6),'MODA');
//                $sheet->setCellValue('M'.(count($data)+5),'=AVERAGE(M5:M'.(count($data)+4).')');
//                $sheet->setCellValue('M'.(count($data)+5),'=MODE(M5:M'.(count($data)+4).')');
//
//                $sheet->setCellValue('M'.(count($data)+5),'=AVERAGE(M5:M'.(count($data)+4).')');
//                $sheet->setCellValue('N'.(count($data)+5),'=AVERAGE(N5:N'.(count($data)+4).')');
//                $sheet->setCellValue('O'.(count($data)+5),'=AVERAGE(O5:O'.(count($data)+4).')');
//                $sheet->setCellValue('P'.(count($data)+5),'=AVERAGE(P5:P'.(count($data)+4).')');
//                $sheet->setCellValue('Q'.(count($data)+5),'=AVERAGE(Q5:Q'.(count($data)+4).')');
//                $sheet->setCellValue('R'.(count($data)+5),'=AVERAGE(R5:R'.(count($data)+4).')');
//                $sheet->setCellValue('S'.(count($data)+5),'=AVERAGE(S5:S'.(count($data)+4).')');
//                $sheet->setCellValue('T'.(count($data)+5),'=AVERAGE(T5:T'.(count($data)+4).')');
//                $sheet->setCellValue('U'.(count($data)+5),'=AVERAGE(U5:U'.(count($data)+4).')');
//                $sheet->setCellValue('V'.(count($data)+5),'=AVERAGE(V5:V'.(count($data)+4).')');
//                $sheet->setCellValue('W'.(count($data)+5),'=AVERAGE(W5:W'.(count($data)+4).')');
//                $sheet->setCellValue('X'.(count($data)+5),'=AVERAGE(X5:X'.(count($data)+4).')');
//
//                $sheet->setCellValue('M'.(count($data)+6),'=MODE(M5:M'.(count($data)+4).')');
//                $sheet->setCellValue('N'.(count($data)+6),'=MODE(N5:N'.(count($data)+4).')');
//                $sheet->setCellValue('O'.(count($data)+6),'=MODE(O5:O'.(count($data)+4).')');
//                $sheet->setCellValue('P'.(count($data)+6),'=MODE(P5:P'.(count($data)+4).')');
//                $sheet->setCellValue('Q'.(count($data)+6),'=MODE(Q5:Q'.(count($data)+4).')');
//                $sheet->setCellValue('R'.(count($data)+6),'=MODE(R5:R'.(count($data)+4).')');
//                $sheet->setCellValue('S'.(count($data)+6),'=MODE(S5:S'.(count($data)+4).')');
//                $sheet->setCellValue('T'.(count($data)+6),'=MODE(T5:T'.(count($data)+4).')');
//                $sheet->setCellValue('U'.(count($data)+6),'=MODE(U5:U'.(count($data)+4).')');
//                $sheet->setCellValue('V'.(count($data)+6),'=MODE(V5:V'.(count($data)+4).')');
//                $sheet->setCellValue('W'.(count($data)+6),'=MODE(W5:W'.(count($data)+4).')');
//                $sheet->setCellValue('X'.(count($data)+6),'=MODE(X5:X'.(count($data)+4).')');


//                $sheet->setColumnFormat(array(
//                                        'M' => '0.00',
//                                        'N' => '0.00',
//                                        'O' => '0.00',
//                                        'P' => '0.00',
//                                        'Q' => '0.00',
//                                        'R' => '0.00',
//                                        'S' => '0.00',
//                                        'T' => '0.00',
//                                        'U' => '0.00',
//                                        'V' => '0.00',
//                                        'W' => '0.00',
//                                        'X' => '0.00',
//                                         )
//                                );

            });
            $excel->sheet('Dolor de Cabeza', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",68)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina Forte",
                    "Aspirina 500 mg",
                    "Panadol 500 mg",
                    "Panadol Forte 500mg",
                    "Kitadol 500g Migraña",
                    "Migralivia",
                    "Cefadol",
                    "Digravin",
                    "Migrax",

                    "Comentario",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:V'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Cardio', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",69)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina 100",
                    "ASSA-81 X 100mg",
                    "Cor-Asa 100mg",
                    "Cardioaspirina EC 100mg",
                    "Ecotrin 100mg",

                     "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                 $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Multivitaminico', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",70)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Berocca plus x 30",
                    "Berocca Plus x 10 comp eferv",
                    "Supradyn cápsulas x 30",
                    "Supradyn Comp. Efervescente x 10",
                    "Ceregen x 325 ml",
                    "Ceregen x 180 ml",
                    "Vitathon Capsula Blanda x35",
                    "Pharmaton cápsulas x30",
                    "Centrum Tabletas x 30",
                    "Centrum Silver tabletas x 30",
                    "Sunvit Multidaily",
                    "Infor",
                    "Multifort",
                    "Biocord",

                    "Comentario"

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:AA'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitamina C', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",71)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Redoxon Doble acción x 3 tubos x 10",
                    "Sunlife",
                    "RedoxVit",
                    "Vitamina C Genfar Tab. Mast 500 mg x 144",
                    "Easylife",
                    "Efer-C caja x 3 Sachets x12",
                    "Redomax",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:U'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitaminas Pronatales', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",72)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Supradyn Pronatal Tab x 30",
                    "Vi-Syneral Pronatal Tab x 30",
                    "Natele cap blanda x 28",
                    "Maddre DSS caja x 30 Tab",
                    "Gestavit dha caps x 30",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                 $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');


                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Derma', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp(" . $company_id . ",73)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Bepanthen crema x 30 gr",
                    "Bepanthen Crema x 100 g",
                    "Mucovit x 30 gr x 1",
                    "Dermafar",
                    "Cicatricure",
                    "Regenerum",
                    "Bepanthen Ungüento 30G",
                    "Hipoglos Pomada 35 G",
                    "Desitin",
                    "Canesten 30G",
                    "Hongocid ungüento x 15 gr",
                    "Lamisil crema x 1%",
                    "Lafitil",
                    "Silka Medic",
                    "Icaden",
                    "Gyno-Canesten Cap vag +apl 500 mg",
                    "Volusol crema vag 2% x 15 gr",
                    "Femstat ovulos x 100 mg x 3",
                    "Desitin 57G",
                    "Desitin 113G",
                    "Zaidman Pote 100G",
                    "Simond´s 60G",
                    "Biopiel",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:AK'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });

        })->export('xls');

    }

    public function productsPriceCompetityAllV2($company_id) {

        Excel::create('Bayer precio competencia', function($excel) use ($company_id) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Dolor de Cuerpo', function($sheet) use ($company_id) {
                // $sqlcoord="CALL sp_price_prod_comp_cat_67_comp_79";
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",67)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Apronax 550mg",
                    "Apronax 275mg",
                    "Doloflam Extra Fuerte 400mg",
                    "Miodel Relax",
                    "Miopress Forte",
                    "Dolgramin",
                    "Dioxaflex CB Plus",
                    "Naproxeno 550 mg genérico",
                    "Redex",
                    "Dolodiclomed",
                    "Doloneurobion",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:X'.(count($data)+4));
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('A'.(count($data)+4).':Y'.(count($data)+4), function($cells) {
                    $cells->setBorder('none','none','double','none');
                });

            });
            $excel->sheet('Dolor de Cabeza', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",68)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina Forte",
                    "Panadol 500 mg",
                    "Panadol Forte 500mg",
                    "Kitadol 500g Migraña",
                    "Migralivia",
                    "Cefadol",
                    "Vivarex (La caja es por 100)",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:T'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Cardio', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",69)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina 100",
                    "ASSA-81 X 100mg",
                    "Cor-Asa 100mg",
                    "Cardioaspirina EC 100mg",
                    "Ecotrin 100mg",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Multivitaminico', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",70)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Berocca plus x 30",
                    "Berocca Plus x 10 comp eferv",
                    "Supradyn cápsulas x 30",
                    "Supradyn Comp. Efervescente x 10",
                    "Ceregen x 325 ml",
                    "Ceregen x 180 ml",
                    "Vitathon Capsula Blanda x35",
                    "Pharmaton cápsulas x30",
                    "Centrum Tabletas x 30",
                    "Centrum Silver tabletas x 30",
                    "Sunvit Multidaily",
                    "Infor",
                    "Multifort",
                    "Biocord",

                    "Comentario"

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:AA'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitamina C', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",71)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Redoxon Doble acción x 3 tubos x 10",
                    "Sunlife",
                    "RedoxVit",
                    "Mi Vitamina C Genfar Tab. Mast 500 mg x 144",
                    "Easylife",
                    "Efer-C caja x 3 Sachets x12",
                    "Redomax x 3 tubos x 10",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:T'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitaminas Pronatales', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",72)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Supradyn Pronatal Tab x 30",
                    "Vi-Syneral Pronatal Tab x 30",
                    "Natele cap blanda x 28",
                    "Maddre DSS caja x 30 Tab",
                    "Gestavit dha caps x 30",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');


                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Derma', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",73)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Bepanthen crema x 30 gr",
                    "Bepanthen Crema x 100 g",
                    "Mucovit x 30 gr x 1",
                    "Dermafar",
                    "Cicatricure",
                    "Regenerum",
                    "Desitin 57G",
                    "Desitin 113G",
                    "Simond´s 60G",
                    "Biopiel",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:W'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Descongestionante', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",76)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Afrin x 15 ml",
                    "Rynat D x 15 ml",
                    "Rhino Dazol x 15 ml",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:P'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Cuidado de la Piel de Bebe', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",77)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Bepanthen Ungüento 30G",
                    "Hipoglos Pomada 35 G",
                    "Desitin Crema",
                    "Zaidman Pote 100G",
                    "Nistaglos",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Antimicótico', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",78)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Canesten Crema",
                    "Hongocid ungüento x 15 gr",
                    "Lamisil crema x 1%",
                    "Lafitil ungüento",
                    "Silka Medic gel",
                    "Icaden crema",
                    "Clotrimazol generico",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:T'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Antimicótico Vaginales', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v2(" . $company_id . ",79)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Gyno-Canesten Cap vag +apl 500 mg",
                    "Volusol crema vag 2% x 15 gr",
                    "Femstat ovulos x 100 mg x 3",
                    "Gyno Zalain 300mg",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:Q'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
        })->export('xls');

    }

    public function productsPriceCompetityAllV3($company_id) {
        Excel::create('Bayer precio competencia', function($excel) use ($company_id) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Dolor de Cuerpo', function($sheet) use ($company_id) {
                // $sqlcoord="CALL sp_price_prod_comp_cat_67_comp_79";
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",67)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Apronax 550mg",
                    "Apronax 275mg",
                    "Doloflam Extra Fuerte 400mg",
                    "Miodel Relax",
                    "Miopress Forte",
                    "Dolgramin",
                    "Dioxaflex CB Plus",
                    "Naproxeno 550 mg genérico",
                    "Redex",
                    "Dolodiclomed",
                    "Doloneurobion",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:X'.(count($data)+4));
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });

                $sheet->cells('A'.(count($data)+4).':Y'.(count($data)+4), function($cells) {
                    $cells->setBorder('none','none','double','none');
                });

            });
            $excel->sheet('Dolor de Cabeza', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",68)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina Forte",
                    "Panadol 500 mg",
                    "Panadol Forte 500mg",
                    "Kitadol 500g Migraña",
                    "Migralivia",
                    "Cefadol",
                    "Vivarex (La caja es por 100)",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

//                for ($i = 1; $i <= count($data); $i++) {
//                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }
//                }
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:T'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Cardio', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",69)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Aspirina 100",
                    "ASSA-81 X 100mg",
                    "Cor-Asa 100mg",
                    "Cardioaspirina EC 100mg",
                    "Ecotrin 100mg",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Multivitaminico', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",70)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Berocca plus x 30",
                    "Berocca Plus x 10 comp eferv",
                    "Supradyn cápsulas x 30",
                    "Supradyn Comp. Efervescente x 10",
                    "Ceregen x 325 ml",
                    "Ceregen x 180 ml",
                    "Vitathon Capsula Blanda x35",
                    "Pharmaton cápsulas x30",
                    "Centrum Tabletas x 30",
                    "Centrum Silver tabletas x 30",
                    "Sunvit Multidaily",
                    "Infor",
                    "Multifort",
                    "Biocord",

                    "Comentario"

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:AA'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitamina C', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",71)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Redoxon Doble acción x 3 tubos x 10",
                    "Sunlife",
                    "RedoxVit",
                    "Mi Vitamina C Genfar Tab. Mast 500 mg x 144",
                    "Easylife",
                    "Efer-C caja x 3 Sachets x12",
                    "Redomax x 3 tubos x 10",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:T'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Vitaminas Pronatales', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",72)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Supradyn Pronatal Tab x 30",
                    "Vi-Syneral Pronatal Tab x 30",
                    "Natele cap blanda x 28",
                    "Maddre DSS caja x 30 Tab",
                    "Gestavit dha caps x 30",

                    "Comentario",
                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');


                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });
            });
            $excel->sheet('Derma', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",73)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Bepanthen crema x 30 gr",
                    "Bepanthen Crema x 100 g",
                    "Mucovit x 30 gr x 1",
                    "Dermafar",
                    "Cicatricure",
                    "Regenerum",
                    "Desitin 57G",
                    "Simond´s 60G",
                    "Biopiel",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:v'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Descongestionante', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",76)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Afrin x 15 ml",
                    "Rynat D x 15 ml",
                    "Rhino Dazol x 15 ml",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:P'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Cuidado de la Piel de Bebe', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",77)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Bepanthen Ungüento 30G",
                    "Hipoglos Pomada 35 G",
                    "Desitin Crema",
                    "Zaidman Pote 100G",
                    "Nistaglos",
                    "Desitin 113G",
                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:R'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Antimicótico', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",78)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Canesten Crema",
                    "Hongocid ungüento x 15 gr",
                    "Lamisil crema x 1%",
                    "Lafitil ungüento",
                    "Silka Medic gel",
                    "Icaden crema",
                    "Clotrimazol generico",
                    "Lafitil Ungüento Tubo x28 gr.",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:U'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
            $excel->sheet('Antimicótico Vaginales', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_price_prod_comp_v3(" . $company_id . ",79)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "CLIENTE",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Gyno-Canesten Cap vag +apl 500 mg",
                    "Volusol crema vag 2% x 15 gr",
                    "Femstat ovulos x 100 mg x 3",
                    "Gyno Zalain 300mg",

                    "Comentario"
                );

                $sheet->prependRow(4, $headings);

                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);

                $sheet->fromArray($data,null,'A5',false,false);

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);
                $sheet->setAutoFilter('A4:Q'.count($data));

                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


            });
        })->export('xls');
    }

    public function excelPruebaBayer()
    {
        Excel::create('Report2016', function($excel) {

            // Set the title
            $excel->setTitle('My awesome report 2016');

            // Chain the setters
            $excel->setCreator('Me')->setCompany('Our Code World');

            $excel->setDescription('A demonstration to change the file properties');

            $data = [12,"Hey",123,4234,5632435,"Nope",345,345,345,345];

            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, NULL, 'A3');
                $sheet->getCell('A1')->setValue("=SUM(B2:B4)");
            });


        })->download('xlsx');
    }

    public function excelPruebaChart()
    {
        $excel = new \PHPExcel();

        $excel->createSheet();
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setTitle('ChartTest');

        $objWorksheet = $excel->getActiveSheet();
        $objWorksheet->fromArray(
            array(
                array('', 'Rainfall (mm)', 'Temperature (°F)', 'Humidity (%)'),
                array('Jan', 78, 52, 61),
                array('Feb', 64, 54, 62),
                array('Mar', 62, 57, 63),
                array('Apr', 21, 62, 59),
                array('May', 11, 75, 60),
                array('Jun', 1, 75, 57),
                array('Jul', 1, 79, 56),
                array('Aug', 1, 79, 59),
                array('Sep', 10, 75, 60),
                array('Oct', 40, 68, 63),
                array('Nov', 69, 62, 64),
                array('Dec', 89, 57, 66),
            )
        );

        $dataseriesLabels1 = array(
            new \PHPExcel_Chart_DataSeriesValues('String', 'ChartTest!$B$1', NULL, 1), //  Temperature
        );
        $dataseriesLabels2 = array(
            new \PHPExcel_Chart_DataSeriesValues('String', 'ChartTest!$C$1', NULL, 1), //  Rainfall
        );
        $dataseriesLabels3 = array(
            new \PHPExcel_Chart_DataSeriesValues('String', 'ChartTest!$D$1', NULL, 1), //  Humidity
        );

        $xAxisTickValues = array(
            new \PHPExcel_Chart_DataSeriesValues('String', 'ChartTest!$A$2:$A$13', NULL, 12), //  Jan to Dec
        );

        $dataSeriesValues1 = array(
            new \PHPExcel_Chart_DataSeriesValues('Number', 'ChartTest!$B$2:$B$13', NULL, 12),
        );

        //  Build the dataseries
        $series1 = new \PHPExcel_Chart_DataSeries(
            \PHPExcel_Chart_DataSeries::TYPE_BARCHART, // plotType
            \PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED, // plotGrouping
            range(0, count($dataSeriesValues1) - 1), // plotOrder
            $dataseriesLabels1, // plotLabel
            $xAxisTickValues, // plotCategory
            $dataSeriesValues1                              // plotValues
        );
        //  Set additional dataseries parameters
        //      Make it a vertical column rather than a horizontal bar graph
        $series1->setPlotDirection(\PHPExcel_Chart_DataSeries::DIRECTION_COL);

        $dataSeriesValues2 = array(
            new \PHPExcel_Chart_DataSeriesValues('Number', 'ChartTest!$C$2:$C$13', NULL, 12),
        );

        //  Build the dataseries
        $series2 = new \PHPExcel_Chart_DataSeries(
            \PHPExcel_Chart_DataSeries::TYPE_LINECHART, // plotType
            \PHPExcel_Chart_DataSeries::GROUPING_STANDARD, // plotGrouping
            range(0, count($dataSeriesValues2) - 1), // plotOrder
            $dataseriesLabels2, // plotLabel
            NULL, // plotCategory
            $dataSeriesValues2                              // plotValues
        );

        $dataSeriesValues3 = array(
            new \PHPExcel_Chart_DataSeriesValues('Number', 'ChartTest!$D$2:$D$13', NULL, 12),
        );

        //  Build the dataseries
        $series3 = new \PHPExcel_Chart_DataSeries(
            \PHPExcel_Chart_DataSeries::TYPE_AREACHART, // plotType
            \PHPExcel_Chart_DataSeries::GROUPING_STANDARD, // plotGrouping
            range(0, count($dataSeriesValues2) - 1), // plotOrder
            $dataseriesLabels3, // plotLabel
            NULL, // plotCategory
            $dataSeriesValues3                              // plotValues
        );


        //  Set the series in the plot area
        $plotarea = new \PHPExcel_Chart_PlotArea(NULL, array($series1, $series2, $series3));
        $legend = new \PHPExcel_Chart_Legend(\PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
        $title = new \PHPExcel_Chart_Title('Grafica de Muestra :(');

        //  Create the chart
        $chart = new \PHPExcel_Chart(
            'chart1', // name
            $title, // title
            $legend, // legend
            $plotarea, // plotArea
            true, // plotVisibleOnly
            0, // displayBlanksAs
            NULL, // xAxisLabel
            NULL            // yAxisLabel
        );

        //  Set the position where the chart should appear in the worksheet
        $chart->setTopLeftPosition('F2');
        $chart->setBottomRightPosition('O16');

        //  Add the chart to the worksheet
        $objWorksheet->addChart($chart);



        $writer = new \PHPExcel_Writer_Excel2007($excel);
        $writer->setIncludeCharts(TRUE);

        // Save the file.
        $writer->save(storage_path().'/file.xlsx');


    }

    public function getChart(){
        $excel=  Excel::create('Users by Country-BetonLove',   function($excel)  {
            $excel->setTitle('Users by Country');
            $excel->setCompany('BetonLove');
            $excel->sheet('Firstsheet', function($sheet) {
                $sheet->fromArray(
                    array(
                        array('',   2010,   2011,   2012),
                        array('Q1',   12,   15,     21),
                        array('Q2',   56,   73,     86),
                        array('Q3',   52,   61,     69),
                        array('Q4',   30,   32,     0),
                    )
                );
                $dataSeriesLabels = array(
                    new PHPExcel_Chart_DataSeriesValues('String', 'Firstsheet!$B$1', NULL, 1),   //  2010
                    new PHPExcel_Chart_DataSeriesValues('String', 'Firstsheet!$C$1', NULL, 1),   //  2011
                    new PHPExcel_Chart_DataSeriesValues('String', 'Firstsheet!$D$1', NULL, 1),   //  2012
                );
                $xAxisTickValues = array(
                    new PHPExcel_Chart_DataSeriesValues('String', 'Firstsheet!$A$2:$A$5', NULL, 4),  //  Q1 to Q4
                );

                $dataSeriesValues = array(
                    new PHPExcel_Chart_DataSeriesValues('Number', 'Firstsheet!$B$2:$B$5', NULL, 4),
                    new PHPExcel_Chart_DataSeriesValues('Number', 'Firstsheet!$C$2:$C$5', NULL, 4),
                    new PHPExcel_Chart_DataSeriesValues('Number', 'Firstsheet!$D$2:$D$5', NULL, 4),
                );

                $series = new PHPExcel_Chart_DataSeries(
                    PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
                    PHPExcel_Chart_DataSeries::GROUPING_CLUSTERED,  // plotGrouping
                    range(0, count($dataSeriesValues)-1),           // plotOrder
                    $dataSeriesLabels,                              // plotLabel
                    $xAxisTickValues,                               // plotCategory
                    $dataSeriesValues                               // plotValues
                );
                $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_BAR);

                $plotArea = new PHPExcel_Chart_PlotArea(NULL, array($series));
                $legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, NULL, false);
                $title = new PHPExcel_Chart_Title('Test Bar Chart');
                $yAxisLabel = new PHPExcel_Chart_Title('Value ($k)');
                //    Create the chart
                $chart = new PHPExcel_Chart(
                    'chart1',       // name
                    $title,         // title
                    $legend,        // legend
                    $plotArea,      // plotArea
                    true,           // plotVisibleOnly
                    0,              // displayBlanksAs
                    NULL,           // xAxisLabel
                    $yAxisLabel     // yAxisLabel
                );

                //    Set the position where the chart should appear in the worksheet
                $chart->setTopLeftPosition('A7');
                $chart->setBottomRightPosition('H20');

                //    Add the chart to the worksheet
                $sheet->addChart($chart);

            });
        });

        $excel->export();
    }

    public function excelVentasAuditBayer($company_id,$fecha,$fecha1)
    {
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $mytime = Carbon\Carbon::now();
        $fechaExcel= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('V_A_B-'.$company_id."-".$fechaExcel."_I_".$fechaI."_F_".$fechaII, function ($excel) use ($company_id,$fechaI,$fechaII) {
            $excel->setTitle('Ventas Auditorias Bayer');
            $excel->sheet('Ventas Auditorías', function ($sheet) use ($company_id,$fechaI,$fechaII) {
                $company_id = (int)$company_id;
                $sqlcoord = "CALL sp_bayer_ventas_v1_p1(5,'" . $fechaI . "','". $fechaII."')";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;

                //dd($stores);
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count++;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Auditor",
                    "Fecha",
                    "Hora",

                    //preg1
                    "respuesta",
                    "opcion",
                    "Comentario",
                    "foto",

                    //preg2
                    "respuesta",
                    "opcion",
                    "Comentario",
                    "foto",

                    //KIT BODEGUERO BAYER
                    "KIT BODEGUERO",

                    //BLOQUEADOR PALMERA SUN EN SACHET (TIRA X 12 UNIDADES)
                    "BLOQUEADOR PALMERA",

                    //preg5
                    "respuesta",

                    //preg6
                    "opcion",
                    "Comentario",

                    //preg7
                    "opcion",
                    "Comentario",

                    //preg8
                    "opcion",
                    "Comentario",

                    //preg9
                    "opcion",
                    "Comentario",

                    //preg10
                    "Panadol",
                    "Kitadol",
                    "Mejoral",
                    "Paldolor",
                    "Otros",
                    "Comentario",

                    //preg3 publicidad 1
                    "respuesta",
                    "opcion",
                    "Comentario",
                    "foto",

                    //preg3 publicidad 2
                    "respuesta",
                    "opcion",
                    "Comentario",
                    "foto",

                );

                $columns = array(
                    "m",
                    "q",
                    "al",
                    "ap"
                );

                $setMargenCell = array("j3:m3","n3:q3","r3:s3","t3:t3","u3:v3","w3:x3","y3:z3","aa3:ab3","ac3:ah3","ai3:al3","am3:ap3");
                $setFormatCell = array("j3","n3","r3","t3","u3","w3","y3","aa3","ac3","ai3","am3");
                //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell = array(

                    "Se encuentra abierto? ",
                    "Cliente Permitio venta? ",
                    "¿Qué producto compró?",//p4
                    "¿Vende algun tipo de Medicamento?",//p5
                    "¿Qué tipo de Medicamento?",//p6
                    "¿Qué tipo de Analgesico?",//p7
                    "¿Donde los compra?",//p8
                    "¿Cual es el motivo de no querer comprar?",//p9
                    "¿Que otras marcas ofrece?",//p10
                    "Desea material POP Botiquin",
                    "Desea material POP Afiche",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data, null, 'A5', false, false);
                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 15);


                $sheet->row(4, function ($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->setAutoFilter('A4:ap' . (count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for ($col = 0; $col < count($columns); $col++) {
                        $url_foto = trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if (strlen($url_foto) > 0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for ($i = 0; $i < count($setFormatCell); $i++) {
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function ($cell) {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls', ['Set-Cookie' => 'fileDownload=true; path=/']);


    }



}