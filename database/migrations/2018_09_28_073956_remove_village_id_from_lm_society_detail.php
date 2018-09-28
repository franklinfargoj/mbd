<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveVillageIdFromLmSocietyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
        	$table->dropForeign(['village_id']);
            $table->dropColumn('village_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            $table->integer('village_id')->unsigned();
        });
    }
}
