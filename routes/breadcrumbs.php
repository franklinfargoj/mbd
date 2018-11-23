<?php

// Rti Application
Breadcrumbs::for('rti_applicants', function ($trail) {
    $trail->push('rti_applicants', route('rti_applicants'));
});

Breadcrumbs::for('view_applicant', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('view_applicant/', route('view_applicant',$id));
});

Breadcrumbs::for('schedule_meeting', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('schedule_meeting/', route('schedule_meeting',$id));
});

Breadcrumbs::for('update_status', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('update_status/', route('update_status',$id));
});

Breadcrumbs::for('rti_send_info', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('rti_send_info/', route('rti_send_info',$id));
});

Breadcrumbs::for('rti_forwarded_application', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('rti_forwarded_application/', route('rti_forwarded_application',$id));
});

//Resolution
Breadcrumbs::for('resolution', function ($trail) {
    $trail->push('resolution', route('resolution.index'));
});

Breadcrumbs::for('resolution_create', function ($trail) {
	$trail->parent('resolution');
    $trail->push('resolution_create', route('resolution.create'));
});
 
Breadcrumbs::for('resolution_edit', function ($trail,$id) {
	$trail->parent('resolution');
    $trail->push('resolution_edit/', route('resolution.edit',$id));
});

Breadcrumbs::for('resolution_view', function ($trail,$id) {
    $trail->parent('resolution');
    $trail->push('resolution_view/', route('resolution.view',$id));
});

//Land
Breadcrumbs::for('village_detail', function ($trail) {
	$trail->push('Land Detail', route('village_detail.index'));
});

Breadcrumbs::for('village_create', function ($trail) {
	$trail->parent('village_detail');
	$trail->push('Add Land', route('village_detail.create'));
});

Breadcrumbs::for('village_view', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('View Land', route('village_detail.show',$id));
});

Breadcrumbs::for('village_edit', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('Edit Land', route('village_detail.edit',$id));
});

Breadcrumbs::for('society_detail', function ($trail) {
	$trail->push('Society Detail', route('society_detail.index'));
});

Breadcrumbs::for('society_details', function ($trail,$id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
});

Breadcrumbs::for('arrears_charges', function ($trail,$id,$building_id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
    $trail->push('Arrear Charges Rate', route('arrears_charges',['society_id'=>$id,'building_id'=>$building_id]));
});

Breadcrumbs::for('service_charges', function ($trail,$id,$building_id) {
    $trail->parent('society_detail');
    $trail->push('Society List', route('society.billing_level'));
    $trail->push('Society Details', route('society.society_details',['id'=>$id]));
    $trail->push('Service Charges Rate', route('service_charges',['society_id'=>$id,'building_id'=>$building_id]));
});

Breadcrumbs::for('society_create', function ($trail) {
	$trail->parent('society_detail');
	$trail->push('Add Society', route('society_detail.create'));
});

Breadcrumbs::for('society_detail_edit', function ($trail,$id) {
	$trail->parent('society_detail',$id);
	$trail->push('Edit Society', route('society_detail.edit',$id));
});

Breadcrumbs::for('society_detail_view', function ($trail,$id) {
	$trail->parent('society_detail',$id);
	$trail->push('View Society', route('society_detail.show',$id));
});

Breadcrumbs::for('lease_detail', function ($trail,$id) {
	$trail->push('Lease Detail', route('lease_detail.index',['id'=>$id]));
});

Breadcrumbs::for('lease_create', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('Add Lease', route('lease_detail.create',['id'=>$id]));
});

Breadcrumbs::for('lease_renew', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('Renew Lease', route('renew-lease.renew',['id'=>$id]));
});

Breadcrumbs::for('lease_edit', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$society_id);
    $trail->push('Edit Lease', route('edit-lease.edit',['id'=>$id, 'society_id'=>$society_id]));
});

Breadcrumbs::for('lease_view', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$society_id);
    $trail->push('View Lease', route('view-lease.view',['id'=>$id, 'society_id'=>$society_id]));
});

// Hearing
Breadcrumbs::for('Hearing', function ($trail) {
    $trail->push('Hearing', route('hearing.index'));
});

Breadcrumbs::for('Add Hearing', function ($trail) {
    $trail->parent('Hearing');
    $trail->push('Add Hearing', route('hearing.create'));
});

Breadcrumbs::for('Edit Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Edit Hearing', route('hearing.edit', $id));
});

Breadcrumbs::for('View Hearing', function ($trail, $hearing_id) {
    $trail->parent('Hearing');
    $trail->push('View Hearing', route('hearing.show', $hearing_id));
});

