<?php
use App\Events\SmsHitEvent;
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
Route::get('send_sms',function(){
    event(new SmsHitEvent('9769121477','testing'));
    
    // $curl_handle=curl_init();
    // curl_setopt($curl_handle,CURLOPT_URL,'http://www.hindit.co.in/API/pushsms.aspx?loginID=t1mhada&password=Mh@d@18&mobile=9769121477&text=test&senderid=MHADAB&route_id=2&Unicode=0&IP=180.149.241.179');
    // curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
    // curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    // $buffer = curl_exec($curl_handle);
    // curl_close($curl_handle);
    // if (empty($buffer)){
    //     print "Nothing returned from url.<p>";
    // }
    // else{
    //     print $buffer;
    // }
//     http://www.hindit.co.in/API/pushsms.aspx?loginID=<#your
// Login_Id#>&password=<#password#>&mobile=98********&text=<#message#>&senderid=<#Sende
// rID#>&route_id=<#route_id#>&Unicode=0&IP=x.x.x.x
});
Route::get('testing',function(){
    return \App\Layout\ArchitectLayout::whereHas('ArchitectLayoutStatusLog',function($q){
        $q->where('user_id',18)->where('current_status',1)->where('status_id',3);
    })->where('layout_excel_status',1)->get();
});
Route::post('test','Auth\LoginController@test')->name('testing');
Route::post('check_user_email_duplicate','Auth\LoginController@check_user_email_duplicate')->name('check_user_email_duplicate');
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
Route::post('rti_frontend/appelle','RtiFrontEndController@rti_appelle')->name('rti_frontend.appelle');
Route::post('rti_frontend/create_application','RtiFrontEndController@saveRtiFrontendForm')->name('rti_frontend_application');
Route::post('rti_frontend/view_application','RtiFrontEndController@show_rti_application_status')->name('rti_frontend_application_status');

Route::post('upload_ee_note','EEDepartment\EEController@uploadEENote')->name('ee.upload_ee_note');

//User Profile
Route::get('/profile','Common\CommonController@profile')->name('admin.profile');
Route::post('/update_profile','Common\CommonController@update_profile')->name('admin.update_profile');

