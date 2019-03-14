<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsUploadInOcScrutinyQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_scrutiny_question_master', function (Blueprint $table){
            if (!Schema::hasColumn('oc_scrutiny_question_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('is_compulsory')->default(0);                
            }
            if (!Schema::hasColumn('oc_scrutiny_question_master', 'is_upload')){
                $table->tinyInteger('is_upload')->after('is_deleted')->default(0);                
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
        Schema::table('oc_scrutiny_question_master', function (Blueprint $table){
            if (Schema::hasColumn('oc_scrutiny_question_master', 'is_deleted')){
                $table->dropColumn('is_deleted');                
            }
            if (Schema::hasColumn('oc_scrutiny_question_master', 'is_upload')){
                $table->dropColumn('is_upload');                
            }       
        });
    }
}
