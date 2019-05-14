<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentToOlConsentVerificationQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_consent_verification_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'is_option')){
                $table->integer('is_option')->after('is_compulsory')->nullable();                
            } 
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'group')){
                $table->integer('group')->after('is_option')->nullable();                
            } 
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'sort_by')){
                $table->integer('sort_by')->after('group')->nullable();                
            }
            if (!Schema::hasColumn('ol_consent_verification_question_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('sort_by')->default(0);                
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
            if (Schema::hasColumn('ol_consent_verification_question_master', 'is_option')){
                $table->dropColumn('is_option');                
            } 
            if (Schema::hasColumn('ol_consent_verification_question_master', 'group')){
                $table->dropColumn('group');                
            }
            if (Schema::hasColumn('ol_consent_verification_question_master', 'sort_by')){
                $table->dropColumn('sort_by');                
            }
            if (Schema::hasColumn('ol_consent_verification_question_master', 'is_deleted')){
                $table->dropColumn('is_deleted');                
            }
        });
    }
}
