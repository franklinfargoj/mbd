<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedUserLayoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_user_layouts_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_layouts_details_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('layout_name')->nullable();
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
        Schema::dropIfExists('deleted_user_layouts_details');
    }
}
