<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 5/07/2017
 * Time: 06:01
 */
use Maatwebsite\Excel\Facades\Excel;

class ExcelBayerController extends BaseController {


    public function index()
    {

    }


    public function productsPriceCompetity()
    {

        Excel::create('Bayer precio competencia', function($excel) {
            $excel->setTitle('Bayer precio Productos Competencia');
            $excel->sheet('Dolor de Cuerpo - Dolor de Cabeza - Cardio - Multivitaminico', function($sheet) {
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
                    "RUC",
                    "NOMBRE",
                    "DISRECCIÓN",
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
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                $sheet->mergeCells('O3:R3');

                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('S3:U3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
            });


            $excel->sheet('Vitamina C - Vitaminas Pronatales - Derma', function($sheet) {
                $sqlcoord="CALL sp_price_prod_comp_cat_71_72_73_comp_79";
                $stores = DB::select($sqlcoord);
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID",
                    "TIPO",
                    "RUC",
                    "NOMBRE",
                    "DISRECCIÓN",
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
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                $sheet->cells('S3:U3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
            });
        })->export('xls');
    }



}