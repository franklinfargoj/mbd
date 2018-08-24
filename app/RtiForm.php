<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RtiForm extends Model
{
    protected $table = "rti_form";

    public function frontendUser()
    {
        return $this->belongsTo('frontend_users');
    }
}
