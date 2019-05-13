<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TransBillGenerate extends Model
{
	 use SoftDeletes;

    /* used for soft delete*/
    protected $dates = ['deleted_at'];

    protected $table = "trans_bill_generate";

    protected $primaryKey = "id";

    // protected $guard = 'society';

	protected $fillable = [
         	'tenant_id', 'building_id', 'society_id',  'bill_date', 'due_date', 'bill_from', 'bill_to', 'bill_month', 'bill_year', 'monthly_bill', 'arrear_bill', 'total_bill', 'total_service_after_due', 'consumer_number', 'late_fee_charge', 'status','balance_amount','credit_amount','created_at','updated_at'
    ];

    public function tenant_detail()
    {
        return $this->belongsTo('App\MasterTenant', 'tenant_id');
    }

    public function building_detail()
    {
        return $this->belongsTo('App\MasterBuilding', 'building_id');
    }

    public function society_detail()
    {
        return $this->belongsTo('App\SocietyDetail', 'society_id');
    }

    public function trans_payment() {
        return $this->hasMany('App\TransPayment','bill_no');
    }
}
