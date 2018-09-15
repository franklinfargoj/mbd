<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOlSocietyDocumentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_document_status', function (Blueprint $table) {
            $table->string('deleted_comment_by_EE')->after('comment_by_EE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_society_document_status', function (Blueprint $table) {
            $table->dropColumn('deleted_comment_by_EE');
        });
    }
}
