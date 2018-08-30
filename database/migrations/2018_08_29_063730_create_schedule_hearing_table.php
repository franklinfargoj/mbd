<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleHearingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearing_schedule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('preceding_officer_name')->nullable();
            $table->string('case_year')->nullable();
            $table->string('case_number')->nullable();

            $table->unsignedInteger('preceding_number');
            $table->foreign('preceding_number')->references('id')->on('hearing')->onDelete('cascade');

            $table->string('appellant_name')->nullable();
            $table->string('respondent_name')->nullable();

            $table->string('preceding_date')->nullable();
            $table->string('preceding_time')->nullable();
            $table->longText('description')->nullable();
            $table->string('case_template')->nullable();

            $table->unsignedInteger('update_status');
            $table->foreign('update_status')->references('id')->on('hearing_status')->onDelete('cascade');

            $table->string('update_supporting_documents')->nullable();

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
        Schema::dropIfExists('hearing_schedule');
    }
}