// Schedule Hearing

Breadcrumbs::for('Schedule Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Schedule Hearing', route('schedule_hearing.add', $id));
});

// Prepone/Postpone Hearing

Breadcrumbs::for('Prepone/Postpone Hearing', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Prepone/Postpone Hearing', route('fix_schedule.add', $id));
});

// Hearing Case Judgement

Breadcrumbs::for('Upload Case Judgement', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Upload Case Judgement', route('upload_case_judgement.add', $id));
});

// Forward Hearing

Breadcrumbs::for('Forward Case', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Forward Case', route('forward_case.create', $id));
});

/*Breadcrumbs::for('Forward Case', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Forward Case', route('forward_case.edit', $id));
});*/

// Send Notice in Hearing

Breadcrumbs::for('Send Notice To Appellant', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Send Notice To Appellant', route('send_notice_to_appellant.create', $id));
});

Breadcrumbs::for('society_dashboard', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
});

Breadcrumbs::for('documents_uploaded', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('View Uploaded documents', route('documents_uploaded'));
});

Breadcrumbs::for('documents_upload', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents', route('documents_upload'));
});

Breadcrumbs::for('society_application', function ($trail) {
    $trail->push('Listing', route('society_offer_letter_dashboard'));
    $trail->push('Applications for Redevelopment
', route('society_detail.application'));
});

Breadcrumbs::for('society_offer_application_create', function ($trail, $id) {
    $trail->parent('society_dashboard');
    $trail->push('Application form for Redevelopment', route('show_form_dev', $id));
});

Breadcrumbs::for('society_offer_letter_edit', function ($trail) {
    $trail->parent('society_dashboard');
    $trail->push('Redevelopment Application Form', route('society_offer_letter_edit'));
});

//cap Breadcrumbs

Breadcrumbs::for('cap', function ($trail) {
    $trail->push('Home', route('cap.index'));
});

Breadcrumbs::for('cap_reval', function ($trail) {
    $trail->push('Home', route('cap_applications.reval'));
});
Breadcrumbs::for('society_reval_documents_cap', function ($trail,$id) {
    $trail->parent('cap_reval');
    $trail->push('society reval documents cap', route('cap.society_reval_documents',$id));
});
Breadcrumbs::for('society_EE_documents_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('society EE documents', route('cap.society_EE_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('EE scrutiny', route('cap.EE_scrutiny_remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('DYCE scrutiny', route('cap.dyce_Scrutiny_Remark',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('cap');
//     $trail->push('REE_calculation', route('cap.dyce_Scrutiny_Remark',$id));
// });
Breadcrumbs::for('calculation_sheet_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('calculation sheet', route('cap.show_calculation_sheet',$id));
});

Breadcrumbs::for('Forward_Application_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('forward application', route('cap.forward_application',$id));
});

Breadcrumbs::for('Forward_Reval_Application_cap', function ($trail,$id) {
    $trail->parent('cap_reval');
    $trail->push('forward Reval application', route('cap.forward_reval_application',$id));
});

Breadcrumbs::for('cap_note_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('cap note', route('cap.cap_notes',$id));
});

//vp Breadcrumbs

Breadcrumbs::for('vp', function ($trail) {
    $trail->push('Home', route('vp.index'));
});

Breadcrumbs::for('vp_reval', function ($trail) {
    $trail->push('Home', route('vp_applications.reval'));
});

Breadcrumbs::for('society_reval_documents_vp', function ($trail,$id) {
    $trail->parent('vp_reval');
    $trail->push('society reval documents vp', route('vp.society_reval_documents',$id));
});

Breadcrumbs::for('society_EE_documents_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('society_EE_documents', route('vp.society_EE_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('EE_scrutiny', route('vp.EE_scrutiny_remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('DYCE_scrutiny', route('vp.dyce_Scrutiny_Remark',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('vp');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });
Breadcrumbs::for('calculation_sheet_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('calculation_sheet', route('vp.show_calculation_sheet',$id));
});

Breadcrumbs::for('Forward_Application_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('Forward_Application', route('vp.forward_application',$id));
});
Breadcrumbs::for('Forward_Reval_Application_vp', function ($trail,$id) {
    $trail->parent('vp_reval');
    $trail->push('Forward_Reval_Application', route('vp.forward_reval_application',$id));
});

Breadcrumbs::for('cap_note_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('cap_note', route('vp.cap_notes',$id));
});

//co Breadcrumbs

Breadcrumbs::for('co', function ($trail) {
    $trail->push('Home', route('co.index'));
});

Breadcrumbs::for('co_reval', function ($trail) {
    $trail->push('Home', route('co_applications.reval'));
});

Breadcrumbs::for('society_EE_documents_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('society_EE_documents', route('co.society_EE_documents',$id));
});

