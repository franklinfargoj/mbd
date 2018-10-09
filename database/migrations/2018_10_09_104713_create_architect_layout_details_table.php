<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_id');
            $table->string('latest_layout')->nullable();
            $table->string('old_approved_layout')->nullable();
            $table->string('last_submitted_layout_for_approval')->nullable();
            $table->string('cts_plan')->nullable();
            $table->string('survey_report')->nullable();
            $table->string('dp_letter')->nullable();
            $table->string('dp_plan')->nullable();
            $table->text('dp_comment')->nullable();
            $table->string('crz_letter')->nullable();
            $table->string('crz_plan')->nullable();
            $table->text('crz_comment')->nullable();
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
        Schema::dropIfExists('architect_layout_details');
    }
}
