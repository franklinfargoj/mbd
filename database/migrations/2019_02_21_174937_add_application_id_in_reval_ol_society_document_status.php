<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplicationIdInRevalOlSocietyDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reval_ol_society_document_status', function (Blueprint $table){
            if (!Schema::hasColumn('reval_ol_society_document_status', 'application_id')){
                $table->integer('application_id')->after('id')->nullable();                
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
            if (Schema::hasColumn('reval_ol_society_document_status', 'application_id')){
                 $table->dropColumn('application_id');               
            }             
        });
    }
}
