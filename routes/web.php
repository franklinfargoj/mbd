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
Route::get('society_detail/print','SocietyController@print_data')->name('society_detail.print');

//lease details print
Route::get('lease_detail/print/{id}','LeaseDetailController@print_data')->name('lease_detail.print');

//Rti admin download applicants form in view application action
Route::get('download_applicant_form/{id}','RtiFormController@download_applicant_form')->name('download_applicant_form');

 Route::get('download_society_offer_letter/{id}','Common\CommonController@downloadOfferLetter')->name('society_offer_download');

Route::group(['middleware' => ['check_society_offer_letter_permission']], function(){
       
});

 Route::get('/application/{id}','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');
    Route::get('refresh_captcha','SocietyOfferLetterController@RefreshCaptcha')->name('refresh_captcha');
    Route::post('UserAuthentication','SocietyOfferLetterController@UserAuthentication')->name('society_detail.UserAuthentication');

   Route::resource('/society_offer_letter', 'SocietyOfferLetterController');




Route::resource('/email_templates', 'EmailTemplateController');
// EE Department Routes
Route::resource('ee', 'EEDepartment\EEController');
Route::get('society_list','EEDepartment\EEController@getSocietyDetailsWithBillingLevel')->name('society.billing_level');
Route::get('society_details/{id}','EEDepartment\EEController@getSocietyDetails')->name('society.society_details');
Route::get('arrears_charges/{society_id}/{building_id}/create','EEDepartment\ArrearsServiceController@create')->name('arrears_charges.create');
Route::post('arrears_charges/{society_id}/{building_id}/store','EEDepartment\ArrearsServiceController@store')->name('arrears_charges.store');
Route::get('arrears_charges/{id}/edit','EEDepartment\ArrearsServiceController@edit')->name('arrears_charges.edit');
Route::post('arrears_charges/{id}/update','EEDepartment\ArrearsServiceController@update')->name('arrears_charges.update');
Route::get('arrears_charges/{society_id}/{building_id}','EEDepartment\ArrearsServiceController@arrersChargesRate')->name('arrears_charges');
Route::get('service_charges/{society_id}/{building_id}/create','EEDepartment\ServiceChargesController@create')->name('service_charges.create');
Route::post('service_charges/{society_id}/{building_id}/store','EEDepartment\ServiceChargesController@store')->name('service_charges.store');
Route::get('service_charges/{id}/edit','EEDepartment\ServiceChargesController@edit')->name('service_charges.edit');
Route::post('service_charges/{id}/update','EEDepartment\ServiceChargesController@update')->name('service_charges.update');
Route::get('service_charges/{society_id}/{building_id}','EEDepartment\ServiceChargesController@serviceChargesRate')->name('service_charges');

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
    Route::get('hearing-dashboard', 'HearingController@Dashboard')->name('hearing.dashboard');
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
    Route::get('/forward_case/show/{id}', 'ForwardCaseController@show')->name('forward_case.show');

    Route::get('/send_notice_to_appellant/create/{id}', 'SendNoticeToAppellantController@create')->name('send_notice_to_appellant.create');
    Route::post('/send_notice_to_appellant/store', 'SendNoticeToAppellantController@store')->name('send_notice_to_appellant.store');
    Route::get('/send_notice_to_appellant/edit/{id}', 'SendNoticeToAppellantController@edit')->name('send_notice_to_appellant.edit');
    Route::post('/send_notice_to_appellant/update/{id}', 'SendNoticeToAppellantController@update')->name('send_notice_to_appellant.update');

    // Land Manager Routes
    
    Route::resource('/village_detail', 'VillageDetailController');
    Route::get('/society_detail', 'SocietyController@index')->name("society_detail.index");
    //Route::get('/society_detail/{id}', 'SocietyController@index')->name("society_detail.index");
    Route::get('/society_detail/create', 'SocietyController@create')->name("society_detail.create");
    // Route::get('/society_detail/create/{id}', 'SocietyController@create')->name("society_detail.create");
    Route::post('/society_detail/store', 'SocietyController@store')->name("society_detail.store");
    Route::get('/society_detail/edit/{id}', 'SocietyController@edit')->name("society_detail.edit");
    Route::get('/society_detail/show/{id}', 'SocietyController@show')->name("society_detail.show");
    Route::post('/society_detail/update/{id}', 'SocietyController@update')->name("society_detail.update");
    Route::get('/society_detail/show_end_date_lease', 'SocietyController@show_end_date_lease')->name("society_detail.show_end_date_lease");

    Route::get('/lease_detail/create/{id}', 'LeaseDetailController@create')->name("lease_detail.create");
    Route::get('/lease_detail/{id}', 'LeaseDetailController@index')->name("lease_detail.index");

    Route::post('/lease_detail/store', 'LeaseDetailController@store')->name("lease_detail.store");

    Route::get('/lease_detail/renew-lease/{id}', 'LeaseDetailController@renewLease')->name('renew-lease.renew');
    Route::post('/lease_detail/update-lease/{id}', 'LeaseDetailController@updateLease')->name('renew-lease.update-lease');
    Route::post('loadDeleteVillageUsingAjax', 'VillageDetailController@loadDeleteVillageUsingAjax')->name('loadDeleteVillageUsingAjax');
    Route::get('/lease_detail/edit-lease/{id}/{society_id}', 'LeaseDetailController@showLatestLease')->name('edit-lease.edit');
    Route::post('/lease_detail/update-edit-lease/{id}', 'LeaseDetailController@updateLatestLease')->name('update-lease.update');
    Route::get('/lease_detail/view-lease/{id}/{society_id}', 'LeaseDetailController@viewLease')->name('view-lease.view');

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


   // EM Department Routes
    Route::resource('em', 'EMDepartment\EMController');

    Route::get('get_societies', 'EMDepartment\EMController@getsocieties')->name('get_societies');
    Route::get('get_buildings/{id}', 'EMDepartment\EMController@getbuildings')->name('get_buildings');
    Route::get('get_tenants/{id}', 'EMDepartment\EMController@gettenants')->name('get_tenants');
    Route::get('soc_bill_level/{id}', 'EMDepartment\EMController@soc_bill_level')->name('soc_bill_level');
    Route::post('update_soc_bill_level', 'EMDepartment\EMController@update_soc_bill_level')->name('update_soc_bill_level');
    Route::get('soc_ward_colony/{id}', 'EMDepartment\EMController@soc_ward_colony')->name('soc_ward_colony');
    
    Route::post('update_soc_ward_colony', 'EMDepartment\EMController@update_soc_ward_colony')->name('update_soc_ward_colony');

    Route::get('get_wards', 'EMDepartment\EMController@get_wards')->name('get_wards');

    Route::get('get_colonies', 'EMDepartment\EMController@get_colonies')->name('get_colonies');
    Route::get('get_society_select', 'EMDepartment\EMController@get_society_select')->name('get_society_select');
    Route::get('get_building_ajax', 'EMDepartment\EMController@get_building_ajax')->name('get_building_ajax');
    Route::get('get_building_select', 'EMDepartment\EMController@get_building_select')->name('get_building_select');
    Route::get('get_building_select_updated', 'EMDepartment\EMController@get_building_select_updated')->name('get_building_select_updated');
    Route::get('get_tenant_ajax', 'EMDepartment\EMController@get_tenant_ajax')->name('get_tenant_ajax');


    Route::get('add_building/{id}', 'EMDepartment\EMController@add_building')->name('add_building');
    Route::get('edit_building/{id}', 'EMDepartment\EMController@edit_building')->name('edit_building');
    Route::post('create_building', 'EMDepartment\EMController@create_building')->name('create_building');
    Route::post('update_building', 'EMDepartment\EMController@update_building')->name('update_building');

    Route::get('add_tenant/{id}', 'EMDepartment\EMController@add_tenant')->name('add_tenant');
    Route::get('edit_tenant/{id}', 'EMDepartment\EMController@edit_tenant')->name('edit_tenant');
    Route::post('create_tenant', 'EMDepartment\EMController@create_tenant')->name('create_tenant');
    Route::post('update_tenant', 'EMDepartment\EMController@update_tenant')->name('update_tenant');
    Route::get('delete_tenant/{id}', 'EMDepartment\EMController@delete_tenant')->name('delete_tenant');
    Route::get('generate_soc_bill', 'EMDepartment\EMController@generate_soc_bill')->name('generate_soc_bill');
    Route::get('generate_tenant_bill', 'EMDepartment\EMController@generate_tenant_bill')->name('generate_tenant_bill');

    Route::get('arrears_calculations','EMDepartment\ArrearsCalculationController@index')->name('arrears_calculations');
    Route::get('billing_calculations','EMDepartment\BillingDetailController@index')->name('billing_calculations');

    Route::get('generateBuildingBill','EMDepartment\EMController@generateBuildingBill')->name('generateBuildingBill');
    Route::get('generateTenantBill','EMDepartment\EMController@generateTenantBill')->name('generateTenantBill');

    Route::post('create_tenant_bill','EMDepartment\EMController@create_tenant_bill')->name('create_tenant_bill');
    Route::post('create_society_bill','EMDepartment\EMController@create_society_bill')->name('create_society_bill');


    //EM_Clerk Routes
    Route::resource('em_clerk', 'EMDepartment\EMClerkController');
    Route::get('em_society_list', 'EMDepartment\EMClerkController@society_list')->name('em_society_list');
    Route::get('em_building_list', 'EMDepartment\EMClerkController@building_list')->name('em_building_list');
    Route::get('tenant_payment_list', 'EMDepartment\EMClerkController@tenant_payment_list')->name('tenant_payment_list');
    Route::get('tenant_arrear_calculation', 'EMDepartment\EMClerkController@tenant_arrear_calculation')->name('tenant_arrear_calculation');
    Route::post('create_arrear_calculation', 'EMDepartment\EMClerkController@create_arrear_calculation')->name('create_arrear_calculation');


    // RC Department Routes
    Route::resource('rc', 'RCDepartment\RCController');
    Route::get('bill_collection_society', 'RCDepartment\RCController@bill_collection_society')->name('bill_collection_society');
    Route::get('bill_collection_tenant', 'RCDepartment\RCController@bill_collection_tenant')->name('bill_collection_tenant');
    Route::get('get_building_bill_collection', 'RCDepartment\RCController@get_building_bill_collection')->name('get_building_bill_collection');
    Route::get('get_tenant_bill_collection', 'RCDepartment\RCController@get_tenant_bill_collection')->name('get_tenant_bill_collection');
    Route::get('generate_receipt_society', 'RCDepartment\RCController@generate_receipt_society')->name('generate_receipt_society');
    Route::get('generate_receipt_tenant', 'RCDepartment\RCController@generate_receipt_tenant')->name('generate_receipt_tenant');
    Route::post('payment_receipt_society', 'RCDepartment\RCController@payment_receipt_society')->name('payment_receipt_society');
    Route::post('payment_receipt_tenant', 'RCDepartment\RCController@payment_receipt_tenant')->name('payment_receipt_tenant');
    Route::get('view_bill_tenant', 'RCDepartment\RCController@view_bill_tenant')->name('view_bill_tenant');
    Route::get('view_bill_building', 'RCDepartment\RCController@view_bill_building')->name('view_bill_building');


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
    Route::get('society_reval_document/{id}','REEDepartment\REEController@societyRevalDocuments')->name('ree.society_reval_documents');

    Route::get('EE_scrutiny_remark/{id}','REEDepartment\REEController@eeScrutinyRemark')->name('ree.EE_Scrutiny_Remark');

    Route::get('dyce_Scrutiny_Remark/{id}','REEDepartment\REEController@dyceScrutinyRemark')->name('ree.dyce_scrutiny_remark');

    Route::get('ree_forward_application/{id}','REEDepartment\REEController@forwardApplication')->name('ree.forward_application');

    Route::get('ree_forward_reval_application/{id}','REEDepartment\REEController@forwardRevalApplication')->name('ree.forward_reval_application');

    Route::get('download_cap_note/{id}','REEDepartment\REEController@downloadCapNote')->name('ree.download_cap_note');
    Route::get('download_reval_cap_note/{id}','REEDepartment\REEController@downloadRevalCapNote')->name('ree.download_reval_cap_note');
    
    Route::post('ree_forward_Application_data','REEDepartment\REEController@sendForwardApplication')->name('ree.forward_application_data');
    Route::post('ree_forward_reval_Application_data','REEDepartment\REEController@sendForwardRevalApplication')->name('ree.forward_reval_application_data');

    Route::get('ree_reval_applications','REEDepartment\REEController@revalidationApplicationList')->name('ree_applications.reval');

    Route::get('calculation_sheet_options/{id}','REEDepartment\REEController@displayCalculationSheetOptions')->name('ree_applications.calculation_sheet_options');

    Route::get('custom_calculation_sheet/{id}','REEDepartment\REEController@displayCustomCalculationSheet')->name('ree_applications.custom_calculation_sheet');

    Route::post('save_custom_calculation_data','REEDepartment\REEController@saveCustomCalculationData')->name('ree.save_custom_calculation_data');

    // Route::resource('/ol_calculation_sheet', 'REEDepartment\OlApplicationCalculationSheetDetailsController');
    Route::post('ol_calculation_sheet/save_details','REEDepartment\OlApplicationCalculationSheetDetailsController@saveCalculationDetails')->name('save_calculation_details');
    Route::post('ol_reval_calculation_sheet/save_details','REEDepartment\OlApplicationCalculationSheetDetailsController@saveRevalCalculationDetails')->name('save_reval_calculation_details');

    Route::get('ol_reval_calculation_sheet/{id}','REEDepartment\OlApplicationCalculationSheetDetailsController@showRevalCalculationDetails')->name('ol_reval_calculation_sheet.show');

    Route::resource('/ol_sharing_calculation_sheet', 'REEDepartment\OlSharingCalculationSheetDetailsController');
    Route::post('ol_sharing_calculation_sheet/save_details','REEDepartment\OlSharingCalculationSheetDetailsController@saveCalculationDetails')->name('save_sharing_calculation_details');

    Route::post('ol_reval_sharing_calculation_sheet/save_details','REEDepartment\OlSharingCalculationSheetDetailsController@saveRevalCalculationDetails')->name('save_reval_sharing_calculation_details');

    Route::get('ol_reval_sharing_calculation_sheet/{id}','REEDepartment\OlApplicationCalculationSheetDetailsController@showRevalSharingCalculationDetails')->name('ol_reval_sharing_calculation_sheet.show');

    Route::post('upload_ree_note','REEDepartment\REEController@uploadREENote')->name('ree.upload_ree_note');

    // CO department route 
    Route::resource('co','CODepartment\COController');

    Route::get('co_reval_applications','CODepartment\COController@revalidationApplicationList')->name('co_applications.reval');
    Route::get('view_reval_application_co/{id}','CODepartment\COController@viewRevalApplication')->name('co.view_reval_application');

    Route::get('society_ee_documents/{id}','CODepartment\COController@societyEEDocuments')->name('co.society_EE_documents');
    Route::get('co_society_reval_document/{id}','CODepartment\COController@societyRevalDocuments')->name('co.society_reval_documents');

    Route::get('reval_calculation_sheet_co/{id}','CODepartment\COController@showRevalCalculationSheet')->name('co.show_reval_calculation_sheet');

    Route::get('ee_Scrutiny_Remark/{id}','CODepartment\COController@eeScrutinyRemark')->name('co.EE_Scrutiny_Remark');

    Route::get('scrutiny_remark_dyce/{id}','CODepartment\COController@dyceScrutinyRemark')->name('co.scrutiny_remark');

    Route::get('co_forward_application/{id}','CODepartment\COController@forwardApplication')->name('co.forward_application');

    Route::post('save_forward_Application','CODepartment\COController@sendForwardApplication')->name('co.forward_application_data');

    Route::get('download_note/{id}','CODepartment\COController@downloadCapNote')->name('co.download_cap_note');

    Route::get('co_forward_reval_application/{id}','CODepartment\COController@forwardRevalApplication')->name('co.forward_reval_application');
    Route::post('co_forward_reval_Application_data','CODepartment\COController@sendForwardRevalApplication')->name('co.forward_reval_application_data');


    // CAP department route
    Route::resource('cap','CAPDepartment\CAPController');

    Route::get('cap_reval_applications','CAPDepartment\CAPController@revalidationApplicationList')->name('cap_applications.reval');
    Route::get('view_reval_application_cap/{id}','CAPDepartment\CAPController@viewRevalApplication')->name('cap.view_reval_application');

    Route::get('cap_society_reval_document/{id}','CAPDepartment\CAPController@societyRevalDocuments')->name('cap.society_reval_documents');

    Route::get('reval_calculation_sheet_cap/{id}','CAPDepartment\CAPController@showRevalCalculationSheet')->name('cap.show_reval_calculation_sheet');

    Route::get('society_EE_document/{id}','CAPDepartment\CAPController@societyEEDocuments')->name('cap.society_EE_documents');
    Route::get('ee_scrutiny_remarks/{id}','CAPDepartment\CAPController@eeScrutinyRemark')->name('cap.EE_scrutiny_remark');

    Route::get('dyce_scrutiny_remark/{id}','CAPDepartment\CAPController@dyceScrutinyRemark')->name('cap.dyce_Scrutiny_Remark');

    Route::get('cap_forward_application/{id}','CAPDepartment\CAPController@forwardApplication')->name('cap.forward_application');
    Route::get('cap_notes/{id}','CAPDepartment\CAPController@displayCAPNote')->name('cap.cap_notes');
    Route::post('upload_cap_note','CAPDepartment\CAPController@uploadCAPNote')->name('cap.upload_cap_note');
    Route::post('cap_save_forward_Application','CAPDepartment\CAPController@sendForwardApplication')->name('cap.forward_application_data');

    Route::get('cap_forward_reval_application/{id}','CAPDepartment\CAPController@forwardRevalApplication')->name('cap.forward_reval_application');
    Route::post('cap_forward_reval_Application_data','CAPDepartment\CAPController@sendForwardRevalApplication')->name('cap.forward_reval_application_data');

        // VP department route 
    Route::resource('vp','VPDepartment\VPController');

    Route::get('vp_reval_applications','VPDepartment\VPController@revalidationApplicationList')->name('vp_applications.reval');
    Route::get('view_reval_application_vp/{id}','VPDepartment\VPController@viewRevalApplication')->name('vp.view_reval_application');

    Route::get('vp_society_reval_document/{id}','VPDepartment\VPController@societyRevalDocuments')->name('vp.society_reval_documents');

    Route::get('reval_calculation_sheet_vp/{id}','VPDepartment\VPController@showRevalCalculationSheet')->name('vp.show_reval_calculation_sheet');


    Route::get('society_EE_document_vp/{id}','VPDepartment\VPController@societyEEDocuments')->name('vp.society_EE_documents');
    Route::get('ee_scrutiny_remarks_vp/{id}','VPDepartment\VPController@eeScrutinyRemark')->name('vp.EE_scrutiny_remark');

    Route::get('dyce_scrutiny_remark_vp/{id}','VPDepartment\VPController@dyceScrutinyRemark')->name('vp.dyce_Scrutiny_Remark');

    Route::get('forward_application_vp/{id}','VPDepartment\VPController@forwardApplication')->name('vp.forward_application');

    Route::get('cap_notes_vp/{id}','VPDepartment\VPController@displayCAPNote')->name('vp.cap_notes');

    Route::post('save_forward_Application_vp','VPDepartment\VPController@sendForwardApplication')->name('vp.forward_application_data');

    Route::get('vp_forward_reval_application/{id}','VPDepartment\VPController@forwardRevalApplication')->name('vp.forward_reval_application');
    Route::post('vp_forward_reval_Application_data','VPDepartment\VPController@sendForwardRevalApplication')->name('vp.forward_reval_application_data');

    // Route::post('save_forward_Application','CODepartment\COController@sendForwardApplication')->name('co.forward_application_data');


     //Society Offer Letter
    Route::post('society_offer_letter/forgot_password','SocietyOfferLetterController@forgot_password')->name('society_offer_letter_forgot_password');
    Route::get('/society_offer_letter_dashboard', 'SocietyOfferLetterController@dashboard')->name('society_offer_letter_dashboard');

    Route::get('/show_form_self/{id}', 'SocietyOfferLetterController@show_form_self')->name('show_form_self');
    Route::get('/offer_letter_application_form_self/{id}', 'SocietyOfferLetterController@show_offer_letter_application_self')->name('offer_letter_application_self');
    Route::post('/save_offer_letter_application_form_self', 'SocietyOfferLetterController@save_offer_letter_application_self')->name('save_offer_letter_application_self');

    Route::get('/show_form_dev/{id}', 'SocietyOfferLetterController@show_form_dev')->name('show_form_dev');
    Route::get('/offer_letter_application_form_dev/{id}', 'SocietyOfferLetterController@show_offer_letter_application_dev')->name('offer_letter_application_dev');
    Route::post('/save_offer_letter_application_form_dev', 'SocietyOfferLetterController@save_offer_letter_application_dev')->name('save_offer_letter_application_dev');

    Route::get('documents_upload','SocietyOfferLetterController@displaySocietyDocuments')->name('documents_upload');
    Route::post('add_uploaded_documents_remark','SocietyOfferLetterController@addSocietyDocumentsRemark')->name('add_uploaded_documents_remark');
    Route::get('documents_uploaded','SocietyOfferLetterController@viewSocietyDocuments')->name('documents_uploaded');
    Route::post('uploaded_documents','SocietyOfferLetterController@uploadSocietyDocuments')->name('uploaded_documents');
    Route::get('delete_uploaded_documents/{id}','SocietyOfferLetterController@deleteSocietyDocuments')->name('delete_uploaded_documents');
    Route::post('add_uploaded_documents_comment','SocietyOfferLetterController@addSocietyDocumentsComment')->name('add_documents_comment');
    Route::get('society_offer_letter_download','SocietyOfferLetterController@displayOfferLetterApplication')->name('society_offer_letter_download');

    Route::get('society_offer_letter_preview','SocietyOfferLetterController@showOfferLetterApplication')->name('society_offer_letter_preview');
    Route::get('society_offer_letter_edit','SocietyOfferLetterController@editOfferLetterApplication')->name('society_offer_letter_edit');
    Route::post('society_offer_letter_update','SocietyOfferLetterController@updateOfferLetterApplication')->name('society_offer_letter_update');

    Route::get('society_offer_letter_application_download','SocietyOfferLetterController@generate_pdf')->name('society_offer_letter_application_download');
    Route::get('upload_society_offer_letter_application','SocietyOfferLetterController@showuploadOfferLetterAfterSign')->name('upload_society_offer_letter_application');
    Route::post('upload_society_offer_letter','SocietyOfferLetterController@uploadOfferLetterAfterSign')->name('upload_society_offer_letter');
    //route for society Application Page
   
    //Society Offer Letter END

    Route::get('/show_reval_self/{id}', 'SocietyOfferLetterController@show_reval_self')->name('show_reval_self');
    Route::get('/show_reval_dev/{id}', 'SocietyOfferLetterController@show_reval_dev')->name('show_reval_dev');
    Route::post('/save_offer_letter_application_reval_self', 'SocietyOfferLetterController@save_offer_letter_application_reval_self')->name('save_offer_letter_application_reval_self');
    Route::post('/save_offer_letter_application_reval_dev', 'SocietyOfferLetterController@save_offer_letter_application_reval_dev')->name('save_offer_letter_application_reval_dev');
    Route::get('society_reval_offer_letter_preview','SocietyOfferLetterController@showOfferLetterRevalApplication')->name('society_reval_offer_letter_preview');


    //architect Module
    Route::get('architect_application','ArchitectApplicationController@index')->name('architect_application');
    Route::get('shortlisted_architect_application','ArchitectApplicationController@shortlistedIndex')->name('shortlisted_architect_application');
    Route::get('final_architect_application','ArchitectApplicationController@finalIndex')->name('final_architect_application');
    Route::get('view_architect_application/{id}','ArchitectApplicationController@viewApplication')->name('view_architect_application');
    Route::get('evaluate_architect_application/{id}','ArchitectApplicationController@evaluateApplication')->name('evaluate_architect_application');
    Route::post('save_evaluate_marks','ArchitectApplicationController@saveEvaluateMarks')->name('save_evaluate_marks');
    Route::get('generate_certificate/{id}','ArchitectApplicationController@getGenerateCertificate')->name('generate_certificate');
    Route::get('forward_application_architect/{id}','ArchitectApplicationController@getForwardApplication')->name('architect.forward_application');
    Route::post('post_forward_application','ArchitectApplicationController@forward_application')->name('architect.post_forward_application');
    Route::get('finalCertificateGenerate/{id}','ArchitectApplicationController@getFinalCertificateGenerate')->name('finalCertificateGenerate');
    Route::get('tempCertificateGenerate/{id}','ArchitectApplicationController@getTempCertificateGenerate')->name('tempCertificateGenerate');
    Route::post('finalCertificateGenerate','ArchitectApplicationController@postFinalCertificateGenerate')->name('architect.post_final_signed_certificate');
    Route::get('architect_edit_certificate/{id}','ArchitectApplicationController@edit_certificate')->name('architect.edit_certificate');
    Route::post('architect_update_certificate','ArchitectApplicationController@update_certificate')->name('architect.update_certificate');
    Route::post('shortlist_architect_application','ArchitectApplicationController@shortlist_architect_application')->name('shortlist_architect_application');
    
    Route::post('finalise_architect_application','ArchitectApplicationController@finalise_architect_application')->name('finalise_architect_application');
    
    Route::post('send_to_candidate','ArchitectApplicationController@send_to_candidate')->name('appointing_architect.send_to_candidate');
    //architect module end

    //---------------------architect layout-------------------------------------------

