<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOtherInOlSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_documents_master', 'is_other')){
                $table->tinyInteger('is_other')->after('is_multiple')->default(0);
            } 
        });

        Schema::table('ol_society_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_document_status', 'document_name')){
                $table->string('document_name')->after('member_name')->nullable();
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
            if (Schema::hasColumn('ol_society_documents_master', 'is_other')){
                $table->dropColumn('is_other');
            }
        });

        Schema::table('ol_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('ol_society_document_status', 'document_name')){
                $table->dropColumn('document_name');
            }
        });
    }
}
