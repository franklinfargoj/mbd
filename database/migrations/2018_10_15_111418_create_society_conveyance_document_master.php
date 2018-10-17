<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietyConveyanceDocumentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_conveyance_document_master', function (Blueprint $table){
            $table->increments('id');
            $table->string('document_name')->nullable();
            $table->integer('application_type_id')->nullable();
            $table->integer('language_id')->nullable();
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
        Schema::dropIfExists('society_conveyance_document_master');
    }
}
