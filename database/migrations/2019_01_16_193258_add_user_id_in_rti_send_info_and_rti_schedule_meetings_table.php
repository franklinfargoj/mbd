<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdInRtiSendInfoAndRtiScheduleMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_schedule_meetings', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });
        Schema::table('rti_send_info', function (Blueprint $table) {
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_schedule_meetings', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('rti_send_info', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