Route::group(['middleware' => ['check-permission', 'auth', 'disablepreventback']], function() {

    //Reports

    Route::get('redevelopement_period_wise_pendency_report','Reports\RedevelopementController@period_wise_pendency')->name('redevelopement.period_wise_pendency_report');
    Route::get('redevelopement_pending_reports','Reports\RedevelopementController@redevelopement_pending_reports')->name('redevelopement_pending_reports');
    //Reports end
    // RTI Routes

//    Route::get('rti_form','RtiFormController@showFrontendForm')->name('rti_form');
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
    Route::get('rti_statstics_reports','Reports\RtiReportController@rti_statstics_reports')->name('rti_statstics_reports');
    Route::get('rti_submitted_reports_by_users','Reports\RtiReportController@rti_submitted_reports_by_users')->name('rti_submitted_reports_by_users');
    Route::get('rti_reports_department','Reports\RtiReportController@reports_department')->name('rti_reports_department');
    Route::get('rti_reports_status','Reports\RtiReportController@reports_status')->name('rti_reports_status');
    Route::get('pending_rti','Reports\RtiReportController@pending_rti')->name('pending_rti');
    Route::get('period_wise_pendancy','Reports\RtiReportController@period_wise_pendancy')->name('rti.period_wise_pendancy');
    Route::get('rti-dashboard', 'Reports\RtiReportController@Dashboard')->name('rti.dashboard');
    
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
    Route::get('hearing_log/{id}', 'HearingController@getHearingLogs')->name('hearing.logs');
    Route::get('hearing_logs/{id}', 'HearingController@getAllHearingLogs')->name('hearing.log');

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
     Route::post('/delete_ee_note', 'EEDepartment\EEController@deleteEENote')->name('delete_ee_note');    
     Route::get('/ee_variation_report/{id}', 'EEDepartment\EEController@generateEEVariationReport')->name('ee_variation_report');    


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
    Route::get('get_building_select_updated_RC', 'RCDepartment\RCController@get_building_select_updated_RC')->name('get_building_select_updated_RC');
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
    Route::get('get_arrear_charges','EMDepartment\EMClerkController@getArrearChargesByYear')->name('get_arrear_charges');
    Route::get('get_arrear_charges_multiple','EMDepartment\EMClerkController@getArrearChargesByYears')->name('get_arrear_charges_multiple');

    // RC Department Routes
    Route::get('get_building_bill_collection', 'RCDepartment\RCController@get_building_bill_collection')->name('get_building_bill_collection');
    Route::get('get_tenant_bill_collection', 'RCDepartment\RCController@get_tenant_bill_collection')->name('get_tenant_bill_collection');
    Route::resource('rc', 'RCDepartment\RCController');
    Route::get('bill_collection_society', 'RCDepartment\RCController@bill_collection_society')->name('bill_collection_society');
    Route::get('bill_collection_tenant', 'RCDepartment\RCController@bill_collection_tenant')->name('bill_collection_tenant');
    Route::get('generate_receipt_society', 'RCDepartment\RCController@generate_receipt_society')->name('generate_receipt_society');
    Route::get('generate_receipt_tenant', 'RCDepartment\RCController@generate_receipt_tenant')->name('generate_receipt_tenant');
    Route::post('payment_receipt_society', 'RCDepartment\RCController@payment_receipt_society')->name('payment_receipt_society');
    Route::post('payment_receipt_tenant', 'RCDepartment\RCController@payment_receipt_tenant')->name('payment_receipt_tenant');
    Route::get('view_bill_tenant', 'RCDepartment\RCController@view_bill_tenant')->name('view_bill_tenant');
    Route::get('view_bill_building', 'RCDepartment\RCController@view_bill_building')->name('view_bill_building');
    Route::get('downloadBill','RCDepartment\RCController@downloadBill')->name('downloadBill');
    Route::get('downloadReceipt','RCDepartment\RCController@downloadReceipt')->name('downloadReceipt');
    
    //Account Department routes 
    Route::get('search_accounts','AccountDepartment\AccountController@index')->name('search_accounts');
    Route::get('get_building_select_society','AccountDepartment\AccountController@getBuildingSelectSociety')->name('get_building_select_society');
    Route::get('get_societies_select_layout','AccountDepartment\AccountController@getSocietySelectLayout')->name('get_societies_select_layout');
    Route::get('account_search','AccountDepartment\AccountController@search')->name('account_search');
    Route::get('view_calculations/{tenant_id}/{year}','AccountDepartment\AccountController@viewCalculations')->name('view_calculations');
    Route::get('payment_details/{tenant_id}','AccountDepartment\AccountController@paymentDetails')->name('payment_details');

    //common in offer letter

    Route::get('ee_scrutiny_remark/{id}','Common\CommonController@eeScrutinyRemark')->name('common.EE_Scrutiny_Remark');

     Route::get('dyce_Scrutiny_Remark/{id}','Common\CommonController@dyceScrutinyRemark')->name('common.dyce_scrutiny_remark');

     // Route::get('society_documents/{id}','Common\CommonController@documentSubmittedBySociety')->name('common.society_documents');
	Route::get('view_society_EE_documents/{id}','Common\CommonController@societyEEDocuments')->name('common.view_society_EE_documents');

     Route::get('view_multiple_document/{id}/{document_id}','Common\CommonController@viewMultipleDocuments')->name('view_multiple_document');


    //DYCE Department routes
    Route::resource('dyce','DYCEDepartment\DYCEController');
	

    Route::get('scrutiny_remark/{id}','DYCEDepartment\DYCEController@dyceScrutinyRemark')->name('dyce.scrutiny_remark');


    Route::get('dyce_forward_application/{id}','DYCEDepartment\DYCEController@forwardApplication')->name('dyce.forward_application');
    Route::post('forward_Application_data','DYCEDepartment\DYCEController@sendForwardApplication')->name('dyce.forward_application_data');

    // REE Department Routes

    Route::resource('ree_applications', 'REEDepartment\REEController');
    // Route::get('society_ee_document/{id}','REEDepartment\REEController@societyEEDocuments')->name('ree.society_EE_documents');
    Route::get('society_reval_document/{id}','REEDepartment\REEController@societyRevalDocuments')->name('ree.society_reval_documents');

    // Route::get('EE_scrutiny_remark/{id}','REEDepartment\REEController@eeScrutinyRemark')->name('ree.EE_Scrutiny_Remark');

    // Route::get('dyce_Scrutiny_Remark_ree/{id}','REEDepartment\REEController@dyceScrutinyRemark')->name('ree.dyce_scrutiny_remark');

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

    Route::get('ol_reval_sharing_calculation_sheet/{id}','REEDepartment\OlSharingCalculationSheetDetailsController@showRevalSharingCalculationDetails')->name('ol_reval_sharing_calculation_sheet.show');

    Route::post('upload_ree_note','REEDepartment\REEController@uploadREENote')->name('ree.upload_ree_note');

    Route::get('fsi_calculation_application/{id}','REEDepartment\REEController@fsiCalculationSheet')->name('ree.fsi_calculation_application'); 

    Route::post('save_fsi_calculation_data','REEDepartment\REEController@saveFsiCalculationData')->name('ree.save_fsi_calculation_data');

    // CO department route 
    Route::resource('co','CODepartment\COController');

    Route::get('co_reval_applications','CODepartment\COController@revalidationApplicationList')->name('co_applications.reval');
    Route::get('view_reval_application_co/{id}','CODepartment\COController@viewRevalApplication')->name('co.view_reval_application');

    // Route::get('society_ee_documents/{id}','CODepartment\COController@societyEEDocuments')->name('co.society_EE_documents');
    Route::get('co_society_reval_document/{id}','CODepartment\COController@societyRevalDocuments')->name('co.society_reval_documents');

    Route::get('reval_calculation_sheet_co/{id}','CODepartment\COController@showRevalCalculationSheet')->name('co.show_reval_calculation_sheet');

    // Route::get('ee_Scrutiny_Remark/{id}','CODepartment\COController@eeScrutinyRemark')->name('co.EE_Scrutiny_Remark');

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
    // Route::get('ee_scrutiny_remarks/{id}','CAPDepartment\CAPController@eeScrutinyRemark')->name('cap.EE_scrutiny_remark');

    // Route::get('dyce_scrutiny_remark/{id}','CAPDepartment\CAPController@dyceScrutinyRemark')->name('cap.dyce_Scrutiny_Remark');

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
    // Route::get('ee_scrutiny_remarks_vp/{id}','VPDepartment\VPController@eeScrutinyRemark')->name('vp.EE_scrutiny_remark');

    // Route::get('dyce_scrutiny_remark_vp/{id}','VPDepartment\VPController@dyceScrutinyRemark')->name('vp.dyce_Scrutiny_Remark');

    Route::get('forward_application_vp/{id}','VPDepartment\VPController@forwardApplication')->name('vp.forward_application');

    Route::get('cap_notes_vp/{id}','VPDepartment\VPController@displayCAPNote')->name('vp.cap_notes');

    Route::post('save_forward_Application_vp','VPDepartment\VPController@sendForwardApplication')->name('vp.forward_application_data');

    Route::get('vp_forward_reval_application/{id}','VPDepartment\VPController@forwardRevalApplication')->name('vp.forward_reval_application');
    Route::post('vp_forward_reval_Application_data','VPDepartment\VPController@sendForwardRevalApplication')->name('vp.forward_reval_application_data');

    // Route::post('save_forward_Application','CODepartment\COController@sendForwardApplication')->name('co.forward_application_data');

    Route::group(['prefix'=>'society'], function() {

        //Society user profile
        Route::get('/profile','Common\CommonController@profile')->name('society.profile');
        Route::post('/update_profile','Common\CommonController@update_profile')->name('society.update_profile');

        //Society Offer Letter
        Route::get('/application/{id}','SocietyOfferLetterController@ViewApplications')->name('society_detail.application');
        Route::post('society_offer_letter/forgot_password', 'SocietyOfferLetterController@forgot_password')->name('society_offer_letter_forgot_password');
        Route::get('/society_offer_letter_dashboard', 'SocietyOfferLetterController@dashboard')->name('society_offer_letter_dashboard');

        Route::get('/show_form_self/{id}', 'SocietyOfferLetterController@show_form_self')->name('show_form_self');

        Route::get('/offer_letter_application_form_self/{id}', 'SocietyOfferLetterController@show_offer_letter_application_self')->name('offer_letter_application_self');
        Route::post('/save_offer_letter_application_form_self', 'SocietyOfferLetterController@save_offer_letter_application_self')->name('save_offer_letter_application_self');

        Route::get('/show_form_dev/{id}', 'SocietyOfferLetterController@show_form_dev')->name('show_form_dev');
        Route::get('/show_form_dev_noc/{id}', 'SocietyNocController@show_form_dev_noc')->name('show_form_dev_noc');
        Route::get('/offer_letter_application_form_dev/{id}', 'SocietyOfferLetterController@show_offer_letter_application_dev')->name('offer_letter_application_dev');
        Route::post('/save_offer_letter_application_form_dev', 'SocietyOfferLetterController@save_offer_letter_application_dev')->name('save_offer_letter_application_dev');

        Route::get('documents_upload', 'SocietyOfferLetterController@displaySocietyDocuments')->name('documents_upload');
        Route::post('add_uploaded_documents_remark', 'SocietyOfferLetterController@addSocietyDocumentsRemark')->name('add_uploaded_documents_remark');
        Route::get('documents_uploaded', 'SocietyOfferLetterController@viewSocietyDocuments')->name('documents_uploaded');
        Route::post('uploaded_documents', 'SocietyOfferLetterController@uploadSocietyDocuments')->name('uploaded_documents');
        Route::get('/upload_multiple_documents/{societyId}/{documentId}', 'SocietyOfferLetterController@uploadMultipleDocuments')->name('upload_multiple_documents');

        Route::post('/save_documents', 'SocietyOfferLetterController@saveDocuments')->name('save_documents'); 
        Route::post('/delete_documents', 'SocietyOfferLetterController@deleteDocuments')->name('delete_documents'); 

        Route::get('delete_uploaded_documents/{id}', 'SocietyOfferLetterController@deleteSocietyDocuments')->name('delete_uploaded_documents');
        Route::post('add_uploaded_documents_comment', 'SocietyOfferLetterController@addSocietyDocumentsComment')->name('add_documents_comment');
        Route::get('society_offer_letter_download', 'SocietyOfferLetterController@displayOfferLetterApplication')->name('society_offer_letter_download');

        Route::get('society_offer_letter_preview', 'SocietyOfferLetterController@showOfferLetterApplication')->name('society_offer_letter_preview');
        Route::get('society_offer_letter_edit', 'SocietyOfferLetterController@editOfferLetterApplication')->name('society_offer_letter_edit');
        Route::post('society_offer_letter_update', 'SocietyOfferLetterController@updateOfferLetterApplication')->name('society_offer_letter_update');

        Route::get('society_offer_letter_application_download', 'SocietyOfferLetterController@generate_pdf')->name('society_offer_letter_application_download');
        Route::get('upload_society_offer_letter_application', 'SocietyOfferLetterController@showuploadOfferLetterAfterSign')->name('upload_society_offer_letter_application');
        Route::post('upload_society_offer_letter', 'SocietyOfferLetterController@uploadOfferLetterAfterSign')->name('upload_society_offer_letter');

        Route::get('society_applications', 'SocietyOfferLetterController@society_applications')->name('society_applications');
        //route for society Application Page

        //Society Offer Letter END


        //tripartite start
        Route::get('tripartite_dashboard', 'TripartiteDashboardController@getDashboardHeaders')->name('tripartite_dashboard');
        Route::get('/show_tripatite_self/{id}', 'SocietyTripatiteController@show_tripatite_self')->name('show_tripatite_self');
        Route::post('/save_tripatite_self', 'SocietyTripatiteController@save_tripatite_self')->name('save_tripatite_self');
        Route::get('/show_tripatite_dev/{id}', 'SocietyTripatiteController@show_tripatite_dev')->name('show_tripatite_dev');
        Route::post('/save_tripatite_dev', 'SocietyTripatiteController@save_tripatite_dev')->name('save_tripatite_dev');
        Route::get('/tripartite_application_form_preview/{id}', 'SocietyTripatiteController@tripartite_application_form_preview')->name('tripartite_application_form_preview');
        Route::get('/society_tripartite_docs/{id}', 'SocietyTripatiteController@display_tripartite_docs')->name('display_tripartite_docs');
        Route::post('/upload_tripartite_docs', 'SocietyTripatiteController@upload_tripartite_docs')->name('upload_tripartite_docs');
        Route::get('/tripartite_application_form_edit/{id}', 'SocietyTripatiteController@tripartite_application_form_edit')->name('tripartite_application_form_edit');
        Route::post('/tripartite_application_form_update', 'SocietyTripatiteController@tripartite_application_form_update')->name('tripartite_application_form_update');
        Route::get('/delete_tripartite_docs/{id}', 'SocietyTripatiteController@delete_tripartite_docs')->name('delete_tripartite_docs');
        Route::post('add_tripartite_documents_comment', 'SocietyTripatiteController@addSocietyDocumentsComment')->name('add_tripartite_documents_comment');
        Route::get('upload_society_tripartite_application/{id}', 'SocietyTripatiteController@showuploadTripartiteAfterSign')->name('upload_society_tripartite_application');
        Route::post('upload_society_tripartite', 'SocietyTripatiteController@uploadTripartiteAfterSign')->name('upload_society_tripartite');
        Route::get('society_tripartite_application_download/{id}', 'SocietyTripatiteController@generate_pdf')->name('society_tripartite_application_download');
        Route::get('tripartite_agreement/{id}', 'SocietyTripatiteController@show_tripartite_agreement')->name('show_tripartite_agreement');
        Route::post('upload_tripartite_agreement', 'SocietyTripatiteController@upload_tripartite_agreement')->name('upload_tripartite_agreement');

        //tripartite end

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
    Route::get('lease_deed/{id}', 'SocietyRenewalController@show_sale_lease')->name('show_lease');
    Route::get('signed_lease_deed/{id}', 'SocietyRenewalController@show_signed_sale_lease')->name('show_signed_lease');
    Route::post('save_lease_deed', 'SocietyRenewalController@upload_sale_lease')->name('upload_lease');
    Route::post('save_signed_lease_deed', 'SocietyRenewalController@upload_signed_sale_lease')->name('upload_signed_lease');
        Route::resource('/society_renewal','SocietyRenewalController');

        //Society Renewal END

    });

    Route::get('/show_reval_self/{id}', 'SocietyOfferLetterController@show_reval_self')->name('show_reval_self');
    Route::get('/show_reval_dev/{id}', 'SocietyOfferLetterController@show_reval_dev')->name('show_reval_dev');
    Route::post('/save_offer_letter_application_reval_self', 'SocietyOfferLetterController@save_offer_letter_application_reval_self')->name('save_offer_letter_application_reval_self');
    Route::post('/save_offer_letter_application_reval_dev', 'SocietyOfferLetterController@save_offer_letter_application_reval_dev')->name('save_offer_letter_application_reval_dev');

    Route::get('society_reval_offer_letter_preview','SocietyOfferLetterController@showOfferLetterRevalApplication')->name('society_reval_offer_letter_preview');
    Route::get('society_reval_offer_letter_edit','SocietyOfferLetterController@editRevalOfferLetterApplication')->name('society_reval_offer_letter_edit');
    Route::post('society_reval_offer_letter_update','SocietyOfferLetterController@updateRevalOfferLetterApplication')->name('society_reval_offer_letter_update');

    Route::get('reval_documents_upload','SocietyOfferLetterController@displaySocietyRevalDocuments')->name('reval_documents_upload');
    Route::post('add_uploaded_reval_documents_remark','SocietyOfferLetterController@addSocietyRevalDocumentsRemark')->name('add_uploaded_reval_documents_remark');
    Route::get('reval_documents_uploaded','SocietyOfferLetterController@viewSocietyRevalDocuments')->name('reval_documents_uploaded');
    Route::post('uploaded_reval_documents','SocietyOfferLetterController@uploadSocietyRevalDocuments')->name('uploaded_reval_documents');
    Route::get('delete_uploaded_reval_documents/{id}','SocietyOfferLetterController@deleteSocietyRevalDocuments')->name('delete_uploaded_reval_documents');
    Route::post('add_uploaded_reval_documents_comment','SocietyOfferLetterController@addSocietyRevalDocumentsComment')->name('add_reval_documents_comment');
    Route::get('upload_society_reval_offer_letter_application','SocietyOfferLetterController@showuploadRevalOfferLetterAfterSign')->name('upload_society_reval_offer_letter_application');
    Route::post('upload_society_reval_offer_letter','SocietyOfferLetterController@uploadRevalOfferLetterAfterSign')->name('upload_society_reval_offer_letter');
    Route::get('society_reval_offer_letter_application_download','SocietyOfferLetterController@generate_reval_pdf')->name('society_reval_offer_letter_application_download');


    // Consent For OC

    Route::get('/show_oc_self/{id}', 'SocietyOfferLetterController@show_oc_self')->name('show_oc_self');
    Route::get('/show_oc_dev/{id}', 'SocietyOfferLetterController@show_oc_dev')->name('show_oc_dev');
    Route::post('/save_oc_application_self', 'SocietyOfferLetterController@save_oc_application_self')->name('save_oc_application_self');
    Route::post('/save_oc_application_dev', 'SocietyOfferLetterController@save_oc_application_dev')->name('save_oc_application_dev');

    Route::get('society_oc_preview','SocietyOfferLetterController@showOcApplication')->name('society_oc_preview');
    Route::get('society_oc_edit','SocietyOfferLetterController@editOcApplication')->name('society_oc_edit');
    Route::post('society_oc_update','SocietyOfferLetterController@updateOcApplication')->name('society_oc_update');

    Route::get('oc_documents_upload','SocietyOfferLetterController@displaySocietyOcDocuments')->name('oc_documents_upload');
    Route::post('add_uploaded_oc_documents_remark','SocietyOfferLetterController@addSocietyOcDocumentsRemark')->name('add_uploaded_oc_documents_remark');
    Route::get('oc_documents_uploaded','SocietyOfferLetterController@viewSocietyOcDocuments')->name('oc_documents_uploaded');
    Route::post('uploaded_oc_documents','SocietyOfferLetterController@uploadSocietyOcDocuments')->name('uploaded_oc_documents');
    Route::get('delete_uploaded_oc_documents/{id}','SocietyOfferLetterController@deleteSocietyOcDocuments')->name('delete_uploaded_oc_documents');
    Route::post('add_uploaded_oc_documents_comment','SocietyOfferLetterController@addSocietyOcDocumentsComment')->name('add_oc_documents_comment');
    Route::get('upload_society_oc_application','SocietyOfferLetterController@showuploadOcAfterSign')->name('upload_society_oc_application');
    Route::post('upload_society_oc','SocietyOfferLetterController@uploadOcAfterSign')->name('upload_society_oc');
    Route::get('society_oc_application_download','SocietyOfferLetterController@generate_oc_pdf')->name('society_oc_application_download');





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

Route::post('send_for_revision','ArchitectLayout\LayoutArchitectDetailController@send_for_revision')->name('architect_layout.send_for_revision');

Route::get('check_layout_details_complete_status/{layout_detail_id}','ArchitectLayout\LayoutArchitectController@check_layout_details_complete_status')->name('check_layout_details_complete_status');

Route::get('view_architect_layout_details/{layout_id}','ArchitectLayout\LayoutArchitectController@view_architect_layout_details')->name('architect_layout_details.view');
Route::post('post_architect_layout','ArchitectLayout\LayoutArchitectController@store_layout')->name('architect_layout.store');
Route::get('add_architect_layout_detail/{layout_id}','ArchitectLayout\LayoutArchitectDetailController@add_detail')->name('architect_layout_detail.add');
Route::get('edit_architect_layout_detail/{layout_detail_id}','ArchitectLayout\LayoutArchitectDetailController@edit_detail')->name('architect_layout_detail.edit');
Route::post('post_architect_layout_detail','ArchitectLayout\LayoutArchitectDetailController@create_detail')->name('architect_layout_detail.create');
Route::post('uploadLatestLayoutAjax','ArchitectLayout\LayoutArchitectDetailController@uploadLatestLayoutAjax')->name('uploadLatestLayoutAjax');
Route::get('list_of_offer_letter_issued/{layout_id}','ArchitectLayout\LayoutArchitectDetailController@list_of_offer_letter_issued')->name('list_of_offer_letter_issued');
//Architect Layout Forward Application
Route::get('forward_architect_layout/{layout_id}','ArchitectLayout\LayoutArchitectController@forwardLayout')->name('forward_architect_layout');
Route::post('post_forward_architect_layout','ArchitectLayout\LayoutArchitectController@post_forward_layout')->name('post_forward_architect_layout');

//Architect Layout EM LM EE REE Scrutiny
Route::get('get_scrutiny/{layout_id}','ArchitectLayout\LayoutArchitectController@get_scrutiny')->name('architect_layout_get_scrtiny');
Route::get('architect_layout_add_scrutiny_report/{layout_id}','ArchitectLayout\LayoutArchitectController@add_scrutiny_report')->name('architect_layout_add_scrutiny_report');
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
Route::post('architect_layout_detail_delete_crz_remark','ArchitectLayout\LayoutArchitectDetailController@delete_crz_remark')->name('delete_crz_remark');
Route::post('architect_layout_detail_delete_dp_remark','ArchitectLayout\LayoutArchitectDetailController@delete_dp_remark')->name('delete_dp_remark');
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
        // User Layout
        Route::post('loadDeleteUserLayoutUsingAjax', 'UserLayoutController@loadDeleteUserLayoutUsingAjax')->name('loadDeleteUserLayoutUsingAjax');
        Route::resource('user_layouts','UserLayoutController');
        Route::post('get_layout','UserLayoutController@getLayout')->name('user_layouts.get_layout');
        // Wards
        Route::post('loadDeleteWardUsingAjax', 'WardController@loadDeleteWardUsingAjax')->name('loadDeleteWardUsingAjax');
        Route::resource('ward','WardController');
        // Colony
        Route::post('loadDeleteColonyUsingAjax', 'ColonyController@loadDeleteColonyUsingAjax')->name('loadDeleteColonyUsingAjax');
        Route::resource('colony','ColonyController');
        // laoding boards of layout
        Route::post('loadWardsOfLayoutUsingAjax', 'ColonyController@loadWardsOfLayoutUsingAjax')->name('loadWardsOfLayoutUsingAjax');



    });

    //Society Formation
    Route::get('society_formation','SocietyFormationController@index')->name('society_formation.index');
    Route::get('society_formation_list','SocietyFormationController@list')->name('society_formation.list');
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
    Route::get('get_em_scrutiny_and_remark_by_em/{id}','conveyance\FormationCommonController@get_sf_em_srutiny_and_remark')->name('formation.em_srutiny_and_remark');
    Route::post('post_em_scrutiny_and_remark_by_em','conveyance\FormationCommonController@post_sf_em_srutiny_and_remark')->name('formation.post_em_srutiny_and_remark');
    Route::post('upload_em_scrutiny_document_for_sf','conveyance\FormationCommonController@upload_em_scrutiny_document_for_sf')->name('formation.upload_em_scrutiny_document_for_sf');
    Route::get('get_no_dues_certificate/{id}','conveyance\FormationCommonController@get_no_dues_certificate')->name('formation.get_no_dues_certificate');
    Route::post('post_no_dues_certificate','conveyance\FormationCommonController@post_no_dues_certificate')->name('formation.post_no_dues_certificate');
    Route::get('get_society_formation_documents/{id}','conveyance\FormationCommonController@society_documents')->name('formation.society_documents');
    Route::post('formation.send_no_due_to_society','conveyance\FormationCommonController@send_no_due_to_society')->name('formation.send_no_due_to_society');
    //Society Formation End

    //tripartite
    Route::group(['prefix' => 'tripartite'], function () {
        Route::get('/','Tripartite\TripartiteController@index')->name('tripartite.index');
        Route::get('/view_application/{application_id}','Tripartite\TripartiteController@view_application')->name('tripartite.view_application');
        Route::get('/view_society_documents/{application_id}','Tripartite\TripartiteController@view_society_documents')->name('tripartite.view_society_documents');
        Route::get('/tripartite_agreement/{application_id}','Tripartite\TripartiteController@tripartite_agreement')->name('tripartite.tripartite_agreement');
        Route::post('/saveTripartiteagreement','Tripartite\TripartiteController@saveTripartiteagreement')->name('saveTripartiteagreement');
        Route::post('/upload_signed_tripartite_agreement','Tripartite\TripartiteController@upload_signed_tripartite_agreement')->name('upload_signed_tripartite_agreement');
        Route::get('/tripartite_ree_note/{application_id}','Tripartite\TripartiteController@ree_note')->name('tripartite.ree_note');
        Route::post('/upload_tripartite_ree_note','Tripartite\TripartiteController@upload_ree_note')->name('tripartite.upload_ree_note');
        Route::post('/setTripartiteRemark','Tripartite\TripartiteController@setTripartiteRemark')->name('tripartite.setTripartiteRemark');
        Route::get('tripartite_forward_application/{application_id}','Tripartite\TripartiteController@forward_application')->name('tripartite.forward_application');
        Route::post('tripartite_forward_application','Tripartite\TripartiteController@saveForwardApplication')->name('tripartite.post_forward_application');
    });
    //End tripartite
    //Society Renewal

