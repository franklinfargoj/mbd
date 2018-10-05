<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePreviousStatusFromArchitectApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('architect_application_status_logs', function (Blueprint $table) {
            $table->dropColumn('previous_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('architect_application_status_logs', function (Blueprint $table) {
            $table->enum('previous_status',[1,2,3,4])->comment('1 = New Application ,2 = Scrutiny pending, 3 = shortlisted, 4 = final');
        });
    }
}