Route::get('architect_layouts','ArchitectLayout\LayoutArchitectController@index')->name('architect_layout.index');
Route::get('architect_layouts_layout_details','ArchitectLayout\LayoutArchitectController@architect_layouts_layout_details')->name('architect_layouts_layout_details.index');
Route::get('add_architect_layouts','ArchitectLayout\LayoutArchitectController@add_layout')->name('architect_layout.add');


Route::get('check_layout_details_complete_status/{layout_detail_id}','ArchitectLayout\LayoutArchitectController@check_layout_details_complete_status')->name('check_layout_details_complete_status');

Route::get('view_architect_layout_details/{layout_id}','ArchitectLayout\LayoutArchitectController@view_architect_layout_details')->name('architect_layout_details.view');
Route::post('post_architect_layout','ArchitectLayout\LayoutArchitectController@store_layout')->name('architect_layout.store');
Route::get('add_architect_layout_detail/{layout_id}','ArchitectLayout\LayoutArchitectDetailController@add_detail')->name('architect_layout_detail.add');
Route::get('edit_architect_layout_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@edit_detail')->name('architect_layout_detail.edit');
Route::post('post_architect_layout_detail','ArchitectLayout\LayoutArchitectDetailController@create_detail')->name('architect_layout_detail.create');
Route::post('uploadLatestLayoutAjax','ArchitectLayout\LayoutArchitectDetailController@uploadLatestLayoutAjax')->name('uploadLatestLayoutAjax');

