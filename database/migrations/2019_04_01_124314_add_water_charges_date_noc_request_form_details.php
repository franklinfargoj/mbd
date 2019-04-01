<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWaterChargesDateNocRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('noc_request_form_details', function (Blueprint $table){
            if (!Schema::hasColumn('noc_request_form_details', 'water_charges_date')){
                $table->string('water_charges_date')->after('water_charges_receipt_number')->nullable();                
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
        Schema::table('noc_request_form_details', function (Blueprint $table){
            if (Schema::hasColumn('noc_request_form_details', 'water_charges_date')){
                $table->dropColumn('water_charges_date');                
            }       
        });
    }
}
