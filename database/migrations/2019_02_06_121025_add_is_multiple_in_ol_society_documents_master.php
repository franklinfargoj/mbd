<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsMultipleInOlSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_documents_master', 'is_multiple')){
                $table->tinyInteger('is_multiple')->after('is_optional')->default(0);                
            }            
        }); 

        Schema::table('ol_society_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_society_document_status', 'member_name')){
                $table->string('member_name')->after('society_document_path')->nullable();                
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
            if (Schema::hasColumn('ol_society_documents_master', 'is_multiple')){
                 $table->dropColumn('is_multiple');               
            }             
        });        

        Schema::table('ol_society_document_status', function (Blueprint $table) {
            if (Schema::hasColumn('ol_society_document_status', 'member_name')){
                 $table->dropColumn('member_name');               
            }             
        }); 
    }
}
