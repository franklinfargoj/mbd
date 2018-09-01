<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRtiScheduleMeetingsApplicationNoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->unsignedInteger('rti_schedule_meeting_id');
            $table->foreign('rti_schedule_meeting_id')->references('id')->on('rti_schedule_meetings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->dropColumns(['rti_schedule_meeting_id']);
        });
    }
}
