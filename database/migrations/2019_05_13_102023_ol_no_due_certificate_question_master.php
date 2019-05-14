<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OlNoDueCertificateQuestionMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('ol_no_due_certificate_question_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->nullable();
            $table->string('question')->nullable();
            $table->tinyInteger('is_compulsory')->default(0);
            $table->tinyInteger('is_option')->default(0);
            $table->tinyInteger('hide')->default(0);
            $table->string('class')->nullable();
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
        Schema::dropIfExists('ol_no_due_certificate_question_master');
    }
}
