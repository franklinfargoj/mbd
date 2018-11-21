<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDocumentPathDataTypeToStringFromIntOfSfDocumentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sf_document_status', function (Blueprint $table) {
            $table->string('document_path')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sf_document_status', function (Blueprint $table) {
            $table->integer('document_path')->change();
        });
    }
}
