<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionApplicableToOcScrutinyQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_scrutiny_question_master', function (Blueprint $table) {
            if (!Schema::hasColumn('oc_scrutiny_question_master', 'option_applicable')){
                $table->tinyInteger('option_applicable')->after('remarks_applicable')->default('0');
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
            if (Schema::hasColumn('oc_scrutiny_question_master', 'option_applicable')){
                $table->dropColumn('option_applicable');
            }
        });
    }
}
