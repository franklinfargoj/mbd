<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameOfDocumentInRevalOlSocietyDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reval_ol_society_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('reval_ol_society_document_status', 'name_of_document')){
                $table->string('name_of_document')->after('society_document_path')->nullable();
            } 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reval_ol_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('reval_ol_society_document_status', 'name_of_document')){
                $table->dropColumn('name_of_document');
            }
        });
    }
}
