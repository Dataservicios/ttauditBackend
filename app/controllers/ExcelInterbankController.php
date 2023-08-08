<?php

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 22/04/2018
 * Time: 09:45
 */
class ExcelInterbankController  extends BaseController {


    public function ibkInventario($company_id) {

        Excel::create('IBK Inventario', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas IBK');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_ibk_inventario(" . $company_id . ")";
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
                    "Foto",

                    "Respuesta",

                    "Fachada",
                    "Zona Banca Electrónica",
                    "IBO",
                    "Pizarras",
                    "Interiores",
                    "Señalética Varias",
                    "Exhibición de Folletos",
                    "Televisores",
                    "Separadores de Cola",
                    "Viniles",
                    "Otros Elementos",


                );

                $columns = array(
                    "P",
                    "R",
                    "S",
                    "T",
                    "U",
                    "V",
                    "W",
                    "x",
                    "y",
                    "z",
                    "aa",
                    "ab"
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

                $sheet->setHeight(4, 25);





                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setValignment('center');
                    $row->setFontSize(10);
                    $row->setBorder('thin','thin','thin','thin');
                });

                $sheet->setAutoFilter('A4:aB'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("ABRIR GALERIA");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir galeria');
                        }
                    }

                }


                $sheet->mergeCells('O3:p3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Se encuentra abierto el local?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });

                $sheet->mergeCells('q3:q3');
                $sheet->cell('q3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información??');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setValignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');
                });


                $sheet->setWidth('o', 40);
                $sheet->setWidth('q', 40);
                $sheet->setHeight(3, 25);



                $sheet->cell('Q3', function($cell) {
                    $cell->setBorder('thin', 'thin', 'thin', 'thin');

                });
//
                $sheet->cells('O4:p4', function($cells) {
                    $cells->setBorder('thin', 'thin', 'thin', 'thin');

                });



