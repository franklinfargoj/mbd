<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OcScrutinyAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oc_scrutiny_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('society_id');
            $table->integer('user_id'); //processing employee id
            $table->integer('question_id')->nullable();
            $table->tinyInteger('answer')->nullable(); //0 => no, 1 => yes
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('oc_scrutiny_answers');
    }
}
