<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentIdToHearingStatusLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hearing_status_log', function (Blueprint $table) {
            if (!Schema::hasColumn('hearing_status_log', 'department_id')){
                $table->string('department_id')->after('role_id')->nullable();                
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
        Schema::table('hearing_status_log', function (Blueprint $table) {
            if (Schema::hasColumn('hearing_status_log', 'department_id')){
                 $table->dropColumn('department_id');               
            }             
        });
    }
}
