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
Route::post('test','Auth\LoginController@test')->name('testing');

Route::get('/', function () {
    return redirect('/login-user');
});

Route::group(['middleware' => 'disablepreventback'], function() {
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/login-user', 'Auth\LoginController@getLoginForm')->name('login');
    Route::get('/society-user', 'Auth\LoginController@getSocietyLoginForm')->name('society-user');
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('/loginUser', 'Auth\LoginController@loginUser')->name('loginUser');
});

//faq print
Route::get('faq/print_data','FaqController@print_data')->name('faq.print_data');
Route::resource('/faq', 'FaqController');
Route::get('/faq/change_status/{id}', 'FaqController@change_status');
Route::resource('/board', 'BoardController');
Route::get('/board/change_status/{id}', 'BoardController@change_status');
Route::resource('/department', 'DepartmentController');
Route::get('/department/change_status/{id}', 'DepartmentController@change_status');
Route::get('frontend_register','FrontendRegisterController@showRegisterForm');
Route::post('frontend_register','FrontendRegisterController@frontendRegister');



//resolution print
Route::get('resolution/print','ResolutionController@print_data')->name('resolution.print');
Route::get('hearing/print','HearingController@print_data')->name('hearing.print');

//village details print
Route::get('village_detail/print','VillageDetailController@print_data')->name('village_detail.print');

//society details print
Route::get('society_detail/print/{id}','SocietyController@print_data')->name('society_detail.print');

//lease details print
Route::get('lease_detail/print/{id}','LeaseDetailController@print_data')->name('lease_detail.print');

//Rti admin download applicants form in view application action
Route::get('download_applicant_form/{id}','RtiFormController@download_applicant_form')->name('download_applicant_form');

 Route::get('download_society_offer_letter/{id}','Common\CommonController@downloadOfferLetter')->name('society_offer_download');

Route::group(['middleware' => ['check_society_offer_letter_permission']], function(){
       
});

 Route::get('/application','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');
    Route::get('refresh_captcha','SocietyOfferLetterController@RefreshCaptcha')->name('refresh_captcha');
    Route::post('UserAuthentication','SocietyOfferLetterController@UserAuthentication')->name('society_detail.UserAuthentication');

    Route::resource('/society_offer_letter', 'SocietyOfferLetterController');





Route::resource('/email_templates', 'EmailTemplateController');
// EE Department Routes
Route::resource('ee', 'EEDepartment\EEController');

Route::resource('received_application','DYCEDepartment\DYCEController');

Route::post('loadDepartmentsOfBoardUsingAjax', 'BoardController@loadDepartmentsOfBoardUsingAjax')->name('loadDepartmentsOfBoardUsingAjax');
Route::post('loadDepartmentsOfBoardForHearing', 'BoardController@loadDepartmentsOfBoardForHearing')->name('loadDepartmentsOfBoardForHearing');
Route::post('getDepartmentUser', 'BoardController@getDepartmentUser')->name('getDepartmentUser');


Route::resource('/rti_frontend', 'RtiFrontEndController');

Route::post('rti_frontend/create_application','RtiFrontEndController@saveRtiFrontendForm')->name('rti_frontend_application');
Route::post('rti_frontend/view_application','RtiFrontEndController@show_rti_application_status')->name('rti_frontend_application_status');

