<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeOcScrutinyQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_scrutiny_question_master', function (Blueprint $table) {
            $table->text('question')->nullable()->change();
            if (!Schema::hasColumn('oc_scrutiny_question_master', 'group')){
                $table->integer('group')->after('is_upload')->nullable();                
            }
            if (!Schema::hasColumn('oc_scrutiny_question_master', 'sort_by')){
                $table->integer('sort_by')->after('group')->nullable();                
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
        Schema::table('oc_scrutiny_question_master', function (Blueprint $table) {
            $table->varchar('question')->change();
            if (Schema::hasColumn('oc_scrutiny_question_master', 'group')){
                $table->dropColumn('group');                
            }
            if (Schema::hasColumn('oc_scrutiny_question_master', 'sort_by')){
                $table->dropColumn('sort_by');                
            } 
        });
    }
}
