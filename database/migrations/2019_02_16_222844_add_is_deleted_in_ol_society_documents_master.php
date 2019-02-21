<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDeletedInOlSocietyDocumentsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table){
            if (!Schema::hasColumn('ol_society_documents_master', 'group')){
                $table->integer('group')->after('id')->nullable();                
            } 
            if (!Schema::hasColumn('ol_society_documents_master', 'sort_by')){
                $table->integer('sort_by')->after('is_multiple')->nullable();                
            } 
            if (!Schema::hasColumn('ol_society_documents_master', 'is_deleted')){
                $table->tinyInteger('is_deleted')->after('sort_by')->default(0);                
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
            if (Schema::hasColumn('ol_society_documents_master', 'group')){
                 $table->dropColumn('group');               
            }            
            if (Schema::hasColumn('ol_society_documents_master', 'sort_by')){
                 $table->dropColumn('sort_by');               
            }            
            if (Schema::hasColumn('ol_society_documents_master', 'is_deleted')){
                 $table->dropColumn('is_deleted');               
            }             
        });
    }
}
