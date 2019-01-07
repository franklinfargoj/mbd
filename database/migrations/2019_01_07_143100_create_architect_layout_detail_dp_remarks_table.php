<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailDpRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_dp_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_detail_id');
            $table->string('dp_letter')->nullable();
            $table->string('dp_plan')->nullable();
            $table->text('dp_comment')->nullable();
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
        Schema::dropIfExists('architect_layout_detail_dp_remarks');
    }
}