Breadcrumbs::for('society_reval_documents_co', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('society reval documents', route('co.society_reval_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('EE_scrutiny', route('co.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('DYCE_scrutiny', route('co.scrutiny_remark',$id));
});

Breadcrumbs::for('Approve_offer_letter', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('Approve_offer_letter', route('co.approve_offer_letter',$id));
});
Breadcrumbs::for('Approve_reval_offer_letter', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('Approve_reval_offer_letter', route('co.approve_reval_offer_letter',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('co');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });
Breadcrumbs::for('calculation_sheet_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('calculation_sheet', route('co.show_calculation_sheet',$id));
});


Breadcrumbs::for('Forward_Application_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('Forward_Application', route('co.forward_application',$id));
});

Breadcrumbs::for('Forward_Reval_Application_co', function ($trail,$id) {
    $trail->parent('co_reval');
    $trail->push('Forward_Application', route('co.forward_reval_application',$id));
});

Breadcrumbs::for('download_cap_note', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('cap_note', route('co.download_cap_note',$id));
});

//REE Breadcrumbs

Breadcrumbs::for('ree', function ($trail) {
    $trail->push('Home', route('ree_applications.index'));
});

Breadcrumbs::for('ree_reval', function ($trail) {
    $trail->push('Home', route('ree_applications.reval'));
});

Breadcrumbs::for('society_EE_documents_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('society EE documents', route('ree.society_EE_documents',$id));
});

Breadcrumbs::for('society_reval_documents_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('society reval documents', route('ree.society_reval_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('EE scrutiny', route('ree.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('DYCE scrutiny', route('ree.dyce_scrutiny_remark',$id));
});

Breadcrumbs::for('calculation_sheet', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('calculation sheet', route('ol_calculation_sheet.index',$id));
});

Breadcrumbs::for('reval_calculation_sheet', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('reval calculation sheet', route('ol_reval_calculation_sheet.show',$id));
});

Breadcrumbs::for('approved_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('approved offer letter', route('ree.approved_offer_letter',$id));
});

Breadcrumbs::for('approved_reval_offer_letter', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('approved reval offer letter', route('ree.approved_reval_offer_letter',$id));
});

Breadcrumbs::for('generate_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('generate offer letter', route('ree.generate_offer_letter',$id));
});

 Breadcrumbs::for('REE_calculation', function ($trail,$id) {
     $trail->parent('ree');
     $trail->push('REE calculation', route('ree.show_calculation_sheet',$id));
 });

Breadcrumbs::for('Forward_Application_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('Forward Application', route('ree.forward_application',$id));
});

Breadcrumbs::for('cap_note_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('cap note', route('ree.download_cap_note',$id));
});

Breadcrumbs::for('reval_cap_note_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('reval cap note', route('ree.download_reval_cap_note',$id));
});

Breadcrumbs::for('ee', function ($trail) {
	$trail->push('Home', route('ee.index'));
});

//offer letter
Breadcrumbs::for('view_application_ee', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('view application', route('ee.view_application',$id));
});

Breadcrumbs::for('view_application_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('view-application', route('vp.view_application',$id));
});

Breadcrumbs::for('view_application_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('view-application', route('ree.view_application',$id));
});

Breadcrumbs::for('view_reval_application_ree', function ($trail,$id) {
    $trail->parent('ree_reval');
    $trail->push('view-reval-application', route('ree.view_reval_application',$id));
});

Breadcrumbs::for('view_application_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('view-application', route('co.view_application',$id));
});

Breadcrumbs::for('view_application_dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('view application', route('dyce.view_application',$id));
});

Breadcrumbs::for('view_application', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('view application', route('cap.view_application',$id));
});


//ee

Breadcrumbs::for('document-submitted', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('society documents', route('document-submitted',$id));
});

Breadcrumbs::for('scrutiny-remark', function ($trail,$id,$societyId) {
    $trail->parent('ee');

$trail->push('scrutiny remark', route('scrutiny-remark',['id'=>$id,'society_id'=>$societyId]));

});

Breadcrumbs::for('Forward_Application_ee', function ($trail,$id) {
    $trail->parent('ee');
    $trail->push('forward application', route('get-forward-application',$id));
});

