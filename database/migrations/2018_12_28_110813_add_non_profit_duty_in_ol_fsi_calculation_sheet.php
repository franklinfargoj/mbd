<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNonProfitDutyInOlFsiCalculationSheet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::table('ol_fsi_calculation_sheet', function (Blueprint $table) {
            
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'non_profit_duty')){  
                $table->string('non_profit_duty')->after('redirekner_val')->nullable();             
            }             
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'non_profit_duty_installment')){  
                $table->string('non_profit_duty_installment')->after('non_profit_duty')->nullable();             
            }             
            if (!Schema::hasColumn('ol_fsi_calculation_sheet', 'non_profit_duty_val')){  
                $table->string('non_profit_duty_val')->after('non_profit_duty_installment')->nullable();             
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
            $table->dropColumn('non_profit_duty');
            $table->dropColumn('non_profit_duty_installment');
            $table->dropColumn('non_profit_duty_val');
        });
    }
}
