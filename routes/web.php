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
Route::get('rti_applicants','RtiFormController@rtiApplicants');
Route::get('schedule_meeting/{id}','RtiFormController@show_schedule_meeting_form');
Route::post('schedule_meeting_booking','RtiFormController@schedule_meeting');


Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');

//resolutions backend
//Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');
Route::resource('/resolution', 'ResolutionController');
Route::post('loadDeleteReasonOfResolutionUsingAjax', 'ResolutionController@loadDeleteReasonOfResolutionUsingAjax')->name('loadDeleteReasonOfResolutionUsingAjax');
Route::post('loadDepartmentsOfBoardUsingAjax', 'BoardController@loadDepartmentsOfBoardUsingAjax')->name('loadDepartmentsOfBoardUsingAjax');

//resolutions frontend
Route::get('/frontend_resolution_list', 'FrontendResolutionController@index')->name('frontend_resolution_list');

//Hearing Admin
Route::resource('/hearing', 'HearingController');
Route::post('loadDeleteReasonOfHearingUsingAjax', 'HearingController@loadDeleteReasonOfHearingUsingAjax')->name('loadDeleteReasonOfHearingUsingAjax');
//Route::get('/hearing/delete/{id}', 'HearingController@destroy')->name('hearing.delete');

Route::resource('/schedule_hearing', 'ScheduleHearingController');
Route::get('/schedule_hearing/create/{id}', 'ScheduleHearingController@create')->name('schedule_hearing.add');

Route::resource('/fix_schedule', 'PrePostScheduleController');
Route::get('/fix_schedule/create/{id}', 'PrePostScheduleController@create')->name('fix_schedule.add');

Route::resource('/upload_case_judgement', 'UploadCaseJudgementController');
Route::get('/upload_case_judgement/create/{id}', 'UploadCaseJudgementController@create')->name('upload_case_judgement.add');

Route::get('/forward_case/create/{id}', 'ForwardCaseController@create')->name('forward_case.create');
Route::post('/forward_case/store', 'ForwardCaseController@store')->name('forward_case.store');
Route::get('/forward_case/edit/{id}', 'ForwardCaseController@edit')->name('forward_case.edit');
Route::post('/forward_case/update/{id}', 'ForwardCaseController@update')->name('forward_case.update');
