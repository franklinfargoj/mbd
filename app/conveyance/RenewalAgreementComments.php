<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class RenewalAgreementComments extends Model
{
	protected $table = 'renewal_agreement_comments';
	public $timestamps = true;
    protected $fillable = [
        'application_id',
        'user_id',
        'role_id',
        'agreement_type_id',
        'remark'
    ];

    public function Roles()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function srAgreementId()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentMaster', 'id', 'agreement_type_id');
    }
}
