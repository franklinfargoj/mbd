<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSocietyFlagRenewalApplicationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('renewal_application_log', function (Blueprint $table) {
                       
            if (Schema::hasColumn('renewal_application_log', 'society_flag')){
                $table->integer('society_flag')->default(0)->change();              
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
        Schema::table('renewal_application_log', function (Blueprint $table) {
             $table->integer('society_flag')->nullable()->change();
        });
    }
} 
 