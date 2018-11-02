<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class DdDetails extends Model
{
     use SoftDeletes;

    /* used for soft delete*/
    protected $dates = ['deleted_at'];

    protected $table = "dd_details";

    protected $primaryKey = "id";

    // protected $guard = 'society';

	protected $fillable = [
         	'bill_no', 'dd_no', 'bank_name', 'dd_amount', 'status'
    ];
}