//    Route::get('sr_download_template', 'SocietyRenewalController@download_excel')->name('sr_download');
//    Route::get('sr_upload_docs', 'SocietyRenewalController@sr_upload_docs')->name('sr_upload_docs');
//    Route::post('upload_sr_docs', 'SocietyRenewalController@upload_sr_docs')->name('upload_sr_docs');
//    Route::get('delete_sr_upload_docs/{id}', 'SocietyRenewalController@delete_sr_upload_docs')->name('delete_sr_upload_docs');
//    Route::post('add_society_documents_comment', 'SocietyRenewalController@add_society_documents_comment')->name('society_doc_comment');
//    Route::get('sr_form_download', 'SocietyRenewalController@generate_pdf')->name('sr_form_download');
//    Route::get('sr_form_upload_show', 'SocietyRenewalController@sr_form_upload_show')->name('sr_form_upload_show');
//    Route::post('sr_form_upload', 'SocietyRenewalController@sr_form_upload')->name('sr_form_upload');
//
//    //sale & lease deed alongwith pay stamp duty letter & resolution & undertaking
////    Route::get('sale_lease_deed/{id}', 'SocietyRenewalController@show_sale_lease')->name('show_sale_lease');
////    Route::get('signed_sale_lease_deed/{id}', 'SocietyRenewalController@show_signed_sale_lease')->name('show_signed_sale_lease');
////    Route::post('save_sale_lease_deed', 'SocietyRenewalController@upload_sale_lease')->name('upload_sale_lease');
////    Route::post('save_signed_sale_lease_deed', 'SocietyRenewalController@upload_signed_sale_lease')->name('upload_signed_sale_lease');
//    Route::resource('/society_renewal','SocietyRenewalController');

    //Society Renewal END

    
});

