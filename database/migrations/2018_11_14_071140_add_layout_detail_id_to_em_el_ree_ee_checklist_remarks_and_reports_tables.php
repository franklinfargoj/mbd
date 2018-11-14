<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLayoutDetailIdToEmElReeEeChecklistRemarksAndReportsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_em_scrunity_question_details', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });
        Schema::table('architect_layout_ee_scrunity_question_details', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });
        Schema::table('architect_layout_lm_scrunity_question_details', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });
        Schema::table('architect_layout_ree_scrunity_question_details', function (Blueprint $table) {
            $table->tinyInteger('architect_layout_detail_id')->default(0);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_em_scrunity_question_details', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
        Schema::table('architect_layout_ee_scrunity_question_details', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
        Schema::table('architect_layout_lm_scrunity_question_details', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
        Schema::table('architect_layout_ree_scrunity_question_details', function (Blueprint $table) {
            $table->dropColumn('architect_layout_detail_id');
        });
    }
}
