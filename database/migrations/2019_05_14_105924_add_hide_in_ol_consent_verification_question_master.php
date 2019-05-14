<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHideInOlConsentVerificationQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'hide')){
                $table->tinyInteger('hide')->after('is_deleted')->default(0);                
            }
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'class')){
                $table->string('class')->after('hide')->nullable();                
            }
        });

        // ol demarcation question master
        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_question_master', 'is_textbox')){
                $table->tinyInteger('is_textbox')->after('is_number')->default(0);                
            }
        });

        // ol demarcation question details
        Schema::table('ol_demarcation_details', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_demarcation_details', 'crz_area')){
                $table->string('crz_area')->after('encrochment')->nullable();                
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
    
            if (Schema::hasColumn('ol_consent_verification_question_master', 'hide')){
                $table->dropColumn('hide');                
            }
            if (Schema::hasColumn('ol_consent_verification_question_master', 'class')){
                $table->dropColumn('class');                
            }
        });

        Schema::table('ol_demarcation_question_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_question_master', 'is_textbox')){
                $table->dropColumn('is_textbox');
            }
        });

         Schema::table('ol_demarcation_details', function (Blueprint $table) {
            if (Schema::hasColumn('ol_demarcation_details', 'crz_area')){
                $table->dropColumn('crz_area');
            }
        });  
    }
}
