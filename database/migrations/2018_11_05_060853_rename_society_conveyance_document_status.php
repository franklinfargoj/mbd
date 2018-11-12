<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameSocietyConveyanceDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
       Schema::rename('society_conveyance_document_status', 'sc_document_status');
        Schema::table('sc_document_status', function (Blueprint $table) {
            $table->renameColumn('conveyance_document_id','document_id');
            $table->integer('user_id')->after('application_id')->nullable();
            $table->tinyInteger('society_flag')->after('user_id')->default('0');
            $table->integer('status_id')->after('society_flag')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('sc_document_status', 'society_conveyance_document_status');
        Schema::table('sc_document_status', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('society_flag');
            $table->dropColumn('status_id');
        });
    }
}
