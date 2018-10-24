<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenToArchitectLayoutStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_layout_status_logs', function (Blueprint $table) {
            $table->tinyInteger('open')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_layout_status_logs', function (Blueprint $table) {
            $table->dropColumn('open');
        });
    }
}
