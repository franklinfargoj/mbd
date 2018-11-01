<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('area_of_rg_to_be_relocated')->after('water_usage_charges')->nullable();
            $table->string('total_area_of_rg_to_be_relocated')->after('area_of_rg_to_be_relocated')->nullable();
            $table->string('groundrent_capitalization_yearly')->after('total_area_of_rg_to_be_relocated')->nullable();
            $table->string('advance_groundrent_per_year')->after('groundrent_capitalization_yearly')->nullable();
            $table->string('nominal_groundrent')->after('advance_groundrent_per_year')->nullable();
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
            $table->dropColumn('area_of_rg_to_be_relocated');
            $table->dropColumn('total_area_of_rg_to_be_relocated');
            $table->dropColumn('groundrent_capitalization_yearly');
            $table->dropColumn('advance_groundrent_per_year');
            $table->dropColumn('nominal_groundrent');
        });
    }
}
