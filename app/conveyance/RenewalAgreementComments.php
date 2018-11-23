<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalAgreementComments extends Model
{
	protected $table = 'renewal_agreement_comments';
	public $timestamps = true;

    public function Roles()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    } 	
}
