<?php
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: jcdia
 * Date: 6/07/2017
 * Time: 01:04
 */
class ExcelAlicorpController extends BaseController {


    public function index()
    {
    }

    /**
     * Excle alicor regular
     */
    public function excel87category53()
    {
        Excel::create('excel87category53', function($excel) {
            $excel->setTitle('Reporte Alicorp Regular');
            $excel->sheet('Categoría 53', function($sheet) {
                $sqlcoord="CALL sp_reporte_company_87_category_53();";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID","TIPO","RUC","NOMBRE","DIRECCION", "DISTRITO","REGION","UBIGEO","LATITUD","LONGITUD","AUDITOR","FECHA", "HORA","TIPO",
                    "¿Se encuentra Abierto? Si/No","Opciones","FOTO",
                    "¿Cliente permitió tomar informaciónn?","Opciones","Comentario","FOTO","¿ Se encontro exhibidor ?","Aún no lo colocaron",
                    "Cliente lo retiro","Cliente lo perdio o lo rompio","Cliente nunca lo acepto",
                    "Otros","Comentario","Es visible?","Está Contaminado","Foto","¿ Se encontro exhibidor ?","Aún no lo colocaron",
                    "Cliente lo retiro","Cliente lo perdio o lo rompio",
                    "Cliente nunca lo acepto","Otros","Comentario","Es visible?","Está Contaminado","Foto","¿ Se encontro exhibidor ?",
                    "Aún no lo colocaron","Cliente lo retiro","Cliente lo perdio o lo rompio",
                    "Cliente nunca lo acepto","Otros",
                    "Comentario","Es visible?","Está Contaminado",
                    "Foto","¿ Se encontro exhibidor ?","Aún no lo colocaron",
                    "Cliente lo retiro","Cliente lo perdio o lo rompio",
                    "Cliente nunca lo acepto","Otros",
                    "Comentario","Es visible?","Está Contaminado","Foto",
                    "¿ Se encontro exhibidor ?","Aún no lo colocaron",
                    "Cliente lo retiro","Cliente lo perdio o lo rompio","Cliente nunca lo acepto",
                    "Otros","Comentario","Es visible?","Está Contaminado","Foto",
                    "¿ Es cliente perfecto ?","¿Desde cuando es cliente perfecto?"
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                for ($i = 1; $i <= count($data); $i++) {
                    $sheet->getCell('Q' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('U' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('AE' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('AO' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('AY' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('BI' . ($i + 4))->getHyperlink()->getUrl();
                    $sheet->getCell('BS' . ($i + 4))->getHyperlink()->getUrl();
                }

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
                    $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AE' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AE' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AE' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AY' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AY' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BI' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BI' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BS' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BS' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->mergeCells('V3:AE3');
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('Ganchera Salsas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AF3:AO3');
                $sheet->cell('AF3', function($cell) {
                    $cell->setValue('Ganchera Frutísimos');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AP3:AY3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('Exhibidores Margarinas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });
                $sheet->mergeCells('AZ3:BI3');
                $sheet->cell('AZ3', function($cell) {
                    $cell->setValue('Posavuelto Galletas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('BJ3:BS3');
                $sheet->cell('BJ3', function($cell) {
                    $cell->setValue('Cubos de impulso');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

//                $sheet->mergeCells('O3:R3');
//
//                $sheet->cell('O3', function($cell) {
//                    $cell->setValue('¿ Se encuentra abierto el punto ?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('solid', 'none', 'none', 'solid');
//                });
//                $sheet->mergeCells('S3:U3');
//                $sheet->cell('S3', function($cell) {
//                    $cell->setValue('¿ Cliente Permitio tomar información ?');
//                    $cell->setFontColor('#fefffe');
//                    $cell->setAlignment('center');
//                    $cell->setBackground('#0e5a97');
//                });
//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
//                });
//                    $sheet->getCell('A7')
//                        ->getHyperlink()
//                        ->setUrl('http://examle.com/uploads/cv/' )
//                        ->setTooltip('Click here to access file');
            });
        })->export('xls');

    }

    public function excel87category54()
    {
        Excel::create('excel87category54', function($excel) {
            $excel->setTitle('Reporte Alicorp Regular');
            $excel->sheet('Categoría 54', function($sheet) {
                $sqlcoord="CALL sp_reporte_company_87_category_54();";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID","TIPO","RUC","NOMBRE","DIRECCION", "DISTRITO","REGION","UBIGEO","LATITUD","LONGITUD","AUDITOR","FECHA", "HORA","TIPO",
                    "Respuesta",
                    "Opciones",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿Existe Ventana?",
                    "¿La Ventana es visible?",
                    "¿Como se encuentra la Ventana?",
                    "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                    "%SOD",
                    "Foto",
                    "¿ Es cliente perfecto ?",
                    "¿Desde cuando es cliente perfecto?",
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                $sheet->setAutoFilter('A4:BY'.count($data));
                for ($i = 1; $i <= count($data); $i++) {
                    $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AA' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AA' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('AG' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AG' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AM' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AM' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AS' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AS' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AY' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AY' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BE' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BE' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BE' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BK' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BK' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BK' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BQ' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BQ' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BQ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('BW' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('BW' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('BW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }

                $sheet->mergeCells('O3:Q3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('Se encuentra Abierto el punto?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('R3:U3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('V3:AA3');
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('Ventana Salsas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('AB3:AG3');
                $sheet->cell('AB3', function($cell) {
                    $cell->setValue('Ventana Pastas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('AH3:AM3');
                $sheet->cell('AH3', function($cell) {
                    $cell->setValue('Ventana Aceites');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('AN3:AS3');
                $sheet->cell('AN3', function($cell) {
                    $cell->setValue('Ventana Galletas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('AT3:AY3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue('Ventana Refrescos');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('AZ3:BE3');
                $sheet->cell('AZ3', function($cell) {
                    $cell->setValue('Ventana Detergentes');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('BF3:BK3');
                $sheet->cell('BF3', function($cell) {
                    $cell->setValue('Ventana Conservas de Atún');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('BL3:BQ3');
                $sheet->cell('BL3', function($cell) {
                    $cell->setValue('Ventana Suavizantes');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('BR3:BW3');
                $sheet->cell('BR3', function($cell) {
                    $cell->setValue('Ventana Quitamanchas');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

            });

            $excel->sheet('Sod por Marca', function($sheet) {
                $sqlcoord="CALL sp_reporte_company_87_category_54_sod(87);";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID","TIPO","RUC","NOMBRE","DIRECCION", "DISTRITO","REGION","UBIGEO","LATITUD","LONGITUD","AUDITOR","FECHA", "HORA","TIPO",
                    "Respuesta",
                    "Opciones",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",

                    "Ventana Salsas \n Alacena",
                    "Ventana Salsas \n Competencia",
                    "Ventana Salsas \n Otras Marcas Alicorp",
                    "Ventana Pastas \n Don Victtorio",
                    "Ventana Pastas \n Lavaggi",
                    "Ventana Pastas \n Nicolini",
                    "Ventana Pastas \n Competencia",
                    "Ventana Pastas \n Otras Marcas Alicorp",
                    "Ventana Aceites \n Primor",
                    "Ventana Aceites \n Cocinero",
                    "Ventana Aceites \n Cil",
                    "Ventana Aceites \n Competencia",
                    "Ventana Aceites \n Otras Marcas Alicorp",
                    "Ventana Galletas \n Galletas Alicorp",
                    "Ventana Galletas \n Competencia",
                    "Ventana Galletas \n Otras Marcas Alicorp",
                    "Ventana Refrescos \n Frutisimos",
                    "Ventana Refrescos \n Negrita",
                    "Ventana Refrescos \n Kanu",
                    "Ventana Refrescos \n Competencia",
                    "Ventana Refrescos \n Otras Marcas Alicorp",
                    "Ventana Detergentes \n Detergente Bolivar",
                    "Ventana Detergentes \n Opal",
                    "Ventana Detergentes \n Marsella",
                    "Ventana Detergentes \n Competencia",
                    "Ventana Detergentes \n Otras Marcas Alicorp",
                    "Exhibidores Margarinas \n Sello de Oro",
                    "Exhibidores Margarinas \n Manty",
                    "Exhibidores Margarinas \n Competencia",
                    "Exhibidores Margarinas \n Otras Marcas Alicorp",
                    "Ventana Conservas de Atún \n Primor",
                    "Ventana Conservas de Atún \n Competencia",
                    "Ventana Conservas de Atún \n Otras Marcas Alicorp",
                    "Ventana Suavizantes \n Suavizante Bolivar",
                    "Ventana Suavizantes \n Competencia",
                    "Ventana Suavizantes \n Otras Marcas Alicorp",
                    "Ventana Quitamanchas \n Opal",
                    "Ventana Quitamanchas \n Competencia",
                    "Ventana Quitamanchas \n Otras Marcas Alicorp"
                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                //$sheet->getCell('B1')->setValue($datito);
                // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                    $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 32);
                $sheet->setAutoFilter('A4:BH'.count($data));


                $sheet->mergeCells('O3:Q3');
                $sheet->cell('O3', function($cell) {
                    $cell->setValue('Se encuentra Abierto el punto?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('R3:U3');
                $sheet->cell('R3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });



            });
        })->export('xls');

    }

    /**
     * Excle alicor regular
     */
    public function excelAlicorpRegular($company_id,$category_id)
    {
        Excel::create('AlicorpRegular', function($excel) use ($company_id, $category_id) {
            $excel->setTitle('Reporte Alicorp Regular');
            if($category_id == 53){
                $excel->sheet('Categoría 53', function($sheet) use ($category_id, $company_id) {
                    $sqlcoord="CALL sp_alicorp_regular(".$company_id.",".$category_id.",0);";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "TIPO",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "REGION",
                        "UBIGEO",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO",

                        "¿Se encuentra Abierto? Si/No",
                        "Opciones",
                        "FOTO",

                        "¿Cliente permitió tomar informaciónn?",
                        "Opciones",
                        "Comentario",
                        "FOTO",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",



                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiro",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo acepto",
                        "Otros",
                        "Comentario",
                        "Es visible?",
                        "Está Contaminado",
                        "Foto",


                        "¿ Es cliente perfecto ?",
                        "¿Desde cuando es cliente perfecto?"
                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    for ($i = 1; $i <= count($data); $i++) {
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('U' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AE' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AY' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('BI' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('BS' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('CC' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('CM' . ($i + 4))->getHyperlink()->getUrl();
                    }

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
                        $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AE' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AE' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AE' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AO' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AO' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AO' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AY' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AY' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AY' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BI' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BI' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BS' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BS' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('CC' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('CC' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('CC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('CM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('CM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('CM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->mergeCells('V3:AE3');
                    $sheet->cell('V3', function($cell) {
                        $cell->setValue('Ganchera Salsas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AF3:AO3');
                    $sheet->cell('AF3', function($cell) {
                        $cell->setValue('Ganchera Frutísimos');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AP3:AY3');
                    $sheet->cell('AP3', function($cell) {
                        $cell->setValue('Exhibidores Margarinas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AZ3:BI3');
                    $sheet->cell('AZ3', function($cell) {
                        $cell->setValue('Posavuelto Galletas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('BJ3:BS3');
                    $sheet->cell('BJ3', function($cell) {
                        $cell->setValue('Cubos de impulso');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('BT3:CC3');
                    $sheet->cell('BT3', function($cell) {
                        $cell->setValue('Ventana Quitamanchas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('CD3:CM3');
                    $sheet->cell('CD3', function($cell) {
                        $cell->setValue('Suavizante');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                });
            } else if($category_id == 54) {
                $excel->sheet('Categoría 54 - Pag. 1', function($sheet) use ($category_id, $company_id) {
                    $sqlcoord="CALL sp_alicorp_regular(".$company_id.",".$category_id.",1);";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID","TIPO",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "REGION",
                        "UBIGEO",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

//                        "¿ Es cliente perfecto ?",
//                        "¿Desde cuando es cliente perfecto?",
                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    $sheet->fromArray($data,null,'A5',false,false);
                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                    });

                    $sheet->setAutoFilter('A4:AS'.count($data));
                    for ($i = 1; $i <= count($data); $i++) {
                        $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AA' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AA' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AG' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AG' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AS' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AS' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

//
                    }

                    $sheet->mergeCells('O3:Q3');
                    $sheet->cell('O3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('R3:U3');
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('V3:AA3');
                    $sheet->cell('V3', function($cell) {
                        $cell->setValue('Ventana Salsas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AB3:AG3');
                    $sheet->cell('AB3', function($cell) {
                        $cell->setValue('Ventana Pastas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AH3:AM3');
                    $sheet->cell('AH3', function($cell) {
                        $cell->setValue('Ventana Aceites');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AN3:AS3');
                    $sheet->cell('AN3', function($cell) {
                        $cell->setValue('Ventana Galletas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                });
                $excel->sheet('Categoría 54 - Pag. 2', function($sheet) use ($category_id, $company_id) {
                    $sqlcoord="CALL sp_alicorp_regular(".$company_id.",".$category_id.",2);";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    };
                    $headings = array(
                        "ID","TIPO",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "REGION",
                        "UBIGEO",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",
                        "TIPO",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿La Ventana es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Ventana esta Trabajada? (Tiene fronterizador arriba y abajo)",
                        "%SOD",
                        "Foto",

//                        "¿ Es cliente perfecto ?",
//                        "¿Desde cuando es cliente perfecto?",
                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    $sheet->fromArray($data,null,'A5',false,false);
                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                    });

                    $sheet->setAutoFilter('A4:AS'.count($data));
                    for ($i = 1; $i <= count($data); $i++) {
                        $url_foto =trim($sheet->getCell('Q' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Q' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AA' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AA' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AA' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AG' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AG' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AG' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AS' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AS' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

//

                    }

                    $sheet->mergeCells('O3:Q3');
                    $sheet->cell('O3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('R3:U3');
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('V3:AA3');
                    $sheet->cell('V3', function($cell) {
                        $cell->setValue('Ventana Refrescos');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AB3:AG3');
                    $sheet->cell('AB3', function($cell) {
                        $cell->setValue('Ventana Detergentes');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AH3:AM3');
                    $sheet->cell('AH3', function($cell) {
                        $cell->setValue('Ventana Conservas de Atún');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                    $sheet->mergeCells('AN3:AS3');
                    $sheet->cell('AN3', function($cell) {
                        $cell->setValue('Ventana Suavizantes');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });



                });
                $excel->sheet('Sod por Marca', function($sheet) use ($company_id) {
                    $sqlcoord="CALL ttaudit_auditors.sp_alicorp_regular_sod(".$company_id.");";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID","TIPO","RUC","NOMBRE","DIRECCION", "DISTRITO","REGION","UBIGEO","LATITUD","LONGITUD","AUDITOR","FECHA", "HORA","TIPO",
                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "Ventana Salsas \n Alacena",
                        "Ventana Salsas \n Competencia",
                        "Ventana Salsas \n Otras Marcas Alicorp",
                        "Ventana Pastas \n Don Victtorio",
                        "Ventana Pastas \n Lavaggi",
                        "Ventana Pastas \n Nicolini",
                        "Ventana Pastas \n Competencia",
                        "Ventana Pastas \n Otras Marcas Alicorp",
                        "Ventana Aceites \n Primor",
                        "Ventana Aceites \n Cocinero",
                        "Ventana Aceites \n Cil",
                        "Ventana Aceites \n Competencia",
                        "Ventana Aceites \n Otras Marcas Alicorp",
                        "Ventana Galletas \n Galletas Alicorp",
                        "Ventana Galletas \n Competencia",
                        "Ventana Galletas \n Otras Marcas Alicorp",
                        "Ventana Refrescos \n Frutisimos",
                        "Ventana Refrescos \n Negrita",
                        "Ventana Refrescos \n Kanu",
                        "Ventana Refrescos \n Competencia",
                        "Ventana Refrescos \n Otras Marcas Alicorp",
                        "Ventana Detergentes \n Detergente Bolivar",
                        "Ventana Detergentes \n Opal",
                        "Ventana Detergentes \n Marsella",
                        "Ventana Detergentes \n Competencia",
                        "Ventana Detergentes \n Otras Marcas Alicorp",
                        "Ventana Conservas de Atún \n Primor",
                        "Ventana Conservas de Atún \n Competencia",
                        "Ventana Conservas de Atún \n Otras Marcas Alicorp",
                        "Ventana Suavizantes \n Suavizante Bolivar",
                        "Ventana Suavizantes \n Competencia",
                        "Ventana Suavizantes \n Otras Marcas Alicorp",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    //$sheet->getCell('B1')->setValue($datito);
                    // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                        $url_foto =trim($sheet->getCell('U' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('U' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->setAutoSize(true);
                    $sheet->setHeight(4, 32);
                    $sheet->setAutoFilter('A4:BA'.count($data));


                    $sheet->mergeCells('O3:Q3');
                    $sheet->cell('O3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('R3:U3');
                    $sheet->cell('R3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });



                });
            }

        })->export('xls');

    }

    public function excelAlicorpRegularV2($company_id,$category_id)
    {
        Excel::create('AlicorpRegular', function($excel) use ($company_id, $category_id) {
            $excel->setTitle('Reporte Alicorp Regular');
            if($category_id == 53){
                $excel->sheet('Categoría 53', function($sheet) use ($category_id, $company_id) {
                    $sqlcoord="CALL sp_alicorp_regular_v2(".$company_id.",".$category_id.",0);";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "¿Se encuentra Abierto? Si/No",
                        "Opciones",
                        "FOTO",

                        "¿Cliente permitió tomar informaciónn?",
                        "Opciones",
                        "Comentario",
                        "FOTO",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdió o lo rompi",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                        "¿ Se encontro exhibidor ?",
                        "Aún no lo colocaron",
                        "Cliente lo retiró",
                        "Cliente lo perdio o lo rompio",
                        "Cliente nunca lo aceptó",
                        "Otros",
                        "Comentario",
                        "¿Es visible?",
                        "¿Está Contaminado?",
                        "Foto",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    for ($i = 1; $i <= count($data); $i++) {
                        $sheet->getCell('Q' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('U' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AE' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AO' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('AY' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('BI' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('BS' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('CC' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('CM' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('CW' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('DG' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('DQ' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('EA' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('EK' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('EU' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('FE' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('FO' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('FY' . ($i + 4))->getHyperlink()->getUrl();
                        $sheet->getCell('GI' . ($i + 4))->getHyperlink()->getUrl();
                    }

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
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AD' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AD' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('CB' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('CB' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('CB' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('CL' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('CL' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('CL' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('CV' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('CV' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('CV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('DF' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('DF' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('DF' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('DP' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('DP' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('DP' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('DZ' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('DZ' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('DZ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('EJ' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('EJ' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('EJ' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('ET' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('ET' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('ET' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('FD' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('FD' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('FD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('FN' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('FN' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('FN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('FX' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('FX' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('FX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('GH' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('GH' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('GH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->mergeCells('U3:AD3');
                    $sheet->cell('U3', function($cell) {
                        $cell->setValue('Ganchera Salsas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AE3:AN3');
                    $sheet->cell('AE3', function($cell) {
                        $cell->setValue('Ganchera Frutísimos');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AO3:AX3');
                    $sheet->cell('AO3', function($cell) {
                        $cell->setValue('Exhibidores Margarinas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                    $sheet->mergeCells('AY3:BH3');
                    $sheet->cell('AY3', function($cell) {
                        $cell->setValue('Posavuelto Galletas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('BI3:BR3');
                    $sheet->cell('BI3', function($cell) {
                        $cell->setValue('Cubos de impulso');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('BS3:CB3');
                    $sheet->cell('BS3', function($cell) {
                        $cell->setValue('Suavizantes/quitamanchas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('CC3:CL3');
                    $sheet->cell('CC3', function($cell) {
                        $cell->setValue('Portafiche Multicategoría');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('CM3:CV3');
                    $sheet->cell('CM3', function($cell) {
                        $cell->setValue('Exhibidor Atún Primor (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('CW3:DF3');
                    $sheet->cell('CW3', function($cell) {
                        $cell->setValue('Exhibidor Bolsas Don Vittorio (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('DG3:DP3');
                    $sheet->cell('DG3', function($cell) {
                        $cell->setValue('Exhibidor Frutísimos (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('DQ3:DZ3');
                    $sheet->cell('DQ3', function($cell) {
                        $cell->setValue('Exhibidor Margarinas (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('EA3:EJ3');
                    $sheet->cell('EA3', function($cell) {
                        $cell->setValue('Ganchera Salsas (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('EK3:ET3');
                    $sheet->cell('EK3', function($cell) {
                        $cell->setValue('Ganchera Suavizantes y Quitamanchas (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('EU3:FD3');
                    $sheet->cell('EU3', function($cell) {
                        $cell->setValue('Mandil Don Vittorio (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('FE3:FN3');
                    $sheet->cell('FE3', function($cell) {
                        $cell->setValue('Mandil Detergente Bolivar (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('FO3:FX3');
                    $sheet->cell('FO3', function($cell) {
                        $cell->setValue('Paleta de precios Aceites Primor (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });

                    $sheet->mergeCells('FY3:GH3');
                    $sheet->cell('FY3', function($cell) {
                        $cell->setValue('Paleta de precios Detergente Bolivar (Mercados)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                });
            } else if($category_id == 54) {
                $excel->sheet('Categoría 54', function($sheet) use ($category_id, $company_id) {
                    $sqlcoord="CALL sp_alicorp_regular_v2(".$company_id.",".$category_id.",1);";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    $sheet->fromArray($data,null,'A5',false,false);
                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                    });

                    $sheet->setAutoFilter('A4:AS'.count($data));
                    for ($i = 1; $i <= count($data); $i++) {
                        $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('Y' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Y' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Y' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AD' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AD' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AI' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AI' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AS' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AS' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }


                        $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BC' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BC' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

//
                    }

                    $sheet->mergeCells('N3:P3');
                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Q3:T3');
                    $sheet->cell('Q3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('U3:Y3');
                    $sheet->cell('U3', function($cell) {
                        $cell->setValue('Ventana Salsas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Z3:AD3');
                    $sheet->cell('Z3', function($cell) {
                        $cell->setValue('Ventana Pastas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AE3:AI3');
                    $sheet->cell('AE3', function($cell) {
                        $cell->setValue('Ventana Aceites');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AJ3:AN3');
                    $sheet->cell('AJ3', function($cell) {
                        $cell->setValue('Ventana Galletas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                    $sheet->mergeCells('AO3:AS3');
                    $sheet->cell('AO3', function($cell) {
                        $cell->setValue(' Ventana Refrescos');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                    $sheet->mergeCells('AT3:AX3');
                    $sheet->cell('AT3', function($cell) {
                        $cell->setValue('Ventana Detergentes');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AY3:BC3');
                    $sheet->cell('AY3', function($cell) {
                        $cell->setValue('Ventana Conservas de Atún');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BD3:BH3');
                    $sheet->cell('BD3', function($cell) {
                        $cell->setValue('Ventana Suavizantes Bolivar');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BI3:BM3');
                    $sheet->cell('BI3', function($cell) {
                        $cell->setValue('Ventana Quitamanchas Opal');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BN3:BR3');
                    $sheet->cell('BN3', function($cell) {
                        $cell->setValue('Ventana Margarinas (Manty o Sello de Oro)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                });

            } else if($category_id == 58) {
                $excel->sheet('Sod por Marca', function($sheet) use ($company_id) {
                    $sqlcoord="CALL ttaudit_auditors.sp_alicorp_regular_sod_v2(".$company_id.");";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "Ventana Salsas \n Alacena",
                        "Ventana Salsas \n Competencia",
                        "Ventana Salsas \n Otras Marcas Alicorp",

                        "Ventana Pastas \n Don Victtorio",
                        "Ventana Pastas \n Lavaggi",
                        "Ventana Pastas \n Nicolini",
                        "Ventana Pastas \n Competencia",
                        "Ventana Pastas \n Otras Marcas Alicorp",

                        "Ventana Aceites \n Primor",
                        "Ventana Aceites \n Cocinero",
                        "Ventana Aceites \n Cil",
                        "Ventana Aceites \n Competencia",
                        "Ventana Aceites \n Otras Marcas Alicorp",

                        "Ventana Galletas \n Galletas Alicorp",
                        "Ventana Galletas \n Competencia",
                        "Ventana Galletas \n Otras Marcas Alicorp",

                        "Ventana Refrescos \n Frutisimos",
                        "Ventana Refrescos \n Negrita",
                        "Ventana Refrescos \n Kanu",
                        "Ventana Refrescos \n Competencia",
                        "Ventana Refrescos \n Otras Marcas Alicorp",

                        "Ventana Detergentes \n Detergente Bolivar",
                        "Ventana Detergentes \n Opal",
                        "Ventana Detergentes \n Marsella",
                        "Ventana Detergentes \n Competencia",
                        "Ventana Detergentes \n Otras Marcas Alicorp",

                        "Ventana Conservas de Atún \n Primor",
                        "Ventana Conservas de Atún \n Competencia",
                        "Ventana Conservas de Atún \n Otras Marcas Alicorp",

                        "Ventana Suavizantes \n Suavizante Bolivar",
                        "Ventana Suavizantes \n Competencia",
                        "Ventana Suavizantes \n Otras Marcas Alicorp",

                        "Ventana Quitamanchas \n Quitamancha Opal",
                        "Ventana Quitamanchas \n Competencia",
                        "Ventana Quitamanchas \n Otras Marcas Alicorp",

                        "Ventana Margarinas \n Manty",
                        "Ventana Margarinas \n Sello de Oro",
                        "Ventana Margarinas \n Competencia",
                        "Ventana Margarinas \n Otras Marcas Alicorp",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    //$sheet->getCell('B1')->setValue($datito);
                    // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->setAutoSize(true);
                    $sheet->setHeight(4, 32);
                    $sheet->setAutoFilter('A4:BG'.count($data));


                    $sheet->mergeCells('N3:P3');
                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Q3:T3');
                    $sheet->cell('Q3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                });
            }

        })->export('xls');

    }


    public function excelAlicorpRegularV3($company_id,$category_id,$desde,$hasta,$pag)
    {


        header('Access-Control-Allow-Origin: *');
        Excel::create('AlicorpRegular', function($excel) use ($company_id, $category_id,$desde,$hasta,$pag) {
            $excel->setTitle('Reporte Alicorp Regular');
            if($category_id == 53){
                if($pag == 1){
                    $excel->sheet('Categoría 53 - pag1', function($sheet) use ($category_id, $company_id,$desde,$hasta,$pag) {
                        $sqlcoord="CALL sp_alicorp_regular_v3(".$company_id.",".$category_id.",".$desde.",".$hasta.",".$pag.",". Auth::user()->id .")";
                        $stores = DB::select($sqlcoord);
                        $data = array();
                        $data = array();
                        foreach ($stores as $result) {
                            $data[] = (array)$result;
                        }
                        $headings = array(
                            "ID",
                            "RUC",
                            "NOMBRE",
                            "DIRECCION",
                            "DISTRITO",
                            "UBIGEO",
                            "CODIGO_CLIENTE",
                            "DISTRIBUIDORA",
                            "LATITUD",
                            "LONGITUD",
                            "AUDITOR",
                            "FECHA",
                            "HORA",

                            "¿Se encuentra Abierto? Si/No",
                            "Opciones",
                            "FOTO",

                            "¿Cliente permitió tomar informaciónn?",
                            "Opciones",
                            "Comentario",
                            "FOTO",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",


                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdió o lo rompi",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",
                        );

                        $sheet->prependRow(4, $headings);
                        $sheet->getCell('A1')->setValue(count($data));
                        $datito = $sheet->getCell('A1')->getValue();
                        $sheet->getCell('B1')->setValue($datito);

                        for ($i = 1; $i <= count($data); $i++) {
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AE' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AO' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AY' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('BI' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('BS' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CC' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CM' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CW' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('DG' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('DQ' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EA' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EK' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EU' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FE' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FO' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FY' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('GI' . ($i + 4))->getHyperlink()->getUrl();
                        }

                        $sheet->fromArray($data,null,'A5',false,false);
                        $sheet->row(4, function($row) {
                            $row->setFontColor('#fefffe');
                            $row->setBackground('#2196F3');
                            $row->setFontWeight('bold');
                            $row->setAlignment('center');
                            $row->setFontSize(10);
                        });

                        $columns = array(
                            "P",
                            "T",
                            "AD",
                            "ar",
                            "bf",
                            "bt",
                            "ch",
                            "cv",
                            "dj",
                            "dx",
                            "el",
                            "ez",
                        );

                        for ($i = 1; $i <= count($data); $i++) {
                            for($col = 0 ; $col < count($columns); $col++){
                                $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                                if(strlen($url_foto)>0) {
                                    $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                                    $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                                }
                            }
                        }

                        $sheet->mergeCells('U3:Ah3');
                        $sheet->cell('U3', function($cell) {
                            $cell->setValue('Ganchera Salsas');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('ai3:av3');
                        $sheet->cell('ai3', function($cell) {
                            $cell->setValue('Ganchera Frutísimos');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('aw3:bj3');
                        $sheet->cell('Aw3', function($cell) {
                            $cell->setValue('Exhibidores Margarinas');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('bk3:bx3');
                        $sheet->cell('bk3', function($cell) {
                            $cell->setValue('Posavuelto Galletas');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('by3:cl3');
                        $sheet->cell('by3', function($cell) {
                            $cell->setValue('Cubos de impulso');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('cm3:cz3');
                        $sheet->cell('cm3', function($cell) {
                            $cell->setValue('Suavizantes/quitamanchas');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('da3:dn3');
                        $sheet->cell('da3', function($cell) {
                            $cell->setValue('Portafiche Multicategoría');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('do3:eb3');
                        $sheet->cell('do3', function($cell) {
                            $cell->setValue('Exhibidor Atún Primor (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('ec3:ep3');
                        $sheet->cell('ec3', function($cell) {
                            $cell->setValue('Exhibidor Bolsas Don Vittorio (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('eq3:fd3');
                        $sheet->cell('eq3', function($cell) {
                            $cell->setValue('Exhibidor Frutísimos (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                    });
                } else if($pag == 2) {
                    $excel->sheet('Categoría 53 - pag2', function($sheet) use ($category_id, $company_id,$desde,$hasta,$pag) {
                        $sqlcoord="CALL sp_alicorp_regular_v3(".$company_id.",".$category_id.",".$desde.",".$hasta.",".$pag.",". Auth::user()->id .")";
                        $stores = DB::select($sqlcoord);
                        $data = array();
                        $data = array();
                        foreach ($stores as $result) {
                            $data[] = (array)$result;
                        }
                        $headings = array(
                            "ID",
                            "RUC",
                            "NOMBRE",
                            "DIRECCION",
                            "DISTRITO",
                            "UBIGEO",
                            "CODIGO_CLIENTE",
                            "DISTRIBUIDORA",
                            "LATITUD",
                            "LONGITUD",
                            "AUDITOR",
                            "FECHA",
                            "HORA",

                            "¿Se encuentra Abierto? Si/No",
                            "Opciones",
                            "FOTO",

                            "¿Cliente permitió tomar informaciónn?",
                            "Opciones",
                            "Comentario",
                            "FOTO",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                            "¿ Se encontro exhibidor ?",
                            "Aún no lo colocaron",
                            "Cliente lo retiró",
                            "Cliente lo perdio o lo rompio",
                            "Cliente nunca lo aceptó",
                            "Otros",
                            "Comentario",
                            "¿Es visible?",
                            "¿Está Contaminado?",
                            "Foto",
                            "¿ Exhibidor Alicorp tiene carga ?",
                            "20%",
                            "50%",
                            "100%",

                        );

                        $sheet->prependRow(4, $headings);
                        $sheet->getCell('A1')->setValue(count($data));
                        $datito = $sheet->getCell('A1')->getValue();
                        $sheet->getCell('B1')->setValue($datito);

                        for ($i = 1; $i <= count($data); $i++) {
                            $sheet->getCell('Q' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('U' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AE' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AO' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('AY' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('BI' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('BS' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CC' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CM' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('CW' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('DG' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('DQ' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EA' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EK' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('EU' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FE' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FO' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('FY' . ($i + 4))->getHyperlink()->getUrl();
                            $sheet->getCell('GI' . ($i + 4))->getHyperlink()->getUrl();
                        }

                        $sheet->fromArray($data,null,'A5',false,false);
                        $sheet->row(4, function($row) {
                            $row->setFontColor('#fefffe');
                            $row->setBackground('#2196F3');
                            $row->setFontWeight('bold');
                            $row->setAlignment('center');
                            $row->setFontSize(10);
                        });

                        $columns = array(
                            "P",
                            "T",
                            "AD",
                            "ar",
                            "bf",
                            "bt",
                            "ch",
                            "cv",
                            "dj",
                        );

                        for ($i = 1; $i <= count($data); $i++) {
                            for($col = 0 ; $col < count($columns); $col++){
                                $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                                if(strlen($url_foto)>0) {
                                    $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                                    $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                                }
                            }
                        }

                        $sheet->mergeCells('U3:Ah3');
                        $sheet->cell('U3', function($cell) {
                            $cell->setValue('Exhibidor Margarinas (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('ai3:av3');
                        $sheet->cell('ai3', function($cell) {
                            $cell->setValue('Ganchera Salsas (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('aw3:bj3');
                        $sheet->cell('Aw3', function($cell) {
                            $cell->setValue('Ganchera Suavizantes y Quitamanchas (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                        $sheet->mergeCells('bk3:bx3');
                        $sheet->cell('bk3', function($cell) {
                            $cell->setValue('Mandil Don Vittorio (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('by3:cl3');
                        $sheet->cell('by3', function($cell) {
                            $cell->setValue('Mandil Detergente Bolivar (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('cm3:cz3');
                        $sheet->cell('cm3', function($cell) {
                            $cell->setValue('Paleta de precios Aceites Primor (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });

                        $sheet->mergeCells('da3:dn3');
                        $sheet->cell('da3', function($cell) {
                            $cell->setValue('Paleta de precios Detergente Bolivar (Mercados)');
                            $cell->setBackground('#0e5a97');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            // Set all borders (top, right, bottom, left)
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                    });
                }


            } else if($category_id == 54) {
                $excel->sheet('Categoría 54', function($sheet) use ($category_id, $company_id,$desde,$hasta) {
                    $sqlcoord="CALL sp_alicorp_regular_v3(".$company_id.",".$category_id.",".$desde.",".$hasta.",0,". Auth::user()->id .")";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",
                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    $sheet->fromArray($data,null,'A5',false,false);
                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                    });

                    $sheet->setAutoFilter('A4:AS'.count($data));
                    for ($i = 1; $i <= count($data); $i++) {
                        $url_foto =trim($sheet->getCell('P' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('P' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('P' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('Y' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('Y' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('Y' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                        $url_foto =trim($sheet->getCell('AD' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AD' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AD' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AI' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AI' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AI' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AN' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AN' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AN' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('AS' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AS' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AS' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }


                        $url_foto =trim($sheet->getCell('AX' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('AX' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('AX' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BC' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BC' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BC' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BH' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BH' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BH' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BM' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BM' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BM' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }

                        $url_foto =trim($sheet->getCell('BR' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('BR' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('BR' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->mergeCells('N3:P3');
                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Q3:T3');
                    $sheet->cell('Q3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('U3:Y3');
                    $sheet->cell('U3', function($cell) {
                        $cell->setValue('Ventana Salsas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Z3:AD3');
                    $sheet->cell('Z3', function($cell) {
                        $cell->setValue('Ventana Pastas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AE3:AI3');
                    $sheet->cell('AE3', function($cell) {
                        $cell->setValue('Ventana Aceites');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AJ3:AN3');
                    $sheet->cell('AJ3', function($cell) {
                        $cell->setValue('Ventana Galletas');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                    $sheet->mergeCells('AO3:AS3');
                    $sheet->cell('AO3', function($cell) {
                        $cell->setValue(' Ventana Refrescos');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                    $sheet->mergeCells('AT3:AX3');
                    $sheet->cell('AT3', function($cell) {
                        $cell->setValue('Ventana Detergentes');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('AY3:BC3');
                    $sheet->cell('AY3', function($cell) {
                        $cell->setValue('Ventana Conservas de Atún');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BD3:BH3');
                    $sheet->cell('BD3', function($cell) {
                        $cell->setValue('Ventana Suavizantes Bolivar');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BI3:BM3');
                    $sheet->cell('BI3', function($cell) {
                        $cell->setValue('Ventana Quitamanchas Opal');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('BN3:BR3');
                    $sheet->cell('BN3', function($cell) {
                        $cell->setValue('Ventana Margarinas (Manty o Sello de Oro)');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                });

            } else if($category_id == 58) {
                $excel->sheet('Sod por Marca', function($sheet) use ($company_id,$desde,$hasta) {
                    $sqlcoord="CALL ttaudit_auditors.sp_alicorp_regular_sod_v3(".$company_id.",".$desde.",".$hasta.",". Auth::user()->id .")";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "Respuesta",
                        "Opciones",
                        "Foto",
                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "Ventana Salsas \n Alacena",
                        "Ventana Salsas \n Competencia",
                        "Ventana Salsas \n Otras Marcas Alicorp",

                        "Ventana Pastas \n Don Victtorio",
                        "Ventana Pastas \n Lavaggi",
                        "Ventana Pastas \n Nicolini",
                        "Ventana Pastas \n Competencia",
                        "Ventana Pastas \n Otras Marcas Alicorp",

                        "Ventana Aceites \n Primor",
                        "Ventana Aceites \n Cocinero",
                        "Ventana Aceites \n Cil",
                        "Ventana Aceites \n Competencia",
                        "Ventana Aceites \n Otras Marcas Alicorp",

                        "Ventana Galletas \n Galletas Alicorp",
                        "Ventana Galletas \n Competencia",
                        "Ventana Galletas \n Otras Marcas Alicorp",

                        "Ventana Refrescos \n Frutisimos",
                        "Ventana Refrescos \n Negrita",
                        "Ventana Refrescos \n Kanu",
                        "Ventana Refrescos \n Competencia",
                        "Ventana Refrescos \n Otras Marcas Alicorp",

                        "Ventana Detergentes \n Detergente Bolivar",
                        "Ventana Detergentes \n Opal",
                        "Ventana Detergentes \n Marsella",
                        "Ventana Detergentes \n Competencia",
                        "Ventana Detergentes \n Otras Marcas Alicorp",

                        "Ventana Conservas de Atún \n Primor",
                        "Ventana Conservas de Atún \n Competencia",
                        "Ventana Conservas de Atún \n Otras Marcas Alicorp",

                        "Ventana Suavizantes \n Suavizante Bolivar",
                        "Ventana Suavizantes \n Competencia",
                        "Ventana Suavizantes \n Otras Marcas Alicorp",

                        "Ventana Quitamanchas \n Quitamancha Opal",
                        "Ventana Quitamanchas \n Competencia",
                        "Ventana Quitamanchas \n Otras Marcas Alicorp",

                        "Ventana Margarinas \n Manty",
                        "Ventana Margarinas \n Sello de Oro",
                        "Ventana Margarinas \n Competencia",
                        "Ventana Margarinas \n Otras Marcas Alicorp",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    //$sheet->getCell('B1')->setValue($datito);
                    // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->setAutoSize(true);
                    $sheet->setHeight(4, 32);
                    $sheet->setAutoFilter('A4:BG'.count($data));


                    $sheet->mergeCells('N3:P3');
                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Q3:T3');
                    $sheet->cell('Q3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                });
            }

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularV4($company_id,$type_bodega,$category_id,$parte)
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . '-'. $category_id . " - ". $type_bodega, function($excel) use ($company_id,$type_bodega, $category_id,$parte) {
            $excel->setTitle('Reporte Alicorp Regular V4');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte) {
                    $sqlcoord="CALL sp_alicorp_regular_v4(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte . ")";
//                    $sqlcoord="CALL sp_alicorp_regular_v4(".$company_id.",'". $type_bodega . "',".$category_id.",5,". $parte . ")";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }

                    if($category_id == 53){
                        if($type_bodega ==  'Bodega'){

                            if ($parte == 1) {

                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCION",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "¿Se encuentra Abierto? Si/No",
                                    "Opciones",
                                    "FOTO",

                                    "¿Cliente permitió tomar informaciónn?",
                                    "Opciones",
                                    "Comentario",
                                    "FOTO",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdio o lo rompio",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%"



                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "AD",
                                    "ar",
                                    "bf",
                                    "bt",
                                    "ch",
                                    "cv",
                                    "dj"

                                );
                                $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                                $setFormatCell =  array("U3","ai3","aw3","bk3");
                                $setTextCell =  array(
                                    "Ganchera Salsas",
                                    "Ganchera Frutísimos",
                                    "Exhibidores Margarinas",
                                    "Posavuelto Galletas"
                                    );

                            } else if ($parte == 2) {

                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCION",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "¿Se encuentra Abierto? Si/No",
                                    "Opciones",
                                    "FOTO",

                                    "¿Cliente permitió tomar informaciónn?",
                                    "Opciones",
                                    "Comentario",
                                    "FOTO",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdio o lo rompio",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%"



                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "AD",
                                    "ar",
                                    "bf",
                                    "bt",
                                    "ch",
                                    "cv"

                                );
                                $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3");
                                $setFormatCell =  array("U3","ai3","aw3");
                                $setTextCell =  array(
                                    "Cubos de impulso",
                                    "Suavizantes/quitamanchas",
                                    "Portafiche Multicategoría");
                            }

                        }else if($type_bodega ==  'Puesto de Mercado'){

                            if ($parte == 1) {
                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCION",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "¿Se encuentra Abierto? Si/No",
                                    "Opciones",
                                    "FOTO",

                                    "¿Cliente permitió tomar informaciónn?",
                                    "Opciones",
                                    "Comentario",
                                    "FOTO",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdio o lo rompio",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "AD",
                                    "ar",
                                    "bf",
                                    "bt",
                                    "ch"

                                );
                                $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                                $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                                $setTextCell =  array(
                                    "Exhibidor Atún Primor (Mercados)",
                                    "Exhibidor Bolsas Don Vittorio (Mercados)",
                                    "Exhibidor Frutísimos (Mercados)",
                                    "Exhibidor Margarinas (Mercados)",
                                    "Ganchera Salsas (Mercados)",

                                );
                            }  else if ($parte == 2) {
                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCION",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "¿Se encuentra Abierto? Si/No",
                                    "Opciones",
                                    "FOTO",

                                    "¿Cliente permitió tomar informaciónn?",
                                    "Opciones",
                                    "Comentario",
                                    "FOTO",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdio o lo rompio",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%",

                                    "¿ Se encontro exhibidor ?",
                                    "Aún no lo colocaron",
                                    "Cliente lo retiró",
                                    "Cliente lo perdió o lo rompi",
                                    "Cliente nunca lo aceptó",
                                    "Otros",
                                    "Comentario",
                                    "¿Es visible?",
                                    "¿Está Contaminado?",
                                    "Foto",
                                    "¿ Exhibidor Alicorp tiene carga ?",
                                    "20%",
                                    "50%",
                                    "100%"


                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "AD",
                                    "ar",
                                    "bf",
                                    "bt",
                                    "ch",
                                    "cv",
                                    "dj",
                                    "dx",
                                    "el",
                                    "ez",
                                );
                                $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                                $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                                $setTextCell =  array(
                                    "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                    "Mandil Don Vittorio (Mercados)",
                                    "Mandil Detergente Bolivar (Mercados)",
                                    "Paleta de precios Aceites Primor (Mercados)",
                                    "Paleta de precios Detergente Bolivar (Mercados)"
                                );
                            }

                        }
                    } else if ($category_id == 54 ) {


                        if($type_bodega ==  'Bodega'){

                            if ($parte == 1) {
                                $headings = array(

                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCIÓN",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "Respuesta",
                                    "Opciones",
                                    "Foto",
                                    "Respuesta",
                                    "Opciones",
                                    "Comentario",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto"
                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "Y",
                                    "AD",
                                    "AI",
                                    "AN",
                                    "AS"

                                );
                                $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3");
                                $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3");
                                $setTextCell =  array(
                                    "Se encuentra Abierto el punto?",
                                    "¿Cliente permitió tomar información?",
                                    "Ventana Salsas",
                                    "Ventana Pastas",
                                    "Ventana Aceites",
                                    "Ventana Galletas",
                                    "Ventana Refrescos",
                                    "Ventana Detergentes",
                                    "Ventana Conservas de Atún");

                            } else if ($parte == 2) {
                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCIÓN",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "Respuesta",
                                    "Opciones",
                                    "Foto",
                                    "Respuesta",
                                    "Opciones",
                                    "Comentario",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "Y",
                                    "AD",

                                );
                                $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3");
                                $setFormatCell =  array("N3","Q3","U3","Z3");
                                $setTextCell =  array(
                                    "Se encuentra Abierto el punto?",
                                    "¿Cliente permitió tomar información?",
                                    "Ventana Detergentes",
                                    "Ventana Conservas de Atún");
                            }


                        }else if($type_bodega ==  'Puesto de Mercado'){
                            if ($parte == 1) {
                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCIÓN",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "Respuesta",
                                    "Opciones",
                                    "Foto",
                                    "Respuesta",
                                    "Opciones",
                                    "Comentario",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "y",
                                    "AD",
                                    "ai",
                                    "an",
                                    "as"

                                );
                                $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                                $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                                $setTextCell =  array(

                                    "Se encuentra Abierto el punto?",
                                    "¿Cliente permitió tomar información?",
                                    "Ventana Salsa (Mercados)",
                                    "Ventana Pastas(Mercados)",
                                    "Ventana Aceites (Mercados)",
                                    "Ventana Galletas (Mercados)",
                                    "Ventana Refrescos (Mercados)",
                                );
                            }else if ($parte == 2) {
                                $headings = array(
                                    "ID",
                                    "RUC",
                                    "NOMBRE",
                                    "DIRECCIÓN",
                                    "DISTRITO",
                                    "UBIGEO",
                                    "CODIGO_CLIENTE",
                                    "DISTRIBUIDORA",
                                    "LATITUD",
                                    "LONGITUD",
                                    "AUDITOR",
                                    "FECHA",
                                    "HORA",

                                    "Respuesta",
                                    "Opciones",
                                    "Foto",
                                    "Respuesta",
                                    "Opciones",
                                    "Comentario",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",

                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                    "¿Existe Ventana?",
                                    "¿Es visible?",
                                    "¿Como se encuentra la Ventana?",
                                    "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                    "Foto",


                                );
                                $columnsFoto = array(
                                    "P",
                                    "T",
                                    "y",
                                    "AD",
                                    "ai",
                                    "an",
                                    "as"

                                );
                                $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                                $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                                $setTextCell =  array(

                                    "Se encuentra Abierto el punto?",
                                    "¿Cliente permitió tomar información?",
                                    "Ventana Detergente (Mercados)",
                                    "Ventana Atún (Mercados)",
                                    "Ventana Suavizante (Mercados)",
                                    "Ventana Quitamancha(Mercados)",
                                    "Ventana Margarina (Mercados)"
                                );
                            }

                        }
                    }




                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    $sheet->getCell('B1')->setValue($datito);

                    $sheet->fromArray($data,null,'A5',false,false);
                    $sheet->row(4, function($row) {
                        $row->setFontColor('#fefffe');
                        $row->setBackground('#2196F3');
                        $row->setFontWeight('bold');
                        $row->setAlignment('center');
                        $row->setFontSize(10);
                    });

                    for ($i = 1; $i <= count($data); $i++) {
                        for($col = 0 ; $col < count($columnsFoto); $col++){
                            $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                            if(strlen($url_foto)>0) {
                                $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                                $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                            }
                        }
                    }


                    for($i = 0 ; $i < count($setFormatCell); $i++){
                        $sheet->mergeCells($setMargenCell[$i]);
                        $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                        $sheet->cell($setMargenCell[$i], function($cell)  {
                            $cell->setBackground('#FF0000');
                            $cell->setAlignment('center');
                            $cell->setFontColor('#fefffe');
                            $cell->setBorder('solid', 'none', 'none', 'solid');
                        });
                    }


                });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function excelAlicorpRegularV5($company_id,$type_bodega,$category_id,$parte)
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . '-'. $category_id . " - ". $type_bodega, function($excel) use ($company_id,$type_bodega, $category_id,$parte) {
            $excel->setTitle('Reporte Alicorp Regular V5');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte) {
                $sqlcoord="CALL sp_alicorp_regular_v5(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte . ")";
//                    $sqlcoord="CALL sp_alicorp_regular_v4(".$company_id.",'". $type_bodega . "',".$category_id.",5,". $parte . ")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría",
                                "Exhibidor de Atún",
                                "Exhibidor de Marsella"
                            );
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3");
                            $setFormatCell =  array("U3","ai3");
                            $setTextCell =  array(
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",

                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún");

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Ventana Marsella(Lava vajillas)");
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)"
                            );
                        }

                    }
                }




                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function excelAlicorpRegularV6($company_id,$type_bodega,$category_id,$parte,$desde,$hasta)
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . '-'. $category_id . " - ". $type_bodega."-".$parte."-".$desde."-".$hasta, function($excel) use ($company_id,$type_bodega, $category_id,$parte,$desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular V6');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte,$desde,$hasta) {
                $sqlcoord="CALL sp_alicorp_regular_v6(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte .",". $desde .",". $hasta . ")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3");
                            $setFormatCell =  array("U3","ai3","aw3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría");
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3");
                            $setFormatCell =  array("U3","ai3");
                            $setTextCell =  array(
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",

                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún");

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3");
                            $setFormatCell =  array("N3","Q3","U3","Z3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún");
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)"
                            );
                        }

                    }
                }




                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularSodV4($company_id,$desde,$hasta)
    {


        header('Access-Control-Allow-Origin: *');
        Excel::create('AlicorpRegular SOD', function($excel) use ($company_id, $desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular SOD');

                $excel->sheet('Sod por Marca', function($sheet) use ($company_id,$desde,$hasta) {
                    $sqlcoord="CALL sp_alicorp_regular_sod_v4(".$company_id.",".$desde.",".$hasta.",". Auth::user()->id .")";
                    $stores = DB::select($sqlcoord);
                    $data = array();
                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCIÓN",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "Respuesta",
                        "Opciones",
                        "Foto",

                        "Respuesta",
                        "Opciones",
                        "Comentario",
                        "Foto",

                        "Ventana Salsas \n Alacena",
                        "Ventana Salsas \n Competencia",
                        "Ventana Salsas \n Otras Marcas Alicorp",
                        "Ventana Salsas \n Nicolini",
                        "Ventana Salsas \n Walibi",
                        "Ventana Salsas \n Libbys",

                        "Ventana Pastas \n Don Victtorio",
                        "Ventana Pastas \n Lavaggi",
                        "Ventana Pastas \n Nicolini",
                        "Ventana Pastas \n Competencia",
                        "Ventana Pastas \n Otras Marcas Alicorp",

                        "Ventana Aceites \n Primor",
                        "Ventana Aceites \n Cocinero",
                        "Ventana Aceites \n Cil",
                        "Ventana Aceites \n Competencia",
                        "Ventana Aceites \n Otras Marcas Alicorp",

                        "Ventana Galletas \n Galletas Alicorp",
                        "Ventana Galletas \n Competencia",
                        "Ventana Galletas \n Otras Marcas Alicorp",

                        "Ventana Refrescos \n Frutisimos",
                        "Ventana Refrescos \n Negrita",
                        "Ventana Refrescos \n Kanu",
                        "Ventana Refrescos \n Competencia",
                        "Ventana Refrescos \n Otras Marcas Alicorp",

                        "Ventana Detergentes \n Detergente Bolivar",
                        "Ventana Detergentes \n Opal",
                        "Ventana Detergentes \n Marsella",
                        "Ventana Detergentes \n Competencia",
                        "Ventana Detergentes \n Otras Marcas Alicorp",

                        "Ventana Conservas de Atún \n Primor",
                        "Ventana Conservas de Atún \n Competencia",
                        "Ventana Conservas de Atún \n Otras Marcas Alicorp",
                        "Ventana Conservas de Atún \n Atún Nicolini",
                        "Ventana Conservas de Atún \n Campomar",
                        "Ventana Conservas de Atún \n Florida",

                        "Ventana Suavizantes \n Suavizante Bolivar",
                        "Ventana Suavizantes \n Competencia",
                        "Ventana Suavizantes \n Otras Marcas Alicorp",

                        "Ventana Quitamanchas \n Quitamancha Opal",
                        "Ventana Quitamanchas \n Competencia",
                        "Ventana Quitamanchas \n Otras Marcas Alicorp",

                        "Ventana Margarinas \n Manty",
                        "Ventana Margarinas \n Sello de Oro",
                        "Ventana Margarinas \n Competencia",
                        "Ventana Margarinas \n Otras Marcas Alicorp",


                        "Ventana Marsella \n Lavavajilla Alicorp",
                        "Ventana Marsella  \n Competencia",
                        "Ventana Marsella  \n Otras Marcas Lavavajillas",

                    );

                    $sheet->prependRow(4, $headings);
                    $sheet->getCell('A1')->setValue(count($data));
                    $datito = $sheet->getCell('A1')->getValue();
                    //$sheet->getCell('B1')->setValue($datito);
                    // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                        $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                            $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                        }
                    }

                    $sheet->setAutoSize(true);
                    $sheet->setHeight(4, 32);
                    $sheet->setAutoFilter('A4:BJ'.count($data));


                    $sheet->mergeCells('N3:P3');
                    $sheet->cell('N3', function($cell) {
                        $cell->setValue('Se encuentra Abierto el punto?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });

                    $sheet->mergeCells('Q3:T3');
                    $sheet->cell('Q3', function($cell) {
                        $cell->setValue('¿Cliente permitió tomar información?');
                        $cell->setBackground('#0e5a97');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        // Set all borders (top, right, bottom, left)
                        $cell->setBorder('thin','thin','thin','thin');
                    });


                });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularSodV5($company_id,$desde,$hasta)
    {


        header('Access-Control-Allow-Origin: *');
        Excel::create('AlicorpR SOD-' . $company_id, function($excel) use ($company_id, $desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular SOD');

            $excel->sheet('Sod por Marca', function($sheet) use ($company_id,$desde,$hasta) {
                $sqlcoord="CALL sp_alicorp_regular_sod_v5(".$company_id.",".$desde.",".$hasta.",". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "UBIGEO",
                    "CODIGO_CLIENTE",
                    "DISTRIBUIDORA",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Respuesta",
                    "Opciones",
                    "Foto",

                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",

                    "Ventana Salsas \n Alacena",
                    "Ventana Salsas \n Competencia",
                    "Ventana Salsas \n Otras Marcas Alicorp",
                    "Ventana Salsas \n Nicolini",
                    "Ventana Salsas \n Walibi",
                    "Ventana Salsas \n Libbys",

                    "Ventana Pastas \n Don Victtorio",
                    "Ventana Pastas \n Lavaggi",
                    "Ventana Pastas \n Nicolini",
                    "Ventana Pastas \n Competencia",
                    "Ventana Pastas \n Otras Marcas Alicorp",

                    "Ventana Aceites \n Primor",
                    "Ventana Aceites \n Cocinero",
                    "Ventana Aceites \n Cil",
                    "Ventana Aceites \n Competencia",
                    "Ventana Aceites \n Otras Marcas Alicorp",

                    "Ventana Galletas \n Galletas Alicorp",
                    "Ventana Galletas \n Competencia",
                    "Ventana Galletas \n Otras Marcas Alicorp",

                    "Ventana Refrescos \n Frutisimos",
                    "Ventana Refrescos \n Negrita",
                    "Ventana Refrescos \n Kanu",
                    "Ventana Refrescos \n Competencia",
                    "Ventana Refrescos \n Otras Marcas Alicorp",

                    "Ventana Detergentes \n Detergente Bolivar",
                    "Ventana Detergentes \n Opal",
                    "Ventana Detergentes \n Marsella",
                    "Ventana Detergentes \n Competencia",
                    "Ventana Detergentes \n Otras Marcas Alicorp",



                    "Ventana Suavizantes \n Suavizante Bolivar",
                    "Ventana Suavizantes \n Competencia",
                    "Ventana Suavizantes \n Otras Marcas Alicorp",

                    "Ventana Quitamanchas \n Quitamancha Opal",
                    "Ventana Quitamanchas \n Competencia",
                    "Ventana Quitamanchas \n Otras Marcas Alicorp",

                    "Ventana Margarinas \n Manty",
                    "Ventana Margarinas \n Sello de Oro",
                    "Ventana Margarinas \n Competencia",
                    "Ventana Margarinas \n Otras Marcas Alicorp",


                    "Ventana Marsella \n Lavavajilla Alicorp",
                    "Ventana Marsella  \n Competencia",
                    "Ventana Marsella  \n Otras Marcas Lavavajillas",


                    "    Pomarola",
                    "    B&D",
                    "    Molitalia",
                    "    Don Maximo",
                    "    Sao",
                    "    Ideal",
                    "Ventana Refrescos \n Zuko",
                    "Ventana Refrescos \n Umsha",



                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                //$sheet->getCell('B1')->setValue($datito);
                // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 32);
                $sheet->setAutoFilter('A4:BJ'.count($data));


                $sheet->mergeCells('N3:P3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue('Se encuentra Abierto el punto?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('Q3:T3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularSodV5_3($company_id,$desde,$hasta)
    {


        header('Access-Control-Allow-Origin: *');
        Excel::create('AlicorpR SOD-' . $company_id, function($excel) use ($company_id, $desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular SOD');

            $excel->sheet('Sod por Marca', function($sheet) use ($company_id,$desde,$hasta) {
                $sqlcoord="CALL sp_alicorp_regular_sod_v5_3(".$company_id.",".$desde.",".$hasta.",". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "UBIGEO",
                    "CODIGO_CLIENTE",
                    "DISTRIBUIDORA",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Respuesta",
                    "Opciones",
                    "Foto",

                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",

                    "Ventana Salsas \n Alacena",
                    "Ventana Salsas \n Competencia Salsas frías",
                    "Ventana Salsas \n Otras Marcas Alicorp salsas frias",
                    "Ventana Salsas \n Nicolini Salsas Frías",
                    "Ventana Salsas \n Walibi",
                    "Ventana Salsas \n Libbys",

                    "Ventana Pastas \n Don Victtorio",
                    "Ventana Pastas \n Lavaggi",
                    "Ventana Pastas \n Nicolini",
                    "Ventana Pastas \n Competencia",
                    "Ventana Pastas \n Otras Marcas Alicorp",

                    "Ventana Aceites \n Primor",
                    "Ventana Aceites \n Cocinero",
                    "Ventana Aceites \n Cil",
                    "Ventana Aceites \n Competencia",
                    "Ventana Aceites \n Otras Marcas Alicorp",

                    "Ventana Galletas \n Galletas Alicorp",
                    "Ventana Galletas \n Competencia",
                    "Ventana Galletas \n Otras Marcas Alicorp",

                    "Ventana Refrescos \n Frutisimos",
                    "Ventana Refrescos \n Negrita",
                    "Ventana Refrescos \n Kanu",
                    "Ventana Refrescos \n Competencia",
                    "Ventana Refrescos \n Otras Marcas Alicorp",

                    "Ventana Detergentes \n Detergente Bolivar",
                    "Ventana Detergentes \n Opal",
                    "Ventana Detergentes \n Marsella",
                    "Ventana Detergentes \n Competencia",
                    "Ventana Detergentes \n Otras Marcas Alicorp",



                    "Ventana Suavizantes \n Suavizante Bolivar",
                    "Ventana Suavizantes \n Competencia",
                    "Ventana Suavizantes \n Otras Marcas Alicorp",

                    "Ventana Quitamanchas \n Quitamancha Opal",
                    "Ventana Quitamanchas \n Competencia",
                    "Ventana Quitamanchas \n Otras Marcas Alicorp",

                    "Ventana Margarinas \n Manty",
                    "Ventana Margarinas \n Sello de Oro",
                    "Ventana Margarinas \n Competencia",
                    "Ventana Margarinas \n Otras Marcas Alicorp",


                    "Ventana Marsella \n Lavavajilla Alicorp",
                    "Ventana Marsella  \n Competencia",
                    "Ventana Marsella  \n Otras Marcas Lavavajillas",


                    "    Pomarola",
                    "    B&D",
                    "    Molitalia",
                    "    Don Maximo",
                    "    Sao",
                    "    Ideal",
                    "Ventana Refrescos \n Zuko",
                    "Ventana Refrescos \n Umsha",

                    "Ventana Salsas \n Pomarola",
                    "Ventana Salsas \n B&D",
                    "Ventana Salsas \n Don Victorio",
                    "Ventana Salsas \n Nicolini Salsas Calientes",
                    "Ventana Salsas \n Otras marcas Alicorp Salsas Calientes",
                    "Ventana Salsas \n Competencia Salsas Calientes",



                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                //$sheet->getCell('B1')->setValue($datito);
                // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 32);
                $sheet->setAutoFilter('A4:BJ'.count($data));


                $sheet->mergeCells('N3:P3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue('Se encuentra Abierto el punto?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('Q3:T3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function excelAlicorpRegularSodV5_2($company_id,$desde,$hasta)
    {


        header('Access-Control-Allow-Origin: *');
        Excel::create('AlicorpR SOD-' . $company_id, function($excel) use ($company_id, $desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular SOD');

            $excel->sheet('Sod por Marca', function($sheet) use ($company_id,$desde,$hasta) {
                $sqlcoord="CALL sp_alicorp_regular_sod_v5_2(".$company_id.",".$desde.",".$hasta.",". Auth::user()->id .")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }
                $headings = array(
                    "ID",
                    "RUC",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "UBIGEO",
                    "CODIGO_CLIENTE",
                    "DISTRIBUIDORA",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Respuesta",
                    "Opciones",
                    "Foto",

                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",




                 "Ventana Galletas \n Oreo",
                 "Ventana Galletas  \n Field",
                 "Ventana Galletas  \n Molitalia",
                 "Ventana Galletas  \n Morochas",
                 "Ventana Galletas  \n San Jorge",

                "Ventana Margarinas \n Gloria",
                "Ventana Margarinas  \n Laive",

                    "Cuidado de la Piel \n Jabones Aval Barra",
                    "Cuidado de la Piel  \n Jabones Aval Liquido",
                    "Cuidado de la Piel \n Protex",
                    "Cuidado de la Piel  \n otras marcas",


                    "Pasta Dental \n Dento",
                    "Pasta Dental  \n Colgate",
                    "Pasta Dental \n otras marcas",

                    "Ventana Conservas de Atún \n Primor",
                    "Ventana Conservas de Atún \n Competencia",
                    "Ventana Conservas de Atún \n Otras Marcas Alicorp",
                    "Ventana Conservas de Atún \n Atún Nicolini",
                    "Ventana Conservas de Atún \n Campomar",
                    "Ventana Conservas de Atún \n Florida",
                    "Ventana Conservas de Atún \n Real",
                    "Ventana Conservas de Atún \n A1",
                    "Ventana Conservas de Atún \n Gloria",
                    "Ventana Conservas de Atún \n Fanny",

                    "Lava vajillas \n Competencia",
                    "Lava vajillas \n Lesly",
                    "Lava vajillas \n Clorandina",
                    "Lava vajillas \n Ayudin",
                    "Lava vajillas \n Marsella",
                    "Lava vajillas \n Marcas sapoolio",

                    "Lejias \n Competencia",
                    "Lejias \n Marcas Sapolio",
                    "Lejias \n Clorox",

                    "Limpiadores Light Duty \n Competencia",
                    "Limpiadores Light Duty \n Marcas Sapolio",
                    "Limpiadores Light Duty \n Pinesol",
                    "Limpiadores Light Duty \n Poet",

                );

                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                //$sheet->getCell('B1')->setValue($datito);
                // $sheet->getCell('c1')->setValue("Buen dat \n todo OK");

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
                    $url_foto =trim($sheet->getCell('T' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('T' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('T' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                }

                $sheet->setAutoSize(true);
                $sheet->setHeight(4, 32);
                $sheet->setAutoFilter('A4:BJ'.count($data));


                $sheet->mergeCells('N3:P3');
                $sheet->cell('N3', function($cell) {
                    $cell->setValue('Se encuentra Abierto el punto?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('Q3:T3');
                $sheet->cell('Q3', function($cell) {
                    $cell->setValue('¿Cliente permitió tomar información?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    /**
     *Excel Alicorp Pre Venta
     */
    public function campaigneAlicorpPreVenta()
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp Pre Venta Julio 86', function($excel) {
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
                    "Cuanto se Facturo en el cliente",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Respuesta",
                    "Comentario",
                    "Foto Marcador Precio",
                    "Foto Material POP adicional",
                    "Comentario adicional del cliente"
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
                    $row->setBorder('thin','thin','thin','thin');
                });
                for ($i = 1; $i <= count($data); $i++) {

                    $url_foto =trim($sheet->getCell('O' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('O' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('O' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AW' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AW' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AW' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                    $url_foto =trim($sheet->getCell('AV' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('AV' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('AV' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

//                    $sheet->getCell('O' . ($i + 4))
//                    ->getHyperlink()
//                    ->setUrl($sheet->getCell('O' . ($i + 4))->getValue())
//                    ->setTooltip('Abrir imagen');
//                    $sheet->getCell('AV' . ($i + 4))
//                        ->getHyperlink()
//                        ->setUrl($sheet->getCell('AV' . ($i + 4))->getValue())
//                        ->setTooltip('Abrir imagen');
//                    $sheet->getCell('AW' . ($i + 4))
//                        ->getHyperlink()
//                        ->setUrl($sheet->getCell('AW' . ($i + 4))->getValue())
//                        ->setTooltip('Abrir imagen');
                }
                $sheet->setAutoFilter('A4:AX'.count($data));
                $sheet->mergeCells('L3:O3');

                $sheet->cell('L3', function($cell) {
                    $cell->setValue('¿ Se encuentra abierto local ?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('thin','thin','thin','thin');
                });
                $sheet->mergeCells('P3:T3');
                $sheet->cell('P3', function($cell) {
                    $cell->setValue('¿ Cuanto Volumen se coloco en el cliente ?');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('P3:T3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });


                $sheet->mergeCells('V3:W3');
                $sheet->cell('V3', function($cell) {
                    $cell->setValue('Jose Antonio largos 500 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('V3:W3', function($cells) {
                    $cells->setBorder('thin','thin','thin','thin');
                });

                $sheet->mergeCells('X3:Y3');
                $sheet->cell('X3', function($cell) {
                    $cell->setValue('Jose Antonio cortos 250 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('X3:Y3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('Z3:AA3');
                $sheet->cell('Z3', function($cell) {
                    $cell->setValue('Don Camilo largos 500 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('Z3:AA3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AB3:AC3');
                $sheet->cell('AB3', function($cell) {
                    $cell->setValue('Don Camilo cortos 250 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AB3:AC3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });


                $sheet->mergeCells('AD3:AE3');
                $sheet->cell('AD3', function($cell) {
                    $cell->setValue('Benotti largos 500 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AD3:AE3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AF3:AG3');
                $sheet->cell('AF3', function($cell) {
                    $cell->setValue('Benotti cortos 250 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AF3:AG3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AH3:AI3');
                $sheet->cell('AH3', function($cell) {
                    $cell->setValue('D’Primera largos 500 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AH3:AI3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AJ3:AK3');
                $sheet->cell('AJ3', function($cell) {
                    $cell->setValue('D’Primera cortos 250 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AJ3:AK3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AL3:AM3');
                $sheet->cell('AL3', function($cell) {
                    $cell->setValue('Sapolio amarillo deterg bolsa 150 gr');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AL3:AM3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AN3:AO3');
                $sheet->cell('AN3', function($cell) {
                    $cell->setValue('Tondero aceite bot 1 lt');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AN3:AO3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AP3:AQ3');
                $sheet->cell('AP3', function($cell) {
                    $cell->setValue('Deleite aceite bot 1 lt');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AP3:AQ3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AR3:AS3');
                $sheet->cell('AR3', function($cell) {
                    $cell->setValue('La Patrona aceite bot 1 lt');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AR3:AS3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

                $sheet->mergeCells('AT3:AU3');
                $sheet->cell('AT3', function($cell) {
                    $cell->setValue('Don Sabor aceite bot 1 lt');
                    $cell->setFontColor('#fefffe');
                    $cell->setAlignment('center');
                    $cell->setBackground('#0e5a97');
                });
                $sheet->cells('AT3:AU3', function($cells) {
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                });

//                $sheet->getCell('A7')
//                    ->getHyperlink()
//                    ->setUrl('http://examle.com/uploads/cv/' )
//                    ->setTooltip('Click here to access file');
            });
        })->export('xlsx',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    /**
     * Excel Plan camiseta
     * @param $company_id
     */
    public function planCamiseta($company_id) {
       // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Plan Camiseta 2018', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas Palmera');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_plan_camiseta(" . $company_id . ",". Auth::user()->id .")";
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

                    "Respuesta",

                    "Respuesta",

                    "Respuesta",
                    "Foto",

                    "Respuesta",
                    "Foto",

                    "Respuesta",
                    "Foto",

                    "Respuesta",
                    "Foto",

                    "Comentario Adicional",


                );

                $columns = array("r","w","y","aa","ac");

                $setMargenCell =  array("O3:R3","s3:s3","t3:t3","u3:u3","v3:w3","x3:y3","z3:aa3","ab3:ac3");
                $setFormatCell =  array("o3","s3","t3","u3","v3","x3","z3","ab3");
                $setTextCell =  array(
                    "¿Se encuentra abierto el local?",
                    "¿Ofreció Salsa Roja Don Vittorio?",
                    "¿Tiene Stock Disponible de SRDV?",
                    "¿Ofreció Pomarola?",
                    "¿Tiene Material POP de SRDV Ventana?",
                    "¿Tiene Material POP de SRDV Mandil?",
                    "¿Tiene Material POP de SRDV Ganchera?",
                    "¿Tiene Material POP de SRDV Volantes?");

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

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    /**
     * Excel Alicorp OSA + SOD Mini Mayoristas Octubre
     * @param $company_id
     */
    public function osaSodMiniMayoristas($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp OSA SOD', function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_osa_sod_minimayoristas(" . $company_id . ",". Auth::user()->id .")";
//                $sqlcoord="CALL sp_osa_sod_minimayoristas(" . $company_id . ",5)";
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

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",
                    "Trabajada",
                    "Visible",

                    "Existe",
                    "Foto",

                    "Existe",
                    "Foto",

                    "Existe",
                    "Foto",

                    "Existe",
                    "Foto",

                    "Existe",
                    "Foto"
                );
//              Columnas para las fotos

                $columns = array("r","W","AA","AE","AI","AM","AQ","AU","AY","BC","BG","BK","BO","BS","BU","BW","BY","CA");

                $setMargenCell =  array(
                   "O3:R3",
                   "s3:u3",
                   "v3:y3",
                   "z3:ac3",
                   "ad3:ag3",
                   "ah3:ak3",
                   "al3:ao3",
                   "ap3:as3",
                   "at3:aw3",
                   "ax3:ba3",
                   "bb3:be3",
                   "bf3:bi3",
                   "bj3:bm3",
                   "bn3:bq3",
                   "br3:bs3",
                   "bt3:bu3",
                   "bv3:bw3",
                   "bx3:by3",
                   "bz3:ca3"
                );
                $setFormatCell =  array(
                    "O3" ,
                    "s3" ,
                    "v3" ,
                    "z3" ,
                    "ad3",
                    "ah3",
                    "al3",
                    "ap3",
                    "at3",
                    "ax3",
                    "bb3",
                    "bf3",
                    "bj3",
                    "bn3",
                    "br3",
                    "bt3",
                    "bv3",
                    "bx3",
                    "bz3");

                $setTextCell =  array(
                   "¿Se encuentra Abierto? Si/No",
                    "¿Cliente permitió tomar informaciónn?",
                  "¿EXISTE VENTANA SALSAS?",
                  "VENTANA PASTAS ",
                  "VENTANA ACEITES",
                  "VENTANA REFRESCOS ",
                  "VENTANA DETERGENTES",
                  "VENTANA CONSERVAS ",
                  "VENTANA MARGARINAS ",
                  "VENTANA HARINAS ",
                  "VENTANA POSTRES ",
                  "VENTANA JABONES DE LAVAR",
                  "VENTANA QUITAMANCHAS",
                  "VENTANA SUAVIZANTES",
                  "GANCHERA SALSAS",
                  "EXHIBIDOR FRUTÍSIMOS",
                  "EXHIBIDOR ATÚN PRIMOR",
                  "EXHIBIDOR MARGARINAS",
                  "GANCHERA SUAV/QUIT"
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

//                $sheet->setColumnFormat([
//                    'O' => '0',
//                    'R' => '0',
//                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    /**
     * Excel excelHelenaPremiacion
     * @param $company_id
     */
    public function excelHelenaPremiacion($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Helena Premia - ' . $company_id, function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas ');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_alicorp_helena_premiados(" . $company_id . ",". Auth::user()->id .")";
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
                    'ID',
                    'CANAL',
                    'MERCADO',
                    'COMERCIO',
                    'DIRECCION',
                    'DISTRITO',
                    'REGION',
                    'UBIGEO',
                    'TIPO DE BODEGA',
                    'AUDITOR',
                    'FECHA',
                    'HORA',

                    '¿ Se encuentra Abierto el punto ?',
                    'Comentario',
                    'FOTO',

                    '¿ Cliente Aceptó Premio ?',
                    'Comentario',
                    'FOTO',
                );

                $columns = array("o","r");

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

                $sheet->setColumnFormat([
                    'O' => '0',
                    'R' => '0',
                ]);
            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
    }


    /**
     * Excel Plan  alicorpMercaderismoNorte
     * @param $ini
     * @param $end
     */
    public function alicorpMercaderismoNorte($ini,$end) {
        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp Mercaderismo Norte', function($excel) use ($ini,$end) {
            $excel->setTitle('Nuevas tiendas');
            $excel->sheet('General', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_alicorp_mercaderismo_norte('" . $ini . "','" . $end . ",". Auth::user()->id .")";
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
                    "Foto",

                    "Respuesta",
                    "Foto",

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
                    $url_foto =trim($sheet->getCell('q' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('q' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('q' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }
                    $url_foto =trim($sheet->getCell('s' . ($i + 4))->getValue());
                    if(strlen($url_foto)>0) {
                        $sheet->getCell('s' . ($i + 4))->setValue("Foto");
                        $sheet->getCell('s' . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imagen');
                    }

                }

                $sheet->mergeCells('p3:q3');
                $sheet->cell('p3', function($cell) {
                    $cell->setValue('¿Se realizó Bandeo de Quitamanchas?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('r3:s3');
                $sheet->cell('r3', function($cell) {
                    $cell->setValue('¿Se realizó Bandero de Suavizantes?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

//                $sheet->mergeCells('x3:y3');
//                $sheet->cell('x3', function($cell) {
//                    $cell->setValue('¿Se colocó sticker?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('solid', 'none', 'none', 'solid');
//                });

//                $sheet->setColumnFormat([
//                    'O' => '0',
//                    'R' => '0',
//                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    /**
     * Excel Plan  alicorpMercaderismoNortev2
     * @param $ini
     * @param $end
     */

    public function alicorpMercaderismoNorteV2($ini,$end) {
        header('Access-Control-Allow-Origin: *');
        Excel::create('Alicorp Mercaderismo Norte', function($excel) use ($ini,$end) {
            $excel->setTitle('Nuevas tiendas');
            $excel->sheet('General', function($sheet) use ($ini,$end) {
                $ini = (string)$ini;
                $end = (string)$end;
                $sqlcoord="CALL sp_alicorp_mercaderismo_norte_v2('" . $ini . "','" . $end . ",". Auth::user()->id .")";
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
                    "Foto",

                    "Respuesta",
                    "Foto",

                    "Respuesta",
                    "Foto",

                );

                $columns = array(
                    "q",
                    "s",
                    "u",
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

                $sheet->setAutoFilter('A4:U'.(count($data) + 4));


                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columns); $col++){
                        $url_foto =trim($sheet->getCell($columns[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columns[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columns[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }

                $sheet->mergeCells('p3:q3');
                $sheet->cell('p3', function($cell) {
                    $cell->setValue('¿Se realizó Bandeo de Quitamanchas?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('r3:s3');
                $sheet->cell('r3', function($cell) {
                    $cell->setValue('¿Existe ventana detergentes?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

                $sheet->mergeCells('t3:u3');
                $sheet->cell('t3', function($cell) {
                    $cell->setValue('¿Permitió trabajar la ventana?');
                    $cell->setBackground('#0e5a97');
                    $cell->setAlignment('center');
                    $cell->setFontColor('#fefffe');
                    // Set all borders (top, right, bottom, left)
                    $cell->setBorder('solid', 'none', 'none', 'solid');
                });

//                $sheet->mergeCells('x3:y3');
//                $sheet->cell('x3', function($cell) {
//                    $cell->setValue('¿Se colocó sticker?');
//                    $cell->setBackground('#0e5a97');
//                    $cell->setAlignment('center');
//                    $cell->setFontColor('#fefffe');
//                    // Set all borders (top, right, bottom, left)
//                    $cell->setBorder('solid', 'none', 'none', 'solid');
//                });

//                $sheet->setColumnFormat([
//                    'O' => '0',
//                    'R' => '0',
//                ]);


//                $sheet->cells('S3:U3', function($cells) {
//                    $cells->setBorder('thin','thin','thin','thin');
//                });

            });

        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    /** Alicorp Helena Triada
     * @param $company_id
     */
    public function excelAlicorpHelenaTriadaV2($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Helena Triada '. $company_id , function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_alicorp_helena_v2(" . $company_id . ",". Auth::user()->id .")";
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
                    'ID',
                    'CANAL',
                    'MERCADO',
                    'COMERCIO',
                    'DIRECCION',
                    'DISTRITO',
                    'REGION',
                    'UBIGEO',
                    'TIPO DE BODEGA',
                    'AUDITOR',
                    'FECHA',
                    'HORA',

                    '¿Se encuentra Abierto? Si/No',
                    'Opciones',
                    'FOTO',

                    '¿Cliente permitió tomar informaciónn?',
                    'Opciones',
                    'Comentario',
//
                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',
                );

                $columns = array("o","u","x","aa","ad","ag","aj","am","ap");

                $setMargenCell =  array('S3:U3','V3:X3','Y3:AA3','AB3:AD3','AE3:AG3','AH3:AJ3','Ak3:Am3','An3:Ap3');
                $setFormatCell =  array('S3','V3','Y3' ,'AB3','AE3','AH3','AK3','AN3');
                $setTextCell =  array(
                    'Ventana Alacena'
                   ,'Ventana salsas Don Vittorio'
                   ,'Ventana Refrescos (Negrita,Kanu,Frutisimos)'
                   ,'Ventana postres Negrita'
                   ,'Cortina Alacena+Don Vittorio'
                   ,'Cajonera Salsas,Refrescos y/o Postres'
                   ,'Ventana Aceites Cil'
                   ,'Ventana Atún Primor' //'Ventana Aceites Friol'
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

                $sheet->setAutoFilter('A4:ap'.(count($data) + 4));


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


    public function excelAlicorpHelenaTriadaV3($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Helena Triada '. $company_id , function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_alicorp_helena_v3(" . $company_id . ",". Auth::user()->id .")";
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
                    'ID',
                    'CANAL',
                    'MERCADO',
                    'COMERCIO',
                    'DIRECCION',
                    'DISTRITO',
                    'REGION',
                    'UBIGEO',
                    'TIPO DE BODEGA',
                    'AUDITOR',
                    'FECHA',
                    'HORA',

                    '¿Se encuentra Abierto? Si/No',
                    'Opciones',
                    'FOTO',

                    '¿Cliente permitió tomar informaciónn?',
                    'Opciones',
                    'Comentario',
//
                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Existe Ventana?',
                    '¿Cumple Visibilidad?',
                    'Foto',

                    '¿Firmo Cargo?',
                    'Foto'
                );

                $columns = array("o","u","x","aa","ad","ag","aj","am","ao");

                $setMargenCell =  array('S3:U3','V3:X3','Y3:AA3','AB3:AD3','AE3:AG3','AH3:AJ3','Ak3:Am3');
                $setFormatCell =  array('S3','V3','Y3' ,'AB3','AE3','AH3','AK3');
                $setTextCell =  array(
                    'Ventana Alacena'
                ,'Ventana salsas Don Vittorio'
                ,'Ventana Refrescos (Negrita,Kanu,Frutisimos)'
                ,'Ventana postres Negrita'
                ,'Cortina Alacena+Don Vittorio'
                ,'Ventana Aceites Cil'
                ,'Ventana Atún Primor' //'Ventana Aceites Friol'
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

                $sheet->setAutoFilter('A4:ao'.(count($data) + 4));


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
     * @param $company_id
     */
    public function excelAlicorpHelenaTriadaProductV4($company_id) {
        // dd(Auth::user()->id);
        header('Access-Control-Allow-Origin: *');
        Excel::create('Helena Triada Producto '. $company_id , function($excel) use ($company_id) {
            $excel->setTitle('Tiendas auditadas');
            $excel->sheet('General', function($sheet) use ($company_id) {
                $company_id = (int)$company_id;
                $sqlcoord="CALL sp_alicorp_helena_products_v4(" . $company_id . ",". Auth::user()->id .")";
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
                    'ID',
                    'CANAL',
                    'MERCADO',
                    'COMERCIO',
                    'DIRECCION',
                    'DISTRITO',
                    'REGION',
                    'UBIGEO',
                    'TIPO DE BODEGA',
                    'AUDITOR',
                    'FECHA',
                    'HORA',

                    '¿Se encuentra Abierto? Si/No',
                    'Opciones',
                    'FOTO',

                    '¿Cliente permitió tomar informaciónn?',
                    'Opciones',
                    'Comentario',
//
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                    'Respuesta',
                );

                $columns = array("o");

//                $setMargenCell =  array('S3:U3','V3:X3','Y3:AA3','AB3:AD3','AE3:AG3','AH3:AJ3','Ak3:Am3','An3:Ap3');
                $setFormatCell =  array(

                                'S3',
                                'T3' ,
                                'U3' ,
                                'V3' ,
                                'W3' ,
                                'X3' ,
                                'Y3' ,
                                'Z3' ,
                                'AA3',
                                'AB3',
                                'AC3',
                                'AD3',
                                'AE3',
                                'AF3',
                                'AG3',
                                'AH3',
                                'AI3',
                                'AJ3',
                                'AK3',
                                'AL3',
                                'AM3',
                                'AN3',
                                'AO3',
                                'AP3',
                                'AQ3',
                                'AR3',
                                'AS3',
                                'AT3',
                                'AU3',
                                'AV3',
                                'AW3',
                                'AX3',
                                'AY3',
                                'AZ3',
                                'BA3',
                                'BB3',
                                'BC3',
                                'BD3',
                                'BE3',
                                'BF3',
                                'BG3',
                                'BH3',
                                'BI3',
                                'BJ3',
                                'BK3'
                );
                $setTextCell =  array(
                        'ALACENA mayonesa 100cc'
                        ,'ALACENA mayonesa 500 cc'
                        ,'ALACENA mayonesa light'
                        ,'ALACENA ketchup'
                        ,'ALACENA mostaza'
                        ,'ALACENA Uchucuta'
                        ,'ALACENA Tari'
                        ,'ALACENA salsa de rocoto'
                        ,'ALACENA huancaina'
                        ,'ALACENA salsa de tomate'
                        ,'DON VITTORIO salsa roja 200gr'
                        ,'DON VITTORIO salsa roja 400gr'
                        ,'NEGRITA gelatina Limon'
                        ,'NEGRITA gelatina Uva'
                        ,'NEGRITA gelatina Piña'
                        ,'NEGRITA gelatina naranja'
                        ,'NEGRITA gelatina Diet FRESA'
                        ,'NEGRITA gelatina Diet PIÑA'
                        ,'NEGRITA gelatina Diet NARANJA'
                        ,'NEGRITA mazamorra morada'
                        ,'NEGRITA mazamorra Durazno'
                        ,'NEGRITA mazamorra Piña'
                        ,'FRUTISIMOS refrescos Mandarina'
                        ,'FRUTISIMOS refrescos Chicha'
                        ,'FRUTISIMOS refrescos Naranja'
                        ,'FRUTISIMOS refrescos Piña'
                        ,'FRUTISIMOS refrescos Maracuya'
                        ,'FRUTISIMOS refrescos Durazno'
                        ,'NEGRITA refrescos CHICHA'
                        ,'NEGRITA refrescos NARANJA'
                        ,'NEGRITA refrescos PIÑA'
                        ,'NEGRITA refrescos FRESA'
                        ,'NEGRITA refrescos MARACUYA'
                        ,'NEGRITA refrescos DURAZNO'
                        ,'NEGRITA refrescos CEBADA'
                        ,'NEGRITA refrescos EMOLIENTE'
                        ,'KANU Piña'
                        ,'KANU Naranja'
                        ,'KANU Chicha morada'
                        ,'KANU Mango'
                        ,'NEGRITA gelatina Fresa 150 gr'
                        ,'Cil 1lt'
                        ,'Cil 500 ml'
                        ,'ATÚN PRIMOR TROZOS DE ATÚN' //'Friol 1 lt'
                        ,'ATÚN PRIMOR FILETE DE ATÚN' //'Friol 500ml'
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

                $sheet->setAutoFilter('A4:bk'.(count($data) + 4));


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
//                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setFormatCell[$i], function($cell)  {
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


// --------------------------------CP OSA bodegas ----------------------------------------
    public function excelAlicorpCpOsaBodegas($company_id)
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id , function($excel) use ($company_id) {
            $excel->setTitle('Reporte CP OSA Bodegas');

            $excel->sheet($company_id , function($sheet) use ($company_id) {
                $sqlcoord="CALL sp_cp_osa_stores_v2(".$company_id.",". Auth::user()->id . ")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                $headings = array(
                    "ID",
                    "RUC",
                    "NOMBRE",
                    "DIRECCIÓN",
                    "DISTRITO",
                    "UBIGEO",
                    "CODIGO_CLIENTE",
                    "DISTRIBUIDORA",
                    "LATITUD",
                    "LONGITUD",
                    "AUDITOR",
                    "FECHA",
                    "HORA",

                    "Respuesta",
                    "Opciones",
                    "Foto",
                    "Respuesta",
                    "Opciones",
                    "Comentario",
                    "Foto",
                    "Opcion"
                );
                $columnsFoto = array(
                    "P",
                    "T"
                );
                $setMargenCell =  array("N3:P3","Q3:T3","U3:U3");
                $setFormatCell =  array("N3","Q3","U3");
                $setTextCell =  array(
                    "Se encuentra Abierto el punto?",
                    "¿Cliente permitió tomar información?",
                    "¿Cuántas veces a la semana lo visita el vendedor?"
                );


                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function excelAlicorpRegularV7($company_id,$type_bodega,$category_id,$parte,$desde,$hasta)
    {

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . '-'. $category_id . " - ". $type_bodega."-".$parte."-".$desde."-".$hasta, function($excel) use ($company_id,$type_bodega, $category_id,$parte,$desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular V7');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte,$desde,$hasta) {
                $sqlcoord="CALL sp_alicorp_regular_v7(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte .",". $desde .",". $hasta . ")";
                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿Tiene la cartilla Cliente Perfecto?",//10
                                "¿Ha recibido esta cartilla?",//11

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AF",
                                "at",
                                "bh",
                                "bv",
                                "cj",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("w3:Aj3","ak3:ax3","ay3:bl3","bm3:bz3");
                            $setFormatCell =  array("w3","ak3","ay3","bm3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿Tiene la cartilla Cliente Perfecto?",//10
                                "¿Ha recibido esta cartilla?",//11

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AF",
                                "at",
                                "bh",
                                "bv",
                                "cj",
                                "cv"

                            );
                            $setMargenCell =  array("W3:AJ3","al3:ax3","ay3:bl3");
                            $setFormatCell =  array("w3","al3","ay3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría");
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3");
                            $setFormatCell =  array("U3","ai3");
                            $setTextCell =  array(
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",

                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún");

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3");
                            $setFormatCell =  array("N3","Q3","U3","Z3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún");
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)"
                            );
                        }

                    }
                }




                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }






    public function excelAlicorpRegularV8($company_id,$type_bodega,$category_id,$parte,$desde,$hasta)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        if ($parte == 10){
            $textoTitle=$company_id .  "-". $fecha."-".$parte."-".$desde."-".$hasta;
        }else{
            $textoTitle=$company_id ."-". $fecha. '-'. $category_id . "-". $type_bodega."-".$parte."-".$desde."-".$hasta;
        }
        header('Access-Control-Allow-Origin: *');
        Excel::create($textoTitle, function($excel) use ($company_id,$type_bodega, $category_id,$parte,$desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular V8');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte,$desde,$hasta) {
                if ($parte == 10){
                    $sqlcoord="CALL sp_alicorp_regular_v8_temp(".$company_id.",". Auth::user()->id .",". $desde .",". $hasta . ")";
                }else{
                    $sqlcoord="CALL sp_alicorp_regular_v8(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte .",". $desde .",". $hasta . ")";
                }

                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                		"¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                		"¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría",
                                "Exhibidor de Atún",
                                "Exhibidor de Marsella");
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",//T

                                //CARTILLA
                                "¿Tiene la cartilla Cliente Perfecto?",//U
                                "¿Ha recibido esta cartilla?",//V
                                "¿A quién le compra sus productos?",//W
                                //FIN CARTILLA

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",
                                //CARTILLA comentario
                                "¿A quién le compra sus productos? Comentario"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AG",
                                "AU",
                                "bi",
                                "bw"
                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","u3:v3","w3:w3","X3:AK3","AL3:AY3","AZ3:BM3","BN3:CA3","CB3:CB3");
                            $setFormatCell =  array("N3","Q3","u3","w3","X3","AL3","az3","bn3","CB3");
                            $setTextCell =  array(
                                "Se encuentra Abierto?",
                                "Permitio tomar información?",
                                "Cartilla",
                                "¿A quién le compra sus productos?",
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",//al3:ay3
                                "Balde Don Vittorio",//az3:bm3
                                "Paleta de Precios",//bn3:ca3
                                "¿A quién le compra sus productos?"
                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún"
                                );

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",//M

                                "Respuesta",//N
                                "Opciones",
                                "Foto",//P

                                "Respuesta",//Q
                                "Opciones",
                                "Comentario",
                                "Foto",//T

                                //cartilla
                                "Respuesta",//U
                                "Respuesta",//V
                                "Opciones",//W
                                //fin Cartilla

                                "¿Existe Ventana?",//X
                                "¿Es visible?",//Y
                                "¿Como se encuentra la Ventana?",//Z
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",//AA
                                "Foto",//AB

                                "¿Existe Ventana?",//AC
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AG


                                "¿Existe Ventana?",//AH
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AL

                                "¿Existe Ventana?",//AM
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AQ

                                "¿Existe Ventana?",//AR
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AV


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AB",
                                "AG",
                                "AL",
                                "AQ",
                                "AV"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:U3","V3:V3","W3:W3","X3:AB3","AC3:AG3","AH3:AL3","AM3:AQ3","AR3:AV3");
                            $setFormatCell =  array("N3","Q3","U3","V3","W3","X3","AC3","AH3","AM3","AR3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "¿Tiene la cartilla Cliente Perfecto?",
                                "¿Ha recibido esta cartilla?",
                                "¿A quién le compra sus productos?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Ventana Marsella (Lava vajillas)",
                                "Ventana Margarinas (Manty o Sello de Oro)",
                                "Ventana Suavizantes Bolivar");
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)"
                            );
                        }

                    }
                }

                if ($parte == 10){
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "¿Se encuentra Abierto? Si/No",
                        "Opciones",
                        "FOTO",

                        "¿Cliente permitió tomar informaciónn?",
                        "Opciones",
                        "Comentario",
                        "FOTO",//T

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",
                    );
                    $columnsFoto = array(
                        "P",
                        "T",
                        "Y",
                        "AD",
                        "AI",
                        "AN",
                        "AS"
                    );
                    $setMargenCell =  array("N3:P3","Q3:T3","u3:y3","z3:ad3","ae3:ai3","aj3:an3","ao3:as3");
                    $setFormatCell =  array("N3","Q3","u3","z3","ae3","aj3","ao3");
                    $setTextCell =  array(
                        "Se encuentra Abierto?",
                        "Permitio tomar información?",
                        "Ventana Postres Alicorp",
                        "Ventana Jabones de Lavar Alicorp",//al3:ay3
                        "Exhibidor Untable Alicorp",//az3:bm3
                        "Exhibidor Harina Alicorp",//bn3:ca3
                        "Exhibidor Lavavajilla Alicorp"
                    );
                }


                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularV9($company_id,$type_bodega,$category_id,$parte,$desde,$hasta)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        if ($parte == 10){
            $textoTitle=$company_id .  "-". $fecha."-".$parte."-".$desde."-".$hasta;
        }else{
            $textoTitle=$company_id ."-". $fecha. '-'. $category_id . "-". $type_bodega."-".$parte."-".$desde."-".$hasta;
        }
        header('Access-Control-Allow-Origin: *');
        Excel::create($textoTitle, function($excel) use ($company_id,$type_bodega, $category_id,$parte,$desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular V9');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte,$desde,$hasta) {
                if ($parte == 10){
                    $sqlcoord="CALL sp_alicorp_regular_v8_temp(".$company_id.",". Auth::user()->id .",". $desde .",". $hasta . ")";
                }else{
                    $sqlcoord="CALL sp_alicorp_regular_v9(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte .",". $desde .",". $hasta . ")";
                }

                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                		"¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj",
                                "dx",
                                "el"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3","cm3:cz3","da3:dn3","do3:eb3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3","cm3","da3","do3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría",
                                "Exhibidor de Atún",
                                "Exhibidor de Marsella",
                                "Ganchera Dento",
                                "Exhibidor de Jabones en barra aval",
                                "Cintas delimitadoras dento y aval"
                            );
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",//T

                                //CARTILLA
                                "¿Tiene la cartilla Cliente Perfecto?",//U
                                "¿Ha recibido esta cartilla?",//V
                                "¿A quién le compra sus productos?",//W
                                //FIN CARTILLA

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",




                                //CARTILLA comentario
                                "¿A quién le compra sus productos? Comentario"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AG",
                                "AU",
                                "bi",
                                "bw",
                                "ck",
                                "cy",
                                "dm"
                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","u3:v3","w3:w3","X3:AK3","AL3:AY3","AZ3:BM3","BN3:CA3","CB3:Co3","Cp3:dc3","dd3:dq3","dr3:dr3");
                            $setFormatCell =  array("N3","Q3","u3","w3","X3","AL3","az3","bn3","CB3","Cp3","dd3","dr3");
                            $setTextCell =  array(
                                "Se encuentra Abierto?",
                                "Permitio tomar información?",
                                "Cartilla",
                                "¿A quién le compra sus productos?",
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",//al3:ay3
                                "Balde Don Vittorio",//az3:bm3
                                "Paleta de Precios",//bn3:ca3

                                "Ganchera Dento",//bn3:ca3
                                "Exhibidor de Jabones en barra aval",//bn3:ca3
                                "Cintas delimitadoras dento y aval",//bn3:ca3

                                "¿A quién le compra sus productos?"
                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS",
                                "AX"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3","At3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Cuidado de la Piel"
                                );

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",//M

                                "Respuesta",//N
                                "Opciones",
                                "Foto",//P

                                "Respuesta",//Q
                                "Opciones",
                                "Comentario",
                                "Foto",//T

                                //cartilla
                                "Respuesta",//U
                                "Respuesta",//V
                                "Opciones",//W
                                //fin Cartilla

                                "¿Existe Ventana?",//X
                                "¿Es visible?",//Y
                                "¿Como se encuentra la Ventana?",//Z
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",//AA
                                "Foto",//AB

                                "¿Existe Ventana?",//AC
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AG


                                "¿Existe Ventana?",//AH
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AL

                                "¿Existe Ventana?",//AM
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AQ

                                "¿Existe Ventana?",//AR
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AV


                                "¿Existe Ventana?",//AR
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AV


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AB",
                                "AG",
                                "AL",
                                "AQ",
                                "AV",
                                "BA"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:U3","V3:V3","W3:W3","X3:AB3","AC3:AG3","AH3:AL3","AM3:AQ3","AR3:AV3","Aw3:ba3");
                            $setFormatCell =  array("N3","Q3","U3","V3","W3","X3","AC3","AH3","AM3","AR3","Aw3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "¿Tiene la cartilla Cliente Perfecto?",
                                "¿Ha recibido esta cartilla?",
                                "¿A quién le compra sus productos?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Ventana Marsella (Lava vajillas)",
                                "Ventana Margarinas (Manty o Sello de Oro)",
                                "Ventana Suavizantes Bolivar",
                                "Pasta Dental"
                            );
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                                "Cuidado de la Piel (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "bc",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3","ay3:bc3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3","ay3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)",
                                "Pasta Dental"
                            );
                        }

                    }
                }

                if ($parte == 10){
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "¿Se encuentra Abierto? Si/No",
                        "Opciones",
                        "FOTO",

                        "¿Cliente permitió tomar informaciónn?",
                        "Opciones",
                        "Comentario",
                        "FOTO",//T

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",
                    );
                    $columnsFoto = array(
                        "P",
                        "T",
                        "Y",
                        "AD",
                        "AI",
                        "AN",
                        "AS"
                    );
                    $setMargenCell =  array("N3:P3","Q3:T3","u3:y3","z3:ad3","ae3:ai3","aj3:an3","ao3:as3");
                    $setFormatCell =  array("N3","Q3","u3","z3","ae3","aj3","ao3");
                    $setTextCell =  array(
                        "Se encuentra Abierto?",
                        "Permitio tomar información?",
                        "Ventana Postres Alicorp",
                        "Ventana Jabones de Lavar Alicorp",//al3:ay3
                        "Exhibidor Untable Alicorp",//az3:bm3
                        "Exhibidor Harina Alicorp",//bn3:ca3
                        "Exhibidor Lavavajilla Alicorp"
                    );
                }


                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }


    public function excelAlicorpRegularV10($company_id,$type_bodega,$category_id,$parte,$desde,$hasta)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();
        if ($parte == 10){
            $textoTitle=$company_id .  "-". $fecha."-".$parte."-".$desde."-".$hasta;
        }else{
            $textoTitle=$company_id ."-". $fecha. '-'. $category_id . "-". $type_bodega."-".$parte."-".$desde."-".$hasta;
        }
        header('Access-Control-Allow-Origin: *');
        Excel::create($textoTitle, function($excel) use ($company_id,$type_bodega, $category_id,$parte,$desde,$hasta) {
            $excel->setTitle('Reporte Alicorp Regular V10');

            $excel->sheet($company_id . '-'. $category_id . " - ". $type_bodega , function($sheet) use ($company_id, $type_bodega, $category_id,$parte,$desde,$hasta) {
                if ($parte == 10){
                    $sqlcoord="CALL sp_alicorp_regular_v8_temp(".$company_id.",". Auth::user()->id .",". $desde .",". $hasta . ")";
                }else{
                    $sqlcoord="CALL sp_alicorp_regular_v10(".$company_id.",'". $type_bodega . "',".$category_id.",". Auth::user()->id .",". $parte .",". $desde .",". $hasta . ")";
                }

                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }

                if($category_id == 53){
                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"



                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3");
                            $setTextCell =  array(
                                "Ganchera Salsas",
                                "Ganchera Frutísimos",
                                "Exhibidores Margarinas",
                                "Posavuelto Galletas"
                            );

                        } else if ($parte == 2) {

                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%"

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch",
                                "cv",
                                "dj",
                                "dx",
                                "el"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3","cm3:cz3","da3:dn3","do3:eb3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3","cm3","da3","do3");
                            $setTextCell =  array(
                                "Cubos de impulso",
                                "Suavizantes/quitamanchas",
                                "Portafiche Multicategoría",
                                "Exhibidor de Atún",
                                "Exhibidor de Marsella",
                                "Ganchera Dento",
                                "Exhibidor de Jabones en barra aval",
                                "Cintas delimitadoras dento y aval"
                            );
                        }

                    }else if($type_bodega ==  'Puesto de Mercado'){

                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AD",
                                "ar",
                                "bf",
                                "bt",
                                "ch"

                            );
                            $setMargenCell =  array("U3:Ah3","ai3:av3","aw3:bj3","bk3:bx3","by3:cl3");
                            $setFormatCell =  array("U3","ai3","aw3","bk3","by3");
                            $setTextCell =  array(
                                "Exhibidor Atún Primor (Mercados)",
                                "Exhibidor Bolsas Don Vittorio (Mercados)",
                                "Exhibidor Frutísimos (Mercados)",
                                "Exhibidor Margarinas (Mercados)",
                                "Ganchera Salsas (Mercados)",

                            );
                        }  else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCION",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "¿Se encuentra Abierto? Si/No",
                                "Opciones",
                                "FOTO",

                                "¿Cliente permitió tomar informaciónn?",
                                "Opciones",
                                "Comentario",
                                "FOTO",//T

                                //CARTILLA
                                "¿Tiene la cartilla Cliente Perfecto?",//U
                                "¿Ha recibido esta cartilla?",//V
                                "¿A quién le compra sus productos?",//W
                                //FIN CARTILLA

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdio o lo rompio",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",

                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",


                                "¿ Se encontro exhibidor ?",
                                "Aún no lo colocaron",
                                "Cliente lo retiró",
                                "Cliente lo perdió o lo rompi",
                                "Cliente nunca lo aceptó",
                                "Otros",
                                "Comentario",
                                "¿Es visible?",
                                "¿Está Contaminado?",
                                "Foto",
                                "¿ Exhibidor Alicorp tiene carga ?",
                                "20%",
                                "50%",
                                "100%",




                                //CARTILLA comentario
                                "¿A quién le compra sus productos? Comentario"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AG",
                                "AU",
                                "bi",
                                "bw",
                                "ck",
                                "cy",
                                "dm"
                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","u3:v3","w3:w3","X3:AK3","AL3:AY3","AZ3:BM3","BN3:CA3","CB3:Co3","Cp3:dc3","dd3:dq3","dr3:dr3");
                            $setFormatCell =  array("N3","Q3","u3","w3","X3","AL3","az3","bn3","CB3","Cp3","dd3","dr3");
                            $setTextCell =  array(
                                "Se encuentra Abierto?",
                                "Permitio tomar información?",
                                "Cartilla",
                                "¿A quién le compra sus productos?",
                                "Ganchera Suavizantes y Quitamanchas (Mercados)",
                                "Balanza Marsella (Mercados)",//al3:ay3
                                "Balde Don Vittorio",//az3:bm3
                                "Paleta de Precios",//bn3:ca3

                                "Ganchera Dento",//bn3:ca3
                                "Exhibidor de Jabones en barra aval",//bn3:ca3
                                "Cintas delimitadoras dento y aval",//bn3:ca3

                                "¿A quién le compra sus productos?"
                            );
                        }

                    }
                } else if ($category_id == 54 ) {


                    if($type_bodega ==  'Bodega'){

                        if ($parte == 1) {
                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto"
                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "Y",
                                "AD",
                                "AI",
                                "AN",
                                "AS",
                                "AX"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:AI3","AJ3:AN3","AO3:AS3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","AE3","AJ3","AO3","At3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Cuidado de la Piel"
                            );

                        } else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",//M

                                "Respuesta",//N
                                "Opciones",
                                "Foto",//P

                                "Respuesta",//Q
                                "Opciones",
                                "Comentario",
                                "Foto",//T

                                //cartilla
                                "Respuesta",//U
                                "Respuesta",//V
                                "Opciones",//W
                                //fin Cartilla

                                "¿Existe Ventana?",//X
                                "¿Es visible?",//Y
                                "¿Como se encuentra la Ventana?",//Z
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",//AA
                                "Foto",//AB

                                "¿Existe Ventana?",//AC
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AG


                                "¿Existe Ventana?",//AH
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AL

                                "¿Existe Ventana?",//AM
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AQ

                                "¿Existe Ventana?",//AR
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AV


                                "¿Existe Ventana?",//AR
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",//AV


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "AB",
                                "AG",
                                "AL",
                                "AQ",
                                "AV",
                                "BA"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:U3","V3:V3","W3:W3","X3:AB3","AC3:AG3","AH3:AL3","AM3:AQ3","AR3:AV3","Aw3:ba3");
                            $setFormatCell =  array("N3","Q3","U3","V3","W3","X3","AC3","AH3","AM3","AR3","Aw3");
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "¿Tiene la cartilla Cliente Perfecto?",
                                "¿Ha recibido esta cartilla?",
                                "¿A quién le compra sus productos?",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Ventana Marsella (Lava vajillas)",
                                "Ventana Margarinas (Manty o Sello de Oro)",
                                "Ventana Suavizantes Bolivar",
                                "Pasta Dental"
                            );
                        }


                    }else if($type_bodega ==  'Puesto de Mercado'){
                        if ($parte == 1) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "ax"

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Salsa (Mercados)",
                                "Ventana Pastas(Mercados)",
                                "Ventana Aceites (Mercados)",
                                "Ventana Galletas (Mercados)",
                                "Ventana Refrescos (Mercados)",
                                "Cuidado de la Piel (Mercados)",
                            );
                        }else if ($parte == 2) {
                            $headings = array(
                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",
                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",

                                "¿Existe Ventana?",
                                "¿Es visible?",
                                "¿Como se encuentra la Ventana?",
                                "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                                "Foto",


                            );
                            $columnsFoto = array(
                                "P",
                                "T",
                                "y",
                                "AD",
                                "ai",
                                "an",
                                "as",
                                "bc",
                                "ax",
                                "bh",
                                "bm",

                            );
                            $setMargenCell =  array("N3:P3","Q3:T3","U3:Y3","Z3:AD3","AE3:Ai3","Aj3:An3","Ao3:As3","At3:Ax3","ay3:bc3","bd3:bh3","bi3:bm3");
                            $setFormatCell =  array("N3","Q3","U3","Z3","ae3","aj3","ao3","at3","ay3","bd3","bi3");
                            $setTextCell =  array(

                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",
                                "Ventana Detergente (Mercados)",
                                "Ventana Atún (Mercados)",
                                "Ventana Suavizante (Mercados)",
                                "Ventana Quitamancha(Mercados)",
                                "Ventana Margarina (Mercados)",
                                "Ventana Marsella (Mercados Lava vajillas)",
                                "Pasta Dental",
                                "Lejia",
                                "Limpiadores Light Duty"
                            );
                        }

                    }
                }

                if ($parte == 10){
                    $headings = array(
                        "ID",
                        "RUC",
                        "NOMBRE",
                        "DIRECCION",
                        "DISTRITO",
                        "UBIGEO",
                        "CODIGO_CLIENTE",
                        "DISTRIBUIDORA",
                        "LATITUD",
                        "LONGITUD",
                        "AUDITOR",
                        "FECHA",
                        "HORA",

                        "¿Se encuentra Abierto? Si/No",
                        "Opciones",
                        "FOTO",

                        "¿Cliente permitió tomar informaciónn?",
                        "Opciones",
                        "Comentario",
                        "FOTO",//T

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",

                        "¿Existe Ventana?",
                        "¿Es visible?",
                        "¿Como se encuentra la Ventana?",
                        "¿Está Trabajada? (Tiene fronterizador arriba y abajo)",
                        "Foto",
                    );
                    $columnsFoto = array(
                        "P",
                        "T",
                        "Y",
                        "AD",
                        "AI",
                        "AN",
                        "AS"
                    );
                    $setMargenCell =  array("N3:P3","Q3:T3","u3:y3","z3:ad3","ae3:ai3","aj3:an3","ao3:as3");
                    $setFormatCell =  array("N3","Q3","u3","z3","ae3","aj3","ao3");
                    $setTextCell =  array(
                        "Se encuentra Abierto?",
                        "Permitio tomar información?",
                        "Ventana Postres Alicorp",
                        "Ventana Jabones de Lavar Alicorp",//al3:ay3
                        "Exhibidor Untable Alicorp",//az3:bm3
                        "Exhibidor Harina Alicorp",//bn3:ca3
                        "Exhibidor Lavavajilla Alicorp"
                    );
                }


                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

    public function excelAlicorpRLV($company_id,$type_bodega)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . "_Alicorp", function($excel) use ($company_id,$type_bodega) {
            $excel->setTitle('Reporte Alicorp Regular ');

            $excel->sheet($company_id . '_A_Regular_'. $type_bodega , function($sheet) use ($company_id, $type_bodega) {

                $sqlcoord="CALL sp_alicorp_r_p_libre_ventana(".$company_id.",'". $type_bodega . "'," . Auth::user()->id .")";


                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }


                    if($type_bodega ==  'Bodega'){

                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",

                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)"

                            );
                            $columnsFoto = array(
                                "P",
                                "T"
                            );
                            $setMargenCell =  array(
                                "N3:P3",
                                "Q3:T3",
                                "U3:U3",
                                "V3:V3",
                                "W3:W3",
                                "X3:X3",
                                "Y3:Y3",
                                "Z3:Z3",
                                "AA3:AA3",
                                "AB3:AB3",
                                "AC3:AC3",
                                "AD3:AD3",
                                "AE3:AE3"
                                );
                            $setFormatCell =  array(
                                "N3",
                                "Q3",
                                "U3",
                                "V3",
                                "W3",
                                "X3",
                                "Y3",
                                "Z3",
                                "AA3",
                                "AB3",
                                "AC3",
                                "AD3",
                                "AE3"
                            );
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",

                                "Ventana Salsas",
                                "Ventana Pastas",
                                "Ventana Aceites",
                                "Ventana Galletas",
                                "Ventana Refrescos",
                                "Ventana Detergentes",
                                "Ventana Conservas de Atún",
                                "Ventana Suavizantes Bolivar",
                                "Ventana Quitamanchas Opal",
                                "Ventana Margarinas (Manty o Sello de Oro)",
                                "Ventana Marsella (Lava vajillas)"
                            );

                    }





                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }
    public function excelAlicorpRLV_2($company_id,$type_bodega)
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();

        header('Access-Control-Allow-Origin: *');
        Excel::create($company_id . "_Alicorp_2", function($excel) use ($company_id,$type_bodega) {
            $excel->setTitle('Reporte Alicorp Regular 2 ');

            $excel->sheet($company_id . '_A_Regular_'. $type_bodega , function($sheet) use ($company_id, $type_bodega) {

                $sqlcoord="CALL sp_alicorp_r_p_libre_ventana_parte_2(".$company_id.",'". $type_bodega . "'," . Auth::user()->id .")";


                $stores = DB::select($sqlcoord);
                $data = array();
                $data = array();
                foreach ($stores as $result) {
                    $data[] = (array)$result;
                }


                    if($type_bodega ==  'Bodega'){

                            $headings = array(

                                "ID",
                                "RUC",
                                "NOMBRE",
                                "DIRECCIÓN",
                                "DISTRITO",
                                "UBIGEO",
                                "CODIGO_CLIENTE",
                                "DISTRIBUIDORA",
                                "LATITUD",
                                "LONGITUD",
                                "AUDITOR",
                                "FECHA",
                                "HORA",

                                "Respuesta",
                                "Opciones",
                                "Foto",

                                "Respuesta",
                                "Opciones",
                                "Comentario",
                                "Foto",

                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)",
                                " ¿Se encuentra en Zona Caliente? (Mostrador o detrás del cliente)"

                            );
                            $columnsFoto = array(
                                "P",
                                "T"
                            );
                            $setMargenCell =  array(
                                "N3:P3",
                                "Q3:T3",
                                "U3:U3",
                                "V3:V3"
                                );
                            $setFormatCell =  array(
                                "N3",
                                "Q3",
                                "U3",
                                "V3"
                            );
                            $setTextCell =  array(
                                "Se encuentra Abierto el punto?",
                                "¿Cliente permitió tomar información?",

                                "Ventana Pasta dental",
                                "Ventana Cuidado Personal"
                            );

                    }





                $sheet->prependRow(4, $headings);
                $sheet->getCell('A1')->setValue(count($data));
                $datito = $sheet->getCell('A1')->getValue();
                $sheet->getCell('B1')->setValue($datito);

                $sheet->fromArray($data,null,'A5',false,false);
                $sheet->row(4, function($row) {
                    $row->setFontColor('#fefffe');
                    $row->setBackground('#2196F3');
                    $row->setFontWeight('bold');
                    $row->setAlignment('center');
                    $row->setFontSize(10);
                });

                for ($i = 1; $i <= count($data); $i++) {
                    for($col = 0 ; $col < count($columnsFoto); $col++){
                        $url_foto =trim($sheet->getCell($columnsFoto[$col] . ($i + 4))->getValue());
                        if(strlen($url_foto)>0) {
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->setValue("Foto");
                            $sheet->getCell($columnsFoto[$col] . ($i + 4))->getHyperlink()->setUrl($url_foto)->setTooltip('Abrir imágen');
                        }
                    }
                }


                for($i = 0 ; $i < count($setFormatCell); $i++){
                    $sheet->mergeCells($setMargenCell[$i]);
                    $sheet->getCell($setFormatCell[$i])->setValue($setTextCell[$i]);
                    $sheet->cell($setMargenCell[$i], function($cell)  {
                        $cell->setBackground('#FF0000');
                        $cell->setAlignment('center');
                        $cell->setFontColor('#fefffe');
                        $cell->setBorder('solid', 'none', 'none', 'solid');
                    });
                }


            });


        })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);

    }

}
