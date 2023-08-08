<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*Route::get('/', function()//
{
	return View::make('hello');
});*/
//Route::when('*', 'csrf', ['post']);

Route::get('/', ['as' => 'login', 'uses' => 'HomeController@login']);
Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('loginMovil', ['as' => 'loginMovil', 'uses' => 'AuthController@loginMovil']);
Route::post('ajaxGetPdvsForPollWithPhotos', ['as' => 'ajaxGetPdvsForPollWithPhotos', 'uses' => 'MediasController@ajaxGetResultsForAuditWithPhotos']);
Route::post('getPhone', ['as' => 'getPhone', 'uses' => 'PhoneDetailController@getPhone']);
Route::post('getPhoneForUser', ['as' => 'getPhoneForUser', 'uses' => 'PhoneDetailController@getPhoneForUser']);
Route::post('savePhoneDetails', 'PhoneDetailController@enterPhoneLocation');
Route::get('detailPhotoPublic/{company_id}/{audit_id}/{tipo}/{store_id}/{poll_id}', ['as' => 'detailPhotoPublic', 'uses' => 'ReportAlicorpController@getDetailMediasPublic']);

//ibkInventory start
Route::get('detailPhotoElementsIbk/{company_id}/{audit_id}/{tipo}/{store_id}/{poll_id}', ['as' => 'detailPhotoElementsIbk', 'uses' => 'InventoryIBKController@getDetailMediasPublic']);
Route::post('getCategoryProducts', ['as' => 'getCategoryProducts', 'uses' => 'InventoryIBKController@getCategoryProducts']);
Route::get('getPhotosInventory/{company_id?}/{store_id?}', ['as' => 'getPhotosInventory', 'uses' => 'InventoryIBKController@getPhotosInventory']);
Route::post('getPhotosInventoryFilter', ['as' => 'getPhotosInventoryFilter', 'uses' => 'InventoryIBKController@getPhotosInventory']);
Route::post('getCategoriesGeneral', ['as' => 'getCategoriesGeneral', 'uses' => 'InventoryIBKController@getCategoriesGeneral']);
//ibkInventory end

Route::post('insertPollPalmeras', ['as' => 'insertPollPalmeras', 'uses' => 'StoreController@insertPollStore']);
Route::post('insertCompanyStore', ['as' => 'insertCompanyStore', 'uses' => 'CompanyStoreController@insertCompanyStore']);
Route::post('duplicateStore', ['as' => 'duplicateStore', 'uses' => 'StoreController@duplicateStore']);
Route::post('ajaxGetRecomendSalesForProduct', ['as' => 'ajaxGetRecomendSalesForProduct', 'uses' => 'ReportBayerController@ajaxGetRecomendSalesForProduct']);
Route::post('listStoreAuditPalmeraNow', ['as' => 'listStoreAuditPalmeraNow', 'uses' => 'UserController@listStoreAuditPalmeraNow']);
Route::post('getJsonControlTime', ['as' => 'getJsonControlTime', 'uses' => 'AuditsController@getJsonControlTime']);
Route::post('getJsonLastDayControlTime', ['as' => 'getJsonLastDayControlTime', 'uses' => 'AuditsController@getJsonLastDayControlTime']);
Route::post('changeContactStore', 'StoreController@updateContact');
Route::post('changeAddressStore', 'StoreController@updateAddress');//updateGeoRef
Route::post('changeAddressNameStore', 'StoreController@updateAddressName');
Route::post('updatedGeoStore', 'StoreController@updateGeoRef');
Route::post('updateCodeSellStore', 'StoreController@updateCodeSellStore');
Route::get('testPrograming/{type}', ['as' => 'testPrograming', 'uses' => 'HomeController@testManagement']);
Route::post('ajaxGetVisitors', ['as' => 'ajaxGetVisitors', 'uses' => 'ReportBayerController@ajaxGetVisitors']);//Obtiene datos para grafico de visitantes
Route::post('ajaxGetRecomendSalesForSeller', ['as' => 'ajaxGetRecomendSalesForSeller', 'uses' => 'ReportBayerController@ajaxGetRecomendSalesForSeller']);
Route::post('ajaxGetResultQuestion', ['as' => 'ajaxGetResultQuestion', 'uses' => 'ReportBayerController@ajaxGetResultQuestion']);

Route::post('getCampaignesBayer', 'BrandHistoryBayerController@getCompaniesBayer');
Route::post('getCitiesForCampaigneAll', 'BrandHistoryBayerController@getCitiesForCampaigneAll');
Route::post('getClientsForCampaigneAll', 'BrandHistoryBayerController@getClientsForCampaigneAll');
Route::post('getEjecutivesForCampaigneAll', 'BrandHistoryBayerController@getEjecutivesForCampaigneAll');
Route::post('getClientForCityForType', 'BrandHistoryBayerController@getClientsForUbigeoType');
Route::post('getEjecutiveForCityForType', 'BrandHistoryBayerController@getEjecutivesForUbigeoType');
Route::post('getEjecutivesForUbigeoChanel', 'BrandHistoryBayerController@getEjecutivesForUbigeoChanel');
Route::post('getEjecutiveForCity', 'BrandHistoryBayerController@getEjecutivesForCity');
Route::post('getCompanyForProduct', 'BrandHistoryBayerController@getCompanyForProduct');
Route::post('getProducts', 'BrandHistoryBayerController@getProductsCampaigne');



//-------------------- Excell-----------------------------------
Route::resource('excel','ExcelController');
Route::resource('notificacionesIbk','ExcelController@alerts_ibk');
Route::resource('excelProductPriceCompetity','ExcelBayerController@productsPriceCompetity');
Route::get('excelPresenPopMercaBayer/{company_id}/{visit_id}/{tipo}', 'ExcelController@presencePopMercaderismoBayer');
Route::resource('excelPresenPopMercaBayer2', 'ExcelController@presencePopMercaderismoBayer2');
Route::get('excelPresenPopMercaBayerAASS/{company_id}/{visit_id}', 'ExcelController@presencePopMercaderismoBayerAASS');
Route::get('excelPresenPopMercaBayerCabe/{company_id}', 'ExcelController@presencePopMercaderismoBayerCabeceras');
Route::get('excelPresenPopMercaBayerComp/{company_id}', 'ExcelController@presencePopMercaderismoBayerCompetencia');
Route::get('excelOrdersBayerTrans/{company_id}', 'ExcelController@ordersBayerTransferencista');
Route::get('excelVisibilidadOriente/{company_id}', 'ExcelController@visibilidadOriente');
Route::get('excelVisibilidadBayerTrans/{company_id}/{visit_id}/{tipo}/{regular}', 'ExcelController@visibilidadBayerTrans');
Route::get('excelPreguntasBTCadenas/{company_id}/{visit_id}/{tipo}/{desde}/{hasta}', 'ExcelController@preguntasGeneralesCadenas');
Route::get('excelCompetenciasBayerTrans/{company_id}/{visit_id}/{tipo}', 'ExcelController@competenciasBayer');
Route::resource('visibilidadOrienteNewStore/{ini}/{end}/', 'ExcelController@visibilidadOrienteNewStore');
Route::resource('pedidsGalletasNewStore/{ini}/{end}/', 'ExcelController@ordersAlicorpGalletas');

require (__DIR__.'/routes/jaime.php');
require (__DIR__.'/routes/crearRutas.php');
require (__DIR__.'/routes/canjes.php');
require (__DIR__.'/routes/transferencistas.php');
require (__DIR__.'/routes/operationsadmin.php');
require (__DIR__.'/routes/alicorp.php');
require (__DIR__.'/routes/gloria.php');
require (__DIR__.'/routes/angel.php');
require (__DIR__.'/routes/lipton.php');

//Bayer Projectista rutas app
Route::post('getProjectsSales', ['as' => 'getProjectsSales', 'uses' => 'ProspeccionBayerController@getProjectionSales']);
Route::post('getPricesForProduct', ['as' => 'getPricesForProduct', 'uses' => 'ProspeccionBayerController@getPricesForProduct']);
Route::post('saveOrder', ['as' => 'saveOrder', 'uses' => 'ProspeccionBayerController@saveOrder']);
Route::post('updateStockMinMax', ['as' => 'updateStockMinMax', 'uses' => 'ProspeccionBayerController@updateStockMinMax']);
Route::post('getLaboratories', ['as' => 'getLaboratories', 'uses' => 'ProspeccionBayerController@getUsersTypeLaboratory']);
Route::post('getProviders', ['as' => 'getProviders', 'uses' => 'ProspeccionBayerController@getUsersTypeProvider']);
Route::post('admin/roadsAuditMapTest', ['as' => 'roadMapTest', 'uses' => 'MapRoadAuditorController@roadMapTest']);
Route::get('admin/roadsAuditTest', ['as' => 'listAuditorAllTest', 'uses' => 'MapRoadAuditorController@listAuditorAllTest']);
//End Bayer Projectista rutas app

//Alicorp Pre Venta
Route::post('ajaxGetProductsForCity', ['as' => 'ajaxGetProductsForCity', 'uses' => 'MercantilistaBayerController@productsForRegion']);
//End Alicorp Pre venta

//Create routings
Route::post('ajaxInsertRoutingVisits', ['as' => 'ajaxInsertRoutingVisits', 'uses' => 'RoadController@saveRouteVisits']);
//End Create routings

Route::post('insertRegPollDetailAll', ['as' => 'insertRegPollDetailAll', 'uses' => 'AuditsController@insertPollDetail']);
Route::post('insertRegPollDetailAllVisits', ['as' => 'insertRegPollDetailAllVisits', 'uses' => 'AuditsController@insertPollDetailVisits']);
//Mercaderismo Bayer Ajax
Route::post('ajaxGetPricesFound', ['as' => 'ajaxGetPricesFound', 'uses' => 'MercantilistaBayerController@getAjaxPricesOfProducts']);//web
Route::post('ajaxGetProductsCompetition', ['as' => 'ajaxGetProductsCompetition', 'uses' => 'MercantilistaBayerController@getProductsForCompetition']);
Route::post('ajaxGetProductsForCampaigneForType', ['as' => 'ajaxGetProductsForCampaigneForType', 'uses' => 'MercantilistaBayerController@getProductsForCampaigneForTypeStore']);
Route::post('ajaxGetRoadsDetail', ['as' => 'ajaxGetRoadsDetail', 'uses' => 'MercantilistaBayerController@getRoadsDetail']);
Route::post('ajaxGetVisits', ['as' => 'ajaxGetVisits', 'uses' => 'MercantilistaBayerController@getVisits']);
Route::post('ajaxGetCategoryProducts', ['as' => 'ajaxGetCategoryProducts', 'uses' => 'MercantilistaBayerController@getCategoryProduct']);
Route::post('ajaxGetStockForPublicity', ['as' => 'ajaxGetStockForPublicity', 'uses' => 'MercantilistaBayerController@getStockForPublicity']);
Route::post('ajaxGetStockForPublicityAll', ['as' => 'ajaxGetStockForPublicityAll', 'uses' => 'MercantilistaBayerController@getStockForPublicityAll']);
Route::post('ajaxGetHistoryPublicityForStore', ['as' => 'ajaxGetHistoryPublicityForStore', 'uses' => 'MercantilistaBayerController@getHistoryPublicityForStore']);
Route::post('getAjaxDetailQuestion', ['as' => 'getAjaxDetailQuestion', 'uses' => 'MercantilistaBayerController@getAjaxResponsesForQuestion']);//web
Route::post('ajaxGetPopBayer', ['as' => 'ajaxGetPopBayer', 'uses' => 'MercantilistaBayerController@getPublicitiesCampaigne']);//deprecated
Route::post('ajaxGetPopForBayer', ['as' => 'ajaxGetPopForBayer', 'uses' => 'ProspeccionBayerController@getPublicitiesForCampaigne']);
Route::post('saveRegisters', 'MercantilistaBayerController@saveRegistersBayerMercaderismo');
Route::post('getCategoryProductForType', ['as' => 'getCategoryProductForType', 'uses' => 'MercantilistaBayerController@getCategoryProductForType']);//web
Route::post('getProductsForCategoryMerca', ['as' => 'getProductsForCategoryMerca', 'uses' => 'MercantilistaBayerController@getProductsForCategory']);//web
Route::post('getClientsMercaForChanel', ['as' => 'getClientsMercaForChanel', 'uses' => 'MercantilistaBayerController@getClientsForChanel']);//web
Route::get('mercaderismo/getExcelsBayerMercaderismo/{company_id?}', ['as' => 'getExcelsMerca', 'uses' => 'MercantilistaBayerController@getExcels']);//web
Route::post('insertImagesMercaderista', 'MercantilistaBayerController@insertImagesMercaderista');
Route::post('insertHistoryPublicityStore', 'MercantilistaBayerController@insertHistoryPublicityStore');
Route::post('pruebasClass', 'MercantilistaBayerController@pruebasClass');
Route::post('getCampaignesMercaderismo', 'MercantilistaBayerController@getCompaniesMercaderismo');
Route::get('mercantilismo/{company_id}', ['as' => 'mercantelismo', 'uses' => 'MercantilistaBayerController@getPublicitiesCampaigne']);
Route::post('getCadenaRucForType', ['as' => 'getCadenaRucForType', 'uses' => 'MercantilistaBayerController@getCadenaRucForType']);//web
Route::post('sendAlertPlanningPop', 'MercantilistaBayerController@sendAlertPlanningPop');
//End Mercaderismo Bayer Ajax

//Ajax Brand History
Route::post('ajaxRecomendSalesForProductAll', ['as' => 'ajaxRecomendSalesForProductAll', 'uses' => 'BrandHistoryBayerController@getRecomendedForSalesForProductAll']);
Route::post('ajaxGetRecomendForLastCampaigne', ['as' => 'ajaxGetRecomendForLastCampaigne', 'uses' => 'BrandHistoryBayerController@getHistoryRecomendForLastCompany']);
//End Brand history

//Visibility History
Route::post('ajaxGetVisibilityHistory', ['as' => 'ajaxGetVisibilityHistory', 'uses' => 'VisibilityHistoryBayerController@getAjaxVisibilityHistory']);
//End Visibility History

//Ficticio History
Route::post('ajaxGetFicticioHistory', ['as' => 'ajaxGetFicticioHistory', 'uses' => 'HistoryFicticiosController@getAjaxHistoryFicticios']);
//End Ficticio History

//Prices history
Route::post('ajaxHistoryPrices', ['as' => 'ajaxHistoryPrices', 'uses' => 'HistoryPricesAndFashionController@getAjaxHistoryPrices']);

//Pop history
Route::post('ajaxHistoryPop', ['as' => 'ajaxHistoryPrices', 'uses' => 'HistoryPopController@getAjaxHistoryPop']);

//sistema Alerts
Route::post('ajxInsertCommentAlert', ['as' => 'ajxInsertCommentAlert', 'uses' => 'AlertsController@insertComment']);
Route::post('ajxLoadCommentAlert', ['as' => 'ajxLoadCommentAlert', 'uses' => 'AlertsController@ajxLoadComments']);
Route::post('admin/audits/medias/detailPhotoFilter', ['as' => 'mediaDetailPhotofilter', 'uses' => 'MediasController@detailPhoto']);
Route::post('admin/audits/medias/detailPhotoFilterVisits', ['as' => 'mediaDetailPhotofilterVisits', 'uses' => 'MediasController@detailPhotoVisits']);

