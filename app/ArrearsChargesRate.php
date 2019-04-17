<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArrearsChargesRate extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table="arrears_charges_rates";

    public function tenanttype() {
    	return $this->hasOne(MasterTenantType::class,'id','tenant_type');
    }
}
