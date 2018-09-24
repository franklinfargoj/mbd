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
            $table->integer('user_id')->nullable(); // application processing user id
            $table->integer('role_id')->nullable(); // role of user while processing application -
            $table->integer('hearing_status_id');
            $table->integer('to_user_id')->nullable();
            $table->integer('to_role_id')->nullable();
            $table->string('remark')->nullable();
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