// RTI Routes

Route::get('rti_form','RtiFormController@showFrontendForm')->name('rti_form');



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
    Route::get('sc_dashboard', 'conveyance\conveyanceCommonController@displayDashboard')->name('conveyance.dashboard');

    Route::get('conveyance_application/{id}', 'conveyance\conveyanceCommonController@ViewApplication')->name('conveyance.view_application');

    Route::get('view_ee_documents/{id}', 'conveyance\conveyanceCommonController@ViewEEDocuments')->name('conveyance.view_ee_documents'); 

    Route::get('forward_application_sc/{id}', 'conveyance\conveyanceCommonController@commonForward')->name('conveyance.forward_application_sc');

    Route::post('save_forward_application_sc', 'conveyance\conveyanceCommonController@saveForwardApplication')->name('conveyance.save_forward_application');

    Route::post('save_agreement_comments', 'conveyance\conveyanceCommonController@SaveAgreementComments')->name('conveyance.save_agreement_comments');

    Route::get('view_documents/{id}', 'conveyance\conveyanceCommonController@ViewSocietyDocuments')->name('conveyance.view_documents');

    Route::get('sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@saleLeaseAgreement')->name('conveyance.sale_lease_agreement');
    
    Route::get('approved_sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@ApprovedSaleLeaseAgreement')->name('conveyance.approved_sale_lease_agreement');
    
    Route::get('stamp_duty_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@StampedDutySaleLeaseAgreement')->name('conveyance.stamp_duty_agreement'); 

    Route::post('save_stamp_duty_agreement', 'conveyance\DYCODepartment\DYCOController@SaveStampDutyAgreement')->name('conveyance.save_stamp_duty_agreement');
    
    Route::get('stamp_signed_duty_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@SignedSaleLeaseAgreement')->name('conveyance.stamp_signed_duty_agreement');
    
    Route::get('register_sale_lease_agreement/{id}', 'conveyance\DYCODepartment\DYCOController@RegisterSaleLeaseAgreement')->name('conveyance.register_sale_lease_agreement'); 

    Route::get('checklist/{id}', 'conveyance\DYCODepartment\DYCOController@showChecklist')->name('conveyance.checklist'); 

    // Route::get('checklist_note/{id}', 'conveyance\conveyanceCommonController@show_checklist')->name('conveyance.checklist_note');


    Route::get('architect_scrutiny_remark/{id}', 'conveyance\conveyanceCommonController@ArchitectScrutinyRemark')->name('conveyance.architect_scrutiny_remark');

    Route::get('la_agreement_riders/{id}', 'conveyance\conveyanceCommonController@la_agreement_riders')->name('conveyance.la_agreement_riders'); 

    Route::get('draft_sign_conveyance_agreement/{id}', 'conveyance\conveyanceCommonController@DraftSignsaleLeaseAgreement')->name('conveyance.draft_sign_conveyance_agreement');

    Route::post('save_draft_sign_conveyance_agreement', 'conveyance\conveyanceCommonController@SaveDraftSignAgreement')->name('conveyance.save_draft_sign_conveyance_agreement');    

    Route::post('upload_la_agreement_riders', 'conveyance\conveyanceCommonController@upload_la_agreement_riders')->name('conveyance.upload_la_agreement_riders');

    Route::get('view_draft_sign_conveyance_agreement/{id}', 'conveyance\conveyanceCommonController@DraftSignsaleLeaseAgreement')->name('conveyance.draft_sign_conveyance_agreement');

    Route::post('save_draft_sign_conveyance_agreement', 'conveyance\conveyanceCommonController@SaveDraftSignAgreement')->name('conveyance.save_draft_sign_conveyance_agreement');

    
    //dyco
    
   Route::get('conveyance_noc/{id}', 'conveyance\DYCODepartment\DYCOController@conveyanceNoc')->name('dyco.conveyance_noc'); 

    Route::get('generate_canveyance_noc/{id}', 'conveyance\DYCODepartment\DYCOController@GenerateConveyanceNOC')->name('dyco.generate_canveyance_noc');

    Route::post('save_draft_NOC', 'conveyance\DYCODepartment\DYCOController@saveDraftNOC')->name('dyco.save_draft_NOC');

    Route::post('save_canveyance_noc', 'conveyance\DYCODepartment\DYCOController@saveUploadedNOC')->name('dyco.save_noc'); 

    Route::post('storeChecklistData', 'conveyance\DYCODepartment\DYCOController@storeChecklistData')->name('dyco.storeChecklistData'); 

    Route::post('upload_note', 'conveyance\DYCODepartment\DYCOController@uploadNote')->name('dyco.uploadDycoNote');    

    Route::post('save_agreement', 'conveyance\DYCODepartment\DYCOController@saveAgreement')->name('dyco.save_agreement');

    Route::post('save_stamp_sign_agreement', 'conveyance\DYCODepartment\DYCOController@SaveStampSignAgreement')->name('dyco.save_stamp_sign_agreement');
    Route::post('forward_application_dyco', 'conveyance\DYCODepartment\DYCOController@saveForwardApplication')->name('dyco.forward_application_data');   

     Route::post('send_to_society', 'conveyance\DYCODepartment\DYCOController@SendToSociety')->name('dyco.send_to_society');  
     Route::post('save_approved_agreement', 'conveyance\DYCODepartment\DYCOController@saveApprovedAgreement')->name('dyco.save_approved_agreement');  

    Route::post('save_renewal_agreement', 'conveyance\DYCODepartment\DYCOController@saveRenewalAgreement')->name('dyco.save_renewal_agreement');

    Route::post('save_approve_renewal_agreement', 'conveyance\DYCODepartment\DYCOController@saveApproveRenewalAgreement')->name('dyco.save_approve_renewal_agreement');

    Route::post('save_renewal_draft_stamp_duty', 'conveyance\DYCODepartment\DYCOController@saveRenewalDraftStampDuty')->name('dyco.save_renewal_draft_stamp_duty');

    Route::get('generate_conveyance_stamp_duty/{id}', 'conveyance\DYCODepartment\DYCOController@GenerateConveyanceStampDuty')->name('dyco.generate_conveyance_stamp_duty');

    Route::post('save_draft_conveyance_stamp_duty', 'conveyance\DYCODepartment\DYCOController@saveDraftConveyanceStampDuty')->name('dyco.save_draft_conveyance_stamp_duty'); 

    Route::post('save_conveyance_stamp_duty', 'conveyance\DYCODepartment\DYCOController@saveConveyanceStampDuty')->name('dyco.save_conveyance_stamp_duty');

    Route::get('generate_renewal_stamp_duty_letter/{id}', 'conveyance\DYCODepartment\DYCOController@GenerateStampDutyLetter')->name('dyco.generate_stamp_duty_letter');

    //EM

    Route::get('scrutiny_remark_em/{id}', 'conveyance\EMDepartment\EMController@ScrutinyRemark')->name('em.scrutiny_remark');
    Route::post('save_conveyance_letter', 'conveyance\EMDepartment\EMController@saveNoDuesCertificate')->name('em.save_conveyance_no_dues_certificate');
    Route::post('save_list_of_allottees', 'conveyance\EMDepartment\EMController@uploadListOfAllottees')->name('em.save_list_of_allottees');
    Route::post('save_covering_letter_em', 'conveyance\EMDepartment\EMController@uploadCoveringLetter')->name('em.save_covering_letter');

    //Architect

    Route::post('save_architect_scrutiny_remark', 'conveyance\conveyanceCommonController@SaveArchitectScrutinyRemark')->name('conveyance.save_architect_scrutiny_remark');

    //EE 

     Route::get('sale_price_calculation/{id}', 'conveyance\EEDepartment\EEController@SalePriceCalculation')->name('ee.sale_price_calculation');

    Route::post('save_calculation_data', 'conveyance\EEDepartment\EEController@SaveCalculationData')->name('ee.save_calculation_data');
    Route::post('save_demarcation_plan', 'conveyance\EEDepartment\EEController@SaveDemarcationPlan')->name('ee.save_demarcation_plan');
    Route::post('save_covering_letter', 'conveyance\EEDepartment\EEController@SaveCoveringLetter')->name('ee.save_covering_letter');

    Route::post('send_forward_application', 'conveyance\EEDepartment\EEController@sendForwardApplication')->name('ee.send_forward_application');

    Route::post('upload_ee_scrutiny_documents', 'conveyance\EEDepartment\EEController@uploadRenewalScrutinyDocument')->name('ee.upload_ee_scrutiny_documents'); 

    Route::post('delete_ee_scrutiny_documents', 'conveyance\EEDepartment\EEController@deleteRenewalScrutinyDocument')->name('ee.delete_ee_scrutiny_documents');

    Route::post('save_scrutiny_remark', 'conveyance\EEDepartment\EEController@SaveScrutinyRemark')->name('ee.save_scrutiny_remark');

