<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTenant extends Model
{
    protected $table = 'master_tenants';

    public function MasterBuilding(){
    	return $this->belongsTo('App\MasterBuilding');	    
    }

    public function arrear(){
    	return $this->hasMany('App\ArrearCalculation', 'tenant_id');
    }

    public function TransBillGenerate() {
        return $this->hasMany(TransBillGenerate::class,'tenant_id');
    }

    public function tenanttype() {
        return $this->hasOne(MasterTenantType::class,'id','tenant_type');
    }
}
