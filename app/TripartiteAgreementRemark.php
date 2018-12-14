<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripartiteAgreementRemark extends Model
{
    protected $table="tripartite_agreement_remarks";

    public $timestamps = true;

    public function Roles()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }
}
