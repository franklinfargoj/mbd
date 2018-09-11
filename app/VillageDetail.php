<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VillageDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $table = "lm_village_detail";
    protected $primaryKey = 'id';
    protected $fillable = [
        'board_id',
        'sr_no',
        'village_name',
        'land_source_id',
        'land_address',
        'district',
        'taluka',
        'total_area',
        'possession_date',
        'remark',
        '7_12_extract',
        '7_12_mhada_name',
        'property_card',
        'property_card_mhada_name',
        'land_cost',
        'extract_file_path',
        'extract_file_name',
        'user_id',
        'role_id'
    ];

    public function villageLandSource(){
        return $this->hasOne("App\LandSource", "id", 'land_source_id');
    }

   public function villageBoard(){
        return $this->hasOne("App\Board", "id", 'board_id');
    }
}
