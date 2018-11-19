<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScAgreementTypeMasterModel extends Model
{
	protected $table = 'sc_agreement_type_master';
    protected $fillable = [
        'agreement_name',
    ];	
    public $timestamps = true;
}