Route::group(['before'=>'auth'], function(){

    Route::get('selectStudies/{customer_id}', ['as' => 'selectStudies', 'uses' => 'HomeController@getCurrentStudies']);//web

    //system prospeccion
    Route::get('transferencista/resumeHome/{company_id?}/{url?}', ['as' => 'transResume', 'uses' => 'ProspeccionBayerController@resumeHome']);//web
    Route::get('transferencista/getExcels/{company_id?}', ['as' => 'getExcelsTransf', 'uses' => 'ProspeccionBayerController@getExcels']);//web
    Route::get('getRoadsTransferencista/{company_id}', ['as' => 'getRoadsTransf', 'uses' => 'ProspeccionBayerController@getRoadsForCampaigne']);
    Route::get('transferencista/detallePopEncontrado/{company_id?}/{url?}', ['as' => 'detailPopEncontradoTransf', 'uses' => 'ProspeccionBayerController@getDetailPopEncontrado']);//web
    Route::post('detailPopEncontradoFilter', ['as' => 'detailPopEncontradoFilter', 'uses' => 'ProspeccionBayerController@getDetailPopEncontrado']);//web
    Route::get('getDetailQuestionBayerTransferencista/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}', ['as' => 'getDetailQuestionBayerTrans', 'uses' => 'ProspeccionBayerController@getDetailQuestion']);
    //end system prospeccion

    //Sistema Bayer Mercaderismo
    Route::get('mercaderismo/resumeHome/{company_id?}/{url?}', ['as' => 'mercaResume', 'uses' => 'MercantilistaBayerController@resumeHome']);//web
    Route::get('mercaderismo/popCompetencia/{company_id?}/{url?}', ['as' => 'popCompetencia', 'uses' => 'MercantilistaBayerController@popCompetencia']);//web
    Route::get('mercaderismo/detallePopEncontrado/{company_id?}/{url?}', ['as' => 'detailPopEncontrado', 'uses' => 'MercantilistaBayerController@getDetailPopEncontrado']);//web
    Route::post('detallePopEncontradoFilter', ['as' => 'detallePopEncontradoFilter', 'uses' => 'MercantilistaBayerController@getDetailPopEncontrado']);//web
    Route::get('productsCompetition/{company_id}/{competition}', ['as' => 'productsCompetition', 'uses' => 'MercantilistaBayerController@getProductsForCompetition']);
    Route::get('getRoadsMercaderismo/{company_id}', ['as' => 'getRoadsMerca', 'uses' => 'MercantilistaBayerController@getRoadsForCampaigne']);
    Route::get('getDetailRoadForMercadersimo/{road_id}/{company_id}', ['as' => 'getDetailRoadForMerca', 'uses' => 'MercantilistaBayerController@getDetailRoad']);
    Route::get('getDetailQuestionBayerMercaderismo/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}', ['as' => 'getDetailQuestionBayerMerc', 'uses' => 'MercantilistaBayerController@getDetailQuestion']);
    Route::get('mercaderismo/foundPrices/{company_id?}/{url?}', ['as' => 'foundPrices', 'uses' => 'MercantilistaBayerController@getPricesOfProductsFound']);//web
//End Sistema Bayer Mercaderismo

//Prices History
    Route::get('mercaderismo/historyPrices', ['as' => 'historyPrices', 'uses' => 'HistoryPricesAndFashionController@homeHistoryAverageAndFashion']);//web
//End Prices history

    //History Pop
    Route::get('mercaderismo/historyPop', ['as' => 'historyPop', 'uses' => 'HistoryPopController@homeHistoryPop']);//web
//End history Pop

    //Brand History
    Route::get('brandHistory', ['as' => 'homeBrandHistory', 'uses' => 'BrandHistoryBayerController@homeBrandHistory']);
    Route::get('brandHistory/detail/{tipo}', ['as' => 'detailBrandHistory', 'uses' => 'BrandHistoryBayerController@detailBrandHistory']);
    Route::get('brandHistoryLastCampaigne', ['as' => 'lastBrandHistory', 'uses' => 'BrandHistoryBayerController@lastCampaigneHome']);
    //End Brand History

    //Visibility History
    Route::get('visibilityHistory', ['as' => 'visibilityHistory', 'uses' => 'VisibilityHistoryBayerController@visibilityHomeHistory']);
    //End Visibility History

    //Ficticio History
    Route::get('mercaderismo/ficticioHistory', ['as' => 'ficticioHistory', 'uses' => 'HistoryFicticiosController@homeHistoryFicticios']);
    //End Ficticio History

    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
    Route::get('report', ['as' => 'report', 'uses' => 'ReportController@reportHome']);
    Route::post('report/Filter', ['as' => 'reportFilter', 'uses' => 'ReportController@reportHome']);
    Route::get('report/getRoadForIbk/{company_id}', ['as' => 'getRoadForIbk', 'uses' => 'ReportController@getRoadsForCampaigne']);
    Route::get('report/getDetailRoadForIbk/{road_id}/{company_id}', ['as' => 'getDetailRoadForIbk', 'uses' => 'ReportController@getDetailRoad']);
    Route::get('report/audit/{id}', ['as' => 'reportAudit', 'uses' => 'ReportController@audit']);//temporal
    Route::get('report/excel', ['as' => 'reportExcel', 'uses' => 'ReportController@reportExcel']);
    Route::get('report/auditReport/{id}/{store_id?}', ['as' => 'auditReport', 'uses' => 'ReportController@auditReportAbstract']);
    Route::post('report/auditReportFilter', ['as' => 'auditReportFilter', 'uses' => 'ReportController@auditReportAbstract']);
    Route::get('report/reportAudios/{empresa}', ['as' => 'reportAudios', 'uses' => 'ReportController@reportAudios']);
    Route::get('report/getDetailResultQuestion/{poll_id}/{values}/{poll_option_id?}', ['as' => 'getDetailResultQuestion', 'uses' => 'ReportController@getDetailResultQuestion']);
    Route::post('report/comparationStudies', ['as' => 'comparationStudies', 'uses' => 'ReportController@comparationCampaigns']);
    Route::get('report/comparationCampaignsLink/{audit_id}/{campaigns}/{company_id}', ['as' => 'comparationCampaignsLink', 'uses' => 'ReportController@comparationCampaignsLink']);
    Route::post('report/compCampaignsLinkFilter', ['as' => 'compCampaignsLinkFilter', 'uses' => 'ReportController@compCampaignsLinkFilter']);
    Route::post('report/homeComparationStudies', ['as' => 'homeComparationStudies', 'uses' => 'ReportController@homeComparationCampaigns']);
    Route::post('report/homeComparationFilter', ['as' => 'homeComparationFilter', 'uses' => 'ReportController@homeCompCampaignsFilter']);
    Route::get('report/homeComparationStudiesLink/{audit_id}/{campaigns}/{company_id}', ['as' => 'homeComparationStudiesLink', 'uses' => 'ReportController@homeComparationCampaignsLink']);
    Route::get('reportColgate', ['as' => 'reportColgate', 'uses' => 'ReportColgateController@reportHome']);
    Route::get('report/auditsColgate/{audit_id}/{company_id}', ['as' => 'auditReportColgate', 'uses' => 'ReportColgateController@auditReportAbstract']);
    Route::get('report/auditsCategoryColgate/{audit_id}/{company_id}/{category_id}', ['as' => 'auditReportCategoryColgate', 'uses' => 'ReportColgateController@auditReportForCategory']);
    Route::post('report/auditsCategoryColgateFilter', ['as' => 'auditReportCategoryColgateFilter', 'uses' => 'ReportColgateController@auditReportForCategory']);
    Route::post('report/auditsColgateFilter', ['as' => 'auditReportColgateFilter', 'uses' => 'ReportColgateController@auditReportAbstract']);
    Route::get('report/auditPublicity/detailCondition/{condition}/{tipo}/{publicity_id}/{company_id}/{category_id}', ['as' => 'auditDetailConditionPublicity', 'uses' => 'ReportColgateController@getDetailConditionPublicity']);
    Route::get('reportBayer/{company_id?}/{url?}/{cat?}', ['as' => 'reportBayer', 'uses' => 'ReportBayerController@reportHome']);
    Route::post('reportBayer/Filter', ['as' => 'reportBayerFilter', 'uses' => 'ReportBayerController@reportHome']);
    Route::get('report/auditsBayer/{audit_id}/{company_id}/{subopcion?}', ['as' => 'auditReportBayer', 'uses' => 'ReportBayerController@auditReportAbstract']);
    Route::post('report/auditsBayerFilter', ['as' => 'auditsBayerFilter', 'uses' => 'ReportBayerController@auditReportAbstract']);
    Route::get('report/getDetailQuestionBayer/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}', ['as' => 'getDetailQuestionBayer', 'uses' => 'ReportBayerController@getDetailQuestionBayer']);
    Route::get('report/getDetailWinnersBayer/{poll_id}/{values}/{company_id}/{aleatorio?}', ['as' => 'getDetailWinnersBayer', 'uses' => 'ReportBayerController@getDetailWinnersBayer']);
    Route::get('report/getRoadForBayer/{company_id}', ['as' => 'getRoadForBayer', 'uses' => 'ReportBayerController@getRoadsForCampaigne']);
    Route::get('report/getDetailRoadForBayer/{road_id}/{company_id}', ['as' => 'getDetailRoadForBayer', 'uses' => 'ReportBayerController@getDetailRoad']);
    Route::get('reportAlicorp/{company_id?}/{url?}', ['as' => 'reportAlicorp', 'uses' => 'ReportAlicorpController@reportHome']);
    Route::post('reportAlicorpFilter', ['as' => 'reportAlicorpFilter', 'uses' => 'ReportAlicorpController@reportHome']);
    Route::get('report/getDetailQuestionAlicorp/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}', ['as' => 'getDetailQuestionAlicorp', 'uses' => 'ReportAlicorpController@getDetailQuestionAlicorp']);
    Route::get('report/auditsCategoryAlicorp/{audit_id}/{company_id}', ['as' => 'auditReportCategoryAlicorp', 'uses' => 'ReportAlicorpController@auditReportForCategory']);
    Route::post('report/auditsCategoryAlicorpFilter', ['as' => 'auditReportCategoryAlicorpFilter', 'uses' => 'ReportAlicorpController@auditReportForCategory']);
    Route::get('report/getRoadForAlicorp/{company_id}', ['as' => 'getRoadForAlicorp', 'uses' => 'ReportAlicorpController@getRoadsForCampaigne']);
    Route::get('report/getDetailRoadForAlicorp/{road_id}/{company_id}', ['as' => 'getDetailRoadForAlicorp', 'uses' => 'ReportAlicorpController@getDetailRoad']);
    Route::get('report/excelAlicorpBodegas/{company_id}/{audit_id}', ['as' => 'excelAlicorpBodegas', 'uses' => 'ReportAlicorpController@excelAlicorpBodegas']);
    Route::get('report/getDetailPublicitiesAlicorp/{publicity_id}/{values}/{condition}/{company_id}', ['as' => 'getDetailPublicitiesAlicorp', 'uses' => 'ReportAlicorpController@getDetailPublicitiesCondition']);
    Route::get('report/getSellersCampaigne/{customer_id}/{products_id}/{cadena?}', ['as' => 'getSellersCampaigne', 'uses' => 'ReportBayerController@homeComparationSellerCampaigns']);
    Route::post('report/getSellersCampaigneFilter', ['as' => 'getSellersCampaigneFilter', 'uses' => 'ReportBayerController@homeComparationSellerCampaigns']);
    Route::get('report/traderMarkReport/{customer_id}/{ejecutivo_id}/{cadena?}/{horizontal?}/{ubigeo?}', ['as' => 'traderMarkReport', 'uses' => 'ReportBayerController@traderMarkReport']);
    Route::post('report/traderMarkFilter', ['as' => 'traderMarkFilter', 'uses' => 'ReportBayerController@traderMarkReport']);

    Route::get('report/photoGallery/{customer_id}', ['as' => 'photoGallery', 'uses' => 'MediasController@photoGallery']);
    Route::get('report/visitasBayer', ['as' => 'visitasBayer', 'uses' => 'ReportBayerController@visitors']);

    //sistema Alerts
    Route::get('report/listAlerts/{customer_id}', ['as' => 'listAlerts', 'uses' => 'AlertsController@getLastAlerts']);
    Route::get('report/alertDetail/{alert_id}', ['as' => 'alertDetail', 'uses' => 'AlertsController@alertDetail']);

    Route::get('auditor/{opcion?}', ['as' => 'auditor', 'uses' => 'AuditorsController@auditorHome']);
    Route::get('auditor/client/{id}/{opcion?}', ['as' => 'auditorClient', 'uses' => 'AuditorsController@auditorHome']);
    Route::post('auditor/insertPhotos', ['as' => 'auditorInsertPhotos', 'uses' => 'AuditorsController@insertPhotos']);
    Route::get('auditor/detailPollPhoto/{id}/{company_id}/{opcion?}', ['as' => 'detailPollPhoto', 'uses' => 'AuditorsController@detailPollPhoto']);
    Route::get('auditor/getPhotoPollStore/{store_id}/{poll_id}/{opcion?}', ['as' => 'getPhotoPollStore', 'uses' => 'AuditorsController@getPhotoPollStore']);
    Route::get('auditor/responsePoll/{company_id}/{audit_id}/{store_id}/{opcion?}', ['as' => 'responsePoll', 'uses' => 'PollController@responsePoll']);
    Route::post('auditor/insertResponsePoll', ['as' => 'insertResponsePoll', 'uses' => 'PollController@insertResponsePoll']);

    Route::get('admin/panel', ['as' => 'admin', 'uses' => 'UserController@listUsers']);
    Route::get('admin/excelCompanies/{company_id}/{audit_id}', ['as' => 'excelCompanies', 'uses' => 'AuditsController@excelCompanies']);
    Route::get('admin/routes', ['as' => 'newRoute', 'uses' => 'StoreController@newRoute']);
    Route::get('admin/operationsGroup', ['as' => 'operationsGroup', 'uses' => 'ReportController@operationsGroup']);//temporal actualiza BD
    Route::get('admin/categoryProduct/{id}', ['as' => 'category', 'uses' => 'CategoryProductController@category']);
    Route::get('admin/product/{id}', ['as' => 'product', 'uses' => 'ProductController@show']);

    Route::get('admin/companyProduct/{id}', ['as' => 'company', 'uses' => 'CompanyController@products']);
    Route::get('admin/latestProducts', ['as' => 'latestProducts', 'uses' => 'ProductController@last']);
    Route::get('admin/sign-up', ['as' => 'sign_up', 'uses' => 'UserController@signUp']);
    Route::post('admin/sign-up', ['as' => 'register', 'uses' => 'UserController@register']);
    Route::get('admin/account', ['as' => 'account', 'uses' => 'UserController@account']);
    Route::put('admin/account', ['as' => 'update_account', 'uses' => 'UserController@updateAccount']);
    Route::get('admin/profile', ['as' => 'profile', 'uses' => 'UserController@profile']);
    Route::put('admin/profile', ['as' => 'update_profile', 'uses' => 'UserController@updateProfile']);
    Route::get('admin/userEdit/{id}', ['as' => 'userEdit', 'uses' => 'UserController@user']);
    Route::put('admin/userEdit/{id}', ['as' => 'update_user', 'uses' => 'UserController@updateUser']);
    Route::delete('admin/user/{id}', ['as' => 'admin.users.destroy', 'uses' => 'UserController@destroy']);
    Route::get('admin/companies', ['as' => 'listCompanies', 'uses' => 'CompanyController@listCompanies']);
    Route::get('admin/newCompany', ['as' => 'newCompany', 'uses' => 'CompanyController@newCompany']);
    Route::post('admin/newCompany', ['as' => 'registerCompany', 'uses' => 'CompanyController@register']);
    Route::get('admin/stores', ['as' => 'listStores', 'uses' => 'StoreController@listStores']);
    Route::get('admin/store/{id}', ['as' => 'storeDetail', 'uses' => 'StoreController@show']);
    Route::get('admin/storeEdit/{id}', ['as' => 'storeEdit', 'uses' => 'StoreController@store']);

    Route::put('admin/storeUpdate/{id}', ['as' => 'storeUpdate', 'uses' => 'StoreController@updateStore']);
    Route::get('admin/newStore', ['as' => 'newStore', 'uses' => 'StoreController@newStore']);
    Route::post('admin/newStore', ['as' => 'registerStore', 'uses' => 'StoreController@registerStore']);
    Route::get('admin/importStore', ['as' => 'importStore', 'uses' => 'StoreController@importStore']);
    Route::get('admin/insertSpace', ['as' => 'insertSpace', 'uses' => 'SpaceController@insertSpace']);
    Route::post('admin/insertSpace', ['as' => 'insertSpace', 'uses' => 'SpaceController@registerSpace']);
    Route::get('admin/auditSpaces', ['as' => 'auditSpaces', 'uses' => 'SpaceController@listSpacesTotal']);
    Route::post('admin/listSpaceForCompany', ['as' => 'listSpaceForCompany', 'uses' => 'SpaceController@listSpacesForCompany']);
    Route::get('admin/spaceDetail/{id}', ['as' => 'spaceDetail', 'uses' => 'SpaceDetailController@resultSpaceAuditor']);
    Route::get('admin/insertPoll', ['as' => 'insertPoll', 'uses' => 'PollController@insertPoll']);
    Route::post('admin/insertPoll', ['as' => 'insertPoll', 'uses' => 'PollController@registerPoll']);
    Route::get('admin/roads', ['as' => 'listRoads', 'uses' => 'RoadController@listRoads']);
    Route::post('admin/roadsFilter', ['as' => 'roadsFilter', 'uses' => 'RoadController@listRoads']);
    Route::get('admin/road/{id}', ['as' => 'roadDetail', 'uses' => 'RoadController@show']);
    Route::get('admin/addAgentRoad/{road_id}/{agent_id}/{company_id}', ['as' => 'addAgentRoad', 'uses' => 'RoadController@addAgentRoad']);
    Route::delete('admin/deleteRoad/{id}', ['as' => 'admin.road.destroy', 'uses' => 'RoadController@deleteRoute']);
    Route::delete('admin/deleteAgentRoad/{id}', ['as' => 'admin.agent.road.destroy', 'uses' => 'RoadController@deleteAgentRoute']);
    Route::get('admin/audits/home', ['as' => 'auditsHome', 'uses' => 'AuditsController@HomeAudits']);
    Route::get('admin/audits/monitoreo', ['as' => 'auditsMonitoreo', 'uses' => 'AuditsController@Monitoreo']);
    Route::get('admin/audits/CampaignforCustomer/{customer_id}', ['as' => 'CampaignForCustomer', 'uses' => 'AuditsController@HomeCampaignForCustomer']);
    Route::get('admin/audits/Campaign/{campaign_id}', ['as' => 'auditsForCampaign', 'uses' => 'AuditsController@auditsForCampaign']);
    Route::get('admin/audits/list/{audit_id}/{campaign_id}/{opcion?}', ['as' => 'auditListStoresForAudit', 'uses' => 'AuditsController@ListStoresForAudit']);
    Route::post('admin/audits/listStoresPublicity', ['as' => 'listStoresPublicity', 'uses' => 'AuditsController@ListStoresPublicity']);
    Route::get('admin/audits/getListStoresPublicity/{ciudad}/{publicity_id}/{auditor_id}/{audit_id}/{company_id}/{ventana?}/{trabajada?}', ['as' => 'getListStoresPublicity', 'uses' => 'AuditsController@ListStoresPublicity']);
    Route::get('admin/audits/detailsPublicitySod/{campaign_id}/{audit_id}/{store_id}/{publicity_id}/{foto}/{publicity_detail_id}/{ciudad?}/{auditor?}', ['as' => 'detailsPublicitySod', 'uses' => 'AuditsController@detailsPublicitySod']);
    Route::get('admin/audits/detail/{audit_id}/{campaign_id}/{store_id}', ['as' => 'auditDetailForStore', 'uses' => 'AuditsController@DetailAudit']);
    Route::get('admin/audits/Presences/{id}/{store_id?}', ['as' => 'adminAuditPresences', 'uses' => 'ReportColgateController@getCountForPresenceDetail']);
    Route::get('admin/audits/medias/{campaign_id}', ['as' => 'mediasHome', 'uses' => 'MediasController@mediasHome']);
    Route::get('admin/audits/medias/detailPhoto/{company_id}/{audit_id}/{tipo}/{id}/{store_id}/{cliente?}/{info?}', ['as' => 'mediaDetailPhoto', 'uses' => 'MediasController@detailPhoto']);

    Route::post('admin/audits/medias/insertPhotos', ['as' => 'mediaInsertPhotos', 'uses' => 'MediasController@insertPhotos']);
    Route::post('admin/audits/pollDetails/updateReg', ['as' => 'updateRegPollDetail', 'uses' => 'AuditsController@updatePollDetails']);
    Route::post('admin/audits/pollDetails/updateRegAll', ['as' => 'updateRegPollDetailAll', 'uses' => 'AuditsController@updatePollDetailsAll']);
    Route::post('admin/audits/pollDetails/updateRegAllVisits', ['as' => 'updateRegPollDetailAllVisits', 'uses' => 'AuditsController@updatePollDetailsAllVisits']);
    Route::post('girarFotos', ['as' => 'girarFotos', 'uses' => 'MediasController@girarFoto']);
    Route::post('admin/audits/pollDetails/deleteAllOptions', ['as' => 'deleteAllOptions', 'uses' => 'AuditsController@deleteAllOptions']);
    Route::post('admin/audits/pollDetails/deleteAllOptionsVisits', ['as' => 'deleteAllOptionsVisits', 'uses' => 'AuditsController@deleteAllOptionsVisits']);
    Route::post('admin/audits/pollDetails/insertRegOptionDetailAll', ['as' => 'insertRegPollOptionDetailAll', 'uses' => 'AuditsController@insertOptions']);
    Route::post('admin/audits/pollDetails/insertRegOptionDetailAllVisits', ['as' => 'insertRegPollOptionDetailAllVisits', 'uses' => 'AuditsController@insertOptionsVisits']);

    Route::get('admin/trackingOffline/{auditor?}/{company_id?}/{ubigeo?}', ['as' => 'trackingOffline', 'uses' => 'AuditsController@trackingOffline']);
    Route::post('trackingOfflineFilter', ['as' => 'trackingOfflineFilter', 'uses' => 'AuditsController@trackingOffline']);
    Route::get('admin/trackingOnline/{auditor?}', ['as' => 'trackingOnline', 'uses' => 'AuditsController@trackingOnline']);
    Route::post('trackingOnlineFilter', ['as' => 'trackingOnlineFilter', 'uses' => 'AuditsController@trackingOnline']);
    Route::get('admin/closedPoints', ['as' => 'closedPoints', 'uses' => 'AuditsController@closedPoints']);



    Route::post('deleteRegsAll', ['as' => 'deleteRegsAll', 'uses' => 'AuditsController@delRegister']);

    //    *********jaime ***************
    Route::post('admin/audits/pollDetails/updatePollOptionsDetails', ['as' => 'updatePollOptionsDetails', 'uses' => 'AuditsController@updatePollOptionsDetails']);
    ///*************end jaime *************
    Route::get('admin/audits/getDetailQuestion/{poll_id}/{values}/{company_id}/{poll_option_id?}/{product_id?}/{publicity_id?}/{audit_id?}/{auditor_id?}', ['as' => 'getDetailQuestionAdmin', 'uses' => 'AuditsController@getDetailQuestion']);
    Route::get('admin/audits/getDetailPublicitiesAlicorp/{publicity_id}/{values}/{condition}/{company_id}', ['as' => 'getAdminDetailPublicitiesAlicorp', 'uses' => 'AuditsController@getDetailPublicitiesCondition']);
    Route::get('admin/audits/getDetailsPhotosForQuestion/{company_id}', ['as' => 'getDetailsPhotosForQuestion', 'uses' => 'MediasController@getDetailsPhotosForQuestions']);
    
    

    Route::get('report/auditReportVisibilidad/{id}/{store_id?}', ['as' => 'auditReportVisibilidad', 'uses' => 'ReportColgateController@getCountForPublicitiesDetail']);
    Route::get('report/detailPresencia/{id}/{audit_id}', ['as' => 'DetailPresencia', 'uses' => 'ReportColgateController@detailPresenceDetailForPresence']);
    Route::get('report/detailPublicidad/{id}/{audit_id}', ['as' => 'DetailPublicidad', 'uses' => 'ReportColgateController@detailPublicityDetailForPublicity']);
});

    Route::get('getCategoryForCompany', ['as' => 'getCategoryForCompany', 'uses' => 'CompanyController@getCategoryForCompany']);

Route::get('/listaCompany',
    [
        'as' => 'lista',
        'uses' => 'PruebasController@ListCompanies'
    ]);



// Get lista de actegoriasajax
Route::get('/listaCompanyAjax',
    [
        'uses'  => 'PruebasController@ListCompaniesAjax',
        'as'    => 'ajax'
    ]
);




    Route::get('storeMap', ['as' =>'storeMap', function(){
        /*$mytime = Carbon\Carbon::now();
        dd($mytime->toDateTimeString());*/
    $id = Input::get('id');
    $stores = Auditor\Entities\Store::where('id', '=',  $id)->take(20)->get();
    //dd($stores);
    return Response::json($stores);
}]);
Route::post('loginUser', ['as' =>'loginUser', function(){

    $data = Input::only('username', 'password');

    $credentials = ['email' => $data['username'], 'password' => $data['password']];

    if (Auth::attempt($credentials))
    {
        //return '{"success":1,"message":"Login ok!","id":'.Auth::id().',"fullname":""'.Auth::user()->fullname.'}';
        return \Response::json([ 'success'=> 1, 'message' => "Login ok!", 'id'=> Auth::id(), 'fullname'=> Auth::user()->fullname]);
    }else{
        //return '{"success":0,"message":"Login error!"}';
        return \Response::json([ 'success'=> 0, 'message' => "Login error!", 'id'=> 0, 'fullname'=> ""]);
    }

}]);

Route::post('JsonRoadsTotal', ['as' =>'JsonRoadsTotal', function(){

    $id = Input::only('id');
    $company_id = Input::only('company_id');
// -- CONSULTA DE FRANCO
//    $sql = "SELECT
//  COUNT(`roads_resume`.`road_id`) AS `pdvs`,
//  `roads_resume`.`road_id` as id,
//  SUM(`roads_resume`.`audit`) AS `auditados`,
//  `roads_resume`.`road` as fullname
//FROM
//  `roads_resume`
//WHERE
//  `roads_resume`.`company_id` = '".$company_id['company_id']."' AND
//  `roads_resume`.`user_id` = '".$id['id']."' and
//  `roads_resume`.`type_road` = '0'
//GROUP BY
//  `roads_resume`.`road_id`,
//  `roads_resume`.`user_id`,
//  `roads_resume`.`road`,
//  `roads_resume`.`auditor`,
//  `roads_resume`.`company_id`";

// -- FIN CONSULTA DE FRANCO


    $sql = "SELECT 
            count(`road_details`.`store_id`) AS `pdvs`,
              `roads`.`id`,
            
              SUM(`road_details`.`audit`) AS `auditados`,
              `roads`.`fullname`
            FROM
              `road_details`
              LEFT OUTER JOIN `roads` ON (`road_details`.`road_id` = `roads`.`id`)
            WHERE
              `road_details`.`company_id` = '".$company_id['company_id']."'  AND 
              `roads`.`user_id` =  '".$id['id']."' 
            GROUP BY
              `roads`.`id`,
              `roads`.`fullname`";

    $consulta=DB::select($sql);
    if(sizeof($consulta) > 0) {

        foreach ($consulta as $v) {
            //$auditado = $v->auditados;
            //dd($auditado);
            if ($v->pdvs <> $v->auditados)
            {
                $success = 1;
                $valores[] = $v;
            }
        }
    }
    else {
        $valores = [];
        $success =  0 ;
    }
    return \Response::json([ 'success'=>$success ,"roads" => $valores]);
}]);


Route::post('JsonRoadsZone', ['as' =>'JsonRoadsZone', function(){

    $id = Input::only('id');
    $company_id = Input::only('company_id');
    $sql = "SELECT 
r.*,
IF(total IS NULL,0,total) pdvs,
IF(auditados IS NULL,0,auditados) auditados
FROM roads r 
left outer join
(
	select road_id, count(1) total , sum(audit) auditados
	from road_details
	group by road_id
) road_details
on (r.id = road_details.road_id)
where user_id= '".$id['id']."' and company_id= '".$company_id['company_id']."' 
and type = 1
and ( total <> auditados or total is null)";

    $consulta=DB::select($sql);

    return \Response::json([ 'success'=>1 ,"roads" => $consulta]);
}]);

Route::post('JsonRoadsAlicorpMayorista', ['as' =>'JsonRoadsAlicorpMayorista', function(){

    $id = Input::only('id');
    $company_id = Input::only('company_id');
    $nivel = Input::only('nivel');

    $sql="SELECT
  COUNT(`roads_resume`.`road_id`) AS `pdvs`,
  SUM(`roads_resume`.`audit`) AS `auditados`
FROM
  `roads_resume`
WHERE
  `roads_resume`.`company_id` = '".$company_id['company_id'] ."' AND
  `roads_resume`.`road_id` = '".$id['id']."' and 
  `roads_resume`.`nivel` = '".$nivel['nivel']."'
GROUP BY
  `roads_resume`.`road_id`,
  `roads_resume`.`user_id`,
  `roads_resume`.`road`,
  `roads_resume`.`auditor`,
  `roads_resume`.`company_id`";
    $consulta1 = DB::select($sql);

    $sql="SELECT store_id as id,cadenaRuc,type,fullname,region,tipo_bodega,address,district,audit as status, comment, codclient
FROM roads_resume r where company_id='".$company_id['company_id'] ."' and road_id='".$id['id']."' and  nivel = '".$nivel['nivel']."'";

    return \Response::json([ 'success'=> 1,"pdvs" => $consulta1[0]->pdvs,"auditados" => $consulta1[0]->auditados, "roadsDetail" => DB::select($sql)]);
}]);

Route::post('JsonRoadsBayerCertificados', ['as' =>'JsonRoadsBayerCertificados', function(){

    $id = Input::only('id');
    $company_id = Input::only('company_id');
    $nivel = Input::only('nivel');
    $padre = Input::only('padre');

    $sql="SELECT 
  COUNT(`roads_resume`.`road_id`) AS `pdvs`,
  SUM(`roads_resume`.`audit`) AS `auditados`
FROM
  `market_details`
  INNER JOIN `stores` ON (`market_details`.`point_id` = `stores`.`id`)
  INNER JOIN `roads_resume` ON (`stores`.`id` = `roads_resume`.`store_id`)
WHERE
  `roads_resume`.`road_id` = '".$id['id']."' AND 
  `roads_resume`.`nivel` = '".$nivel['nivel']."' AND 
  `roads_resume`.`company_id` = '".$company_id['company_id'] ."' AND 
  market_details.store_id = '".$padre['padre'] ."'";
    $consulta1 = DB::select($sql);

    $sql="SELECT
  `stores`.`id`,
  `stores`.`cadenaRuc`,
  `stores`.`fullname`,
  `stores`.`type`,
`stores`.`region`,
`stores`.`tipo_bodega`,
  `stores`.`address`,
  `stores`.`district`,
  `stores`.`codclient`,
  `stores`.`comment`,
  `roads_resume`.`audit` as status
FROM
  `stores`
  INNER JOIN `roads_resume` ON (`stores`.`id` = `roads_resume`.`store_id`)
  INNER JOIN `market_details` ON (`stores`.`id` = `market_details`.`point_id`)
WHERE
  `market_details`.`store_id` = '".$padre['padre']."'";

    return \Response::json([ 'success'=> 1,"pdvs" => $consulta1[0]->pdvs,"auditados" => $consulta1[0]->auditados, "roadsDetail" => DB::select($sql)]);
}]);

