<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::get('getOrderDetailsAdmin/{company_id}/{store_id}/', ['as' => 'getOrderDetailsAdmin', 'uses' => 'OperationsController@getRoadDetails']);

//Operations Ajax
Route::post('ajaxDeletePhoto', ['as' => 'ajaxDeletePhoto', 'uses' => 'OperationsController@deletePhoto']);
Route::post('saveSOD', ['as' => 'saveSOD', 'uses' => 'OperationsController@saveSOD']);
Route::post('releasePointsInBlocks', ['as' => 'releasePointsInBlocks', 'uses' => 'OperationsController@releasePointsInBlocks']);
//End operations ajax

//operaciones
Route::get('admin/product/addProdRegStoreForCVS/{archivo}/{company_id}', ['as' => 'adminAuditPresences', 'uses' => 'OperationsController@addProdRegStoreForCVS']);
Route::get('admin/storeUpdate/{archivo}', ['as' => 'storeUpdateEjecutivo', 'uses' => 'OperationsController@updateEjecutivoStore']);
Route::get('admin/storeDelete/{archivo}', ['as' => 'storeDelete', 'uses' => 'OperationsController@deleteStoreCVS']);
Route::get('admin/deleteMedia/{media_id}/{type}', ['as' => 'deleteMedia', 'uses' => 'OperationsController@deleteFileMedia']);
//Fin Operaciones