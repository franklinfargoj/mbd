<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class TransBillGenerate extends Model
{
	 use SoftDeletes;

    /* used for soft delete*/
    protected $dates = ['deleted_at'];

    protected $table = "trans_payment";

    protected $primaryKey = "id";

    // protected $guard = 'society';

	protected $fillable = [
         	'tenant_id', 'building_id', 'society_id',  'bill_date', 'due_date', 'bill_from', 'bill_to', 'bill_month', 'bill_year', 'monthly_bill', 'arrear_bill', 'total_bill'
    ];
}