Route::post('JsonRoadsDetail', ['as' =>'JsonRoadsDetail', function(){

    $id = Input::only('id');
    $company_id = Input::only('company_id');

    $sql="SELECT
  COUNT(`roads_resume`.`road_id`) AS `pdvs`,
  SUM(`roads_resume`.`audit`) AS `auditados`
FROM
  `roads_resume`
WHERE
  `roads_resume`.`company_id` = '".$company_id['company_id'] ."' AND
  `roads_resume`.`road_id` = '".$id['id']."' and 
  `roads_resume`.`nivel` = '1'
GROUP BY
  `roads_resume`.`road_id`,
  `roads_resume`.`user_id`,
  `roads_resume`.`road`,
  `roads_resume`.`auditor`,
  `roads_resume`.`company_id`";
    $consulta1 = DB::select($sql);

//    $sql="SELECT store_id as id,cadenaRuc,type,fullname,region,tipo_bodega,address,district,audit as status, comment, codclient
//FROM roads_resume r where company_id='".$company_id['company_id'] ."' and road_id='".$id['id']."' and  nivel = '1'";

    $sql="SELECT
  `roads_resume`.`road_id`,
  `roads_resume`.`store_id` AS `id`,
  `roads_resume`.`cadenaRuc`,
  CASE
	when `roads_resume`.`cadenaRuc` is null or `roads_resume`.`cadenaRuc` = ''  then `roads_resume`.`DNI` else `roads_resume`.`cadenaRuc` end documento,
  CASE
	when `roads_resume`.`cadenaRuc` is null or `roads_resume`.`cadenaRuc` = '' then 'DNI' else 'RUC' end  tipo_documento,
  `roads_resume`.`fullname`,
  `roads_resume`.`region`,
  `roads_resume`.`tipo_bodega`,
  `roads_resume`.`address`,
  `roads_resume`.`district`,
  `roads_resume`.`audit` AS `status`,
  `roads_resume`.`codclient`,
  `roads_resume`.`urbanization`,
  `roads_resume`.`type`,
  `roads_resume`.`ejecutivo`,
  `roads_resume`.`latitude`,
  `roads_resume`.`longitude`,
  `roads_resume`.`telephone`,
  `roads_resume`.`cell`,
  `roads_resume`.`comment`,
  `roads_resume`.`owner`,
  `roads_resume`.`fnac`
FROM roads_resume  where `roads_resume`.`company_id`='".$company_id['company_id'] ."' and `roads_resume`.`road_id`='".$id['id']."' and  `roads_resume`.`nivel` = '1'";

    return \Response::json([ 'success'=> 1,"pdvs" => $consulta1[0]->pdvs,"auditados" => $consulta1[0]->auditados, "roadsDetail" => DB::select($sql)]);
}]);

Route::post('JsonRoadDetail', ['as' =>'JsonRoadDetail', function(){

    $id = Input::only('id');
    //var_dump($id) ;
    //dd($id) ;

    //$sql = "SELECT s.fullname,s.address, s.district, s.latitude, s.longitude FROM stores s where s.id='" . $id['id']  . "'";
    //$sql = "SELECT s.cadenaRuc,s.fullname,s.codclient,s.address, s.district, s.urbanization,s.type,s.tipo_bodega,s.region,s.ejecutivo, s.latitude, s.longitude FROM stores s where s.id='" . $id['id']  . "'";
    $sql = "SELECT id, case when s.cadenaRuc is null or s.cadenaRuc= ''  then s.dni else s.cadenaruc end documento, case when s.cadenaRuc is null or s.cadenaRuc= '' then 'DNI' else 'RUC' end tipo_documento, s.cadenaRuc,s.fullname,s.codclient,s.address, s.district, s.urbanization,s.type,s.tipo_bodega,s.region,s.ejecutivo, s.latitude, s.longitude, s.telephone, s.cell,s.comment,s.owner,s.fnac,s.rubro FROM stores s where s.id='" . $id['id']  . "'";
    return \Response::json([ 'success'=> 1, "roadsDetail" => DB::select($sql)]);


}]);


Route::post('JsonRoadsMap', ['as' =>'JsonRoadsMap', function(){

    $id = Input::only('id');
    $sql = "SELECT
              stores.fullname,
              stores.latitude,
              stores.longitude,
              company_stores.company_id,
              companies.customer_id
            FROM
              stores
              INNER JOIN road_details ON (stores.id = road_details.store_id)
              INNER JOIN company_stores ON (stores.id = company_stores.store_id)
              INNER JOIN companies ON (company_stores.company_id = companies.id)
            WHERE
              road_details.road_id = '" . $id['id']  . "' AND
              road_details.audit = 0";
    return \Response::json([ 'success'=> 1, "storeMaps" => DB::select($sql)]);
}]);

Route::post('JsonRoadsMapBayerCertificados', ['as' =>'JsonRoadsMapBayerCertificados', function(){

    $id = Input::only('id');
    $sql = "SELECT
              stores.fullname,
              stores.latitude,
              stores.longitude,
              road_details.company_id,
              companies.customer_id
            FROM
              stores
              INNER JOIN road_details ON (stores.id = road_details.store_id)
              INNER JOIN companies ON (road_details.company_id = companies.id)
            WHERE
              road_details.road_id = '" . $id['id']  . "' AND
              road_details.audit = 0 and road_details.nivel = 1";
    return \Response::json([ 'success'=> 1, "storeMaps" => DB::select($sql)]);
}]);

Route::post('JsonAuditsForStore', ['as' =>'JsonAuditsForStore', function(){

    $id = Input::only('id');
    $idRoute = Input::only('idRoute');
    $company_id = Input::only('company_id');
    //var_dump($id) ;
    //dd($id) ;

    $sql = "SELECT company_id FROM company_stores c where store_id='" . $id['id']  . "' and company_id='".$company_id['company_id']."'";
    $consulta=DB::select($sql);
    $t="";
    if (count($consulta)>0){
        $sql1="SELECT a.id, a.fullname FROM company_audits c,audits a where c.company_id='" . $company_id['company_id']. "' and c.audit=1 and c.audit_id=a.id ORDER BY orden ASC";
        /*foreach ($consulta as $v) {
            $sql1="SELECT a.id, a.fullname FROM company_audits c,audits a where c.company_id='" . $v->company_id . "' and c.audit=1 and c.audit_id=a.id";
            $t = array("company_id" => $v->company_id, "audits" => DB::select($sql1));
        }*/
        $consulta1 = DB::select($sql1);
       //dd($consulta1);
        foreach ($consulta1 as $v) {
            $sql2 = "SELECT audit FROM audit_road_stores a where company_id='". $company_id['company_id'] ."' and road_id='". $idRoute['idRoute'] ."' and store_id='". $id['id']  ."' and audit_id='". $v->id ."'";
            $consulta2 = DB::select($sql2);
            if (count($consulta2)>0){
                $audits[] = array("id" => $v->id, "fullname" => $v->fullname, "state" => $consulta2[0]->audit);
            }
            //dd($sql2);

        }
        $var = array("success" => 1, "company" => $consulta[0]->company_id , "audits" => $audits);
    }else{
        $var = array("success" => 0, "error" => "No presenta auditorias");
    }

    //return $t;
    return \Response::json($var);


}]);

Route::post('JsonPollsCompany', ['as' =>'JsonPollsCompany', function(){

    $id = Input::only('id');
    //var_dump($id) ;
    //dd($id) ;

    $sql = "SELECT s.id, s.question FROM polls s where s.company_id='" . $id['id']  . "'";
    return \Response::json([ 'success'=> 1, "questionsPoll" => DB::select($sql)]);


}]);

Route::post('JsonUpdatePollsCompany', ['as' =>'JsonUpdatePollsCompany', function(){

    $question = Input::only('question');
    $idstrore = Input::only('id');
    $idcompany = Input::only('idCompany');
    $idroute  = Input::only('idRuta');
    $idaudit = Input::only('idAuditoria');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    $c=0;
    //dd($question);
    $valores0 = explode("|",$question['question']);
    //dd($valores0);
    for($i=0;$i<count($valores0);$i++) {
        $valores = explode(":", $valores0[$i]);
        //dd($valores);
        //if ($valores[1]==0) $valores[1]=false; else $valores[1]=true;
        DB::insert("INSERT INTO poll_details (result,store_id,poll_id,created_at,updated_at) VALUES(?,?,?,?,?)" , array($valores[1], $idstrore['id'] , $valores[0],$horaSistema,$horaSistema));

    }
    DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema,$idcompany['idCompany'], $idroute['idRuta'], $idaudit['idAuditoria'], $idstrore['id'] ));


    return \Response::json([ 'success'=> 1]);


}]);

Route::post('updatePositionStore', ['as' =>'updatePositionStore', function(){

    $id = Input::only('id');
    $latitud = Input::only('latitud');
    $longitud = Input::only('longitud');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    //var_dump($id) ;
    //dd($id) ;
    DB::update("UPDATE  stores set latitude = ? , longitude = ?, updated_at = ? where id= ? " , array($latitud['latitud'], $longitud['longitud'], $horaSistema, $id['id'] ));
    return \Response::json([ 'success'=> 1]);
}]);

Route::post('JsonGetQuestions', ['as' =>'JsonGetQuestions', function(){

    $audit_id = Input::only('idAuditoria');
    $company_id = Input::only('idCompany');
    //var_dump($id) ;
    //dd($id) ;

    $sql = "SELECT id FROM company_audits c where audit_id='" . $audit_id['idAuditoria']  . "' and company_id='". $company_id['idCompany'] ."' and audit =1 order by created_at desc limit 1";
    $consulta=DB::select($sql);
    $t="";
    if (count($consulta)>0){
        $sql1="SELECT id, question FROM polls where company_audit_id='" . $consulta[0]->id . "' order by orden ASC";

        $consulta1 = DB::select($sql1);
        if (count($consulta1)>0){
            foreach ($consulta1 as $v) {
                $questions[] = array("id" => $v->id, "question" => $v->question);
            }
            $var = array("success" => 1, "questions" => $questions);
        }else{
            $var = array("success" => 0, "error" => "No presenta preguntas esta auditoria");
        }

    }else{
        $var = array("success" => 0, "error" => "No presenta auditorias");
    }

    //return $t;
    return \Response::json($var);


}]);

//BIM
Route::post('JsonInsertStoreBIM', ['as' =>'JsonInsertStoreBIM', function(){
    $nombre = Input::only('nombre');
    $ruc = Input::only('ruc');
    $codclient = Input::only('codclient');
    $company_id = Input::only('company_id');
    $distrito = Input::only('distrito');
    $address = Input::only('address');
    $referencia = Input::only('referencia');
    $dni = Input::only('dni');
    $road_id = Input::only('road_id');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM stores where fullname='" . $nombre['nombre'] . "' and cadenaRuc='".$ruc['ruc']."' and codclient='".$codclient['codclient']."' and district='".$distrito['distrito']."' and address='".$address['address']."'  and urbanization='".$referencia['referencia']."' and DNI='".$dni['dni']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    if ($consultaNum[0]->numero==0){
        DB::insert("INSERT INTO stores (fullname, cadenaRuc, codclient,district, ruteado,test,owner,address,urbanization,DNI,latitude,longitude, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)" , array($nombre['nombre'],$ruc['ruc'],$codclient['codclient'],$distrito['distrito'],0,0,'public',$address['address'],$referencia['referencia'],$dni['dni'],0,0,$horaSistema,$horaSistema));
        $idPollDetail = DB::getPdo()->lastInsertId();
        $sqlnum1="SELECT count(id) as numero FROM company_stores where store_id='" . $idPollDetail . "'";
        $consultaNum1 = DB::select($sqlnum1);
        if ($consultaNum1[0]->numero==0){
            DB::insert("INSERT INTO company_stores (company_id, store_id, ruteado, created_at,updated_at) VALUES(?,?,?,?,?)" , array($company_id['company_id'],$idPollDetail,1,$horaSistema,$horaSistema));
            DB::insert("INSERT INTO road_details (company_id, store_id, audit,road_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($company_id['company_id'],$idPollDetail,0,$road_id['road_id'],$horaSistema,$horaSistema));
            DB::insert("INSERT INTO audit_road_stores (company_id, store_id, audit_id,road_id,audit, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id['company_id'],$idPollDetail,36,$road_id['road_id'],0,$horaSistema,$horaSistema));
            return \Response::json([ 'success'=> 1,'store_id' => $idPollDetail]);
        }else{
            return \Response::json([ 'success'=> 0,'store_id' => 0]);
        }
    }else{
        return \Response::json([ 'success'=> 0,'store_id' => 0]);
    }

}]);

//BIM
Route::post('JsonGetResponsePollBim', ['as' =>'JsonGetResponsePollBim', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $idcompany = Input::only('idCompany');
    $sqlauditor="select a.poll_id, a.company_id, a.store_id, a.result, a.comentario, codigo, otro
from poll_details a
left outer join poll_option_details b
on (a.store_id = b.store_id and a.company_id = b.company_id)
left outer join poll_options c
on (b.poll_option_id = c.id and a.poll_id = c.poll_id)
where a.company_id = '".$idcompany['idCompany']."'
and a.poll_id = '".$poll_id['poll_id']."'
and a.store_id = '".$store_id['store_id']."'";
    $consultaAuditor = DB::select($sqlauditor);
    if (count($consultaAuditor)>0){
        return \Response::json(['success' => 1,'data'=>$consultaAuditor]);
    }else{
        return \Response::json(['success' => 0, 'data' => '']);
    }
}]);

//BIM
Route::post('JsonInsertAuditPollsBim', ['as' =>'JsonInsertAuditPollsBim', function(){

    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $sino = Input::only('sino');
    $options = Input::only('options');
    $limits = Input::only('limits');
    $media = Input::only('media');
    $coment = Input::only('coment');
    $comentario = Input::only('comentario');
    $opcion = Input::only('opcion');
    //$limite = Input::only('limite');
    $result = Input::only('result');
    $coment_options = Input::only('coment_options');// 0 o 1
    $comentario_options = Input::only('comentario_options');//comentario options

    $idcompany = Input::only('idCompany');
    $idroute  = Input::only('idRuta');
    $idaudit = Input::only('idAuditoria');
    $status = Input::only('status');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$idcompany['idCompany']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $horaSistema = $mytime->toDateTimeString();
    if ($consultaNum[0]->numero==0){
        $sqlauditor="SELECT user_id,auditor FROM roads_resume where store_id='".$store_id['store_id']."'  and company_id='".$idcompany['idCompany']."'";
        $consultaAuditor = DB::select($sqlauditor);//return \Response::json(['success' => dd($consultaAuditor)]);
        if (count($consultaAuditor)>0)
        {
            $auditor = $consultaAuditor[0]->auditor."(".$consultaAuditor[0]->user_id.")";
        }else{
            $auditor="";
        }
        if (($status['status']==0) or ($status['status']==2)){
            if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){

                DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,media,options,result,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$media['media'],$options['options'],$result['result'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
                $sqlFecha="SELECT created_at FROM poll_details where id='" . $idPollDetail . "'";
                $consultaFecha = DB::select($sqlFecha);

                $sqlcoord="SELECT  a.cadenaRuc,a.type,a.coordinador,a.fullname, a.codclient,a.address,a.district,a.ubigeo FROM stores a WHERE a.id = '".$store_id['store_id']."'";
                $consulEmail = DB::select($sqlcoord);//dd($consulEmail);

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        $sql2="SELECT fullname FROM companies where id='" . $idcompany['idCompany'] . "'";
                        $consulta2 = DB::select($sql2);

                        if (count($consulta1)>0){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            //return \Response::json(['success' => $consulta1[0]->options]);
                            //empieza envio de email
                            if ($consulta1[0]->options=='Local Cerrado')
                            {

                                $textoEmail = $consulta2[0]->fullname." Tienda Cerrada Id: ".$store_id['store_id'];

                                $textoContent = $textoEmail;
                                $nombreEnvio = $consulEmail[0]->coordinador;
                                $motivo = $consulta1[0]->options;
                                $fechaHoraEnvio =$consultaFecha[0]->created_at;

                                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1 and company_id='".$idcompany['idCompany']."'";
                                $consulMedia = DB::select($sqlmedia);
                                $urlBase = \App::make('url')->to('/');
                                $urlImages = '/media/fotos/';
                                if (count($consulMedia)>0){
                                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                                }else{
                                    $foto = "";
                                }


                                $datai = ['origen' => $store_id['store_id'],
                                    'tipo'  =>  'LocalCerrado',
                                    'titulo'=> $textoContent,
                                    'motivo' => $motivo,
                                    'auditor' => $auditor,
                                    'comentario' => '',
                                    'cadena' => '',
                                    'tipoLocal' => $consulEmail[0]->type,
                                    'agente'   =>  $consulEmail[0]->fullname,
                                    'dir' => $consulEmail[0]->codclient,
                                    'direccion' => $consulEmail[0]->address,
                                    'distrito' => $consulEmail[0]->district,
                                    'foto' => $foto,
                                    'fecha' => $fechaHoraEnvio
                                ];
                                $envio = ['responsable' => 'Franco','email' =>'adavelouis@ttaudit.com', 'subject' =>$textoEmail];
                                \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                                    $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                                });

                                $envio = ['responsable' => 'Augusto Guerra','email' =>'lrosales@ttaudit.com', 'subject' =>$textoEmail];
                                \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                                    $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                                });
                                $envio = ['responsable' => 'Raul Pulido','email' =>'rpulido@ttaudit.com', 'subject' =>$textoEmail];
                                \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                                    $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                                });
                                /*$envio = ['responsable' => 'Daniela','email' =>'rgallo@ttaudit.com', 'subject' =>$textoEmail];
                                \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                                    $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                                });*/
                            }
                            //finaliza envio de email

                        }
                    }
                }

            }

            if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){

                DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, coment,result,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
            }

            if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1)and ($coment_options['coment_options']<>1)){
                DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor <> '') {
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }$sw=0;

            }

            if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1)){
                //return \Response::json([ 'result'=> Input::all()]);
                DB::insert("INSERT INTO poll_details (poll_id, store_id, options, comentOptions,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment_options['coment_options'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }$sw=0;
            }

            if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
                DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, media,result,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$media['media'],$result['result'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
            }

            if (($sino['sino']<>1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
                DB::insert("INSERT INTO poll_details (poll_id, store_id, coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
            }

            if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
                //return \Response::json([ 'result'=> Input::all()]);
                DB::insert("INSERT INTO poll_details (poll_id, store_id, options, coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor <> '') {
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }
            }

            if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']==1)){
                //return \Response::json([ 'result'=> Input::all()]);
                DB::insert("INSERT INTO poll_details (poll_id, store_id, options, coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor <> '') {
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }
            }

            if ($status['status']==2)
            {
                DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $idcompany['idCompany'], $idroute['idRuta'], $idaudit['idAuditoria'], $store_id['store_id'] ));
            }
            dd($idPollDetail);
            if ($idPollDetail>0){
                return \Response::json(['success' => 1]);
            }else{
                return \Response::json(['success' => 0]);
            }
        }
    }else {
        return \Response::json(['success' => 0]);
    }
}]);

