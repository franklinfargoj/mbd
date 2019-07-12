<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataSheet extends Model
{
    protected $table="data_sheets";

    protected $fillable=[
        'full_name',
        'permanant_address',
        'address_present',
        'residing_in_staff_quarter',
        'staff_quarter_area',
        'staff_quarter_address',
        'date_of_allotment_of_staff_quarter',
        'phonenumber',
        'email',
        'post',
        'class',
        'pay_scale',
        'income_category_group',
        'dob',
        'date_of_appoinment_in_mhada',
        'received_house_from_mhada',
        'under_which_provosion',
        'you_or_your_spouse_own_house',
        'if_yes_name_of_the_city',
        'requirement_of_house_by_mhada',
        'preferable_city_1',
        'preferable_city_2',
        'preferable_city_3',
        'created_at',
        'updated_at',
    ];
}
