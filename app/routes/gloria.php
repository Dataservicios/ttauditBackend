<?php

//-------------------- Excell Gloria ----------------------------------
Route::resource('gloriaOrders/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportGloriaOrders');
Route::resource('gloriaGeneral/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportGeneralGloria');

//-------------------- Excell Alicorp Solutions ----------------------------------
Route::resource('alicorpSolutionsOrders/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAlicorpSolutionsOrders');
Route::resource('alicorpSolutionsProducts/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAlicorpSolutionsProducts');

//-------------------- Excell Angel ----------------------------------
Route::resource('angelStock/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAngelOrders');
Route::resource('angelVisibility/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAngelVisibility');

Route::resource('angelStock_v2/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAngelOrders_v2');
Route::resource('angelVisibility_v2/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAngelVisibility_v2');
Route::resource('angelVisibilityProduct_v2/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportAngelVisibility_product_v2');



//-------------------- Excell Gloria Bodegas----------------------------------
Route::resource('gBodegasPresentacion/{company_id}//', 'ExcelGloriaController@gBodegasPresentacion');
Route::resource('gBodegasAuditorias/{company_id}//', 'ExcelGloriaController@gBodegasAuditorias');


//-------------------- Excell Gloria gEjecucionAnaquel----------------------------------
Route::resource('gEjecucionAnaquel/{company_id}/', 'ExcelGloriaController@gEjecucionAnaquel');
Route::resource('gEjecucionVisicooler/{company_id}/', 'ExcelGloriaController@gEjecucionVisicooler');

Route::resource('gloriaMayoVisiVarios/{fecha1}/{fecha2}/', 'ExcelGeneralController@mayoristaGloriaVisibilidadVarios');
Route::resource('gloriaMayoVisiAnaquel/{fecha1}/{fecha2}/', 'ExcelGeneralController@mayoristaGloriaVisibilidadAnaquel');
Route::resource('gloriaMayoVisiExhibidores/{fecha1}/{fecha2}/', 'ExcelGeneralController@mayoristaGloriaVisibilidadExhibi');
Route::resource('gloriaMayoVisiVisicooler/{fecha1}/{fecha2}/', 'ExcelGeneralController@mayoristaGloriaVisibilidadVisicooler');
Route::resource('gloriaMayoVisiRumas/{fecha1}/{fecha2}/', 'ExcelGeneralController@mayoristaGloriaVisibilidadRumas');
Route::resource('palmeraOrders/{fecha1}/{fecha2}/', 'ExcelGeneralController@palmeraOrders');

Route::resource('reportCigarrerasProducts/{company}/{parte}/{fecha1}/{fecha2}/', 'ExcelGeneralController@reportCigarrerasProducts');