Route::post('JsonInsertAuditPollsProduct', ['as' =>'JsonInsertAuditPollsProduct', function(){

    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $product_id = Input::only('product_id');
    $sino = Input::only('sino');
    $coment = Input::only('coment');
    $result = Input::only('result');
    $idcompany = Input::only('company_id');
    $idroute  = Input::only('idroute');
    $idaudit = Input::only('idaudit');
    $status = Input::only('status');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    $company_id_active=230;$company_id_old=163;

    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and product_id='".$product_id['product_id']."' and company_id='".$idcompany['company_id']."'";
    $consultaNum = DB::select($sqlnum);
    if ($consultaNum[0]->numero==0)
    {
        $sqlauditor="SELECT user_id,auditor FROM roads_resume where store_id='".$store_id['store_id']."'  and company_id='".$idcompany['company_id']."'";
        $consultaAuditor = DB::select($sqlauditor);
        $sql2="SELECT fullname FROM companies where id='" . $idcompany['company_id'] . "'";
        $consulta2 = DB::select($sql2);

        $auditor = $consultaAuditor[0]->auditor."(".$consultaAuditor[0]->user_id.")";
        $valoresCampaigne[$company_id_old] = array('stock' => 2690,'premio' => 2691,'recomendo' =>2688,'cerrado' =>2686);
        $valoresCampaigne[$company_id_active] = array('stock' => 3994,'premio' => 3995,'recomendo' =>3992,'cerrado' =>3990);
        $valoresProducts = array('apronax' => 534,'aspirina_forte' => 644);
        $company_id = $idcompany['company_id'];$motivo="";$comentario="";
        $sqlcoord="SELECT  a.cadenaRuc,a.type,a.fullname,a.chanel,a.address,a.district,a.ejecutivo,a.region,a.ubigeo FROM stores a WHERE a.id = '".$store_id['store_id']."'";
        $consulEmail = DB::select($sqlcoord);

        if ($status['status']==0){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, comentario,result,product_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$product_id['product_id'],$idcompany['company_id'], $horaSistema, $horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();$sw=0;

            //empieza envio de email
            if ( (($poll_id['poll_id']==$valoresCampaigne[$company_id]['stock']) or ($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado']) or ($poll_id['poll_id']==$valoresCampaigne[$company_id]['premio'])) and ($result['result']==0))
            {
                $soloTtaudit=0;
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['premio'])
                {
                    $sw=1;$soloTtaudit=1;
                    $textoEmail = $consulta2[0]->fullname." Farmacia NO Acepto Premio ID PDV: ".$store_id['store_id']." - ".$consulEmail[0]->cadenaRuc;
                }
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['stock'])
                {
                    $textoEmail = $consulta2[0]->fullname." Farmacia NO tiene Stock ID PDV: ".$store_id['store_id']." - ".$consulEmail[0]->cadenaRuc;
                }
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado'])
                {
                    $textoEmail = $consulta2[0]->fullname." Farmacia Cerrada ID PDV: ".$store_id['store_id']." - ".$consulEmail[0]->cadenaRuc;
                    $sw=1;$soloTtaudit=1;
                }

                $textoContent = $textoEmail;
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['premio'])
                {
                    $motivo = 'No Quiso recibir Premio ID PDV:'.$store_id['store_id'];
                }


                if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['stock']) and ($result['result']==0))
                {
                    $sqlComent = "SELECT m.id,m.comentario FROM poll_details m where m.poll_id='".$valoresCampaigne[$company_id]['recomendo']."' and m.store_id='".$store_id['store_id']."' and m.product_id='".$product_id['product_id']."'";
                    $comentNoStock = DB::select($sqlComent);
                    if (count($comentNoStock)>0){
                        $comentarioNoStock  = trim(strtoupper($comentNoStock[0]->comentario));
                        DB::update("update poll_details set comentario = '' where id = ?", array($comentNoStock[0]->id));
                    }else{
                        $comentarioNoStock  = "";
                    }

                    DB::update("update poll_details set comentario = ? where id = ?", array($comentarioNoStock,$idPollDetail));
                }

                $sqlmedia = "SELECT m.comentario,m.product_id,m.created_at FROM poll_details m where m.id='".$idPollDetail."'";
                $consulMedia = DB::select($sqlmedia);
                $urlBase = \App::make('url')->to('/');
                $urlImages = '/media/fotos/';
                $foto = "";
                $fechaHoraEnvio = $consulMedia[0]->created_at;
                //if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['stock']) and ($consulMedia[0]->product_id == $valoresProducts['apronax'] or $consulMedia[0]->product_id == $valoresProducts['aspirina_forte']) and ($result['result']==0))
                if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['stock']) and ($result['result']==0))
                {
                    $sqlProduct = "SELECT m.fullname FROM products m where m.id='".$consulMedia[0]->product_id."'";
                    $consulProduct = DB::select($sqlProduct);
                    if ($consulMedia[0]->product_id==645){
                        if ($comentarioNoStock<>''){
                            $mascaras = explode(',',$comentarioNoStock);
                            if (count($mascaras)>0){
                                $motivo = 'No tiene Stock de '.trim($mascaras[0]).' ID PDV: '.$store_id['store_id'];
                                $valorComment = trim($mascaras[0]);
                            }else{
                                $motivo = 'No tiene Stock de '.$consulProduct[0]->fullname.' ID PDV: '.$store_id['store_id'];
                                $valorComment = $consulProduct[0]->fullname;
                            }
                        }else{
                            $motivo = 'No tiene Stock de '.$consulProduct[0]->fullname.' ID PDV: '.$store_id['store_id'];
                            $valorComment = $consulProduct[0]->fullname;
                        }
                    }else{
                        $motivo = 'No tiene Stock de '.$consulProduct[0]->fullname.' ID PDV: '.$store_id['store_id'];$valorComment = $consulProduct[0]->fullname;
                    }
                    $textoEmail = $consulta2[0]->fullname." - Sin stock - ".$valorComment." - ".$consulEmail[0]->cadenaRuc.' - '.$consulEmail[0]->ubigeo.' - '.$consulEmail[0]->fullname;
                    $sw=0;
                    $comentario = $consulMedia[0]->comentario;
                }else{
                    if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['premio'])
                    {
                        $comentario = $consulMedia[0]->comentario;
                    }
                }
                $tipoTemplate="EmailsBayer";
            }

            //finaliza envio de email

        }

        if ($status['status']==1){
            if ($poll_id['poll_id']==0){
                $sqlNoStock="SELECT product_id,created_at FROM poll_details where store_id='".$store_id['store_id']."'  and company_id='".$idcompany['company_id']."' and poll_id='".$valoresCampaigne[$company_id]['stock']."' and result='0'";
                $consultaNoStock = DB::select($sqlNoStock);
                $sw=0;
                if (count($consultaNoStock)>0){
                    $sqlProducts="SELECT  `product_detail`.`product_id`, `products`.`fullname` FROM `product_detail` INNER JOIN `products` ON (`product_detail`.`product_id` = `products`.`id`) WHERE `product_detail`.`company_id` = '".$company_id_active."'";
                    $consultaProducts = DB::select($sqlProducts);
                    if (count($consultaProducts)>0){$c=0;$nombProducts="";
                        foreach ($consultaProducts as $products){
                            $arrayProducts[$products->product_id] = $products->fullname;
                        }
                    }

                    $textoEmail = $consulta2[0]->fullname." Farmacia NO tiene Stock - ".$consulEmail[0]->ubigeo." - ".$consulEmail[0]->fullname;
                    foreach ($consultaNoStock as $dato){
                        $nombProducts.=$arrayProducts[$dato->product_id];
                        $c++;
                        if ($c<count($consultaProducts)){
                            $nombProducts.=" , ";
                        }
                        $fechaHoraEnvio=$dato->created_at;
                    }
                    $motivo = 'No tiene Stock de '.$nombProducts;
                    $textoContent = $textoEmail;
                    $tipoTemplate="EmailsBayer";
                    $sw=1;$soloTtaudit=0;
                    $foto="";
                }
            }
            $updateE=DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $idcompany['company_id'], $idroute['idroute'], $idaudit['idaudit'], $store_id['store_id'] ));
            if ($updateE){
                $idPollDetail=1;
            }else{
                $idPollDetail=0;
            }
        }

        if ($status['status']==2){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, comentario,result,product_id, company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$product_id['product_id'], $idcompany['company_id'],$horaSistema, $horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $idcompany['company_id'], $idroute['idroute'], $idaudit['idaudit'], $store_id['store_id'] ));
            $sw=0;
            //empieza envio de email
            if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado']) and ($result['result']==0))
            {
                $textoEmail = $consulta2[0]->fullname." Farmacia Cerrada : ".$consulEmail[0]->cadenaRuc;
                $textoContent = $textoEmail;
                $motivo = 'Local Cerrado';

                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1 and company_id='".$idcompany['company_id']."'";
                $consulMedia = DB::select($sqlmedia);

                $sqlFechaIng = "SELECT created_at FROM poll_details m where id='".$idPollDetail."'";
                $consulFechaIng = DB::select($sqlFechaIng);

                $urlBase = \App::make('url')->to('/');
                $urlImages = '/media/fotos/';
                if (count($consulMedia)>0){
                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                }else{
                    $foto = "";
                }
                $fechaHoraEnvio = $consulFechaIng[0]->created_at;

                $tipoTemplate="LocalCerrado";$comentario="";
                $sw=1;$soloTtaudit=1;
            }
        }

        if ($sw==100){
            $datai = ['origen' => $store_id['store_id'],
                'tipo'  =>  $tipoTemplate,
                'titulo'=> $textoContent,
                'auditor' => $auditor,
                'motivo' => $motivo,
                'comentario' => $comentario,
                'cadena' => $consulEmail[0]->cadenaRuc,
                'tipoLocal' => $consulEmail[0]->type,
                'agente'   =>  $consulEmail[0]->fullname,
                'dir' => $consulEmail[0]->ejecutivo,
                'direccion' => $consulEmail[0]->address,
                'distrito' => $consulEmail[0]->district,
                'ciudad' => $consulEmail[0]->region,
                'ubigeo' => $consulEmail[0]->ubigeo,
                'foto' => $foto,
                'fecha' => $fechaHoraEnvio
            ];
            $store_prueba=29463;
            if ($soloTtaudit==1)
            {
                $emails[]=array('nombres'=>'Franco','email'=>'franbrsj@gmail.com');
                $emails[]=array('nombres'=>'Elba','email'=>'ellerena@ttaudit.com');
                $emails[]=array('nombres'=>'Rodrigo','email'=>'roblitas@ttaudit.com');
            }else{
                if ($consulEmail[0]->ejecutivo<>''){
                    $sqlUser="SELECT  a.id,a.email FROM users a WHERE a.fullname = '".$consulEmail[0]->ejecutivo."'";
                    $consulUser = DB::select($sqlUser);
                    if ((strtoupper(trim($consulEmail[0]->ubigeo))<>'CUZCO')){
                        if ($consulEmail[0]->type<>'CADENA')
                        {
                            if (strtoupper(trim($consulEmail[0]->ubigeo))<>'ICA'){
                                if (strtoupper(trim($consulEmail[0]->ubigeo))=='LIMA'){
                                    $emails[]=array('nombres'=>'Mauricio','email'=>'mauricio.monge@bayer.com');
                                }else{
                                    $emails[]=array('nombres'=>'Xavier','email'=>'xavier.madrid@bayer.com');
                                }
                            }else{
                                if ($consulEmail[0]->type=='DETALLISTA'){
                                    $emails[]=array('nombres'=>'Mauricio','email'=>'mauricio.monge@bayer.com');
                                }
                            }

                        }
                        if (count($consulUser)>0)
                        {
                            $emails[]=array('nombres'=>$consulEmail[0]->ejecutivo,'email'=>$consulUser[0]->email);
                            $emailEjec=$consulUser[0]->id;
                        }else{
                            $emailEjec=0;
                        }
                        $emails[]=array('nombres'=>'Giancarlo','email'=>'giancarlo.figallo@bayer.com');
                        $emails[]=array('nombres'=>'Geraldine','email'=>'geraldinemilagros.febres@bayer.com');
                        $emails[]=array('nombres'=>'David','email'=>'david.zapata@bayer.com');
                    }
                }
                if ($consulEmail[0]->type=='CADENA')
                {
                    $emails[]=array('nombres'=>'Edwin','email'=>'edwinjavier.duarte@bayer.com');
                }
                if ($consulEmail[0]->type=='DETALLISTA')
                {
                    if (strtoupper(trim($consulEmail[0]->ubigeo))<>'LIMA'){
                        if (strtoupper(trim($consulEmail[0]->ubigeo))<>'ICA'){
                            $emails[]=array('nombres'=>'Xavier','email'=>'Xavier.madrid@bayer.com');
                        }
                    }
                }
                $emails[]=array('nombres'=>'Franco','email'=>'franbrsj@gmail.com');
                $emails[]=array('nombres'=>'Elba','email'=>'ellerena@ttaudit.com');
                $emails[]=array('nombres'=>'Rodrigo','email'=>'roblitas@ttaudit.com');
                $emails[]=array('nombres'=>'Geraldine','email'=>'geraldinemilagros.febres@bayer.com');

                if ($poll_id['poll_id']<>$valoresCampaigne[$company_id]['stock']){
                    //$emails[]=array('nombres'=>'Sergio','email'=>'sergio.vega@bayer.com');
                }
            }
            if ($store_id['store_id']<>$store_prueba){
                if (count($emails)>0){$c=0;$ListEmails='';
                    foreach ($emails as $email) {
                        $c=$c+1;
                        $ListEmails .= $email['email'].":".$email['nombres'];
                        if (count($emails)>$c){
                            $ListEmails .= "|";
                        }
                        $envio = ['responsable' => $email['nombres'],'email' =>$email['email'], 'subject' =>$textoEmail];
                        \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                            $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                        });
                    }
                    DB::insert("INSERT INTO alerts (store_id,poll_id, user_id,ejecutivo_id,titulo,motivo,company_id,customer_id,emails,send,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$poll_id['poll_id'],$auditor,$emailEjec,$textoContent,$motivo,$idcompany['company_id'],5,$ListEmails,'1',$fechaHoraEnvio,$horaSistema));
                }

            }

        }

        if ($idPollDetail >0)
        {
            return \Response::json([ 'success'=> 1]);
        }else{
            return \Response::json([ 'success'=> 0]);
        }
    }else{
        return \Response::json([ 'success'=> 0]);
    }

}]);

Route::post('JsonQuestionsTemp', ['as' =>'JsonQuestionsTemp', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    /*$product_id = Input::only('product_id');*/
    /*$sino = Input::only('sino');*/
    $coment = Input::only('coment');
    /*$result = Input::only('result');*/
    $idcompany = Input::only('company_id');
    /*$idroute  = Input::only('idroute');
    $idaudit = Input::only('idaudit');*/
    $status = Input::only('status');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$idcompany['company_id']."'";
    $consultaNum = DB::select($sqlnum);
    if ($consultaNum[0]->numero==0)
    {
        if ($status['status']==0){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$coment['coment'],$idcompany['company_id'], $horaSistema, $horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();$sw=0;

            if ($idPollDetail >0)
            {
                return \Response::json([ 'success'=> 1]);
            }else{
                return \Response::json([ 'success'=> 0]);
            }
        }



    }else{
        return \Response::json([ 'success'=> 0]);
    }

}]);

Route::post('JsonInsertAuditBayer',['as' => '', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $sino = Input::only('sino');
    $options = Input::only('options');
    $limits = Input::only('limits');
    $media = Input::only('media');
    $coment = Input::only('coment');
    $comentario = Input::only('comentario');
    $opcion = Input::only('opcion');
    $limite = Input::only('limite');
    $result = Input::only('result');
    $coment_options = Input::only('coment_options');// 0 o 1
    $comentario_options = Input::only('comentario_options');//comentario options
    $product = Input::only('product');
    $product_id = Input::only('product_id');

    $idcompany = Input::only('idCompany');
    $idroute  = Input::only('idRuta');
    $idaudit = Input::only('idAuditoria');
    $status = Input::only('status');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='" . $idcompany['idCompany'] . "' and product_id='".$product_id['product_id']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();$idPollDetail=0;

    if ($consultaNum[0]->numero==0){
        if (($sino['sino']==1) and ($product['product']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']==1) and ($product['product']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']==1) and ($product['product']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario,media,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$media['media'],$idcompany['idCompany'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']==1) and ($product['product']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario, media,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$media['media'],$idcompany['idCompany'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']==1) and ($product['product']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,product_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$product_id['product_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,product_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$product_id['product_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']<>1) and ($product['product']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id,product_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$idcompany['idCompany'],$product_id['product_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,product_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$product_id['product_id'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,product_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$product_id['product_id'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']<>1) and ($product['product']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id,product_id,coment,comentario, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$idcompany['idCompany'],$product_id['product_id'],$coment['coment'],$comentario['comentario'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);//dd($opciones);
            if ($consultaNum[0]->numero==0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $opciones2 = explode('-',$valor);
                        if ($opciones2[0]<>''){
                            $idopcion = $opciones2[0];
                            $priority = $opciones2[1];
                        }else{
                            $idopcion = $valor;
                            $priority = 0;
                        }
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $idopcion . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,product_id,priority, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$product_id['product_id'],$priority,$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,product_id,priority, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$product_id['product_id'],$priority,$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
        if (($sino['sino']<>1) and ($product['product']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id,coment,comentario, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$idcompany['idCompany'],$coment['coment'],$comentario['comentario'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $idopcion =$opcion['opcion'];//dd($opciones);
            if ($consultaNum[0]->numero==0){
                $sql1="SELECT id,options FROM poll_options where codigo='" . $idopcion . "'";
                $consulta1 = DB::select($sql1);

                if (count($consulta1)>0){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$horaSistema,$horaSistema));
                }

            }else{
                return \Response::json([ 'success'=> 1]);
            }
        }
    }

    if ($idPollDetail >0){
        if ($status['status']==1){
            DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema,$idcompany['idCompany'], $idroute['idRuta'], $idaudit['idAuditoria'], $store_id['store_id'] ));
        }

        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);

//kcc
Route::post('JsonInsertStoreKCC', ['as' =>'JsonInsertStoreKCC', function(){
    $nombre = Input::only('nombre');
    $ruc = Input::only('ruc');
    $codclient = Input::only('codclient');
    $company_id = Input::only('company_id');
    $distrito = Input::only('distrito');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM stores where fullname='" . $nombre['nombre'] . "' and cadenaRuc='".$ruc['ruc']."' and codclient='".$codclient['codclient']."' and district='".$distrito['distrito']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    if ($consultaNum[0]->numero==0){
        DB::insert("INSERT INTO stores (fullname, cadenaRuc, codclient,district, ruteado,test, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($nombre['nombre'],$ruc['ruc'],$codclient['codclient'],$distrito['distrito'],0,0,$horaSistema,$horaSistema));
        $idPollDetail = DB::getPdo()->lastInsertId();
        $sqlnum1="SELECT count(id) as numero FROM company_stores where store_id='" . $idPollDetail . "'";
        $consultaNum1 = DB::select($sqlnum1);
        if ($consultaNum1[0]->numero==0){
            DB::insert("INSERT INTO company_stores (company_id, store_id, ruteado, created_at,updated_at) VALUES(?,?,?,?,?)" , array($company_id['company_id'],$idPollDetail,1,$horaSistema,$horaSistema));

            return \Response::json([ 'success'=> 1,'store_id' => $idPollDetail]);
        }else{
            return \Response::json([ 'success'=> 0,'store_id' => 0]);
        }
    }else{
        return \Response::json([ 'success'=> 0,'store_id' => 0]);
    }

}]);
//kcc
Route::post('JsonInsertPollsKCC', ['as' =>'JsonInsertPollsKCC', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $company_id = Input::only('company_id');
    $sino = Input::only('sino');
    $options = Input::only('options');
    $limits = Input::only('limits');
    $media = Input::only('media');
    $coment = Input::only('coment');
    $opcion = Input::only('opcion');
    $result = Input::only('result');
    $coment_options = Input::only('coment_options');// 0 o 1
    $comentario_options = Input::only('comentario_options');
    $auditor = Input::only('auditor');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$company_id['company_id']."' and auditor='".$auditor['auditor']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    if ($consultaNum[0]->numero==0)
    {
        if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, coment,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options, comentOptions,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment_options['coment_options'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();

            $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
            $consulta1 = DB::select($sql1);

            if (count($consulta1)>0){
                if ($coment_options['coment_options'] == 1){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                }else{
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                }
            }
        }

        if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if (count($opciones)>0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                        }
                    }
                }
            }else{
                $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
                $consulta1 = DB::select($sql1);
                if (count($consulta1)>0){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                }
            }

        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1)and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            if (count($opciones)>0){
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);
                        if (count($consulta1)>0){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                        }
                    }
                }
            }else{
                $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
                $consulta1 = DB::select($sql1);
                if (count($consulta1)>0){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$auditor['auditor'],$horaSistema,$horaSistema));
                }
            }

        }

        if ($idPollDetail >0){
            return \Response::json([ 'success'=> 1]);
        }else{
            return \Response::json([ 'success'=> 0]);
        }
    }else{
        return \Response::json([ 'success'=> 0]);
    }

}]);
/*sino=0;options=0;limits=1;media=0;coment=0;result=0;opcion=0;limite=1.2|total:Muy Rapida*/