//Dyce


Breadcrumbs::for('dyce', function ($trail) {
	$trail->push('Home', route('dyce.index'));
});

Breadcrumbs::for('society_EE_documents', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('society EE documents', route('dyce.society_EE_documents',$id));
});

Breadcrumbs::for('EE_Scrutiny_Remark-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('EE Scrutiny Remark', route('dyce.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('scrutiny_remark-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('Scrutiny Remark', route('dyce.scrutiny_remark',$id));
});

Breadcrumbs::for('forward_application-dyce', function ($trail,$id) {
    $trail->parent('dyce');
    $trail->push('forward application', route('dyce.forward_application',$id));
});

//Role
Breadcrumbs::for('role', function ($trail) {
    $trail->push('Home', route('roles.index'));
});

Breadcrumbs::for('add_role', function ($trail) {
    $trail->parent('role');
    $trail->push('Create Role', route('roles.create'));
});

Breadcrumbs::for('role_detail', function ($trail) {
    $trail->push('Role Detail', route('roles.index'));
});

Breadcrumbs::for('edit_role', function ($trail,$id) {
    $trail->parent('role_detail');
    $trail->push('Edit Role', route('roles.edit',$id));
});

Breadcrumbs::for('role_view', function ($trail,$id) {
    $trail->parent('role');
    $trail->push('View Role', route('roles.show',$id));
});

//Application Status
Breadcrumbs::for('application_status', function ($trail) {
    $trail->push('Home', route('application_status.index'));
});

Breadcrumbs::for('add_application_status', function ($trail) {
    $trail->parent('application_status');
    $trail->push('Create Application Status', route('application_status.create'));
});

Breadcrumbs::for('application_status_detail', function ($trail) {
    $trail->push('Application Status Detail', route('application_status.index'));
});

Breadcrumbs::for('edit_application_status', function ($trail,$id) {
    $trail->parent('application_status_detail');
    $trail->push('Edit Application Status', route('application_status.edit',$id));
});

Breadcrumbs::for('application_status_view', function ($trail,$id) {
    $trail->parent('application_status');
    $trail->push('View Application Status', route('application_status.show',$id));
});

// Hearing Status
Breadcrumbs::for('hearing_status', function ($trail) {
    $trail->push('Home', route('hearing_status.index'));
});

Breadcrumbs::for('add_hearing_status', function ($trail) {
    $trail->parent('hearing_status');
    $trail->push('Create Hearing Status', route('hearing_status.create'));
});

Breadcrumbs::for('hearing_status_detail', function ($trail) {
    $trail->push('Hearing Status Detail', route('hearing_status.index'));
});

Breadcrumbs::for('edit_hearing_status', function ($trail,$id) {
    $trail->parent('hearing_status_detail');
    $trail->push('Edit Hearing Status', route('hearing_status.edit',$id));
});

Breadcrumbs::for('hearing_status_view', function ($trail,$id) {
    $trail->parent('hearing_status');
    $trail->push('View Hearing Status', route('hearing_status.show',$id));
});

// RTI Status
Breadcrumbs::for('rti_status', function ($trail) {
    $trail->push('Home', route('rti_status.index'));
});

Breadcrumbs::for('add_rti_status', function ($trail) {
    $trail->parent('rti_status');
    $trail->push('Create RTI Status', route('rti_status.create'));
});

Breadcrumbs::for('rti_status_detail', function ($trail) {
    $trail->push('RTI Status Detail', route('rti_status.index'));
});

Breadcrumbs::for('edit_rti_status', function ($trail,$id) {
    $trail->parent('rti_status_detail');
    $trail->push('Edit RTI Status', route('rti_status.edit',$id));
});

Breadcrumbs::for('rti_status_view', function ($trail,$id) {
    $trail->parent('rti_status');
    $trail->push('View RTI Status', route('rti_status.show',$id));
});

// Layouts
Breadcrumbs::for('layout', function ($trail) {
    $trail->push('Home', route('layouts.index'));
});

Breadcrumbs::for('add_layout', function ($trail) {
    $trail->parent('layout');
    $trail->push('Create Layout', route('layouts.create'));
});

Breadcrumbs::for('layout_detail', function ($trail) {
    $trail->push('Layout Detail', route('layouts.index'));
});

Breadcrumbs::for('edit_layout', function ($trail,$id) {
    $trail->parent('layout_detail');
    $trail->push('Edit Layout', route('layouts.edit',$id));
});

