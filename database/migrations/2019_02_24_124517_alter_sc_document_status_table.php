<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScDocumentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_document_status', 'other_document_name')){
                $table->string('other_document_name')->nullable();
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
        Schema::table('sc_document_status', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_document_status', 'other_document_name')){
                $table->dropColumn('other_document_name');
            }
        });
    }
}
