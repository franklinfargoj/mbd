<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScAgreementTypeStatus extends Model
{
	protected $table = 'sc_agreement_type_status';
    public $timestamps = true;

    public function scAgreementName()
    {
        return $this->hasOne('App\conveyance\ScAgreementTypeMasterModel', 'id','agreement_type_id');
    }  
}
