<?php
/**
 * Created by PhpStorm.
 * User: Jaime
 * Date: 1/25/2016
 * Time: 4:14 PM
 */

use Maatwebsite\Excel\Facades\Excel;
use Auditor\Repositories\ProductRepo;
use Auditor\Repositories\PollDetailRepo;
use Illuminate\Support\Facades\Auth;

class ExcelControllerV2 extends  BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    protected $productRepo;
    protected $pollDetailRepo;

    public function __construct(PollDetailRepo $pollDetailRepo,ProductRepo $productRepo)
    {
        $this->productRepo = $productRepo;
        $this->pollDetailRepo = $pollDetailRepo;
    }



    /**
     * Excel Plan camiseta
     * @param $company_id
     */
    public function misteryAlicorp($company_id,$pag) {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Mistery Auditorias Mayoristas Alicorp '.$company_id."-".$fecha, function($excel) use ($company_id,$pag) {

            if ($pag==1)
            {
                $excel->setTitle('Mistery Alicorp '.$company_id);
                $excel->sheet('Mistery', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_mistery_alicorp(" . $company_id . ",".$pag.",". Auth::user()->id .")";
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

                        "Respuesta",//3
                        "Foto",
                        "Opción",
                        "Comentario",

                        "Respuesta",//4
                        "Foto",
                        "Opción",
                        "Comentario",//4

                        "Respuesta",//5
                        "Foto",
                        "Opción",
                        "Comentario",//5

                        "Respuesta",//6
                        "Foto",
                        "Opción",
                        "Comentario",//6

                        "Respuesta",//2
                        "Foto",
                        "Opción",
                        "Comentario",


                        "Respuesta",//7
                        "Foto",
                        "Opción",
                        "Comentario",//7

                        "Respuesta",//8

                        "Respuesta",//9

                        "Opción",//10
                        "Comentario",//10

                        "Opción",//11
                        "Comentario",//11

                        "Opción",//12
                        "Comentario",//12

                        "Comentario",//13

                        "Respuesta",//14

                        "Respuesta",//15

                        "Respuesta",//16

                        "Respuesta",//17

                        "Opción",//18
                        "Comentario",//18

                        "Opción",//19
                        "Comentario",//19

                        "Opción",//20
                        "Comentario",//20

                        "Opción",//21
                        "Comentario",//21


                    );

                    $columns = array("p","r","v","z","ad","ah","al");

                    $setMargenCell =  array("O3:P3","U3:X3","Y3:AB3","AC3:AF3","AG3:AJ3","Q3:T3","AK3:AN3","AO3:AO3","AP3:AP3","AQ3:AR3","AS3:AT3","AU3:AV3","AW3:AW3","AX3:AX3","AY3:AY3","AZ3:AZ3","BA3:BA3",
                        "BB3:BC3","BD3:BE3","BF3:BG3","BH3:BI3");
                    $setFormatCell =  array("O3","Q3","U3","Y3","AC3","AG3","AK3","AO3","AP3","AQ3","AS3","AU3","AW3","AX3","AY3","AZ3","BA3","BB3","BD3","BF3","BH3");
                    $setTextCell =  array(
                        "El modulo se encuentra abierto?",
                        "¿El modulo se encuentra en buen estado?",
                        "¿Tiene material de Afiches?",
                        "¿Tiene material de Carteles?",
                        "¿Tiene material Volantes?",
                        "¿La canjista se encuentra en el modulo?",
                        "¿La canjista cuenta con uniforme (identificación de Lucky)?",
                        "¿La comunicación de las mecánicas se encuentran vigentes?",
                        "La canjista conoce y explica detalladamente cada escala (Consumo, Detergentes, Galletas)",
                        "Del uno al cinco, cómo calificarías el conocimiento de las mecánicas",
                        "Del uno al cinco, cómo calificarías la persuasión (técnicas de venta) de la canjista para que compres al punto de venta y realices un canje?",
                        "Al momento de preguntarle qué documentos recibe para realizar los canjes ¿Cuáles menciona?",
                        "Cuánto es el máximo de canjes que se debe entregar al PDV?",
                        "¿La persona que lo atendió tuvo que solicitar ayuda de alguna otra persona o hacer alguna consulta al respecto?",
                        "La canjista tiene conocimiento de los PDV Mayoristas que atiende",
                        " La canjista tiene conocimiento sobre la ubicación de los PDV Mayoristas que atiende",
                        "La canjista tiene buen trato? (Saluda, Sonrie)",
                        "Al acercarse, la canjista aborda o espera que el cliente pregunte?",
                        "Del uno al cinco, cómo calificarías la actitud de la canjista al momento de atender?",
                        "En todo el tiempo de la visita, las canjistas se mantuvieron en los modulos de canje o salen a abordar a los clientes para comunicar las mecánicas?",
                        "Del uno al cinco, cómo calificarías el servicio brindado por las canjista?");

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

                    $sheet->setAutoFilter('A4:ad'.(count($data) + 4));


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
            }
            if ($pag==2)
            {
                $excel->setTitle('Profundidad Alicorp '.$company_id);
                $excel->sheet('Profundidad', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_mistery_alicorp(" . $company_id . ",".$pag.",". Auth::user()->id .")";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $count=0;
                    foreach ($stores as $result) {
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

                        "Comentario",//22

                        "Opción",//23
                        "Comentario",

                        "Respuesta",//24
                        "Comentario",

                        "Opción",//25
                        "Comentario",

                        "Opción",//26
                        "Comentario",

                        "Comentario",//27

                        "Respuesta",//28

                        "Opción",//29
                        "Comentario",

                        "Respuesta",//30
                        "Comentario",

                        "Opción",//31

                        "Opción",//32
                        "Comentario",

                        "Comentario",//33

                        "Respuesta",//34

                        "Opción",//35
                        "Comentario",

                        "Opción",//36
                        "Comentario",

                        "Respuesta",//37
                        "Comentario",

                        "Opción",//38
                        "Comentario",

                        "Respuesta",//39
                        "Comentario",

                        "Comentario",//40

                        "Respuesta",//41

                        "Opción",//42

                        "Comentario",//43
                        "Opción",

                        "Comentario",//44

                        "Comentario",//45

                        "Comentario",//46

                        "Respuesta",//47
                        "Opción",
                        "Comentario",

                        "Respuesta",//48

                        "Opción",//49
                        "Comentario",
                    );

                    $columns = array("p","r","v","z","ad","ah","al");

                    $setMargenCell =  array("O3:O3","P3:Q3","R3:S3","T3:U3","V3:W3","X3:X3","Y3:Y3","Z3:AA3","AB3:AC3","AD3:AD3","AE3:AF3","AG3:AG3","AH3:AH3","AI3:AJ3","AK3:AL3","AM3:AN3","AO3:AP3","AQ3:AR3","AS3:AS3","AT3:AT3","AU3:AU3","AV3:AW3","AX3:AX3","AY3:AY3","AZ3:AZ3","BA3:BC3","BD3:BD3","BE3:BF3");
                    $setFormatCell =  array("O3","P3","R3","T3","V3","X3","Y3","Z3","AB3","AD3","AE3","AG3","AH3","AI3","AK3","AM3","AO3","AQ3","AS3","AT3","AU3","AV3","AX3","AY3","AZ3","BA3","BD3","BE3");
                    $setTextCell =  array(
                        "Nombre completo de la canjista",//22
                        "Tiempo trabajando Lucky",//23
                        "Conoce el nombre de su supervisor",//24
                        "Qué tan seguido la supervisora los visita?",//25
                        "Del 1 al 5, cómo consideran que es el trato de la supervisora?",//26
                        "Cuál es la rutina que realiza la supervisora cuando te visita? ",//27
                        "La supervisora realiza seguimiento a tus resultados?",//28
                        " Del 1 al 5, cómo calificarías el trabajo de tu supervisora?",//29
                        " Conoce el nombre de su controller ",//30
                        "Qué tan seguido el controller los visita?",//31
                        "Del 1 al 5, cómo consideran que es el trato del controller?",//32
                        "Cuál es la rutina que realiza del controller cuando te visita? ",//33
                        "El controller realiza seguimiento a tus resultados?",//34
                        "Qué tipo de reportes recibes del controller?",//35
                        "Del 1 al 5, cómo calificarías el trabajo de tu controller?",//36
                        "Conoce el nombre de su ejecutivo de cuenta",//37
                        "Qué tan seguido el ejecutivo los visita?",//38
                        "Del 1 al 5, cómo consideran que es el trato del ejecutivo?",//39
                        "Cuál es la rutina que realiza el ejecutivo cuando te visita? ",//40
                        "El ejecutivo realiza seguimiento a tus resultados? ",//41
                        "Qué tipo de reportes recibes del ejecutivo?",//42
                        "Del 1 al 5, cómo calificarías el trabajo de tu ejecutivo?",//43
                        "Funciones que realiza: (hasta 5 funciones)",//44
                        "Detalla cuál es su rutina de trabajo todos los días ",//45
                        "Con qué personas de Lucky interactúa : (Hasta 3 personas NOMBRE Y PUESTO)",//46
                        "Se te brinda toda las herramientas y facilidades para poder trabajar adecuadamente (Si contesta SI indicar Cuales)",//47
                        "Siempre cuentas con stock para realizar canjes?",//48
                        "Del 1 al 5, cómo calificarías el trato de los PDV que atiendes? Por qué?"//49
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

                    $sheet->setAutoFilter('A4:BF'.(count($data) + 4));


                    /*for ($i = 1; $i <= count($data); $i++) {
                        for($col = 0 ; $col < count($columns); $col++){
                            $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                            if(strlen($url_foto)>0) {
                                $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                                $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                            }
                        }
                    }*/


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
            }

            if ($pag==3)
            {
                $excel->setTitle('Preguntas al cliente'.$company_id);
                $excel->sheet('Preguntas al Cliente', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_mistery_alicorp(" . $company_id . ",".$pag.",". Auth::user()->id .")";
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

                        "Respuesta",//58
                        "Comentario",//58

                        "Respuesta",//50

                        "Respuesta",//51
                        "Comentario",//51

                        "Respuesta",//52
                        "Comentario",//52

                        "Opción",//53

                        "Respuesta",//54

                        "Respuesta",//55

                        "Comentario",//59

                        "Opción",//56

                        "Opción",//57


                    );

                    $columns = array("p","r","v","z","ad","ah","al");

                    $setMargenCell =  array("O3:P3","Q3:Q3","R3:S3","T3:U3","V3:V3","W3:W3","X3:X3","Y3:Y3","Z3:Z3","AA3:AA3");
                    $setFormatCell =  array("O3","Q3","R3","T3","V3","W3","X3","Y3","Z3","AA3");
                    $setTextCell =  array(
                        "¿Se pudo realizar la encuesta ?",
                        "Ha realizado algún canje en el módulo ?",
                        "Conoce a la canjista de Lucky?",
                        "Conoce a la supervisora de la zona de Lucky?",
                        "Del 1 al 5, Cómo calificarías el desempeño de la canjista?",
                        "La supervisora de Lucky te soluciona los incovenientes que sucitan cada día?",
                        "Has tenido problemas con el servicio de canjes anteriormente?",
                        "¿Cuáles fueron los problemas que se dieron?",
                        "Del 1 al 5,  Cómo calificaría el servicio de Lucky?",
                        "Qué mejorarías del servicio?");

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


                    /*for ($i = 1; $i <= count($data); $i++) {
                        for($col = 0 ; $col < count($columns); $col++){
                            $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                            if(strlen($url_foto)>0) {
                                $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                                $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                            }
                        }
                    }*/


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
            }
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    public function helenaEvaluacion($company_id,$pag)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        if ($pag==1) $valor_temp="Preguntas";if ($pag==2) $valor_temp="Publicidades";if ($pag==3) $valor_temp="Productos";
        Excel::create('Helena Evaluación '.$valor_temp." - ".$company_id."-".$fecha, function($excel) use ($company_id,$pag) {
            if ($pag==1)
            {
                $excel->setTitle('Preguntas Varias Helena Evaluación'.$company_id);
                $excel->sheet('Preguntas', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_helena_evaluacion(" . $company_id . ",".$pag.",". Auth::user()->id .")";
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
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO BODEGA",

                        "Respuesta",//1
                        "Foto",

                        "Respuesta",//2
                        "Opción",
                        "Comentario",
                        "Foto",

                        "Comentario",//3
                        "Foto",

                        "Comentario",//4
                        "Foto",

                        "Comentario",//5
                        "Foto",

                        "Respuesta",//6
                        "Foto",

                        "Respuesta",//11
                        "Foto",

                        "Respuesta",//12
                        "Foto",

                        "Comentario",//13
                        "Foto",

                        "Comentario",//14
                        "Foto",

                    );

                    $columns = array("p","t","v","x","z","ab","ad","af","ah","aj");

                    $setMargenCell =  array("O3:P3","Q3:T3","U3:V3","W3:X3","Y3:Z3","AA3:AB3","AC3:AD3","AE3:AF3","AG3:AH3","AI3:AJ3");
                    $setFormatCell =  array("O3","Q3","U3","W3","Y3","AA3","AC3","AE3","AG3","AI3");
                    $setTextCell =  array(
                        "El local está abierto ?",
                        "Cliente permitió tomar información ?",
                        "Cuántas Gancheras Triangulares existen en el comercio ?",
                        "Cuántas Gancheras Rectangulares (5 tiras) existen en el comercio ?",
                        "Cuántas Gancheras Rectangulares (7 tiras) existen en el comercio ?",
                        "El comercio cuenta con Módulo adicional ?",
                        "El comercio cuenta con exhibidor de lavavajilla MARSELLA?",
                        "El cliente firmó cargo de auditoría?",
                        "¿Cuantos Ganchos Opal existen en el comercio?",
                        "¿Cuantos Gancho Marsella existen en el comercio?");

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

                    $sheet->setAutoFilter('A4:ab'.(count($data) + 4));


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
            }
            if ($pag==2)
            {
                $excel->setTitle('Publicidades Helena Evaluación'.$company_id);
                $excel->sheet('Publicidades', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_helena_evaluacion(" . $company_id . ",".$pag.",". Auth::user()->id .")";
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
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO BODEGA",

                        "Respuesta",//1
                        "Foto",

                        "Respuesta",//2
                        "Opción",
                        "Comentario",
                        "Foto",

                        "Respuesta",//7_publicity_id_1
                        "Foto",

                        "Respuesta",//8_publicity_id_1

                        "Comentario",//9_publicity_id_1
                        "Respuesta",//7_publicity_id_2
                        "Foto",

                        "Respuesta",//8_publicity_id_2

                        "Comentario",//9_publicity_id_2
                        "Respuesta",//7_publicity_id_3
                        "Foto",

                        "Respuesta",//8_publicity_id_3

                        "Comentario",//9_publicity_id_3
                        "Respuesta",//7_publicity_id_4
                        "Foto",

                        "Respuesta",//8_publicity_id_4

                        "Comentario",//9_publicity_id_4

                        "Respuesta",//7_publicity_id_5
                        "Foto",

                        "Respuesta",//8_publicity_id_5

                        "Comentario",//9_publicity_id_5

                    );
                    $sheet->mergeCells('U2:X2');
                    $sheet->cell('U2', function($cell) {
                        $cell->setValue(' Ventana Detergentes (Bolivar, Opal, Marsella) ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('Y2:AB2');
                    $sheet->cell('Y2', function($cell) {
                        $cell->setValue(' Ventana Suavizantes Bolivar ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AC2:AF2');
                    $sheet->cell('AC2', function($cell) {
                        $cell->setValue(' Ventana Quitamanchas Opal ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AG2:AJ2');
                    $sheet->cell('AG2', function($cell) {
                        $cell->setValue(' Ventana Jabones de Lavar (Bolivar, Marsella) ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AK2:AN2');
                    $sheet->cell('AK2', function($cell) {
                        $cell->setValue(' Ventana Lavajillas Marsella) ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $columns = array("p","t","v","z","ad","ah","al");

                    $setMargenCell =  array("O3:P3","Q3:T3","U3:V3","W3:W3","X3:X3","Y3:Z3","AA3:AA3","AB3:AB3","AC3:AD3","AE3:AE3","AF3:AF3","AG3:AH3","AI3:AI3","AJ3:AJ3","AK3:AL3","AM3:AM3","AN3:AN3");
                    $setFormatCell =  array("O3","Q3","U3","W3","X3","Y3","AA3","AB3","AC3","AE3","AF3","AG3","AI3","AJ3","AK3","AM3","AN3");
                    $setTextCell =  array(
                        "El local está abierto ?",
                        "Cliente permitió tomar información ?",//Ventana Detergentes (Bolivar, Opal, Marsella)
                        "Existe Ventana ?",
                        "Está trabajada?",
                        "Cantidad de frentes de la ventana",//Ventana Detergentes (Bolivar, Opal, Marsella)
                        "Existe Ventana ?",
                        "Está trabajada?",
                        "Cantidad de frentes de la ventana",//Ventana Detergentes (Bolivar, Opal, Marsella)
                        "Existe Ventana ?",
                        "Está trabajada?",
                        "Cantidad de frentes de la ventana",//Ventana Detergentes (Bolivar, Opal, Marsella)
                        "Existe Ventana ?",
                        "Está trabajada?",
                        "Cantidad de frentes de la ventana",//Ventana Detergentes (Bolivar, Opal, Marsella)
                        "Existe Ventana ?",
                        "Está trabajada?",
                        "Cantidad de frentes de la ventana");

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

                    $sheet->setAutoFilter('A4:AJ'.(count($data) + 4));


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
            }
            if ($pag==3)
            {
                $excel->setTitle('Productos Helena Evaluación'.$company_id);
                $excel->sheet('Productos', function($sheet) use ($company_id,$pag) {
                    $company_id = (int)$company_id;
                    $sqlcoord="CALL sp_helena_evaluacion(" . $company_id . ",".$pag.",". Auth::user()->id .")";
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
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO BODEGA",

                        "Respuesta",//1
                        "Foto",

                        "Respuesta",//2
                        "Opción",
                        "Comentario",
                        "Foto",

                        "Respuesta",//10_product_id_1

                        "Respuesta",//10_product_id_2

                        "Respuesta",//10_product_id_3

                    );
                    $sheet->mergeCells('U2:W2');
                    $sheet->cell('U2', function($cell) {
                        $cell->setValue(' Existe Producto ');
                        $cell->setBackground('#E40421');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $columns = array("p","t");

                    $setMargenCell =  array("O3:P3","Q3:T3","U3:U3","V3:V3","W3:W3");
                    $setFormatCell =  array("O3","Q3","U3","V3","W3");
                    $setTextCell =  array(
                        "El local está abierto ?",
                        "Cliente permitió tomar información ?",
                        "QUITAMANCHAS DOY PACK 500 ML",
                        "SUAVIZANTE AROMA ACTIVO",
                        "OPAL ADVANCE");

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
            }

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function visibilidadBayerTransV2($company_id,$visit_id,$regular=1)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Visibilidad Bayer Transferencista '.$regular.'-'.$company_id."-".$fecha, function($excel) use ($company_id, $visit_id,$regular) {
            $excel->setTitle('Presencia POP '.$regular);
            $excel->sheet('Presencia POP REGULARES '.$regular, function($sheet) use ($visit_id, $company_id,$regular) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_bayert_visibilidad_V2(".$company_id.",".$visit_id.",".$regular.",0,0,". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",//K

                    "Respuesta",//l
                    "Foto",

                    /*561*/
                    "Respuesta",//N
                    "Foto",//O
                    "Comentario",//P

                    "Actual",//Q
                    "Antiguo",//R

                    "Base",//S

                    "Respuesta",//T
                    "Comentario",//U
                    "Mala Ubicación",//V
                    "Contaminado",//W

                    "Respuesta",//X 27
                    "Comentario",//Y
                    "Deteriorado",//Z
                    "Desordenado",//AA
                    "Imagen deteriorada/dañada",//AB
                    "Parante roto",//AC
                    "Vacio",//AD

                    /*1384*/
                    "Respuesta",//AE
                    "Foto",//AF
                    "Comentario",//AG

                    "Actual",//AH
                    "Antiguo",//AI

                    "Base",//AJ

                    "Respuesta",//AK
                    "Comentario",//AL
                    "Mala Ubicación",//AM
                    "Contaminado",//AN

                    "Respuesta",//AO 27
                    "Comentario",//AP
                    "Deteriorado",//AQ
                    "Desordenado",//AR
                    "Imagen deteriorada/dañada",//AS
                    "Parante roto",//AT
                    "Vacio",//AU

                    /*565*/
                    "Respuesta",//AV
                    "Foto",//AW
                    "Comentario",//AX

                    "Actual",//AY
                    "Antiguo",//AZ

                    "Base",//BA

                    "Respuesta",//BB
                    "Comentario",//BC
                    "Mala Ubicación",//BD
                    "Contaminado",//BE

                    "Respuesta",//BF 27
                    "Comentario",//BG
                    "Deteriorado",//BH
                    "Desordenado",//BI
                    "Imagen deteriorada/dañada",//BJ
                    "Parante roto",//BK
                    "Vacio",//BL

                );
                //Columnas de Foto
                $columns = array("M","O","AF","AW");

                $setMargenCell =  array("L3:M3","N3:S3","T3:W3","X3:AD3","AE3:AJ3","AK3:AN3","AO3:AU3","AV3:BA3","BB3:BE3","BF3:BL3");
                $setFormatCell =  array("L3","N3","T3","X3","AE3","AK3","AO3","AV3","BB3","BF3");
                $setTextCell =  array(
                    "¿Se encuentra abierto el local?",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
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

                $sheet->setAutoFilter('A4:BL'.(count($data) + 4));


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

                if ($regular==1){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Corpóreos ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Dispensador de Agua ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Paneles de Anaquel ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }

                if ($regular==2){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Vitrinas ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Laterales Vitaminas ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Afiches de Meson ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }
                if ($regular==3){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Pedestales ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Ganchera Redoxitos ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Otros ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
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

    public function visibilidadBayerTransV3($company_id,$visit_id,$regular=1)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Visibilidad Bayer Transferencista '.$regular.'-'.$company_id."-".$fecha, function($excel) use ($company_id, $visit_id,$regular) {
            $excel->setTitle('Presencia POP '.$regular);
            $excel->sheet('Presencia POP REGULARES '.$regular, function($sheet) use ($visit_id, $company_id,$regular) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_bayert_visibilidad_V3(".$company_id.",".$visit_id.",".$regular.",0,0,". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",//K

                    "Respuesta",//l
                    "Foto",

                    /*561*/
                    "Respuesta",//N
                    "Foto",//O
                    "Comentario",//P

                    "Actual",//Q
                    "Antiguo",//R

                    "Base",//S

                    "Respuesta",//T
                    "Comentario",//U
                    "Mala Ubicación",//V
                    "Contaminado",//W

                    "Respuesta",//X 27
                    "Comentario",//Y
                    "Deteriorado",//Z
                    "Desordenado",//AA
                    "Imagen deteriorada/dañada",//AB
                    "Parante roto",//AC
                    "Vacio",//AD

                    /*1384*/
                    "Respuesta",//AE
                    "Foto",//AF
                    "Comentario",//AG

                    "Actual",//AH
                    "Antiguo",//AI

                    "Base",//AJ

                    "Respuesta",//AK
                    "Comentario",//AL
                    "Mala Ubicación",//AM
                    "Contaminado",//AN

                    "Respuesta",//AO 27
                    "Comentario",//AP
                    "Deteriorado",//AQ
                    "Desordenado",//AR
                    "Imagen deteriorada/dañada",//AS
                    "Parante roto",//AT
                    "Vacio",//AU

                    /*565*/
                    "Respuesta",//AV
                    "Foto",//AW
                    "Comentario",//AX

                    "Actual",//AY
                    "Antiguo",//AZ

                    "Base",//BA

                    "Respuesta",//BB
                    "Comentario",//BC
                    "Mala Ubicación",//BD
                    "Contaminado",//BE

                    "Respuesta",//BF 27
                    "Comentario",//BG
                    "Deteriorado",//BH
                    "Desordenado",//BI
                    "Imagen deteriorada/dañada",//BJ
                    "Parante roto",//BK
                    "Vacio",//BL

                    "Respuesta",//BM
                    "Foto",

                );
                //Columnas de Foto
                $columns = array("M","O","AF","AW","BN");

                $setMargenCell =  array("L3:M3","N3:S3","T3:W3","X3:AD3","AE3:AJ3","AK3:AN3","AO3:AU3","AV3:BA3","BB3:BE3","BF3:BL3","BM3:BN3");
                $setFormatCell =  array("L3","N3","T3","X3","AE3","AK3","AO3","AV3","BB3","BF3","BM3");
                $setTextCell =  array(
                    "¿Se encuentra abierto el local?",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
                    "Existe Material POP",
                    "Es visible material POP",
                    "Cual es el estado del material POP",
                    "¿El cliente recibió el premio?"
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

                $sheet->setAutoFilter('A4:BN'.(count($data) + 4));


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

                if ($regular==1){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Corpóreos ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Dispensador de Agua ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Paneles de Anaquel ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }

                if ($regular==2){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Vitrinas ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Laterales Vitaminas ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Afiches de Meson ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }
                if ($regular==3){
                    $sheet->mergeCells('N2:AD2');
                    $sheet->cell('N2', function($cell) {
                        $cell->setValue(' Pedestales ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AE2:AU2');
                    $sheet->cell('AE2', function($cell) {
                        $cell->setValue(' Ganchera Redoxitos ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AV2:BL2');
                    $sheet->cell('AV2', function($cell) {
                        $cell->setValue(' Otros ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
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