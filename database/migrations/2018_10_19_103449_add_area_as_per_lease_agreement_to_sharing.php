<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAreaAsPerLeaseAgreementToSharing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
            $table->string('area_as_per_lease_agreement')->after('area_of_tit_bit_plot')->nullable();
            $table->string('abhinyas_area_as_per_lease_agreement')->after('area_of_total_plot')->nullable();
            $table->string('abhinyas_area_of_tit_bit_plot')->after('abhinyas_area_as_per_lease_agreement')->nullable();
            $table->string('abhinyas_area_of_total_plot')->after('abhinyas_area_of_tit_bit_plot')->nullable();
            $table->string('area_of_​​subsistence_to_calculate')->after('abhinyas_area_of_total_plot')->nullable();
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
            $table->dropColumn('area_as_per_lease_agreement');
            $table->dropColumn('abhinyas_area_as_per_lease_agreement');
            $table->dropColumn('abhinyas_area_of_tit_bit_plot');
            $table->dropColumn('abhinyas_area_of_total_plot');
            $table->dropColumn('area_of_​​subsistence_to_calculate');
        });
    }
}
