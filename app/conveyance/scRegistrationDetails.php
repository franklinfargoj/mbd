<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class scRegistrationDetails extends Model
{
    protected $table = 'sc_registration_details';

    protected $fillable = [
        'application_id',
        'agreement_type_id',
        'sub_registrar_name',
        'registration_year',
        'registration_no'
    ];
}