//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls');

    }


    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function ibkV6($company_id,$pag) {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('IBK-'.$pag."_".$company_id."_".$fecha, function($excel) use ($company_id,$pag) {
            $excel->setTitle('IBK_V6_'.$pag);
            $excel->sheet('Tiendas IBK', function($sheet) use ($company_id,$pag) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_ibk_v6(" . $company_id . ",". Auth::user()->id .",".$pag.")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }

                if ($pag == 2){
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



                        "(3) Respuesta ",
                        "(3) Local Cerrado",
                        "(3) Ya no es Agente",
                        "(3) Existe señalización pero pidio retiro",
                        "(3) Foto",

                        "(1) Respuesta ",
                        "(1) Comentario ",

                        "(24) Saluda",
                        "(24) Usa el por favor",
                        "(24) Da las gracias",
                        "(24) Sonríe",
                        "(24) Mira a los ojos",
                        "(24) No interrumpe",
                        "(24) Despedida",
                        "(24) Estandar",

                        "(25) Conoce las operaciones que se puede realizar en agente",
                        "(25) Sabe cómo operar el pos al realizar la operación",
                        "(25) No solicita ayuda para realizar la operación",
                        "(25) Estandar",

                        "(26) Pendiente de  usted durante la atención",
                        "(26) Concentrado en la operación mientras atendía",
                        "(26) Le ofreció un producto o servicio adicional",
                        "(26) Estandar",

                        "(27) Respuesta",
                        "(27) Incremento de clientes",
                        "(27) Más ventas",
                        "(27) Comisiones",
                        "(27) Mejora de imagen",
                        "(27) Porque me diferencia de la competencia",
                        "(27) Porque los clientes lo solicitan",
                        "(27) Seguridad",
                        "(27) Pérdida de tiempo",
                        "(27) Las comisiones son bajas",
                        "(27) No precisa",

                        "(28) Respuesta",

                        "(41) Respuesta",
                        "(41) Comentario",//ant

                        "(50) Tarjeta de débito",
                        "(50) Tarjeta de crédito",
                        "(50) Solo Efectivo",
                        "(50) Otros",
                        "(50) Coment_otro",

                        "(51) Respuesta",
                        "(51) Comentario",

                        "(52) Visanet",
                        "(52) Paypal",
                        "(52) Izypay",
                        "(52) Otro",
                        "(52) coment_otro",
                        "(52) Ninguno",
                        "(52) Foto",

                        "(53) Rejas",
                        "(53) Cinta de seguridad",
                        "(53) Acrílicos",
                        "(53) Plástico",
                        "(53) Otros",
                        "(53) Coment_otros",
                        "(53) foto",

                        "(54) Respuesta",

                        "(55) Respuesta"


                    );
                    //              Columnas de Foto
                    $columns = array("u","bo","bv");
                    //
                    $setMargenCell =  array("q3:u3","v3:w3","x3:ae3","af3:ai3","aj3:am3","an3:ax3","ay3:ay3","az3:ba3","bb3:bf3","bg3:bh3","bi3:bo3","bp3:bv3","bw3:bw3","bx3:bx3");
                    $setFormatCell =  array("q3","v3","x3","af3","aj3","an3","ay3","az3","bb3","bg3","bi3","bp3","bw3","bx3");
                    //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Se encuentra abierto el agente?",
                        "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",
                        
                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                        "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                        "Otras apreciaciones a comentar",
                        "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",
                        "¿El agente permite el pago de consumo con tarjeta de débito o crédito?",
                        "¿Hay monto mínimo?",
                        "¿Qué medio digital de pago utiliza el agente?",
                        "Forma de atención del agente.",
                        "¿Puedo abrir una cuenta Interbank aquí?",
                        "¿Agente se mostró interesado?"
                    );
                }else{
                    
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



                        "(3) Respuesta ",
                        "(3) Local Cerrado",
                        "(3) Ya no es Agente",
                        "(3) Existe señalización pero pidio retiro",
                        "(3) Foto",

                        "(1) Respuesta ",
                        "(1) Comentario ",

                        "(4) Respuesta",
                        "(4) Letrero de metal o madera",
                        "(4) Rompe tráfico",
                        "(4) Letrero luminoso",
                        "(4) Letrero luminoso Bandera",
                        "(4) Letrero compartido",
                        "(4) Banner",
                        "(4) Otros",
                        "(4) Comentario",
                        "(4) Foto",

                        "(5) Respuesta",
                        "(5) Colgante",
                        "(5) Mostrador",
                        "(5) Banner",
                        "(5) Fronterizador",
                        "(5) Posavuelto",
                        "(5) Otros",
                        "(5) Comentario",
                        "(5) Foto",

                        "(6) Respuesta",
                        "(6) Comentario",

                        "(7 Respuesta)",
                        "(7) Comentario",

                        "(8 Respuesta)",

                        "(9) Interbank",
                        "(9) Otro Agente",
                        "(9) En cualquiera/En el que usted decida/En los dos",
                        "(9) No Precisa",

                        "(10) Respuesta",

                        "(11) Respuesta",

                        "(12) Respuesta",

                        "(13) El encargado estaba ocupado",
                        "(13) Porque me indicó que no había sistema",
                        "(13) Otro",

                        "(14) Pidiéndole que por favor espere mientras terminaba de atender a otro cliente",
                        "(14) Preguntándole desde que llegó, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe",
                        "(14) Otro",

                        "(15) Me atendieron",
                        "(15) No me atendieron",

                        "(16) Respuesta",

                        "(17) Respuesta",

                        "(18) Respuesta",

                        "(19) Respuesta",
                        "(19) Foto",

                        "(20) No había sistema",
                        "(20) La línea estaba copada para el depósito",
                        "(20) La persona que atiende (operador) no estaba disponible",
                        "(20) POS no operativo",
                        "(20) No había efectivo disponible para el retiro",
                        "(20) Falta de conocimiento de la operativa / capacitación",
                        "(20) Otro",

                        "(21) Le pidió regrese más tarde",
                        "(21) Lo guio hacia otro Agente",
                        "(21) Le dijo como llegar a alguna Tienda Interbank",
                        "(21) Otros",

                        "(22) Pago de TC",
                        "(22) Retiro",
                        "(22) Deposito",
                        "(22) Pago de servicio",


                        "(23) Respuesta",

                        "(24) Saluda",
                        "(24) Usa el por favor",
                        "(24) Da las gracias",
                        "(24) Sonríe",
                        "(24) Mira a los ojos",
                        "(24) No interrumpe",
                        "(24) Despedida",
                        "(24) Estandar",

                        "(25) Conoce las operaciones que se puede realizar en agente",
                        "(25) Sabe cómo operar el pos al realizar la operación",
                        "(25) No solicita ayuda para realizar la operación",
                        "(25) Estandar",

                        "(26) Pendiente de  usted durante la atención",
                        "(26) Concentrado en la operación mientras atendía",
                        "(26) Le ofreció un producto o servicio adicional",
                        "(26) Estandar",

                        "(27) Respuesta",
                        "(27) Incremento de clientes",
                        "(27) Más ventas",
                        "(27) Comisiones",
                        "(27) Mejora de imagen",
                        "(27) Porque me diferencia de la competencia",
                        "(27) Porque los clientes lo solicitan",
                        "(27) Seguridad",
                        "(27) Pérdida de tiempo",
                        "(27) Las comisiones son bajas",
                        "(27) No precisa",

                        "(28) Respuesta",

                        "(41) Respuesta",
                        "(41) Comentario",


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
                }
                

                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data,null,'A5',true,false);
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
                if ($pag == 2){
                    $sheet->setAutoFilter('A4:BX'.(count($data) + 4));
                }else{
                    $sheet->setAutoFilter('A4:dg'.(count($data) + 4));
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
                if ($pag == 1){
                    $sheet->getColumnDimension('CF')->setVisible(false);
                    $sheet->getColumnDimension('CG')->setVisible(false);
                    $sheet->getColumnDimension('CH')->setVisible(false);
                    $sheet->getColumnDimension('CI')->setVisible(false);
                    $sheet->getColumnDimension('CJ')->setVisible(false);
                    $sheet->getColumnDimension('CK')->setVisible(false);
                    $sheet->getColumnDimension('CL')->setVisible(false);
                    $sheet->getColumnDimension('CM')->setVisible(false);
                    $sheet->getColumnDimension('CN')->setVisible(false);
                    $sheet->getColumnDimension('CO')->setVisible(false);
                    $sheet->getColumnDimension('CP')->setVisible(false);
                    $sheet->getColumnDimension('CQ')->setVisible(false);
                    $sheet->getColumnDimension('CR')->setVisible(false);
                    $sheet->getColumnDimension('CS')->setVisible(false);
                    $sheet->getColumnDimension('CT')->setVisible(false);
                    $sheet->getColumnDimension('CU')->setVisible(false);
                    $sheet->getColumnDimension('CV')->setVisible(false);
                    $sheet->getColumnDimension('CW')->setVisible(false);
                    $sheet->getColumnDimension('CX')->setVisible(false);
                    $sheet->getColumnDimension('CY')->setVisible(false);
                    $sheet->getColumnDimension('CZ')->setVisible(false);
                    $sheet->getColumnDimension('DA')->setVisible(false);
                    $sheet->getColumnDimension('DB')->setVisible(false);
                    $sheet->getColumnDimension('DC')->setVisible(false);
                    $sheet->getColumnDimension('DD')->setVisible(false);
                    $sheet->getColumnDimension('DE')->setVisible(false);
                    $sheet->getColumnDimension('DF')->setVisible(false);
                    $sheet->getColumnDimension('DG')->setVisible(false);
                    $sheet->getColumnDimension('DH')->setVisible(false);
                    $sheet->getColumnDimension('DI')->setVisible(false);
                }
                
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    /**
     * Excel ibkV5
     * @param $company_id
     */
    public function ibkV5($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('IBK-'.$company_id, function($excel) use ($company_id) {
            $excel->setTitle('IBK');
            $excel->sheet('Tiendas IBK', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_ibk_v5(" . $company_id . ",". Auth::user()->id .")";
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



                    "(3) Respuesta ",
                    "(3) Local Cerrado",
                    "(3) Ya no es Agente",
                    "(3) Existe señalización pero pidio retiro",
                    "(3) Foto",

                    "(1) Respuesta ",
                    "(1) Comentario ",

                    "(4) Respuesta",
                    "(4) Letrero de metal o madera",
                    "(4) Rompe tráfico",
                    "(4) Letrero luminoso",
                    "(4) Letrero luminoso Bandera",
                    "(4) Letrero compartido",
                    "(4) Banner",
                    "(4) Otros",
                    "(4) Comentario",
                    "(4) Foto",

                    "(5) Respuesta",
                    "(5) Colgante",
                    "(5) Mostrador",
                    "(5) Banner",
                    "(5) Fronterizador",
                    "(5) Posavuelto",
                    "(5) Otros",
                    "(5) Comentario",
                    "(5) Foto",

                    "(6) Respuesta",
                    "(6) Comentario",

                    "(7 Respuesta)",
                    "(7) Comentario",

                    "(8 Respuesta)",

                    "(9) Interbank",
                    "(9) Otro Agente",
                    "(9) En cualquiera/En el que usted decida/En los dos",
                    "(9) No Precisa",

                    "(10) Respuesta",

                    "(11) Respuesta",

                    "(12) Respuesta",

                    "(13) El encargado estaba ocupado",
                    "(13) Porque me indicó que no había sistema",
                    "(13) Otro",

                    "(14) Pidiéndole que por favor espere mientras terminaba de atender a otro cliente",
                    "(14) Preguntándole desde que llegó, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe",
                    "(14) Otro",

                    "(15) Me atendieron",
                    "(15) No me atendieron",

                    "(16) Respuesta",

                    "(17) Respuesta",

                    "(18) Respuesta",

                    "(19) Respuesta",
                    "(19) Foto",

                    "(20) No había sistema",
                    "(20) La línea estaba copada para el depósito",
                    "(20) La persona que atiende (operador) no estaba disponible",
                    "(20) POS no operativo",
                    "(20) No había efectivo disponible para el retiro",
                    "(20) Falta de conocimiento de la operativa / capacitación",
                    "(20) Otro",

                    "(21) Le pidió regrese más tarde",
                    "(21) Lo guio hacia otro Agente",
                    "(21) Le dijo como llegar a alguna Tienda Interbank",
                    "(21) Otros",

                    "(22) Pago de TC",
                    "(22) Retiro",
                    "(22) Deposito",
                    "(22) Pago de servicio",


                    "(23) Respuesta",

                    "(24) Saluda",
                    "(24) Usa el por favor",
                    "(24) Da las gracias",
                    "(24) Sonríe",
                    "(24) Mira a los ojos",
                    "(24) No interrumpe",
                    "(24) Despedida",
                    "(24) Estandar",

                    "(25) Conoce las operaciones que se puede realizar en agente",
                    "(25) Sabe cómo operar el pos al realizar la operación",
                    "(25) No solicita ayuda para realizar la operación",
                    "(25) Estandar",

                    "(26) Pendiente de  usted durante la atención",
                    "(26) Concentrado en la operación mientras atendía",
                    "(26) Le ofreció un producto o servicio adicional",
                    "(26) Estandar",

                    "(27) Respuesta",
                    "(27) Incremento de clientes",
                    "(27) Más ventas",
                    "(27) Comisiones",
                    "(27) Mejora de imagen",
                    "(27) Porque me diferencia de la competencia",
                    "(27) Porque los clientes lo solicitan",
                    "(27) Seguridad",
                    "(27) Pérdida de tiempo",
                    "(27) Las comisiones son bajas",
                    "(27) No precisa",

                    "(28) Respuesta",

                    "(41) Respuesta",
                    "(41) Comentario",


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

                $sheet->setAutoFilter('A4:dg'.(count($data) + 4));


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
    public function ibkV7($company_id,$pag) {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('IBK-'.$pag."_".$company_id."_".$fecha, function($excel) use ($company_id,$pag) {
            $excel->setTitle('IBK_V7_'.$pag);
            $excel->sheet('Tiendas IBK', function($sheet) use ($company_id,$pag) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_ibk_v7(" . $company_id . ",". Auth::user()->id .",".$pag.")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }

                if ($pag == 2){
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



                        "(3) Respuesta ",
                        "(3) Local Cerrado",
                        "(3) Ya no es Agente",
                        "(3) Existe señalización pero pidio retiro",
                        "(3) Foto",

                        "(1) Respuesta ",
                        "(1) Comentario ",

                        "(24) Saluda",
                        "(24) Usa el por favor",
                        "(24) Da las gracias",
                        "(24) Sonríe",
                        "(24) Mira a los ojos",
                        "(24) No interrumpe",
                        "(24) Despedida",
                        "(24) Estandar",

                        "(25) Conoce las operaciones que se puede realizar en agente",
                        "(25) Sabe cómo operar el pos al realizar la operación",
                        "(25) No solicita ayuda para realizar la operación",
                        "(25) Estandar",

                        "(26) Pendiente de  usted durante la atención",
                        "(26) Concentrado en la operación mientras atendía",
                        "(26) Le ofreció un producto o servicio adicional",
                        "(26) Estandar",

                        "(27) Respuesta",
                        "(27) Incremento de clientes",
                        "(27) Más ventas",
                        "(27) Comisiones",
                        "(27) Mejora de imagen",
                        "(27) Porque me diferencia de la competencia",
                        "(27) Porque los clientes lo solicitan",
                        "(27) Seguridad",
                        "(27) Pérdida de tiempo",
                        "(27) Las comisiones son bajas",
                        "(27) No precisa",

                        "(28) Respuesta",

                        "(41) Respuesta",
                        "(41) Comentario",//ant

                        "(50) Tarjeta de débito",
                        "(50) Tarjeta de crédito",
                        "(50) Solo Efectivo",
                        "(50) Otros",
                        "(50) Coment_otro",

                        "(51) Respuesta",
                        "(51) Comentario",

                        "(52) Visanet",
                        "(52) Paypal",
                        "(52) Izypay",
                        "(52) Otro",
                        "(52) coment_otro",
                        "(52) Ninguno",
                        "(52) Foto",

                        "(53) Rejas",
                        "(53) Cinta de seguridad",
                        "(53) Acrílicos",
                        "(53) Plástico",
                        "(53) Otros",
                        "(53) Coment_otros",
                        "(53) foto",

                        "(54) Respuesta",

                        "(55) Respuesta"


                    );
                    //              Columnas de Foto
                    $columns = array("u","bo","bv");
                    //
                    $setMargenCell =  array("q3:u3","v3:w3","x3:ae3","af3:ai3","aj3:am3","an3:ax3","ay3:ay3","az3:ba3","bb3:bf3","bg3:bh3","bi3:bo3","bp3:bv3","bw3:bw3","bx3:bx3");
                    $setFormatCell =  array("q3","v3","x3","af3","aj3","an3","ay3","az3","bb3","bg3","bi3","bp3","bw3","bx3");
                    //                $setFormatCell =  array("q3","v3","x3","ah3","ao3","aq3","as3","at3","ax3","ay3","az3","ba3","bd3","bg3","bi3","bj3","bk3","bl3","bn3","bu3","by3","cc3","cd3","cl3","cp3","ct3","de3","df3");
                    $setTextCell =  array(

                        "¿Se encuentra abierto el agente?",
                        "Al llegar al establecimiento el cliente incógnito deberá preguntar directamente por el agente de Interbank. Ejemplo: Buenos días/tardes, ¿hay agente de Interbank aquí?",

                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la amabilidad de la persona que te atendió?",
                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías el conocimiento de la persona que lo atendió?",
                        "En una escala del 0 al 3 donde 0 significa Debajo del estándar, 2 Estándar y 3 Superior, ¿cómo calificarías la disposición de la persona que lo atendió?",
                        "El CI deberá mostrar interés: Voy a abrir un negocio, ¿usted me recomendaría tener un agente Interbank?",
                        "Otras apreciaciones a comentar",
                        "¿Hay una agencia Interbank por aqui cerca? Puedes indicarme como llegar?",
                        "¿El agente permite el pago de consumo con tarjeta de débito o crédito?",
                        "¿Hay monto mínimo?",
                        "¿Qué medio digital de pago utiliza el agente?",
                        "Forma de atención del agente.",
                        "¿Puedo abrir una cuenta Interbank aquí?",
                        "¿Agente se mostró interesado?"
                    );
                }else{

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



                        "(3) Respuesta ",
                        "(3) Local Cerrado",
                        "(3) Ya no es Agente",
                        "(3) Existe señalización pero pidio retiro",
                        "(3) Foto",

                        "(1) Respuesta ",
                        "(1) Comentario ",

                        "(4) Respuesta",
                        "(4) Letrero de metal o madera",
                        "(4) Rompe tráfico",
                        "(4) Letrero luminoso",
                        "(4) Letrero luminoso Bandera",
                        "(4) Letrero compartido",
                        "(4) Banner",
                        "(4) Otros",
                        "(4) Comentario",
                        "(4) Foto",

                        "(5) Respuesta",
                        "(5) Colgante",
                        "(5) Mostrador",
                        "(5) Banner",
                        "(5) Fronterizador",
                        "(5) Posavuelto",
                        "(5) Otros",
                        "(5) Comentario",
                        "(5) Foto",//AP

                        "(6) Respuesta",//AQ
                        "(6) Comentario",//AR
                        "(6) BBVA",//AS
                        "(6) BCP",//AT
                        "(6) BANBIF",//AU
                        "(6) KASNET",//AV
                        "(6) MULTIRED",//AW
                        "(6) SCOTIABANK",//AX
                        "(6) WESTER UNION",//AY
                        "(6) CAJA AREQUIPA",//AZ
                        "(6) CAJA CUSCO",//BA
                        "(6) CAJA SULLANA",//BB
                        "(6) CAJA PAITA",//BC
                        "(6) OTROS",//BD
                        "(6) COMENT OTROS",//BE
                        "(6) Foto",//BF

                        "(7 Respuesta)",//BG
                        "(7) Comentario",//BH

                        "(8 Respuesta)",//BI

                        "(9) Interbank",//BJ
                        "(9) Otro Agente",//BK
                        "(9) En cualquiera/En el que usted decida/En los dos",//BL
                        "(9) No Precisa",//BM

                        "(10) Respuesta",//BN

                        "(11) Respuesta",//BO

                        "(12) Respuesta",//BP

                        "(13) El encargado estaba ocupado",//BQ
                        "(13) Porque me indicó que no había sistema",//BR
                        "(13) Otro",//BS

                        "(14) Pidiéndole que por favor espere mientras terminaba de atender a otro cliente",//BT
                        "(14) Preguntándole desde que llegó, qué operación iba a realizar, para saber cómo atenderlo cuando se desocupe",//BU
                        "(14) Otro",//BV

                        "(15) Me atendieron",//BW
                        "(15) No me atendieron",//BX

                        "(16) Respuesta",//BY

                        "(17) Respuesta",//BZ

                        "(18) Respuesta",//CA

                        "(19) Respuesta",//CB
                        "(19) Foto",//CD

                        "(20) No había sistema",//CE
                        "(20) La línea estaba copada para el depósito",//CF
                        "(20) La persona que atiende (operador) no estaba disponible",//CG
                        "(20) POS no operativo",//CH
                        "(20) No había efectivo disponible para el retiro",//CI
                        "(20) Falta de conocimiento de la operativa / capacitación",//CJ
                        "(20) Otro",//CK

                        "(21) Le pidió regrese más tarde",//CL
                        "(21) Lo guio hacia otro Agente",//CM
                        "(21) Le dijo como llegar a alguna Tienda Interbank",//CN
                        "(21) Otros",//CO

                        "(22) Pago de TC",//CP
                        "(22) Retiro",//CQ
                        "(22) Deposito",//CR
                        "(22) Pago de servicio",//CS


                        "(23) Respuesta",//CT

                        "(24) Saluda",//CU
                        "(24) Usa el por favor",//CV
                        "(24) Da las gracias",//CW
                        "(24) Sonríe",//CX
                        "(24) Mira a los ojos",//CY
                        "(24) No interrumpe",//CZ
                        "(24) Despedida",//DA
                        "(24) Estandar",//DB

                        "(25) Conoce las operaciones que se puede realizar en agente",//DC
                        "(25) Sabe cómo operar el pos al realizar la operación",//DD
                        "(25) No solicita ayuda para realizar la operación",//DE
                        "(25) Estandar",//DF

                        "(26) Pendiente de  usted durante la atención",//DG
                        "(26) Concentrado en la operación mientras atendía",//DH
                        "(26) Le ofreció un producto o servicio adicional",//DI
                        "(26) Estandar",//DJ

                        "(27) Respuesta",//DK
                        "(27) Incremento de clientes",//DL
                        "(27) Más ventas",//DM
                        "(27) Comisiones",//DN
                        "(27) Mejora de imagen",//DO
                        "(27) Porque me diferencia de la competencia",//DP
                        "(27) Porque los clientes lo solicitan",//DQ
                        "(27) Seguridad",//DR
                        "(27) Pérdida de tiempo",//DS
                        "(27) Las comisiones son bajas",//DT
                        "(27) No precisa",//DU

                        "(28) Respuesta",//DV

                        "(41) Respuesta",//DW
                        "(41) Comentario",//DX


                    );
                    //              Columnas de Foto
                    $columns = array("u","ag","ap","bf","cc");
                    //
                    $setMargenCell =  array("q3:u3","v3:w3","x3:ag3","ah3:ap3","aq3:bf3","bg3:bh3","bi3:bi3","bj3:bm3","bn3:bn3","bo3:bo3","bp3:bp3","bq3:bs3","bt3:bv3","bw3:bx3","by3:by3","bz3:bz3","ca3:ca3","cb3:cc3","cd3:cj3","ck3:cn3","co3:cr3","cs3:cs3","ct3:da3","db3:de3","df3:di3","dj3:dt3","du3:du3","dv3:dw3");
                    $setFormatCell =  array("q3","v3","x3","ah3","aq3","bg3","bi3","bj3","bn3","bo3","bp3","bq3","bt3","bw3","by3","bz3","ca3","cb3","cd3","ck3","co3","cs3","ct3","db3","df3","dj3","du3","dv3");
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
                        "¿Le entregaron ESPONTÁNEAMENTE un comprobante luego de la transacción? (Si no le entregaron espontáneamente el voucher deben solicitarlo y adjuntarlo al formulario)",
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
                }


                $sheet->prependRow(4, $headings);
                $sheet->cell('A1', function($cell) {
                    $cell->setValue('TOTAL');
                    $cell->setBackground('#0e5a97');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->getCell('B1')->setValue($count);
                $sheet->fromArray($data,null,'A5',true,false);
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
                if ($pag == 2){
                    $sheet->setAutoFilter('A4:BX'.(count($data) + 4));
                }else{
                    $sheet->setAutoFilter('A4:dX'.(count($data) + 4));
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
                if ($pag == 1){
                    $sheet->getColumnDimension('CU')->setVisible(false);
                    $sheet->getColumnDimension('CV')->setVisible(false);
                    $sheet->getColumnDimension('CW')->setVisible(false);
                    $sheet->getColumnDimension('CX')->setVisible(false);
                    $sheet->getColumnDimension('CY')->setVisible(false);
                    $sheet->getColumnDimension('CZ')->setVisible(false);
                    $sheet->getColumnDimension('DA')->setVisible(false);
                    $sheet->getColumnDimension('DB')->setVisible(false);
                    $sheet->getColumnDimension('DC')->setVisible(false);
                    $sheet->getColumnDimension('DD')->setVisible(false);
                    $sheet->getColumnDimension('DE')->setVisible(false);
                    $sheet->getColumnDimension('DF')->setVisible(false);
                    $sheet->getColumnDimension('DG')->setVisible(false);
                    $sheet->getColumnDimension('DH')->setVisible(false);
                    $sheet->getColumnDimension('DI')->setVisible(false);
                    $sheet->getColumnDimension('DJ')->setVisible(false);
                    $sheet->getColumnDimension('DK')->setVisible(false);
                    $sheet->getColumnDimension('DL')->setVisible(false);
                    $sheet->getColumnDimension('DM')->setVisible(false);
                    $sheet->getColumnDimension('DN')->setVisible(false);
                    $sheet->getColumnDimension('DO')->setVisible(false);
                    $sheet->getColumnDimension('DP')->setVisible(false);
                    $sheet->getColumnDimension('DQ')->setVisible(false);
                    $sheet->getColumnDimension('DR')->setVisible(false);
                    $sheet->getColumnDimension('DS')->setVisible(false);
                    $sheet->getColumnDimension('DT')->setVisible(false);
                    $sheet->getColumnDimension('DU')->setVisible(false);
                    $sheet->getColumnDimension('DV')->setVisible(false);
                    $sheet->getColumnDimension('DW')->setVisible(false);
                    $sheet->getColumnDimension('DX')->setVisible(false);
                }

            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

}