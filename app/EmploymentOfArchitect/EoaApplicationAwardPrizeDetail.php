<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationAwardPrizeDetail extends Model
{
    protected $tabele="eoa_application_award_prize_details";

    protected $fillable=[
        'eoa_application_id',
        'award_name'.
        'award_certificate',
        'award_drawing'
    ];
}
