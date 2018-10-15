<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietyConveyanceDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_conveyance_document_status', function (Blueprint $table){
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('conveyance_document_id')->nullable();
            $table->string('document_path')->nullable();
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
        Schema::dropIfExists('society_conveyance_document_status');
    }
}
