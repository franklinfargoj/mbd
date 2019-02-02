<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExpectedAnswerOlConsentVerificationQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'expected_answer')){
                $table->integer('expected_answer')->after('question')->nullable();                
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
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_consent_verification_question_master', 'expected_answer')){
                 $table->dropColumn('expected_answer');               
            }             
        }); 
    }
}
