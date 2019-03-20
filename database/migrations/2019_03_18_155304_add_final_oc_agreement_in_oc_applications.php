<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFinalOcAgreementInOcApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_applications', function (Blueprint $table){
            if (!Schema::hasColumn('oc_applications', 'final_oc_agreement')){
                $table->string('final_oc_agreement')->after('text_oc')->nullable();                
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
            if (Schema::hasColumn('oc_applications', 'final_oc_agreement')){
                $table->dropColumn('final_oc_agreement');                
            }       
        });
    }
}
