<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OlApplicationConcessionSheetDetails extends Model
{
    protected $table = 'ol_application_concession_sheet_details';
    protected $fillable = [
    	'application_id',
        'user_id',
        'society_id',
        'tenement_charges',
        'r_g_shiffting',
        'ob_other_plot',
        'vp_cota',
        'encroachment_plot',
        'premium_charges',
        'tit_bit_land',
    ];
}