//Architect Layout Forward Application
Route::get('forward_architect_layout/{layout_id}','ArchitectLayout\LayoutArchitectController@forwardLayout')->name('forward_architect_layout');
Route::post('post_forward_architect_layout','ArchitectLayout\LayoutArchitectController@post_forward_layout')->name('post_forward_architect_layout');

//Architect Layout EM LM EE REE Scrutiny
Route::get('get_scrutiny/{layout_id}','ArchitectLayout\LayoutArchitectController@get_scrutiny')->name('architect_layout_get_scrtiny');
Route::get('add_scrutiny_report/{layout_id}','ArchitectLayout\LayoutArchitectController@add_scrutiny_report')->name('architect_layout_add_scrutiny_report');
Route::post('post_architect_layout_scrutiny_report','ArchitectLayout\LayoutArchitectController@post_scrutiny_report')->name('architect_layout_post_scrutiny_report');
Route::post('delete_architect_layout_scrutiny_report','ArchitectLayout\LayoutArchitectController@delete_scrutiny_report')->name('delete_architect_layout_scrutiny_report');
Route::post('upload_lm_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@upload_lm_checklist_and_remark_report')->name('upload_lm_checklist_and_remark_report');
Route::post('post_lm_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@post_lm_checklist_and_remark_report')->name('post_lm_checklist_and_remark_report');

