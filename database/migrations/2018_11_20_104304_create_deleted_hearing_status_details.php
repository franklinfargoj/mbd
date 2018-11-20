<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedHearingStatusDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_hearing_status_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('hearing_status_details_id');
            $table->string('user_name')->nullable();
            $table->string('status_title')->nullable();
            $table->string('day')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('deleted_hearing_status_details');
    }
}
