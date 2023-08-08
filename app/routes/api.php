<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//--------------- API IMAP GMAIL-------------------------
//BEGIN
// Get obtiene todas las carpetas de GMAIL
Route::get('/showFoldersGmail', 'imap\ApiGmailController@getFolders');

//--------------- API IMAP GSUIT-------------------------
//BEGIN
// Get obtiene todas las carpetas de GSIUT
Route::get('/showFoldersGsuit', 'imap\ApiGmailGsuitController@getFolders');
Route::get('/showFolderGsuit/{folder}', 'imap\ApiGmailGsuitController@getFolder');
Route::get('/showSubDayPaginator/{subDay}/{perPage}/{page}', 'imap\ApiGmailGsuitController@getSubDayPaginator');
Route::get('/showMesage', 'imap\ApiGmailGsuitController@getMesage');


//--------------- API IMAP OUTLOOK-------------------------
// Get obtiene todas las carpetas de OUTLOOK
Route::get('/showFoldersOtlook', 'imap\ApiOutlookController@getFolders');



//PRUEBAS IMAP
Route::get('/showFolders', 'ImapController@getApiFull');
Route::get('/showMesagge/{uid}', 'ImapController@getApiMessageUID');





