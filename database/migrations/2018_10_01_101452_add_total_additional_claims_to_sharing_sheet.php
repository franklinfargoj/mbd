<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTotalAdditionalClaimsToSharingSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_sharing_calculation_sheet_details', function (Blueprint $table) {
             $table->string('total_additional_claims')->after('per_sq_km_proyerta_construction_area')->nullable();
            $table->string('total_rehabilitation_mattress_area_with_dcr')->after('total_additional_claims')->nullable();
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
            $table->dropColumn('total_additional_claims');
            $table->dropColumn('total_rehabilitation_mattress_area_with_dcr');

        });
    }
}
