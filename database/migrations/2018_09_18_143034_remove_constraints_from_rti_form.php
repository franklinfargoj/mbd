<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveConstraintsFromRtiForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_form', function (Blueprint $table) {
          $table->dropForeign(['rti_schedule_meeting_id']);
          $table->dropForeign(['rti_status_id']);
          $table->dropForeign(['rti_send_info_id']);
          $table->dropForeign(['rti_forward_application_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
