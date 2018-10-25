<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsOptionalSocietyDocumentMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_documents_master', function (Blueprint $table) {
            $table->tinyInteger('is_optional')->after('name')->default('0');
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
            $table->dropColumn('is_optional');
        });
    }
}
