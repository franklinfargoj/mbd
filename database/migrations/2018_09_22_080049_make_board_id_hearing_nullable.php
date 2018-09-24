<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeBoardIdHearingNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hearing', function (Blueprint $table) {
            $table->integer('department_id')->change()->nullable();
            $table->integer('board_id')->change()->nullable();
            $table->integer('hearing_status_id')->change()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hearing', function (Blueprint $table) {
            //
        });
    }
}
