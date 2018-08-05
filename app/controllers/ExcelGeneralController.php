<?php

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
}
