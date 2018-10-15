<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScApplicationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_application_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->tinyInteger('society_flag');
            $table->integer('user_id'); // application processing user id
            $table->integer('role_id'); // role of user while processing application -
            $table->integer('status_id');
            $table->integer('to_user_id'); // application sent to user id
            $table->integer('to_role_id'); // application sent to role id
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
        Schema::dropIfExists('sc_application_log');
    }
}
