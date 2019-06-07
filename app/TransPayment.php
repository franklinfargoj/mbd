<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TransPayment extends Model
{
	 use SoftDeletes;

    /* used for soft delete*/
    protected $dates = ['deleted_at'];

    protected $table = "trans_payment";

    protected $primaryKey = "id";

    // protected $guard = 'society';

	protected $fillable = [
         	'created_at','updated_at','bill_no', 'tenant_id', 'building_id', 'society_id', 'paid_by', 'mode_of_payment', 'bill_amount', 'amount_paid', 'from_date', 'to_date', 'balance_amount', 'credit_amount'
    ];

    public function bill_details()
    {
        return $this->belongsTo('App\TransBillGenerate', 'bill_no');
    }
    
    public function dd_details()
    {
        return $this->belongsTo('App\DdDetails', 'dd_id');
    }

    public function society_details(){
        return $this->belongsTo('App\SocietyDetail','society_id');
    }

    public function building()
    {
        return $this->hasMany('App\MasterBuilding','id','building_id');
    }
    public function tenants()
    {
        return $this->hasMany('App\MasterTenant','id','tenant_id');
    }
}
