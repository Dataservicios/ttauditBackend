<?php

/**
 * Created by PhpStorm.
 * User: Franco
 * Date: 26/07/2019
 * Time: 12:02
 */
class ExcelLiptonController extends BaseController {
    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function liptonV1($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        Excel::create('LIPTON-'.$company_id."-".$fecha, function($excel) use ($company_id) {
            $excel->setTitle('Lipton');
            $excel->sheet('Tiendas Lipton', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_lipton_v1(" . $company_id . ",". Auth::user()->id .")";
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
                    "Codigo",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Latitud",
                    "Longitud",
                    "Rubro",
                    "Store_type",
                    "Fecha",
                    "Hora",
                    "Auditor",



                    "(1) Respuesta ",//o
                    "(1) Comentario ",//p
                    "(1) Local Cerrado por Horario",
                    "(1) Cambio de Giro",
                    "(1) Local no Existe",
                    "(1) Otros",
                    "(1) Comentario",
                    "(1) Foto",//V

                    "(2) Respuesta ",//W
                    "(2) Comentario ",//X
                    "(2) No estaba el encargado ",
                    "(2) No quiere Participar ",
                    "(2) Cambio dueño ",//AA
                    "(2) Aún no le ha llegado el producto",//Ab
                    "(2) Es Otro Rubro (Oficina u Otros)",//Ac
                    "(2) Producto se acabó",//Ad
                    "(2) Se derivó el producto a otro local",//Ae
                    "(2) No aceptaron el producto",//Af
                    "(2) No permiten material POP por políticas de la empresa",//Ag
                    "(2) Otros",//Ah
                    "(2) Comentario Otros",//Ai

                    "(3) Cuantas Cajas vendio en la quincena",//AJ

                    "(4) Respuesta ",//AK
                    "(4) Comentario ",//AKL
                    "(4) No cuenta con espacio",
                    "(4) Municipalidad no permite",
                    "(4) No le gusta el diseño",
                    "(4) Sencillamente no desea",
                    "(4) Otro",
                    "(4) Comentario",
                    "(4) Foto",//AS

                    "(5) Respuesta ",//AT
                    "(5) Comentario ",//AU
                    "(5) No cuenta con espacio",
                    "(5) No le gusta el diseño",
                    "(5) Sencillamente no desea",
                    "(5) Otro",
                    "(5) Comentario",
                    "(5) Foto",//BA

                    "(6) Respuesta",//BB
                    "(6) Comentario ",//BC
                    "(6) No cuenta con espacio",
                    "(6) No le gusta el diseño",
                    "(6) Sencillamente no desea",
                    "(6) Otro",
                    "(6) Comentario",
                    "(6) Foto",//BI

                    "(7) Respuesta",//BJ
                    "(7) Comentario ",//BK
                    "(7) No cuenta con espacio",
                    "(7) No le gusta el diseño",
                    "(7) Sencillamente no desea",
                    "(7) Otro",
                    "(7) Comentario",
                    "(7) Foto",//BQ

                    "(8) Respuesta",//BR
                    "(8) Comentario ",//BS
                    "(8) No acepto productos gratis",
                    "(8) Planea venderlo",
                    "(8) Sencillamente no desea",
                    "(8) Otro",
                    "(8) Comentario",
                    "(8) Foto",//BY

                    "(9) Respuesta",//BZ
                    "(9) Comentario ",//CB
                    "(9) Politica del local no lo permite",
                    "(9) No le gusta el diseño",
                    "(9) Sencillamente no desea",
                    "(9) Otro",
                    "(9) Comentario",
                    "(9) Foto",//CG

                    "(10) Respuesta",//CH
                    "(10) Comentario ",//CI
                    "(10) Politica del local no lo permite",
                    "(10) No le gusta el diseño",
                    "(10) Sencillamente no desea",
                    "(10) Otro",
                    "(10) Comentario",
                    "(10) Foto",//CO

                    "(11) Respuesta",//CP
                    "(11) Comentario ",//CQ
                    "(11) Politica del local no lo permite",
                    "(11) No le gusta el diseño",
                    "(11) Sencillamente no desea",
                    "(11) Otro",
                    "(11) Comentario",
                    "(11) Foto",//CW

                    "(12) Restaurante",//CX
                    "(12) Panadería/Pastelería",//CY
                    "(12) Cafetería",//CP
                    "(12) Casino",//CP
                    "(12) Bodega",//CP
                    "(12) Otros",//CP
                    "(12) Comentario Otros"//DD

                );
                //Columnas de Foto
                $columns = array("V","BA","BI","BQ","BY","CG","CO","CW");

                $setMargenCell =  array("o3:v3","W3:AI3","AJ3:AJ3","AK3:AS3","AT3:BA3","BB3:BI3","BJ3:BQ3","BR3:BY3","BZ3:CG3","CH3:CO3","CP3:CW3","CX3:DD3");
                $setFormatCell =  array("O3","W3","AJ3","AK3","AT3","BB3","BJ3","BR3","BZ3","CH3","CP3","CX3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el local?",
                    "¿Cliente permitio trabajar mercaderismo?",
                    "¿Cuantas cajas de Lipton vendio en la quincena?",
                    "¿Deja colocar o mantiene Letrero Exterior?",
                    "¿Deja colocar o mantiene Exhibidor Lipton?",
                    "¿Deja colocar o mantiene Poster?",
                    "¿Deja colocar o mantiene Jalavista ?",
                    "¿Recibió o mantiene Cupones de producto?",
                    "¿Deja colocar o mantiene tend cards?",
                    "¿Recibió o mantiene Vasos (30), (20), (10)?",
                    "¿Deja colocar o mantiene individuales?",
                    "¿Cuál es el Rubro del Local?"
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


                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->setAutoFilter('A4:DD'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
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

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function Alicorp_no_medidos($company_id){
        header('Access-Control-Allow-Origin: *');
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        Excel::create('Alicorp_NO_Medidos-'.$company_id."-".$fecha, function($excel) use ($company_id){
            $excel->setTitle('No Medidos');
            $excel->sheet('Pop No medidos', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_alicorp_no_medidos(" . $company_id .")";
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
                    "Store_ID",
                    "Auditor Id",
                    "Auditor",
                    "Medido",
                    "Mat. POP ID",
                    "Mat. POP",
                    "Tipo Store",
                    "Ciudad",
                    "Foto",

                );
                //Columnas de Foto
                $columns = array("I");

                $setMargenCell =  array("A3:I3");
                $setFormatCell =  array("A3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "Materiales No medidos",
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


                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->setAutoFilter('A4:I'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir Foto');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
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
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function liptonV2($company_id) {
        if (is_object(Auth::user())){
            header('Access-Control-Allow-Origin: *');
            $mytime = Carbon\Carbon::now();
            $fecha= $mytime->toDateTimeString();
            Excel::create('Encuestas-'.$company_id."-".$fecha, function($excel) use ($company_id) {
                $excel->setTitle('Encuestas');
                $excel->sheet('Tiendas Encuestas', function($sheet) use ($company_id) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_lipton_v2(" . $company_id . ",". Auth::user()->id .")";
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
                        "Codigo",
                        "Comercio",
                        "Dirección",
                        "Distrito",
                        "Provincia",
                        "Departamento",
                        "Latitud",
                        "Longitud",
                        "Rubro",
                        "Store_type",
                        "Fecha",
                        "Hora",
                        "Auditor",



                        "(1) Respuesta ",//o
                        "(1) Comentario ",//p
                        "(1) Foto",//q

                        "(2) Respuesta ",//r
                        "(2) Comentario ",//s
                        "(2) No estaba el encargado ",//t
                        "(2) no desea ser encuestado",//u
                        "(2) Otros",//v
                        "(2) Comentario Otros",///w

                    );
                    //Columnas de Foto
                    $columns = array("Q");

                    $setMargenCell =  array("o3:q3","r3:w3");
                    $setFormatCell =  array("O3","R3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Se encuentra abierto el local?",
                        "¿Cliente permitio tomar información?"
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


                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                        $row->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->setAutoFilter('A4:W'.(count($data) + 4));


                    for ($i = 1; $i <= count($data); $i++) {
                        for($col = 0 ; $col < count($columns); $col++){
                            $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                            if(strlen($url_foto)>0) {
                                $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                                $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                            }
                        }
                    }


                    for($i = 0 ; $i < count($setFormatCell); $i++){
                        $sheet->mergeCells($setMargenCell[$i]);
                        $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                        $sheet->cell($setMargenCell[$i], function($cell)  {
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

            })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
        }else{
            return \Redirect::to('https://ttaudit.com');
        }

    }
}