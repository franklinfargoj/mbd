<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNocNumberInOlRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('ol_request_form_details', function (Blueprint $table){
            if (!Schema::hasColumn('ol_request_form_details', 'noc_number')){
                $table->string('noc_number')->after('is_full_oc')->nullable();                
            }
            if (!Schema::hasColumn('ol_request_form_details', 'noc_date')){
                $table->string('noc_date')->after('noc_number')->nullable();                
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
        Schema::table('ol_request_form_details', function (Blueprint $table){
            if (Schema::hasColumn('ol_request_form_details', 'noc_number')){
                $table->dropColumn('noc_number');                
            }
            if (Schema::hasColumn('ol_request_form_details', 'noc_date')){
                $table->dropColumn('noc_date');                
            }       
        });
    }
}
