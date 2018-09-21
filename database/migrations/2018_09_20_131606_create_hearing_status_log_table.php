<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHearingStatusLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearing_status_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hearing_id');
            $table->integer('user_id'); // application processing user id
            $table->integer('role_id'); // role of user while processing application -
            $table->integer('hearing_status_id');
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
        Schema::dropIfExists('hearing_status_log');
    }
}