Breadcrumbs::for('layout_view', function ($trail,$id) {
    $trail->parent('layout');
    $trail->push('View Layout', route('layouts.show',$id));
});

// Users
Breadcrumbs::for('user', function ($trail) {
    $trail->push('Home', route('users.index'));
});

Breadcrumbs::for('add_user', function ($trail) {
    $trail->parent('user');
    $trail->push('Create User', route('users.create'));
});

Breadcrumbs::for('user_detail', function ($trail) {
    $trail->push('User Detail', route('users.index'));
});

Breadcrumbs::for('edit_user', function ($trail,$id) {
    $trail->parent('user_detail');
    $trail->push('Edit User', route('users.edit',$id));
});

Breadcrumbs::for('user_view', function ($trail,$id) {
    $trail->parent('user');
    $trail->push('View User', route('users.show',$id));
});

// User Layouts
Breadcrumbs::for('user_layout', function ($trail) {
    $trail->push('Home', route('user_layouts.index'));
});

Breadcrumbs::for('add_user_layout', function ($trail) {
    $trail->parent('user_layout');
    $trail->push('Create User Layout', route('user_layouts.create'));
});

Breadcrumbs::for('user_layout_detail', function ($trail) {
    $trail->push('User Layout Detail', route('user_layouts.index'));
});

Breadcrumbs::for('edit_user_layout', function ($trail,$id) {
    $trail->parent('user_layout_detail');
    $trail->push('Edit User Layout', route('user_layouts.edit',$id));
});

Breadcrumbs::for('user_layout_view', function ($trail,$id) {
    $trail->parent('user_layout');
    $trail->push('View User Layout', route('user_layouts.show',$id));
});




Breadcrumbs::for('em', function ($trail) {
    $trail->push('Home', route('em.index'));
});

Breadcrumbs::for('society_list',function($trail){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
});

Breadcrumbs::for('building_list',function($trail,$id){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
    $trail->push('List of Buildings',route('get_buildings',['id' => $id]));
});

Breadcrumbs::for('tenant_list',function($trail,$id,$building_id){
    $trail->parent('em');
    $trail->push('Society List',route('get_societies'));
    $trail->push('List of Buildings',route('get_buildings',['id' => $id]));
    $trail->push('Tenant List',route('get_tenants',['id' => $building_id]));
});

Breadcrumbs::for('rc', function ($trail) {
    $trail->push('Home', route('rc.index'));
});

Breadcrumbs::for('em_clerk', function ($trail) {
    $trail->push('Home', route('em_clerk.index'));
});


//architect application

Breadcrumbs::for('architect_application', function ($trail) {
    $trail->push('architect_application', route('architect_application'));
});
Breadcrumbs::for('evaluate_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Evaluate Application', route('evaluate_architect_application',['id'=>$id]));
});

Breadcrumbs::for('view_architect_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('View', route('view_architect_application',['id'=>$id]));
});

Breadcrumbs::for('forward_architect_application', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Forward Application', route('architect.forward_application',['id'=>$id]));
});

Breadcrumbs::for('architect_generate_certificate', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Generate Certificate', route('generate_certificate',['id'=>$id]));
});

Breadcrumbs::for('architect_finalCertificateGenerate', function ($trail,$id) {
    $trail->parent('architect_application');
    $trail->push('Download Certificate', route('finalCertificateGenerate',['id'=>$id]));
});

//architect layouts

Breadcrumbs::for('architect_layout', function ($trail) {
    $trail->push('architect_layout', route('architect_layout.index'));
});

Breadcrumbs::for('architect_layout_details', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('View Details', route('architect_layout_details.view',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_scrutiny_remarks', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Scrutiny & Remark', route('architect_layout_get_scrtiny',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_add_details', function ($trail,$id) {
    $trail->parent('architect_layout_details',$id);
    $trail->push('Add Details', route('architect_layout_detail.edit',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_forward', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Forward Application', route('forward_architect_layout',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_Layout_scrutiny_of_ee_em_lm_ree', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Scrutiny of EE EM LM REE', route('architect_Layout_scrutiny_of_ee_em_lm_ree',['layout_id'=>$id]));
});

Breadcrumbs::for('architect_layout_prepare_layout_excel', function ($trail,$id) {
    $trail->parent('architect_layout');
    $trail->push('Layout & Excel', route('architect_layout_prepare_layout_excel',['layout_id'=>$id]));
});

//Society Formation
Breadcrumbs::for('society_formation',function($trail){
    $trail->push('HOme',route('society_formation.index'));
});


