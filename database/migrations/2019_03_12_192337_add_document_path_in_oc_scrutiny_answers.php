<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentPathInOcScrutinyAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('oc_scrutiny_answers', function (Blueprint $table){
            if (!Schema::hasColumn('oc_scrutiny_answers', 'document_path')){
                $table->string('document_path')->after('answer')->nullable();                
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
        Schema::table('oc_scrutiny_answers', function (Blueprint $table){
            if (Schema::hasColumn('oc_scrutiny_answers', 'document_path')){
                $table->dropColumn('document_path');                
            }       
        });
    }
}
