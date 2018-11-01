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
         	'bill_no', 'tenant_id', 'building_id', 'society_id', 'paid_by', 'mode_of_payment', 'bill_amount', 'amount_paid', 'from_date', 'to_date', 'balance_amount', 'credit_amount'
    ];
}
