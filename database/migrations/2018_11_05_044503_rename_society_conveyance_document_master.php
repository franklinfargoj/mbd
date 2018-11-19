<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSocietyConveyanceDocumentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
       Schema::rename('society_conveyance_document_master', 'sc_document_master');
        Schema::table('sc_document_master', function (Blueprint $table) {
            $table->tinyInteger('society_flag')->after('language_id')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('sc_document_master', 'society_conveyance_document_master');
    }
} 
