<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSendForScrutinyStatusToArchitectLayouts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->tinyInteger('sent_for_scrutiny_status')->default(0);
        });

        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->dropColumn('sent_for_scrutiny_status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layouts', function (Blueprint $table) {
            $table->dropColumn('sent_for_scrutiny_status')->default(0);
        });

        Schema::table('eoa_applications', function (Blueprint $table) {
            $table->tinyInteger('sent_for_scrutiny_status')->default(0);
        });
    }
}
