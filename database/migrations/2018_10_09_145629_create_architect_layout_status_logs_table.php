<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectLayoutStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_layout_status_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('architect_layout_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('role_id')->nullable();
            $table->integer('status_id')->nullable();
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
        Schema::dropIfExists('architect_layout_status_logs');
    }
}
