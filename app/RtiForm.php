<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiForm extends Model
{
    protected $table = "rti_form";

    protected $fillable = array('board_id','frontend_user_id','applicant_name','applicant_addr','info_subject','info_period_from','info_period_to','info_descr','info_post_or_person','info_post_type','applicant_below_poverty_line','poverty_line_proof','department_id','unique_id', 'status', 'user_id', 'rti_schedule_meeting_id', 'rti_status_id', 'rti_send_info_id', 'rti_forward_application_id','appeal_by_applicant','created_at','updated_at');

    public function frontendUser()
    {
        return $this->belongsTo('frontend_users');
    }

    public function users(){
    	return $this->belongsTo(RtiFronendUser::class, 'frontend_user_id');
    }

    public function rti_schedule_meetings(){
    	return $this->belongsTo(RtiScheduleMeeting::class, 'rti_schedule_meeting_id');
    }

    public function rti_send_info(){
    	return $this->belongsTo(RtiSendInfo::class, 'id','application_id');
    }

    public function sent_info_hostory()
    {
        return $this->hasMany(RtiSendInfo::class, 'application_id','id');
    }

    public function rti_forward_application(){
    	return $this->belongsTo(RtiForwardApplication::class, 'rti_forward_application_id');
    }

    public function board(){
        return $this->belongsTo(Board::class, 'board_id');
    }

    public function department(){
        return $this->belongsTo(Department::class, 'department_id','id');
    }

    public function master_rti_status(){
        return $this->belongsTo(RtiStatus::class,'rti_status_id','id');
    }

    public function current_status(){
        return $this->belongsTo(MasterRtiStatus::class, 'status','id');
    }
    public function rti_forward_status(){
    	return $this->hasMany(RtiForwardApplication::class, 'application_id','id')->orderBy('id','desc');
    }

}
