<?php
/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 6/11/2019
 * Time: 05:42
 */

class ExcelGloriaController extends BaseController {





    public function gBodegasPresentacion($company_id)
    {

        Excel::create('Gloria Presentación', function ($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('Presentación', function ($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord = "CALL sp_g_bodegas_presentacion_v1(" . $company_id . " , 5)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count++;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "PSE",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Latitud",
                    "Longitud",
                    "Ejecutivo",
                    "Coordinador",
                    "Fecha",
                    "Hora",
                    "Auditor",
                    "Rubro",
                    "Tipo",


                    "Respuesta ",
                    "Opcion",

                    "Foto",
                    "Foto",
                    "Foto",
                    "Foto",
                    "Foto",


                );

                $columns = array(
                    "S",
                    "T",
                    "V",
                    "W"
                );

                $setMargenCell = array("q3:r3", "s3:s3", "t3:t3", "u3:u3", "v3:v3", "w3:w3");
                $setFormatCell = array("q3", "s3", "t3", "u3", "v3", "w3");
                //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell = array(

                    "Cliente firmó carta de compromiso? ",
                    "Foto a la carta",
                    "Foto del DNI",
                    "Cliente recibió kit de bienvenida?",
                    "Foto cliente con kit de bienvenida",
                    "Foto al cargo de entrega",

                );

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function ($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data, null, 'A5', false, true);
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

                $sheet->setAutoFilter('A4:dg' . (count($data) + 4));


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



    public function gBodegasAuditorias($company_id)
    {

        Excel::create('Gloria Auditorias', function ($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('Auditorías', function ($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord = "CALL sp_g_bodegas_auditorias_v1(" . $company_id . " , 5)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count++;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "PSE",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Latitud",
                    "Longitud",
                    "Ejecutivo",
                    "Coordinador",
                    "Fecha",
                    "Hora",
                    "Auditor",
                    "Rubro",
                    "Tipo",


                    "respuesta",
                    "Comentario",
                    "respuesta",
                    "opcione",
                    "foto",
                    "respuesta",
                    "opciones",
                    "comentario",
                    "respuesta",
                    "Existe elemento ?",
                    "Foto",
                    "es visible",
                    "esta trabajada",
                    "está contaminado",
                    "Cumple con mix de productos? ",
                    "GLORIA UHT CHOCO X 1L (BOLSA o TTP) ",
                    "GLORIA UHT ENTERA X1L (BOLSA o TTP)",
                    "GLORIA UHT S/LACTOSA X1L (BOLSA o TTP)",
                    "GLORIA UHT NIÑOS DOBLE DHA X1L (TTP)",
                    "GLORIA UHT NIÑOS LIGTH X1L (TTP)",
                    "GLORIA EVAP.ENTERA 400GR",
                    "GLORIA EVAP. NIÑOS DOBLE DHA 400GR",
                    "GLORIA EVAP.LIGHT 400GR",
                    "GLORIA EVAP. SIN LACTOSA 400 GR",
                    "PURA VIDA EVAP. 400 GR",
                    "SOY VIDA EVAP. 400 GR",
                    "GLORIA EVAP. 170 GR",
                    "PURA VIDA EVAP. 165 GR",
                    "SOY VIDA EVAP. 155 GR",
                    "Existe exhibidor? ",
                    "Foto del Exhibidor (Solo en Si)",
                    "Es visible? ",
                    "Tiene carga minima del 50% ? ",
                    "Está contaminado? ",
                    "Existe Visicooler? ",
                    "Foto del Visicooler (Solo en Si)",
                    "Está encendido? ",
                    "Está contaminado? ",
                    "Se encuentra el buen estado el Visicooler?",
                    "Decolorado.",
                    "Roto.",
                    "Arte/Vinil Dañado. ",
                    "foto",
                    "Cumple con mix de categoría? ",
                    "MANTEQUILLA",
                    "QUESOS",
                    "YOGURT VASOS",
                    "LECHE SABORIZADA (MENOR A 1 KG)",
                    "BATIDO DE PROTEINAS (MENOR A 1 KG)",
                    "YOGURT BEBIBLE (MENOR A 1 KG)",
                    "YOGURT DE 1 KG / GALONERA",
                    "OTRAS BEBIDAS DE GLORIA",
                    "Foto al cargo de auditoría",
                    "Foto de DNI (parte delantera)",
                    "Cliente aceptó premio? ",
                    "OPCIONES",
                    "Foto del cliente con tarjeta.",
                    "Foto al cargo de premiación",
                    "Foto del DNI (parte delantera)"

                );

                $columns = array(
                    "u",
                    "aa",
                    "au",
                    "az",
                    "bg",
                    "bq",
                    "br",
                    "bu",
                    "bv",
                    "bw"
                );

                $setMargenCell = array("q3:r3","s3:u3","v3:x3","y3:y3","z3:as3","at3:ax3","ay3:bp3","bs3:bw3");
                $setFormatCell = array("q3","s3","v3","y3","z3","at3","ay3","bs3");
                //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell = array(

                    "Giro del Negocio",
                    "Cliente se encuentra abierto? ",
                    "Cliente recomendó Evaporada Azul? ",
                    "Cumple precio sugerido? (S/. 3.20)",
                    "Zona 1 - Anaquel",
                    "Zona 2 - Exhibidor ",
                    "Zona 3 - Visicooler",
                    "PREMIACION"

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

                $sheet->setAutoFilter('A4:bw' . (count($data) + 4));


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




//    Reporte Gloria ejecución


    public function gEjecucionAnaquel($company_id)
    {

        Excel::create('G.Ejecución anaquel', function ($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('Auditorías', function ($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord = "CALL sp_g_ejecucion_anaquel_v1(" . $company_id . " , 5)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count++;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "PSE",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Latitud",
                    "Longitud",
                    "Ejecutivo",
                    "Coordinador",
                    "Fecha",
                    "Hora",
                    "Auditor",
                    "Rubro",
                    "Tipo",


                    "Opciones",
                    "Comentario",

                    "Respuesta",
                    "opcion",
                    "foto",
                    "Respuesta",
                    "opcion",
                    "foto",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "foto",
                    "opcion",
                    "comentario",
                    "Foto al cargo de auditoría",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "respuesta",
                    "Gloria Leche Condensada 393 GR",
                    "Gloria Evap. Niños 400 Gr",
                    "Gloria Sin Lactorsa 400 G",
                    "Gloria Evap. Superlight 400 GR",
                    "Gloria Evap. Light 400 GR",
                    "Gloria Evap. Entera 400 G",
                    "Pura Vida Mezcla Lactea 400 GR",
                    "Soy Vida Beb. Soya Evap. 400 G",
                    "Gloria Evap. Niños 170 G",
                    "Gloria Sin Lactosa 170 G",
                    "Gloria Evap. Light 170 GR",
                    "Gloria Evap. Entera 170 GR",
                    "Pura Vida Mezcla Latea 165 GR",
                    "Soy Vida Beb. Soya Evap. 155 GR",
                    "N/A",
                    "Gloria Leche Condensada 393 GR",
                    "Gloria Evap. Niños 400 Gr",
                    "Gloria Sin Lactorsa 400 G",
                    "Gloria Evap. Superlight 400 GR",
                    "Gloria Evap. Light 400 GR",
                    "Gloria Evap. Entera 400 G",
                    "Pura Vida Mezcla Lactea 400 GR",
                    "Soy Vida Beb. Soya Evap. 400 G",
                    "Gloria Evap. Niños 170 G",
                    "Gloria Sin Lactosa 170 G",
                    "Gloria Evap. Light 170 GR",
                    "Gloria Evap. Entera 170 GR",
                    "Pura Vida Mezcla Latea 165 GR",
                    "Soy Vida Beb. Soya Evap. 155 GR",
                    "N/A",
                    "Gloria Leche Condensada 393 GR (S/. 5.00)",
                    "Gloria Evap. Niños 400 Gr (S/. 3.30)",
                    "Gloria Sin Lactorsa 400 G (S/. 3.40)",
                    "Gloria Evap. Superlight 400 GR (S/. 3.50)",
                    "Gloria Evap. Light 400 GR (S/. 3.20)",
                    "Gloria Evap. Entera 400 G (S/. 3.20)",
                    "Pura Vida Mezcla Lactea 400 GR (S/. 2.50)",
                    "Soy Vida Beb. Soya Evap. 400 G (S/. 2.20)",
                    "Gloria Evap. Niños 170 G (S/. 1.70)",
                    "Gloria Sin Lactosa 170 G (S/. 180)",
                    "Gloria Evap. Light 170 GR (S/. 1.60)",
                    "Gloria Evap. Entera 170 GR (S/ 1.60)",
                    "Pura Vida Mezcla Latea 165 GR (S/. 1.40)",
                    "Soy Vida Beb. Soya Evap. 155 GR (S/. 1.20)",
                    "N/A"
                );

                $columns = array(
                    "u",
                    "x",
                    "z",
                    "ab",
                    "ad",
                    "ag",
                    "ai"
                );

                $setMargenCell = array("Q3:R3","S3:U3","V3:X3","Y3:Z3","AA3:AB3","AC3:AD3","AE3:AF3","AG3:AG3","AH3:AI3","AJ3:AJ3","AK3:AK3","AL3:AL3","AM3:AM3","AN3:AN3","AO3:AO3","AP3:AP3","AQ3:BF3","BG3:BU3","BV3:CJ3");
                $setFormatCell = array("Q3","S3","V3","Y3","AA3","AC3","AE3","AG3","AH3","AJ3","AK3","AL3","AM3","AN3","AO3","AP3","AQ3","BG3","BV3");
                //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell = array(
                    "Indicar Giro del Negocio",
                    "Se encuentra abierto?",
                    "Cliente permitió tomar información? ",
                    "Cliente tiene equipo de frío propio? ",
                    "Tienen exhibidor Gloria? ",
                    "Tiene afiche Gloria?",
                    "A quien le compra productos Gloria? ",
                    "Foto al cargo de auditoría",
                    "Tiene Elemento?",
                    "Cumple Planograma (Evaporadas exhibidas y ordenadas según planograma.)",
                    "Cumple Tamaño (Latas grandes a la izquierda, latas chicas a la derecha o abajo)",
                    "Cumple orden por Marca (Gloria, Pura Vida, Soy Vida)",
                    "Cumple orden por Precio (De mayor a menor)",
                    "Está invadido?",
                    "Cuenta con cinta o cenefa fronterizadora Gloria? (minimo cinta o cenefa fronterizadora abajo)",
                    "Están en buen estado los productos? (Etiquetas no rotas, descoloradas ni latas abolladas)",
                    "Cumple con la exhibición de productos?  (Indicar que productos no se encontraron)",
                    "Los siguientes productos tienen marcador de precio? (Indicar que productos tienen marcador de precio)",
                    "Los siguientes productos cumplen con el precio sugerido (+/- S/. 0.10) (Indicar que productos cumplen con el precio sugerido)"
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

                $sheet->setAutoFilter('A4:bw' . (count($data) + 4));


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

    public function gEjecucionVisicooler($company_id)
    {

        Excel::create('G.Ejecución Visicooler', function ($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('Auditorías', function ($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord = "CALL sp_g_ejecucion_visicooler_v1(" . $company_id . " , 5)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count++;
                }
                //dd($data);
                $headings = array(
                    "ID",
                    "PSE",
                    "Comercio",
                    "Dirección",
                    "Distrito",
                    "Provincia",
                    "Departamento",
                    "Latitud",
                    "Longitud",
                    "Ejecutivo",
                    "Coordinador",
                    "Fecha",
                    "Hora",
                    "Auditor",
                    "Rubro",
                    "Tipo",


                    "Opciones",
                    "Comentario",
                    "Respuesta",
                    "opcion",
                    "foto",
                    "Respuesta",
                    "opcion",
                    "foto",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "foto",
                    "opcion",
                    "comentario",
                    "Foto al cargo de auditoría",
                    "respuesta",
                    "foto",
                    "respuesta",
                    "Respuesta",
                    "Decolorado.",
                    "Roto",
                    "Arte/Vinil Dañado. ",
                    "Respuesta",
                    "Respuesta",
                    "Respuesta",
                    "Respuesta",
                    "Respuesta",
                    "Respuesta",
                    "Respuesta",
                    "MANTEQUILLA",
                    "QUESOS",
                    "YOGURT VASOS",
                    "YOGURT BEBIBLE PERSONAL (MENOR A 1 KG)",
                    "YOGURT DE 1 KG",
                    "OTRAS BEBIDAS DE GLORIA",
                    "OTRAS PRODUCTOS DE GLORIA",
                    "N/A",
                    "Respuesta",
                    "MANTEQUILLA",
                    "QUESOS",
                    "YOGURT VASOS",
                    "YOGURT BEBIBLE PERSONAL (MENOR A 1 KG)",
                    "YOGURT DE 1 KG",
                    "OTRAS BEBIDAS DE GLORIA",
                    "OTRAS PRODUCTOS DE GLORIA",
                    "N/A"
                );

                $columns = array(
                    "u",
                    "x",
                    "z",
                    "ab",
                    "ad",
                    "ag",
                    "ai"
                );

                $setMargenCell = array("Q3:R3","S3:U3","V3:X3","Y3:Z3","AA3:AB3","AC3:AD3","AE3:AF3","AG3:AG3","AH3:AI3",     "AJ3:AJ3","AK3:AN3","AO3:AO3","AP3:AP3","AQ3:AQ3","AR3:AR3","AS3:AS3","AT3:AT3","AU3:BC3","BD3:BL3");
                $setFormatCell = array("Q3","S3","V3","Y3","AA3","AC3","AE3","AG3","AH3",       "AJ3","AK3","AO3","AP3","AQ3","AR3","AS3","AT3","AU3","BD3");
                //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell = array(
                    "Indicar Giro del Negocio",
                    "Se encuentra abierto?",
                    "Cliente permitió tomar información? ",
                    "Cliente tiene equipo de frío propio? ",
                    "Tienen exhibidor Gloria? ",
                    "Tiene afiche Gloria?",
                    "A quien le compra productos Gloria? ",
                    "Foto al cargo de auditoría",
                    "Tiene Elemento?",
                    "Está encendido?",
                    "Se encuentra el buen estado el Visicooler? (Operativo, Sin golpes, Brandeado)",
                    "Es visible y está bien ubicado?",
                    "Productos exhibidos según planograma?",
                    "Está invadido?",
                    "Cuenta con cinta fronterizadora?",
                    "Están en buen estado los productos? (Etiquetas no rotas, descoloradas ni latas abolladas)",
                    "Cuenta con carga?",
                    "Cumple con mix de categoría? (Indicar que categoría no se encuentra)",
                    "Tienen marcador de precio? (Indicar que categoría no tiene marcador de precio)"
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

                $sheet->setAutoFilter('A4:bl' . (count($data) + 4));


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
