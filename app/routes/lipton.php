<?php

//-------------------- Excell Lipton ----------------------------------
Route::resource('liptonV1/{company_id}/', 'ExcelLiptonController@liptonV1');
Route::resource('EncuestasV1/{company_id}/', 'ExcelLiptonController@liptonV2');
Route::resource('Alicorp_no_medidos/{company_id}/', 'ExcelLiptonController@Alicorp_no_medidos');