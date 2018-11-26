<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocScrutinyQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_scrutiny_question_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->default(0); //  default 0
            $table->string('question');
            $table->tinyInteger('is_compulsory')->default('1');
            $table->tinyInteger('remarks_applicable')->default('0');
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
        Schema::dropIfExists('noc_scrutiny_question_master');
    }
}
