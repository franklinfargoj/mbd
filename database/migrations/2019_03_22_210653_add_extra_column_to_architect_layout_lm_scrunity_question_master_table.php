<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnToArchitectLayoutLmScrunityQuestionMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_lm_scrunity_question_master', function (Blueprint $table) {
            $table->integer('rank')->default(0);
            $table->integer('gruoup_in')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_lm_scrunity_question_master', function (Blueprint $table) {
            $table->dropColumn('rank');
            $table->dropColumn('gruoup_in');
        });
    }
}
