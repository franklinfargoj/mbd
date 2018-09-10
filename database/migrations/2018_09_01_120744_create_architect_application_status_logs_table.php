<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchitectApplicationStatusLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('architect_application_status_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('architect_application_id');
            $table->enum('previous_status',[1,2,3,4])->comment('1 = New Application ,2 = Scrutiny pending, 3 = shortlisted, 4 = final');;
            $table->timestamp('changed_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('architect_application_status_logs');
    }
}