Route::post('upload_em_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@upload_em_checklist_and_remark_report')->name('upload_em_checklist_and_remark_report');
Route::post('post_em_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@post_em_checklist_and_remark_report')->name('post_em_checklist_and_remark_report');

Route::post('upload_ee_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@upload_ee_checklist_and_remark_report')->name('upload_ee_checklist_and_remark_report');
Route::post('post_ee_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@post_ee_checklist_and_remark_report')->name('post_ee_checklist_and_remark_report');

Route::post('upload_ree_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@upload_ree_checklist_and_remark_report')->name('upload_ree_checklist_and_remark_report');
Route::post('post_ree_checklist_and_remark_report','ArchitectLayout\LayoutArchitectController@post_ree_checklist_and_remark_report')->name('post_ree_checklist_and_remark_report');

//scrutiny report of ee em ree and lm
Route::get('scrutiny_of_ee_em_lm_ree/{layout_id}','ArchitectLayout\LayoutArchitectController@get_scrutiny_of_ee_em_lm_ree')->name('architect_Layout_scrutiny_of_ee_em_lm_ree');

//architect layout prepare layout and excel
Route::get('architect_layout_prepare_layout_excel/{layout_id}','ArchitectLayout\LayoutArchitectController@prepare_layout_excel')->name('architect_layout_prepare_layout_excel');
Route::post('uploadLayoutandExcelAjax','ArchitectLayout\LayoutArchitectController@uploadLayoutandExcelAjax')->name('uploadLayoutandExcelAjax');

