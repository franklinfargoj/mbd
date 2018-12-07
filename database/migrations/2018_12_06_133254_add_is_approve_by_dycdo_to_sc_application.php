<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsApproveByDycdoToScApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_application', 'approved_by_dycdo')){  
                $table->tinyInteger('approved_by_dycdo')->after('riders')->default('0');             
            }            
            if (!Schema::hasColumn('sc_application', 'stamp_by_dycdo')){
                $table->tinyInteger('stamp_by_dycdo')->after('approved_by_dycdo')->default('0');               
            }            
            if (!Schema::hasColumn('sc_application', 'phase')){
                $table->integer('phase')->after('stamp_by_dycdo')->default('0');               
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
        Schema::table('sc_application', function (Blueprint $table) {
            $table->dropColumn('approved_by_dycdo');
            $table->dropColumn('stamp_by_dycdo');
            $table->dropColumn('phase');
        });
    }
} 
