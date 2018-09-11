<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtiScheduleMeetingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rti_schedule_meetings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_no');
            $table->string('meeting_scheduled_date');
            $table->string('meeting_venue');
            $table->string('meeting_time');
            $table->string('contact_person_name');
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
        Schema::dropIfExists('rti_schedule_meetings');
    }
}