//add cts
Route::get('view_cts_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@view_cts_detail')->name('architect_layout_detail_view_cts_plan');
Route::get('add_cts_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@add_cts_detail')->name('architect_layout_detail_cts_plan');
Route::post('post_cts_detail','ArchitectLayout\LayoutArchitectDetailController@post_cts_detail')->name('post_cts_detail');
Route::post('delete_cts_detail','ArchitectLayout\LayoutArchitectDetailController@delete_cts_detail')->name('delete_cts_detail');
//add PR card
Route::get('view_prc_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@view_prc_detail')->name('architect_layout_detail_view_prc_detail');
Route::get('add_prc_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@add_prc_detail')->name('architect_layout_detail_prc_detail');
Route::post('post_prc_detail','ArchitectLayout\LayoutArchitectDetailController@post_prc_detail')->name('post_prc_detail');
Route::post('delete_prc_detail','ArchitectLayout\LayoutArchitectDetailController@delete_prc_detail')->name('delete_prc_detail');
//dp crz remark
Route::get('architect_layout_detail_dp_crz_remark_view/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@view_dp_crz_remark')->name('architect_detail_dp_crz_remark_view');
Route::get('architect_layout_detail_dp_crz_remark_add/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@add_dp_crz_remark')->name('add_architect_detail_dp_crz_remark_add');
Route::post('architect_layout_detail_dp_crz_remark_post','ArchitectLayout\LayoutArchitectDetailController@post_dp_crz_remark')->name('post_architect_detail_dp_crz_remark_add');
//add and delete EE report
Route::post('architect_layout_detail_post_ee_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailPostEEDetails')->name('architect_layout_detail_post_ee_report');
Route::post('architect_layout_detail_delete_ee_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailDeleteEEDetail')->name('architect_layout_detail_delete_ee_report');

//add and delete EM report
Route::post('architect_layout_detail_post_em_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailPostEMDetails')->name('architect_layout_detail_post_em_report');
Route::post('architect_layout_detail_delete_em_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailDeleteEMDetail')->name('architect_layout_detail_delete_em_report');

//add and delete REE report
Route::post('architect_layout_detail_post_ree_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailPostREEDetails')->name('architect_layout_detail_post_ree_report');
Route::post('architect_layout_detail_delete_ree_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailDeleteREEDetail')->name('architect_layout_detail_delete_ree_report');
//add Land Report
Route::post('architect_layout_detail_post_land_report','ArchitectLayout\LayoutArchitectDetailController@architectLyoutDetailPostLandDetails')->name('architect_layout_detail_post_land_report');


Route::get('view_court_case_or_dispute_on_land/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@view_court_case_or_dispute_on_land')->name('view_court_case_or_dispute_on_land');
//court case or dispute on land
Route::get('architect_layout_detail_court_case_or_dispute_on_land/{layout_detail_id}','ArchitectLayout\CourtCaseOrDisputeOnLandController@index')->name('architect_layout_detail_court_case_or_dispute_on_land.index');
Route::get('create_architect_layout_detail_court_case_or_dispute_on_land/{layout_detail_id}','ArchitectLayout\CourtCaseOrDisputeOnLandController@create')->name('architect_layout_detail_court_case_or_dispute_on_land.create');
Route::post('store_architect_layout_detail_court_case_or_dispute_on_land','ArchitectLayout\CourtCaseOrDisputeOnLandController@store')->name('architect_layout_detail_court_case_or_dispute_on_land.store');
Route::get('edit_architect_layout_detail_court_case_or_dispute_on_land/{id}','ArchitectLayout\CourtCaseOrDisputeOnLandController@edit')->name('architect_layout_detail_court_case_or_dispute_on_land.edit');
Route::post('update_architect_layout_detail_court_case_or_dispute_on_land','ArchitectLayout\CourtCaseOrDisputeOnLandController@update')->name('architect_layout_detail_court_case_or_dispute_on_land.update');
Route::get('show_architect_layout_detail_court_case_or_dispute_on_land/{id}','ArchitectLayout\CourtCaseOrDisputeOnLandController@show')->name('architect_layout_detail_court_case_or_dispute_on_land.view');
Route::delete('destroy_architect_layout_detail_court_case_or_dispute_on_land/{id}','ArchitectLayout\CourtCaseOrDisputeOnLandController@destroy')->name('architect_layout_detail_court_case_or_dispute_on_land.destroy');
//---------------------architect layout end---------------------------------------
//CRUD Routes

    Route::group(['namespace' => 'CRUDAdmin','prefix' => 'crudadmin'], function() {
        // Superadmin Dashboard
        Route::get('dashboard','DashboardController@index')->name('superadmin.dashboard');
        // Role
        Route::post('loadDeleteRoleUsingAjax', 'RoleController@loadDeleteRoleUsingAjax')->name('loadDeleteRoleUsingAjax');
        Route::resource('roles','RoleController');
        // Application Status
        Route::post('loadDeleteApplicationStatusUsingAjax', 'ApplicationStatusController@loadDeleteApplicationStatusUsingAjax')->name('loadDeleteApplicationStatusUsingAjax');
        Route::resource('application_status','ApplicationStatusController');
        // Hearing Status
        Route::post('DeleteHearingStatusUsingAjax', 'HearingStatusController@DeleteHearingStatusUsingAjax')->name('DeleteHearingStatusUsingAjax');
        Route::resource('hearing_status','HearingStatusController');
        // RTI Status
        Route::post('DeleteRTIStatusUsingAjax', 'RTIStatusController@DeleteRTIStatusUsingAjax')->name('DeleteRTIStatusUsingAjax');
        Route::resource('rti_status','RTIStatusController');
        // Layout
        Route::post('loadDeleteLayoutUsingAjax', 'LayoutController@loadDeleteLayoutUsingAjax')->name('loadDeleteLayoutUsingAjax');
        Route::resource('layouts','LayoutController');
        // User
        Route::post('loadDeleteUserUsingAjax', 'UserController@loadDeleteUserUsingAjax')->name('loadDeleteUserUsingAjax');
        Route::resource('users','UserController');


    });

    //Society Conveyance

    Route::get('download_template', 'SocietyConveyanceController@download_excel')->name('sc_download');
    Route::get('sc_upload_docs', 'SocietyConveyanceController@sc_upload_docs')->name('sc_upload_docs');
    Route::post('upload_sc_docs', 'SocietyConveyanceController@upload_sc_docs')->name('upload_sc_docs');
    Route::get('delete_sc_upload_docs/{id}', 'SocietyConveyanceController@delete_sc_upload_docs')->name('delete_sc_upload_docs');
    Route::post('society_bank_details', 'SocietyConveyanceController@society_bank_details')->name('society_bank_details');
    Route::get('sc_form_download', 'SocietyConveyanceController@generate_pdf')->name('sc_form_download');
    Route::get('sc_form_upload_show', 'SocietyConveyanceController@sc_form_upload_show')->name('sc_form_upload_show');
    Route::post('sc_form_upload', 'SocietyConveyanceController@sc_form_upload')->name('sc_form_upload');

    //sale & lease deed alongwith pay stamp duty letter & resolution & undertaking
    Route::get('sale_lease_deed/{id}', 'SocietyConveyanceController@show_sale_lease')->name('show_sale_lease');
    Route::get('signed_sale_lease_deed/{id}', 'SocietyConveyanceController@show_signed_sale_lease')->name('show_signed_sale_lease');
    Route::post('save_sale_lease_deed', 'SocietyConveyanceController@upload_sale_lease')->name('upload_sale_lease');
    Route::post('save_signed_sale_lease_deed', 'SocietyConveyanceController@upload_signed_sale_lease')->name('upload_signed_sale_lease');
    Route::resource('/society_conveyance','SocietyConveyanceController');

    //Society Conveyance END


    //Society Formation
    Route::get('society_formation','SocietyFormationController@index')->name('society_formation.index');
    Route::get('society_formation/create','SocietyFormationController@create')->name('society_formation.create');
    Route::post('society_formation/store','SocietyFormationController@store')->name('society_formation.store');
    Route::get('view_society_formation/{id}','SocietyFormationController@view_application')->name('society_formation.view_application');
    Route::post('upload_sf_application_attachment','SocietyFormationController@upload_sf_application_attachment')->name('upload_sf_application_attachment');
    Route::post('sf_submit_application','SocietyFormationController@sf_submit_application')->name('sf_submit_application');
    
    //admin side
    Route::get('get_sf_applications','conveyance\FormationCommonController@index')->name('get_sf_applications.index');
    Route::get('sf_view_application/{id}','conveyance\FormationCommonController@ViewApplication')->name('formation.view_application');
    Route::get('sf_forward_application/{id}','conveyance\FormationCommonController@commonForward')->name('formation.forward_application');
    Route::post('sf_post_forward_application','conveyance\FormationCommonController@saveForwardApplication')->name('formation.post_forward_application');
    
    //Society Formation End


    //Society Renewal

    Route::get('sr_download_template', 'SocietyRenewalController@download_excel')->name('sr_download');
    Route::get('sr_upload_docs', 'SocietyRenewalController@sr_upload_docs')->name('sr_upload_docs');
    Route::post('upload_sr_docs', 'SocietyRenewalController@upload_sr_docs')->name('upload_sr_docs');
    Route::get('delete_sr_upload_docs/{id}', 'SocietyRenewalController@delete_sr_upload_docs')->name('delete_sr_upload_docs');
    Route::post('add_society_documents_comment', 'SocietyRenewalController@add_society_documents_comment')->name('society_doc_comment');
    Route::get('sr_form_download', 'SocietyRenewalController@generate_pdf')->name('sr_form_download');
    Route::get('sr_form_upload_show', 'SocietyRenewalController@sr_form_upload_show')->name('sr_form_upload_show');
    Route::post('sr_form_upload', 'SocietyRenewalController@sr_form_upload')->name('sr_form_upload');

    //sale & lease deed alongwith pay stamp duty letter & resolution & undertaking
