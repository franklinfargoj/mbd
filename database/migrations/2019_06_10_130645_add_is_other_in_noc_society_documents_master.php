<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOtherInNocSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // add is_other in NOC module 
        Schema::table('noc_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_society_documents_master', 'is_other')){
                $table->tinyInteger('is_other')->after('is_optional')->default(0);
            } 
        });

        Schema::table('noc_society_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('noc_society_document_status', 'name_of_document')){
                $table->string('name_of_document')->after('society_document_path')->nullable();
            } 
        }); 

        // add is_other in OC module
        Schema::table('oc_society_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('oc_society_document_status', 'name_of_document')){
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
        Schema::table('noc_society_documents_master', function (Blueprint $table) {
            if (Schema::hasColumn('noc_society_documents_master', 'is_other')){
                $table->dropColumn('is_other');
            }
        });

        Schema::table('noc_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('noc_society_document_status', 'name_of_document')){
                $table->dropColumn('name_of_document');
            }
        });

        // OC module
        Schema::table('oc_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('oc_society_document_status', 'name_of_document')){
                $table->dropColumn('name_of_document');
            }
        });
    }
}