Route::post('JsonInsertAuditPolls', ['as' =>'JsonInsertAuditPolls', function(){

    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $sino = Input::only('sino');
    $options = Input::only('options');
    $limits = Input::only('limits');
    $media = Input::only('media');
    $coment = Input::only('coment');
    $comentario = Input::only('comentario');
    $opcion = Input::only('opcion');
    $limite = Input::only('limite');
    $result = Input::only('result');
    $coment_options = Input::only('coment_options');// 0 o 1
    $comentario_options = Input::only('comentario_options');//comentario options
    //dd(Input::all());
    $idcompany = Input::only('idCompany');
    $user_id = Input::only('user_id');
    $idroute  = Input::only('idRuta');
    $idaudit = Input::only('idAuditoria');
    $status = Input::only('status');

    $idPollDetail=0;
    $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$idcompany['idCompany']."'";
    $consultaNum = DB::select($sqlnum);

    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $horaSistema = $mytime->toDateTimeString();
    if ($consultaNum[0]->numero==0){
        $sql=0;$sw=0;$textoEmail='';$soloTtaudit=0;
        $sqlauditor="SELECT user_id,auditor FROM roads_resume where store_id='".$store_id['store_id']."'  and company_id='".$idcompany['idCompany']."'";
        $consultaAuditor = DB::select($sqlauditor);
        $auditor = $consultaAuditor[0]->auditor."(".$consultaAuditor[0]->user_id.")";

        $sql2="SELECT fullname FROM companies where id='" . $idcompany['idCompany'] . "'";
        $consulta2 = DB::select($sql2);

        //$valoresCampaigne[226] = array('cobro' => 3900,'NoTransaccion' => 3897,'externo' =>3881,'interno' => 3882, 'cerrado' =>3880,'NoTransaccionBIM' => 2954);//BCP
        $valoresCampaigne[241] = array('cobro' => 4222,'NoTransaccion' => 4219,'externo' =>4203,'interno' => 4204, 'cerrado' =>4202,'NoTransaccionBIM' => 2954);//BCP
        $company_id = $idcompany['idCompany'];
        $sqlcoord1="SELECT  b.id,b.fullname as nomb_ejecutivo,a.cadenaRuc,a.type,a.ejecutivo,a.coordinador,a.gerzonal,a.fullname, a.codclient,a.address,a.district,a.ubigeo,b.email FROM stores a, users b WHERE a.id = '".$store_id['store_id']."' AND b.email = a.ejecutivo";
        $consulEmailEjecutivo = DB::select($sqlcoord1);
        $sqlcoord2="SELECT  b.id,b.fullname as nomb_ejecutivo,a.cadenaRuc,a.type,a.ejecutivo,a.coordinador,a.gerzonal,a.fullname, a.codclient,a.address,a.district,a.ubigeo,b.email FROM stores a, users b WHERE a.id = '".$store_id['store_id']."' AND b.email = a.coordinador";
        $consulEmailCoordinador = DB::select($sqlcoord2);
        $sqlcoord3="SELECT  b.id,b.fullname as nomb_ejecutivo,a.cadenaRuc,a.type,a.ejecutivo,a.coordinador,a.gerzonal,a.fullname, a.codclient,a.address,a.district,a.ubigeo,b.email FROM stores a, users b WHERE a.id = '".$store_id['store_id']."' AND b.email = a.gerzonal";
        $consulEmailGerZonal = DB::select($sqlcoord3);
        $urlBase = \App::make('url')->to('/');
        $urlImages = '/media/fotos/';

        if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){

            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, coment,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $sqlFecha="SELECT created_at FROM poll_details where id='" . $idPollDetail . "'";
            $consultaFecha = DB::select($sqlFecha);
            $fechaHoraEnvio = $consultaFecha[0]->created_at;

            if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['cobro']) and ($result['result']==1))
            {
                $textoEmail = "ALERTA: ".$consulta2[0]->fullname." Agente cobro fuera del voucher. DIR: ".$consulEmailEjecutivo[0]->codclient;
                $textoContent = $textoEmail;
                $nombreEnvio = $consulEmailEjecutivo[0]->nomb_ejecutivo;
                $motivo = 'Agente hizo un cobro fuera del Voucher';
                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1;";
                $consulMedia = DB::select($sqlmedia);
                if (count($consulMedia)>0){
                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                }else{
                    $foto = "";
                }
                DB::insert("INSERT INTO alerts (store_id,poll_id, user_id,ejecutivo_id,titulo,motivo,company_id,emails,send,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$valoresCampaigne[$company_id]['cobro'],$consultaAuditor[0]->user_id,$consulEmailEjecutivo[0]->id,$textoEmail,$motivo,$idcompany['idCompany'],'','1',$fechaHoraEnvio,$horaSistema));
                $idAlertInsert = DB::getPdo()->lastInsertId();
                $datai = ['origen' => $store_id['store_id'],
                    'tipo'  =>  'AlertasIBK',
                    'titulo'=> $textoContent,
                    'motivo' => $motivo,
                    'auditor' => $auditor,
                    'comentario' => '',
                    'cadena' => $consulEmailEjecutivo[0]->cadenaRuc,
                    'tipoLocal' => $consulEmailEjecutivo[0]->type,
                    'agente'   =>  $consulEmailEjecutivo[0]->fullname,
                    'dir' => $consulEmailEjecutivo[0]->codclient,
                    'direccion' => $consulEmailEjecutivo[0]->address,
                    'distrito' => $consulEmailEjecutivo[0]->district,
                    'foto' => $foto,
                    'fecha' => $fechaHoraEnvio,
                    'idAlert' => $idAlertInsert
                ];
                $sw=1;$soloTtaudit=1;
            }

        }

        if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){

            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, coment,result,comentario,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$comentario['comentario'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            //return \Response::json([ 'result'=> Input::all()]);
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options, coment,comentario,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
            $consulta1 = DB::select($sql1);

            if (count($consulta1)>0){
                if ($coment_options['coment_options'] == 1){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],1,$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }else{
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, store_id,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$store_id['store_id'],1,$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }
            }

        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1)){
            //return \Response::json([ 'result'=> Input::all()]);
            DB::insert("INSERT INTO poll_details (poll_id,result, store_id, options, comentOptions,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],0,$store_id['store_id'],$options['options'],$coment_options['coment_options'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();

            $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
            $consulta1 = DB::select($sql1);

            if (count($consulta1)>0){
                if ($coment_options['coment_options'] == 1){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id,result, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }else{
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }
            }$sw=0;
            if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['NoTransaccion'])
            {
                $sqlFecha="SELECT created_at FROM poll_details where id='" . $idPollDetail . "'";
                $consultaFecha = DB::select($sqlFecha);

                $fechaHoraEnvio = $consultaFecha[0]->created_at;

                if (count($consulEmailEjecutivo)>0){
                    $nombreEnvio = $consulEmailEjecutivo[0]->coordinador;
                    $codclientStore = $consulEmailEjecutivo[0]->codclient;
                }else{
                    $nombreEnvio = "";$codclientStore="";
                }
                $textoEmail = "ALERTA: ".$consulta2[0]->fullname." Dependiente NO acepto Trans. DIR: ".$codclientStore;

                $textoContent = $textoEmail;

                $motivo = 'Dependiente NO acepto Transacción motivo <b>'.strtoupper($consulta1[0]->options).'</b>';
                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1;";
                $consulMedia = DB::select($sqlmedia);
                if (count($consulMedia)>0){
                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                }else{
                    $foto = "";
                }
                DB::insert("INSERT INTO alerts (store_id,poll_id, user_id,ejecutivo_id,titulo,motivo,company_id,emails,send,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$valoresCampaigne[$company_id]['NoTransaccion'],$consultaAuditor[0]->user_id,$consulEmailEjecutivo[0]->id,$textoEmail,$motivo,$idcompany['idCompany'],'','1',$fechaHoraEnvio,$horaSistema));
                $idAlertInsert = DB::getPdo()->lastInsertId();
                $datai = ['origen' => $store_id['store_id'],
                    'tipo'  =>  'AlertasIBK',
                    'titulo'=> $textoContent,
                    'motivo' => $motivo,
                    'auditor' => $auditor,
                    'comentario' => '',
                    'cadena' => $consulEmailEjecutivo[0]->cadenaRuc,
                    'tipoLocal' => $consulEmailEjecutivo[0]->type,
                    'agente'   =>  $consulEmailEjecutivo[0]->fullname,
                    'dir' => $consulEmailEjecutivo[0]->codclient,
                    'direccion' => $consulEmailEjecutivo[0]->address,
                    'distrito' => $consulEmailEjecutivo[0]->district,
                    'foto' => $foto,
                    'fecha' => $fechaHoraEnvio,
                    'idAlert' => $idAlertInsert
                ];
                $sw=1;

            }
        }


        if (($sino['sino']<>1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, coment,comentario,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$coment['coment'],$comentario['comentario'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']==1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options, comentOptions,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$coment_options['coment_options'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();

            $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
            $consulta1 = DB::select($sql1);

            if (count($consulta1)>0){
                if ($coment_options['coment_options'] == 1){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }else{
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }
            }
        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']==1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options, limits,limite,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$limits['limits'],trim($limite['limite']),$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $valores = explode('|',$opcion['opcion']);
            if (count($valores)<>0){
                foreach ($valores as $v) {
                    if (!empty($v)){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $v . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($coment_options['coment_options'] == 1){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }
            }

        }

        if (($sino['sino']<>1) and ($options['options']<>1) and ($limits['limits']==1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, limits,limite,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$limits['limits'],trim($limite['limite']),$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
        }

        if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, media,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$media['media'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();

        }

        if (($sino['sino']==1) and ($options['options']<>1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino, coment,media,result,comentario,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$media['media'],$result['result'],$comentario['comentario'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();

        }

        if (($sino['sino']<>1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1)and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
            $consulta1 = DB::select($sql1);

            if (count($consulta1)>0){
                if ($coment_options['coment_options'] == 1){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }else{
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                }
            }$sw=0;

        }

        if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']==1) and ($coment_options['coment_options']<>1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,options,result,coment,comentario,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$options['options'],$result['result'],$coment['coment'],$comentario['comentario'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            foreach ($opciones as $valor) {
                if ($valor<>''){
                    $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                    $consulta1 = DB::select($sql1);

                    if (count($consulta1)>0){
                        if ($coment_options['coment_options'] == 1){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }else{
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }
                    }
                }
            }

        }

        if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']<>1)){

            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,media,options,result,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$media['media'],$options['options'],$result['result'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $sqlFecha="SELECT created_at FROM poll_details where id='" . $idPollDetail . "'";
            $consultaFecha = DB::select($sqlFecha);

            $sqlCiudad="SELECT  a.ubigeo FROM stores a WHERE a.id = '".$store_id['store_id']."'";
            $consulCiudad = DB::select($sqlCiudad);


            $fechaHoraEnvio = $consultaFecha[0]->created_at;
            if ((($poll_id['poll_id']==$valoresCampaigne[$company_id]['externo']) or ($poll_id['poll_id']==$valoresCampaigne[$company_id]['interno'])) and ($result['result']==0))
            {
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['externo']){
                    $poll_id_select = $valoresCampaigne[$company_id]['externo'];
                    $textoEmail = "ALERTA: ".$consulta2[0]->fullname." Letrero Externo NO visible DIR: ".$consulEmailCoordinador[0]->codclient;
                }
                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['interno']){
                    $poll_id_select = $valoresCampaigne[$company_id]['interno'];
                    $textoEmail = "ALERTA: ".$consulta2[0]->fullname." Letrero Interno NO visible DIR: ".$consulEmailCoordinador[0]->codclient;
                }
                $textoContent = $textoEmail;
                $nombreEnvio = $consulEmailCoordinador[0]->nomb_ejecutivo;
                $motivo = 'Letreros NO Visibles';
                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1;";
                $consulMedia = DB::select($sqlmedia);
                $urlBase = \App::make('url')->to('/');
                $urlImages = '/media/fotos/';
                if (count($consulMedia)>0){
                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                }else{
                    $foto = "";
                }
                DB::insert("INSERT INTO alerts (store_id,poll_id, user_id,ejecutivo_id,titulo,motivo,company_id,emails,send,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$poll_id_select,$consultaAuditor[0]->user_id,$consulEmailEjecutivo[0]->id,$textoEmail,$motivo,$idcompany['idCompany'],'','1',$fechaHoraEnvio,$horaSistema));
                $idAlertInsert = DB::getPdo()->lastInsertId();

                $datai = ['origen' => $store_id['store_id'],
                    'tipo'  =>  'AlertasIBK',
                    'titulo'=> $textoContent,
                    'motivo' => $motivo,
                    'auditor' => $auditor,
                    'comentario' => '',
                    'cadena' => $consulEmailCoordinador[0]->cadenaRuc,
                    'tipoLocal' => $consulEmailCoordinador[0]->type,
                    'agente'   =>  $consulEmailCoordinador[0]->fullname,
                    'dir' => $consulEmailCoordinador[0]->codclient,
                    'direccion' => $consulEmailCoordinador[0]->address,
                    'distrito' => $consulEmailCoordinador[0]->district,
                    'foto' => $foto,
                    'fecha' => $fechaHoraEnvio,
                    'idAlert' => $idAlertInsert
                ];
                $sw=1;

            }

            $opciones = explode('|',$opcion['opcion']);
            if (count($opciones)>0){
                foreach ($opciones as $valor) {//dd($valor);
                    if ($valor<>''){
                        $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));

                            //empieza envio de email
                            if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado']) and ($result['result']==0))
                            {

                                if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado']){
                                    $textoEmail = "ALERTA: ".$consulta2[0]->fullname." Agente Cerrado DIR: ".$consulEmailEjecutivo[0]->codclient;
                                }

                                $textoContent = $textoEmail;
                                $nombreEnvio = $consulEmailEjecutivo[0]->nomb_ejecutivo;
                                $motivo = $consulta1[0]->options;

                                $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1;";
                                $consulMedia = DB::select($sqlmedia);
                                $urlBase = \App::make('url')->to('/');
                                $urlImages = '/media/fotos/';
                                if (count($consulMedia)>0){
                                    $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                                }else{
                                    $foto = "";
                                }
                                DB::insert("INSERT INTO alerts (store_id,poll_id, user_id,ejecutivo_id,titulo,motivo,company_id,emails,send,created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$valoresCampaigne[$company_id]['cerrado'],$consultaAuditor[0]->user_id,$consulEmailEjecutivo[0]->id,$textoEmail,$motivo,$idcompany['idCompany'],'','1',$fechaHoraEnvio,$horaSistema));
                                $idAlertInsert = DB::getPdo()->lastInsertId();

                                $datai = ['origen' => $store_id['store_id'],
                                    'tipo'  =>  'AlertasIBK',
                                    'titulo'=> $textoContent,
                                    'motivo' => $motivo,
                                    'auditor' => $auditor,
                                    'comentario' => '',
                                    'cadena' => $consulEmailEjecutivo[0]->cadenaRuc,
                                    'tipoLocal' => $consulEmailEjecutivo[0]->type,
                                    'agente'   =>  $consulEmailEjecutivo[0]->fullname,
                                    'dir' => $consulEmailEjecutivo[0]->codclient,
                                    'direccion' => $consulEmailEjecutivo[0]->address,
                                    'distrito' => $consulEmailEjecutivo[0]->district,
                                    'foto' => $foto,
                                    'fecha' => $fechaHoraEnvio,
                                    'idAlert' => $idAlertInsert
                                ];
                                $sw=1;
                            }
                            //finaliza envio de email
                        }
                    }
                }
            }

        }

        if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']<>1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1)){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,result,options,comentOptions,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$result['result'],$options['options'],$coment_options['coment_options'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            foreach ($opciones as $valor) {
                if ($valor<>''){
                    $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "' and poll_id='".$poll_id['poll_id']."'";
                    $consulta1 = DB::select($sql1);

                    if (count($consulta1)>0){
                        if ($consulta1[0]->options == 'Otros'){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }else{
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }
                    }
                }
            }

        }

        if (($sino['sino']==1) and ($options['options']==1) and ($limits['limits']<>1) and ($media['media']==1) and ($coment['coment']<>1) and ($coment_options['coment_options']==1))
        {
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,result,options,comentOptions,media,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$result['result'],$options['options'],$coment_options['coment_options'],$media['media'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            $opciones = explode('|',$opcion['opcion']);
            foreach ($opciones as $valor) {
                if ($valor<>''){
                    $sql1="SELECT id,options FROM poll_options where codigo='" . $valor . "' and poll_id='".$poll_id['poll_id']."'";
                    $consulta1 = DB::select($sql1);

                    if (count($consulta1)>0){
                        if ($consulta1[0]->options == 'Otros'){
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }else{
                            DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,auditor, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$idcompany['idCompany'],$user_id['user_id'],$horaSistema,$horaSistema));
                        }
                    }
                }
            }
        }


        if (($sw==1) and ($soloTtaudit==0))
        {
            if (count($consulEmailEjecutivo)>0){
                if ($consulEmailEjecutivo[0]->ejecutivo<>'')
                {
                    $emails[]=array('nombres'=>$consulEmailEjecutivo[0]->nomb_ejecutivo,'email'=>$consulEmailEjecutivo[0]->email);
                }
            }
            if (count($consulEmailCoordinador)>0){
                if ($consulEmailCoordinador[0]->coordinador<>'')
                {
                    $emails[]=array('nombres'=>$consulEmailCoordinador[0]->nomb_ejecutivo,'email'=>$consulEmailCoordinador[0]->email);
                }
            }
            if (count($consulEmailGerZonal)>0){
                if ($consulEmailGerZonal[0]->gerzonal<>'')
                {
                    $emails[]=array('nombres'=>$consulEmailGerZonal[0]->nomb_ejecutivo,'email'=>$consulEmailGerZonal[0]->email);
                }
            }

            if (strtoupper(trim($consulEmailEjecutivo[0]->ubigeo)) == 'LIMA'){
                $emails[]=array('nombres'=>'Leonardo','email'=>'lduarez@intercorp.com.pe');
            }else{
                $emails[]=array('nombres'=>'Gino','email'=>'gtori@intercorp.com.pe');
            }

            //$emails[]=array('nombres'=>'Roberto','email'=>'roblitas@ttaudit.com');
            $emails[]=array('nombres'=>'Camila','email'=>'ctavera@ttaudit.com');
            $emails[]=array('nombres'=>'Daniela','email'=>'dolaguibel@ttaudit.com');
            $emails[]=array('nombres'=>'Jaime','email'=>'jcdiaz356@gmail.com');
            $emails[]=array('nombres'=>'Elba','email'=>'ellerena@ttaudit.com');
            $emails[]=array('nombres'=>'Carlos Medina','email'=>'cmedinap@intercorp.com.pe');
            $emails[]=array('nombres'=>'Franco','email'=>'franbrsj@gmail.com');
            $emails[]=array('nombres'=>'Karina','email'=>'Kpalominof@intercorp.com.pe');

            if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['externo'])  or ($poll_id['poll_id']==$valoresCampaigne[$company_id]['interno'])){
                //$emails[]=array('nombres'=>'Karina','email'=>'ecastillor@intercorp.com.pe');
            }

            if (($poll_id['poll_id']==$valoresCampaigne[$company_id]['cerrado']) and ($result['result']==0)){
                if ($consulCiudad[0]->ubigeo == 'PIURA')
                {
                    $emails[]=array('nombres'=>'Henriquez','email'=>'jhenriquez@intercorp.com.pe');
                    $emails[]=array('nombres'=>'Oliva','email'=>'jolivam@intercorp.com.pe');
                }
                if ($consulCiudad[0]->ubigeo == 'LA LIBERTAD')
                {
                    $emails[]=array('nombres'=>'Henriquez','email'=>'jhenriquez@intercorp.com.pe');
                    $emails[]=array('nombres'=>'Nuñez','email'=>'rnuñezg@intercorp.com.pe');

                }
                if ($consulCiudad[0]->ubigeo == 'LAMBAYEQUE')
                {
                    $emails[]=array('nombres'=>'Henriquez','email'=>'jhenriquez@intercorp.com.pe');
                    $emails[]=array('nombres'=>'Jimenez','email'=>'ajimenezf@intercorp.com.pe');
                }
            }
            if (count($emails)>0){$c=0;$ListEmails='';
                foreach ($emails as $email) {
                    $c=$c+1;
                    $ListEmails .= $email['email'].":".$email['nombres'];
                    if (count($emails)>$c){
                        $ListEmails .= "|";
                    }
                    $envio = ['responsable' => $email['nombres'],'email' =>$email['email'], 'subject' =>$textoEmail];
                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });
                }

                DB::update("UPDATE  alerts set emails= ? where id = ?" , array($ListEmails, $idAlertInsert));
            }

        }
        if (($soloTtaudit==1) and ($sw==1))
        {
            if ($poll_id['poll_id']==$valoresCampaigne[$company_id]['cobro']){
                $emails[]=array('nombres'=>'Karina','email'=>'Kpalominof@intercorp.com.pe');
            }
            $emails[]=array('nombres'=>'Camila','email'=>'ctavera@ttaudit.com');
            $emails[]=array('nombres'=>'Elba','email'=>'ellerena@ttaudit.com');
            $emails[]=array('nombres'=>'Franco','email'=>'franbrsj@gmail.com');
            $emails[]=array('nombres'=>'Mauricio','email'=>'mmontenegro@ttaudit.com');

            if (count($emails)>0){$c=0;$ListEmails='';

                foreach ($emails as $email) {
                    $c=$c+1;
                    $ListEmails .= $email['email'].":".$email['nombres'];
                    if (count($emails)>$c){
                        $ListEmails .= "|";
                    }
                    $envio = ['responsable' => $email['nombres'],'email' =>$email['email'], 'subject' =>$textoEmail];

                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });

                }
                DB::update("UPDATE  alerts set emails= ? where id = ?" , array($ListEmails, $idAlertInsert));
            }
        }

        if ($idPollDetail >0){
            if ($status['status']==1){
                DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema,$idcompany['idCompany'], $idroute['idRuta'], $idaudit['idAuditoria'], $store_id['store_id'] ));
            }

            return \Response::json([ 'success'=> 1]);
        }else{
            return \Response::json([ 'success'=> 0]);
        }
    }else{
        return \Response::json([ 'success'=> 1]);
    }


}]);

