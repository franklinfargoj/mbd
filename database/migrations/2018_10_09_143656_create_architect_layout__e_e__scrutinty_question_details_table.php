<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutEEScrutintyQuestionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_ee_scrunity_question_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('architect_layout_id');
            $table->integer('architect_layout_ee_scrunity_question_master_id');
            $table->text('remark')->nullable();
            $table->tinyInteger('label1')->default(0);
            $table->tinyInteger('label2')->default(0);
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('architect_layout_ee_scrunity_question_details');
    }
}
