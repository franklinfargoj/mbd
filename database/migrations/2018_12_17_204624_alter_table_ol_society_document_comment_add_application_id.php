<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOlSocietyDocumentCommentAddApplicationId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ol_society_document_comment', function (Blueprint $table) {
            $table->string('application_id')->nullable()->after('society_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ol_society_document_comment', function (Blueprint $table) {
            $table->dropColumn('application_id');
        });
    }
}
