<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaOfTotalPlotToCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_application_calculation_sheet_details', function (Blueprint $table) {
            $table->string('area_of_total_plot')->after('area_of_ntbnib_plot')->nullable();
            $table->string('permissible_proratata_area')->after('total_house')->nullable();
            $table->string('proratata_construction_area')->after('per_sq_km_proyerta_construction_area')->nullable();
            $table->string('remaining_area')->after('existing_construction_area')->nullable();
            $table->string('redirekner_val')->after('redirekner_construction_rate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
