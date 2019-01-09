<?php

namespace App\EmploymentOfArchitect;

use Illuminate\Database\Eloquent\Model;

class EoaApplicationPartnerDetail extends Model
{
  protected $table="eoa_application_partner_details";

  protected $fillable=['eoa_application_id','name','registration_no'];
}
