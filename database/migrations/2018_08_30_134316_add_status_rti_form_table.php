<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusRtiFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rti_form', function (Blueprint $table) {
            $table->unsignedInteger('status');
            $table->foreign('status')->references('id')->on('master_rti_status')->onDelete('cascade');
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
            $table->dropColumns(['status']);
        });
    }
}
