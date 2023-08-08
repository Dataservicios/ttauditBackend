<?php

class ExcellPivotController extends BaseController
{

    public function excelPolls($company_id,$typeop="0")
    {
        $mytime = Carbon\Carbon::now();
        $fecha= $mytime->toDateTimeString();

        header('Access-Control-Allow-Origin: *');
        if ($typeop=="0"){
            Excel::create('Preguntas_'.$company_id . "_".$fecha, function($excel) use ($company_id) {
                $excel->setTitle('Reporte General ');

                $excel->sheet($company_id . '_reporte_'. $company_id , function($sheet) use ($company_id) {

                    $sqlcoord="CALL sp_dynamic_polls_stores(".$company_id.")";


                    $stores = DB::select($sqlcoord);

                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $sheet->getCell('A1')->setValue(count($data));
                    $sheet->fromArray($data,null,'A5',false,true);


                });


            })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
        }

        if ($typeop=="1"){
            Excel::create('Productos_'.$company_id . "_".$fecha, function($excel) use ($company_id) {
                $excel->setTitle('Reporte productos y otros ');

                $excel->sheet($company_id . '_reporte_'. $company_id , function($sheet) use ($company_id) {

                    $sqlcoord="CALL sp_dynamic_polls_products_stores(".$company_id.")";


                    $stores = DB::select($sqlcoord);

                    $data = array();
                    foreach ($stores as $result) {
                        $data[] = (array)$result;
                    }
                    $sheet->getCell('A1')->setValue(count($data));
                    $sheet->fromArray($data,null,'A5',false,true);


                });


            })->export('xls',['Set-Cookie'=>'fileDownload=true; path=/']);
        }


    }

}