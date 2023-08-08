<?php

use Illuminate\Support\Facades\Redirect;

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 14/07/2018
 * Time: 12:02
 */
class ExcelGeneralController extends BaseController {



    public function excelRoadsAndStoresForEstudy($company_id,$desde,$hasta)
    {
        Excel::create('Tiendas y Rutas por estudio', function($excel) use ($company_id,$desde,$hasta) {
            $excel->setTitle('Reporte Tiendas y Rutas');

                    $excel->sheet('Tiendas y Rutas', function($sheet) use ($company_id,$desde,$hasta) {
                        $sqlcoord="CALL sp_get_all_stores_study(".$company_id.",".$desde.",".$hasta.");";
                        $stores = DB::select($sqlcoord);
                        $data = array();
                        $data = array();
                        foreach ($stores as $result) {
                            $data[] = (array)$result;
                        }

//                        $sheet->prependRow(4, $headings);
                        $sheet->getCell('A1')->setValue(count($data));
                        $datito = $sheet->getCell('A1')->getValue();
                        $sheet->getCell('B1')->setValue($datito);
                        $sheet->fromArray($data,null,'A5',true,true);
                        $sheet->row(5, function($row) {
                            $row->setFontColor('#fefffe');
                            $row->setBackground('#2196F3');
                            $row->setFontWeight('bold');
                            $row->setAlignment('center');
                            $row->setFontSize(10);
                        });

                        $sheet->setAutoSize(true);
                        $sheet->setHeight(4, 32);
                        $sheet->setAutoFilter('A5:AD'.count($data));

                    });

        })->export('xls');
    }


    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function reportGloriaOrders($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('ORDENES GLORIA-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Gloria');
            $excel->sheet('Puntos Gloria', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_gloria_orders_v1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Nombres",
                    "Distribuidor",
                    "Codigo",
                    "Vendedor",
                    "Promotor",
                    "Fecha",
                    "Hora",
                    "Product_id",
                    "EAM",
                    "Producto",
                    "Precio",
                    "Cantidad",
                );
                // Columnas de Foto
                $columns = array("u","ag","ap","bo");
                //
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function reportGeneralGloria($fecha,$fecha1) {
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('GENERAL GLORIA-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Gloria');
            $excel->sheet('Puntos Gloria', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_gloria_general_v1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Ruc",
                    "Comercio",
                    "Distribuidor",
                    "Codigo",
                    "Latitud",
                    "Longitud",
                    "Vendedor",
                    "Promotor",
                    "Fecha",
                    "Hora",

                    "(1) Respuesta",
                    "Local Cerrado",
                    "En remodelación",
                    "Se ha mudado",
                    "Cambió de giro",
                    "Foto",

                    "(2) Respuesta",
                    "No estaba el encargado de las compras",
                    "Tiene Stock",
                    "Línea de crédito / moroso",
                    "El producto no le rota",
                    "Otros",
                    "Comentario",
                    "(3) Respuesta",
                    "Foto 1",
                    "Foto 2",
                    "Foto 3",


                );
//              Columnas de Foto
                $columns = array("q","z","aa","ab");
//
                $setMargenCell =  array("l3:q3","r3:x3","y3:ab3");
                $setFormatCell =  array("l3","r3","y3");
//                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra Abierto el local?",
                    "Hizo pedido?",
                    "¿Cliente permitió trabajar exhibición o colocar POP ? Tomar foto de fachada (mostrando pop), anaquel y visicooler. Hasta 3 fotos?",

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

                $sheet->setAutoFilter('A4:AB'.(count($data) + 4));


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

    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function reportAlicorpSolutionsOrders($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('ORDENES ALICORP SOLUCIONES-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Alicorp Soluciones');
            $excel->sheet('Puntos Alicorp Solutions', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_alicorp_solutions_orders(5,'" . $fechaI . "','". $fechaII."')";
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
                    "Nombres",
                    "Distribuidor",
                    "Codigo",
                    "Vendedor",
                    "Promotor",
                    "Fecha",
                    "Hora",
                    "Product_id",
                    "EAM",
                    "Producto",
                    "Precio",
                    "Cantidad",
                );
//              Columnas de Foto
                $columns = array("u","ag","ap","bo");
//
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
//                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function reportAlicorpSolutionsProducts($fecha,$fecha1) {
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('PRODUCTOS ALICORP SOLUCIONES-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Alicorp Soluciones');
            $excel->sheet('Puntos Alicorp Soluciones', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_alicorp_solutions_products(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Nombres",
                    "Distribuidor",
                    "Codigo",
                    "Vendedor",
                    "Promotor",
                    "Fecha",
                    "Hora",

                    "(1) Respuesta",
                    "Opción",
                    "Foto",

                    "(2) Respuesta",
                    "Opción",

                    "(3) Lunes",
                    "Martes",
                    "Miércoles",
                    "Jueves",
                    "Viernes",
                    "Sábado",

                    "(4) Opción",

                    "(5) Respuesta",
                    "Opción",

                    "(6) Nombre",

                    "(7) Respuesta",
                    "Opción",

                    "(8) Respuesta",

                    "(9) Comentario",

                );
//              Columnas de Foto
                $columns = array("k");
//
                $setMargenCell =  array("i3:k3","l3:m3","n3:s3","t3:t3","u3:v3","w3:w3","x3:y3","z3:z3","aa3:aa3");
                $setFormatCell =  array("i3","l3","n3","t3","u3","w3","x3","z3","aa3");
//                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra Abierto el local?",
                    "¿Cliente permitio tomar información?",
                    "Días de preferencia para pedido",
                    "Frecuencia para preferencia de pedido",
                    "Cliente realizo compra",
                    "Producto",
                    "Compro el producto anteriormente",
                    "¿Adquirio el producto en su ultima compra?",
                    "¿Cuantas veces a comprado el producto?",

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

                $sheet->setAutoFilter('A4:AA'.(count($data) + 4));


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


    public function reportAngelOrders($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('STOCK ANGEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Angel');
            $excel->sheet('Puntos Angel', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_angel_stock_v1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Puesto",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                    "Product_id",
                    "EAM",
                    "Producto",
                    "Cantidad",
                );
                // Columnas de Foto
                $columns = array("u","ag","ap","bo");
                //
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    public function reportAngelVisibility($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('VISIBILITY ANGEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Angel');
            $excel->sheet('Puntos Angel', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_angel_visibilidad_v1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Puesto",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                    "Publicidad",
                    "Foto Antes",
                    "Foto Despues",
                    "Comentario",
                );
                // Columnas de Foto
                $columns = array("n","o");
                //
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    public function reportAngelOrders_v2($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('STOCK ANGEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Angel');
            $excel->sheet('Puntos Angel', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_angel_stock_v2(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Puesto",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                    "Product_id",
                    "EAM",
                    "Producto",
                    "Cantidad",
                );
                // Columnas de Foto
                $columns = array("u","ag","ap","bo");
                //
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    public function reportAngelVisibility_v2($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('VISIBILITY ANGEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Angel');
            $excel->sheet('Puntos Angel', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_angel_visibilidad_v2(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Puesto",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                    "Publicidad",
                    "Foto Antes",
                    "Foto Despues",
                    "Comentario",
                );
                // Columnas de Foto
                $columns = array("n","o");
                //
                $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:ar3","as3:at3","au3:au3","av3:ay3","az3:az3","ba3:ba3","bb3:bb3","bc3:be3","bf3:bh3","bi3:bj3","bk3:bk3","bl3:bl3","bm3:bm3","bn3:bo3","bp3:bv3","bw3:bz3","ca3:cd3","ce3:ce3","cf3:cm3","cn3:cq3","cr3:cu3","cv3:df3","dg3:dg3","dh3:di3");
                $setFormatCell =  array("q3","v3","x3","ah3","aq3","as3","au3","av3","az3","ba3","bb3","bc3","bf3","bi3","bk3","bl3","bm3","bn3","bp3","bw3","ca3","ce3","cf3","cn3","cr3","cv3","dg3","dh3");
                // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                $setTextCell =  array(

                    "¿Se encuentra abierto el agente?",
                    "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                    "¿El letrero IBK Agente es visible desde fuera?",
                    "¿El letrero IBK Agente es visible estando dentro del establecimiento?",
                    "¿Existe algún otro Agente / corresponsal bancario?",
                    "El CI deberá preguntar: ¿Puedo pagar mi tarjeta de crédito Interbank aquí?",
                    "Preguntar: ¿Aquí puedo pagar mi teléfono?",
                    "Si responde que sí en la P8, preguntar: ¿Y en cuál agente me conviene pagar mi teléfono?",
                    "Si me envían dinero del exterior, ¿Puedo cobrarlo aquí?",
                    "Al preguntar si se podía hacer la operación correspondiente, ¿el dependiente aceptó realizar la operación?",
                    "¿Su solicitud fue atendido de inmediato?",
                    " Su solicitud no fue atendida de inmediato porque",
                    "Mientras esperaba. ¿La persona que lo atendió se preocupó por su tiempo?",
                    "Después de esperar",
                    "¿La transacción se llegó a realizar de manera exitosa?  (Se considera exitosa cuando se entrega el voucher)",
                    "¿Cuántos MINUTOS transcurrieron entre que solicitó la transacción y la persona terminó (le entregá el voucher)?",
                    "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                    "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Por qué no se pudo realizar la transacción?",
                    "(SÓLO SI NO SE REALIZÓ LA TRANSACCIÓN) ¿Le dieron alguna solución para poder realizar la transacción?",
                    "Escoger tipo de Transacción",
                    "¿El agente hizo algún cobro fuera del voucher?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                    "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                    "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                    "Otras apreciaciones a comentar",
                    "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",

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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                /*for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }*/

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    public function reportAngelVisibility_product_v2($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('VISIBILITY PROD ANGEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Promotoria Angel');
            $excel->sheet('Puntos Angel', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_angel_visibilidad_product_v2(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Puesto",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                    "Publicidad",
                    "Producto",
                    "Cantidad",
                );
                // Columnas de Foto
                $columns = array();
                //


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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }
//-------------------------------LIFE -----------------------------------------------------

    /**
     *
     * Reporte de Life Modulo de compra
     * @param $fecha
     * @param $fecha1
     */
    public function reportLifeModCompra($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('Life-Mod-Compra-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Life Mod. Compra');
            $excel->sheet('Mod. Compra', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_life_audit_one_v1(5,'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Cod. vendedor",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",
                     "respuesta",
                     "foto",
                     "respuesta",
                     "respuesta",
                     "comentario",
                     "respuesta",
                     "comentario",
                     "respuesta",
                     "comentario",
                     "respuesta"
                );
                // Columnas de Foto
                $columns = array("n");
                //

                $setMargenCell =  array("m3:n3","o3:o3","p3:q3","r3:s3","t3:u3","v3:v3");
                $setFormatCell =  array("m3","o3","p3","r3","t3","v3");
//              $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");

                $setTextCell =  array(
                    "Se encuentra abierto el local",
                    "¿CLIENTE COMPRÓ PRODUCTO?",
                    "CLIENTE COMPRO TIRA LIFE MULTIGRAIN?",
                    "CLIENTE COMPRO TIRA LIFE FIBRA?",
                    "Motivo de no compra del cliente",
                    "En qué fecha visitó el punto ? "
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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));

//------------------fotooooooooooooooooooooooo
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


    /**
     * Modulo de Visitas
     * @param $fecha
     * @param $fecha1
     */
    public function reportLifeModVisitas($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('Life-Mod-Visita-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Life Mod. Visita');
            $excel->sheet('Mod. Visita', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_life_audit_2_v1(5,'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Cod. vendedor",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",

                    "respuesta",
                    "comentario",

                    "Mustra gratis de producto",
                    "Afiche",
                    "Gachera",
                    "Hoja vendedora",
                    "Lapicero",
                    "No se entregó nada"
                );
                // Columnas de Foto
                $columns = array("n");
                //

                $setMargenCell =  array("m3:n3","o3:t3");
                $setFormatCell =  array("m3","o3");
//              $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");

                $setTextCell =  array(
                    "Había producto vencido?",
                    "Merch entregado"
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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


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


    /**
     * Modulo de información
     * @param $fecha
     * @param $fecha1
     */
    public function reportLifeModInformacion($fecha,$fecha1) {
        // dd(Auth::user()->id);
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('Life-Mod-info-'.$fecha, function($excel) use ($fechaI,$fechaII) {
            $excel->setTitle('Life Mod. Info');
            $excel->sheet('Mod. Info', function($sheet) use ($fechaI,$fechaII) {
                $sqlcoord="CALL sp_life_audit_3_v1(5,'" . $fechaI . "','". $fechaII."')";
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
                    "Store_id",
                    "Mercado",
                    "Distrito",
                    "region",
                    "Ubigeo",
                    "Distribuidor",
                    "Cod. cliente",
                    "Cod. vendedor",
                    "Comentario",
                    "Auditor",
                    "Fecha",
                    "Hora",

                    "Opciones",

                    "Opciones",
                    "comentario",

                    "Respuesta",

                    "Opciones",
                    "comentario",


                );
                // Columnas de Foto
                $columns = array("n");
                //

                $setMargenCell =  array("m3:m3","n3:o3","p3:p3","q3:r3");
                $setFormatCell =  array("m3","n3","p3","q3");
//              $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");

                $setTextCell =  array(
                    "Afluencia de personas por e establecimiento",
                    "Lugares cercanos al establecimiento",
                    "Dentro del establecimiento, es visible el producto?",
                    "Dónde se encuentra posicionado el producto?"
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

                $sheet->setAutoFilter('A4:M'.(count($data) + 4));


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

    public function mayoristaGloriaVisibilidadVarios($fecha,$fecha1) {
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('MAYO_GLO_VARIOS-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Mayorista Gloria');
                $excel->sheet('Visibilidad Gloria', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_gloria_mayorista_v2_p2(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Tipo",
                        "Fecha",
                        "Hora",
                        "Respuesta",//k

                        "¿Existe elemento?",//l
                        "Foto",
                        "¿Elemento limpio?",
                        "¿Elemento en buen estado?",

                        "¿Existe elemento?",//p
                        "Foto",
                        "¿Elemento limpio?",
                        "¿Elemento en buen estado?",

                        "¿Existe elemento?",//t
                        "Foto",
                        "¿Elemento limpio?",
                        "¿Elemento en buen estado?"
                    );
                    // Columnas de Foto
                    $columns = array("m","q","u");
                    //
                    $setMargenCell =  array("k3:k3","l3:o3","p3:s3","t3:w3");
                    $setFormatCell =  array("k3","l3","p3","t3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Permitio tomar información?",

                        "Elemento Toldo",

                        "Elemento Panel",

                        "Elemento Banner",

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

    public function mayoristaGloriaVisibilidadAnaquel($fecha,$fecha1){
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('MAYOR_GLO_ANAQUEL-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Mayorista Gloria Anaquel');
                $excel->sheet('Visibilidad Anaquel', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_gloria_mayorista_v2_p1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Tipo",
                        "Fecha",
                        "Hora",
                        "Respuesta",//k

                        "¿Hay un bloque de productos Gloria?",//l
                        "Foto",//M

                        "¿Está ubicado en zona caliente?",//N
                        "¿Está delimitado con cinta fronteriza?",//O

                        "¿Solo tiene productos Gloria?",//P
                        "¿Sigue el planograma Gloria?",//Q
                        "¿Tiene el mínimo de Sku´s de leches evaporadas?",//R

                        "¿Tiene el mínimo de marcadores de precio?"//S
                    );
                    // Columnas de Foto
                    $columns = array("m");
                    //
                    $setMargenCell =  array("k3:k3","l3:s3");
                    $setFormatCell =  array("k3","l3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Permitio tomar información?",

                        "ANAQUEL",

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

                    $sheet->setAutoFilter('A4:S'.(count($data) + 4));


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

    public function mayoristaGloriaVisibilidadExhibi($fecha,$fecha1){
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('MAYOR_GLO_EXHIBIDOR-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Mayorista Gloria Exhibidor');
                $excel->sheet('Visibilidad Exhibidor', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_gloria_mayorista_v2_p3(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Tipo",
                        "Fecha",
                        "Hora",
                        "Respuesta",//k

                        "¿Hay alguna Exhibición de AFICHE?",//l
                        "Foto",//M
                        "¿Esta ubicado en lugar preferente?",//N
                        "¿Tiene marcadores?",//O

                        "¿Hay alguna Exhibición de ARTESANAL?",//p
                        "Foto",//q
                        "¿Esta ubicado en lugar preferente?",//r
                        "¿Tiene marcadores?",//s

                        "¿Hay alguna Exhibición de PRODUCTOS?",//t
                        "Foto",//u
                        "¿Esta ubicado en lugar preferente?",//v
                        "¿Tiene marcadores?",//w
                    );
                    // Columnas de Foto
                    $columns = array("m","q","u");
                    //
                    $setMargenCell =  array("k3:k3","l3:o3","p3:s3","t3:w3");
                    $setFormatCell =  array("k3","l3","p3","t3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Permitio tomar información?",

                        "AFICHE",
                        "ARTESANAL",
                        "PRODUCTOS"

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

    public function mayoristaGloriaVisibilidadVisicooler($fecha,$fecha1){
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('MAYOR_GLO_VISICOOLER-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Mayorista Gloria Visicooler');
                $excel->sheet('Visibilidad Visicooler', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_gloria_mayorista_v2_p4(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Tipo",
                        "Fecha",
                        "Hora",
                        "Respuesta",//k

                        "¿Existe Visicooler?",//l
                        "Foto",//M
                        "¿Esta encendido?",//N
                        "¿Es visible?",//O

                        "¿Esta en lugar accesible?",//p
                        "¿solo exhibe paquetes Gloria?",//q
                        "¿Tiene marcadores (precio por paquete)?",//r
                        "¿solo exhibe unidades Gloria?",//s
                        "¿Tiene marcadores (precio por unidad)?",//t
                    );
                    // Columnas de Foto
                    $columns = array("m");
                    //
                    $setMargenCell =  array("k3:k3","l3:t3");
                    $setFormatCell =  array("k3","l3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Permitio tomar información?",

                        "VISICOOLER"

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

                    $sheet->setAutoFilter('A4:T'.(count($data) + 4));


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

    public function mayoristaGloriaVisibilidadRumas($fecha,$fecha1){
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('MAYOR_GLO_RUMAS-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Mayorista Gloria Rumas');
                $excel->sheet('Visibilidad Rumas', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_gloria_mayorista_v2_p5(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Tipo",
                        "Fecha",
                        "Hora",
                        "Respuesta",//k

                        "¿Existe Ruma Yogourt?",//l
                        "Foto",//M
                        "¿Esta ubicado lugar preferente?",//N
                        "¿tiene un rango?",//O
                        "¿tiene marcador precio por paquete?",//P

                        "¿Existe Ruma Nectares?",//Q
                        "Foto",//R
                        "¿Esta ubicado lugar preferente?",//S
                        "¿tiene un rango?",//T
                        "¿tiene marcador precio por paquete?",//U

                        "¿Existe Ruma Tall?",//V
                        "Foto",//W
                        "¿Esta ubicado lugar preferente?",//X
                        "¿tiene un rango?",//Y
                        "¿tiene marcador precio por paquete?",//Z
                    );
                    // Columnas de Foto
                    $columns = array("m","r","w");
                    //
                    $setMargenCell =  array("k3:k3","l3:p3","q3:u3","v3:z3");
                    $setFormatCell =  array("k3","l3","q3","v3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Permitio tomar información?",

                        "YOGOURT",
                        "NECTARES",
                        "TALL"

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

                    $sheet->setAutoFilter('A4:Z'.(count($data) + 4));


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

    public function palmeraOrders($fecha,$fecha1){
        if (is_object(Auth::user())){
            $fechaT = explode('-',$fecha);
            $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            $fechaT = explode('-',$fecha1);
            $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
            header('Access-Control-Allow-Origin: *');
            Excel::create('PALMERAS-'.$fecha, function($excel) use ($fechaI,$fechaII) {
                $excel->setTitle('Palmeras Orders');
                $excel->sheet('Orders', function($sheet) use ($fechaI,$fechaII) {
                    $sqlcoord="CALL sp_palmera_orders_v1(". Auth::user()->id .",'" . $fechaI . "','". $fechaII."')";
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
                        "Nombres",
                        "Dirección",
                        "Distrito",
                        "Región",
                        "Ubigeo",
                        "Auditor",
                        "Fecha",
                        "Hora",

                        "DNI",//j

                        "Id Producto",//k
                        "EAM",//l
                        "Producto",//m

                        "Precio",//n
                        "Cantidad",//o
                    );
                    // Columnas de Foto
                    $columns = array();
                    //
                    $setMargenCell =  array("k3:o3");
                    $setFormatCell =  array("k3");
                    // $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "Pedido"

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

                    $sheet->setAutoFilter('A4:O'.(count($data) + 4));


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

    public function reportCigarrerasProducts($company_id,$parte,$fecha,$fecha1) {
        $fechaT = explode('-',$fecha);
        $fechaI = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        $fechaT = explode('-',$fecha1);
        $fechaII = $fechaT[0].'/'.$fechaT[1].'/'.$fechaT[2];
        header('Access-Control-Allow-Origin: *');
        Excel::create('BatCigarreras1_'.$parte."_".$fecha, function($excel) use ($company_id,$parte,$fechaI,$fechaII) {
            $excel->setTitle('Bat Cigarreras'.$parte);
            $excel->sheet('Puntos Bat Cigarreras'.$parte, function($sheet) use ($company_id,$parte) {
                $sqlcoord="CALL sp_bat_cigarreras1(". Auth::user()->id .",'" . $company_id."','" . $parte."')";
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
                if ($parte==1)
                {
                    $headings = array(
                        "ID",
                        "Nombres",
                        "Distrito",
                        "Region",
                        "Ubigeo",
                        "Auditor",
                        "Fecha",
                        "Hora",

                        "(1) Respuesta",//i4
                        "Opción",
                        "Otro",
                        "Foto",

                        "(2) Respuesta",//m
                        "Opción",

                        "(3) Respuesta",//o
                        "Foto",
                        "Comentario",

                        "(5) Respuesta",//r
                        "Comentario",

                        "(4.1) Respuesta",//t
                        "Cantidad",
                        "Foto",

                        "(4.2) Respuesta",//w
                        "Cantidad",
                        "Foto",

                        "(4.3) Respuesta",//z
                        "Cantidad",
                        "Foto",

                        "(4.4) Respuesta",//ac
                        "Cantidad",
                        "Foto",

                        "(4.5) Respuesta",//af
                        "Cantidad",
                        "Foto",

                        "(4.6) Respuesta",//ai
                        "Cantidad",
                        "Foto",

                        "(4.7) Respuesta",//al
                        "Cantidad",
                        "Foto",

                        "(4.8) Respuesta",//ao
                        "Cantidad",
                        "Foto",

                        "(4.9) Respuesta",//ar
                        "Cantidad",
                        "Foto",

                        "(4.10) Respuesta",//au
                        "Cantidad",
                        "Foto",

                        "(4.11) Respuesta",//ax
                        "Cantidad",
                        "Foto",

                        "(4.12) Respuesta",//ba
                        "Cantidad",
                        "Foto",

                        "(4.13) Respuesta",//bd
                        "Cantidad",
                        "Foto",

                        "(4.14) Respuesta",//bg
                        "Cantidad",
                        "Foto",

                        "(4.15) Respuesta",//bj
                        "Cantidad",
                        "Foto",

                    );
                }

                if ($parte==2)
                {
                    $headings = array(
                        "ID",
                        "Nombres",
                        "Distrito",
                        "Region",
                        "Ubigeo",
                        "Auditor",
                        "Fecha",
                        "Hora",

                        "(1) Respuesta",//i4
                        "Opción",
                        "Otro",
                        "Foto",

                        "(2) Respuesta",//m
                        "Opción",

                        "(3) Respuesta",//o
                        "Foto",
                        "Comentario",

                        "(5) Respuesta",//r
                        "Comentario",

                        "(4.16) Respuesta",//t
                        "Cantidad",
                        "Foto",

                        "(4.17) Respuesta",//w
                        "Cantidad",
                        "Foto",

                        "(4.18) Respuesta",//z
                        "Cantidad",
                        "Foto",

                        "(4.19) Respuesta",//ac
                        "Cantidad",
                        "Foto",

                        "(4.20) Respuesta",//af
                        "Cantidad",
                        "Foto",

                        "(4.21) Respuesta",//ai
                        "Cantidad",
                        "Foto",

                        "(4.22) Respuesta",//al
                        "Cantidad",
                        "Foto",

                        "(4.23) Respuesta",//ao
                        "Cantidad",
                        "Foto",

                        "(4.24) Respuesta",//ar
                        "Cantidad",
                        "Foto",

                        "(4.25) Respuesta",//au
                        "Cantidad",
                        "Foto",

                        "(4.26) Respuesta",//ax
                        "Cantidad",
                        "Foto",

                        "(4.27) Respuesta",//ba
                        "Cantidad",
                        "Foto",

                    );
                }

//              Columnas de Foto
                if ($parte==1)
                {
                    $columns = array("l","p","y","ab","ae","ah","ak","an","aq","at","aw","az","bc","bf","bi","bl");
                }
                if ($parte==2)
                {
                    $columns = array("l","p","y","ab","ae","ah","ak","an","aq","at","aw","az","bc");
                }

                if ($parte==1)
                {
                    $setMargenCell =  array("i3:l3","m3:n3","o3:q3","r3:s3","t3:v3","w3:y3","z3:ab3","ac3:ae3","af3:ah3","ai3:ak3","al3:an3","ao3:aq3","ar3:at3","au3:aw3","ax3:az3","ba3:bc3","bd3:bf3","bg3:bi3","bj3:bl3");
                    $setFormatCell =  array("i3","m3","o3","r3","t3","w3","z3","ac3","af3","ai3","al3","ao3","ar3","au3","ax3","ba3","bd3","bg3","bj3");

                    $setTextCell =  array(

                        "¿Se encuentra Abierto el local?",
                        "¿Cliente permitio tomar información?",
                        "Cuenta con cigarrera",
                        "Recuerda nombre de Vend. Jandy",

                        "BLACK PIANO DOBLE",
                        "BLACK PIANO SIMPLE",
                        "CAJA DE LUZ/CAJA LUZ 7CAV",
                        "CAJA LUZ 7CAV",
                        "CIG 8 CAALT",
                        "CIG AEREA 10CAPIX",
                        "CIG AEREA 10CAPIX TV",
                        "CIG AEREA 10CAV",
                        "CIG AEREA 10CAV PLUS",
                        "CIG AEREA 16CAMAD",
                        "CIG AEREA 6CAMAD",
                        "CIG AEREA 6CAPLA",
                        "CIG AEREA 7CAV",
                        "CIG AEREA 7CAV PLUS",
                        "CIG AEREA 8CAALT",

                    );
                }

                if ($parte==2)
                {
                    $setMargenCell =  array("i3:l3","m3:n3","o3:q3","r3:s3","t3:v3","w3:y3","z3:ab3","ac3:ae3","af3:ah3","ai3:ak3","al3:an3","ao3:aq3","ar3:at3","au3:aw3","ax3:az3","ba3:bc3");
                    $setFormatCell =  array("i3","m3","o3","r3","t3","w3","z3","ac3","af3","ai3","al3","ao3","ar3","au3","ax3","ba3");

                    $setTextCell =  array(

                        "¿Se encuentra Abierto el local?",
                        "¿Cliente permitio tomar información?",
                        "Cuenta con cigarrera",
                        "Recuerda nombre de Vend. Jandy",

                        "CIG AEREA PIXEL 3.0",
                        "CIG AEREA PIXEL 3.0 MD 12.",
                        "CIG BACK W. PIXEL 3.0",
                        "CIG PARED 6CAGR",
                        "CIG PARED 6CAPQ",
                        "CIG PARED 7CAV",
                        "CIG. AEREA 7CAV PLUS",
                        "CIG. BLACK WALL PIXEL 3.0",
                        "CIGARRERA PIXEL MD12",
                        "PANTALLA 3.0 AEREA/10CAPIX",
                        "PIXEL PARED/PIXEL TRANSFORMADA",
                        "TRANSFORMER",

                    );
                }


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

                if ($parte==1)
                {
                    $sheet->setAutoFilter('A4:bk'.(count($data) + 4));
                }
                if ($parte==2)
                {
                    $sheet->setAutoFilter('A4:bc'.(count($data) + 4));
                }


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



}
