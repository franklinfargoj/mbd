<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMcgmIodNumberMcgmIodDateColumnToNocCcRequestFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_cc_request_form_details', function (Blueprint $table) {
            $table->string('mcgm_iod_number')->nullable()->after('offer_letter_number');
            $table->string('mcgm_iod_date')->nullable()->after('mcgm_iod_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('noc_cc_request_form_details', function (Blueprint $table) {
            $table->dropColumn('mcgm_iod_date');
            $table->dropColumn('mcgm_iod_number');

        });
    }
}
