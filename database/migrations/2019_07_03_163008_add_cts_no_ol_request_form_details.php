<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCtsNoOlRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {

            $table->renameColumn('construction_details', 'lease_deed_area');
            if (!Schema::hasColumn('ol_request_form_details', 'cts_no')){
                $table->string('cts_no')->after('noc_for_iod_purpose_date')->nullable();
            } 
            if (!Schema::hasColumn('ol_request_form_details', 'floor')){
                $table->string('floor')->after('cts_no')->nullable();
            } 
            if (!Schema::hasColumn('ol_request_form_details', 'floor_no')){
                $table->string('floor_no')->after('floor')->nullable();
            } 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_request_form_details', function (Blueprint $table) {
            $table->renameColumn('lease_deed_area', 'construction_details');
            if (Schema::hasColumn('ol_request_form_details', 'cts_no')){
                $table->dropColumn('cts_no');
            }
            if (Schema::hasColumn('ol_request_form_details', 'floor')){
                $table->dropColumn('floor');
            }
            if (Schema::hasColumn('ol_request_form_details', 'floor_no')){
                $table->dropColumn('floor_no');
            }
        });
    }
}
