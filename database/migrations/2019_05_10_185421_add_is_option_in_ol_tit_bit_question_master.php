<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOptionInOlTitBitQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_tit_bit_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'is_option')){
                $table->tinyInteger('is_option')->after('is_compulsory')->default(0);                
            } 
            if (!Schema::hasColumn('ol_tit_bit_question_master', 'is_select')){
                $table->tinyInteger('is_select')->after('is_option')->default(0);                
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
            if (Schema::hasColumn('ol_tit_bit_question_master', 'is_option')){
                $table->dropColumn('is_option');                
            } 
            if (Schema::hasColumn('ol_tit_bit_question_master', 'is_select')){
                $table->dropColumn('is_select');                
            }
        });
    }
}
