<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutDetailCrzRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_detail_crz_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_detail_id');
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
        Schema::dropIfExists('architect_layout_detail_crz_remarks');
    }
}
