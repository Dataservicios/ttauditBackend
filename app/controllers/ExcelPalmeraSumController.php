<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 23/09/2017
 * Time: 12:20
 */

use Maatwebsite\Excel\Facades\Excel;
class ExcelPalmeraSumController extends BaseController
{

    public function storesAudit($company_id) {

        Excel::create('Palmera Sum', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas Palmera');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_palmera_auditor(" . $company_id . ")";
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
                    "UGIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITO",
                    "FECHA",
                    "HORA",
                    "TIPO BODEGA",
                    "Respuesta",
                    "Opción",
                    "Foto",
                    "Respuesta",
                    "Opcion",
                    "Comentario",
                    "¿Cuánto stock tiene? (Cantidad de Sachets)",
                    "Monto que se vendio",
                    "Respuesta",
                    "Foto"
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

                $sheet->setAutoFilter('A4:X'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }


                $sheet->mergeCells('O3:Q3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Cliente permitió auditoria?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Cliente compro bloqueador Palmera?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('¿Se colocó sticker?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }

    public function storesAuditV2($company_id) {

        Excel::create('Palmera Sum', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas Palmera');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_palmera_auditor_v2(" . $company_id . ")";
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
                    "UGIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITO",
                    "FECHA",
                    "HORA",
                    "TIPO BODEGA",

                    "Respuesta",
                    "Opción",
                    "Foto",

                    "Respuesta",
                    "Opcion",
                    "Comentario",


                    "Cantidad Bolsas Trome de 150 gr",
                    "Monto Trome",

                    "Hay presencia de Sapolio 150gr",
                    "Opcion",
                    "Comentario",

                    "Hay presencia de Patito 150gr",
                    "Opcion",
                    "Comentario",

                    "Respuesta",
                    "Opcion",
                    "Comentario",

                    "Monto que se vendio",
                    "Comentario Adicional",


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

                $sheet->setAutoFilter('A4:X'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
//                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }

                }


                $sheet->mergeCells('O3:Q3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Se encuentra abierto el local?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('Efectividad Venta Trome:');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('x3:y3');
                $sheet->cell('x3', function($cell) {
                    $cell->setValue('Precio Venta Sugerido de Sapolio 150gr');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('aa3:ab3');
                $sheet->cell('aa3', function($cell) {
                    $cell->setValue('Precio Venta Sugerido de Patito 150gr');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('ac3:ae3');
                $sheet->cell('ac3', function($cell) {
                    $cell->setValue('¿Cliente compro bloqueador Palmera?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }

    public function palmeraNewStore($ini,$end) {

        Excel::create('Palmera Sum', function($excel) use ($ini,$end) {
            $excel->setTitle('Tiendas auditadas Palmera');
            $excel->sheet('General', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_palmera_new_store('" . $ini . "','" . $end . "')";
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
                    "TELEFONO",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UGIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITO",
                    "FECHA",
                    "HORA",
                    "TIPO BODEGA",
                    "Respuesta",
                    "Opción",
                    "Foto",
                    "Respuesta",
                    "Opcion",
                    "Comentario",
                    "¿Cuánto stock tiene? (Cantidad de Sachets)",
                    "Monto que se vendio",
                    "Respuesta",
                    "Foto"
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

                $sheet->setAutoFilter('A4:X'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('y' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('y' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('y' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }


                $sheet->mergeCells('p3:r3');
                $sheet->cell('p3', function($cell) {
                    $cell->setValue('¿Cliente permitió auditoria?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('s3:u3');
                $sheet->cell('s3', function($cell) {
                    $cell->setValue('¿Cliente compro bloqueador Palmera?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('x3:y3');
                $sheet->cell('x3', function($cell) {
                    $cell->setValue('¿Se colocó sticker?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

//                $sheet->setColumnFormat([
//                    'O' => '0',
//                    'R' => '0',
//                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }

    public function storesTromePalmera($ini,$end) {

        Excel::create('Trome', function($excel) use ($ini,$end) {
            $excel->setTitle('Tiendas auditadas Trome');
            $excel->sheet('General', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_trome_new_store('" . $ini . "','" . $end . "')";
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
                    "UGIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITO",
                    "FECHA",
                    "HORA",
                    "TIPO BODEGA",

                    "Respuesta",
                    "Opción",
                    "Foto",

                    "Respuesta",
                    "Opcion",
                    "Comentario",


                    "Cantidad Bolsas Trome de 150 gr",
                    "Monto Trome",

                    "Hay presencia de Sapolio 150gr",
                    "Opcion",
                    "Comentario",

                    "Hay presencia de Patito 150gr",
                    "Opcion",
                    "Comentario",

                    "Respuesta",
                    "Opcion",
                    "Comentario",

                    "Monto que se vendio",
                    "Comentario Adicional",


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

                $sheet->setAutoFilter('A4:X'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
//                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }

                }


                $sheet->mergeCells('O3:Q3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Se encuentra abierto el local?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('Efectividad Venta Trome:');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('x3:y3');
                $sheet->cell('x3', function($cell) {
                    $cell->setValue('Precio Venta Sugerido de Sapolio 150gr');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('aa3:ab3');
                $sheet->cell('aa3', function($cell) {
                    $cell->setValue('Precio Venta Sugerido de Patito 150gr');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('ac3:ae3');
                $sheet->cell('ac3', function($cell) {
                    $cell->setValue('¿Cliente compro bloqueador Palmera?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }

    public function storesTromeFaseDos($company_id) {

        Excel::create('Trome Fase Dos', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas Palmera');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_trome_fase_dos(" . $company_id . ")";
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
                    "UGIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITO",
                    "FECHA",
                    "HORA",
                    "TIPO BODEGA",

                    "Respuesta",
                    "Opción",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Opción",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Opcion",
                    "Comentario",

                    "¿Cuantas unidades?",

                    "¿A qué precio ?",

                    "¿Tiene exhibido el producto?",
                    "Foto",


                    "Opcion",
                    "Comentario",


                    "Comentario Adicional",


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

                $sheet->setAutoFilter('A4:af'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('r' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('r' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('r' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
//                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }

                }

                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('v' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('v' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('v' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
//                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }

                }

                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('ac' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('ac' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('ac' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
//                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
//                    if(strlen($url_foto)>0) {
//                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
//                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
//                    }

                }

                $sheet->mergeCells('O3:R3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Se encuentra abierto el local?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('s3:v3');
                $sheet->cell('s3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('w3:y3');
                $sheet->cell('w3', function($cell) {
                    $cell->setValue('¿Rotó Trome?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('ad3:ae3');
                $sheet->cell('ad3', function($cell) {
                    $cell->setValue('¿Donde lo tiene exhibido?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

//                $sheet->mergeCells('ac3:ae3');
//                $sheet->cell('ac3', function($cell) {
//                    $cell->setValue('¿Cliente compro bloqueador Palmera?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('solid', 'none', 'none', 'solid');
//                });

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }
}