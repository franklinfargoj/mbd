<?php

namespace App\conveyance;

use Illuminate\Database\Eloquent\Model;

class ScApplicationAgreements extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sc_application_agreements';

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
        'draft_sale_agreement',
        'draft_lease_agreement',
        'approve_sale_agreement',
        'approve_lease_agreement',
        'stamp_sale_agreement',
        'stamp_lease_agreement',
        'sign_sale_agreement',
        'sign_lease_agreement',
        'register_sale_agreement',
        'register_lease_agreement',
    ];

    /**
     * Indicates if the model has update and creation timestamps.
     *
     * @var bool
     */
    public $timestamps = true;
}