Route::post('upload_ee_note','EEDepartment\EEController@uploadEENote')->name('ee.upload_ee_note');
Route::group(['middleware' => ['check-permission', 'auth', 'disablepreventback']], function() {

    // RTI Routes

    Route::get('rti_form','RtiFormController@showFrontendForm')->name('rti_form');
// Route::post('rti_form','RtiFormController@saveFrontendForm');
    Route::get('rti_form_success','RtiFormController@rtiFormSuccess')->name('rti_form_success');
    Route::get('rti_form_success_close','RtiFormController@rtiFormSuccessClose')->name('rti_form_success_close');
    Route::get('rti_form_search','RtiFormController@searchRtiForm')->name('rti_form_search');
    Route::get('rti_applicants','RtiFormController@rtiApplicants')->name('rti_applicants');
    Route::get('schedule_meeting/{id}','RtiFormController@show_schedule_meeting_form')->name('schedule_meeting');
    Route::post('rti_schedule_meeting/{id}','RtiFormController@schedule_meeting')->name('rti_schedule_meeting');
    Route::get('view_applicant/{id}','RtiFormController@view_applicant')->name('view_applicant');
    Route::get('update_status/{id}','RtiFormController@show_update_status_form')->name('update_status');
    Route::post('rti_update_status/{id}','RtiFormController@update_status')->name('rti_update_status');
    Route::get('rti_send_info/{id}','RtiFormController@show_send_info_form')->name('rti_send_info');
    Route::post('rti_sent_info/{id}','RtiFormController@send_info')->name('rti_sent_info_data');
    Route::get('rti_forward_application/{id}','RtiFormController@show_forward_application_form')->name('rti_forwarded_application');
    Route::post('rti_forwarded_application/{id}','RtiFormController@forward_application')->name('rti_forwarded_application_data');
    // Resolution routes
    
    Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');
//resolutions backend   
//Route::get('/resolution/delete/{id}', 'ResolutionController@destroy')->name('resolution.delete');
    Route::resource('/resolution', 'ResolutionController');
    Route::post('loadDeleteReasonOfResolutionUsingAjax', 'ResolutionController@loadDeleteReasonOfResolutionUsingAjax')->name('loadDeleteReasonOfResolutionUsingAjax');

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

    // Land Manager Routes
    
    Route::resource('/village_detail', 'VillageDetailController');
    Route::get('/society_detail/{id}', 'SocietyController@index')->name("society_detail.index");
    Route::get('/society_detail/create/{id}', 'SocietyController@create')->name("society_detail.create");
    Route::post('/society_detail/store', 'SocietyController@store')->name("society_detail.store");
    Route::get('/society_detail/edit/{id}', 'SocietyController@edit')->name("society_detail.edit");
    Route::get('/society_detail/show/{id}', 'SocietyController@show')->name("society_detail.show");
    Route::post('/society_detail/update/{id}', 'SocietyController@update')->name("society_detail.update");

    Route::get('/lease_detail/create/{id}/{village_id}', 'LeaseDetailController@create')->name("lease_detail.create");
    Route::get('/lease_detail/{id}/{village_id}', 'LeaseDetailController@index')->name("lease_detail.index");

    Route::post('/lease_detail/store', 'LeaseDetailController@store')->name("lease_detail.store");

    Route::get('/lease_detail/renew-lease/{id}/{village_id}', 'LeaseDetailController@renewLease')->name('renew-lease.renew');
    Route::post('/lease_detail/update-lease/{id}', 'LeaseDetailController@updateLease')->name('renew-lease.update-lease');
    Route::post('loadDeleteVillageUsingAjax', 'VillageDetailController@loadDeleteVillageUsingAjax')->name('loadDeleteVillageUsingAjax');
    Route::get('/lease_detail/edit-lease/{id}/{village_id}', 'LeaseDetailController@showLatestLease')->name('edit-lease.edit');
    Route::post('/lease_detail/update-edit-lease/{id}', 'LeaseDetailController@updateLatestLease')->name('update-lease.update');
    Route::get('/lease_detail/view-lease/{id}/{village_id}', 'LeaseDetailController@viewLease')->name('view-lease.view');

    // EE Department Routes

    Route::resource('ee', 'EEDepartment\EEController');
    Route::get('/scrutiny-remark/{application_id}/{society_id}', 'EEDepartment\EEController@scrutinyRemarkByEE')->name('scrutiny-remark');
    Route::post('/ee-scrutiny-document', 'EEDepartment\EEController@addDocumentScrutiny')->name('ee-scrutiny-document');
    Route::post('/get-ee-scrutiny-data', 'EEDepartment\EEController@getDocumentScrutinyData')->name('get-ee-scrutiny-data');
    Route::post('/edit-ee-scrutiny-document/{id}', 'EEDepartment\EEController@editDocumentScrutiny')->name('edit-ee-scrutiny-document');
    Route::post('/ee-document-scrutiny-delete/{id}', 'EEDepartment\EEController@deleteDocumentScrutiny')->name('ee-document-scrutiny-delete');
    Route::get('/document-submitted/{society_id}', 'EEDepartment\EEController@documentSubmittedBySociety')->name('document-submitted');

    Route::post('/consent-verfication', 'EEDepartment\EEController@consentVerification')->name('consent-verfication');
    Route::post('/ee-demarcation', 'EEDepartment\EEController@eeDemarcation')->name('ee-demarcation');
    Route::post('/ee-tit-bit', 'EEDepartment\EEController@titBit')->name('ee-tit-bit');
    Route::post('/ee-rg-relocation', 'EEDepartment\EEController@rgRelocation')->name('ee-rg-relocation');

    Route::get('get-forward-application/{application_id}', 'EEDepartment\EEController@getForwardApplicationForm')->name('get-forward-application');
    Route::post('/forward-application', 'EEDepartment\EEController@forwardApplication')->name('forward-application');

    Route::post('/consent-verfication', 'EEDepartment\EEController@consentVerification')->name('consent-verfication');
    Route::post('/ee-demarcation', 'EEDepartment\EEController@eeDemarcation')->name('ee-demarcation');
    Route::post('/ee-tit-bit', 'EEDepartment\EEController@titBit')->name('ee-tit-bit');
    Route::post('/ee-rg-relocation', 'EEDepartment\EEController@rgRelocation')->name('ee-rg-relocation');    


	//DYCE Department routes
	Route::resource('dyce','DYCEDepartment\DYCEController');
	Route::get('society_EE_documents/{id}','DYCEDepartment\DYCEController@societyEEDocuments')->name('dyce.society_EE_documents');
	Route::get('ee_scrutiny_remark/{id}','DYCEDepartment\DYCEController@eeScrutinyRemark')->name('dyce.EE_Scrutiny_Remark');

    Route::get('scrutiny_remark/{id}','DYCEDepartment\DYCEController@dyceScrutinyRemark')->name('dyce.scrutiny_remark');


    Route::get('dyce_forward_application/{id}','DYCEDepartment\DYCEController@forwardApplication')->name('dyce.forward_application');
    Route::post('forward_Application_data','DYCEDepartment\DYCEController@sendForwardApplication')->name('dyce.forward_application_data');

    // REE Department Routes

    Route::resource('ree_applications', 'REEDepartment\REEController');
    Route::get('society_ee_document/{id}','REEDepartment\REEController@societyEEDocuments')->name('ree.society_EE_documents');

    Route::get('EE_scrutiny_remark/{id}','REEDepartment\REEController@eeScrutinyRemark')->name('ree.EE_Scrutiny_Remark');

    Route::get('dyce_Scrutiny_Remark/{id}','REEDepartment\REEController@dyceScrutinyRemark')->name('ree.dyce_scrutiny_remark');

    Route::get('ree_forward_application/{id}','REEDepartment\REEController@forwardApplication')->name('ree.forward_application');   
    Route::get('download_cap_note/{id}','REEDepartment\REEController@downloadCapNote')->name('ree.download_cap_note');
    Route::post('ree_forward_Application_data','REEDepartment\REEController@sendForwardApplication')->name('ree.forward_application_data');



    Route::resource('/ol_calculation_sheet', 'REEDepartment\OlApplicationCalculationSheetDetailsController');
    Route::post('ol_calculation_sheet/save_details','REEDepartment\OlApplicationCalculationSheetDetailsController@saveCalculationDetails')->name('save_calculation_details');


    Route::post('upload_ree_note','REEDepartment\REEController@uploadREENote')->name('ree.upload_ree_note');

    // CO department route 
    Route::resource('co','CODepartment\COController');
    Route::get('society_ee_documents/{id}','CODepartment\COController@societyEEDocuments')->name('co.society_EE_documents');
    Route::get('ee_Scrutiny_Remark/{id}','CODepartment\COController@eeScrutinyRemark')->name('co.EE_Scrutiny_Remark');

    Route::get('scrutiny_remark_dyce/{id}','CODepartment\COController@dyceScrutinyRemark')->name('co.scrutiny_remark');

    Route::get('co_forward_application/{id}','CODepartment\COController@forwardApplication')->name('co.forward_application');

    Route::post('save_forward_Application','CODepartment\COController@sendForwardApplication')->name('co.forward_application_data');

    Route::get('download_note/{id}','CODepartment\COController@downloadCapNote')->name('co.download_cap_note');    

        // CAP department route 
    Route::resource('cap','CAPDepartment\CAPController');
    Route::get('society_EE_document/{id}','CAPDepartment\CAPController@societyEEDocuments')->name('cap.society_EE_documents');
    Route::get('ee_scrutiny_remarks/{id}','CAPDepartment\CAPController@eeScrutinyRemark')->name('cap.EE_scrutiny_remark');

    Route::get('dyce_scrutiny_remark/{id}','CAPDepartment\CAPController@dyceScrutinyRemark')->name('cap.dyce_Scrutiny_Remark');

    Route::get('cap_forward_application/{id}','CAPDepartment\CAPController@forwardApplication')->name('cap.forward_application');
    Route::get('cap_notes/{id}','CAPDepartment\CAPController@displayCAPNote')->name('cap.cap_notes');
    Route::post('upload_cap_note','CAPDepartment\CAPController@uploadCAPNote')->name('cap.upload_cap_note');
    Route::post('cap_save_forward_Application','CAPDepartment\CAPController@sendForwardApplication')->name('cap.forward_application_data');


        // VP department route 
    Route::resource('vp','VPDepartment\VPController');
    Route::get('society_EE_document_vp/{id}','VPDepartment\VPController@societyEEDocuments')->name('vp.society_EE_documents');
    Route::get('ee_scrutiny_remarks_vp/{id}','VPDepartment\VPController@eeScrutinyRemark')->name('vp.EE_scrutiny_remark');

    Route::get('dyce_scrutiny_remark_vp/{id}','VPDepartment\VPController@dyceScrutinyRemark')->name('vp.dyce_Scrutiny_Remark');

    Route::get('forward_application_vp/{id}','VPDepartment\VPController@forwardApplication')->name('vp.forward_application');
    Route::get('cap_notes_vp/{id}','VPDepartment\VPController@displayCAPNote')->name('vp.cap_notes');
    Route::post('save_forward_Application_vp','VPDepartment\VPController@sendForwardApplication')->name('vp.forward_application_data');    

    // Route::post('save_forward_Application','CODepartment\COController@sendForwardApplication')->name('co.forward_application_data');


     //Society Offer Letter
    Route::post('society_offer_letter/forgot_password','SocietyOfferLetterController@forgot_password')->name('society_offer_letter_forgot_password');
    Route::get('/society_offer_letter_dashboard', 'SocietyOfferLetterController@dashboard')->name('society_offer_letter_dashboard');
    Route::get('/offer_letter_application_form_self/{id}', 'SocietyOfferLetterController@show_offer_letter_application_self')->name('offer_letter_application_self');
    Route::post('/save_offer_letter_application_form_self', 'SocietyOfferLetterController@save_offer_letter_application_self')->name('save_offer_letter_application_self');
    Route::get('/offer_letter_application_form_dev/{id}', 'SocietyOfferLetterController@show_offer_letter_application_dev')->name('offer_letter_application_dev');
    Route::post('/save_offer_letter_application_form_dev', 'SocietyOfferLetterController@save_offer_letter_application_dev')->name('save_offer_letter_application_dev');
    Route::get('documents_upload','SocietyOfferLetterController@displaySocietyDocuments')->name('documents_upload');
    Route::post('add_uploaded_documents_remark','SocietyOfferLetterController@addSocietyDocumentsRemark')->name('add_uploaded_documents_remark');
    Route::get('documents_uploaded','SocietyOfferLetterController@viewSocietyDocuments')->name('documents_uploaded');
    Route::post('uploaded_documents','SocietyOfferLetterController@uploadSocietyDocuments')->name('uploaded_documents');
    Route::get('delete_uploaded_documents/{id}','SocietyOfferLetterController@deleteSocietyDocuments')->name('delete_uploaded_documents');
    Route::post('add_uploaded_documents_comment','SocietyOfferLetterController@addSocietyDocumentsComment')->name('add_documents_comment');
    Route::get('society_offer_letter_download','SocietyOfferLetterController@displayOfferLetterApplication')->name('society_offer_letter_download');
    Route::post('upload_society_offer_letter','SocietyOfferLetterController@uploadOfferLetterAfterSign')->name('upload_society_offer_letter');
    //route for society Application Page
   
    //Society Offer Letter END


});


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


