<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlRequestFormDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_request_form_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id');
            $table->date('date_of_meeting');
            $table->string('resolution_no');
            $table->string('architect_name')->nullable();
            $table->string('developer_name')->nullable();
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
        Schema::dropIfExists('ol_request_form_details');
    }
}
