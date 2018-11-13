<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendForScrtinyStatusToEoaApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->tinyInteger('send_for_scrtiny_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->dropColumn('send_for_scrtiny_status');
        });
    }
}
