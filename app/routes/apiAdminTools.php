<?php


Route::get('getAllCompanies', '\Api\AdminToolsController@getAllCompanies');

Route::post('loginMovilApp', ['as' => 'loginMovilApp', 'uses' => '\Api\AdminToolsController@loginMovilApp']);

