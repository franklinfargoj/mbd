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
// Route::post('rti_form','RtiFormController@saveFrontendForm');
Route::get('rti_form_success','RtiFormController@rtiFormSuccess');
Route::get('rti_form_success_close','RtiFormController@rtiFormSuccessClose');
Route::get('rti_form_search','RtiFormController@searchRtiForm');
Route::get('rti_applicants','RtiFormController@rtiApplicants');
Route::get('schedule_meeting/{id}','RtiFormController@show_schedule_meeting_form');
Route::post('rti_schedule_meeting/{id}','RtiFormController@schedule_meeting');
Route::get('view_applicant/{id}','RtiFormController@view_applicant');
Route::get('update_status/{id}','RtiFormController@show_update_status_form');
Route::post('rti_update_status/{id}','RtiFormController@update_status');
Route::get('rti_send_info/{id}','RtiFormController@show_send_info_form');
Route::post('rti_sent_info/{id}','RtiFormController@send_info');
Route::get('rti_forward_application/{id}','RtiFormController@show_forward_application_form');
Route::post('rti_forwarded_application/{id}','RtiFormController@forward_application');
Route::post('rti_frontend/create_application','RtiFrontEndController@saveRtiFrontendForm')->name('rti_frontend_application');
Route::post('rti_frontend/view_application','RtiFrontEndController@show_rti_application_status')->name('rti_frontend_application_status');
Route::resource('/rti_frontend', 'RtiFrontEndController');
Route::post('society_offer_letter/forgot_password','SocietyOfferLetterController@forgot_password')->name('society_offer_letter_forgot_password');
Route::get('/society_offer_letter_dashboard', 'SocietyOfferLetterController@dashboard')->name('society_offer_letter_dashboard');
Route::get('/offer_letter_application_form', 'SocietyOfferLetterController@show_offer_letter_application')->name('offer_letter_application');
Route::resource('/society_offer_letter', 'SocietyOfferLetterController');
Route::resource('/email_templates', 'EmailTemplateController');


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

Route::get('/send_notice_to_appellant/create/{id}', 'SendNoticeToAppellantController@create')->name('send_notice_to_appellant.create');
Route::post('/send_notice_to_appellant/store', 'SendNoticeToAppellantController@store')->name('send_notice_to_appellant.store');
Route::get('/send_notice_to_appellant/edit/{id}', 'SendNoticeToAppellantController@edit')->name('send_notice_to_appellant.edit');
Route::post('/send_notice_to_appellant/update/{id}', 'SendNoticeToAppellantController@update')->name('send_notice_to_appellant.update');

Route::resource('/village_detail', 'VillageDetailController');
Route::get('/society_detail/{id}', 'SocietyController@index')->name("society_detail.index");
Route::get('/society_detail/create/{id}', 'SocietyController@create')->name("society_detail.create");
Route::post('/society_detail/store', 'SocietyController@store')->name("society_detail.store");

Route::get('/lease_detail/{id}', 'LeaseDetailController@index')->name("lease_detail.index");
Route::get('/lease_detail/create/{id}', 'LeaseDetailController@create')->name("lease_detail.create");
Route::post('/lease_detail/store', 'LeaseDetailController@store')->name("lease_detail.store");

Route::get('/lease_detail/renew-lease/{id}', 'LeaseDetailController@renewLease')->name('renew-lease.renew');
Route::post('/lease_detail/update-lease/{id}', 'LeaseDetailController@updateLease')->name('renew-lease.update-lease');


Route::get('architect_application','ArchitectApplicationController@index');
Route::get('shortlisted_architect_application','ArchitectApplicationController@shortlistedIndex');
Route::get('final_architect_application','ArchitectApplicationController@finalIndex');
Route::get('view_architect_application/{id}','ArchitectApplicationController@viewApplication');
Route::get('evaluate_architect_application/{id}','ArchitectApplicationController@evaluateApplication');
Route::post('save_evaluate_marks','ArchitectApplicationController@saveEvaluateMarks')->name('save_evaluate_marks');
Route::get('generate_certificate/{id}','ArchitectApplicationController@getGenerateCertificate');
Route::get('forward_application/{id}','ArchitectApplicationController@getForwardApplication');
Route::get('finalCertificateGenerate/{id}','ArchitectApplicationController@getFinalCertificateGenerate');
Route::get('tempCertificateGenerate/{id}','ArchitectApplicationController@getTempCertificateGenerate');
Route::post('finalCertificateGenerate','ArchitectApplicationController@postFinalCertificateGenerate');

Route::post('loadDeleteVillageUsingAjax', 'VillageDetailController@loadDeleteVillageUsingAjax')->name('loadDeleteVillageUsingAjax');
Route::get('refresh_captcha','SocietyOfferLetterController@RefreshCaptcha')->name('refresh_captcha');
Route::post('UserAuthentication','SocietyOfferLetterController@UserAuthentication')->name('society_detail.UserAuthentication');


// EE Department Routes

Route::resource('ee', 'EEDepartment\EEController');
//route for society Application Page
Route::get('/application','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');
Route::resource('received_application','DYCEDepartment\DYCEController');
Route::get('documents_Upload','SocietyOfferLetterController@displaySocietyDocuments');