// Renewal

    // common in renewal
    Route::resource('renewal', 'conveyance\renewalCommonController');  
    Route::get('renewal_application/{id}', 'conveyance\renewalCommonController@ViewApplication')
    ->name('renewal.view_application');

    Route::get('view_renewal_society_documents/{id}', 'conveyance\renewalCommonController@ViewSocietyDocuments')->name('renewal.view_documents');

    Route::get('prepare_renewal_agreement/{id}', 'conveyance\renewalCommonController@PrepareRenewalAgreement')->name('renewal.prepare_renewal_agreement'); 

    Route::get('approve_renewal_agreement/{id}', 'conveyance\renewalCommonController@ApproveRenewalAgreement')->name('renewal.approve_renewal_agreement');    

     Route::get('registered_renewal_agreement/{id}', 'conveyance\renewalCommonController@registeredRenewalAgreement')->name('renewal.registered_renewal_agreement');

     Route::get('stamp_renewal_agreement/{id}', 'conveyance\renewalCommonController@StampRenewalAgreement')->name('renewal.stamp_renewal_agreement');

      Route::get('stamp_sign_renewal_agreement/{id}', 'conveyance\renewalCommonController@StampSignRenewalAgreement')->name('renewal.stamp_sign_renewal_agreement'); 

    Route::get('renewal_forward_application/{id}', 'conveyance\renewalCommonController@commonForwardApplication')->name('renewal.renewal_forward_application');    

    Route::get('renewal_architect_scrutiny/{id}', 'conveyance\renewalCommonController@RenewalArchitectScrunity')->name('renewal.architect_scrutiny');

    Route::get('renewal_ee_scrutiny/{id}', 'conveyance\renewalCommonController@RenewalEEScrunityRemark')->name('renewal.ee_scrutiny');

    Route::post('upload_architect_documents', 'conveyance\renewalCommonController@uploadArchitectDocuments')->name('renewal.upload_architect_documents');

    Route::post('delete_architect_documents', 'conveyance\renewalCommonController@deleteRenewalArchitectDocument')->name('renewal.delete_architect_documents');

    Route::post('save_architect_scrutiny', 'conveyance\renewalCommonController@SaveArchitectScrutinyRemark')->name('renewal.save_architect_scrutiny'); 

    Route::post('save_forward_application_renewal', 'conveyance\renewalCommonController@saveForwardApplication')->name('renewal.save_forward_application_renewal'); 

    Route::post('save_stamp_renewal_agreement', 'conveyance\renewalCommonController@saveStampRenewalAgreement')->name('renewal.save_stamp_renewal_agreement'); 

    Route::post('save_stamp_sign_renewal_agreement', 'conveyance\renewalCommonController@SaveStampSignRenewalAgreement')->name('renewal.save_stamp_sign_renewal_agreement');   

    Route::post('renewal_save_agreement_comments', 'conveyance\renewalCommonController@SaveAgreementComments')->name('renewal.save_agreement_comments');

    Route::post('renewal_send_to_society', 'conveyance\DYCODepartment\DYCOController@SendRenewalApplicationToSociety')->name('dyco.renewal_send_to_society');    

    // Route::post('upload_renewal_stamp_letter', 'conveyance\DYCODepartment\DYCOController@uploadRenewalStampLetter')->name('dyco.upload_renewal_stamp_letter');

    Route::post('save_renewal_stamp_duty', 'conveyance\DYCODepartment\DYCOController@saveRenewalStampDuty')->name('dyco.save_renewal_stamp_duty');

    Route::get('renewal_scrutiny_remark_em/{id}', 'conveyance\EMDepartment\EMController@RenewalScrutinyRemark')->name('em.renewal_scrutiny_remark');
    Route::post('save_renewal_letter', 'conveyance\EMDepartment\EMController@saveRenewalNoDuesCertificate')->name('em.save_renewal_no_dues_certificate');
    Route::post('save_list_of_bonafide_allottees', 'conveyance\EMDepartment\EMController@uploadRenewalListOfAllottees')->name('em.save_renewal_list_of_allottees');
    Route::post('upload_covering_letter','conveyance\EMDepartment\EMController@uploadRenewalCoveringLetter')->name('em.upload_renewal_covering_letter');

    Route::get('la_agreement_riders_renewal/{id}', 'conveyance\renewalCommonController@la_agreement_riders')->name('renewal.la_agreement_riders');

    Route::post('upload_la_agreement_riders_renewal', 'conveyance\renewalCommonController@upload_la_agreement_riders')->name('renewal.upload_la_agreement_riders');

    Route::get('forward_application_sr/{id}', 'conveyance\renewalCommonController@commonForward')->name('renewal.forward_application_sc');

    Route::post('save_forward_application_sr', 'conveyance\renewalCommonController@saveForwardApplication')->name('renewal.save_forward_application');

    Route::post('save_draft_sign_renewal_agreement', 'conveyance\renewalCommonController@saveDraftSignRenewalAgreement')->name('renewal.save_draft_sign_renewal_agreement');

    // All dashboards
    Route::get('/dashboard','Common\CommonController@dashboard')->name('dashboard');
    // Ree Dashboard
    Route::get('/ree_dashboard','REEDepartment\REEController@dashboard')->name('ree.dashboard');
    // Co Dashboard
    Route::get('/co_dashboard','CODepartment\COController@dashboard')->name('co.dashboard');
    // Architect Layout Dashboard
    Route::get('architect_layout_dashboard','Dashboard\ArchitectLayoutDashboardController@dashboard')->name('architect_layout_dashboard');
    // Land Dashboard
    Route::get('/land_dashboard','VillageDetailController@dashboard')->name('land.dashboard');
    //selection comitte dashboard
    Route::get('appointing_architect_dashboard','Dashboard\AppointingArchitectController@index')->name('appointing_architect_dashboard');

    Route::post('/ddashboard','Common\CommonController@ajaxDashboard')->name('dashboard.ajax');


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
        Route::post('add_enclosure', 'EmploymentOfArchitectController@add_enclosure')->name('appointing_architect.add_enclosure');
        Route::post('upload_enclosure_file', 'EmploymentOfArchitectController@upload_enclosure_file')->name('appointing_architect.upload_enclosure_file');
        Route::get('step3/{id}', 'EmploymentOfArchitectController@step3')->name('appointing_architect.step3');
        Route::post('step3_post/{id}', 'EmploymentOfArchitectController@step3_post')->name('appointing_architect.step3_post');
        Route::post('ajaxDeletepartners', 'EmploymentOfArchitectController@delete_partners')->name('appointing_architect.delete_partners');
        Route::post('ajaxAddawardsPrizes', 'EmploymentOfArchitectController@add_award_prizes')->name('appointing_architect.add_award_prizes');
        Route::post('ajaxDeleteawardsPrizes', 'EmploymentOfArchitectController@delete_award_prizes')->name('appointing_architect.delete_award_prizes');
        Route::post('ajaxUploadAwardCertificate','EmploymentOfArchitectController@upload_award_certificate')->name('appointing_architect.upload_award_certificate');
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

