<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocietyIdInCalculationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->integer('society_id')->after('user_id');
        });

        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->integer('society_id')->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->dropColumn('society_id');
        });

        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->dropColumn('society_id');
        });
    }
}
