<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOlSocietyDocumentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ol_society_document_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('society_id');
            $table->integer('document_id');
            $table->string('society_document_path');
            $table->string('EE_document_path')->nullable();
            $table->string('comment_by_EE')->nullable();
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
        Schema::dropIfExists('ol_society_document_status');
    }
}
