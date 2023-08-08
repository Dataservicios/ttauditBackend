<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::resource('excel87category53','ExcelAlicorpController@excel87category53');
Route::resource('excel87category54','ExcelAlicorpController@excel87category54');
Route::resource('excelAlicorpRegular/{company_id}/{category_id}/','ExcelAlicorpController@excelAlicorpRegular');
Route::resource('excelAlicorpRegularV2/{company_id}/{category_id}/','ExcelAlicorpController@excelAlicorpRegularV2');
Route::resource('excelAlicorpRegularV3/{company_id}/{category_id}/{desde}/{hasta}/{pag}/','ExcelAlicorpController@excelAlicorpRegularV3');

Route::resource('excelAlicorpRegularV4/{company_id}/{type_bodega}/{category_id}/{parte}/','ExcelAlicorpController@excelAlicorpRegularV4');
Route::resource('excelAlicorpRegularSodV4/{company_id}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularSodV4');

Route::resource('excelAlicorpRegularSodV5/{company_id}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularSodV5');

Route::resource('excelAlicorpRegularSodV5_2/{company_id}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularSodV5_2');
Route::resource('excelAlicorpRegularSodV5_3/{company_id}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularSodV5_3');

Route::resource('excelAlicorpRegularV5/{company_id}/{type_bodega}/{category_id}/{parte}/','ExcelAlicorpController@excelAlicorpRegularV5');
Route::resource('excelAlicorpRegularV6/{company_id}/{type_bodega}/{category_id}/{parte}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularV6');

Route::resource('excelAlicorpRegularV7/{company_id}/{type_bodega}/{category_id}/{parte}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularV7');


Route::resource('excelAlicorpRegularV8/{company_id}/{type_bodega}/{category_id}/{parte}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularV8');
Route::resource('excelAlicorpRLV/{company_id}/{type_bodega}/','ExcelAlicorpController@excelAlicorpRLV');
Route::resource('excelAlicorpRLV_2/{company_id}/{type_bodega}/','ExcelAlicorpController@excelAlicorpRLV_2');
Route::resource('excelAlicorpRegularV9/{company_id}/{type_bodega}/{category_id}/{parte}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularV9');
Route::resource('excelAlicorpRegularV10/{company_id}/{type_bodega}/{category_id}/{parte}/{desde}/{hasta}/','ExcelAlicorpController@excelAlicorpRegularV10');
//-------------------- CP OSA BODEGAS -----------------------------------
Route::resource('excelAlicorpCpOsaBodegas/{company_id}/','ExcelAlicorpController@excelAlicorpCpOsaBodegas');

//-------------------- Excell Alicorp Helena premiación-----------------------------------

Route::resource('excelHelenaPremiacion/{company_id}/', 'ExcelAlicorpController@excelHelenaPremiacion');

//-------------------- Excell Alicorp Helena triada------------------------

Route::resource('excelHelenaTriada/{company_id}/', 'ExcelAlicorpController@excelAlicorpHelenaTriadaV2');

Route::resource('excelHelenaTriadaV3/{company_id}/', 'ExcelAlicorpController@excelAlicorpHelenaTriadaV3');
Route::resource('excelHelenaTriadaProductos/{company_id}/', 'ExcelAlicorpController@excelAlicorpHelenaTriadaProductV4');

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
Route::resource('ibkV5/{company_id}/', 'ExcelInterbankController@ibkV5');
Route::resource('ibkV6/{company_id}/{pag}/', 'ExcelInterbankController@ibkV6');
Route::resource('ibkV7/{company_id}/{pag}/', 'ExcelInterbankController@ibkV7');


//-------------------- Excell Palmera Sum-----------------------------------
Route::resource('storesAudit/{company_id}/', 'ExcelPalmeraSumController@storesAudit');
Route::resource('storesAuditV2/{company_id}/', 'ExcelPalmeraSumController@storesAuditV2');
Route::resource('palmeraNewStore/{ini}/{end}/', 'ExcelPalmeraSumController@palmeraNewStore');
Route::resource('storesTromePalmera/{ini}/{end}/', 'ExcelPalmeraSumController@storesTromePalmera');
Route::resource('storesTromeFaseDos/{company_id}/', 'ExcelPalmeraSumController@storesTromeFaseDos');

Route::resource('palmeraVentas/{company_id}/', 'ExcelPalmeraSumController@palmeraVentas');

Route::resource('coberturadex/{company_id}/', 'ExcelPalmeraSumController@coberturaDex');

Route::resource('proyectoHock/{company_id}/', 'ExcelPalmeraSumController@proyectoHock');



//-------------------- Excell Plan camisetas mojadas ----------------------------------
Route::resource('planCamiseta/{company_id}/', 'ExcelAlicorpController@planCamiseta');

//Alicorp OSA + SOD Mini Mayoristas Octubre
Route::resource('osa_sod_mayorista/{company_id}/', 'ExcelAlicorpController@osaSodMiniMayoristas');


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


Route::get('excelito',function (){
   Excel::create('report',function ($excel){

       $excel->sheet('Sheet1',function ($sheet){
          for($i=1; $i<=300; $i ++){
              $sheet->row($i, array('test1','test2','tes3','test4'));
          }
       });
   })->store('xlsx','public/excel/exports');

   return [
     'success' => true,
     'path' => 'http://' . Request::server('HTTP_HOST'). '/excel/exports/report.xlsx'
   ];
});

//Route::get('report/traderMarkReportPrueba', ['as' => 'traderMarkReport', 'uses' => 'ReportBayerController@traderMarkReportPrueba']);
Route::get('report/traderMarkReportPrueba', ['as' => 'traderMarkReport', 'uses' => 'PruebaController@traderMarkReportPrueba']);
Route::resource('pruebaHome','PruebaController@pruebaHome');
Route::resource('filtroPeriodos','PruebaController@filtroPeriodos');



//Excel Promotorialife

Route::resource('lifmodulocompra/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportLifeModCompra');
Route::resource('lifmodulovisita/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportLifeModVisitas');
Route::resource('lifmoduloinformacion/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportLifeModInformacion');

// ------------------- Mapa De rutas con zonas--------------------------------
Route::get('admin/roadsAuditZonas', ['as' => 'listAuditorAllZonas', 'uses' => 'MapRoadAuditorController@listAuditorAllZonas']);
Route::post('admin/roadsAuditMapZonas', ['as' => 'roadMapZonas', 'uses' => 'MapRoadAuditorController@roadMapZonas']);



Route::resource('pivoteGeneralPolls/{company_id}/{typeop}/', 'ExcellPivotController@excelPolls');
Route::resource('excelStoresAllCompany/{company_id}/', 'ExcellPivotController@excelStoresAllCompany');