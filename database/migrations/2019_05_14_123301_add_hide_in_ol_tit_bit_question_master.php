<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHideInOlTitBitQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_tit_bit_question_master', function (Blueprint $table) {
            
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'hide')){
                $table->tinyInteger('hide')->after('is_select')->default(0);                
            }
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'class')){
                $table->string('class')->after('hide')->nullable();                
            }
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('class')->default(0);                
            }
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'group')){
                $table->Integer('group')->after('is_deleted')->nullable();                
            }
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'sort_by')){
                $table->Integer('sort_by')->after('group')->nullable();                
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
        Schema::table('ol_tit_bit_question_master', function (Blueprint $table) {
    
            if (Schema::hasColumn('ol_tit_bit_question_master', 'hide')){
                $table->dropColumn('hide');                
            }
            if (Schema::hasColumn('ol_tit_bit_question_master', 'class')){
                $table->dropColumn('class');                
            }
            if (Schema::hasColumn('ol_tit_bit_question_master', 'is_deleted')){
                $table->dropColumn('is_deleted');                
            }
            if (Schema::hasColumn('ol_tit_bit_question_master', 'group')){
                $table->dropColumn('group');                
            }
            if (Schema::hasColumn('ol_tit_bit_question_master', 'sort_by')){
                $table->dropColumn('sort_by');                
            }
        });
    }
}
