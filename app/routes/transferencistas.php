<?php
//-------------------- Excell Alicorp Regular-----------------------------------

Route::get('searchOrders/{company_id}/{user_id}/', ['as' => 'searchOrders', 'uses' => 'ProspeccionBayerController@searchOrders']);
Route::post('searchOrdersResults', ['as' => 'searchOrdersResults', 'uses' => 'ProspeccionBayerController@getOrdersAuditors']);
Route::get('insertOrders/{company_id}/{user_id}/', ['as' => 'insertOrders', 'uses' => 'ProspeccionBayerController@insertOrders']);