<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHearingSupportDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hearing_support_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_path')->nullable();
            $table->string('document_name')->nullable();
            $table->integer('hearing_id')->nullable();
            $table->integer('hearing_user_id')->nullable();
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
        Schema::dropIfExists('hearing_support_documents');
    }
}
