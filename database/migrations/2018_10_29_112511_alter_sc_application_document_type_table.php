<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScApplicationDocumentTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('sc_application_master', function (Blueprint $table) {
//            $table->increments('id');
//            $table->timestamps();
//        });
        Schema::rename('society_application_document_type', 'sc_application_master');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('society_application_document_type');
    }
}
