<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisputeBillDetail extends Model
{
    protected $table = "dispute_bill_detail";
    protected $primaryKey = 'id';
    protected $fillable = [
        'trans_bill_generate_id',
        'amount',
        'remark'
    ];

//    public function boardDepartments()
//    {
//        return $this->hasMany('App\BoardDepartment');
//    }
//
    public function trans_bills()
    {
        return $this->hasOne(\App\TransBillGenerate::class,'id','trans_bill_generate_id');
    }
}
