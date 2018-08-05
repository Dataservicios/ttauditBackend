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

class ExcelController extends  BaseController {

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

    public function index()
    {

        Excel::create('Laravel Excel', function($excel) {
            $excel->sheet('Productos', function($sheet) {

                //$products = Product::all();
                //$sheet->fromArray($products);

                //$sheet->fromArray($this->productRepo->allReg());
                //dd($this->productRepo->allReg());


                $sqlcoord="CALL sp_reporte_company_82_premiados;";
                $stores = DB::select($sqlcoord);


                //dd($stores);
//                $payment[] = array();
//                foreach ($stores as $payment) {
//                    $payment = $payment;
//                }
//                dd($payment);

                $data = array();
                foreach ($stores as $result) {
//                    $result->filed1 = 'some modification';
//                    $result->filed2 = 'some modification2';
                    $data[] = (array)$result;
                    #or first convert it and then change its properties using
                    #an array syntax, it's up to you
                }
                 //dd($data);

//                $obj = get_object_vars($stores);
//                $obj = (array)$stores;

                $sheet->fromArray($data);



            });
        })->export('xls');

    }

    public function alerts_ibk()
    {
        Excel::create('Notificaciones IBK', function($excel) {
            $excel->sheet('Notificaciones', function($sheet) {
                $sqlcoord="CALL sp_alerts_ibk();";
                $stores = DB::select($sqlcoord);

                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                $sheet->fromArray($data);
            });
            $excel->sheet('Respuestas', function($sheet) {
                $sqlcoord="CALL sp_alerts_comments_ibk();";
                $stores = DB::select($sqlcoord);

                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                $sheet->fromArray($data);
            });
        })->export('xls');
    }


