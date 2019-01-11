<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpenAndCurrentStatusColumnToSfApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
           $table->tinyInteger('current_status')->default(0);
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
        Schema::table('sf_application_status_logs', function (Blueprint $table) {
            $table->dropColumn('current_status');
            $table->dropColumn('open');
        });
    }
}
