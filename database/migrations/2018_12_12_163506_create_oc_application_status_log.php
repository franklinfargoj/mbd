<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcApplicationStatusLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oc_application_status_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->boolean('society_flag')->default(0)->comment("1= Is Society & 0 = Not Society");
            $table->integer('user_id')->nullable(); // application processing user id
            $table->integer('role_id')->nullable(); // role of user while processing application -
            $table->integer('status_id');
            $table->integer('to_user_id')->nullable(); // application sent to user id
            $table->integer('to_role_id')->nullable();
            $table->string('remark')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('phase')->default(0);
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
        Schema::dropIfExists('oc_application_status_log');
    }
}
