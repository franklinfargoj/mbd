<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOtherInScDocumentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sc_document_master', function (Blueprint $table) {
            if (!Schema::hasColumn('sc_document_master', 'is_other')){
                $table->tinyInteger('is_other')->after('is_optional')->default(0);
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
        Schema::table('sc_document_master', function (Blueprint $table) {
            if (Schema::hasColumn('sc_document_master', 'is_other')){
                $table->dropColumn('is_other');
            }
        });
    }
}