    /**
     *Excel Alicorp Pre Venta
     */
    public function campaigneAlicorpPreVenta()
    {

        Excel::create('Alicorp Pre Venta Julio', function($excel) {
            $excel->setTitle('Alicorp Pre Venta');
            $excel->sheet('Datos', function($sheet) {
                $sqlcoord="CALL sp_reporte_company_86";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
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
                    "Largos 500 grs",
                    "Cortos 250 grs",
                    "Norcheff 1 lt",
                    "TriA 1 lt",
                    "Trome 150 gr",
                    "Respuesta",
                    "Jose Antonio largos 500 gr",
                    "Jose Antonio cortos 250 gr",
                    "Don Camilo largos 500 gr",
                    "Don Camilo cortos 250 gr(775)",
                    "Benotti largos 500 gr(776)",
                    "Benotti cortos 250 gr(777)",
                    "D’Primera largos 500 gr(778)",
                    "D’Primera cortos 250 gr(779)",
                    "Sapolio amarillo deterg bolsa 150 gr(780)",
                    "La Patrona aceite bot 1 lt(785)",
                    "Don Sabor aceite bot 1 lt(786)",
                    "Jose Antonio largos 500 gr",
                    "Jose Antonio cortos 250 gr",
                    "Don Camilo largos 500 gr",
                    "Don Camilo cortos 250 gr(775)",
                    "Benotti largos 500 gr(776)",
                    "Benotti cortos 250 gr(777)",
                    "D’Primera largos 500 gr(778)",
                    "D’Primera cortos 250 gr(779)",
                    "Sapolio amarillo deterg bolsa 150 gr(780)",
                    "La Patrona aceite bot 1 lt(785)",
                    "Don Sabor aceite bot 1 lt(786)",
                    "Foto Marcador Precio",
                    "Foto Material POP adicional",
                    "Comentario"
                );

                $sheet->prependRow(4, $headings);
                //$sheet->getCell('A1')->setValue($count);
//                $sheet->cell('A1', function($cell) {
//                    $cell->setValue("");
//                });

                //$sheet->fromArray($data);
                //fromArray($source, $nullValue, $startCell, $strictNullComparison, $headingGeneration)
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                $sheet->mergeCells('L3:O3');

                $sheet->cell('L3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto local ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('P3:T3');
                $sheet->cell('P3', function($cell) {
                    $cell->setValue('¿ Cuanto Volumen se coloco en el cliente ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('P3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                //$sheet->mergeCells('U3:U3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('¿ Cuanto se Facturo en el cliente ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('V3:AF3');
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('¿ Existe Producto de competencia ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('V3:AF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AG3:AQ3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue('¿ Precio Producto compentencia x caja ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AG3:AQ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AR3', function($cell) {
                    $cell->setValue('Foto Marcadores de Precio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AR3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AS3', function($cell) {
                    $cell->setValue('Foto Material POP adicional');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue('Comentario adicional del cliente');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
//                $sheet->getCell('A7')
//                    ->getHyperlink()
//                    ->setUrl('http://examle.com/uploads/cv/' )
//                    ->setTooltip('Click here to access file');
            });
        })->export('xls');
    }


    public function presencePopMercaderismoBayer($company_id,$visit_id,$tipo)
    {

        Excel::create('Bayer Mercaderismo Presencia POP REGULARES', function($excel) use ($tipo, $company_id, $visit_id) {
            $excel->setTitle('Presencia POP');
            $excel->sheet('Presencia POP REGULARES 1', function($sheet) use ($tipo, $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",".$visit_id.",".$tipo.",1,0)";
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
                    "VISITA",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    /*564*/


                    /*561*/
                    "Respuesta",//U
                    "Foto",//V

                    "Base",//W

                    "Respuesta",//X

                    "Respuesta",//Y
                    "Mala Ubicación",//Z
                    "Contaminado",//AA
                    "Comentario",//AB

                    "Respuesta",//AC
                    "Imagen Deteriorada",//AD
                    "Parante Roto",//AE
                    "Comentario",//AF

                    "Respuesta",//AG
                    "Lo Descontamine",//
                    "Mejore Ubicación",//
                    "Otros",//
                    "Comentario",//
                    "Foto",//AL
                    /*563*/
                    "Respuesta",//AM
                    "Foto",//AN

                    "Base",//AO

                    "Respuesta",//AP
                    "Mala Ubicación",//
                    "Contaminado",//
                    "Comentario",//AS

                    "Respuesta",//AT
                    "Imagen Deteriorada",//AU
                    "Comentario",//AV

                    "Respuesta",//AW
                    "Lo Descontamine",//AX
                    "Mejore Ubicación",//AY
                    "Otros",//AZ
                    "Comentario",//BA
                    "Foto",//BB
                    /*565*/
                    "Respuesta",//BC
                    "Foto",//BD

                    "Base",//BE

                    "Respuesta",//BF

                    "Respuesta",//BG
                    "Mala Ubicación",//BH
                    "Contaminado",//BI
                    "Comentario",//BJ

                    "Respuesta",//BK
                    "Imagen Deteriorada",//BL
                    "Comentario",//BM

                    "Respuesta",//BN
                    "Lo Descontamine",//BO
                    "Mejore Ubicación",//BP
                    "Otros",//BQ
                    "Comentario",//BR
                    "Foto"//BS

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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('A' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0){
                        $sheet->getCell('BB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0){
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                    $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BS' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BS' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }

                $sheet->mergeCells('N3:Q3');

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Cliente Permitió tomar información?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('R3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*561*/

                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('¿Existe Material POP Corpóreos?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->cell('X3', function($cell) {
                    $cell->setValue(' ¿Funciona luz Led? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('Y3:AB3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue('¿Es visible material POP Corpóreos?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3:AB3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AC3:AF3');
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue('¿Cuál es el estado del material POP Corpóreos?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AB3:AF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AG3:AL3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Corpóreos? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AG3:AL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*563*/
                $sheet->mergeCells('AM3:AN3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('¿Existe Material POP Bidoneras?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AM3:AN3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AO3', function($cell) {
                    $cell->setValue(' Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AP3:AS3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('¿Es visible material POP Bidoneras?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AP3:AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AT3:AV3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue('¿Cuál es el estado del material POP Bidoneras?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3:AV3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AW3:BB3');
                $sheet->cell('AW3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Bidoneras? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AW3:BB3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*565*/
                $sheet->mergeCells('BC3:BD3');
                $sheet->cell('BC3', function($cell) {
                    $cell->setValue('¿Existe Material POP Paneles?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BC3:BD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('BE3', function($cell) {
                    $cell->setValue(' Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BE3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('BF3', function($cell) {
                    $cell->setValue(' ¿Funciona luz Led? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BG3:BJ3');
                $sheet->cell('BG3', function($cell) {
                    $cell->setValue('¿Es visible material POP Paneles?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BG3:BJ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BK3:BM3');
                $sheet->cell('BK3', function($cell) {
                    $cell->setValue(' ¿Cuál es el estado del material POP Paneles?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BK3:BM3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BN3:BS3');
                $sheet->cell('BN3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Paneles? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BN3:BS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

            });

            $excel->sheet('Presencia POP REGULARES 2', function($sheet) use ($tipo, $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",".$visit_id.",".$tipo.",2,0)";
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
                    "VISITA",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",

                    /*566*/
                    "Respuesta",
                    "Foto",

                    "Base",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Imagen Deteriorada",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*562*/
                    "Respuesta",
                    "Foto",

                    "Base",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Imagen Deteriorada",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*567*/
                    "Respuesta",
                    "Foto",

                    "Base",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Imagen Deteriorada",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto"
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }

                $sheet->mergeCells('N3:Q3');

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Cliente Permitió tomar información?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('R3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*566*/

                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('¿Existe Material POP Vitrinas?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('X3:AA3');
                $sheet->cell('X3', function($cell) {
                    $cell->setValue('¿Es visible material POP Vitrinas?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('X3:AA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AB3:AF3');
                $sheet->cell('AB3', function($cell) {
                    $cell->setValue('¿Cuál es el estado del material POP Vitrinas?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AB3:AF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AG3:AL3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Vitrinas? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AG3:AL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*562*/
                $sheet->mergeCells('AM3:AN3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('¿Existe Material POP Ficticio?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AM3:AN3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AO3', function($cell) {
                    $cell->setValue(' Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AP3:AS3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('¿Es visible material POP Ficticio?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AP3:AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });


                $sheet->mergeCells('AT3:AV3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue('¿Cuál es el estado del material POP Ficticio?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3:AV3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AW3:BB3');
                $sheet->cell('AW3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Ficticio? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AW3:BB3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*565*/
                $sheet->mergeCells('BC3:BD3');
                $sheet->cell('BC3', function($cell) {
                    $cell->setValue(' ¿Existe Material POP Viniles de Mesón?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BC3:BD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->cell('BE3', function($cell) {
                    $cell->setValue(' Bayer');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BE3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('BF3:BI3');
                $sheet->cell('BF3', function($cell) {
                    $cell->setValue('¿Es visible material POP Viniles de Mesón?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BF3:BI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('BJ3:BL3');
                $sheet->cell('BJ3', function($cell) {
                    $cell->setValue('¿Cuál es el estado del material POP Viniles de Mesón?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BJ3:BL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BM3:BR3');
                $sheet->cell('BM3', function($cell) {
                    $cell->setValue(' ¿Realizó cambios en material Viniles de Mesón? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BM3:BR3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

            });

        })->export('xls');
    }

    public function presencePopMercaderismoBayerxxx()
    {

        Excel::create('Bayer Mercaderismo Presencia POP REGULARES', function($excel) {
            $excel->setTitle('Presencia POP');
            $excel->sheet('Presencia POP REGULARES 1', function($sheet) {
                $sqlcoord="CALL sp_rep_presence_pop(79,1)";
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
                    "VISITA",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    /*564*/


                    /*561*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*563*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*565*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*566*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*562*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*567*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto"
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('W' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('W' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('W' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BG' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BG' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BW' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BW' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BZ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BZ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('DG' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('DG' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('DG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('DJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('DJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('DJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->mergeCells('N3:Q3');

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('R3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*564*/
                /*$sheet->mergeCells('W3:Y3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Existe Material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:Y3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('Z3', function($cell) {
                    $cell->setValue(' ¿Tiene stock de producto? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AA3:AD3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Es visible material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AA3:AD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AE3:AI3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AE3:AI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AJ3:AO3');
                $sheet->cell('AJ3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Cabecera Gondola? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AJ3:AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });*//*561*/
//                $sheet->getCell('A7')
//                    ->getHyperlink()
//                    ->setUrl('http://examle.com/uploads/cv/' )
//                    ->setTooltip('Click here to access file');
                $sheet->mergeCells('U3:W3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Existe Material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:W3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('X3:AA3');
                $sheet->cell('X3', function($cell) {
                    $cell->setValue(' Es visible material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('X3:AA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AB3:AF3');
                $sheet->cell('AB3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AB3:AF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AG3:AL3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Corporeos? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AG3:AL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*563*/
                $sheet->mergeCells('AM3:AO3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue(' Existe Material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AM3:AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AP3:AS3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue(' Es visible material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AP3:AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AT3:AX3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3:AX3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AY3:BD3');
                $sheet->cell('AY3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Bidoneras? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AY3:BD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*565*/
                $sheet->mergeCells('BE3:BG3');
                $sheet->cell('BE3', function($cell) {
                    $cell->setValue(' Existe Material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BE3:BG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('BH3', function($cell) {
                    $cell->setValue(' ¿Funciona luz Led? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BH3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BI3:BL3');
                $sheet->cell('BI3', function($cell) {
                    $cell->setValue(' Es visible material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BI3:BL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BM3:BQ3');
                $sheet->cell('BM3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BM3:BQ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BR3:BW3');
                $sheet->cell('BR3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Paneles? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BR3:BW3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                /*566*/
                $sheet->mergeCells('BX3:BZ3');
                $sheet->cell('BX3', function($cell) {
                    $cell->setValue(' Existe Material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BX3:BZ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CA3:CD3');
                $sheet->cell('CA3', function($cell) {
                    $cell->setValue(' Es visible material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CA3:CD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CE3:CI3');
                $sheet->cell('CE3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CE3:CI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CJ3:CO3');
                $sheet->cell('CJ3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Vitrinas? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CJ3:CO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562 585*/
                $sheet->mergeCells('CP3:CR3');
                $sheet->cell('CP3', function($cell) {
                    $cell->setValue(' Existe Material Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CP3:CR3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CS3:CV3');
                $sheet->cell('CS3', function($cell) {
                    $cell->setValue(' Es visible material POP Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CS3:CV3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CW3:DA3');
                $sheet->cell('CW3', function($cell) {
                    $cell->setValue(' Cual es el estado POP Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CW3:DA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DB3:DG3');
                $sheet->cell('DB3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en POP Ficticio? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DB3:DG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('DH3:DJ3');
                $sheet->cell('DH3', function($cell) {
                    $cell->setValue(' Existe Material Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DH3:DJ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DK3:DN3');
                $sheet->cell('DK3', function($cell) {
                    $cell->setValue(' Es visible material Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DK3:DN3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DO3:DS3');
                $sheet->cell('DO3', function($cell) {
                    $cell->setValue(' Cual es el estado Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DO3:DS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DT3:DY3');
                $sheet->cell('DT3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en Viniles de Mesón ? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DT3:DY3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                /*568*/
            });
        })->export('xls');
    }

    public function presencePopMercaderismoBayer2()
    {

        Excel::create('Bayer Mercaderismo Presencia POP REGULARES', function($excel) {
            $excel->setTitle('Presencia POP');
            $excel->sheet('Presencia POP REGULARES 2', function($sheet) {
                $sqlcoord="CALL sp_rep_presence_pop(79,2)";
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
                    "VISITA",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    /*564*/
                    /*"Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",*/


                    /*561*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*563*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*565*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*566*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*562*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto",
                    /*567*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    "Respuesta",
                    "Deteriorado",
                    "Decolorado",
                    "Roto",
                    "Comentario",

                    "Respuesta",
                    "Lo Descontamine",
                    "Mejore Ubicación",
                    "Otros",
                    "Comentario",
                    "Foto"
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('W' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('W' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('W' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BG' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BG' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BW' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BW' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BZ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BZ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('DG' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('DG' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('DG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('DJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('DJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('DJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->mergeCells('N3:Q3');

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('R3:T3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿ Cliente Permitio tomar información ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('R3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*564*/
                /*$sheet->mergeCells('W3:Y3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Existe Material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:Y3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('Z3', function($cell) {
                    $cell->setValue(' ¿Tiene stock de producto? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AA3:AD3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Es visible material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AA3:AD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AE3:AI3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Cabecera Gondola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AE3:AI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AJ3:AO3');
                $sheet->cell('AJ3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Cabecera Gondola? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AJ3:AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });*//*561*/
//                $sheet->getCell('A7')
//                    ->getHyperlink()
//                    ->setUrl('http://examle.com/uploads/cv/' )
//                    ->setTooltip('Click here to access file');
                $sheet->mergeCells('U3:W3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Existe Material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:W3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('X3:AA3');
                $sheet->cell('X3', function($cell) {
                    $cell->setValue(' Es visible material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('X3:AA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AB3:AF3');
                $sheet->cell('AB3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Corporeos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AB3:AF3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AG3:AL3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Corporeos? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AG3:AL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*563*/
                $sheet->mergeCells('AM3:AO3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue(' Existe Material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AM3:AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AP3:AS3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue(' Es visible material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AP3:AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AT3:AX3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3:AX3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AY3:BD3');
                $sheet->cell('AY3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Bidoneras? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AY3:BD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*565*/
                $sheet->mergeCells('BE3:BG3');
                $sheet->cell('BE3', function($cell) {
                    $cell->setValue(' Existe Material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BE3:BG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('BH3', function($cell) {
                    $cell->setValue(' ¿Funciona luz Led? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BH3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BI3:BL3');
                $sheet->cell('BI3', function($cell) {
                    $cell->setValue(' Es visible material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BI3:BL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BM3:BQ3');
                $sheet->cell('BM3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BM3:BQ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('BR3:BW3');
                $sheet->cell('BR3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Paneles? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BR3:BW3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                /*566*/
                $sheet->mergeCells('BX3:BZ3');
                $sheet->cell('BX3', function($cell) {
                    $cell->setValue(' Existe Material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('BX3:BZ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CA3:CD3');
                $sheet->cell('CA3', function($cell) {
                    $cell->setValue(' Es visible material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CA3:CD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CE3:CI3');
                $sheet->cell('CE3', function($cell) {
                    $cell->setValue(' Cual es el estado del material POP Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CE3:CI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CJ3:CO3');
                $sheet->cell('CJ3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en material Vitrinas? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CJ3:CO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562 585*/
                $sheet->mergeCells('CP3:CR3');
                $sheet->cell('CP3', function($cell) {
                    $cell->setValue(' Existe Material Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CP3:CR3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CS3:CV3');
                $sheet->cell('CS3', function($cell) {
                    $cell->setValue(' Es visible material POP Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CS3:CV3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('CW3:DA3');
                $sheet->cell('CW3', function($cell) {
                    $cell->setValue(' Cual es el estado POP Ficticio');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('CW3:DA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DB3:DG3');
                $sheet->cell('DB3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en POP Ficticio? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DB3:DG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('DH3:DJ3');
                $sheet->cell('DH3', function($cell) {
                    $cell->setValue(' Existe Material Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DH3:DJ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DK3:DN3');
                $sheet->cell('DK3', function($cell) {
                    $cell->setValue(' Es visible material Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DK3:DN3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DO3:DS3');
                $sheet->cell('DO3', function($cell) {
                    $cell->setValue(' Cual es el estado Viniles de Mesón ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DO3:DS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('DT3:DY3');
                $sheet->cell('DT3', function($cell) {
                    $cell->setValue(' ¿Realizo cambios en Viniles de Mesón ? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('DT3:DY3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                /*568*/
            });
        })->export('xls');
    }

    public function presencePopMercaderismoBayerAASS($company_id, $visit_id)
    {

        Excel::create('Bayer Mercaderismo Presencia POP AASS', function($excel) use ($company_id, $visit_id) {
            $excel->setTitle('Presencia POP');
            $excel->sheet('Presencia POP AASS', function($sheet) use ( $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",".$visit_id.",2,1,0)";
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
                    "VISITA",

                    /*585*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Bayer",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    /*586*/
                    "Respuesta",
                    "Comentario",
                    "Foto",

                    "Respuesta",//lay out

                    "Bayer",

                    "Respuesta",
                    "Mala Ubicación",
                    "Contaminado",
                    "Comentario",

                    /*683*/
                    "Respuesta",
                    "Comentario",
                    "Foto",
                    "Respuesta", /*683-887*/
                    "Respuesta", /*683-888*/
                    "Respuesta", /*683-889*/
                    "Respuesta", /*683-890*/
                    "Respuesta", /*683-891*/
                    "Respuesta" /*683-892*/
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('G' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('G' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('G' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->mergeCells('N3:P3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿Existe Material Bepanthen AASS?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('N3:P3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue(' Base');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('R3:U3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Es visible material Bepanthen AASS?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('R3:U3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*586*/
                $sheet->mergeCells('V3:X3');
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('¿Existe Material Ganchera?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('V3:X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->cell('Y3', function($cell) {
                    $cell->setValue('¿Cumple Lay Out?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('Z3', function($cell) {
                    $cell->setValue(' Base');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->mergeCells('AA3:AD3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue('¿Es visible material Ganchera?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AA3:AD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683*/
                $sheet->mergeCells('AE3:AG3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue('¿Existe Material Vitaminas AASS?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AE3:AG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-887*/
                $sheet->cell('AH3', function($cell) {
                    $cell->setValue('Redoxon');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AH3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-888*/
                $sheet->cell('AI3', function($cell) {
                    $cell->setValue('Supradyn Grageas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-889*/
                $sheet->cell('AJ3', function($cell) {
                    $cell->setValue('Supradyn EEFF');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AJ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-890*/
                $sheet->cell('AK3', function($cell) {
                    $cell->setValue('Berocca EEFF');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AK3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-891*/
                $sheet->cell('AL3', function($cell) {
                    $cell->setValue('Berocca Comprimidos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AL3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });/*683-892*/
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('Supradyn Capsulas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AM3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
            });
        })->export('xls');
    }

    public function presencePopMercaderismoBayerCabeceras($company_id)
    {

        $num_visitas = $this->pollDetailRepo->getVisitStores($company_id,564,"0","0","0");
        Excel::create('Bayer Mercaderismo Cabeceras', function($excel) use ($num_visitas, $company_id) {
            $excel->setTitle('Presencia Cabeceras');
            foreach ($num_visitas as $num_visita) {
                $numero_visita = $num_visita->visit_id;
                $excel->sheet('Visita '.$numero_visita, function($sheet) use ($numero_visita, $company_id) {
                    $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",".$numero_visita.",1,1,0)";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $count=0;
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                        $count ++ ;
                    }
                    $headings = array(
                        "ID",//A
                        "TIPO",//B
                        "CLIENTE",//C
                        "NOMBRE",//D
                        "DIRECCIÓN",//E
                        "DISTRITO",//F
                        "AUDITOR",//G
                        "FECHA",//H
                        "HORA",//I
                        "VISITA",//J
                        "Respuesta",//K 1367
                        "Opciones",//L 1367
                        "Comentario",//M 1367
                        "Foto",//N 1367
                        "Respuesta",//O 1369
                        "Opciones",//P 1369
                        "Comentario",//Q 1369

                        /*564*/
                        "Respuesta",//R 1370
                        "Comentario",//S 1370
                        "Foto",//T 1370

                        "Bayer",//U

                        "Respuesta",//V 1371

                        "Respuesta",//W 1373

                        "Respuesta",//X 1374
                        "Imagen Deteriorada",//Y 1374 A
                        "Contaminado",//Z 1374 B
                        "Roto",//AA  1374 C

                        "Respuesta",//AB 1442
                        "Lo Descontamine",//AC 1442 A
                        "Otros",//AD 1442 C
                        "Comentario",//AE 1442 COMENT
                        "Foto"//AF 1442 FOTO

                        //"Respuesta",//AI 1375
                        //"Anaquel",//AJ 1375 A
                        //"Sobre Mesón",//AK 1375 B
                        //"Vitrinas",//AL 1375 C
                        //"Otros",//AM 1375 D
                        //"Comentario",//AN 1375 COMENT
                        //"Foto"//AO 1375 FOTO
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
                    for ($i = 1; $i <= count($data); $i++) {

                        $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AF' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AF' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        /*$url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }*/

                    }

                    $sheet->mergeCells('K3:N3');

                    $sheet->cell('K3', function($cell) {
                        $cell->setValue('¿ Se encuentra abierto el punto ?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->cells('K3:N3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('O3:Q3');
                    $sheet->cell('O3', function($cell) {
                        $cell->setValue('¿ Cliente Permitió tomar información ?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('O3:Q3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    /*564*/
                    $sheet->mergeCells('R3:T3');
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue('¿Existe Material Cabecera?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('R3:T3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->cell('U3', function($cell) {
                        $cell->setValue(' Base');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('U3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->cell('V3', function($cell) {
                        $cell->setValue('¿Hay Stock de Productos?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('V3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->cell('W3', function($cell) {
                        $cell->setValue('¿Es visible material Cabecera?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('W3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('X3:AA3');
                    $sheet->cell('X3', function($cell) {
                        $cell->setValue('¿Cuál es el estado de la cabecera?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('X3:AA3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('AB3:AF3');
                    $sheet->cell('AB3', function($cell) {
                        $cell->setValue('¿Realizó cambios en material en Cabecera?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AB3:AF3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    /*$sheet->mergeCells('AI3:AO3');
                    $sheet->cell('AI3', function($cell) {
                        $cell->setValue(' Tiene espacio adicional para elementos gratuitos (Ficticios)');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AI3:AO3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });*/
                });
            }

        })->export('xls');
    }

    public function presencePopMercaderismoBayerCompetencia($company_id)
    {
        Excel::create('Bayer Mercaderismo Competencia', function($excel) use ($company_id) {
            $excel->setTitle('Presencia Competencia');
            $excel->sheet('Panadol', function($sheet) use ($company_id) {
                //$sqlcoord="CALL sp_rep_presence_pop_competencia(79,685,1376)";
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",0,3,0,685)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",//A
                    "TIPO",//B
                    "CLIENTE",//C
                    "NOMBRE",//D
                    "DIRECCIÓN",//E
                    "DISTRITO",//F
                    "AUDITOR",//G
                    "FECHA",//H
                    "HORA",//I
                    "VISITA",//J

                    /*561*/
                    "Respuesta",//K
                    "Foto",//L

                    /*562*/
                    "Respuesta",//M
                    "Foto",//N

                    /*563*/
                    "Respuesta",//O
                    "Foto",//P

                    /*564*/
                    "Respuesta",//Q
                    "Foto",//R

                    /*565*/
                    "Respuesta",//S
                    "Foto",//T

                    /*566*/
                    "Respuesta",//U
                    "Foto",//V

                    /*567*/
                    "Respuesta",//W
                    "Foto",//X

                    /*568*/
                    "Respuesta",//Y
                    "Foto"//Z

                    /*585*/
                    //"Respuesta",//AA
                    //"Foto",//AB

                    /*586*/
                    //"Respuesta",//AC
                    //"Foto"//AD
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
                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('L' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('L' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('L' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*$url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }*/
                }


                /*561*/
                $sheet->mergeCells('K3:L3');
                $sheet->cell('K3', function($cell) {
                    $cell->setValue('Corpóreos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('K3:L3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562*/
                $sheet->mergeCells('M3:N3');
                $sheet->cell('M3', function($cell) {
                    $cell->setValue(' Ficticios');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*563*/
                $sheet->mergeCells('O3:P3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue(' Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('O3:P3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*564*/
                $sheet->mergeCells('Q3:R3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('Cabecera Góndola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3:R3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*565*/
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue(' Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*566*/
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Viniles de Mesón / Afiche');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*568*/
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue(' Otros');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*585*/
                /*$sheet->mergeCells('AA3:AB3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Bepanthen AASS');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AA3:AB3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });*/

                /*586*/
                /*$sheet->mergeCells('AC3:AD3');
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue(' Ganchera');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AC3:AD3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });*/
            });

            $excel->sheet('Kitadol', function($sheet) use ($company_id) {
                //$sqlcoord="CALL sp_rep_presence_pop_competencia(79,686,1376)";
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",0,3,0,686)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",//A
                    "TIPO",//B
                    "CLIENTE",//C
                    "NOMBRE",//D
                    "DIRECCIÓN",//E
                    "DISTRITO",//F
                    "AUDITOR",//G
                    "FECHA",//H
                    "HORA",//I
                    "VISITA",//J

                    /*561*/
                    "Respuesta",//K
                    "Foto",//L

                    /*562*/
                    "Respuesta",//M
                    "Foto",//N

                    /*563*/
                    "Respuesta",//O
                    "Foto",//P

                    /*564*/
                    "Respuesta",//Q
                    "Foto",//R

                    /*565*/
                    "Respuesta",//S
                    "Foto",//T

                    /*566*/
                    "Respuesta",//U
                    "Foto",//V

                    /*567*/
                    "Respuesta",//W
                    "Foto",//X

                    /*568*/
                    "Respuesta",//Y
                    "Foto"//Z

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
                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('L' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('L' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('L' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }


                /*561*/
                $sheet->mergeCells('K3:L3');
                $sheet->cell('K3', function($cell) {
                    $cell->setValue('Corpóreos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('K3:L3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562*/
                $sheet->mergeCells('M3:N3');
                $sheet->cell('M3', function($cell) {
                    $cell->setValue(' Ficticios');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*563*/
                $sheet->mergeCells('O3:P3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue(' Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('O3:P3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*564*/
                $sheet->mergeCells('Q3:R3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('Cabecera Góndola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3:R3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*565*/
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue(' Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*566*/
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Viniles de Mesón / Afiche');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*568*/
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue(' Otros');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

            });

            $excel->sheet('Doloflam', function($sheet) use ($company_id) {
                //$sqlcoord="CALL sp_rep_presence_pop_competencia(79,687,1376)";
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",0,3,0,687)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",//A
                    "TIPO",//B
                    "CLIENTE",//C
                    "NOMBRE",//D
                    "DIRECCIÓN",//E
                    "DISTRITO",//F
                    "AUDITOR",//G
                    "FECHA",//H
                    "HORA",//I
                    "VISITA",//J

                    /*561*/
                    "Respuesta",//K
                    "Foto",//L

                    /*562*/
                    "Respuesta",//M
                    "Foto",//N

                    /*563*/
                    "Respuesta",//O
                    "Foto",//P

                    /*564*/
                    "Respuesta",//Q
                    "Foto",//R

                    /*565*/
                    "Respuesta",//S
                    "Foto",//T

                    /*566*/
                    "Respuesta",//U
                    "Foto",//V

                    /*567*/
                    "Respuesta",//W
                    "Foto",//X

                    /*568*/
                    "Respuesta",//Y
                    "Foto"//Z

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
                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('L' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('L' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('L' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }


                /*561*/
                $sheet->mergeCells('K3:L3');
                $sheet->cell('K3', function($cell) {
                    $cell->setValue('Corpóreos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('K3:L3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562*/
                $sheet->mergeCells('M3:N3');
                $sheet->cell('M3', function($cell) {
                    $cell->setValue(' Ficticios');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*563*/
                $sheet->mergeCells('O3:P3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue(' Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('O3:P3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*564*/
                $sheet->mergeCells('Q3:R3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('Cabecera Góndola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3:R3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*565*/
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue(' Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*566*/
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Viniles de Mesón / Afiche');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*568*/
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue(' Otros');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

            });

            $excel->sheet('Vick', function($sheet) use ($company_id) {
                //$sqlcoord="CALL sp_rep_presence_pop_competencia(79,688,1376)";
                $sqlcoord="CALL sp_bayer_mercad_regular(".$company_id.",0,3,0,688)";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",//A
                    "TIPO",//B
                    "CLIENTE",//C
                    "NOMBRE",//D
                    "DIRECCIÓN",//E
                    "DISTRITO",//F
                    "AUDITOR",//G
                    "FECHA",//H
                    "HORA",//I
                    "VISITA",//J

                    /*561*/
                    "Respuesta",//K
                    "Foto",//L

                    /*562*/
                    "Respuesta",//M
                    "Foto",//N

                    /*563*/
                    "Respuesta",//O
                    "Foto",//P

                    /*564*/
                    "Respuesta",//Q
                    "Foto",//R

                    /*565*/
                    "Respuesta",//S
                    "Foto",//T

                    /*566*/
                    "Respuesta",//U
                    "Foto",//V

                    /*567*/
                    "Respuesta",//W
                    "Foto",//X

                    /*568*/
                    "Respuesta",//Y
                    "Foto"//Z

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
                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('L' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('L' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('L' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('R' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('R' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('R' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }


                /*561*/
                $sheet->mergeCells('K3:L3');
                $sheet->cell('K3', function($cell) {
                    $cell->setValue('Corpóreos');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('K3:L3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*562*/
                $sheet->mergeCells('M3:N3');
                $sheet->cell('M3', function($cell) {
                    $cell->setValue(' Ficticios');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*563*/
                $sheet->mergeCells('O3:P3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue(' Bidoneras');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('O3:P3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*564*/
                $sheet->mergeCells('Q3:R3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('Cabecera Góndola');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3:R3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*565*/
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue(' Paneles');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*566*/
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue(' Vitrinas');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('U3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*567*/
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Viniles de Mesón / Afiche');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:X3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                /*568*/
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue(' Otros');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Y3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

            });

        })->export('xls');
    }

    public function ordersBayerTransferencista($company_id)
    {
        $mytime = Carbon\Carbon::now();
        $fecha = $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Bayer Pedidos_' . $company_id . "-" . $fecha, function ($excel) use ($company_id) {
            $excel->setTitle('Transferencistas');
            $excel->sheet('Pedidos Bayer', function ($sheet) use ($company_id) {
                $sqlcoord = "CALL sp_orders_new(" . $company_id . ",0,0,0,". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count = 0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count++;
                }
                $headings = array(
                    "ORDER_ID",
                    "CODIGO",
                    "DISTRIBUIDOR_ID",
                    "DISTRIBUIDOR",
                    "STORE_ID",
                    "CLIENTE",
                    "RUC",
                    "CANAL",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "LATITUD",
                    "LONGITUD",
                    "ZONA",
                    "AUDITOR_ID",
                    "AUDITOR",
                    "COMPANY_ID",
                    "VISITA",
                    "FECHA",
                    "HORA",
                    "PRODUCT_ID",
                    "SKU",
                    "MARCA",
                    "PRODUCTO",
                    "CANTIDAD",
                    "PRECIO",
                    "MONTO",
                    "ATENDIDO",
                    "ZONA_TT",
                    "ZONA_SUP"
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data, null, 'A5', false, false);
                $sheet->row(4, function ($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                $sheet->setAutoFilter('A4:AE' . count($data));
                $sheet->mergeCells('N3:Q3');

            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function visibilidadOriente($company_id)
    {
        $mytime = Carbon\Carbon::now();
        $fecha = $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp Visibilidad Oriente_' . $company_id . "-" . $fecha, function($excel) use ($company_id) {
            $excel->setTitle('Visibilidad Oriente');
            $excel->sheet('Pagina 1', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_alicorp_visibilidad_oriente(".$company_id.",0,0,0,1,". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "CLIENTE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "TELEFONO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Respuesta",//N
                    "Opciones",//O
                    "Comentario",//P
                    "Foto",//*Q /*  "product__id_1 */
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_1 */ /*  "product__id_2*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_2*//*  "product__id_3*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_3*//*  "product__id_4*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_4*//*  "product__id_5*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_5*//*  "product__id_6*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                "Respuesta",//Y 2474
                    "Foto",//*Z
                "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto"//*AC  /* fin "product__id_6*/
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#76BD1D');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  "product__id_1*/
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AC' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AC' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_1*/

                    /*  "product__id_2*/
                    $url_foto =trim($sheet->getCell('AF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_2*/

                    /*  "product__id_3*/
                    $url_foto =trim($sheet->getCell('AR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AZ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AZ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BA' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BA' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_3*/
                    /*  "product__id_4*/
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_4*/
                    /*  "product__id_5*/
                    $url_foto =trim($sheet->getCell('BP' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BP' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BP' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BY' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BY' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_5*/
                    /*  "product__id_6*/
                    $url_foto =trim($sheet->getCell('CB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CK' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CK' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CK' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_6*/
                }
                $sheet->mergeCells('R2:AC2');
                $sheet->cell('R2', function($cell) {
                        $cell->setValue(' TROME ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AD2:AO2');
                $sheet->cell('AD2', function($cell) {
                    $cell->setValue(' DÍA ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AP2:BA2');
                $sheet->cell('AP2', function($cell) {
                    $cell->setValue(' JUMBO ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BB2:BM2');
                $sheet->cell('BB2', function($cell) {
                    $cell->setValue(' NORCHEFF ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BN2:BY2');
                $sheet->cell('BN2', function($cell) {
                    $cell->setValue(' SAYON ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BZ2:CK2');
                $sheet->cell('BZ2', function($cell) {
                    $cell->setValue(' ESPIGA DE ORO ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Q3');//

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });// /*  "product__id_1*/
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AA3:AB3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_1*/
                /*  "product__id_2*/
                $sheet->cell('AD3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AE3:AF3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AG3:AH3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AI3:AJ3');
                $sheet->cell('AI3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AK3:AL3');
                $sheet->cell('AK3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AM3:AN3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AO3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_2*/

                /*  "product__id_3*/
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AQ3:AR3');
                $sheet->cell('AQ3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AS3:AT3');
                $sheet->cell('AS3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AU3:AV3');
                $sheet->cell('AU3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AW3:AX3');
                $sheet->cell('AW3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AY3:AZ3');
                $sheet->cell('AY3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('BA3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_3*/
                /*  "product__id_4*/
                $sheet->cell('BB3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BC3:BD3');
                $sheet->cell('BC3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BE3:BF3');
                $sheet->cell('BE3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BG3:BH3');
                $sheet->cell('BG3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BI3:BJ3');
                $sheet->cell('BI3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BK3:BL3');
                $sheet->cell('BK3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('BM3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_4*/
                /*  "product__id_5*/
                $sheet->cell('BN3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BO3:BP3');
                $sheet->cell('BO3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BQ3:BR3');
                $sheet->cell('BQ3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BS3:BT3');
                $sheet->cell('BS3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BU3:BV3');
                $sheet->cell('BU3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('BW3:BX3');
                $sheet->cell('BW3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('BY3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_5*/

                /*  "product__id_6*/
                $sheet->cell('BZ3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('CA3:CB3');
                $sheet->cell('CA3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('CC3:CD3');
                $sheet->cell('CC3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('CE3:CF3');
                $sheet->cell('CE3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('CG3:CH3');
                $sheet->cell('CG3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('CI3:CJ3');
                $sheet->cell('CI3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('CK3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_6*/
            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function visibilidadBayerTrans($company_id,$visit_id,$tipo,$regular=1)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Visibilidad Bayer Transferencista '.$company_id."-".$fecha, function($excel) use ($tipo, $company_id, $visit_id,$regular) {
            $excel->setTitle('Presencia POP '.$regular);
            if ($regular==1){
                $excel->sheet('Presencia POP REGULARES 1', function($sheet) use ($tipo, $visit_id, $company_id) {
                    $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",1,0,0,". Auth::user()->id .")";
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
                        "ZONA",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "REGION",
                        "EJECUTIVO",
                        "UBIGEO",
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "VISITA",
                        "Respuesta",
                        "Foto",
                        /*564*/


                        /*561*/
                        "Respuesta",//U
                        "Foto",//V

                        "Base",//W

                        "Respuesta",//X

                        "Respuesta",//Y
                        "Mala Ubicación",//Z
                        "Contaminado",//AA
                        "Comentario",//AB

                        "Respuesta",//AC
                        "Imagen Deteriorada",//AD
                        "Parante Roto",//AE
                        "Comentario",//AF

                        "Respuesta",//AG
                        "Lo Descontamine",//
                        "Mejore Ubicación",//
                        "Otros",//
                        "Comentario",//
                        "Foto",//AL
                        /*563*/
                        "Respuesta",//AM
                        "Foto",//AN

                        "Base",//AO

                        "Respuesta",//AP
                        "Mala Ubicación",//
                        "Contaminado",//
                        "Comentario",//AS

                        "Respuesta",//AT
                        "Imagen Deteriorada",//AU
                        "Comentario",//AV

                        "Respuesta",//AW
                        "Lo Descontamine",//AX
                        "Mejore Ubicación",//AY
                        "Otros",//AZ
                        "Comentario",//BA
                        "Foto",//BB
                        /*565*/
                        "Respuesta",//BC
                        "Foto",//BD

                        "Base",//BE

                        "Respuesta",//BF

                        "Respuesta",//BG
                        "Mala Ubicación",//BH
                        "Contaminado",//BI
                        "Comentario",//BJ

                        "Respuesta",//BK
                        "Imagen Deteriorada",//BL
                        "Comentario",//BM

                        "Respuesta",//BN
                        "Lo Descontamine",//BO
                        "Mejore Ubicación",//BP
                        "Otros",//BQ
                        "Comentario",//BR
                        "Foto"//BS

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
                    for ($i = 1; $i <= count($data); $i++) {

                        $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AG' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AG' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AI' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AI' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AW' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0){
                            $sheet->getCell('AW' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AY' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0){
                            $sheet->getCell('AY' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BN' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BN' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                    }
                    $sheet->setAutoFilter('A4:BN'.count($data));
                    $sheet->mergeCells('N3:O3');

                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('¿ Se encuentra abierto el punto ?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    /*561*/
                    $sheet->mergeCells('P2:AG2');
                    $sheet->cell('P2', function($cell) {
                        $cell->setValue(' CORPOREO ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('P3:Q3');
                    $sheet->cell('P3', function($cell) {
                        $cell->setValue('¿Existe Material POP Corpóreos?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('P3:Q3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue(' Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('R3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->cell('S3', function($cell) {
                        $cell->setValue(' ¿Funciona luz Led? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('S3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('T3:W3');
                    $sheet->cell('T3', function($cell) {
                        $cell->setValue('¿Es visible material POP Corpóreos?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('T3:W3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('X3:AA3');
                    $sheet->cell('X3', function($cell) {
                        $cell->setValue('¿Cuál es el estado del material POP Corpóreos?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('X3:AA3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AB3:AG3');
                    $sheet->cell('AB3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Corpóreos? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AB3:AG3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });/*563*/
                    $sheet->mergeCells('AH2:AW2');
                    $sheet->cell('AH2', function($cell) {
                        $cell->setValue(' BIDONERA ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AH3:AI3');
                    $sheet->cell('AH3', function($cell) {
                        $cell->setValue('¿Existe Material POP Bidoneras?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AH3:AI3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('AJ3', function($cell) {
                        $cell->setValue(' Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AJ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AK3:AN3');
                    $sheet->cell('AK3', function($cell) {
                        $cell->setValue('¿Es visible material POP Bidoneras?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AK3:AN3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AO3:AQ3');
                    $sheet->cell('AO3', function($cell) {
                        $cell->setValue('¿Cuál es el estado del material POP Bidoneras?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AO3:AQ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AR3:AW3');
                    $sheet->cell('AR3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Bidoneras? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AR3:AW3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });/*565*/
                    $sheet->mergeCells('AX2:BN2');
                    $sheet->cell('AX2', function($cell) {
                        $cell->setValue(' PANELES ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AX3:AY3');
                    $sheet->cell('AX3', function($cell) {
                        $cell->setValue('¿Existe Material POP Paneles?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AX3:AY3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('AZ3', function($cell) {
                        $cell->setValue(' Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AZ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('BA3', function($cell) {
                        $cell->setValue(' ¿Funciona luz Led? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BA3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('BB3:BE3');
                    $sheet->cell('BB3', function($cell) {
                        $cell->setValue('¿Es visible material POP Paneles?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BB3:BE3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('BF3:BH3');
                    $sheet->cell('BF3', function($cell) {
                        $cell->setValue(' ¿Cuál es el estado del material POP Paneles?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BF3:BH3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('BI3:BN3');
                    $sheet->cell('BI3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Paneles? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BI3:BN3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                });
            }
            if ($regular==2){
                $excel->sheet('Presencia POP REGULARES 2', function($sheet) use ($tipo, $visit_id, $company_id) {
                    $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",2,0,0,". Auth::user()->id .")";
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
                        "VISITA",
                        "Respuesta",
                        "Foto",

                        /*566*/
                        "Respuesta",
                        "Foto",

                        "Base",

                        "Respuesta",
                        "Mala Ubicación",
                        "Contaminado",
                        "Comentario",

                        "Respuesta",
                        "Imagen Deteriorada",
                        "Decolorado",
                        "Roto",
                        "Comentario",

                        "Respuesta",
                        "Lo Descontamine",
                        "Mejore Ubicación",
                        "Otros",
                        "Comentario",
                        "Foto",
                        /*562*/
                        "Respuesta",
                        "Foto",

                        "Base",

                        "Respuesta",
                        "Mala Ubicación",
                        "Contaminado",
                        "Comentario",

                        "Respuesta",
                        "Imagen Deteriorada",
                        "Comentario",

                        "Respuesta",
                        "Lo Descontamine",
                        "Mejore Ubicación",
                        "Otros",
                        "Comentario",
                        "Foto",
                        /*567*/
                        "Respuesta",
                        "Foto",

                        "Base",

                        "Respuesta",
                        "Mala Ubicación",
                        "Contaminado",
                        "Comentario",

                        "Respuesta",
                        "Imagen Deteriorada",
                        "Comentario",

                        "Respuesta",
                        "Lo Descontamine",
                        "Mejore Ubicación",
                        "Otros",
                        "Comentario",
                        "Foto"
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
                    for ($i = 1; $i <= count($data); $i++) {

                        $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AG' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AG' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AI' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AI' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AW' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0){
                            $sheet->getCell('AW' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AY' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0){
                            $sheet->getCell('AY' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                    }
                    $sheet->setAutoFilter('A4:BM'.count($data));
                    $sheet->mergeCells('N3:O3');

                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('¿ Se encuentra abierto el punto ?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    /*566*/
                    $sheet->mergeCells('P2:AG2');
                    $sheet->cell('P2', function($cell) {
                        $cell->setValue(' VITRINAS ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('P3:Q3');
                    $sheet->cell('P3', function($cell) {
                        $cell->setValue('¿Existe Material POP Vitrinas?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('P3:Q3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue('Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('R3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('S3:V3');
                    $sheet->cell('S3', function($cell) {
                        $cell->setValue('¿Es visible material POP Vitrinas?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('S3:V3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('W3:AA3');
                    $sheet->cell('W3', function($cell) {
                        $cell->setValue('¿Cuál es el estado del material POP Vitrinas?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('W3:AA3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AB3:AG3');
                    $sheet->cell('AB3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Vitrinas? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AB3:AG3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });/*562*/
                    $sheet->mergeCells('AH2:AW2');
                    $sheet->cell('AH2', function($cell) {
                        $cell->setValue(' FICTICIOS ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AH3:AI3');
                    $sheet->cell('AH3', function($cell) {
                        $cell->setValue('¿Existe Material POP Ficticio?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AH3:AI3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->cell('AJ3', function($cell) {
                        $cell->setValue(' Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AJ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('AK3:AN3');
                    $sheet->cell('AK3', function($cell) {
                        $cell->setValue('¿Es visible material POP Ficticio?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AK3:AN3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });


                    $sheet->mergeCells('AO3:AQ3');
                    $sheet->cell('AO3', function($cell) {
                        $cell->setValue('¿Cuál es el estado del material POP Ficticio?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AO3:AQ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('AR3:AW3');
                    $sheet->cell('AR3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Ficticio? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AR3:AW3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });/*565*/
                    $sheet->mergeCells('AX2:BM2');
                    $sheet->cell('AX2', function($cell) {
                        $cell->setValue(' VINILES DE MESÓN ');
                        $cell->setBackground('#89D329');
                        $cell->setAlignment('center');
                        $cell->setFontWeight('bold');
                        $cell->setFontColor('#FFFFFF');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('AX3:AY3');
                    $sheet->cell('AX3', function($cell) {
                        $cell->setValue(' ¿Existe Material POP Viniles de Mesón?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AX3:AY3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->cell('AZ3', function($cell) {
                        $cell->setValue(' Bayer');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('AZ3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('BA3:BD3');
                    $sheet->cell('BA3', function($cell) {
                        $cell->setValue('¿Es visible material POP Viniles de Mesón?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BA3:BD3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                    $sheet->mergeCells('BE3:BG3');
                    $sheet->cell('BE3', function($cell) {
                        $cell->setValue('¿Cuál es el estado del material POP Viniles de Mesón?');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BE3:BG3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });
                    $sheet->mergeCells('BH3:BM3');
                    $sheet->cell('BH3', function($cell) {
                        $cell->setValue(' ¿Realizó cambios en material Viniles de Mesón? ');
                        $cell->setFontColor('#fefffe');
                        $cell->setAlignment('center');
                        $cell->setBackground('#0e5a97');
                    });
                    $sheet->cells('BH3:BM3', function($cells) {
                        $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    });

                });
            }

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function preguntasGeneralesCadenas($company_id,$visit_id,$tipo,$desde,$hasta){
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Preguntas Bayer Transferencista'.$company_id."-".$fecha."-".$desde."-".$hasta, function($excel) use ($tipo, $company_id, $visit_id,$desde,$hasta) {
            $excel->setTitle('Preguntas Bayer');
            $excel->sheet('CADENAS '."-".$desde."-".$hasta, function($sheet) use ($tipo, $visit_id, $company_id,$desde,$hasta) {
                $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",1,".$desde.",".$hasta.",". Auth::user()->id .")";
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
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",
                    "Respuesta",
                    "Foto",
                    /*564*/


                    /*561*/
                    "Respuesta",//U

                    "Respuesta",//W

                    "Respuesta",//X

                    "Respuesta",//Y

                    "Dependiente",//Z
                    "Quimico",//AA

                    "Respuesta"//AC

                    /*"No estaba el encargado",//AD
                    "Tiene stock suficiente",//AE
                    "Linea de credito excedida",//AF
                    "Realizo pedido al distribuidor",//AF
                    "Otros",
                    "Comentario",

                    "Comentario",

                    "Comentario"*/
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }
                $sheet->setAutoFilter('A4:U'.count($data));
                $sheet->mergeCells('M3:N3');

                $sheet->cell('M3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('¿Cuántas personas trabajan por turno Mañana? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cell('P3', function($cell) {
                    $cell->setValue(' ¿Cuántas personas trabajan por turno Tarde? ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cell('Q3', function($cell) {
                    $cell->setValue(' ¿Cuántas personas trabajan por turno Noche?  ');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cell('R3', function($cell) {
                    $cell->setValue('Nombre de la persona a quien se comunicó');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('Puesto');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('S3:T3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                /*$sheet->cell('V3', function($cell) {
                    $cell->setValue(' Cliente realizó pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->mergeCells('W3:AB3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('Razón de no pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('W3:AB3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue(' Nombre  con quien se comunico / o solicito el pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });*/

                $sheet->cell('U3', function($cell) {
                    $cell->setValue('Ingrese el Teléfono');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }
    public function preguntasGeneralesTradicional($company_id,$visit_id,$tipo,$desde,$hasta){
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Preguntas Bayer Transferencista'.$company_id."-".$fecha."-".$desde."-".$hasta, function($excel) use ($tipo, $company_id, $visit_id,$desde,$hasta) {
            $excel->setTitle('Preguntas Bayer');
            $excel->sheet('TRADICIONAL '."-".$desde."-".$hasta, function($sheet) use ($tipo, $visit_id, $company_id,$desde,$hasta) {
                $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",2,".$desde.",".$hasta.",". Auth::user()->id .")";
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
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",
                    "Respuesta",
                    "Foto",
                    /*564*/

                    "Respuesta",//AC
                    "Total",
                    "No estaba el encargado",//AD
                    "Tiene stock suficiente",//AE
                    "Linea de credito excedida",//AF
                    "Realizo pedido al distribuidor",//AF
                    "Otros",
                    "Comentario",

                    "Comentario",

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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('N' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('N' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('N' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }

                $sheet->setAutoFilter('A4:X'.count($data));
                $sheet->mergeCells('M3:N3');

                $sheet->cell('M3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('M3:N3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->cell('O3', function($cell) {
                    $cell->setValue(' Cliente realizó pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cell('P3', function($cell) {
                    $cell->setValue(' Monto Pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->mergeCells('Q3:V3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('Razón de no pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Q3:V3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });
                $sheet->cell('W3', function($cell) {
                    $cell->setValue(' Nombre  con quien se comunico / o solicito el pedido');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

                $sheet->cell('X3', function($cell) {
                    $cell->setValue('Ingrese el Teléfono');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });

            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function competenciasBayer($company_id,$visit_id,$tipo)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Competencias por lab Bayer Transferencista '.$company_id.'-'.$fecha, function($excel) use ($tipo, $company_id, $visit_id) {
            $excel->setTitle('Competencias Bayer');
            $excel->sheet('Competencias Pag. 1', function($sheet) use ($tipo, $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",1)";
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
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",
                    /*564*/

                    /*788*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Merck",//469
                    "Glaxo",//470
                    "Grunenthal",//471
                    "Farmindustria",//472
                    "Teva",//473
                    "Medifarma",//474
                    "Hersil",//475
                    "k2 Pharmavida",//476
                    "Otro",//477
                    "Comentario",//477
                    /*789*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Merck",//469
                    "Glaxo",//470
                    "Grunenthal",//471
                    "Farmindustria",//472
                    "Teva",//473
                    "Medifarma",//474
                    "Hersil",//475
                    "k2 Pharmavida",//476
                    "Otro",//477
                    "Comentario",//477
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }
                $sheet->setAutoFilter('A4:AM'.count($data));
                $sheet->mergeCells('N2:AM2');
                $sheet->cell('N2', function($cell) {
                    $cell->setValue(' ¿Qué actividades realiza la competencia?  ');
                    $cell->setBackground('#89D329');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Z3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue(' Vales de consumo ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('N3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AA3:AM3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Concursos ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('AA3:AM3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });


            });
            $excel->sheet('Competencias Pag. 2', function($sheet) use ($tipo, $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",2)";
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
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",
                    /*564*/

                    /*790*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Merck",//469
                    "Glaxo",//470
                    "Grunenthal",//471
                    "Farmindustria",//472
                    "Teva",//473
                    "Medifarma",//474
                    "Hersil",//475
                    "k2 Pharmavida",//476
                    "Otro",//477
                    "Comentario",//477
                    /*791*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Merck",//469
                    "Glaxo",//470
                    "Grunenthal",//471
                    "Farmindustria",//472
                    "Teva",//473
                    "Medifarma",//474
                    "Hersil",//475
                    "k2 Pharmavida",//476
                    "Otro",//477
                    "Comentario",//477
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }
                $sheet->setAutoFilter('A4:AM'.count($data));
                $sheet->mergeCells('N2:AM2');
                $sheet->cell('N2', function($cell) {
                    $cell->setValue(' ¿Qué actividades realiza la competencia?  ');
                    $cell->setBackground('#89D329');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Z3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue(' Degustaciones / Muestras ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('N3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AA3:AM3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Activaciones (Ofertas, encartes)  ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('AA3:AM3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });


            });
            $excel->sheet('Competencias Pag. 3', function($sheet) use ($tipo, $visit_id, $company_id) {
                $sqlcoord="CALL sp_bayert_visibilidad(".$company_id.",".$visit_id.",".$tipo.",3)";
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
                    "ZONA",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "EJECUTIVO",
                    "UBIGEO",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "VISITA",
                    /*564*/

                    /*792*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Merck",//469
                    "Glaxo",//470
                    "Grunenthal",//471
                    "Farmindustria",//472
                    "Teva",//473
                    "Medifarma",//474
                    "Hersil",//475
                    "k2 Pharmavida",//476
                    "Otro",//477
                    "Comentario",//477
                    /*793*/
                    "Respuesta",//U
                    "Foto",
                    "Bagó",//468
                    "Comentario",//477
                    "Merck",//469
                    "Comentario",//477
                    "Glaxo",//470
                    "Comentario",//477
                    "Grunenthal",//471
                    "Comentario",//477
                    "Farmindustria",//472
                    "Comentario",//477
                    "Teva",//473
                    "Comentario",//477
                    "Medifarma",//474
                    "Comentario",//477
                    "Hersil",//475
                    "Comentario",//477
                    "k2 Pharmavida",//476
                    "Comentario",//477
                    "Otro",//477
                    "Comentario",//477
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
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }
                $sheet->setAutoFilter('A4:AV'.count($data));
                $sheet->mergeCells('N2:AV2');
                $sheet->cell('N2', function($cell) {
                    $cell->setValue(' ¿Qué actividades realiza la competencia?  ');
                    $cell->setBackground('#89D329');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Z3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue(' Merchandising ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('N3:Z3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AA3:AV3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue(' Otros ');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cells('AA3:AV3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });


            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function visibilidadOrienteNewStore($ini,$end) {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Visibilidad Oriente New store_161_'.$fecha, function($excel) use ($ini,$end) {
            $excel->setTitle('Tiendas auditadas Visbilidad Oriente');
            $excel->sheet('Pagina 1', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_alicorp_visibilidad_oriente(161,1,'" . $ini . "','" . $end . "',1,". Auth::user()->id .")";
                //$sqlcoord="CALL sp_palmera_new_store('" . $ini . "','" . $end . "')";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "CLIENTE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "TELEFONO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Respuesta",//N
                    "Opciones",//O
                    "Comentario",//P
                    "Foto",//*Q /*  "product__id_1 */
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_1 */ /*  "product__id_2*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_2*//*  "product__id_3*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto"//*AC  /* fin "product__id_3*/

                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#76BD1D');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  "product__id_1*/
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AC' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AC' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_1*/

                    /*  "product__id_2*/
                    $url_foto =trim($sheet->getCell('AF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_2*/

                    /*  "product__id_3*/
                    $url_foto =trim($sheet->getCell('AR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AZ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AZ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BA' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BA' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_3*/
                    /*  "product__id_4*/
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_4*/
                    /*  "product__id_5*/
                    $url_foto =trim($sheet->getCell('BP' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BP' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BP' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BY' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BY' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_5*/
                    /*  "product__id_6*/
                    $url_foto =trim($sheet->getCell('CB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CK' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CK' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CK' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_6*/
                }
                $sheet->setAutoFilter('A4:BA'.count($data));
                $sheet->mergeCells('R2:AC2');
                $sheet->cell('R2', function($cell) {
                    $cell->setValue(' TROME ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AD2:AO2');
                $sheet->cell('AD2', function($cell) {
                    $cell->setValue(' DÍA ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AP2:BA2');
                $sheet->cell('AP2', function($cell) {
                    $cell->setValue(' JUMBO ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Q3');//

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });// /*  "product__id_1*/
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AA3:AB3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_1*/
                /*  "product__id_2*/
                $sheet->cell('AD3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AE3:AF3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AG3:AH3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AI3:AJ3');
                $sheet->cell('AI3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AK3:AL3');
                $sheet->cell('AK3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AM3:AN3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AO3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_2*/

                /*  "product__id_3*/
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AQ3:AR3');
                $sheet->cell('AQ3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AS3:AT3');
                $sheet->cell('AS3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AU3:AV3');
                $sheet->cell('AU3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AW3:AX3');
                $sheet->cell('AW3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AY3:AZ3');
                $sheet->cell('AY3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('BA3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_3*/

            });

            $excel->sheet('Pagina 2', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_alicorp_visibilidad_oriente(161,1,'" . $ini . "','" . $end . "',2,". Auth::user()->id .")";
                //$sqlcoord="CALL sp_palmera_new_store('" . $ini . "','" . $end . "')";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "CLIENTE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "TELEFONO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Respuesta",//N
                    "Opciones",//O
                    "Comentario",//P /*
                    "Foto",//  "product__id_4*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_4*//*  "product__id_5*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto",//*AC  /* fin "product__id_5*//*  "product__id_6*/
                    "Respuesta",//*R
                    "Respuesta",//S 2471
                    "Foto",//*T
                    "Respuesta",//U 2472
                    "Foto",//*V
                    "Respuesta",//W 2473
                    "Foto",//*X
                    "Respuesta",//Y 2474
                    "Foto",//*Z
                    "Respuesta",//AA  2475
                    "Foto",//*AB
                    "Foto"//*AC  /* fin "product__id_6*/
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#76BD1D');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  "product__id_1*/
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('V' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('V' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('V' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('X' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('X' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('X' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('Z' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Z' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Z' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AC' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AC' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_1*/

                    /*  "product__id_2*/
                    $url_foto =trim($sheet->getCell('AF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_2*/

                    /*  "product__id_3*/
                    $url_foto =trim($sheet->getCell('AR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AZ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AZ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BA' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BA' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_3*/
                    /*  "product__id_4*/
                    $url_foto =trim($sheet->getCell('BD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BL' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BL' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_4*/
                    /*  "product__id_5*/
                    $url_foto =trim($sheet->getCell('BP' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BP' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BP' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BT' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BT' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BT' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BX' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BX' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('BY' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BY' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_5*/
                    /*  "product__id_6*/
                    $url_foto =trim($sheet->getCell('CB' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CB' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CD' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CD' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CF' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CF' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CH' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CH' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CJ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CJ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('CK' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('CK' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('CK' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    /*  FIN "product__id_6*/
                }
                $sheet->setAutoFilter('A4:BA'.count($data));
                $sheet->mergeCells('R2:AC2');
                $sheet->cell('R2', function($cell) {
                    $cell->setValue(' NORCHEFF ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AD2:AO2');
                $sheet->cell('AD2', function($cell) {
                    $cell->setValue(' SAYON ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AP2:BA2');
                $sheet->cell('AP2', function($cell) {
                    $cell->setValue(' ESPIGA DE ORO ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('N3:Q3');//

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });//
                /*  "product__id_4*/
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('S3:T3');
                $sheet->cell('S3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('U3:V3');
                $sheet->cell('U3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('W3:X3');
                $sheet->cell('W3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('Y3:Z3');
                $sheet->cell('Y3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AA3:AB3');
                $sheet->cell('AA3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_4*/
                /*  "product__id_5*/
                $sheet->cell('AD3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AE3:AF3');
                $sheet->cell('AE3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AG3:AH3');
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AI3:AJ3');
                $sheet->cell('AI3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AK3:AL3');
                $sheet->cell('AK3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AM3:AN3');
                $sheet->cell('AM3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('AO3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_5*/

                /*  "product__id_6*/
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('¿Existe Ventana Alicorp?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AQ3:AR3');
                $sheet->cell('AQ3', function($cell) {
                    $cell->setValue('¿Está Trabajada? (Si Existe)');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AS3:AT3');
                $sheet->cell('AS3', function($cell) {
                    $cell->setValue('Colocación de Material POP Marcador de Precio');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AU3:AV3');
                $sheet->cell('AU3', function($cell) {
                    $cell->setValue('Colocación de Material POP Afiches');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AW3:AX3');
                $sheet->cell('AW3', function($cell) {
                    $cell->setValue('Colocación de Material POP Colgante');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AY3:AZ3');
                $sheet->cell('AY3', function($cell) {
                    $cell->setValue('Colocación de Material POP Ganchera');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->cell('BA3', function($cell) {
                    $cell->setValue('Foto Final de Ventana Alicorp');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });/*  "product__id_6*/

            });

            $excel->sheet('Pagina 3', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_alicorp_visibilidad_oriente(161,1,'" . $ini . "','" . $end . "',3,". Auth::user()->id .")";
                //$sqlcoord="CALL sp_palmera_new_store('" . $ini . "','" . $end . "')";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;

                //dd($stores);
                foreach ($stores as $result) {
                    //dd($result->1378_67_690_Comentario);
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "CLIENTE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "TELEFONO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "Respuesta",//N
                    "Opciones",//O
                    "Comentario",//P /*
                    "Foto",
                    "Respuesta",//N preg 9
                    "Aceite Tondero 900ml",//O
                    "Aceite Palmerola 900ml",
                    "Aceite Soi 900ml",
                    "Respuesta",//N preg 10
                    "Fid. Spaghe. Jose Antonio",//O
                    "Fid. Spaghe. Grano de Oro",
                    "Fid. Spaghe. Marco Polo",
                    "Respuesta",//N preg 11
                    "Det. Patito 150GR 60 BOL",//O
                    "Det. Sapolio 150GR 60 BOL",
                    "Respuesta",//N preg 12
                    "Jabon Popeye Blancura 230Gr",//O
                    "Jabon Popeye Antibacterial 230GR",
                    "Jabon Popeye Suavidad 230GR",
                    "Respuesta",//N preg 13
                    "Soda Gourmet San Jorge de 250gr",//O
                    "Rellenitas Surtidas GN",
                    "Comentarios",//N preg 14
                    "Se entrego Polo?",//N preg 15
                    "Foto Polo"
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#76BD1D');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }
                $sheet->setAutoFilter('A4:AL'.count($data));
                $sheet->mergeCells('R2:AH2');
                $sheet->cell('R2', function($cell) {
                    $cell->setValue(' VENTANAS ');
                    $cell->setBackground('#E40421');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });


                $sheet->mergeCells('N3:Q3');//

                $sheet->cell('N3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto el punto ?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });//

                $sheet->mergeCells('R3:U3');//
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Existe Ventana Aceites?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('V3:Y3');//
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('¿Existe Ventana Fideos?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('Z3:AB3');//
                $sheet->cell('Z3', function($cell) {
                    $cell->setValue('¿Existe Ventana Detergentes?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AC3:AF3');//
                $sheet->cell('AC3', function($cell) {
                    $cell->setValue('¿Existe Ventana Jabones?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AG3:AI3');//
                $sheet->cell('AG3', function($cell) {
                    $cell->setValue('¿Existe Ventana Galletas?');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AJ3:AL3');//
                $sheet->cell('AJ3', function($cell) {
                    $cell->setValue('OTROS');
                    $cell->setBackground('#B40312');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function ordersAlicorpGalletas($ini,$end)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp_Galletas Pedidos_166'."-".$fecha, function($excel) use ($ini,$end) {
            $excel->setTitle('Alicorp Galletas');
            $excel->sheet('Pedidos', function($sheet) use ($ini,$end) {
                $sqlcoord="CALL sp_orders_new(166,1,'" . $ini . "','" . $end . "',". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "ORDER_ID",
                    "CODIGO",
                    "DISTRIBUIDOR_ID",
                    "DISTRIBUIDOR",
                    "STORE_ID",
                    "RUC",
                    "CLIENTE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "TELEFONO",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",
                    "PRODUCT_ID",
                    "SKU",
                    "MARCA",
                    "PRODUCTO",
                    "CANTIDAD",
                    "PRECIO",
                    "MONTO",
                    "TIPO DE PAGO"
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
                $sheet->setAutoFilter('A4:Y'.count($data));
                $sheet->mergeCells('N3:Q3');

            });
        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }

    public function canjesAlicorp($company_id)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        Excel::create('Canjes Alicorp '.$company_id.'-'.$fecha, function($excel) use ($company_id) {
            $excel->setTitle('Canjes');
            $excel->sheet('Canjes Pag. 1', function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_alicorp_canjes(".$company_id.")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $count=0;
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                    $count ++ ;
                }
                $headings = array(
                    "STORE_ID",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "REGION",
                    "UBIGEO",
                    "EJECUTIVO",
                    "LATITUD",
                    "LONGITUD",
                    "FECHA",
                    "HORA",
                    /*564*/

                    /*788*/
                    "Distribuidor_id",//U
                    "Distribuidor",
                    "Mecánica",//469
                    "Product_id",//470
                    "Producto",//471
                    "Mecanica de Rotación",//472
                    "Cantidad",//473
                    "Foto",//477
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue($count);
                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#F70006');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('S' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('S' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('S' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }
                $sheet->setAutoFilter('A4:S'.count($data));
                $sheet->mergeCells('M3:S3');
                $sheet->cell('M3', function($cell) {
                    $cell->setValue(' Canjes realizados  ');
                    $cell->setBackground('#06B100');
                    $cell->setAlignment('center');
                    $cell->setFontWeight('bold');
                    $cell->setFontColor('#FFFFFF');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
            });

        })->export('xls');
    }
}