//    Route::get('sale_lease_deed/{id}', 'SocietyRenewalController@show_sale_lease')->name('show_sale_lease');
//    Route::get('signed_sale_lease_deed/{id}', 'SocietyRenewalController@show_signed_sale_lease')->name('show_signed_sale_lease');
//    Route::post('save_sale_lease_deed', 'SocietyRenewalController@upload_sale_lease')->name('upload_sale_lease');
//    Route::post('save_signed_sale_lease_deed', 'SocietyRenewalController@upload_signed_sale_lease')->name('upload_signed_sale_lease');
    Route::resource('/society_renewal','SocietyRenewalController');

    //Society Renewal END

    
});





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


// Route::get('generate-offer-letter', 'REEDepartment\REEController@GenerateOfferLetter');
Route::get('sharing-calculation-sheet', 'REEDepartment\REEController@SharingCalculationSheet');

Route::get('offer_letter','REEDepartment\REEController@offerLetter')->name('offer_letter');

// Route::get('pdfMerge', 'REEDepartment\REEController@pdfMerge')->name('ree.pdfMerge');
Route::get('approved_offer_lettershow_form_dev/{id}','REEDepartment\REEController@approvedOfferLetter')->name('ree.approved_offer_letter');
Route::get('generate_offer_letter/{id}', 'REEDepartment\REEController@GenerateOfferLetter')->name('ree.generate_offer_letter');

Route::get('approved_reval_offer_letter/{id}','REEDepartment\REEController@approvedRevalOfferLetter')->name('ree.approved_reval_offer_letter');
Route::get('generate_reval_offer_letter/{id}', 'REEDepartment\REEController@GenerateRevalOfferLetter')->name('ree.generate_reval_offer_letter');
Route::get('edit_reval_offer_letter/{id}', 'REEDepartment\REEController@editRevalOfferLetter')->name('ree.edit_reval_offer_letter');
Route::post('save_reval_offer_letter', 'REEDepartment\REEController@saveRevalOfferLetter')->name('ree.save_reval_offer_letter');
Route::post('upload_reval_offer_letter/{id}', 'REEDepartment\REEController@uploadRevalOfferLetter')->name('ree.upload_reval_offer_letter');

Route::get('edit_offer_letter/{id}', 'REEDepartment\REEController@editOfferLetter')->name('ree.edit_offer_letter');
Route::post('save_offer_letter', 'REEDepartment\REEController@saveOfferLetter')->name('ree.save_offer_letter');
Route::post('upload_offer_letter/{id}', 'REEDepartment\REEController@uploadOfferLetter')->name('ree.upload_offer_letter');
Route::post('send_for_approval','REEDepartment\REEController@sendForApproval')->name('ree.send_for_approval');
Route::post('send_letter_society','REEDepartment\REEController@sendOfferLetterToSociety')->name('ree.send_letter_society');
Route::post('send_reval_letter_society','REEDepartment\REEController@sendRevalOfferLetterToSociety')->name('ree.send_reval_letter_society');
Route::get('view_application_ree/{id}','REEDepartment\REEController@viewApplication')->name('ree.view_application');
Route::get('view_reval_application_ree/{id}','REEDepartment\REEController@viewRevalApplication')->name('ree.view_reval_application');
Route::get('calculation_sheet_ree/{id}','REEDepartment\REEController@showCalculationSheet')->name('ree.show_calculation_sheet');
Route::get('reval_calculation_sheet_ree/{id}','REEDepartment\REEController@showRevalCalculationSheet')->name('ree.show_reval_calculation_sheet');

Route::get('approve_offer_letter/{id}','CODepartment\COController@approveOfferLetter')->name('co.approve_offer_letter');
Route::post('send_approved_offer_letter','CODepartment\COController@approvedOfferLetter')->name('co.send_approved_offer_letter');
Route::get('approve_reval_offer_letter/{id}','CODepartment\COController@approveRevalOfferLetter')->name('co.approve_reval_offer_letter');
Route::post('send_approved_reval_offer_letter','CODepartment\COController@approvedRevalOfferLetter')->name('co.send_approved_reval_offer_letter');

Route::get('view_application_co/{id}','CODepartment\COController@viewApplication')->name('co.view_application');
Route::get('calculation_sheet_co/{id}','REEDepartment\REEController@showCalculationSheet')->name('co.show_calculation_sheet');

// Route::get('calculation_sheet/{id}','Common\CommonController@showCalculationSheet')->name('show_calculation_sheet');

Route::get('view_application/{id}','CAPDepartment\CAPController@viewApplication')->name('cap.view_application');
Route::get('calculation_sheet_cap/{id}','REEDepartment\REEController@showCalculationSheet')->name('cap.show_calculation_sheet');

Route::get('view_application_dyce/{id}','DYCEDepartment\DYCEController@viewApplication')->name('dyce.view_application');

Route::get('view_application_ee/{id}','EEDepartment\EEController@viewApplication')->name('ee.view_application');

Route::get('view_application_vp/{id}','VPDepartment\VPController@viewApplication')->name('vp.view_application');
Route::get('calculation_sheet_vp/{id}','REEDepartment\REEController@showCalculationSheet')->name('vp.show_calculation_sheet');


Route::resource('/ol_calculation_sheet', 'REEDepartment\OlApplicationCalculationSheetDetailsController');



