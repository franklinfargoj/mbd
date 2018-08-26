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


}
