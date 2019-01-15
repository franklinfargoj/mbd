<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForiegnKeyFromRtiForwardApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_forward_application', function (Blueprint $table) {
            $table->dropForeign('rti_forward_application_application_id_foreign');
            $table->dropForeign('rti_forward_application_board_id_foreign');
            $table->dropForeign('rti_forward_application_department_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rti_forward_application', function (Blueprint $table) {
            $table->foreign('rti_forward_application_application_id_foreign')->references('id')->on('rti_forward_application');
            $table->foreign('rti_forward_application_board_id_foreign')->references('id')->on('boards');
            $table->foreign('rti_forward_application_department_id_foreign')->references('id')->on('board_departments');
        });
    }
}
