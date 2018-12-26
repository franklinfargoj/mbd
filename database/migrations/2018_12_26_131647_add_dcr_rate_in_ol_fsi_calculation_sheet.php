<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDcrRateInOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'dcr_rate')){  
                $table->string('dcr_rate')->after('redirekner_val')->nullable();             
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
            $table->dropColumn('dcr_rate');
        });
    }
}
