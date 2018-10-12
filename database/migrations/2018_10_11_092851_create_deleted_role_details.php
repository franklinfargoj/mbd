<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeletedRoleDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deleted_role_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_details_id');
            $table->string('user_name')->nullable();
            $table->string('role_name')->nullable();
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
        Schema::dropIfExists('deleted_role_details');
    }
}