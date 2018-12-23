<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalNoOfBuildingsToSharingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->integer('total_no_of_buildings')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->dropColumn('total_no_of_buildings');
        });
    }
}
