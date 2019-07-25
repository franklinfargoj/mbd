<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScAgreementComments extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_agreement_comments';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'application_id',
        'user_id',
        'role_id',
        'agreement_type_id',
        'remark','status_id'
    ];

    public function Roles()
    {
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function scAgreementId()
    {
        return $this->hasOne('App\conveyance\SocietyConveyanceDocumentMaster', 'id', 'agreement_type_id');
    }

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
