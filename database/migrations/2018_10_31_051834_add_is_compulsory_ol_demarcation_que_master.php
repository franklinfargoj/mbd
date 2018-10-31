<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsCompulsoryOlDemarcationQueMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            $table->tinyInteger('is_compulsory')->after('question')->default('0');
        });        
        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            $table->tinyInteger('is_compulsory')->after('question')->default('0');
        });        
        Schema::table('ol_tit_bit_question_master', function (Blueprint $table) {
            $table->tinyInteger('is_compulsory')->after('question')->default('0');
        });        
        Schema::table('ol_rg_relocation_question_master', function (Blueprint $table) {
            $table->tinyInteger('is_compulsory')->after('question')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            $table->dropColumn('is_compulsory');
        });        
        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            $table->dropColumn('is_compulsory');
        });        
        Schema::table('ol_tit_bit_question_master', function (Blueprint $table) {
            $table->dropColumn('is_compulsory');
        });        
        Schema::table('ol_rg_relocation_question_master', function (Blueprint $table) {
            $table->dropColumn('is_compulsory');
        });
    }
}