//Noc -- /* Created by: Sayan Pal */

Route::group(['middleware' => ['auth']], function(){

Route::get('/show_form_self_noc/{id}', 'SocietyNocController@show_form_self_noc')->name('show_form_self_noc');
Route::get('/show_form_dev_noc/{id}', 'SocietyNocController@show_form_dev_noc')->name('show_form_dev_noc');
Route::post('/save_noc_application_self', 'SocietyNocController@save_noc_application_self')->name('save_noc_application_self');
Route::get('society_noc_preview','SocietyNocController@showNocApplication')->name('society_noc_preview');
Route::get('society_noc_edit','SocietyNocController@editNocApplication')->name('society_noc_edit');
Route::post('society_noc_update','SocietyNocController@updateNocApplication')->name('society_noc_update');
Route::get('documents_upload_noc','SocietyNocController@displaySocietyDocuments')->name('documents_upload_noc');
Route::post('uploaded_documents_noc','SocietyNocController@uploadSocietyDocuments')->name('uploaded_documents_noc');
Route::get('delete_uploaded_documents_noc/{id}','SocietyNocController@deleteSocietyDocuments')->name('delete_uploaded_documents_noc');
Route::get('upload_noc_application','SocietyNocController@showuploadNoc')->name('upload_noc_application');
Route::post('add_uploaded_documents_comment_noc','SocietyNocController@addSocietyDocumentsComment')->name('add_documents_comment_noc');
Route::get('society_noc_application_download','SocietyNocController@download_noc_application')->name('society_noc_application_download');
Route::post('upload_society_noc','SocietyNocController@uploadNocAfterSign')->name('upload_society_noc');
Route::get('documents_uploaded_noc','SocietyNocController@viewSocietyDocuments')->name('documents_uploaded_noc');
Route::post('resubmit_noc_application','SocietyNocController@resubmitNocApplication')->name('resubmit_noc_application');

//NOC --REE Department Routes

Route::get('ree_noc_applications','REEDepartment\REEController@nocApplicationList')->name('ree_applications.noc');
Route::get('view_application_noc/{id}','REEDepartment\REEController@viewApplicationNoc')->name('ree.view_application_noc');
Route::get('society_noc_documents/{id}','REEDepartment\REEController@societyNocDocuments')->name('ree.society_noc_documents');
Route::get('generate_noc/{id}', 'REEDepartment\REEController@GenerateNoc')->name('ree.generate_noc');
Route::get('create_edit_noc/{id}', 'REEDepartment\REEController@createEditNoc')->name('ree.create_edit_noc');
Route::post('save_draft_noc', 'REEDepartment\REEController@saveDraftNoc')->name('ree.save_draft_noc');
Route::post('upload_draft_noc/{id}', 'REEDepartment\REEController@uploadDraftNoc')->name('ree.upload_draft_noc');
Route::get('/scrutiny-remark-noc/{application_id}', 'REEDepartment\REEController@scrutinyRemarkNocByREE')->name('ree.scrutiny-remark-noc');
Route::post('/noc-scrutiny-verfication', 'REEDepartment\REEController@nocScrutinyVerification')->name('ree.scrutiny_verification');
Route::post('upload_ree_note_noc','REEDepartment\REEController@uploadOfficeNoteNocRee')->name('ree.upload_office-note-noc');
Route::get('ree_forward_application_noc/{id}','REEDepartment\REEController@forwardApplicationNoc')->name('ree.forward_application_noc');
Route::post('ree_forward_noc_application_data','REEDepartment\REEController@sendForwardNocApplication')->name('ree.forward_noc_application_data');
Route::get('approved_noc_letter/{id}','REEDepartment\REEController@approvedNOCletter')->name('ree.approved_noc_letter');
Route::post('send_noc_issued_society','REEDepartment\REEController@sendissuedNOCToSociety')->name('ree.send_noc_issued_society');

//NOC --CO Department routes

Route::get('co_noc_applications','CODepartment\COController@nocApplicationList')->name('co_applications.noc');
Route::get('view_noc_application_co/{id}','CODepartment\COController@viewNocApplication')->name('co.view_noc_application');
Route::get('society_noc_documents_co/{id}','CODepartment\COController@societyNocDocuments')->name('co.society_noc_documents');
Route::get('ree_scrutiny_remark_co/{id}','CODepartment\COController@nocScrutinyRemarks')->name('co.noc_scrutiny_remarks');
Route::get('approve_noc_co/{id}','CODepartment\COController@issueNoc')->name('co.approve_noc');
Route::post('issue_noc_letter_to_ree','CODepartment\COController@approveNoctoRee')->name('co.issue_noc_letter_to_ree');
Route::get('co_forward_noc_application/{id}','CODepartment\COController@forwardNOCApplication')->name('co.forward_noc_application');
Route::post('save_forward_noc_Application','CODepartment\COController@sendForwardNocApplication')->name('co.forward_noc_application_data');

});

