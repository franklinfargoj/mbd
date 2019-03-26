<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnNameOfArchitectLayoutEeScrunityQuestionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_ee_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('gruoup_in', 'group_in');
        });
        Schema::table('architect_layout_em_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('gruoup_in', 'group_in');
        });
        Schema::table('architect_layout_lm_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('gruoup_in', 'group_in');
        });
        Schema::table('architect_layout_ree_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('gruoup_in', 'group_in');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_ee_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('group_in', 'gruoup_in');
        });
        Schema::table('architect_layout_em_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('group_in', 'gruoup_in');
        });
        Schema::table('architect_layout_lm_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('group_in', 'gruoup_in');
        });
        Schema::table('architect_layout_ree_scrunity_question_master', function (Blueprint $table) {
            $table->renameColumn('group_in', 'gruoup_in');
        });
    }
}
