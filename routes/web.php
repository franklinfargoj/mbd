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
    return redirect('/login-user');
});

Route::group(['middleware' => 'disablepreventback'], function() {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/login-user', 'Auth\LoginController@getLoginForm')->name('login');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/loginUser', 'Auth\LoginController@loginUser')->name('loginUser');
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

//Society Offer Letter
Route::post('society_offer_letter/forgot_password','SocietyOfferLetterController@forgot_password')->name('society_offer_letter_forgot_password');
Route::get('/society_offer_letter_dashboard', 'SocietyOfferLetterController@dashboard')->name('society_offer_letter_dashboard');
Route::get('/offer_letter_application_form_self', 'SocietyOfferLetterController@show_offer_letter_application_self')->name('offer_letter_application_self');
Route::post('/save_offer_letter_application_form_self', 'SocietyOfferLetterController@save_offer_letter_application_self')->name('save_offer_letter_application_self');
Route::get('/offer_letter_application_form_dev', 'SocietyOfferLetterController@show_offer_letter_application_dev')->name('offer_letter_application_dev');
Route::post('/save_offer_letter_application_form_dev', 'SocietyOfferLetterController@save_offer_letter_application_dev')->name('save_offer_letter_application_dev');
Route::get('documents_upload','SocietyOfferLetterController@displaySocietyDocuments')->name('documents_upload');
Route::post('uploaded_documents','SocietyOfferLetterController@uploadSocietyDocuments')->name('uploaded_documents');
Route::get('delete_uploaded_documents/{id}','SocietyOfferLetterController@deleteSocietyDocuments');
Route::post('add_uploaded_documents_comment','SocietyOfferLetterController@addSocietyDocumentsComment')->name('add_documents_comment');
Route::get('society_offer_letter_download','SocietyOfferLetterController@displayOfferLetterApplication')->name('society_offer_letter_download');
Route::post('upload_society_offer_letter','SocietyOfferLetterController@uploadOfferLetterAfterSign')->name('upload_society_offer_letter');

Route::resource('/society_offer_letter', 'SocietyOfferLetterController');
Route::resource('/email_templates', 'EmailTemplateController');
// EE Department Routes
Route::resource('ee', 'EEDepartment\EEController');
//route for society Application Page
Route::get('/application','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');
Route::resource('received_application','DYCEDepartment\DYCEController');




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

Route::group(['middleware' => ['check-permission', 'auth', 'disablepreventback']], function() {
    Route::resource('/village_detail', 'VillageDetailController');
    Route::get('/society_detail/{id}', 'SocietyController@index')->name("society_detail.index");
    Route::get('/society_detail/create/{id}', 'SocietyController@create')->name("society_detail.create");
    Route::post('/society_detail/store', 'SocietyController@store')->name("society_detail.store");
    Route::get('/society_detail/edit/{id}', 'SocietyController@edit')->name("society_detail.edit");
    Route::post('/society_detail/update/{id}', 'SocietyController@update')->name("society_detail.update");

    Route::get('/lease_detail/{id}', 'LeaseDetailController@index')->name("lease_detail.index");
    Route::get('/lease_detail/create/{id}', 'LeaseDetailController@create')->name("lease_detail.create");
    Route::post('/lease_detail/store', 'LeaseDetailController@store')->name("lease_detail.store");

    Route::get('/lease_detail/renew-lease/{id}', 'LeaseDetailController@renewLease')->name('renew-lease.renew');
    Route::post('/lease_detail/update-lease/{id}', 'LeaseDetailController@updateLease')->name('renew-lease.update-lease');
    Route::post('loadDeleteVillageUsingAjax', 'VillageDetailController@loadDeleteVillageUsingAjax')->name('loadDeleteVillageUsingAjax');

    // EE Department Routes

    Route::resource('ee', 'EEDepartment\EEController');
    Route::get('/scrutiny-remark', 'EEDepartment\EEController@scrutinyRemarkByEE')->name('scrutiny-remark');
    Route::post('/ee-scrutiny-document', 'EEDepartment\EEController@addDocumentScrutiny')->name('ee-scrutiny-document');
    Route::post('/get-ee-scrutiny-data', 'EEDepartment\EEController@getDocumentScrutinyData')->name('get-ee-scrutiny-data');
    Route::post('/edit-ee-scrutiny-document/{id}', 'EEDepartment\EEController@editDocumentScrutiny')->name('edit-ee-scrutiny-document');
    Route::post('/ee-document-scrutiny-delete/{id}', 'EEDepartment\EEController@deleteDocumentScrutiny')->name('ee-document-scrutiny-delete');
    Route::get('/document-submitted', 'EEDepartment\EEController@documentSubmittedBySociety')->name('document-submitted');

    Route::get('get-forward-application', 'EEDepartment\EEController@getForwardApplicationForm')->name('get-forward-application');
    Route::post('/forward-application', 'EEDepartment\EEController@forwardApplication')->name('forward-application');



});

Route::post('/consent-verfication', 'EEDepartment\EEController@consentVerification')->name('consent-verfication');

Route::get('architect_application','ArchitectApplicationController@index')->name('architect_application');
Route::get('shortlisted_architect_application','ArchitectApplicationController@shortlistedIndex')->name('shortlisted_architect_application');
Route::get('final_architect_application','ArchitectApplicationController@finalIndex')->name('final_architect_application');
Route::get('view_architect_application/{id}','ArchitectApplicationController@viewApplication')->name('view_architect_application');
Route::get('evaluate_architect_application/{id}','ArchitectApplicationController@evaluateApplication')->name('evaluate_architect_application');
Route::post('save_evaluate_marks','ArchitectApplicationController@saveEvaluateMarks')->name('save_evaluate_marks');
Route::get('generate_certificate/{id}','ArchitectApplicationController@getGenerateCertificate')->name('generate_certificate');
Route::get('forward_application/{id}','ArchitectApplicationController@getForwardApplication')->name('forward_application');
Route::get('finalCertificateGenerate/{id}','ArchitectApplicationController@getFinalCertificateGenerate')->name('finalCertificateGenerate');
Route::get('tempCertificateGenerate/{id}','ArchitectApplicationController@getTempCertificateGenerate')->name('tempCertificateGenerate');
Route::post('finalCertificateGenerate','ArchitectApplicationController@postFinalCertificateGenerate')->name('finalCertificateGenerate');


Route::get('refresh_captcha','SocietyOfferLetterController@RefreshCaptcha')->name('refresh_captcha');
Route::post('UserAuthentication','SocietyOfferLetterController@UserAuthentication')->name('society_detail.UserAuthentication');

Route::get('captcha', function() {
    Captcha::create(\Illuminate\Support\Facades\Input::has('id')?\Illuminate\Support\Facades\Input::get('id'):null);
});
//Route::get('captcha', 'LoginController@captcha');


//route for society Application Page
Route::get('/application','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');

//DYCE Department routes
Route::resource('dyce','DYCEDepartment\DYCEController');
Route::get('dyce_scrutiny_remark','DYCEDepartment\DYCEController@dyceScrutinyRemark')->name('dyce.scrutiny_remark');
Route::get('societyEEDocuments','DYCEDepartment\DYCEController@societyEEDocuments')->name('dyce.society_EE_documents');
Route::get('eeScrutinyRemark','DYCEDepartment\DYCEController@eeScrutinyRemark')->name('dyce.EE_Scrutiny_Remark');

// REE Department Routes

Route::group(['middleware' => ['disablepreventback']], function() {
    Route::resource('ree_applications', 'REEDepartment\REEController');
    Route::resource('/ol_calculation_sheet', 'REEDepartment\OlApplicationCalculationSheetDetailsController');

});

// Frontend -- desgin views - abhiraj

Route::get('calculation-sheet', 'ReeCalculationSheet@CalculationSheet');
Route::get('scrunity-remarks', 'EeScrunityRemarks@ScrunityRemarks');
Route::get('forward-application', 'EeForwardApplication@ForwardApplication');

