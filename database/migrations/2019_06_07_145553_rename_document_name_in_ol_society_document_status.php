<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameDocumentNameInOlSocietyDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::table('ol_society_document_status', function (Blueprint $table) {
            $table->renameColumn('document_name','name_of_document');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_society_document_status', function (Blueprint $table) {
            $table->renameColumn('name_of_document','document_name');
        });
    }
}
