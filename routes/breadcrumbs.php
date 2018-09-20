<?php 

// Rti Application
Breadcrumbs::for('rti_applicants', function ($trail) {
    $trail->push('rti_applicatnts', route('rti_applicants'));
});

Breadcrumbs::for('view_applicant', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('view_applicant/'.$id, route('view_applicant',$id));
});

Breadcrumbs::for('schedule_meeting', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('schedule_meeting/'.$id, route('schedule_meeting',$id));
});

Breadcrumbs::for('update_status', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('update_status/'.$id, route('update_status',$id));
});

Breadcrumbs::for('rti_send_info', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('rti_send_info/'.$id, route('rti_send_info',$id));
});

Breadcrumbs::for('rti_forwarded_application', function ($trail,$id) {
    $trail->parent('rti_applicants');
    $trail->push('rti_forwarded_application/'.$id, route('rti_forwarded_application',$id));
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
    $trail->push('resolution_edit/'.$id, route('resolution.edit',$id));
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
	$trail->push('village_view/'.$id, route('village_detail.show',$id));
});

Breadcrumbs::for('village_edit', function ($trail,$id) {
	$trail->parent('village_detail');
	$trail->push('village_edit/'.$id, route('village_detail.edit',$id));
});

Breadcrumbs::for('society_detail', function ($trail,$id) {
	$trail->push('society_detail', route('society_detail.index',$id));
});

Breadcrumbs::for('society_create', function ($trail,$id) {
	$trail->parent('society_detail',$id);
	$trail->push('society_create/'.$id, route('society_detail.create',$id));
});

Breadcrumbs::for('society_detail_edit', function ($trail,$id) {
	$trail->parent('society_detail',$id);
	$trail->push('society_detail_edit/'.$id, route('society_detail.edit',$id));
});

Breadcrumbs::for('lease_detail', function ($trail,$id,$village_id) {
	$trail->push('lease_detail', route('lease_detail.index',['id'=>$id,'village_id'=>$village_id]));
});

Breadcrumbs::for('lease_create', function ($trail,$id,$village_id) {
	$trail->parent('lease_detail',$id,$village_id);
	$trail->push('lease_create', route('lease_detail.create',['id'=>$id,'village_id'=>$village_id]));
});

