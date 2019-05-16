<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantsLogDetails extends Model
{
    protected $table = 'tenants_log_details';

    public function MasterBuilding(){
        return $this->belongsTo('App\MasterBuilding','building_id','id');
    }

    public function tenanttype() {
        return $this->hasOne(MasterTenantType::class,'id','tenant_type');
    }
}