Route::post('insertImagesPoll', ['as' =>'insertImagesPoll', function(){
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $tipo = Input::only('tipo');
    $archivo = Input::only('archivo');
    $company_id = Input::only('company_id');

    DB::insert("INSERT INTO medias (store_id,poll_id, tipo,archivo,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($store_id['store_id'],$poll_id['poll_id'], $tipo['tipo'], $archivo['archivo'], $company_id['company_id'],$horaSistema,$horaSistema));

    return \Response::json([ 'success'=> 1]);
}]);

//bayer
Route::post('uploadImagesAuditBayer', ['as' =>'uploadImagesAuditBayer', function(){


    if(Input::hasFile('fotoUp')) {
        $archivo=Input::file('fotoUp');
        $archivo->move('media/fotos/',$archivo->getClientOriginalName());
    }

    $product_id = Input::only('product_id');
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $tipo = Input::only('tipo');
    $archivo = Input::only('archivo');
    $company_id = Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();



    DB::insert("INSERT INTO medias (store_id,poll_id,product_id, tipo,archivo,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$poll_id['poll_id'],$product_id['product_id'], $tipo['tipo'], $archivo['archivo'], $company_id['company_id'],$horaSistema,$horaSistema));

    return \Response::json([ 'success'=> 1]);
}]);

Route::post('insertImagesPublicities', ['as' =>'insertImagesPublicities', function(){

    $publicities_id = Input::only('publicities_id');
    $store_id = Input::only('store_id');
    $tipo = Input::only('tipo');
    $archivo = Input::only('archivo');
    $company_id =Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO medias (store_id,publicities_id, tipo,archivo, company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($store_id['store_id'],$publicities_id['publicities_id'], $tipo['tipo'], $archivo['archivo'],$company_id['company_id'],$horaSistema,$horaSistema));

    return \Response::json([ 'success'=> 1]);
}]);
Route::post('insertImagesProductPoll', ['as' =>'insertImagesProductPoll', function(){

    $product_id = Input::only('product_id');
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $tipo = Input::only('tipo');
    $archivo = Input::only('archivo');
    $company_id = Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO medias (store_id,poll_id,product_id, tipo,archivo,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($store_id['store_id'],$poll_id['poll_id'],$product_id['product_id'], $tipo['tipo'], $archivo['archivo'], $company_id['company_id'],$horaSistema,$horaSistema));

    return \Response::json([ 'success'=> 1]);
}]);
Route::post('insertImagesInvoices', ['as' =>'insertImagesInvoices', function(){

    $invoices_id = Input::only('invoices_id');
    $store_id = Input::only('store_id');
    $tipo = Input::only('tipo');
    $archivo = Input::only('archivo');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO medias (store_id,invoices_id, tipo,archivo, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($store_id['store_id'],$invoices_id['invoices_id'], $tipo['tipo'], $archivo['archivo'],$horaSistema,$horaSistema));

    return \Response::json([ 'success'=> 1]);
}]);

Route::post('uploadImagesAudit', ['as' =>'uploadImagesAudit', function(){
    if(Input::hasFile('fotoUp')) {
        $archivo=Input::file('fotoUp');
        $archivo->move('media/fotos/',$archivo->getClientOriginalName());
    }

    return \Response::json([ 'success'=> 1]);
}]);

Route::post('insertaTiempoNew', ['as' =>'insertaTiempoNew', function(){

    $latitud_close= Input::only('latitud_close');
    $longitud_close = Input::only('longitud_close');
    $latitud_open = Input::only('latitud_open');
    $longitud_open = Input::only('longitud_open');
    $tiempo_inicio  = Input::only('tiempo_inicio');
    $tiempo_fin = Input::only('tiempo_fin');
    $tduser = Input::only('tduser');
    $storeid = Input::only('id');
    $idruta = Input::only('idruta');
    $company_id = Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();


    DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? " , array($horaSistema,$storeid ['id'], $idruta['idruta']));
    //DB::insert("INSERT INTO control_time (closes,user_id, store_id,lat_close,long_close, lat_open,long_open,time_open,time_close,company_id, created_at,updated_at) VALUES('store',?,?,?,?,?,?,?,?,?,?,?)" , array($tduser['tduser'],$storeid['id'], $latitud_close['latitud_close'], $longitud_close['longitud_close'],$latitud_open['latitud_open'],$longitud_open['longitud_open'],$tiempo_inicio['tiempo_inicio'],$tiempo_fin['tiempo_fin'],$company_id['company_id'],$horaSistema,$horaSistema));
    $idPollDetail = DB::getPdo()->lastInsertId();

    $sql = "SELECT * FROM road_details r where road_id='" . $idruta['idruta'] . "' and audit=0 ";
    $consulta1 = DB::select($sql);
    if (count($consulta1) == 0){
        DB::update("UPDATE  roads set audit= 1, updated_at=? where id = ? " , array($horaSistema,$idruta['idruta']));//update de la ruta
    }

    return \Response::json([ 'success'=> 1]);



}]);

Route::post('insertaTiempo', ['as' =>'insertaTiempo', function(){

    $latitud_close= Input::only('latitud_close');
    $longitud_close = Input::only('longitud_close');
    $latitud_open = Input::only('latitud_open');
    $longitud_open = Input::only('longitud_open');
    $tiempo_inicio  = Input::only('tiempo_inicio');
    $tiempo_fin = Input::only('tiempo_fin');
    $tduser = Input::only('tduser');
    $storeid = Input::only('id');
    $idruta = Input::only('idruta');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();


    DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? " , array($horaSistema,$storeid ['id'], $idruta['idruta']));
    DB::insert("INSERT INTO control_time (closes,user_id, store_id,lat_close,long_close, lat_open,long_open,time_open,time_close, created_at,updated_at) VALUES('store',?,?,?,?,?,?,?,?,?,?)" , array($tduser['tduser'],$storeid['id'], $latitud_close['latitud_close'], $longitud_close['longitud_close'],$latitud_open['latitud_open'],$longitud_open['longitud_open'],$tiempo_inicio['tiempo_inicio'],$tiempo_fin['tiempo_fin'],$horaSistema,$horaSistema));
    $idPollDetail = DB::getPdo()->lastInsertId();

    $sql = "SELECT * FROM road_details r where road_id='" . $idruta['idruta'] . "' and audit=0";
    $consulta1 = DB::select($sql);
    if (count($consulta1) == 0){
        DB::update("UPDATE  roads set audit= 1, updated_at=? where id = ? " , array($horaSistema,$idruta['idruta']));//update de la ruta
    }
    if ($idPollDetail >0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }


}]);
Route::post('insertaTiempoPalmera', ['as' =>'insertaTiempoPalmera', function(){

    $latitud_close= Input::only('latitud_close');
    $longitud_close = Input::only('longitud_close');
    $latitud_open = Input::only('latitud_open');
    $longitud_open = Input::only('longitud_open');
    $tiempo_inicio  = Input::only('tiempo_inicio');
    $tiempo_fin = Input::only('tiempo_fin');
    $tduser = Input::only('tduser');
    $storeid = Input::only('id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();


    $idPollDetail = DB::insert("INSERT INTO control_time (closes,user_id, store_id,lat_close,long_close, lat_open,long_open,time_open,time_close, created_at,updated_at) VALUES('store',?,?,?,?,?,?,?,?,?,?)" , array($tduser['tduser'],$storeid['id'], $latitud_close['latitud_close'], $longitud_close['longitud_close'],$latitud_open['latitud_open'],$longitud_open['longitud_open'],$tiempo_inicio['tiempo_inicio'],$tiempo_fin['tiempo_fin'],$horaSistema,$horaSistema));

    if ($idPollDetail >0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }


}]);



Route::post('deletePhotoSOD', ['as' =>'deletePhotoSOD', function(){
    //$company_id = Input::only('company_id');
    $publicityDetail_id = Input::only('publicityDetail_id');
    $media_id= Input::only('media_id');
    $responseDeletePubli = Input::only('responseDeletePubli');
    $filePhoto = Input::only('filePhoto');
    $urlPhoto = Input::only('url_photo');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    if ($responseDeletePubli['responseDeletePubli']==1){
        DB::table('publicity_details')->where('id', $publicityDetail_id['publicityDetail_id'])->delete();
    }
    DB::table('medias')->where('id', $media_id['media_id'])->delete();
    $nombre_fichero = "media/fotos/".$filePhoto['filePhoto'];
    if (file_exists($nombre_fichero))
    {
        unlink($nombre_fichero);
    }
        //DB::update("UPDATE  publicity_details set sod= ?,photo = ?, updated_at=? where id = ? " , array($sod['sod'],$foto['foto'],$horaSistema,$publicityDetail_id['publicityDetail_id']));
    header('Access-Control-Allow-Origin: *');
    return \Response::json([ 'success'=> 1]);
}]);

Route::post('saveRoute', ['as' =>'saveRoute', function(){
    //$company_id = Input::only('company_id');
    $user_id = Input::only('user_id');
    $id_store = Input::only('id_store');
    $nombreRuta = Input::only('nombreRuta');
    $date = Input::only('date');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO roads (fullname,user_id,f_ejecucion, created_at,updated_at) VALUES(?,?,?,?,?)" , array($nombreRuta['nombreRuta'],$user_id['user_id'],$date['date'],$horaSistema,$horaSistema));
    $idPollDetail = DB::getPdo()->lastInsertId();
    if ($idPollDetail >0){
        for($i = 0; $i < count($id_store['id_store']); ++$i) {
            $valores = explode('|',$id_store['id_store'][$i]);
            DB::insert("INSERT INTO road_details (store_id,audit,road_id, company_id,created_at,updated_at) VALUES(?,0,?,?,?,?)" , array($valores[0],$idPollDetail,$valores[1],$horaSistema,$horaSistema));
            $sql1="SELECT audit_id FROM company_audits c where company_id='".$valores[1]."' and audit=1";
            $consulta1 = DB::select($sql1);
            if (count($consulta1)>0){
                foreach ($consulta1 as $v) {
                    DB::insert("INSERT INTO audit_road_stores (company_id,road_id,audit_id,store_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($valores[1],$idPollDetail,$v->audit_id,$valores[0],$horaSistema,$horaSistema));
                }
                DB::update("UPDATE  stores set ruteado= 1, updated_at=? where id = ? " , array($horaSistema,$valores[0]));
                DB::update("UPDATE  company_stores set ruteado= 1, updated_at=? where company_id = ? and store_id= ? " , array($horaSistema,$valores[1],$valores[0]));
            }
        }
    }
    header('Access-Control-Allow-Origin: *');
    return \Response::json([ 'success'=> 1]);


}]);
//valor temp
Route::post('insertaProductCompany', ['as' =>'insertaProductCompany', function(){
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    $sql1="SELECT id FROM products where company_id=11";
    $consulta1 = DB::select($sql1);
    foreach ($consulta1 as $valor) {
        DB::insert("INSERT INTO product_detail (product_id,company_id, created_at,updated_at) VALUES(?,?,?,?)" , array($valor->id,11,$horaSistema,$horaSistema));
    }

    return \Response::json([ 'success'=> 1]);


}]);

//valor temp
Route::post('insertaRoadDetails', ['as' =>'insertaRoadDetails', function(){
//Alicorp Mayoristas

    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $mercado=94888;
    $company_id=275;
    $user_id=1542;
    $f_ejecucion='2019-05-25';
    $nomb_ruta ="Mistery Giuliana Arequipa 25/05";
    $horaSistema = $mytime->toDateTimeString();$c=0;$sw=0;
    DB::insert("INSERT INTO roads (fullname,user_id, audit, f_ejecucion, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($nomb_ruta,$user_id,0,$f_ejecucion,$horaSistema,$horaSistema));
    $road_id = DB::getPdo()->lastInsertId();
    //$road_id =13477;
    //$sql1="SELECT store_id,nivel FROM road_details where road_id='".$road_id."' and company_id='".$company_id."'";
    $sql1="SELECT id FROM stores where id>=315401 and id<=315408";
    $consulta1 = DB::select($sql1);//dd($consulta1);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {
            // $sql2="SELECT store_id FROM company_stores c where company_id='".$company_id."' and store_id='".$valor->id."'";
            // $consulta2 = DB::select($sql2);
            // if (count($consulta2)==0){
            //     $sw=1;
            //     DB::insert("INSERT INTO company_stores (company_id,store_id, ruteado, created_at,updated_at) VALUES(?,?,?,?,?)" , array($company_id,$valor->id,1,$horaSistema,$horaSistema));
            // }else{
            //     $sw=0;
            //     DB::update("UPDATE  company_stores set ruteado= 1, updated_at=? where  store_id = ? and company_id= ?" , array($horaSistema,$valor->id,$company_id));
            // }

            //DB::insert("INSERT INTO company_stores (company_id,store_id, ruteado, created_at,updated_at) VALUES(?,?,?,?,?)" , array($company_id,$valor->id,1,$horaSistema,$horaSistema));
            if ($c==0){
                //DB::insert("INSERT INTO road_details (company_id,store_id, audit, road_id,nivel, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$mercado,0,$road_id,1,$horaSistema,$horaSistema));
            }
            DB::insert("INSERT INTO road_details (company_id,store_id, audit, road_id,nivel, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor->id,0,$road_id,1,$horaSistema,$horaSistema));
            /*$sql11="SELECT store_id FROM market_details c where store_id='".$mercado."' and point_id='".$valor->id."' and company_id='".$company_id."'";
            $consulta11 = DB::select($sql11);
            if (count($consulta11)==0){
                DB::insert("INSERT INTO market_details (company_id,store_id, point_id, cuota_venta, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($company_id,$mercado,$valor->id,'0',$horaSistema,$horaSistema));
            }*/

            $sql2="SELECT audit_id FROM company_audits c where company_id='".$company_id."'";
            $consulta2 = DB::select($sql2);
            foreach ($consulta2 as $valor1) {
                DB::insert("INSERT INTO audit_road_stores (company_id,road_id, audit_id,store_id,audit,visit_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($company_id,$road_id, $valor1->audit_id,$valor->id,0,0,$horaSistema,$horaSistema));
            }
            $c=$c+1;
            //DB::insert("INSERT INTO visit_stores (company_id, store_id, visit_id,road_id,ruteado, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor->id,1,$road_id,0,$horaSistema,$horaSistema));

            /*$sql12="SELECT road_id FROM visit_stores c where store_id='".$valor->id."' and visit_id='1' and ruteado='0' and company_id='".$company_id."'";
            $consulta11 = DB::select($sql12);
            if (count($consulta11)<>0){
                foreach ($consulta11 as $valor1) {
                    $road_id_ant=$valor1->road_id;
                }
                DB::update("UPDATE  visit_stores set ruteado= 1, updated_at=? where visit_id = ? and store_id = ? and company_id= ? and road_id= ?" , array($horaSistema,1,$valor->id,$company_id,$road_id_ant));
            }*/

        }
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);

//valor temp
Route::post('insertaConstancias', ['as' =>'insertaConstancias', function(){
//Bayer Constancias
    $mytime = Carbon\Carbon::now();
    $mytime->setTimezone('America/Lima');
    $company_id=77;
    $horaSistema = $mytime->toDateTimeString();
    $sql1="SELECT store_id,road_id FROM road_details r where company_id='".$company_id."'";//ini:45599 fin:45883
    $consulta1 = DB::select($sql1);//dd($consulta1);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {
            $mercado=$valor->store_id;
            $road_id=$valor->road_id;

            $sql2="SELECT point_id FROM market_details r where store_id='".$mercado."' and company_id='".$company_id."'";
            $consulta2 = DB::select($sql2);
            if (count($consulta2)>0){
                $c=0;
                foreach ($consulta2 as $valor2) {
                    if ($c==0){
                        DB::update("UPDATE  audit_road_stores set store_id= ?, updated_at=? where store_id = ? and company_id= ? and road_id= ?" , array($valor2->point_id,$horaSistema,$mercado,$company_id,$road_id));
                    }else{
                        $sql3="SELECT audit_id FROM company_audits c where company_id='".$company_id."'";
                        $consulta3 = DB::select($sql3);
                        foreach ($consulta3 as $valor3) {
                            DB::insert("INSERT INTO audit_road_stores (company_id,road_id, audit_id,store_id,audit, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$road_id, $valor3->audit_id,$valor2->point_id,0,$horaSistema,$horaSistema));
                        }
                    }
                    DB::insert("INSERT INTO road_details (company_id,store_id, audit, road_id,nivel, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($company_id,$valor2->point_id,0,$road_id,0,$horaSistema,$horaSistema));
                    $c=$c+1;
                }
            }

        }
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }




}]);

//valor temp
Route::post('insertaCompanyStores', ['as' =>'insertaCompanyStores', function(){

    $sql1="SELECT id FROM stores where id>37258 and id <= 37458";
    $consulta1 = DB::select($sql1);
    $mytime = Carbon\Carbon::now();
    foreach ($consulta1 as $valor) {
        $horaSistema = $mytime->toDateTimeString();
        DB::insert("INSERT INTO company_stores (company_id,store_id,ruteado, created_at,updated_at) VALUES(?,?,?,?,?)" , array(65,$valor->id,0,$horaSistema,$horaSistema));
    }
    return \Response::json([ 'success'=> 1]);


}]);
Route::get('getPointStores', ['as' =>'getPointStores', function(){

    $sql1="SELECT id,fullname,address, urbanization as referencia,district,region as provincia,ubigeo as departamento,codclient, latitude as latitud,longitude as longitud  FROM stores s where ruteado=0 and latitude<>0";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getPointStoresForCompany', ['as' =>'getPointStoresForCompany', function(){
    $company_id= Input::only('company_id');

    $sql1="SELECT
  stores.id,stores.fullname,stores.address, stores.urbanization as referencia,stores.district,
  stores.region as provincia,
  stores.ubigeo as departamento,
  stores.codclient,
  stores.latitude as latitud,
  stores.longitude as longitud
FROM
  company_stores
  INNER JOIN stores ON (company_stores.store_id = stores.id)
WHERE
  company_stores.company_id = '".$company_id['company_id']."' AND
  stores.ruteado = 0";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getPointStoresForCompanyDepartament', 'CompanyStoreController@getStoresForRoutingForCity');
Route::post('getPointStoresForCompanyDepartamentVisits', 'CompanyStoreController@getStoresForRoutingForCityVisits');
Route::post('getPointStoresForVisit', 'CompanyStoreController@getStoresForRoutingForCompanyVisit');


Route::post('getAuditores', ['as' =>'getAuditores', function(){

    $sql1="SELECT users.id,users.fullname AS Auditor FROM users WHERE users.type ='auditor' order by users.fullname DESC";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);
Route::post('getRutasxUser', ['as' =>'getRutasxUser', function(){
    $user_id = Input::only('user_id');
    $sql1="SELECT roads.id, roads.fullname, roads.created_at FROM roads WHERE roads.user_id = '".$user_id['user_id']."' ORDER BY  roads.created_at DESC";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);
Route::post('getStoresxRoad', ['as' =>'getStoresxRoad', function(){
    $road_id = Input::only('road_id');
    $sql1="SELECT stores.id, stores.fullname,stores.address, stores.urbanization as referencia, stores.district, stores.region as provincia, stores.ubigeo as departamento,stores.codclient, stores.latitude, stores.longitude as longitud FROM  stores INNER JOIN road_details ON (stores.id = road_details.store_id) WHERE road_details.road_id = '".$road_id['road_id']."' ORDER BY road_details.updated_at DESC";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getDistrictxRegion', ['as' =>'getDistrictxRegion', function(){
    $region = Input::only('region');
    $sql1="SELECT district as id, district as fullname,region FROM stores s where s.region = '".$region['region']."' group by s.district";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getProductsForCategory', ['as' =>'getProductsForCategory', function(){
    $category_id = Input::only('category_id');
    $company_id = Input::only('company_id');
    $sql1="SELECT
  `presences`.`id`,
  `products`.`fullname`
FROM
  `presences`
  INNER JOIN `products` ON (`presences`.`product_id` = `products`.`id`)
WHERE
  `products`.`category_product_id` = '".$category_id['category_id']."' AND
  `presences`.`company_id` = '".$company_id['company_id']."'";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getEjecutivoxRegionxDistric', ['as' =>'getEjecutivoxRegionxDistric', function(){
    $arrayDistrict = Input::only('district');
    $valDistrict = explode('|',$arrayDistrict['district']);
    $region = $valDistrict[0];
    $district = $valDistrict[1];
    $sql1 = "SELECT ejecutivo as id, nomb_ejecutivo as fullname,region,district FROM stores s where s.region = '".$region."' and s.district='".$district."' and s.ejecutivo<>'' group by s.ejecutivo";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getRubroxEjecxRegionxDistric', ['as' =>'getRubroxEjecxRegionxDistric', function(){
    $arrayEjecutivo = Input::only('ejecutivo');
    $valEjecutivo = explode('|',$arrayEjecutivo['ejecutivo']);
    $region = $valEjecutivo[0];
    $district = $valEjecutivo[1];
    $ejecutivo = $valEjecutivo[2];
    $sql1 = "SELECT id,rubro as id, rubro as fullname,region,district,ejecutivo FROM stores s where s.region = '".$region."' and s.district='".$district."' and s.ejecutivo='".$ejecutivo."' group by s.rubro";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getEjecutivos', ['as' =>'getEjecutivos', function(){

    //$sql1 = "SELECT ejecutivo as id, ejecutivo as fullname FROM stores s where ejecutivo<>'' group by ejecutivo";
    $sql1 = "SELECT 
  `stores`.`ejecutivo` as id, `stores`.`ejecutivo` as fullname
FROM
  `companies`
  INNER JOIN `customers` ON (`companies`.`customer_id` = `customers`.`id`)
  INNER JOIN `company_stores` ON (`companies`.`id` = `company_stores`.`company_id`)
  INNER JOIN `stores` ON (`company_stores`.`store_id` = `stores`.`id`)
WHERE
  `customers`.`id` = 1 and `stores`.`ejecutivo`<>''
GROUP BY
  `stores`.`ejecutivo`";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('getEjecutivosForCompany', ['as' =>'getEjecutivos', function(){
    $company_id = Input::only('company_id');
    $sql1 = "SELECT 
  `stores`.`ejecutivo` as id, `stores`.`nomb_ejecutivo` as fullname
FROM
  `company_stores`
  INNER JOIN `stores` ON (`company_stores`.`store_id` = `stores`.`id`)
WHERE
  `company_stores`.`company_id` = '".$company_id['company_id']."' AND 
  `stores`.`test` = 0
GROUP BY
  `stores`.`ejecutivo`";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);
Route::post('getAuditors', ['as' =>'getAuditors', function(){

    $sql1 = "SELECT id,fullname FROM users u where type='auditor' and active='1' order by fullname desc";
    header('Access-Control-Allow-Origin: *');
    //header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');

    return \Response::json( DB::select($sql1));
}]);
Route::post('getRubros', ['as' =>'getRubros', function(){
    $company_id = Input::only('company_id');
    $sql1 = "SELECT
  `poll_options`.`id`,
  `poll_options`.`options` AS `fullname`
FROM
  `polls`
  INNER JOIN `company_audits` ON (`polls`.`company_audit_id` = `company_audits`.`id`)
  INNER JOIN `poll_options` ON (`polls`.`id` = `poll_options`.`poll_id`)
WHERE
  `company_audits`.`company_id` = '".$company_id['company_id']."' AND 
  `polls`.`question` = 'Indicar Rubro'";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);
Route::post('getTransaccion', ['as' =>'getTransaccion', function(){
    $company_id = Input::only('company_id');
    $sql1 = "SELECT
  `poll_options`.`id`,
  `poll_options`.`options` AS `fullname`
FROM
  `polls`
  INNER JOIN `company_audits` ON (`polls`.`company_audit_id` = `company_audits`.`id`)
  INNER JOIN `poll_options` ON (`polls`.`id` = `poll_options`.`poll_id`)
WHERE
  `company_audits`.`company_id` = '".$company_id['company_id']."' AND 
  `polls`.`question` = 'Escoger tipo de Transacción'";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::get('getCompanies', ['as' =>'getCompanies', function(){

    $sql1 = "SELECT id,fullname FROM companies c where active=1";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::get('getDepartmentCompanies', ['as' =>'getCompanies', function(){
    /*$company_id = Input::only('company_id');*/
    /*$sql1 = "SELECT  ubigeo
FROM  stores INNER JOIN company_stores ON (stores.id = company_stores.store_id)
WHERE company_stores.company_id ='" .  $company_id['company_id'] . "' and stores.test=0 group by ubigeo";*/
    $sql1 = "SELECT  stores.id,stores.ubigeo,company_stores.company_id
FROM  stores INNER JOIN company_stores ON (stores.id = company_stores.store_id)
WHERE stores.test=0 and company_stores.ruteado=0 group by ubigeo";
    header('Access-Control-Allow-Origin: *');

    return \Response::json( DB::select($sql1));
}]);

Route::post('JsonListProducts', ['as' =>'JsonListProducts', function(){//Observación productos
    $company_id = Input::only('company_id');
    if ($company_id==''){
        $sql = "SELECT products.id, products.fullname, products.eam, products.precio, products.company_id,category_products.id AS category_id, category_products.fullname AS categoria, products.imagen
            FROM products INNER JOIN category_products ON (products.category_product_id = category_products.id)";
    }else{
        $sql = "SELECT products.id, products.fullname, products.eam, products.precio, products.company_id,category_products.id AS category_id, category_products.fullname AS categoria, products.imagen
            FROM products INNER JOIN category_products ON (products.category_product_id = category_products.id) where products.company_id='" . $company_id['company_id']  . "'";
    }

    return \Response::json([ 'success'=> 1, "products" => DB::select($sql)]);


}]);

Route::post('JsonListProductsCompany', ['as' =>'JsonListProductsCompany', function(){
    $company_id = Input::only('company_id');
    $sql = "SELECT
  `products`.`id`,
  `products`.`fullname`,
  `products`.`eam`,
  `products`.`precio`,
  `product_detail`.`company_id`,
  `category_products`.`id` AS `category_id`,
  `category_products`.`fullname` AS `categoria`,
  `products`.`imagen`
FROM
  `product_detail`
  LEFT OUTER JOIN `products` ON (`product_detail`.`product_id` = `products`.`id`)
  INNER JOIN `category_products` ON (`products`.`category_product_id` = `category_products`.`id`)
WHERE
  `product_detail`.`company_id` = '".$company_id['company_id']."'";

    return \Response::json([ 'success'=> 1, "products" => DB::select($sql)]);


}]);

//alicorp
Route::post('JsonInsertPollOptionPubli',['as' => 'JsonInsertPollOptionPubli', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $opcion = Input::only('opcion');
    $publicity_id = Input::only('publicity_id');
    $company_id = Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    $sql2 = "SELECT id FROM poll_details p where poll_id='" .$poll_id['poll_id']. "' and store_id='".$store_id['store_id']."' and options=1 and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'";
    $consulta22 = DB::select($sql2);
    if (count($consulta22)==0){
        DB::insert("INSERT INTO poll_details (poll_id, options, store_id,company_id,publicity_id, created_at,updated_at) VALUES(?,1,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));

        $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
        $consulta1 = DB::select($sql1);

        if (count($consulta1)>0){
            $sql3 = "SELECT id FROM poll_option_details p where poll_option_id='" .$consulta1[0]->id. "' and store_id='".$store_id['store_id']."' and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'";
            $consulta3 = DB::select($sql3);
            if (count($consulta3)==0){
                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,publicity_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
            }
        }else{
            return \Response::json([ 'success'=> 0]);
        }
    }else{
        return \Response::json([ 'success'=> 0]);
    }
    if ($idPollDetail >0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);

//alicorp
Route::post('saveExhibidorBodegaAlicorp', 'Api\AlicorpController@saveExhibidorBodegaAlicorp');

Route::post('insertImagesPublicitiesAlicorp', 'Api\AlicorpController@insertImagesPublicitiesAlicorp');
Route::post('insertImagesProductPollAlicorp', 'Api\AlicorpController@insertImagesProductPollAlicorp');
Route::post('insertImagesAlicorp', 'Api\AlicorpController@insertImagesAlicorp');
Route::post('insertImages', 'PollDetailController@insertImages');
Route::post('insertImagesMayorista', 'PollDetailController@insertImagesMayorista');
Route::post('insertDataImages', 'PollDetailController@insertDataImages');
Route::post('insertFileImages', 'PollDetailController@insertFileImages');
Route::post('closeAudit', 'Api\AlicorpController@closeAudit');
Route::post('savePollDetails', 'PollDetailController@index');
Route::post('savePollDetailsReg', 'PollDetailController@saveRegisters');
Route::post('savePollDetailsNew', 'PollDetailController@savePollsNew');

Route::post('savePollDetailsRegAllProduct', 'PollDetailController@saveReg2');
Route::post('updateStore', 'StoreController@index');

Route::resource('data', 'Api\AlicorpController');

//alicorp
Route::post('JsonInsertPollsAlicorp',['as' => 'JsonInsertPollsAlicorp', function(){
    $poll_id = Input::only('poll_id');
    $store_id = Input::only('store_id');
    $sino = Input::only('sino');
    $options = Input::only('options');
    $media = Input::only('media');
    $coment = Input::only('coment');
    $comentario = Input::only('comentario');
    $opcion = Input::only('opcion');
    $result = Input::only('result');

    $company_id = Input::only('company_id');
    $idroute  = Input::only('idroute');
    $idaudit = Input::only('idaudit');
    $status = Input::only('status');
    $publicity_id = Input::only('publicity_id');
    $coment_options = Input::only('coment_options');
    $comentario_options = Input::only('comentario_options');

    $idPollDetail=0;
    if ($publicity_id['publicity_id']=="0")
    {
        $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$company_id['company_id']."'";
    }else{
        $sqlnum="SELECT count(id) as numero FROM poll_details where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'";
    }

    $consultaNum = DB::select($sqlnum);
    $NumPollDetails = $consultaNum[0]->numero;

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();
    $sql2="SELECT fullname FROM companies where id='" . $company_id['company_id'] . "'";
    $consulta2 = DB::select($sql2);
    //$valoresAlicorp[36] = array('abierto' => 489,'permitio' => 490,'opcionNoClientePerfecto' => '490c','opcionNoRecibeMerca' => '490a','pruebas'=>1);
    $valoresAlicorp[43] = array('abierto' => 563,'permitio' => 564,'opcionNoClientePerfecto' => '564c','opcionNoRecibeMerca' => '564a','pruebas'=>0);
    $valoresAlicorp[46] = array('abierto' => 617,'permitio' => 618,'opcionNoClientePerfecto' => '618c','opcionNoRecibeMerca' => '618a','pruebas'=>0);
    $valoresAlicorp[53] = array('abierto' => 756,'permitio' => 757,'opcionNoClientePerfecto' => '757c','opcionNoRecibeMerca' => '757a','pruebas'=>0);
    $valoresAlicorp[68] = array('abierto' => 973,'permitio' => 974,'opcionNoClientePerfecto' => '974c','opcionNoRecibeMerca' => '974a','pruebas'=>0);

    if ($consultaNum[0]->numero==0){
        $sqlauditor="SELECT user_id,auditor FROM roads_resume where store_id='".$store_id['store_id']."'  and company_id='".$company_id['company_id']."'";
        $consultaAuditor = DB::select($sqlauditor);
        $auditor = $consultaAuditor[0]->auditor."(".$consultaAuditor[0]->user_id.")";

        if ($status['status']==0){
            if (($sino['sino']==1) and ($options['options']<>1)  and ($media['media']<>1) and ($coment['coment']==1)){

                DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,coment,result,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$comentario['comentario'],$company_id['company_id'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
            }
            if (($sino['sino']==1) and ($options['options']==1)  and ($media['media']<>1) and ($coment['coment']<>1) and ($publicity_id['publicity_id']<>0) and ($coment_options['coment_options']<>0)){

                if ($NumPollDetails==0)
                {
                    DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,coment,result,comentario,company_id,publicity_id,options,comentOptions, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$comentario['comentario'],$company_id['company_id'],$publicity_id['publicity_id'],$options['options'],$coment_options['coment_options'],$horaSistema,$horaSistema));
                }else{
                    DB::update("UPDATE  poll_details set poll_id=?, store_id=?, sino=?,coment=?,result=?,comentario=?,company_id=?,publicity_id=?,options=?,comentOptions=?, created_at=?,updated_at=? where poll_id='" . $poll_id['poll_id'] . "' and store_id='".$store_id['store_id']."' and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$coment['coment'],$result['result'],$comentario['comentario'],$company_id['company_id'],$publicity_id['publicity_id'],$options['options'],$coment_options['coment_options'],$horaSistema,$horaSistema));
                }

                $opciones = explode('|',$opcion['opcion']);
                foreach ($opciones as $valor) {
                    if ($valor<>''){
                        $sql1="SELECT id,options,codigo FROM poll_options where codigo='" . $valor . "' and poll_id='".$poll_id['poll_id']."'";
                        $consulta1 = DB::select($sql1);

                        if (count($consulta1)>0){
                            if ($consulta1[0]->options == 'Otros'){
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, otro, store_id,company_id,publicity_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,$comentario_options['comentario_options'],$store_id['store_id'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));
                            }else{
                                DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id,publicity_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));
                            }
                        }
                    }
                }

            }

        }
        if (($sino['sino']==1) and ($options['options']==1)  and (($media['media']==0) or ($media['media']==1)) and ($coment['coment']==1)){

            DB::insert("INSERT INTO poll_details (poll_id, store_id,sino,media,coment,result,comentario, options,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],1,1,1,$result['result'],$comentario['comentario'],$options['options'],$company_id['company_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
            if ($opcion['opcion']<>''){
                $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
                $consulta1 = DB::select($sql1);

                if (count($consulta1)>0){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$horaSistema,$horaSistema));
                }
            }

        }

        if ($status['status']==1){
            if (($sino['sino']==1) and ($options['options']<>1)  and ($media['media']==1) and ($coment['coment']==1)){

                DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,media,coment,result,comentario,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$sino['sino'],$media['media'],$coment['coment'],$result['result'],$comentario['comentario'],$company_id['company_id'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
                DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id= ?" , array($horaSistema,$store_id['store_id'],  $idroute['idroute'], $company_id['company_id']));
                //return \Response::json([ 'success'=> 1]);

            }
            if (($sino['sino']<>1) and ($options['options']==1)  and ($media['media']<>1) and ($coment['coment']<>1)){

                DB::insert("INSERT INTO poll_details (poll_id, store_id, options,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],$options['options'],$company_id['company_id'],$horaSistema,$horaSistema));
                $idPollDetail = DB::getPdo()->lastInsertId();
                $sql1="SELECT id,options FROM poll_options where codigo='" . $opcion['opcion'] . "'";
                $consulta1 = DB::select($sql1);

                if (count($consulta1)>0){
                    DB::insert("INSERT INTO poll_option_details (poll_option_id, result,store_id,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($consulta1[0]->id,1,$store_id['store_id'],$company_id['company_id'],$horaSistema,$horaSistema));
                }
            }
            DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id = ?" , array($horaSistema,$store_id ['store_id'], $idroute['idroute'],$company_id['company_id']));
            DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $company_id['company_id'], $idroute['idroute'], $idaudit['idaudit'], $store_id['store_id'] ));

            //emails
            $sw=0;

            if (($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['permitio']) and ($result['result']==0))
            {
                $textoEmail = $consulta2[0]->fullname." Bod. No permitio tomar Inf. Id:".$store_id['store_id'];
                if ($opcion['opcion']==$valoresAlicorp[$company_id['company_id']]['opcionNoClientePerfecto'])
                {
                    $sw=1;
                }
                if ($opcion['opcion']==$valoresAlicorp[$company_id['company_id']]['opcionNoRecibeMerca'])
                {
                    $sw=1;
                }
            }

            if (($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['abierto']) and ($result['result']==0))
            {
                $textoEmail = $consulta2[0]->fullname." Bod. Tienda Cerrada Id:".$store_id['store_id'];$sw=1;
            }


//dd($consulta1);
            if (count($consulta1)>0){
                $valorOpcion = $consulta1[0]->options;
            }else{
                $valorOpcion ="";
            }

            if ($sw==1){
                $sqlcoord="SELECT  a.tipo_bodega,a.fullname,a.address,a.district FROM stores a WHERE a.id = '".$store_id['store_id']."'";
                $consulEmail = DB::select($sqlcoord);

                $sqlFecha="SELECT created_at FROM poll_details where id='" . $idPollDetail . "'";
                $consultaFecha = DB::select($sqlFecha);
                $fechaHoraEnvio = $consultaFecha[0]->created_at;

                $textoContent = $textoEmail;
                $nombreEnvio = "Franco Ramirez";
                if ($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['abierto'])
                {
                    $motivo = "Tienda Cerrada Opción: ".'<b>'.strtoupper($valorOpcion).'</b>';
                }
                if ($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['permitio'])
                {
                    $motivo = "No permitio tomar Inf. Opción: ".'<b>'.strtoupper($valorOpcion).'</b>';
                }
                $foto = "";

                if ($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['abierto'])
                {
                    $sqlmedia = "SELECT archivo,created_at FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1 and company_id='".$company_id['company_id']."'";
                    $consulMedia = DB::select($sqlmedia);

                    $urlBase = \App::make('url')->to('/');
                    $urlImages = '/media/fotos/';
                    if (count($consulMedia)>0){
                        $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
                    }else{
                        $foto = "";
                    }
                }


                $datai = ['origen' => $store_id['store_id'],
                    'tipo'  =>  'LocalCerrado',
                    'titulo'=> $textoContent,
                    'motivo' => $motivo,
                    'auditor' => $auditor,
                    'comentario' => '',
                    'cadena' => 'alicorp',
                    'tipoLocal' => $consulEmail[0]->tipo_bodega,
                    'agente'   =>  $consulEmail[0]->fullname,
                    'dir' => '',
                    'direccion' => $consulEmail[0]->address,
                    'distrito' => $consulEmail[0]->district,
                    'foto' => $foto,
                    'fecha' => $fechaHoraEnvio
                ];//dd($datai);
                if ($valoresAlicorp[$company_id['company_id']]['pruebas']==1)
                {
                    $envio = ['responsable' => $nombreEnvio,'email' =>'franbrsj@gmail.com', 'subject' =>$textoEmail];
                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });
                }else{
                    $envio = ['responsable' => 'Augusto Guerra','email' =>'lrosales@ttaudit.com', 'subject' =>$textoEmail];
                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });
                    $envio = ['responsable' => 'Augusto Guerra','email' =>'adavelouis@ttaudit.com', 'subject' =>$textoEmail];
                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });
                    $envio = ['responsable' => 'Raul Pulido','email' =>'rpulido@ttaudit.com', 'subject' =>$textoEmail];
                    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
                        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
                    });
                    if ($poll_id['poll_id']==$valoresAlicorp[$company_id['company_id']]['permitio']){

                    }
                }


            }

            return \Response::json([ 'success'=> 1]);
        }

        if ($idPollDetail >0){
            return \Response::json([ 'success'=> 1]);
        }else{
            return \Response::json([ 'success'=> 0]);
        }
    }else{
        return \Response::json([ 'success'=> 1]);
    }


}]);

//alicorp
Route::post('savePresenciaAlicorp', ['as' =>'savePresenciaAlicorp', function(){
    $product_id = Input::only('product_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $company_id = Input::only('company_id');

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    $sql = "SELECT id FROM presences p where product_id='" . $product_id['product_id']  . "'";
    $consulta1 = DB::select($sql);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {
            $presence_id= $valor->id;
        }
        $sql1 = "SELECT id FROM presence_details p where presence_id='" . $presence_id  . "' and store_id='".$store_id['store_id']."' and user_id='".$user_id['user_id']."' and company_id='".$company_id['company_id']."' and result_product=1 and result_price=1";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){
            DB::insert("INSERT INTO presence_details (presence_id,store_id,user_id,result_product,result_price,company_id, created_at,updated_at) VALUES(?,?,?,1,1,?,?,?)" , array($presence_id,$store_id['store_id'],$user_id['user_id'],$company_id['company_id'],$horaSistema,$horaSistema));
            $idPollDetail = DB::getPdo()->lastInsertId();
        }else{
            $idPollDetail=0;
        }

    }

    if ($idPollDetail >0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);


//alicorp
Route::post('saveSODBodegaAlicorp', ['as' =>'saveSODBodegaAlicorp', function(){
    $company_id = Input::only('company_id');
    $poll_id = Input::only('poll_id');
    $result = Input::only('result');
    $audit_id = Input::only('audit_id');
    $road_id = Input::only('rout_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $publicity_id = Input::only('publicity_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    if ($publicity_id['publicity_id']=="0"){
        $comentario = Input::only('comentario');
        $status = Input::only('status');
        $sql2 = "SELECT id FROM poll_details p where poll_id='" .$poll_id['poll_id']. "' and store_id='".$store_id['store_id']."' and sino=1 and result='".$result['result']."' and company_id='".$company_id['company_id']."' and coment='1' and comentario='".$comentario['comentario']."'";
    }else{
        $sql2 = "SELECT id FROM poll_details p where poll_id='" .$poll_id['poll_id']. "' and store_id='".$store_id['store_id']."' and sino=1 and result='".$result['result']."' and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'";
    }

    $consulta22 = DB::select($sql2);
    if (count($consulta22)==0){
        if ($publicity_id['publicity_id']=="0"){
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,result,company_id,coment,comentario, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],1,$result['result'],$company_id['company_id'],1,$comentario['comentario'],$horaSistema,$horaSistema));
        }else{
            DB::insert("INSERT INTO poll_details (poll_id, store_id, sino,result,company_id,publicity_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($poll_id['poll_id'],$store_id['store_id'],1,$result['result'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));
        }
        $idPollDetail = DB::getPdo()->lastInsertId();
        if($idPollDetail == 0) {
            return \Response::json([ 'success'=> 0]);
        }

    }else{
        if ($publicity_id['publicity_id']=="0"){
            DB::update("UPDATE  poll_details set poll_id= ?,store_id=?,sino=?,result=?,company_id=?,coment=?,comentario=?,created_at=?,updated_at=? where poll_id='" .$poll_id['poll_id']. "' and store_id='".$store_id['store_id']."' and sino=1 and result='".$result['result']."' and company_id='".$company_id['company_id']."' and coment='1' and comentario='".$comentario['comentario']."'" , array($poll_id['poll_id'],$store_id['store_id'],1,$result['result'],$company_id['company_id'],1,$comentario['comentario'],$horaSistema,$horaSistema));
        }else{
            DB::update("UPDATE  poll_details set poll_id=?, store_id=?, sino=?,result=?,company_id=?,publicity_id=?, created_at=?,updated_at=? where poll_id='" .$poll_id['poll_id']. "' and store_id='".$store_id['store_id']."' and sino=1 and result='".$result['result']."' and company_id='".$company_id['company_id']."' and publicity_id='".$publicity_id['publicity_id']."'" , array($poll_id['poll_id'],$store_id['store_id'],1,$result['result'],$company_id['company_id'],$publicity_id['publicity_id'],$horaSistema,$horaSistema));
        }
    }

    if ($publicity_id['publicity_id']<>"0"){
        $sql1 = "SELECT id FROM publicity_details p where publicity_id='" .$publicity_id['publicity_id'] . "' and store_id='".$store_id['store_id']."' and user_id='".$user_id['user_id']."' and result=1 and company_id='".$company_id['company_id']."'";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){
            DB::insert("INSERT INTO publicity_details (publicity_id,store_id,user_id,result,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($publicity_id['publicity_id'],$store_id['store_id'],$user_id['user_id'],1,$company_id['company_id'],$horaSistema,$horaSistema));
            $idPublicityId = DB::getPdo()->lastInsertId();
            if($idPublicityId == 0) {
                return \Response::json([ 'success'=> 0]);
            }
        }else{
            DB::update("UPDATE  publicity_details set publicity_id=?,store_id=?,user_id=?,result=?,company_id=?, created_at=?,updated_at=? where publicity_id='" .$publicity_id['publicity_id'] . "' and store_id='".$store_id['store_id']."' and user_id='".$user_id['user_id']."' and result=1 and company_id='".$company_id['company_id']."'" , array($publicity_id['publicity_id'],$store_id['store_id'],$user_id['user_id'],1,$company_id['company_id'],$horaSistema,$horaSistema));
        }
    }else{
        if ($status['status']==1){
            DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id = ? " , array($horaSistema,$store_id ['store_id'], $road_id['rout_id'],$company_id['company_id']));
            DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $company_id['company_id'], $road_id['rout_id'], $audit_id['audit_id'], $store_id['store_id'] ));
        }
    }

    return \Response::json([ 'success'=> 1]);

}]);

//alicorp
Route::post('updatePriceProdAlicorp', ['as' =>'updatePriceProdAlicorp', function(){
    $product_id = Input::only('product_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $company_id = Input::only('company_id');
    $price = Input::only('price');

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();$result=0;

    $sql = "SELECT id FROM presences p where product_id='" . $product_id['product_id']  . "'";
    $consulta1 = DB::select($sql);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {
            $presence_id= $valor->id;
        }
        $result =DB::update("UPDATE  presence_details set result_price = 0, price= ?, updated_at=? where store_id = ? and  presence_id = ? and company_id=? and user_id=? " , array($price['price'],$horaSistema,$store_id['store_id'], $presence_id, $company_id['company_id'], $user_id['user_id']));
    }
    if ($result>0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }

}]);

//alicorp
Route::post('updatePriceProdVisble', ['as' =>'updatePriceProdVisble', function(){
    $product_id = Input::only('product_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $company_id = Input::only('company_id');$result=0;

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    $sql = "SELECT id FROM presences p where product_id='" . $product_id['product_id']  . "'";
    $consulta1 = DB::select($sql);
    if (count($consulta1)>0){
        foreach ($consulta1 as $valor) {
            $presence_id= $valor->id;
        }
        $result = DB::update("UPDATE  presence_details set visible_price= 1, updated_at=? where store_id = ? and  presence_id = ? and company_id=? and user_id=? " , array($horaSistema,$store_id['store_id'], $presence_id, $company_id['company_id'], $user_id['user_id']));
    }
    if ($result>0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }

}]);

//alicorp
Route::post('endPresenceProdAlicorp', ['as' =>'endPresenceProdAlicorp', function(){

    $store_id = Input::only('store_id');
    $company_id = Input::only('company_id');
    $idroute  = Input::only('idroute');
    $idaudit = Input::only('idaudit');
    $status = Input::only('status');

    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::update("UPDATE  audit_road_stores set audit= 1,updated_at=? where company_id = ? and  road_id = ? and audit_id = ? and store_id = ?" , array($horaSistema, $company_id['company_id'], $idroute['idroute'], $idaudit['idaudit'], $store_id['store_id'] ));
    if ($status['status']==1){
        DB::update("UPDATE  road_details set audit= 1, updated_at=? where store_id = ? and  road_id = ? " , array($horaSistema,$store_id ['store_id'], $idroute['idroute']));
    }


    return \Response::json([ 'success'=> 1]);
}]);
//alicorp
Route::post('JsonListProductsAlicorp', ['as' =>'JsonListProductsAlicorp', function(){
    //ENUM('Mini Market','Bodega Clásica','Bodega Alto Tráfico')
    $company_id = Input::only('company_id');
    $tipo_bodega= Input::only('tipo_bodega');
    if($tipo_bodega['tipo_bodega']==1) {$bodega='Mini Market';}
    if($tipo_bodega['tipo_bodega']==2) {$bodega='Bodega Clásica';}
    if($tipo_bodega['tipo_bodega']==3) {$bodega='Bodega Alto Tráfico';}
    $region= Input::only('region');
    $sql = "SELECT
  `products`.`id`,
  `products`.`fullname`,
  `products`.`eam`,
  `product_store_region`.`price` AS `precio`,
  `products`.`category_product_id` AS `category_id`,
  `category_products`.`fullname` AS `categoria`,
  `products`.`imagen`
FROM
  `product_store_region`
  INNER JOIN `products` ON (`product_store_region`.`product_id` = `products`.`id`)
  INNER JOIN `category_products` ON (`products`.`category_product_id` = `category_products`.`id`)
WHERE
  `product_store_region`.`company_id` = '".$company_id['company_id']."' AND
  `product_store_region`.`tipo_bodega` = '".$bodega."' AND
  `product_store_region`.`region` = '".$region['region']."'";

    return \Response::json([ 'success'=> 1, "products" => DB::select($sql)]);


}]);
//alicorp
Route::post('JsonListPublicitiesAlicorp', ['as' =>'JsonListPublicitiesAlicorp', function(){//observación
    $company_id = Input::only('company_id');
    $tipo_bodega= Input::only('tipo_bodega');
    if($tipo_bodega['tipo_bodega']==1) {$bodega='Mini Market';$anexo = "AND `publicity_store`.`tipo_bodega` = '".$bodega."'";}
    if($tipo_bodega['tipo_bodega']==2) {$bodega='Bodega Clásica';$anexo = "AND `publicity_store`.`tipo_bodega` = '".$bodega."'";}
    if($tipo_bodega['tipo_bodega']==3) {$bodega='Bodega Alto Tráfico';$anexo = "AND `publicity_store`.`tipo_bodega` = '".$bodega."'";}
    if($tipo_bodega['tipo_bodega']==4) {$bodega='';$anexo = "";}
    $sql = "SELECT
  `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`company_id`,
  `category_products`.`id` AS `category_id`,
  `category_products`.`fullname` AS `categoria`,
  `publicities`.`imagen`
FROM
  `publicity_store`
  INNER JOIN `publicities` ON (`publicity_store`.`publicity_id` = `publicities`.`id`)
  INNER JOIN `category_products` ON (`publicities`.`category_product_id` = `category_products`.`id`)
WHERE `publicity_store`.`active`=1 and
  `publicities`.`company_id` = '" . $company_id['company_id']  . "' ".$anexo;


    return \Response::json([ 'success'=> 1, "publicities" => DB::select($sql)]);


}]);
//alicorp
Route::post('JsonListSODAlicorp', ['as' =>'JsonListSODAlicorp', function(){//observación
    $company_id = Input::only('company_id');
    $sql = "SELECT
  `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`imagen`
FROM
  `publicities`
WHERE
  `publicities`.`category_product_id` = 54 AND
  `publicities`.`company_id` = '" . $company_id['company_id']  . "'";


    return \Response::json([ 'success'=> 1, "sod" => DB::select($sql)]);


}]);

//-------------------------------- UPDATE ADDRESS STORE alicorp ----------------------
Route::post('JsonUpdateStoreAddress', ['as' =>'JsonUpdateStoreAddress', function(){

    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $company_id = Input::only('company_id');
    $direccion  = Input::only('direccion');
    $referencia = Input::only('referencia');
    $userName = Input::only('userName');
    $storeName = Input::only('storeName');
    $comentario = Input::only('comentario');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    $result =0 ;
    $result = DB::update("UPDATE  stores set address= ?, urbanization= ? ,  updated_at=?  where id = ? " , array($direccion['direccion'], $referencia['referencia'],$horaSistema,$store_id['store_id']));

    if($result > 0) {
        $sqlcoord="SELECT  a.tipo_bodega,a.fullname,a.address,a.district FROM stores a WHERE a.id = '".$store_id['store_id']."'";
        $consulEmail = DB::select($sqlcoord);

        $sql = "SELECT 
  `customers`.`fullname`
FROM
  `companies`
  INNER JOIN `customers` ON (`companies`.`customer_id` = `customers`.`id`)
WHERE
  `companies`.`id` = '".$company_id['company_id']."'";
        $consulEmp = DB::select($sql);

        $foto='';$textoEmail = 'Se actualizo Datos Tienda '.$storeName['storeName'];
        $datai = ['origen' => $store_id['store_id'],
            'tipo'  =>  'LocalCerrado',
            'titulo'=> 'Se actualizo Datos Tienda '.$storeName['storeName'],
            'motivo' => 'Cambio de Dirección '.$storeName['storeName'].'('.$store_id['store_id'].')',
            'auditor' => $userName['userName'].'('.$user_id['user_id'].')',
            'comentario' => $comentario['comentario'],
            'cadena' => $consulEmp[0]->fullname."(id campaña: ".$company_id['company_id'].")",
            'tipoLocal' => $consulEmail[0]->tipo_bodega,
            'agente'   =>  $consulEmail[0]->fullname,
            'referencia' => $referencia['referencia'],
            'direccion' => $consulEmail[0]->address,
            'distrito' => $consulEmail[0]->district,
            'foto' => $foto,
            'fecha' => $horaSistema
        ];//dd($datai);
        $envio = ['responsable' => 'Augusto Guerra','email' =>'lrosales@ttaudit.com', 'subject' =>$textoEmail];
        \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
            $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
        });
        $envio = ['responsable' => 'Augusto Guerra','email' =>'adavelouis@ttaudit.com', 'subject' =>$textoEmail];
        \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
            $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
        });
        $envio = ['responsable' => 'Raul Pulido','email' =>'rpulido@ttaudit.com', 'subject' =>$textoEmail];
        \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
            $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
        });

        return \Response::json([ 'success'=> 1]);
    } else {
        return \Response::json([ 'success'=> 0]);
    }

}]);

//alicorp AASS
Route::post('JsonListSODAlicorpAASS', ['as' =>'JsonListSODAlicorpAASS', function(){//observación
    $company_id = Input::only('company_id');
    $sql = "SELECT
  `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`imagen`
FROM
  `publicities`
WHERE
  `publicities`.`category_product_id` = 55 AND
  `publicities`.`company_id` = '" . $company_id['company_id']  . "'";


    return \Response::json([ 'success'=> 1, "sod" => DB::select($sql)]);


}]);
//alicorp Mayoristas
Route::post('JsonGetCuotaVenta', ['as' =>'JsonGetCuotaVenta', function(){
    $store_id= Input::only('store_id');
    $sql = "SELECT
      store_id as mercado, cuota_venta as cuota
FROM
  market_details
WHERE
  point_id = '".$store_id['store_id']."' ";
$result =  DB::select($sql);
if ($result){
    return \Response::json([ 'success'=> 1, "cuota_venta" => $result]);
}else{
    return \Response::json([ 'success'=> 0, "cuota_venta" => []]);
}

}]);
//alicorp AASS
Route::post('JsonListPublicitiesPrograms', ['as' =>'JsonListPublicitiesPrograms', function(){//observación
    $company_id = Input::only('company_id');
    $store_id= Input::only('store_id');
    $sql = "SELECT
      `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`cadena`,
  `publicities`.`category`,
  `publicities`.`start`,
  `publicities`.`end`,
  `publicities`.`imagen`,
  `publicities`.`cabecera`,
  `publicities`.`lateral`,
  `publicities`.`ruma`,
  `publicities`.`mesaCarga`,
  `publicities`.`muroValor`,
  `publicities`.`cabeceraFija`,
  `publicities`.`created_at`,
  `publicities`.`updated_at`
FROM
  `publicities`
WHERE
  `publicities`.`company_id` = '".$company_id['company_id']."' AND
  `publicities`.`category_product_id` = 56 AND
  `publicities`.`store_id` = '".$store_id['store_id']."'";


    return \Response::json([ 'success'=> 1, "publicities" => DB::select($sql)]);


}]);


//alicorp AASS
Route::post('JsonListPublicitiesAditions', ['as' =>'JsonListPublicitiesAditions', function(){
    $company_id = Input::only('company_id');
    $store_id= Input::only('store_id');
    $sql = "SELECT
  `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`description`,
  `publicities`.`cadena`,
  `publicities`.`category`,
  `publicities`.`start`,
  `publicities`.`end`,
  `publicities`.`imagen`,
  `publicities`.`cabecera`,
  `publicities`.`lateral`,
  `publicities`.`ruma`,
  `publicities`.`chimenea`,
  `publicities`.`ventaCruzada`,
  `publicities`.`ganchera`,
  `publicities`.`mesaCarga`,
  `publicities`.`muroValor`,
  `publicities`.`puntoCaja`,
  `publicities`.`created_at`,
  `publicities`.`updated_at`
FROM
  `publicities`
WHERE
  `publicities`.`company_id` = '".$company_id['company_id']."' AND
  `publicities`.`category_product_id` = 57 AND
  `publicities`.`store_id` = '".$store_id['store_id']."'";


    return \Response::json([ 'success'=> 1, "publicities" => DB::select($sql)]);


}]);

//alicorp AASS
Route::post('JsonListPublicitiesPromotions', ['as' =>'JsonListPublicitiesPromotions', function(){
    $company_id = Input::only('company_id');
    $cadena= Input::only('cadena');
    $sql = "SELECT
  `publicities`.`id`,
  `publicities`.`fullname`,
  `publicities`.`description`,
  `publicities`.`imagen`,
  `publicities`.`dinamica`,
  `publicities`.`cadena`,
  `publicities`.`category`,
  `publicities`.`start`,
  `publicities`.`end`
FROM
  `publicities`
WHERE
  `publicities`.`company_id` = '".$company_id['company_id']."' AND
  `publicities`.`cadena` = '".$cadena['cadena']."' AND
  `publicities`.`category_product_id` = 58 ORDER BY category ASC";


    return \Response::json([ 'success'=> 1, "publicities" => DB::select($sql)]);


}]);

//alicorp AASS
Route::post('saveExhibidorProgAlicorp', ['as' =>'saveExhibidorProgAlicorp', function(){
    $company_id = Input::only('company_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $publicity = Input::only('publicity');
    $audit_id = Input::only('audit_id');
    $status = Input::only('status');
    $rout_id = Input::only('rout_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    for($i = 0; $i < count($publicity['publicity']); ++$i) {
        $valpublicity = json_decode($publicity['publicity'][$i],true);
        $sql1 = "SELECT id FROM publicity_details p where publicity_id='" . $valpublicity['publicity_id']  . "' and store_id='".$store_id['store_id']."' and user_id='".$user_id['user_id']."' and result=1 and carteleria='".$valpublicity['carteleria']."' and contaminated='".$valpublicity['contaminated']."' and company_id='".$company_id['company_id']."'";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){
            DB::insert("INSERT INTO publicity_details (publicity_id,store_id,user_id,result,carteleria,contaminated,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?)" , array($valpublicity['publicity_id'],$store_id['store_id'],$user_id['user_id'],1,$valpublicity['carteleria'],$valpublicity['contaminated'],$company_id['company_id'],$horaSistema,$horaSistema));
        }
    }
    if ($status['status']==1){
        DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " , array($horaSistema,$store_id['store_id'], $rout_id['rout_id'], $company_id['company_id'], $audit_id['audit_id']));
    }
    return \Response::json([ 'success'=> 1]);
}]);

//alicorp AASS
Route::post('saveExhibidorPromotionsAlicorp', ['as' =>'saveExhibidorPromotionsAlicorp', function(){
    $company_id = Input::only('company_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $publicity = Input::only('publicity');
    $audit_id = Input::only('audit_id');
    $status = Input::only('status');
    $rout_id = Input::only('rout_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    for($i = 0; $i < count($publicity['publicity']); ++$i) {
        $valpublicity = json_decode($publicity['publicity'][$i],true);
        $sql1 = "SELECT id FROM publicity_details p where publicity_id='" . $valpublicity['publicity_id']  . "' and store_id='".$store_id['store_id']."' and user_id='".$user_id['user_id']."' and result=1 and comunicacion='".$valpublicity['comunicacion']."' and company_id='".$company_id['company_id']."'";
        $consulta11 = DB::select($sql1);
        if (count($consulta11)==0){
            DB::insert("INSERT INTO publicity_details (publicity_id,store_id,user_id,result,comunicacion,company_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?)" , array($valpublicity['publicity_id'],$store_id['store_id'],$user_id['user_id'],1,$valpublicity['comunicacion'],$company_id['company_id'],$horaSistema,$horaSistema));
        }
    }
    if ($status['status']==1){
        DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " , array($horaSistema,$store_id['store_id'], $rout_id['rout_id'], $company_id['company_id'], $audit_id['audit_id']));
    }
    return \Response::json([ 'success'=> 1]);
}]);

//valor temp
Route::post('JsonListProductsBayer', ['as' =>'JsonListProductsBayer', function(){//Observación productos
    $company_id = Input::only('company_id');
    if ($company_id==''){
        $sql = "SELECT products.id, products.fullname, products.eam, products.precio, products.company_id,category_products.id AS category_id, category_products.fullname AS categoria, products.imagen
            FROM products INNER JOIN category_products ON (products.category_product_id = category_products.id)";
    }else{
        $sql = "SELECT
  products.id,
  products.fullname,
  products.eam,
  products.precio,
  product_detail.company_id,
  category_products.id AS category_id,
  category_products.fullname AS categoria,
  products.imagen,
  product_detail.orden
FROM
  products
  INNER JOIN category_products ON (products.category_product_id = category_products.id)
  INNER JOIN product_detail ON (products.id = product_detail.product_id)
WHERE
  product_detail.company_id = '".$company_id['company_id']."' order by product_detail.orden ASC";
    }

    return \Response::json([ 'success'=> 1, "products" => DB::select($sql)]);


}]);

Route::post('JsonListPublicities', ['as' =>'JsonListProducts', function(){//observación
    $company_id = Input::only('company_id');
    if ($company_id==''){
        $sql = "SELECT publicities.id, publicities.fullname, publicities.company_id,category_products.id AS category_id, category_products.fullname AS categoria, publicities.imagen
            FROM publicities INNER JOIN category_products ON (publicities.category_product_id = category_products.id)";
    }else{
        $sql = "SELECT publicities.id, publicities.fullname, publicities.company_id,category_products.id AS category_id, category_products.fullname AS categoria, publicities.imagen
            FROM publicities INNER JOIN category_products ON (publicities.category_product_id = category_products.id) where publicities.company_id='" . $company_id['company_id']  . "'";
    }

    return \Response::json([ 'success'=> 1, "publicities" => DB::select($sql)]);


}]);

Route::post('saveAuditPresencia', ['as' =>'saveAuditPresencia', function(){
    $products = Input::only('products');
    $score = Input::only('score');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $road_id = Input::only('rout_id');
    $audit_id = Input::only('audit_');
    $company_id = Input::only('company_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    for($i = 0; $i < count($products['products']); ++$i) {
        $valproduct = json_decode($products['products'][$i],true);
        $sql = "SELECT id FROM presences p where product_id='" . $valproduct['product_id']  . "'";
        $consulta1 = DB::select($sql);
        if (count($consulta1)>0){
            foreach ($consulta1 as $valor) {
                $presence_id= $valor->id;
            }
            DB::insert("INSERT INTO presence_details (presence_id,store_id,user_id,result_product,result_price, created_at,updated_at) VALUES(?,?,?,1,0,?,?)" , array($presence_id,$store_id['store_id'],$user_id['user_id'],$horaSistema,$horaSistema));
        }
    }
    DB::insert("INSERT INTO scores (score,audit_id,store_id,company_id,user_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($score['score'],$audit_id['audit_'],$store_id['store_id'],$company_id['company_id'],$user_id['user_id'],$horaSistema,$horaSistema));
    DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " , array($horaSistema,$store_id['store_id'], $road_id['rout_id'], $company_id['company_id'], $audit_id['audit_']));
    return \Response::json([ 'success'=> 1]);
}]);

Route::get('SearchResults', function (){
    $dir = Input::get('dir');
    /*$stores = Auditor\Entities\Store::where('codclient', 'LIKE', '%' . $dir. '%')->take(5)->get();*/
    $sqlcoord="SELECT 
  `stores`.`id`,
  `stores`.`fullname`,
  `stores`.`district`,
  `stores`.`region` AS `provincia`,
  `stores`.`ubigeo` AS `departamento`,
  `stores`.`codclient`,
  `companies`.`fullname` AS `company`
FROM
  `company_stores`
  INNER JOIN `stores` ON (`company_stores`.`store_id` = `stores`.`id`)
  INNER JOIN `companies` ON (`company_stores`.`company_id` = `companies`.`id`)
WHERE
  (`stores`.`fullname` LIKE '%".$dir."%' or `stores`.`codclient` LIKE '%".$dir."%' or `stores`.`id` LIKE '%".$dir."%') AND 
  `stores`.`test` = 0
ORDER BY
  `company_stores`.`store_id` DESC
LIMIT 15";
    $stores = DB::select($sqlcoord);
    header('Access-Control-Allow-Origin: *');
    return \Response::json($stores);
});

Route::get('SearchResultsForCompany', function (){
    $valores = explode('|',Input::get('dir'));
    $dir = $valores[0];
    $company_id = $valores[1];
    /*$stores = Auditor\Entities\Store::where('codclient', 'LIKE', '%' . $dir. '%')->take(5)->get();*/
    if ($company_id == 316){
                $sqlcoord="SELECT 
        `company_stores`.`store_id` AS `id`,
          `stores`.`fullname`,
          `stores`.`codclient`,
          `companies`.`fullname` as company,
          `company_stores`.`company_id`
          
        FROM
          `company_stores`
          INNER JOIN `stores` ON (`company_stores`.`store_id` = `stores`.`id`)
          INNER JOIN `companies` ON (`company_stores`.`company_id` = `companies`.`id`)
        WHERE
            (`stores`.`fullname` like '%".$dir."%' or `company_stores`.`store_id` LIKE '%".$dir."%' or `stores`.`codclient` LIKE '%".$dir."%') and 
          `company_stores`.`company_id` =  ".$company_id;
    }else{
        $sqlcoord="SELECT 
          `roads_resume`.`store_id` AS `id`,
          `roads_resume`.`fullname`,
          `roads_resume`.`codclient`,
          `roads_resume`.`company_id`,
          `roads_resume`.`user_id`,
          `roads_resume`.`auditor`,
          `companies`.`fullname` AS `company`
        FROM
          `roads_resume`
          INNER JOIN `companies` ON (`roads_resume`.`company_id` = `companies`.`id`)
        WHERE
          (`roads_resume`.`fullname` LIKE '%".$dir."%' or `roads_resume`.`store_id` LIKE '%".$dir."%' or `roads_resume`.`codclient` LIKE '%".$dir."%') AND 
          `roads_resume`.`company_id` = ".$company_id."
        LIMIT 15";
    }

    $stores = DB::select($sqlcoord);
    header('Access-Control-Allow-Origin: *');
    return \Response::json($stores);
});

Route::get('searchStore', function (){

    $dir = Input::get('dir');
    $valores = explode('|',$dir);
    $texto = $valores[0];
    $company_id = $valores[1];
    $type=Input::get('type');
    if ($type=='auditor'){
        $sqlcoord="SELECT 
  `roads_resume`.`store_id` AS `id`,
  `roads_resume`.`fullname`,
  `roads_resume`.`codclient`,
  `roads_resume`.`company_id`,
  `roads_resume`.`user_id`,
  `roads_resume`.`auditor`,
  `companies`.`fullname` AS `company`
FROM
  `roads_resume`
  INNER JOIN `companies` ON (`roads_resume`.`company_id` = `companies`.`id`)
WHERE
  (`roads_resume`.`fullname` LIKE '%".$texto."%' or `roads_resume`.`store_id` LIKE '%".$texto."%' or `roads_resume`.`codclient` LIKE '%".$texto."%') AND 
  `roads_resume`.`company_id` = ".$company_id."
LIMIT 15";
        $stores = DB::select($sqlcoord);
    }
    if ($type=='promotoria'){
        $sqlcoord="SELECT
  `a`.`store_id` AS id,
`stores`.`fullname`,
`stores`.`codclient`,
`companies`.`id` as `company_id`,
`e`.`id` as `user_id`,
  `e`.`fullname` AS `auditor`,
  `companies`.`fullname` as `company`
FROM
  `poll_details` `a`
LEFT OUTER JOIN `stores` ON (`a`.`store_id` = `stores`.`id`)
  LEFT OUTER JOIN `company_stores` `f` ON (`a`.`store_id` = `f`.`store_id`)
  LEFT OUTER JOIN `users` `e` ON (`a`.`auditor` = `e`.`id`)
  LEFT OUTER JOIN `companies` ON (`f`.`company_id` = `companies`.`id`)
WHERE
  (`stores`.`fullname` LIKE '%".$texto."%' or `stores`.`id` LIKE '%".$texto."%' or `stores`.`codclient` LIKE '%".$texto."%') AND
  `f`.`company_id` = '".$company_id."' 
GROUP BY
  `f`.`company_id`,
  `a`.`store_id`
ORDER BY `a`.`created_at` DESC";
        $stores = DB::select($sqlcoord);
    }
    if ($type==''){
        $stores = [];
    }
    header('Access-Control-Allow-Origin: *');
    return \Response::json($stores);
});

Route::get('SearchResults0', function (){
    $dir = Input::get('dir');
    /*$stores = Auditor\Entities\Store::where('codclient', 'LIKE', '%' . $dir. '%')->take(5)->get();*/
    $sqlcoord="SELECT
  stores.id,
  stores.fullname,
  stores.district,
  stores.region as provincia,
  stores.ubigeo as departamento,
  stores.codclient,
  companies.id AS company_id,
  companies.fullname AS company
FROM
  company_stores
  INNER JOIN stores ON (company_stores.store_id = stores.id)
  INNER JOIN companies ON (company_stores.company_id = companies.id)
WHERE
  (stores.fullname like '%". $dir. "%' or  stores.id like '%". $dir. "%') and company_stores.ruteado=0
LIMIT 20";
    $stores = DB::select($sqlcoord);
    header('Access-Control-Allow-Origin: *');
    return \Response::json($stores);
});

Route::post('saveScoreStoreBayer', ['as' =>'saveScoreStoreBayer', function(){
    $company_id = Input::only('company_id');
    $audit_id = Input::only('audit_id');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO scores (audit_id,store_id,company_id,user_id, created_at,updated_at) VALUES(?,?,?,?,?,?)" , array($audit_id['audit_id'],$store_id['store_id'],$company_id['company_id'],$user_id['user_id'],$horaSistema,$horaSistema));
    $idPollDetail = DB::getPdo()->lastInsertId();
    if ($idPollDetail>0){
        return \Response::json([ 'success'=> 1]);
    }else{
        return \Response::json([ 'success'=> 0]);
    }
}]);

Route::post('saveAuditVisibility', ['as' =>'saveAuditVisibility', function(){
    $company_id = Input::only('company_id');
    $audit_id = Input::only('audit_');
    $road_id = Input::only('rout_id');
    $score = Input::only('score');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $publicity = Input::only('publicity');
    $scores_details = Input::only('scores_details');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    for($i = 0; $i < count($publicity['publicity']); ++$i) {
        $valpublicity = json_decode($publicity['publicity'][$i],true);
        DB::insert("INSERT INTO publicity_details (publicity_id,store_id,user_id,result,layout,visible,comment,contaminated, created_at,updated_at) VALUES(?,?,?,?,?,?,?,?,?,?)" , array($valpublicity['publicity_id'],$store_id['store_id'],$user_id['user_id'],$valpublicity['found'],$valpublicity['layout_correct'],$valpublicity['visible'],$valpublicity['comment'],$valpublicity['contaminated'],$horaSistema,$horaSistema));
    }
    DB::insert("INSERT INTO scores (score,audit_id,store_id,company_id,user_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($score['score'],$audit_id['audit_'],$store_id['store_id'],$company_id['company_id'],$user_id['user_id'],$horaSistema,$horaSistema));
    $idScore = DB::getPdo()->lastInsertId();
    for($i = 0; $i < count($scores_details['scores_details']); ++$i) {
        $valscores = json_decode($scores_details['scores_details'][$i],true);
        DB::insert("INSERT INTO score_details (score_id,category_product_id,score, created_at,updated_at) VALUES(?,?,?,?,?)" , array($idScore,$valscores['category_id'],$valscores['score'],$horaSistema,$horaSistema));
    }

    DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " , array($horaSistema,$store_id['store_id'], $road_id['rout_id'], $company_id['company_id'], $audit_id['audit_']));

    return \Response::json([ 'success'=> 1]);
}]);

Route::post('saveAuditFacturacion', ['as' =>'saveAuditFacturacion', function(){
    $invoices_id = Input::only('invoices_id');
    $company_id = Input::only('company_id');
    $audit_id = Input::only('audit_');
    $road_id = Input::only('rout_id');
    $score = Input::only('score');
    $store_id = Input::only('store_id');
    $user_id = Input::only('user_id');
    $mytime = Carbon\Carbon::now();
    $horaSistema = $mytime->toDateTimeString();

    DB::insert("INSERT INTO auditinvoices_details (auditinvoices_id,store_id,user_id,result, created_at,updated_at) VALUES(?,?,?,1,?,?)" , array($invoices_id['invoices_id'],$store_id['store_id'],$user_id['user_id'],$horaSistema,$horaSistema));
    DB::insert("INSERT INTO scores (score,audit_id,store_id,company_id,user_id, created_at,updated_at) VALUES(?,?,?,?,?,?,?)" , array($score['score'],$audit_id['audit_'],$store_id['store_id'],$company_id['company_id'],$user_id['user_id'],$horaSistema,$horaSistema));
    DB::update("UPDATE  audit_road_stores set audit= 1, updated_at=? where store_id = ? and  road_id = ? and company_id=? and audit_id=? " , array($horaSistema,$store_id['store_id'], $road_id['rout_id'], $company_id['company_id'], $audit_id['audit_']));


    return \Response::json([ 'success'=> 1]);
}]);

Route::post('sendEmail', ['as' => 'sendEmail', function(){
    $store_id = Input::only('store_id');
    $poll_id = Input::only('poll_id');
    /*$envio = ['responsable' => 'Franco Bill','email' =>'franbrsj@gmail.com', 'subject' =>"Practica de envios de email"];
    $data = ['name'  =>  'Franco Bill',
        'titulo'=> 'Pruebas',
        'msg'   =>  'Mailing con Laravel'];

    \Mail::send('emails.mensaje', $data, function($message) use ($envio){
        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
    });*/
    $sql1="SELECT id,options FROM poll_options where codigo='67a'";
    $consulta1 = DB::select($sql1);

    $sqlcoord="SELECT  b.email,a.coordinador,a.fullname, a.codclient,a.address FROM stores a, users b WHERE a.id = '".$store_id['store_id']."' AND b.fullname = a.coordinador";
    $consulEmail = DB::select($sqlcoord);
    $textoEmail = "Agente Cerrado DIR: ".$consulEmail[0]->codclient;
    $textoContent = $textoEmail;
    $nombreEnvio = $consulEmail[0]->coordinador;
    $motivo = $consulta1[0]->options;

    $sqlmedia = "SELECT archivo FROM medias m where store_id='".$store_id['store_id']."' and poll_id='".$poll_id['poll_id']."' and tipo=1;";
    $consulMedia = DB::select($sqlmedia);
    $urlBase = \App::make('url')->to('/');
    $urlImages = '/media/fotos/';
    if (count($consulMedia)>0){
        $foto = $urlBase.$urlImages.$consulMedia[0]->archivo;
    }else{
        $foto = "";
    }


    $envio = ['responsable' => $nombreEnvio,'email' =>$consulEmail[0]->email, 'subject' =>$textoEmail];
    $dt = new DateTime();
    $fechaHoraEnvio = $dt->format('d-m-Y H:i:s');

    $datai = ['origen' => $store_id['store_id'],
        'tipo'  =>  'LocalCerrado',
        'titulo'=> $textoContent,
        'motivo' => $motivo,
        'agente'   =>  $consulEmail[0]->fullname,
        'dir' => $consulEmail[0]->codclient,
        'direccion' => $consulEmail[0]->address,
        'foto' => $foto,
        'fecha' => $fechaHoraEnvio
    ];
    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
    });
    $sqlejec1="SELECT  b.email,a.ejecutivo FROM stores a, users b WHERE a.id = '".$store_id['store_id']."' AND b.fullname = a.ejecutivo";
    $consulEmail1 = DB::select($sqlejec1);
    $nombreEnvio = $consulEmail1[0]->ejecutivo;
    $envio = ['responsable' => $nombreEnvio,'email' =>$consulEmail1[0]->email, 'subject' =>$textoEmail];
    \Mail::send('emails.localCerrado', $datai, function($message) use ($envio){
        $message->to($envio['email'], $envio['responsable'])->subject($envio['subject']);
    });
    return \Response::json([ 'success'=> 1]);
}]);


Route::get('versiones', function (){
    $company_id = Input::get('company_id');
    $type = Input::get('type');//dd($type);

    $sqlcoord="SELECT
  versiones.id,
  versiones.title,
  versiones.content,
  versiones.version,
  versiones.type,
  companies.id,
  companies.fullname,
  versiones.programador,
  versiones.created_at,
  versiones.updated_at
FROM
  versiones
  INNER JOIN companies ON (versiones.company_id = companies.id)
WHERE
  versiones.type = '".$type."' AND
  versiones.company_id = '".$company_id."'";
    $stores = DB::select($sqlcoord);
    header('Access-Control-Allow-Origin: *');
    return \Response::json([ 'success'=> 1, "version" => $stores]);
});

