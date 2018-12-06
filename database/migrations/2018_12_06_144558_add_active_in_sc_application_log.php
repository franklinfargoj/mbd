<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveInScApplicationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_application_log', function (Blueprint $table) {
            
            if (!Schema::hasColumn('sc_application_log', 'is_active')){  
                $table->tinyInteger('is_active')->after('remark')->default('0');             
            }            
           
            if (!Schema::hasColumn('sc_application_log', 'phase')){
                $table->integer('phase')->after('is_active')->default('0');               
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
        Schema::table('sc_application_log', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('phase');
        });
    }
}
