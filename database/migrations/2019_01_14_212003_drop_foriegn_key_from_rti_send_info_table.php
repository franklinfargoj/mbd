<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForiegnKeyFromRtiSendInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_send_info', function (Blueprint $table) {
            $table->dropForeign('rti_send_info_application_id_foreign');
            $table->dropForeign('rti_send_info_rti_status_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_send_info', function (Blueprint $table) {
            $table->foreign('rti_send_info_application_id_foreign')->references('id')->on('rti_form');
            $table->foreign('rti_send_info_rti_status_id_foreign')->references('id')->on('rti_status');
            
        });
    }
}
