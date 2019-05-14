<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOptionInOlRgRelocationQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_rg_relocation_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_rg_relocation_question_master', 'is_option')){
                $table->tinyInteger('is_option')->after('is_compulsory')->default(0);                
            } 
            if (!Schema::hasColumn('ol_rg_relocation_question_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('is_option')->default(0);                
            }
        });

        Schema::table('ol_rg_relocation_details', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_rg_relocation_details', 'schema')){
                $table->string('schema')->after('remark')->nullable();                
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
        Schema::table('ol_rg_relocation_question_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_rg_relocation_question_master', 'is_option')){
                $table->dropColumn('is_option');                
            } 
            if (Schema::hasColumn('ol_rg_relocation_question_master', 'is_select')){
                $table->dropColumn('is_select');                
            }
        });

        Schema::table('ol_rg_relocation_details', function (Blueprint $table) {
            if (Schema::hasColumn('ol_rg_relocation_details', 'schema')){
                $table->dropColumn('schema');                
            } 
        });
    }
}
