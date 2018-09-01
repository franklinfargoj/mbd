<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtiStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rti_status', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('status_id');
            $table->foreign('status_id')->references('id')->on('master_rti_status')->onDelete('cascade');
            $table->unsignedInteger('application_id');
            $table->foreign('application_id')->references('id')->on('rti_form')->onDelete('cascade');
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
        Schema::dropIfExists('rti_status');
    }
}
