<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailMsgSendDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_msg_sent_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('mobile_no',20)->nullable();
            $table->string('mail_id',50)->nullable();
            $table->binary('msg_content')->nullable();
            $table->binary('mail_content')->nullable();
            $table->tinyInteger('is_delivered')->default(0);
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('mail_msg_sent_details');
    }
}
