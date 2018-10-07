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

//Land
Breadcrumbs::for('village_detail', function ($trail) {
	$trail->push('village_detail', route('village_detail.index'));
});

Breadcrumbs::for('village_create', function ($trail) {
	$trail->parent('village_detail');
	$trail->push('village_create', route('village_detail.create'));
});

Breadcrumbs::for('village_view', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('village_view/', route('village_detail.show',$id));
});

Breadcrumbs::for('village_edit', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('village_edit/', route('village_detail.edit',$id));
});

Breadcrumbs::for('society_detail', function ($trail) {
	$trail->push('society_detail', route('society_detail.index'));
});

Breadcrumbs::for('society_create', function ($trail) {
	$trail->parent('society_detail');
	$trail->push('society_create/', route('society_detail.create'));
});

Breadcrumbs::for('society_detail_edit', function ($trail,$id) {
	$trail->parent('society_detail',$id);
	$trail->push('society_detail_edit/', route('society_detail.edit',$id));
});

Breadcrumbs::for('lease_detail', function ($trail,$id) {
	$trail->push('lease_detail', route('lease_detail.index',['id'=>$id]));
});

Breadcrumbs::for('lease_create', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('lease_create', route('lease_detail.create',['id'=>$id]));
});

Breadcrumbs::for('lease_renew', function ($trail,$id) {
	$trail->parent('lease_detail',$id);
	$trail->push('lease_renew', route('renew-lease.renew',['id'=>$id]));
});

Breadcrumbs::for('lease_edit', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$id);
    $trail->push('lease_edit', route('edit-lease.edit',['id'=>$id, 'society_id'=>$society_id]));
});

Breadcrumbs::for('lease_view', function ($trail,$id,$society_id) {
    $trail->parent('lease_detail',$id);
    $trail->push('lease_view', route('view-lease.view',['id'=>$id, 'society_id'=>$society_id]));
});

// Hearing
Breadcrumbs::for('Hearing', function ($trail) {
    $trail->push('Hearing', route('hearing.index'));
});

Breadcrumbs::for('Hearing Create', function ($trail) {
    $trail->parent('Hearing');
    $trail->push('Hearing Create', route('hearing.create'));
});

Breadcrumbs::for('Hearing Edit', function ($trail, $id) {
    $trail->parent('Hearing');
    $trail->push('Hearing Edit', route('hearing.edit', $id));
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
    $trail->push('Dashboard', route('society_offer_letter_dashboard'));
});

Breadcrumbs::for('documents_uploaded', function ($trail) {
    $trail->push('Dashboard', route('society_offer_letter_dashboard'));
    $trail->push('Uploaded documents', route('documents_uploaded'));
});

Breadcrumbs::for('documents_upload', function ($trail) {
    $trail->push('Dashboard', route('society_offer_letter_dashboard'));
    $trail->push('Upload documents', route('documents_upload'));
});

//cap Breadcrumbs

Breadcrumbs::for('cap', function ($trail) {
    $trail->push('Home', route('cap.index'));
});

Breadcrumbs::for('society_EE_documents_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('society_EE_documents', route('cap.society_EE_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('EE_scrutiny', route('cap.EE_scrutiny_remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('DYCE_scrutiny', route('cap.dyce_Scrutiny_Remark',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('cap');
//     $trail->push('REE_calculation', route('cap.dyce_Scrutiny_Remark',$id));
// });

Breadcrumbs::for('Forward_Application_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('Forward_Application', route('cap.forward_application',$id));
});

Breadcrumbs::for('cap_note_cap', function ($trail,$id) {
    $trail->parent('cap');
    $trail->push('cap_note', route('cap.cap_notes',$id));
});

//vp Breadcrumbs

Breadcrumbs::for('vp', function ($trail) {
    $trail->push('Home', route('vp.index'));
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

Breadcrumbs::for('Forward_Application_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('Forward_Application', route('vp.forward_application',$id));
});

Breadcrumbs::for('cap_note_vp', function ($trail,$id) {
    $trail->parent('vp');
    $trail->push('cap_note', route('vp.cap_notes',$id));
});

//co Breadcrumbs

Breadcrumbs::for('co', function ($trail) {
    $trail->push('Home', route('co.index'));
});

Breadcrumbs::for('society_EE_documents_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('society_EE_documents', route('co.society_EE_documents',$id));
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

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('co');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });

Breadcrumbs::for('Forward_Application_co', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('Forward_Application', route('co.forward_application',$id));
});

Breadcrumbs::for('download_cap_note', function ($trail,$id) {
    $trail->parent('co');
    $trail->push('cap_note', route('co.download_cap_note',$id));
});

//REE Breadcrumbs

Breadcrumbs::for('ree', function ($trail) {
    $trail->push('Home', route('co.index'));
});

Breadcrumbs::for('society_EE_documents_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('society_EE_documents', route('ree.society_EE_documents',$id));
});

Breadcrumbs::for('EE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('EE_scrutiny', route('ree.EE_Scrutiny_Remark',$id));
});

Breadcrumbs::for('DYCE_scrutiny_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('DYCE_scrutiny', route('ree.dyce_scrutiny_remark',$id));
});

Breadcrumbs::for('calculation_sheet', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('calculation_sheet', route('ol_calculation_sheet.index',$id));
});

Breadcrumbs::for('approved_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('approved_offer_letter', route('ree.approved_offer_letter',$id));
});

Breadcrumbs::for('generate_offer_letter', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('generate_offer_letter', route('ree.generate_offer_letter',$id));
});

// Breadcrumbs::for('REE_calculation_cap', function ($trail,$id) {
//     $trail->parent('co');
//     $trail->push('REE_calculation', route('vp.forward_application',$id));
// });

Breadcrumbs::for('Forward_Application_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('Forward_Application', route('ree.forward_application',$id));
});

Breadcrumbs::for('cap_note_ree', function ($trail,$id) {
    $trail->parent('ree');
    $trail->push('cap_note', route('ree.download_cap_note',$id));
});