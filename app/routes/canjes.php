<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::post('getMechanics', ['as' => 'getMechanics', 'uses' => 'CanjeController@getMechanics']);
Route::post('getSwaps', ['as' => 'getSwaps', 'uses' => 'CanjeController@getSwaps']);
Route::post('saveCanjes', ['as' => 'saveCanjes', 'uses' => 'CanjeController@saveOperationSwap']);
Route::resource('excelCanjes/{company_id}/', 'ExcelController@canjesAlicorp');

//-------------------- Excell Alicorp Mistery ----------------------------------
Route::resource('alicorpMistery/{company_id}/{pag}/', 'ExcelControllerV2@misteryAlicorp');
Route::resource('alicorpHelenaEvaluacion/{company_id}/{pag}/', 'ExcelControllerV2@helenaEvaluacion');