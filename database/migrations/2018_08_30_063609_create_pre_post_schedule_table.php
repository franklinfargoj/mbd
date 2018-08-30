<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrePostScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_post_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hearing_id');
            $table->foreign('hearing_id')->references('id')->on('hearing')->onDelete('cascade');
            $table->string('date')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('pre_post_status')->default(0)->comment("1=Prepone and 0=Postpone");
            $table->unsignedInteger('hearing_schedule_id');
            $table->foreign('hearing_schedule_id')->references('id')->on('hearing_schedule')->onDelete('cascade');

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
        Schema::dropIfExists('pre_post_schedule');
    }
}
