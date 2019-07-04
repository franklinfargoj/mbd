<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullOcDocumentOlSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_documents_master', 'full_oc_document')){
                $table->tinyInteger('full_oc_document')->after('is_deleted')->default('0');
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
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (Schema::hasColumn('ol_society_documents_master', 'full_oc_document')){
                $table->dropColumn('full_oc_document');
            }
        });
    }
}
