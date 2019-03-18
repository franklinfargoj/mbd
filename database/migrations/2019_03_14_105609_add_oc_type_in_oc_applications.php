<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOcTypeInOcApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_applications', function (Blueprint $table){
            if (!Schema::hasColumn('oc_applications', 'oc_type')){
                $table->string('oc_type',50)->after('is_approve_oc')->nullable();                
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
        Schema::table('oc_applications', function (Blueprint $table){
            if (Schema::hasColumn('oc_applications', 'oc_type')){
                $table->dropColumn('oc_type');                
            }       
        });
    }
}
