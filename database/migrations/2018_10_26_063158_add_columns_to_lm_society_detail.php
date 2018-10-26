<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToLmSocietyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lm_society_detail', function (Blueprint $table) {
            $table->string('society_re_no')->after('society_name')->nullable();
            $table->string('chairman_mob_no')->after('chairman')->nullable();
            $table->string('secretary')->after('chairman_mob_no')->nullable();
            $table->string('secretary_mob_no')->after('secretary')->nullable();
            $table->string('society_email_id')->after('society_address')->nullable();
            $table->tinyInteger('society_conveyed')->after('other_land_id')->nullable();
            $table->string('date_of_conveyance')->after('society_conveyed')->nullable();
            $table->string('area_of_conveyance')->after('date_of_conveyance')->nullable();
            $table->longText('layout')->after('village')->nullable();


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
            $table->dropColumn('society_re_no');
            $table->dropColumn('chairman_mob_no');
            $table->dropColumn('secretary');
            $table->dropColumn('secretary_mob_no');
            $table->dropColumn('society_email_id');
            $table->dropColumn('society_conveyed');
            $table->dropColumn('date_of_conveyance');
            $table->dropColumn('area_of_conveyance');
            $table->dropColumn('layout');


        });
    }
}
