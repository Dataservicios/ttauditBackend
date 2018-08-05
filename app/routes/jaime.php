<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::resource('excel87category53','ExcelAlicorpController@excel87category53');
Route::resource('excel87category54','ExcelAlicorpController@excel87category54');
Route::resource('excelAlicorpRegular/{company_id}/{category_id}/','ExcelAlicorpController@excelAlicorpRegular');
Route::resource('excelAlicorpRegularV2/{company_id}/{category_id}/','ExcelAlicorpController@excelAlicorpRegularV2');
Route::resource('excelAlicorpRegularV3/{company_id}/{category_id}/{desde}/{hasta}/{pag}/','ExcelAlicorpController@excelAlicorpRegularV3');
//-------------------- Excell Alicorp Preventa-----------------------------------
Route::resource('reporteExcelAlicorpPreVenta','ExcelAlicorpController@campaigneAlicorpPreVenta');

Route::resource('alicorpMercaderismoNorte/{ini}/{end}/', 'ExcelAlicorpController@alicorpMercaderismoNorte');
Route::resource('alicorpMercaderismoNorteV2/{ini}/{end}/', 'ExcelAlicorpController@alicorpMercaderismoNorteV2');
//-------------------- Excell Bayer-----------------------------------
Route::resource('excelPresenPopMercaBayer79', 'ExcelBayerController@productsPriceCompetity79');
Route::resource('productsPriceCompetity79', 'ExcelBayerController@productsPriceCompetity79');
Route::resource('productsPriceCompetityAll79', 'ExcelBayerController@productsPriceCompetityAll79');
Route::resource('productsPriceCompetityAll/{company_id}/', 'ExcelBayerController@productsPriceCompetityAll');
Route::resource('productsPriceCompetityAllV2/{company_id}/', 'ExcelBayerController@productsPriceCompetityAllV2');
Route::resource('productsPriceCompetityAllV3/{company_id}/', 'ExcelBayerController@productsPriceCompetityAllV3');

//-------------------- Excell IBK-----------------------------------
Route::resource('ibkInventario/{company_id}/', 'ExcelInterbankController@ibkInventario');


//-------------------- Excell Palmera Sum-----------------------------------
Route::resource('storesAudit/{company_id}/', 'ExcelPalmeraSumController@storesAudit');
Route::resource('storesAuditV2/{company_id}/', 'ExcelPalmeraSumController@storesAuditV2');
Route::resource('palmeraNewStore/{ini}/{end}/', 'ExcelPalmeraSumController@palmeraNewStore');
Route::resource('storesTromePalmera/{ini}/{end}/', 'ExcelPalmeraSumController@storesTromePalmera');
Route::resource('storesTromeFaseDos/{company_id}/', 'ExcelPalmeraSumController@storesTromeFaseDos');

//-------------------- Excell Plan camisetas mojadas ----------------------------------
Route::resource('planCamiseta/{company_id}/', 'ExcelAlicorpController@planCamiseta');



// ------------------- Mapa De rutas --------------------------------
Route::get('admin/roadsAudit', ['as' => 'listAuditorAll', 'uses' => 'MapRoadAuditorController@listAuditorAll']);
Route::post('admin/roadsAuditMap', ['as' => 'roadMap', 'uses' => 'MapRoadAuditorController@roadMap']);

//-------------------- Resportes Generales-----------------------------------
Route::resource('roadsAndStores/{company_id}/{desde}/{hasta}/', 'ExcelGeneralController@excelRoadsAndStoresForEstudy');

// ------------------- Reportes de prueba --------------------------------
Route::resource('excelPruebaBayer','ExcelBayerController@excelPruebaBayer');
Route::resource('excelPruebaChart','ExcelBayerController@excelPruebaChart');
Route::resource('getChart','ExcelBayerController@getChart');




//Send file
Route::post('imageUpload', 'PollDetailController@imageUpload');


// Pruebas -----------------------------------------
Route::get('pruebaReportExcelDowload','PruebaController@pruebaDowloadExcelAjax');


Route::get('excel',function (){
   Excel::create('report',function ($excel){

       $excel->sheet('Sheet1',function ($sheet){
          for($i=1; $i<=300; $i ++){
              $sheet->row($i, array('test1','test2','tes3','test4'));
          }
       });
   })->store('xls','exports');

   return [
     'success' => true,
     'path' => 'http://' . Request::server('HTTP_HOST'). '/exports/report.xlsx'
   ];
});

//Route::get('report/traderMarkReportPrueba', ['as' => 'traderMarkReport', 'uses' => 'ReportBayerController@traderMarkReportPrueba']);
Route::get('report/traderMarkReportPrueba', ['as' => 'traderMarkReport', 'uses' => 'PruebaController@traderMarkReportPrueba']);
Route::resource('pruebaHome','PruebaController@pruebaHome');
Route::resource('filtroPeriodos','PruebaController@filtroPeriodos');