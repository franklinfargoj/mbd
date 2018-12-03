<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocCcApplicationStatusLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_cc_application_status_log', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id');
            $table->integer('user_id')->nullable(); // application processing user id
            $table->integer('role_id')->nullable(); // role of user while processing application -
            $table->integer('status_id');
            $table->integer('to_user_id')->nullable(); // application sent to user id
            $table->string('remark')->nullable();
            $table->integer('to_role_id')->nullable();
            $table->boolean('society_flag')->default(0)->comment("1= Is Society & 0 = Not Society");
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
        Schema::dropIfExists('noc_cc_application_status_log');
    }
}
