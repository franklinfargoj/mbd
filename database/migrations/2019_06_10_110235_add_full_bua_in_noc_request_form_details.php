<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullBuaInNocRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_request_form_details', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_request_form_details', 'full_bua')){
                $table->string('full_bua')->after('water_charges_date')->nullable();
            }
            if (!Schema::hasColumn('noc_request_form_details', 'existing_bua')){
                $table->string('existing_bua')->after('full_bua')->nullable();
            }
            if (!Schema::hasColumn('noc_request_form_details', 'percent_bua')){
                $table->string('percent_bua')->after('existing_bua')->nullable();
            }
            if (!Schema::hasColumn('noc_request_form_details', 'total_bua')){
                $table->string('total_bua')->after('percent_bua')->nullable();
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
        Schema::table('noc_request_form_details', function (Blueprint $table) {
            if (Schema::hasColumn('noc_request_form_details', 'full_bua')){
                $table->dropColumn('full_bua');
            }
            if (Schema::hasColumn('noc_request_form_details', 'existing_bua')){
                $table->dropColumn('existing_bua');
            }
            if (Schema::hasColumn('noc_request_form_details', 'percent_bua')){
                $table->dropColumn('percent_bua');
            }
            if (Schema::hasColumn('noc_request_form_details', 'total_bua')){
                $table->dropColumn('total_bua');
            }
        });
    }
}
