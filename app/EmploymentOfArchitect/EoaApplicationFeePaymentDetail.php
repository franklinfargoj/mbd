<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationFeePaymentDetail extends Model
{
    protected $table="eoa_application_fee_payment_details";

    protected $fillable=[
        'eoa_application_id',
        'receipt_no',
        'cash',
        'pay_order_no',
        'bank',
        'branch',
        'date_of_payment',
        'receipt_date'
    ];
}
