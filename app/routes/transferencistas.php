<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::get('searchOrders/{company_id}/{user_id}/', ['as' => 'searchOrders', 'uses' => 'ProspeccionBayerController@searchOrders']);
Route::post('searchOrdersResults', ['as' => 'searchOrdersResults', 'uses' => 'ProspeccionBayerController@getOrdersAuditors']);
Route::get('SearchStoresVisits', ['as' => 'searchStoresVisits', 'uses' => 'ProspeccionBayerController@searchStoresVisits']);
Route::post('changeAniversarioStore', 'StoreController@updateAniversario');
Route::post('insertContactStore', 'UserController@insertContact');
Route::post('listContactStore', 'UserController@listContacts');
Route::post('insertUpdateCreditDistributor', 'UserController@insertCreditDistributor');
Route::post('listCreditsStore', 'UserController@listCreditDistributor');
Route::get('excelPreguntasBTTradicional/{company_id}/{visit_id}/{tipo}/{desde}/{hasta}', 'ExcelController@preguntasGeneralesTradicional');
Route::get('excelPreguntasBTOcultas/{company_id}/{visit_id}/{desde}/{hasta}', 'ExcelController@preguntasOcultasTradicional');

//V2 VISIBILIDAD bAYER
Route::get('excelVisibilidadBayerTransV2/{company_id}/{visit_id}/{regular}', 'ExcelControllerV2@visibilidadBayerTransV2');
Route::get('excelVisibilidadBayerTransV3/{company_id}/{visit_id}/{regular}', 'ExcelControllerV2@visibilidadBayerTransV3');

//ventas Bayer
Route::resource('ventasAuditBayer/{company_id}/{fecha1}/{fecha2}/', 'ExcelBayerController@excelVentasAuditBayer');