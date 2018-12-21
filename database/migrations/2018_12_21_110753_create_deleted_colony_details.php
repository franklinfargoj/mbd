<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedColonyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_colony_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('colony_details_id');
            $table->string('user_name')->nullable();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('deleted_colony_details');
    }
}