Route::get('view_resolution/{id}', 'ResolutionController@view')->name('resolution.view');

// ee billing 

Route::get('ee-billing-login', 'EEBillingController@Login');
Route::get('ee-billing-dashboard', 'EEBillingController@Dashboard');
Route::get('ee-billing-list-of-societies', 'EEBillingController@ListOfSocieties');
Route::get('ee-billing-add-rates', 'EEBillingController@AddRates');
Route::get('ee-billing-arrears-charges', 'EEBillingController@ArrearsChargesRate');
Route::get('ee-billing-add-building', 'EEBillingController@AddBuilding');
Route::get('ee-billing-edit-building', 'EEBillingController@EditBuilding');
Route::get('ee-billing-manage-masters', 'EEBillingController@ManageMasters');
Route::get('ee-billing-level', 'EEBillingController@BillingLevel');
Route::get('ee-ward-colony', 'EEBillingController@WardColony');
Route::get('ee-add-tenant', 'EEBillingController@AddTenant');
Route::get('ee-society-billing-generation', 'EEBillingController@SocietyBillGeneration');
Route::get('ee-tenant-billing-generation', 'EEBillingController@SocietyBillGeneration');
Route::get('society-conveyance-application', 'EEBillingController@SocietyConveyanceApplication');
Route::get('ee-blling-arrears-calculation', 'EEBillingController@ArrearsCalculation');
Route::get('ee-blling-view-bill-details', 'EEBillingController@ViewBillDetailsSociety');
Route::get('generate-receipt', 'EEBillingController@GenerateReceipt');

//conveyance
Route::group(['middleware' => ['check-permission', 'auth', 'disablepreventback']], function(){
 
 //common in conveyance
    Route::resource('conveyance', 'conveyance\conveyanceCommonController');    
    Route::get('conveyance_application/{id}', 'conveyance\conveyanceCommonController@ViewApplication')->name('conveyance.view_application');

    Route::get('view_ee_documents/{id}', 'conveyance\conveyanceCommonController@ViewEEDocuments')->name('conveyance.view_ee_documents'); 

    Route::get('forward_application_sc/{id}', 'conveyance\conveyanceCommonController@commonForward')->name('conveyance.forward_application_sc');

    Route::post('save_forward_application_sc', 'conveyance\conveyanceCommonController@saveForwardApplication')->name('conveyance.save_forward_application');

    Route::post('save_agreement_comments', 'conveyance\conveyanceCommonController@SaveAgreementComments')->name('conveyance.save_agreement_comments');

    Route::get('view_documents/{id}', 'conveyance\conveyanceCommonController@ViewDocuments')->name('conveyance.view_documents');

    Route::get('sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@saleLeaseAgreement')->name('conveyance.sale_lease_agreement');
    
    Route::get('approved_sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@ApprovedSaleLeaseAgreement')->name('conveyance.approved_sale_lease_agreement');
    
    Route::get('stamp_duty_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@StampedSaleLeaseAgreement')->name('conveyance.stamp_duty_agreement');
    
    Route::get('stamp_signed_duty_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@SignedSaleLeaseAgreement')->name('conveyance.stamp_signed_duty_agreement');
    
    Route::get('register_sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@RegisterSaleLeaseAgreement')->name('conveyance.register_sale_lease_agreement'); 

    Route::get('checklist/{id}', 'conveyance\DYCODepartment\DYCOController@showChecklist')->name('conveyance.checklist');

    Route::get('architect_scrutiny_remark/{id}', 'conveyance\conveyanceCommonController@ArchitectScrutinyRemark')->name('conveyance.architect_scrutiny_remark'); 
    
    //dyco
    
   Route::get('conveyance_noc/{id}', 'conveyance\DYCODepartment\DYCOController@conveyanceNoc')->name('dyco.conveyance_noc');
    
    // Route::get('forward_application/{id}', 'conveyance\DYCODepartment\DYCOController@displayForwardApplication')->name('dyco.forward_application');   

    Route::get('conveyance_noc/{id}', 'conveyance\DYCODepartment\DYCOController@conveyanceNOC')->name('dyco.conveyance_noc');

    Route::post('storeChecklistData', 'conveyance\DYCODepartment\DYCOController@storeChecklistData')->name('dyco.storeChecklistData'); 

    Route::post('upload_note', 'conveyance\DYCODepartment\DYCOController@uploadNote')->name('dyco.uploadDycoNote');    

    Route::post('save_agreement', 'conveyance\DYCODepartment\DYCOController@saveAgreement')->name('dyco.save_agreement');

    Route::post('save_stamp_sign_agreement', 'conveyance\DYCODepartment\DYCOController@SaveStampSignAgreement')->name('dyco.save_stamp_sign_agreement');
    Route::post('forward_application_dyco', 'conveyance\DYCODepartment\DYCOController@saveForwardApplication')->name('dyco.forward_application_data');   

     Route::post('send_to_society', 'conveyance\DYCODepartment\DYCOController@SendToSociety')->name('dyco.send_to_society');  
     Route::post('save_approved_agreement', 'conveyance\DYCODepartment\DYCOController@saveApprovedAgreement')->name('dyco.save_approved_agreement');  

    Route::post('save_renewal_agreement', 'conveyance\DYCODepartment\DYCOController@saveRenewalAgreement')->name('dyco.save_renewal_agreement');

    Route::post('save_approve_renewal_agreement', 'conveyance\DYCODepartment\DYCOController@saveApproveRenewalAgreement')->name('dyco.save_approve_renewal_agreement');

    //EM

    Route::get('scrutiny_remark_em/{id}', 'conveyance\EMDepartment\EMController@ScrutinyRemark')->name('em.scrutiny_remark');
    Route::post('save_conveyance_letter', 'conveyance\EMDepartment\EMController@saveNoDuesCertificate')->name('em.save_conveyance_no_dues_certificate');

    // Route::get('sale_price_calculation/{id}', 'conveyance\EEDepartment\EEController@SalePriceCalculation')->name('ee.sale_price_calculation');

    //Architect

    Route::post('save_architect_scrutiny_remark', 'conveyance\conveyanceCommonController@SaveArchitectScrutinyRemark')->name('conveyance.save_architect_scrutiny_remark');

    //EE 

     Route::get('sale_price_calculation/{id}', 'conveyance\EEDepartment\EEController@SalePriceCalculation')->name('ee.sale_price_calculation');

    Route::post('save_calculation_data', 'conveyance\EEDepartment\EEController@SaveCalculationData')->name('ee.save_calculation_data');
    Route::post('save_demarcation_plan', 'conveyance\EEDepartment\EEController@SaveDemarcationPlan')->name('ee.save_demarcation_plan');
    Route::post('save_covering_letter', 'conveyance\EEDepartment\EEController@SaveCoveringLetter')->name('ee.save_covering_letter');
    Route::get('forward_application_ee/{id}', 'conveyance\EEDepartment\EEController@forwardApplication')->name('ee.forward_application_sc'); 

    Route::post('send_forward_application', 'conveyance\EEDepartment\EEController@sendForwardApplication')->name('ee.send_forward_application');

    Route::post('upload_ee_scrutiny_documents', 'conveyance\EEDepartment\EEController@uploadRenewalScrutinyDocument')->name('ee.upload_ee_scrutiny_documents'); 

    Route::post('delete_ee_scrutiny_documents', 'conveyance\EEDepartment\EEController@deleteRenewalScrutinyDocument')->name('ee.delete_ee_scrutiny_documents');

    Route::post('save_scrutiny_remark', 'conveyance\EEDepartment\EEController@SaveScrutinyRemark')->name('ee.save_scrutiny_remark');

// Renewal

    // common in renewal
    Route::resource('renewal', 'conveyance\renewalCommonController');  
    Route::get('renewal_application/{id}', 'conveyance\renewalCommonController@ViewApplication')
    ->name('renewal.view_application'); 

    Route::get('prepare_renewal_agreement/{id}', 'conveyance\renewalCommonController@PrepareRenewalAgreement')->name('renewal.prepare_renewal_agreement'); 

    Route::get('approve_renewal_agreement/{id}', 'conveyance\renewalCommonController@ApproveRenewalAgreement')->name('renewal.approve_renewal_agreement');    

     Route::get('stamp_renewal_agreement/{id}', 'conveyance\renewalCommonController@StampRenewalAgreement')->name('renewal.stamp_renewal_agreement'); 

    Route::get('renewal_forward_application/{id}', 'conveyance\renewalCommonController@commonForwardApplication')->name('renewal.renewal_forward_application');    

    Route::get('renewal_architect_scrutiny/{id}', 'conveyance\renewalCommonController@RenewalArchitectScrunity')->name('renewal.architect_scrutiny');

    Route::get('renewal_ee_scrutiny/{id}', 'conveyance\renewalCommonController@RenewalEEScrunityRemark')->name('renewal.ee_scrutiny');

    Route::post('upload_architect_documents', 'conveyance\renewalCommonController@uploadArchitectDocuments')->name('renewal.upload_architect_documents');

    Route::post('delete_architect_documents', 'conveyance\renewalCommonController@deleteRenewalArchitectDocument')->name('renewal.delete_architect_documents');

    Route::post('save_architect_scrutiny', 'conveyance\renewalCommonController@SaveArchitectScrutinyRemark')->name('renewal.save_architect_scrutiny'); 

    Route::post('save_forward_application_renewal', 'conveyance\renewalCommonController@saveForwardApplication')->name('renewal.save_forward_application_renewal'); 

    Route::post('save_stamp_renewal_agreement', 'conveyance\renewalCommonController@saveStampRenewalAgreement')->name('renewal.save_stamp_renewal_agreement');   

    Route::post('renewal_save_agreement_comments', 'conveyance\renewalCommonController@SaveAgreementComments')->name('renewal.save_agreement_comments');


    Route::get('renewal_scrutiny_remark_em/{id}', 'conveyance\EMDepartment\EMController@RenewalScrutinyRemark')->name('em.renewal_scrutiny_remark');
    Route::post('save_renewal_letter', 'conveyance\EMDepartment\EMController@saveRenewalNoDuesCertificate')->name('em.save_renewal_no_dues_certificate');
    Route::post('save_list_of_bonafide_allottees', 'conveyance\EMDepartment\EMController@saveRenewalNoDuesCertificate')->name('em.save_renewal_no_dues_certificate');
    Route::post('upload_covering_letter','conveyance\EMDepartment\EMController@uploadCoveringLetter')->name('em.upload_covering_letter');    

//dashboard    

    Route::get('/dashboard','Common\CommonController@dashboard')->name('dashboard');

});

