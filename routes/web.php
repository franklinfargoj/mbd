<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::resource('/faq', 'FaqController');
Route::get('/faq/change_status/{id}', 'FaqController@change_status');
Route::resource('/board', 'BoardController');
Route::get('/board/change_status/{id}', 'BoardController@change_status');
Route::resource('/department', 'DepartmentController');
Route::get('/department/change_status/{id}', 'DepartmentController@change_status');
Route::get('frontend_register','FrontendRegisterController@showRegisterForm');
Route::post('frontend_register','FrontendRegisterController@frontendRegister');
Route::get('rti_form','RtiFormController@showFrontendForm');
Route::post('rti_form','RtiFormController@saveFrontendForm');
Route::get('rti_form_success','RtiFormController@rtiFormSuccess');
Route::get('rti_form_success_close','RtiFormController@rtiFormSuccessClose');
Route::get('rti_form_search','RtiFormController@searchRtiForm');


Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');

//resolutions backend
//Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');
Route::resource('/resolution', 'ResolutionController');
Route::post('loadDeleteReasonOfResolutionUsingAjax', 'ResolutionController@loadDeleteReasonOfResolutionUsingAjax')->name('loadDeleteReasonOfResolutionUsingAjax');
Route::post('loadDepartmentsOfBoardUsingAjax', 'BoardController@loadDepartmentsOfBoardUsingAjax')->name('loadDepartmentsOfBoardUsingAjax');

//resolutions frontend
Route::get('/frontend_resolution_list', 'FrontendResolutionController@index')->name('frontend_resolution_list');
