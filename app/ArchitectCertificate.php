<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchitectCertificate extends Model
{
     protected $table="architect_certificates";

     protected $fillable=['architect_application_id','certificate_name','certificate_path'];
}
