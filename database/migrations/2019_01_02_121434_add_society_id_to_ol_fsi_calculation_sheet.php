<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocietyIdToOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {            
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'society_id')){  
                $table->integer('society_id')->after('application_id')->nullable();             
            }                         
        });

        Schema::table('ol_custom_calculation_sheet', function (Blueprint $table) {            
            if (!Schema::hasColumn('ol_custom_calculation_sheet', 'society_id')){  
                $table->integer('society_id')->after('application_id')->nullable();             
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
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            $table->dropColumn('society_id');
        });        
        Schema::table('ol_custom_calculation_sheet', function (Blueprint $table) {
            $table->dropColumn('society_id');
        });
    }
}
