<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadCaseJudgementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_case_judgement', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hearing_id');
            $table->foreign('hearing_id')->references('id')->on('hearing')->onDelete('cascade');
            $table->string('upload_judgement_case')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('upload_case_judgement');
    }
}
