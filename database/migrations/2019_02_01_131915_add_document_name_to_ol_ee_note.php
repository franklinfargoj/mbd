<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentNameToOlEeNote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_ee_note', function (Blueprint $table) {
            if (!Schema::hasColumn('ol_ee_note', 'document_name')){
                $table->string('document_name')->after('document_path')->nullable();                
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
        Schema::table('ol_ee_note', function (Blueprint $table) {
            if (Schema::hasColumn('ol_ee_note', 'document_name')){
                 $table->dropColumn('document_name');               
            }             
        }); 
    }
}