// Route::get('refresh_captcha','SocietyOfferLetterController@RefreshCaptcha')->name('refresh_captcha');

Route::get('captcha', function() {
    Captcha::create(\Illuminate\Support\Facades\Input::has('id')?\Illuminate\Support\Facades\Input::get('id'):null);
});
//Route::get('captcha', 'LoginController@captcha');




// Frontend -- desgin views - abhiraj

Route::get('calculation-sheet', 'ReeCalculationSheet@CalculationSheet');
Route::get('scrutiny-remarks', 'EeScrunityRemarks@ScrunityRemarks');
Route::get('forward-application', 'EeForwardApplication@ForwardApplication');
Route::get('offer-letter-doc', 'OfferLetterController@OfferLetterDoc');

// Route::get('offer_letter', 'OfferLetterController@OfferLetterDoc');

// Route::get('offer_letter','REEDepartment\REEController@offerLetter')->name('offer_letter');
Route::get('generate_offer_letter/{id}', 'REEDepartment\REEController@GenerateOfferLetter')->name('ree.generate_offer_letter');

Route::get('pdfMerge', 'REEDepartment\REEController@pdfMerge')->name('ree.pdfMerge');
Route::get('edit_offer_letter', 'REEDepartment\REEController@editOfferLetter')->name('ree.edit_offer_letter');
Route::post('saveOfferLetter', 'REEDepartment\REEController@saveOfferLetter')->name('ree.saveOfferLetter');



