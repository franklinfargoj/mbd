<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherLandSourceColumnToLmVillageDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_village_detail', function (Blueprint $table) {
            $table->longText('other_land_source')->after('land_source_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lm_village_detail', function (Blueprint $table) {
            $table->dropColumn('other_land_source');
        });
    }
}
