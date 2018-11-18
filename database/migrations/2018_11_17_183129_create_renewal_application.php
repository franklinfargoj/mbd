<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenewalApplication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_application', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_master_id')->nullable();
            $table->integer('form_request_id')->nullable();
            $table->integer('layout_id')->nullable();
            $table->integer('society_id')->nullable();
            $table->string('application_no',25)->nullable();
            $table->string('application_type',50)->nullable();
            $table->integer('application_status')->nullable();
            $table->string('riders')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renewal_application');
    }
}
