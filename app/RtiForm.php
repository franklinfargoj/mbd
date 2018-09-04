<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiForm extends Model
{
    protected $table = "rti_form";

    protected $fillable = array('board_id','frontend_user_id','applicant_name','applicant_addr','info_subject','info_period_from','info_period_to','info_descr','info_post_or_person','info_post_type','applicant_below_poverty_line','poverty_line_proof','department_id','unique_id');

    public function frontendUser()
    {
        return $this->belongsTo('frontend_users');
    }

    public function users(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function rti_schedule_meetings(){
    	return $this->belongsTo(RtiScheduleMeeting::class, 'rti_schedule_meeting_id');
    }

    public function rti_send_info(){
    	return $this->belongsTo(RtiSendInfo::class, 'rti_send_info_id');
    }

    public function rti_forward_application(){
    	return $this->belongsTo(RtiForwardApplication::class, 'rti_forward_application_id');
    }

}