Route::get('/calculation', function () {
    return view('admin.conveyance.common.sale_price_calculation');
});

Route::get('/scrutiny_remark_em', function () {
    return view('admin.conveyance.em_department.scrutiny_remark');
});


Route::get('/sale_lease_agreement', function () {
    return view('admin.conveyance.dyco_department.sale_lease_agreement');
});



Route::prefix('appointing_architect')->group(function () {
    Route::get('login','Auth\LoginController@getAppointingArchitectLoginForm')->name('appointing_architect.login');
    Route::get('signup','EmploymentOfArchitectController@signup')->name('appointing_architect.signup');
    Route::post('post_signup','EmploymentOfArchitectController@create_user')->name('appointing_architect.post_signup');
    Route::middleware(['check-permission', 'auth', 'disablepreventback'])->group(function(){
    Route::get('index', 'EmploymentOfArchitectController@index')->name('appointing_architect.index');
      Route::middleware(['check_eoa_form_step'])->group(function(){
        Route::get('step1/{id}', 'EmploymentOfArchitectController@step1')->name('appointing_architect.step1');
        Route::post('step1_post/{id}', 'EmploymentOfArchitectController@step1_post')->name('appointing_architect.step1_post');
        Route::get('step2/{id}', 'EmploymentOfArchitectController@step2')->name('appointing_architect.step2');
        Route::post('step2_post/{id}', 'EmploymentOfArchitectController@step2_post')->name('appointing_architect.step2_post');
        Route::post('delete_enclosure', 'EmploymentOfArchitectController@delete_enclosure')->name('appointing_architect.delete_enclosure');
        Route::get('step3/{id}', 'EmploymentOfArchitectController@step3')->name('appointing_architect.step3');
        Route::post('step3_post/{id}', 'EmploymentOfArchitectController@step3_post')->name('appointing_architect.step3_post');
        Route::get('step4/{id}', 'EmploymentOfArchitectController@step4')->name('appointing_architect.step4');
        Route::post('step4_post/{id}', 'EmploymentOfArchitectController@step4_post')->name('appointing_architect.step4_post');
        Route::post('ajaxDeleteImpProject', 'EmploymentOfArchitectController@delete_imp_project')->name('appointing_architect.delete_imp_project');
        Route::get('step5/{id}', 'EmploymentOfArchitectController@step5')->name('appointing_architect.step5');
        Route::post('step5_post/{id}', 'EmploymentOfArchitectController@step5_post')->name('appointing_architect.step5_post');
        Route::post('ajaxDeleteImpProjectWorkHandled', 'EmploymentOfArchitectController@delete_imp_project_work_handled')->name('appointing_architect.delete_imp_project_work_handled');
        Route::get('step6/{id}', 'EmploymentOfArchitectController@step6')->name('appointing_architect.step6');
        Route::post('step6_post/{id}', 'EmploymentOfArchitectController@step6_post')->name('appointing_architect.step6_post');
        Route::post('ajaxDeleteImpSeniorProfessional', 'EmploymentOfArchitectController@delete_imp_senior_professional')->name('appointing_architect.delete_imp_senior_professional');
        Route::get('step7/{id}', 'EmploymentOfArchitectController@step7')->name('appointing_architect.step7');
        Route::post('step7_post/{id}', 'EmploymentOfArchitectController@step7_post')->name('appointing_architect.step7_post');
        Route::post('ajaxDeleteProjectSheet', 'EmploymentOfArchitectController@delete_project_sheet_detail')->name('appointing_architect.delete_project_sheet_detail');
        Route::get('step8/{id}', 'EmploymentOfArchitectController@step8')->name('appointing_architect.step8');
        Route::post('step8_post/{id}', 'EmploymentOfArchitectController@step8_post')->name('appointing_architect.step8_post');
        Route::get('step9/{id}', 'EmploymentOfArchitectController@step9')->name('appointing_architect.step9');
        Route::post('step9_post/{id}', 'EmploymentOfArchitectController@step9_post')->name('appointing_architect.step9_post');
        Route::post('ajaxDeleteSupportingDocument', 'EmploymentOfArchitectController@delete_supporting_document')->name('appointing_architect.delete_supporting_document');
        Route::get('step10/{id}', 'EmploymentOfArchitectController@step10')->name('appointing_architect.step10');
        Route::post('step10_post/{id}', 'EmploymentOfArchitectController@step10_post')->name('appointing_architect.step10_post');
    });
      Route::post('send_to_architect','EmploymentOfArchitectController@send_to_architect')->name('appointing_architect.send_to_architect');
      Route::get('view_eoa_application/{id}','EmploymentOfArchitectController@view_eoa_application')->name('appointing_architect.view_eoa_application');
    });
    
});
