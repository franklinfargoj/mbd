<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendNoticeToAppellantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('send_notice_to_appellant', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hearing_id');
            $table->foreign('hearing_id')->references('id')->on('hearing')->onDelete('cascade');
            $table->string('upload_notice')->nullable();
            $table->string('comment')->nullable();
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
        Schema::dropIfExists('send_notice_to_appellant');
    }
}
