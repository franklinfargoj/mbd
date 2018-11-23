<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NocSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_society_documents_master', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->default(0); //  default 0
            $table->integer('application_id');
            $table->string('name');
            $table->tinyInteger('is_optional')->default('0');
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
        Schema::dropIfExists('noc_society_documents_master');
    }
}
