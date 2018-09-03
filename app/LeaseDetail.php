<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaseDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = "lease_detail";
    protected $primaryKey = 'id';
    protected $fillable = [
        'lease_rule_16_other',
        'lease_basis',
        'area',
        'lease_period',
        'lease_start_date',
        'lease_rent',
        'lease_rent_start_month',
        'interest_per_lease_agreement',
        'lease_renewal_date',
        'lease_renewed_period',
        'rent_per_renewed_lease',
        'interest_per_renewed_lease_agreement',
        'month_rent_per_renewed_lease',
        'payment_detail',
        'lease_status',
        'society_id',
    ];

    public function leaseSociety()
    {
        return $this->belongsTo('App\SocietyDetail', 'society_id');
    }
}