//NOC FOR CC -- Sayan Pal

Route::group(['middleware' => ['auth']], function(){

Route::get('/show_form_self_noc_cc/{id}', 'SocietyNocforCCController@show_form_self_noc_cc')->name('show_form_self_noc_cc');
Route::post('/save_noc_cc_application_self', 'SocietyNocforCCController@save_noc_cc_application_self')->name('save_noc_cc_application_self');
Route::get('society_noc_cc_preview','SocietyNocforCCController@showNocApplication')->name('society_noc_cc_preview');
Route::get('society_noc_cc_edit','SocietyNocforCCController@editNocApplication')->name('society_noc_cc_edit');
Route::post('society_noc_cc_update','SocietyNocforCCController@updateNocApplication')->name('society_noc_cc_update');
Route::get('documents_upload_noc_cc','SocietyNocforCCController@displaySocietyDocuments')->name('documents_upload_noc_cc');
Route::post('uploaded_documents_noc_cc','SocietyNocforCCController@uploadSocietyDocuments')->name('uploaded_documents_noc_cc');
Route::get('delete_uploaded_documents_noc_cc/{id}','SocietyNocforCCController@deleteSocietyDocuments')->name('delete_uploaded_documents_noc_cc');
Route::post('add_uploaded_documents_comment_noc_cc','SocietyNocforCCController@addSocietyDocumentsComment')->name('add_documents_comment_noc_cc');
Route::get('upload_noc_application_cc','SocietyNocforCCController@showuploadNoc')->name('upload_noc_application_cc');
Route::get('society_noc_cc_application_download','SocietyNocforCCController@download_noc_application')->name('society_noc_cc_application_download');
Route::post('upload_society_noc_cc','SocietyNocforCCController@uploadNocAfterSign')->name('upload_society_noc_cc');
Route::get('documents_uploaded_noc_cc','SocietyNocforCCController@viewSocietyDocuments')->name('documents_uploaded_noc_cc');
Route::post('resubmit_noc_application_cc','SocietyNocforCCController@resubmitNocApplication')->name('resubmit_noc_application_cc');

// NOC for CC -- REE Department routes

Route::get('ree_noc_cc_applications','REEDepartment\REEController@nocforCCApplicationList')->name('ree_applications.noc_cc');
Route::get('view_application_noc_cc/{id}','REEDepartment\REEController@viewApplicationNocforCC')->name('ree.view_application_noc_cc');
Route::get('society_noc_cc_documents/{id}','REEDepartment\REEController@societyNocforCCDocuments')->name('ree.society_noc_cc_documents');
Route::get('generate_noc_cc/{id}', 'REEDepartment\REEController@GenerateNocforCC')->name('ree.generate_noc_cc');
Route::get('create_edit_noc_cc/{id}', 'REEDepartment\REEController@createEditNocforCC')->name('ree.create_edit_noc_cc');
Route::post('save_draft_noc_cc', 'REEDepartment\REEController@saveDraftNocforCC')->name('ree.save_draft_noc_cc');
Route::post('upload_draft_noc_cc/{id}', 'REEDepartment\REEController@uploadDraftNocforCC')->name('ree.upload_draft_noc_cc');
Route::get('/scrutiny-remark-noc-cc/{application_id}', 'REEDepartment\REEController@scrutinyRemarkNocforCCByREE')->name('ree.scrutiny-remark-noc-cc');
Route::post('upload_ree_note_noc_cc','REEDepartment\REEController@uploadOfficeNoteNocforCCRee')->name('ree.upload_office-note-noc-cc');
Route::get('ree_forward_application_noc_cc/{id}','REEDepartment\REEController@forwardApplicationNocCC')->name('ree.forward_application_noc_cc');
Route::post('ree_forward_noc_cc_application_data','REEDepartment\REEController@sendForwardNocforCCApplication')->name('ree.forward_noc_cc_application_data');
Route::get('approved_noc_cc_letter/{id}','REEDepartment\REEController@approvedNOCforCCletter')->name('ree.approved_noc_cc_letter');
Route::post('send_noc_cc_issued_society','REEDepartment\REEController@sendissuedNOCforCCToSociety')->name('ree.send_noc_cc_issued_society');

// NOC for CC -- CO Department Routes

Route::get('co_noc_cc_applications','CODepartment\COController@nocforCCApplicationList')->name('co_applications.noc_cc');
Route::get('view_noc_cc_application_co/{id}','CODepartment\COController@viewNocforCCApplication')->name('co.view_noc_cc_application');
Route::get('society_noc_cc_documents_co/{id}','CODepartment\COController@societyNocforCCDocuments')->name('co.society_noc_cc_documents');
Route::get('ree_scrutiny_remark_co_noc_cc/{id}','CODepartment\COController@nocforCCScrutinyRemarks')->name('co.noc_cc_scrutiny_remarks');
Route::get('approve_noc_cc_co/{id}','CODepartment\COController@issueNocforCC')->name('co.approve_noc_cc');
Route::post('issue_noc_cc_letter_to_ree','CODepartment\COController@approveNocforCCtoRee')->name('co.issue_noc_cc_letter_to_ree');
Route::get('co_forward_noc_cc_application/{id}','CODepartment\COController@forwardNOCforCCApplication')->name('co.forward_noc_cc_application');
Route::post('save_forward_noc_cc_Application','CODepartment\COController@sendForwardNocforCCApplication')->name('co.forward_noc_cc_application_data');

});

