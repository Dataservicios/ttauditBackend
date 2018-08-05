<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::post('getMechanics', ['as' => 'getMechanics', 'uses' => 'CanjeController@getMechanics']);
Route::post('getSwaps', ['as' => 'getSwaps', 'uses' => 'CanjeController@getSwaps']);
Route::post('saveCanjes', ['as' => 'saveCanjes', 'uses' => 'CanjeController@saveOperationSwap']);
Route::resource('excelCanjes/{company_id}/', 'ExcelController@canjesAlicorp');