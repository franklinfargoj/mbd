<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSfDocumentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_document_status', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('society_flag')->default(0);
            $table->integer('status_id')->nullable();
            $table->integer('document_id')->nullable();
            $table->integer('document_path')->nullable();
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
        Schema::dropIfExists('sf_applications');
    }
}