// Consent for OC -- EE routes

Route::get('consentoc_ee','EEDepartment\EEController@consent_for_oc')->name('ee.consent_for_oc');
Route::get('view_oc_application/{id}','EEDepartment\EEController@viewOCApplication')->name('ee.view_oc_application');
Route::get('society_documents_oc/{id}', 'EEDepartment\EEController@societyDocumentsOC')->name('ee.society_documents_oc');
Route::get('/scrutiny-remark-oc/{id}', 'EEDepartment\EEController@scrutinyRemarkOcByEE')->name('ee.scrutiny-remark-oc');
Route::post('/scrutiny-verification-oc', 'EEDepartment\EEController@oCScrutinyVerification')->name('ee.scrutiny_verification_oc');
Route::post('upload_ee_note_oc','EEDepartment\EEController@uploadOfficeNoteOcEE')->name('ee.upload_office-note-oc');
Route::get('ee-forward-application-oc/{id}','EEDepartment\EEController@forwardApplicationOcEE')->name('ee-forward-application-oc');
Route::post('ee_forward_oc_application_data','EEDepartment\EEController@sendForwardOcApplication')->name('ee.forward_oc_application_data');

// EM Routes consent for OC

Route::get('consentoc_em','EMDepartment\EMController@consent_for_oc')->name('em.consent_for_oc');
Route::get('view_oc_application_em/{id}','EMDepartment\EMController@viewOCApplication')->name('em.view_oc_application');
Route::get('society_documents_oc_em/{id}', 'EMDepartment\EMController@societyDocumentsOC')->name('em.society_documents_oc');
Route::get('no_dues_certificate_em_oc/{id}', 'EMDepartment\EMController@generateNoDueCertificateOc')->name('em.no_dues_certifitce');
Route::get('create_edit_noduecert/{id}', 'EMDepartment\EMController@createEditNoDueCert')->name('em.create_edit_ndc');
Route::post('save_no_dues_cert_em', 'EMDepartment\EMController@saveNoDuesCertOc')->name('em.save_no_dues_cert_oc');
Route::post('upload_em_note_oc','EMDepartment\EMController@uploadOfficeNoteOcEM')->name('em.upload_office-note-oc');
Route::get('em-forward-application-oc/{id}','EMDepartment\EMController@forwardApplicationOcEM')->name('em-forward-application-oc');
Route::post('em_forward_oc_application_data','EMDepartment\EMController@sendForwardOcApplication')->name('em.forward_oc_application_data');

// Consent for OC -- REE routes

Route::get('ree_oc_applications','REEDepartment\REEController@consentforOCApplicationList')->name('ree_applications.consent_oc');
Route::get('view_application_consent_oc/{id}','REEDepartment\REEController@viewApplicationConsentOc')->name('ree.view_application_consent_oc');
Route::get('society_oc_documents/{id}','REEDepartment\REEController@societyOcDocuments')->name('ree.society_oc_documents');
Route::get('em_scrutiny_oc_ree/{id}','REEDepartment\REEController@viewEMScrutinyOc')->name('ree.em_scrutiny_oc_ree');
Route::get('ee_scrutiny_oc_ree/{id}','REEDepartment\REEController@viewEEScrutinyOc')->name('ree.ee_scrutiny_oc_ree');
Route::get('generate_oc_certificate/{id}','REEDepartment\REEController@generateOccertificate')->name('ree.generate_oc_certificate');
Route::get('create_edit_oc/{id}', 'REEDepartment\REEController@createEditConsentOc')->name('ree.create_edit_oc');
Route::post('save_draft_consent_oc', 'REEDepartment\REEController@saveDraftConsentOc')->name('ree.save_draft_consent_oc');
Route::post('upload_draft_consent_oc/{id}', 'REEDepartment\REEController@uploadDraftConsentforOc')->name('ree.upload_draft_consent_oc');
Route::get('/ree-note-consentoc/{application_id}', 'REEDepartment\REEController@uploadNoteConsentOC')->name('ree.ree-note-consentoc');
Route::post('upload_ree_note_consent_oc','REEDepartment\REEController@uploadOfficeNoteConsentOCRee')->name('ree.upload_ree_note_consent_oc');
Route::get('ree-forward-application-oc/{id}','REEDepartment\REEController@forwardApplicationConsentOc')->name('ree-forward-application-oc');
Route::post('ree_forward_oc_application_data','REEDepartment\REEController@sendForwardConsentOcApplication')->name('ree.ree_forward_oc_application_data');
Route::get('approved_consent_oc_letter/{id}','REEDepartment\REEController@approvedConsentOcletter')->name('ree.approved_consent_oc_letter');
Route::post('send_oc_issued_society','REEDepartment\REEController@sendissuedOcToSociety')->name('ree.send_oc_issued_society');

// Consent for OC -- CO routes

Route::get('co_consent_oc_applications','CODepartment\COController@consentforOcApplicationList')->name('co_applications.consent_oc');
Route::get('view_oc_application_co/{id}','CODepartment\COController@viewApplicationConsentOc')->name('co.view_oc_application');
Route::get('society_oc_documents_co/{id}','CODepartment\COController@societyconsentOcDocuments')->name('co.society_oc_documents');
Route::get('em_scrutiny_oc_co/{id}','CODepartment\COController@viewEMScrutinyOc')->name('co.em_scrutiny_oc_co');
Route::get('ee_scrutiny_oc_co/{id}','CODepartment\COController@viewEEScrutinyOc')->name('co.ee_scrutiny_oc_co');
Route::get('ree_note_oc_co/{id}','CODepartment\COController@consentforOcREEnote')->name('co.ree_note_oc_co');
Route::get('approve_consent_oc/{id}','CODepartment\COController@approveConsentforOc')->name('co.approve_consent_oc');
Route::post('issue_oc_letter_to_ree','CODepartment\COController@approveconsentOctoRee')->name('co.issue_oc_letter_to_ree');
Route::get('co-forward-application-oc/{id}','CODepartment\COController@forwardOcApplication')->name('co-forward-application-oc');
Route::post('save_forward_oc_Application','CODepartment\COController@sendForwardOcApplication')->name('co.forward_oc_application_data');




//import the societies.

Route::get('import',function() {
    return view('admin.import');
});

Route::post('importSociety','ImportController@import');